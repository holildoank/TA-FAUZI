<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_usergroup extends CI_Model{
    function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "usergroup_name";
        $dataorder[2] = "usergroup_desc";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        // $usergroup_active = $this->input->post("usergroup_active");

        $query = "
                  select
                      *
                  from m_usergroup
                  where usergroup_active = 'y'
              ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(usergroup_name, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(usergroup_desc, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->usergroup_id;

            $view = '';
            $edit = '';
            $delete = '';

            $view=
            '<a href="#" onclick="btn_view('.$id.')" class="btn btn-info btn-sm" title="view">
            <i class="fa fa-search"></i>
            </a>';
            if($d->usergroup_id==1 || $d->usergroup_id==2){
                $edit=
                '<a href="#" onclick="event.preventDefault();btn_edit('.$id.');" class="btn btn-xs green" title="edit">
                <i class="fa fa-pencil"></i>
                </a>';
            }else{
                $edit=
                '<a href="#" onclick="event.preventDefault();btn_edit('.$id.')" class="btn btn-xs green" title="edit">
                <i class="fa fa-pencil"></i>
                </a>';
                $delete='
                <a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="btn btn-xs red" title="delete">
                <i class="fa fa-trash-o"></i>
                </a> ';
            }
            $action = '
            <div class="btn-group">
              <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                  <i class="fa fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu pull-right" role="menu">
                  <li>
                      <a href="javascript:;">
                          <i class="fa fa-pencil"></i> Edit </a>
                  </li>
                  <li>
                      <a href="javascript:;">
                          <i class="fa fa-trash-o"></i> Delete </a>
                  </li>
              </ul>
            </div>
            ';

            $r = array();
            $r[0] = $i;
            $r[1] = $d->usergroup_name;
            $r[2] = $d->usergroup_desc;
            $r[3] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }
}
