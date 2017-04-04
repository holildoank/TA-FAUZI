<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_promotion extends CI_Model{
    function ajax_list() {
        $dataorder    = array();
        $dataorder[2] = "promotion_name";
        $dataorder[3] = "promotion_desc";
        $dataorder[4] = "promotion_endat";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        $usergroup_id = $this->session->userdata('usergroup_id');

        $query = "
        select
            t_promotion.*
        from t_promotion
        where promotion_active in ('y','n')
        ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " replace(promotion_name, '''', '') LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(promotion_desc, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(promotion_endat, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->promotion_id;

            $view = '';
            $edit = '';
            $delete = '';

            $view=
            '<a href="#" onclick="btn_view('.$id.')" class="btn btn-info btn-sm" title="view">
            <i class="fa fa-search"></i>
            </a>';
            if($usergroup_id==1 || $usergroup_id==2){
                $edit=
                '<a href="'.site_url().'promotion/update/'.$id.'" class="btn btn-xs green" title="edit">
                <i class="fa fa-pencil"></i>
                </a>';
                $delete='
                <a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="btn btn-xs red" title="delete">
                <i class="fa fa-trash-o"></i>
                </a> ';
            }
             $gambar=(count($d->promotion_file) > 0) ? '<a class="fancybox" href="'.base_url().'/uploads/promotion/'.$d->promotion_file.'"><img src="'.base_url().'/uploads/promotion/'.$d->promotion_file.'" width="100" height="100">' :'<img src="'.base_url().'/uploads/promotion/'.$d->promotion_file.'" width="100" height="100">'; 
            
            
            $r = array();

            $r[0] = $i;
            $r[1] = $gambar;
            $r[2] = $d->promotion_name;
            $r[3] = $d->promotion_desc;
            $r[4] = date('d M Y - H:i', strtotime($d->promotion_startat));
            $r[5] = date('d M Y - H:i', strtotime($d->promotion_endat));
            $r[6] = $d->promotion_active;
            $r[7] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

    public function upload_promotion_photo()
    {
        $config['upload_path'] = './uploads/promotion/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['max_size']  = '90000';
        // $config['max_width']  = '1024';
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('promotion_file')){
            $result['stat'] = false;
            $error = array('error' => $this->upload->display_errors());
            $result = array(
                            'stat' => false,
                            'data' => $error['error'],
                            );
        }
        else{
            $upload_data = $this->upload->data();
            $result = array(
                            'stat' => true,
                            'data' => $upload_data,
                            );
        }
        return $result;
    }
}
