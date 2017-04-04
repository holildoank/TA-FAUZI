<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product extends CI_Model{
    function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "product_name";
        $dataorder[2] = "product_desc";
        $dataorder[3] = "service_name";
        $dataorder[4] = "staff_name";
        $dataorder[5] = "product_price";
        $dataorder[6] = "product_duration";
        $dataorder[7] = "product_active";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        $usergroup_id = $this->session->userdata('usergroup_id');
        $filter_service_id = $this->input->post('filter_service_id');
        $filter_staff_id = $this->input->post('filter_staff_id');

        $query = "
        select
            t_product.*,
            m_service.service_name,
            m_staff.staff_name
        from t_product
        left join m_service on(t_product.service_id=m_service.service_id)
        left join m_staff on(t_product.staff_id=m_staff.staff_id)
        where product_active in ('y','n')
        ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " replace(product_name, '''', '') LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(product_desc, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(service_name, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(staff_name , '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(product_price, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(product_active, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(product_duration, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " ) ";
        }

        if (!empty($filter_service_id)) {
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= "t_product.service_id = '$filter_service_id' ";
        }
        if (!empty($filter_staff_id)) {
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= "t_product.staff_id = '$filter_staff_id' ";
        }

        if($order){
            $query.= " order by
              ".$dataorder[$order[0]["column"]]." ".$order[0]["dir"];
        }

        $iTotalRecords  = $this->db->query("SELECT COUNT(*) AS numrows FROM (".$query.") A")->row()->numrows;
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart  = intval($_REQUEST['start']);
        $query          .= " LIMIT ". ($start) .",".($iDisplayLength);

        $data = $this->db->query($query)->result();
        $i = 0;
        $result = array();
        foreach ($data as $d) {
            $i++;
            $id = $d->product_id;

            $view = '';
            $edit = '';
            $delete = '';

            $view=
            '<a href="#" onclick="btn_view('.$id.')" class="btn btn-info btn-sm" title="view">
            <i class="fa fa-search"></i>
            </a>';
            if($usergroup_id==1 || $usergroup_id==2){

                $edit=
                '<a href="'.site_url().'product/update/'.$id.'" class="btn btn-xs green" title="edit">
                <i class="fa fa-pencil"></i>
                </a>';
                $delete='
                <a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="btn btn-xs red" title="delete">
                <i class="fa fa-trash-o"></i>
                </a> ';
            }

            $r = array();
            $r[0]  = $i;
            $r[1]  = $d->product_name;
            $r[2] = $d->product_desc;
            $r[3] = $d->service_name;
            $r[4] = $d->staff_name;
            $r[5] = $d->product_price;
            $r[6] = $d->product_duration;
            $r[7] = $d->product_active;
            $r[8]  = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

}
