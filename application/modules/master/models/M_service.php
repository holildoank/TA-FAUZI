<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_service extends CI_Model{
    function ajax_list() {
        $dataorder    = array();
        $dataorder[2] = "service_name";
        $dataorder[3] = "service_desc";
        $dataorder[4] = "service_harga";
        $dataorder[5] = "service_active";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'service';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);

        $query = "
        select
            m_service.*
        from m_service
        where service_active in ('y','n')
        ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " replace(service_name, '''', '') LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(service_desc, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(service_harga, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(service_active, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " ) ";
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
            $id = $d->service_id;

            $view = '';
            $edit = '';
            $delete = '';



            if (in_array('view_service', $ar_haklistakses)) {
              $view=
              '<a href="#" onclick="btn_view('.$id.')" class="btn btn-info btn-sm" title="view">
              <i class="fa fa-search"></i>
              </a>';
            }
            if (in_array('update_service', $ar_haklistakses)) {
              $edit=
              '<a href="#" onclick="event.preventDefault();btn_edit('.$id.');" class="btn btn-xs green" title="edit">
              <i class="fa fa-pencil"></i>
              </a>';
            }
            if (in_array('delete_service', $ar_haklistakses)) {
              $delete='
              <a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="btn btn-xs red" title="delete">
              <i class="fa fa-trash-o"></i>
              </a> ';
            }
            $r = array();
            $r[0] = $i;
            $r[1] = $d->service_name;
            $r[2] = $d->service_desc;
            $r[3] = $d->service_harga.'/'.$d->hitungan_jam.'Jam';
            $r[4] = $d->service_active;
            $r[5] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }


}
