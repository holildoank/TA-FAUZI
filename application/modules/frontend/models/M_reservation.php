<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_reservation extends CI_Model{
    function ajax_list() {
        $dataorder    = array();
        $dataorder[1] = "reservation_id";
        $dataorder[2] = "customer_name";
        $dataorder[3] = "customer_phone";
        $dataorder[4] = "service_name";
        $dataorder[5] = "reservation_startdatetime";
        $dataorder[6] = "reservation_endtime_confir";
        $dataorder[7] = "status_payment_name";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        $usergroup_id = $this->session->userdata('usergroup_id');

        $filter_sproduct_id = $this->input->post('filter_product_id');
        //datetime
        $filter_from=$this->input->post('from');
        $filter_to=$this->input->post('to');
        $query = "
        select
            v_reservation.*
                from
             v_reservation
            where reservation_active in ('y','n')
            ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " replace(reservation_number, '''', '') LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(customer_name, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(customer_phone, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(service_name , '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(reservation_startdatetime, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(reservation_endtime_confir, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(status_payment_name, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " ) ";
        }

        if (!empty($filter_sproduct_id)) {
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= "v_reservation.service_id = '$filter_sproduct_id' ";
        }

        if (!empty($filter_from) && ($filter_to)){
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " v_reservation.reservation_createat='$filter_from' BETWEEN TIME reservation_createat.reservation_createat=('$filter_to')
                AND TIME(reservation_createat)";
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
            $id = $d->reservation_id;

            $view = '';
            $edit = '';
            $delete = '';

            $view=
            '<a href="#" onclick="btn_view('.$id.')" class="btn btn-info btn-sm" title="view">
            <i class="fa fa-search"></i>
            </a>';

            if($d->status_payment_id==1){ //bru
                    $btn='btn-warning';
                    $update=$edit;
                    $kon='';
                    $hapus=$delete;
            }elseif($d->status_payment_id==2){ //konfirmas
                    $btn='btn-warning';
                    $update=$edit;
                    $kon='';
                    $hapus=$delete;
            }elseif($d->status_payment_id==3) { //selesai
                    $btn='btn-success';
                    $kon='disabled="disabled"';
                    $update='';
                    $hapus='';
            }elseif ($d->status_payment_id==4) { //sudah konfimasi sama admin
                    $btn='btn-success';
                    $kon='disabled="disabled"';
                    $update='';
                    $hapus='';
            }else{
                    $btn='btn-danger';
                    $kon='disabled="disabled"';
                    $update='';
                    $hapus='';
            }
            // if($usergroup_id==1 || $usergroup_id==2){

                $edit=
                '<a href="'.site_url().'reservation/update/'.$id.'" '.$kon.' class="btn btn-xs green" title="edit">
                <i class="fa fa-pencil"></i>
                </a>';
                $delete='
                <a href="#" onclick="event.preventDefault();btn_delete('.$id.')" '.$kon.' class="btn btn-xs red" title="delete">
                <i class="fa fa-trash-o"></i>
                </a> ';
            // }

            $konfirmasi='<a href="#" onclick="event.preventDefault();btn_konfirmasi('.$id.')" '.$kon.' class="btn btn-xs blue" title="konfirmasi pembayaran"><i class="fa fa-plane" aria-hidden="true"></i></a>';
            $status='<button type="button" class="btn '.$btn.' mt-ladda-btn ladda-button btn-circle" data-style="expand-up"><span class="ladda-label">'.$d->status_payment_name.'</span></button>';
            $no_reservation=''.$d->reservation_number.'';

            $r = array();
            $r[0] = $i;
            $r[1] = $no_reservation;
            $r[2] = $d->customer_name;
            $r[3] = $d->customer_phone;
            $r[4] = $d->service_name;
            $r[5] = date('d M Y - H:i',strtotime($d->reservation_startdatetime));
            $r[6] = date('d M Y - H:i',strtotime($d->reservation_endtime_confir));
            $r[7] = $status;
            $r[8] = $edit.$delete.$konfirmasi;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }
    function ajax_list_front() {
        $dataorder    = array();
        $dataorder[1] = "reservation_id";
        $dataorder[2] = "customer_name";
        $dataorder[3] = "customer_phone";
        $dataorder[4] = "product_name";
        $dataorder[5] = "staff_name";
        $dataorder[6] = "reservation_startdatetime";
        $dataorder[7] = "reservation_endtime_confir";
        $dataorder[8] = "status_payment_name";

        $start = intval($_POST['start']);
        $sEcho = intval($_POST['draw']);

        $order  = $this->input->post('order');
        $search = $this->input->post("search");
        $usergroup_id = $this->session->userdata('usergroup_id');

        $filter_sproduct_id = $this->input->post('filter_product_id');
        $filter_staff_id = $this->input->post('filter_staff_id');

        $query = "
        select
            v_reservation.*
                from
             v_reservation
            ";

        // var_dump($query);
        if (!empty($search)) {
            $s_search = str_replace("'","",$search["value"]);
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= " ( ";
            $query .= " replace(reservation_id, '''', '') LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(customer_name, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(customer_phone, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(product_name , '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(staff_name, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(reservation_startdatetime, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(reservation_endtime_confir, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " OR LOWER(replace(status_payment_name, '''', '')) LIKE '%".strtolower($s_search)."%' ";
            $query .= " ) ";
        }

        if (!empty($filter_sproduct_id)) {
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= "v_reservation.product_id = '$filter_sproduct_id' ";
        }
        if (!empty($filter_staff_id)) {
            $query .= preg_match("/WHERE/i", $query) ? " AND " : " WHERE ";
            $query .= "v_reservation.staff_id = '$filter_staff_id' ";
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
            $id = $d->reservation_id;


            if($d->status_payment_id==1){ //bru
                    $btn='btn-warning';
                    $update=$edit;
                    $kon='';
                    $hapus=$delete;
            }elseif($d->status_payment_id==2){ //konfirmas
                    $btn='btn-warning';
                    $update=$edit;
                    $kon='';
                    $hapus=$delete;
            }elseif($d->status_payment_id==3) { //selesai
                    $btn='btn-success';
                    $kon='disabled="disabled"';
                    $update='';
                    $hapus='';
            }elseif ($d->status_payment_id==4) { //sudah konfimasi sama admin
                    $btn='btn-success';
                    $kon='disabled="disabled"';
                    $update='';
                    $hapus='';
            }else{
                    $btn='btn-danger';
                    $kon='disabled="disabled"';
                    $update='';
                    $hapus='';
            }
            $status='<button type="button" class="btn '.$btn.' mt-ladda-btn ladda-button btn-circle" data-style="expand-up"><span class="ladda-label">'.$d->status_payment_name.'</span></button>';

            $r = array();
            $r[0] = $i;
            $r[1] = $d->customer_name;
            $r[2] = $d->staff_name;
            $r[3] = $d->product_name;
            $r[4] = date('D/d M Y - H:i',strtotime($d->reservation_startdatetime));
            $r[5] = $status;
            array_push($result, $r);
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
    }

}
