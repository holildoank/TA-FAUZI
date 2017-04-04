<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_usergroup extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('m_usergroup');

		// session menu
		$data_session = array(
			'menu_parent' => 'master',
			'menu_child' => 'usergroup',
		);
		modules::run('base/c_base/set_session_menu', $data_session);
	}
	public function index()
	{
		$data = array();

		$data_view['content_layout'] = $this->load->view('v_usergroup', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function ajax_list()
	{
		$records = $this->m_usergroup->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode'] = 'add';
		$data['judul'] = '<i class="fa fa-plus"></i> Add New User Group';

		$this->load->view('v_usergroup_modal_form', $data);
	}

	public function create_action()
	{
		$createby = $this->session->userdata('user_id');
		$createat = date('Y-m-d H:i:s');
		$data = array(
			'usergroup_name' => $this->input->post('usergroup_name'),
			'usergroup_desc' => $this->input->post('usergroup_desc'),
			'usergroup_createby' => $createby,
			'usergroup_createat' => $createat,
		);
		$result = $this->m_base->insert_data('m_usergroup', $data);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['mode']            = 'edit';
		$data['judul']           = '<i class="fa fa-pencil"></i> Edit User Group';
		$data['data_usergroup'] = $this->m_base->get_data('m_usergroup', array('usergroup_id' => $id));

		$this->load->view('v_usergroup_modal_form', $data, FALSE);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'usergroup_id' => $this->input->post('id')
		);
		$data = array(
			'usergroup_name' => $this->input->post('usergroup_name'),
			'usergroup_desc' => $this->input->post('usergroup_desc'),
			'usergroup_updateby' => $updateby,
			'usergroup_updateat' => $updateat,
		);
		$result = $this->m_base->update_data('m_usergroup', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$filter = array('usergroup_id' => $id);
		$data = array('usergroup_active' => 't');
		$result = $this->m_base->update_data('m_usergroup', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
