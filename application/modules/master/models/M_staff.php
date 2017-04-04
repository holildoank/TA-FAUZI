<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_staff extends CI_Model{
    function ajax_list() {
        $dataorder    = array();
        $dataorder[2] = "staff_name";
        $dataorder[3] = "staff_address";
        $dataorder[4] = "staff_gender";
        $dataorder[5] = "staff_position";
        $dataorder[6] = "staff_active";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        // $usergroup_id = $this->session->userdata('usergroup_id');
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'staff';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        $query = "
        select
            m_staff.*
        from m_staff
        where staff_active in ('y','n')
        ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " replace(staff_name, '''', '') LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(staff_address, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(staff_gender, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(staff_position, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(staff_active, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->staff_id;

            $view = '';
            $edit = '';
            $delete = '';
                if (in_array('view_staff', $ar_haklistakses)) {
                  $view=
                  '<a href="#" onclick="btn_view('.$id.')" class="btn btn-info btn-sm" title="view">
                  <i class="fa fa-search"></i>
                  </a>';
                }
                if (in_array('update_staff', $ar_haklistakses)) {
                  $edit=
                  '<a href="'.site_url().'staff/update/'.$id.'" class="btn btn-xs green" title="edit">
                  <i class="fa fa-pencil"></i>
                  </a>';
                }
                if (in_array('delete_staff', $ar_haklistakses)) {
                  $delete='
                  <a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="btn btn-xs red" title="delete">
                  <i class="fa fa-trash-o"></i>
                  </a> ';
                }
            $gambar=(count($d->staff_photo) > 0) ? '<a class="fancybox" href="'.base_url().'/uploads/staff/'.$d->staff_photo.'"><img src="'.base_url().'/uploads/staff/'.$d->staff_photo.'" width="100" height="100">' :'<img src="'.base_url().'/uploads/staff/'.$d->staff_photo.'" width="100" height="100">';
            $r = array();
            $r[0] = $i;
            $r[1] = $gambar;
            $r[2] = $d->staff_name;
            $r[3] = $d->staff_address;
            $r[4] = $d->staff_gender;
            $r[5] = $d->staff_position;
            $r[6] = $d->staff_active;
            $r[7] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

    public function upload_staff_photo()
    {
        $config['upload_path'] = './uploads/staff/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['max_size']  = '90000';
        // $config['max_width']  = '1024';
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('staff_photo')){
            $result['stat'] = false;
            $error = array('error' => $this->upload->display_errors());
            $result = array(
                            'stat' => false,
                            'data' => $error['error'],
                            );
        }
        else{
            // $upload_data = $this->upload->data();
            $upload_data = $this->upload->data();
            $config['image_library']  = 'gd2';
            $config['source_image']   = $config['upload_path']. $upload_data['file_name'];
            $config['create_thumb']   = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 80;
            $config['height']         = 80;
            // $config['max_width']  = '1024';
            //  $config['max_height']  = '768'
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $result = array(
                            'stat' => true,
                            'data' => $upload_data,
                            );
        }
        return $result;
    }
}
