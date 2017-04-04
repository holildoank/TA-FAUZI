<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_schedule extends CI_Model{
    function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "staff_name";
        $dataorder[2] = "schedule_date";
        $dataorder[3] = "schedule_starttime";
        $dataorder[4] = "schedule_enddatime";
        $dataorder[5] = "schedule_status";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        $usergroup_id = $this->session->userdata('usergroup_id');

        $query = "select
                    t_schedule_staff.*,
                    m_staff.staff_name
                from t_schedule_staff
                left join m_staff on(t_schedule_staff.staff_id=m_staff.staff_id)
                where schedule_active in ('y','n')
              ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " LOWER(replace(staff_name, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(schedule_date, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(schedule_starttime, '''', '')) LIKE '%".strtolower($s_search)."%' ";
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
            $id = $d->schedule_staff_id;

            $view = '';
            $edit = '';
            $delete = '';

            $view=
            '<a href="#" onclick="btn_view('.$id.')" class="btn btn-info btn-sm" title="view">
            <i class="fa fa-search"></i>
            </a>';
            // if($usergroup_id==1 || $usergroup_id==2){
                $edit=
                '<a href="#" onclick="event.preventDefault();btn_edit('.$id.');" class="btn btn-xs green" title="edit">
                <i class="fa fa-pencil"></i>
                </a>';
                $delete='
                <a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="btn btn-xs red" title="delete">
                <i class="fa fa-trash-o"></i>
                </a> ';
            // }else{
            //     $edit=
            //     '<a href="#" onclick="event.preventDefault();btn_edit('.$id.')" class="btn btn-xs green" title="edit">
            //     <i class="fa fa-pencil"></i>
            //     </a>';
            //     $delete='
            //     <a href="#" onclick="event.preventDefault();btn_delete('.$id.')" class="btn btn-xs red" title="delete">
            //     <i class="fa fa-trash-o"></i>
            //     </a> ';
            // }
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
            $r[1] = $d->staff_name;
            $r[2] = date('Y-m-d',strtotime($d->schedule_date));
            $r[3] = date('H:i', strtotime($d->schedule_starttime));
            $r[4] = date('H:i', strtotime($d->schedule_enddatime));
            $r[5] = $d->schedule_status;
            $r[6] = $edit.$delete;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }
}
