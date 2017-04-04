<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_slide extends CI_Model{
    function ajax_list() {
        $dataorder    = array();
        $dataorder[2] = "slide_order";
        $dataorder[3] = "slide_active";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        // $user_active = $this->input->post("user_active");
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'slide';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);


        $query = "
        select
            t_slide.*
        from t_slide
        where slide_active in ('y','n')
        ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " replace(slide_order, '''', '') LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(slide_active, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->slide_id;

            $view = '';
            $edit = '';
            $delete = '';
            if (in_array('view_slide', $ar_haklistakses)) {
              $view=
              '<a href="#" onclick="btn_view('.$id.')" class="btn btn-info btn-sm" title="view">
              <i class="fa fa-search"></i>
              </a>';
            }
            if (in_array('update_slide', $ar_haklistakses)) {
              $edit=
              '<a href="'.site_url().'slide/update/'.$id.'" class="btn btn-xs green" title="edit">
              <i class="fa fa-pencil"></i>
              </a>';
            }
            if (in_array('delete_slide', $ar_haklistakses)) {
              $delete='
              <a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="btn btn-xs red" title="delete">
              <i class="fa fa-trash-o"></i>
              </a> ';
            }

            $gambar=(count($d->slide_file) > 0) ? '<a class="fancybox" href="'.base_url().'/uploads/slide/'.$d->slide_file.'"><img src="'.base_url().'/uploads/slide/'.$d->slide_file.'" width="100" height="100">' :'<img src="'.base_url().'/uploads/slide/'.$d->slide_file.'" width="100" height="100">';
            $r = array();
            $r[0] = $i;
            $r[1] = $gambar;
            $r[2] = $d->slide_order;
            $r[3] = $d->slide_active;
            $r[4] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

    public function upload_slide_photo()
    {
        $config['upload_path'] = './uploads/slide/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['max_size']  = '90000';
        // $config['max_width']  = '1024';
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('slide_file')){
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
