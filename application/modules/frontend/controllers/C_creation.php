<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_creation extends MX_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->model('base/m_base');
	$this->load->model('m_creation');
	$is_logged_in = $this->session->userdata(base_url().'is_logged_in');
	if(!isset($is_logged_in) || $is_logged_in != true)
	{
			redirect(site_url());
	}
	$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
	$this->menu_parent  = 'frontend';
	$this->menu_child   = 'creation';
	$this->menu_kode    = 'creation';
	//session menu
	$data_sess = array(
		base_url().'menu_parent' => $this->menu_parent,
		base_url().'menu_child'  => $this->menu_child,
		'page_title' => 'DigiReservation | Creation',
	);
	modules::run('base/c_base/set_session_menu', $data_sess);
}
	public function index()
	{
		$data = array();
		$data_view['content_layout'] = $this->load->view('v_creation', $data, true);
    echo modules::run('base/c_base/main_view', $data_view);
	}

	public function ajax_list()
	{
		$records = $this->m_creation->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode'] = 'add';
        $data['judul'] = '<i class="fa fa-plus"></i> Add New Creation';
		$data['m_service'] = $this->m_base->get_data('m_service', array('service_active'=>'y','service_jenis'=>'OUR CREATIONS'), 'service_id, service_name');
		$data_view['content_layout'] = $this->load->view('v_creation_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function create_action()
	{
       $createby = $this->session->userdata('user_id');
       $createat = date('Y-m-d H:i:s');
		if(!empty($_FILES['creation_file']['name'])){
			$upload = $this->m_creation->upload_creation_photo();
			if($upload['stat']){
				$creation_file = $upload['data']['file_name'];
				$data = array(
					'creation_desc' => $this->input->post('creation_desc'),
					'service_id' => $this->input->post('service_id'),
					'creation_active' => $this->input->post('creation_active'),
	                'creation_file' => $creation_file,
	                'creation_createby' => $createby,
	                'creation_createat' => $createat,
	            );
				$result = $this->m_base->insert_data('t_creation', $data);
			}else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}else{
			$data = array(
				'creation_desc' => $this->input->post('creation_desc'),
				'service_id' => $this->input->post('service_id'),
				'creation_active' => $this->input->post('creation_active'),
				'creation_createby' => $createby,
				'creation_createat' => $createat,
			);
			$result = $this->m_base->insert_data('t_creation', $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['mode']                = 'edit';
		$data['judul']               = '<i class="fa fa-pencil"></i> Edit Creation';
		$data['data_creation']       = $this->m_base->get_data('t_creation', array('creation_id' => $id));
		$data['m_service']           = $this->m_base->get_data('m_service', array('service_active'=>'y','service_jenis'=>'OUR CREATIONS'), 'service_id, service_name');
		$data_view['content_layout'] = $this->load->view('v_creation_form', $data, true);
		echo modules::run('base/c_base/main_view', $data_view);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'creation_id' => $this->input->post('id')
		);
		if(!empty($_FILES['creation_file']['name'])){
			$upload = $this->m_creation->upload_creation_photo();
			if($upload['stat']){
				$creation_file = $upload['data']['file_name'];
				$last_photo = $this->m_base->get_data('t_creation', $filter, 'creation_file')->row()->creation_file;
				if(file_exists('./uploads/creation/'.$last_photo)){
					unlink('./uploads/creation/'.$last_photo);
				}

				if(!empty($this->input->post('creation_desc'))){
					$data = array(
					'creation_desc'     => $this->input->post('creation_desc'),
					'service_id'        => $this->input->post('service_id'),
					'creation_active'   => $this->input->post('creation_active'),
					'creation_file'     => $creation_file,
					'creation_updateby' => $updateby,
					'creation_updateat' => $updateat,
					);
				}else{
					$data = array(
					'creation_desc'     => $this->input->post('creation_desc'),
					'service_id'        => $this->input->post('service_id'),
					'creation_active'   => $this->input->post('creation_active'),
					// 'creation_file'     => $creation_file,
					'creation_updateby' => $updateby,
					'creation_updateat' => $updateat,
					);
				}
				$result = $this->m_base->update_data('t_creation', $data, $filter);
			}else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}else{
			$data = array(
				'creation_desc'     => $this->input->post('creation_desc'),
				'service_id'        => $this->input->post('service_id'),
				'creation_active'   => $this->input->post('creation_active'),
				// 'creation_file'     => $creation_file,
				'creation_updateby' => $updateby,
				'creation_updateat' => $updateat,
			);

			$result = $this->m_base->update_data('t_creation', $data, $filter);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');

		$filter = array('creation_id' => $id);
		$data = array('creation_active' => 't',
				'creation_updateby' =>$updateby,
				'creation_updateat' => $updateat);
		$result = $this->m_base->update_data('t_creation', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
