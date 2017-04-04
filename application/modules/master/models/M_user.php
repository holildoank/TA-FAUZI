<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
    function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "user_username";
        $dataorder[2] = "usergroup_name";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");


        // start hak akses
        $akses_usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        $akses_menu_kode = 'user';
        $ar_haklistakses = get_listakses($akses_usergroup_id, $akses_menu_kode);
        // end hak akses
        // $user_active = $this->input->post("user_active");

        $query = "
        select
       a.user_id,
       a.user_username,
       a.user_active,
       b.usergroup_name
       from m_user a
       left join m_usergroup b on (a.usergroup_id=b.usergroup_id)
       where user_active in ('y','t')
        ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(user_username, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(usergroup_name, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->user_id;

            $view = '';
            $edit = '';
            $delete = '';

            $view=
            '';
            if (in_array('xread_user', $ar_haklistakses)) {
                $view='<a href="#" onclick="btn_view('.$id.')" class="btn btn-info btn-sm" title="view">
                <i class="fa fa-search"></i>
                </a> ';
            }
            if (in_array('xupdate_user', $ar_haklistakses)) {
                $edit='<a href="'.site_url().'user/update/'.$id.'" class="btn btn-xs green" title="edit">
                <i class="fa fa-pencil"></i>
                </a> ';
            }
            if (in_array('xdelete_user', $ar_haklistakses)) {
                $delete='<a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="btn btn-xs red" title="delete">
                <i class="fa fa-trash-o"></i>
                </a> ';
            }

            $r = array();

            $r[0] = $i;
            $r[1] = $d->user_username;
            $r[2] = $d->usergroup_name;
            $r[3] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

    public function upload_user_photo()
    {
        $config['upload_path'] = './uploads/user/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['max_size']  = '90000';
        // $config['max_width']  = '1024';
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('user_photo')){
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
