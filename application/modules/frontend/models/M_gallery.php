<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gallery extends CI_Model{
    function ajax_list() {
        $dataorder    = array();
        $dataorder[2] = "gallery_desc";
        $dataorder[3] = "gallery_active";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        $usergroup_id = $this->session->userdata('usergroup_id');

        $query = "
        select
            t_gallery.*
        from t_gallery
        where gallery_active in ('y','n')
        ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " replace(gallery_desc, '''', '') LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(gallery_active, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->gallery_id;

            $view = '';
            $edit = '';
            $delete = '';

            $view=
            '<a href="#" onclick="btn_view('.$id.')" class="btn btn-info btn-sm" title="view">
            <i class="fa fa-search"></i>
            </a>';
            // if($usergroup_id==1 || $usergroup_id==2){
                $edit=
                '<a href="'.site_url().'gallery/update/'.$id.'" class="btn btn-xs green" title="edit">
                <i class="fa fa-pencil"></i>
                </a>';
                $delete='
                <a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="btn btn-xs red" title="delete">
                <i class="fa fa-trash-o"></i>
                </a> ';
            // }
            $gambar       = (count($d->gallery_file) > 0) ? '<a class="fancybox" href="'.base_url().'/uploads/gallery/'.$d->gallery_file.'"><img src="'.base_url().'/uploads/gallery/'.$d->gallery_file.'" width="100" height="100">': '<img src="'.base_url().'/uploads/gallery/'.$d->gallery_file.'" width="100" height="100">';
            $asli         = $d->gallery_file;
            $tanpa_ext    = preg_replace('/\.[^.\s]{3,4}$/', '', $asli);
            $pathinfo     = pathinfo($asli);
            $ext          = $pathinfo['extension'];
            $thumb        = $tanpa_ext.'_thumb.'.$ext;
            $gambar_thumb = (count($d->gallery_file) > 0) ? '<a class="fancybox" href="'.base_url().'/uploads/gallery/'.$d->gallery_file.'"><img src="'.base_url().'/uploads/gallery/'.$thumb.'" width="100" height="100">':           '<img src="'.base_url().'/uploads/gallery/'.$thumb.'" width="100" height="100">';

            $r = array();
            $r[0] = $i;
            $r[1] = $gambar_thumb;
            $r[2] = $d->gallery_desc;
            $r[3] = $d->gallery_active;
            $r[4] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

    public function upload_gallery_photo()
    {
        $config['upload_path'] = './uploads/gallery/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']  = '90000';
        // $config['max_width']  = '35';
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('gallery_file')){
            $result['stat'] = false;
            $error = array('error' => $this->upload->display_errors());
            $result = array(
                            'stat' => false,
                            'data' => $error['error'],
                            );
        }else{
            $upload_data = $this->upload->data();
            $config['image_library']  = 'gd2';
            $config['source_image']   = $config['upload_path']. $upload_data['file_name'];
            $config['create_thumb']   = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 350;
            $config['height']         = 250;
            // $config['max_width']  = '1024';
            //  $config['max_height']  = '768'
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            // $this->image_lib->crop();
            $result = array(
                            'stat' => true,
                            'data' => $upload_data,
                            );

        }
        return $result;
    }
}
