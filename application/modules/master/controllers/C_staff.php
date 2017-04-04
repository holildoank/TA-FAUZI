<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_staff extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		modules::run('base/c_login/is_logged_in');
		$this->load->model('base/m_base');
		$this->load->model('m_staff');

		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'master';
		$this->menu_child   = 'staff';
		$this->menu_kode    = 'staff';
		//session menu
		$data_sess = array(
			base_url().'menu_parent' => $this->menu_parent,
			base_url().'menu_child'  => $this->menu_child,
			'page_title' => 'DigiReservation | Staff',
		);
		modules::run('base/c_base/set_session_menu', $data_sess);
	}
	public function index()
	{
		$data = array();

		$data_view['content_layout'] = $this->load->view('v_staff', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function ajax_list()
	{
		$records = $this->m_staff->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode'] = 'add';
        $data['judul'] = '<i class="fa fa-plus"></i> Add New Staff';
		$data_view['content_layout'] = $this->load->view('v_staff_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);


	}

	public function create_action()
	{

       	$createby = $this->session->userdata('user_id');
       	$createat = date('Y-m-d H:i:s');

		if(!empty($_FILES['staff_photo']['name'])){
			$upload = $this->m_staff->upload_staff_photo();
			if($upload['stat']){
				$staff_photo = $upload['data']['file_name'];
				$data = array(
					'staff_name'     => $this->input->post('staff_name'),
					'staff_gender'   => $this->input->post('staff_gender'),
					'staff_address'  => $this->input->post('staff_address'),
					'staff_tlp'      => $this->input->post('staff_tlp'),
					'staff_position' => $this->input->post('staff_position'),
					'staff_active'   => $this->input->post('staff_active'),
					'staff_photo'    => $staff_photo,
					'staff_createby' => $createby,
					'staff_createat' => $createat,
	            );
				$result = $this->m_base->insert_data('m_staff', $data);
			}else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}else{
			$data = array(
				'staff_name'     => $this->input->post('staff_name'),
				'staff_gender'   => $this->input->post('staff_gender'),
				'staff_address'  => $this->input->post('staff_address'),/// date('Y-m-d', strtotime($this->req['tanggal'])),
				'staff_tlp'      => $this->input->post('staff_tlp'),
				'staff_position' => $this->input->post('staff_position'),
				'staff_active'   => $this->input->post('staff_active'),
				'staff_createby' => $createby,
				'staff_createat' => $createat,
				);
			$result = $this->m_base->insert_data('m_staff', $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['mode']            = 'edit';
		$data['judul']           = '<i class="fa fa-pencil"></i> Edit Staff';
		$data['data_staff'] = $this->m_base->get_data('m_staff', array('staff_id' => $id));
		$data_view['content_layout'] = $this->load->view('v_staff_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'staff_id' => $this->input->post('id')
		);
		if(!empty($_FILES['staff_photo']['name'])){
			$upload = $this->m_staff->upload_staff_photo();
			if($upload['stat']){
				$staff_photo = $upload['data']['file_name'];
				$last_photo = $this->m_base->get_data('m_staff', $filter, 'staff_photo')->row()->staff_photo;
				if(file_exists('./uploads/promotion/'.$last_photo)){
					unlink('./uploads/promotion/'.$last_photo);
				}

				if(!empty($this->input->post('staff_photo'))){
					$data = array(
						'staff_name'     => $this->input->post('staff_name'),
						'staff_gender'   => $this->input->post('staff_gender'),
						'staff_address'  => $this->input->post('staff_address'),/// date('Y-m-d', strtotime($this->req['tanggal'])),
						'staff_tlp'      => $this->input->post('staff_tlp'),
						'staff_position' => $this->input->post('staff_position'),
						'staff_active'   => $this->input->post('staff_active'),
						'staff_photo'     => $staff_photo,
						'staff_updateby' => $updateby,
						'staff_updateat' => $updateat,
					);
				}else{
					$data = array(
						'staff_name'         => $this->input->post('staff_name'),
						'staff_gender'       => $this->input->post('staff_gender'),
						'staff_address'      => $this->input->post('staff_address'),/// date('Y-m-d', strtotime($this->req['tanggal'])),
						'staff_tlp'          => $this->input->post('staff_tlp'),
						'staff_active'   => $this->input->post('staff_active'),
						'staff_photo'        => $staff_photo,
						'staff_updateby' => $updateby,
						'staff_updateat' => $updateat,
					);
				}
				$result = $this->m_base->update_data('m_staff', $data, $filter);
			}else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}else{
			$data = array(
				'staff_name'     => $this->input->post('staff_name'),
				'staff_gender'   => $this->input->post('staff_gender'),
				'staff_address'  => $this->input->post('staff_address'),/// date('Y-m-d', strtotime($this->req['tanggal'])),
				'staff_tlp'      => $this->input->post('staff_tlp'),
				'staff_position' => $this->input->post('staff_position'),
				'staff_active'   => $this->input->post('staff_active'),
				'staff_updateby' => $updateby,
				'staff_updateat' => $updateat,
			);

			$result = $this->m_base->update_data('m_staff', $data, $filter);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array('staff_id' => $id);
		$data = array('staff_active' => 't',
				'staff_updateby' => $updateby,
				'staff_updateat' => $updateat);
		$result = $this->m_base->update_data('m_staff', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
