<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_schedule  extends MX_Controller {

    public function __construct()
    {

    parent::__construct();
    $this->load->model('base/m_base');
    $this->load->model('m_schedule');
    $is_logged_in = $this->session->userdata(base_url().'is_logged_in');
    if(!isset($is_logged_in) || $is_logged_in != true)
    {
        redirect(site_url());
    }
    $this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
    $this->menu_parent  = 'frontend';
    $this->menu_child   = 'schedule';
    $this->menu_kode    = 'schedule';
    //session menu
    $data_sess = array(
      base_url().'menu_parent' => $this->menu_parent,
      base_url().'menu_child'  => $this->menu_child,
      'page_title' => 'DigiReservation | schedule',
    );
    modules::run('base/c_base/set_session_menu', $data_sess);
    }

    public function index()
    {
        $data = array();
		$data['m_staff'] = $this->m_base->get_data('m_staff', array('staff_active'=>'y'), 'staff_id, staff_name');
		$data_view['content_layout'] = $this->load->view('v_schedule', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
    }

    public function ajax_list()
    {
        $records = $this->m_schedule->ajax_list();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }
    public function create()
	{
		$data['mode'] = 'add';
		$data['judul'] = '<i class="fa fa-plus"></i> Add New  Time Schedule Staff';
        $data['data_staff'] = $this->m_base->get_data('m_staff', array('staff_active'=>'y'), 'staff_id, staff_name');
		$this->load->view('v_modal_schedule_form', $data);
	}
    public function create_action()
	{
		$createby = $this->session->userdata('user_id');
		$createat = date('Y-m-d H:i:s');
        $schedule_starttime = date('H:i:s', strtotime($this->input->post('schedule_starttime')));
        $schedule_enddatime = date('H:i:s', strtotime($this->input->post('schedule_enddatime')));

        $schedule_date = date('Y-m-d', strtotime($this->input->post('schedule_date')));
        $staff_id = $this->input->post('staff_id');

        $sql_cek = "
            SELECT
                *
            FROM
                t_schedule_staff
            WHERE
            staff_id = '$staff_id'
            AND date(schedule_date) = '$schedule_date'";
        $cek = $this->db->query($sql_cek);
        if($cek->num_rows() > 0){
            // sudah ada
            $result['stat'] = false;
            $result['pesan'] = 'Mohon maaf Anda sudah memasukan staff ini pada tanggal yang anda pilih';
        }else{
    		$data = array(
    			'staff_id' => $this->input->post('staff_id'),
                'schedule_date'      => $schedule_date,
                'schedule_starttime' => $schedule_starttime,
    			'schedule_enddatime' => $schedule_enddatime,
    			'schedule_createby' => $createby,
    			'schedule_createat' => $createat,
    		);
    		$result = $this->m_base->insert_data('t_schedule_staff', $data);
        }
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
    public function update($id)
	{
		$data['mode']            = 'edit';
		$data['judul']           = '<i class="fa fa-pencil"></i> Edit Time Schedule Staff';
		$data['data_scheduler'] = $this->m_base->get_data('t_schedule_staff', array('schedule_staff_id' => $id));
        $data['data_staff'] = $this->m_base->get_data('m_staff', array('staff_active'=>'y'), 'staff_id, staff_name');
		$this->load->view('v_modal_schedule_form', $data, FALSE);
	}
    public function update_action(){
        $updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'schedule_staff_id' => $this->input->post('id')
		);
        $schedule_starttime = date('H:i:s', strtotime($this->input->post('schedule_starttime')));
        $schedule_enddatime = date('H:i:s', strtotime($this->input->post('schedule_enddatime')));

        $schedule_date = date('Y-m-d', strtotime($this->input->post('schedule_date')));
        $staff_id = $this->input->post('staff_id');
        $schedule_staff_id = $this->input->post('id');


        $sql_cek = "
            SELECT
                *
            FROM
                t_schedule_staff
            WHERE
            staff_id = $staff_id
            AND schedule_staff_id not in('$schedule_staff_id')
            AND date(schedule_starttime) = '$schedule_date'";
        $cek = $this->db->query($sql_cek);
        if($cek->num_rows() > 0){
            // sudah ada
            $result['stat'] = false;
            $result['pesan'] = 'Mohon maaf Anda sudah memasukan staff ini pada tanggal yang anda pilih';
        }else{
            $data = array(
    			'staff_id' => $this->input->post('staff_id'),
                'schedule_starttime' => $schedule_starttime,
    			'schedule_enddatime' => $schedule_enddatime,
                'schedule_date'      => $schedule_date,
    			'schedule_updateby' => $updateby,
    			'schedule_updateat' => $updateat,
    		);
    		$result = $this->m_base->update_data('t_schedule_staff', $data,$filter);
        }
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    public function delete($id)
	{
		$filter = array('schedule_staff_id' => $id);
		$data = array('schedule_active' => 't');
		$result = $this->m_base->update_data('t_schedule_staff', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}
