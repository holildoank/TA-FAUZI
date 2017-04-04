<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_service extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        modules::run('base/c_login/is_logged_in');
        $this->load->model('base/m_base');
        $this->load->model('m_service');

    		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
    		$this->menu_parent  = 'master';
    		$this->menu_child   = 'service';
    		$this->menu_kode    = 'service';
    		//session menu
    		$data_sess = array(
    			base_url().'menu_parent' => $this->menu_parent,
    			base_url().'menu_child'  => $this->menu_child,
          'page_title' => 'DigiReservation | service',
    		);
    		modules::run('base/c_base/set_session_menu', $data_sess);
    	}
    public function index()
    {
      cek_hak_akses($this->usergroup_id, $this->menu_kode);
      $data['ar_haklistakses'] = get_listakses($this->usergroup_id, $this->menu_kode);
        $data = array();
        $data_view['content_layout'] = $this->load->view('v_service', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
    }

    public function ajax_list()
    {
        $records = $this->m_service->ajax_list();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }

    public function create()
    {
        $data['mode'] = 'add';
        $data['judul'] = '<i class="fa fa-plus"></i> Add New Service';
        $this->load->view('v_service_modal_form', $data, FALSE);
    }

    public function create_action()
    {
       $createby = $this->session->userdata('user_id');
       $createat = date('Y-m-d H:i:s');
            $data = array(
                'service_name' => $this->input->post('service_name'),
                'service_desc' => $this->input->post('service_desc'),
                'service_active' => $this->input->post('service_active'),
                'service_jenis' => $this->input->post('service_jenis'),
                'service_createby' => $createby,
                'service_createat' => $createat,
            );
        $result = $this->m_base->insert_data('m_service', $data);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function update($id)
    {

        $data['mode']            = 'edit';
        $data['judul']           = '<i class="fa fa-pencil"></i> Edit Service';
        $data['data_service'] = $this->m_base->get_data('m_service', array('service_id' => $id));
        $this->load->view('v_service_modal_form', $data, FALSE);
    }

    public function update_action()
    {
            $updateby          = $this->session->userdata('user_id');
            $updateat          = date('Y-m-d H:i:s');
            $filter            = array(
            'service_id'       => $this->input->post('id')
            );

            $data              = array(
            'service_name'     => $this->input->post('service_name'),
            'service_desc'     => $this->input->post('service_desc'),
            'service_active'   => $this->input->post('service_active'),
            'service_harga'   => $this->input->post('service_harga'),
            'hitungan_jam'   => $this->input->post('hitungan_jam'),
            'sevice_updateby' => $updateby,
            'service_updateat' => $updateat,
            );

            $result            = $this->m_base->update_data('m_service', $data, $filter);
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function delete($id)
    {
        $updateby = $this->session->userdata('user_id');
        $updateat = date('Y-m-d H:i:s');

        $filter = array('service_id' => $id);
        $data = array('service_active' => 't',
               'sevice_updateby' => $updateby,
            'service_updateat' => $updateat);
        $result = $this->m_base->update_data('m_service', $data, $filter);

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
