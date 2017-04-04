<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_gallery extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('m_gallery');
		$is_logged_in = $this->session->userdata(base_url().'is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
				redirect(site_url());
		}
		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'frontend';
		$this->menu_child   = 'gallery';
		$this->menu_kode    = 'gallery';
		//session menu
		$data_sess = array(
			base_url().'menu_parent' => $this->menu_parent,
			base_url().'menu_child'  => $this->menu_child,
			'page_title' => 'DigiReservation | Gallery',
		);
		modules::run('base/c_base/set_session_menu', $data_sess);
	}

	public function index()
	{
		$data = array();

		$data_view['content_layout'] = $this->load->view('v_gallery', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function ajax_list()
	{
		$records = $this->m_gallery->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode'] = 'add';
        $data['judul'] = '<i class="fa fa-plus"></i> Add New Gallery';
		// $data['data_usergroup'] = $this->m_base->get_data('m_usergroup', array('usergroup_active'=>'y'), 'usergroup_id, usergroup_name');

		// $this->load->view('v_user_modal_form', $data);
		$data_view['content_layout'] = $this->load->view('v_gallery_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function create_action()
	{
       $createby = $this->session->userdata('user_id');
       $createat = date('Y-m-d H:i:s');
		if(!empty($_FILES['gallery_file']['name'])){
			$upload = $this->m_gallery->upload_gallery_photo();
			if($upload['stat']){
				$gallery_file = $upload['data']['file_name'];
				$data = array(
					'gallery_desc' => $this->input->post('gallery_desc'),
	                'gallery_file' => $gallery_file,
	                'gallery_createby' => $createby,
	                'gallery_createat' => $createat,
	            );
				$result = $this->m_base->insert_data('t_gallery', $data);
			}else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}else{
			$data = array(
				'gallery_desc' => $this->input->post('gallery_desc'),
				'gallery_createby' => $createby,
				'gallery_createat' => $createat,
			);
			$result = $this->m_base->insert_data('t_gallery', $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['mode']            = 'edit';
		$data['judul']           = '<i class="fa fa-pencil"></i> Edit galery';
		$data['data_gallery'] = $this->m_base->get_data('t_gallery', array('gallery_id' => $id));
		$data_view['content_layout'] = $this->load->view('v_gallery_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'gallery_id' => $this->input->post('id')
		);
		if(!empty($_FILES['gallery_file']['name'])){
			$upload = $this->m_gallery->upload_gallery_photo();
			if($upload['stat']){
				$gallery_file = $upload['data']['file_name'];
				$last_photo = $this->m_base->get_data('t_gallery', $filter, 'gallery_file')->row()->gallery_file;
				if(file_exists('./uploads/gallery/'.$last_photo)){
					unlink('./uploads/gallery/'.$last_photo);
				}

				if(!empty($this->input->post('gallery_desc'))){
					$data = array(
						'gallery_desc'     => $this->input->post('gallery_desc'),
						'gallery_active'   => $this->input->post('gallery_active'),
						'gallery_file'     => $gallery_file,
						'gallery_updateby' => $updateby,
						'gallery_updateat' => $updateat,
					);
				}else{
					$data = array(
						'gallery_desc'     => $this->input->post('gallery_desc'),
						'gallery_active'   => $this->input->post('gallery_active'),
						'gallery_file'     => $gallery_file,
						'gallery_updateby' => $updateby,
						'gallery_updateat' => $updateat,
					);
				}
				$result = $this->m_base->update_data('t_gallery', $data, $filter);
			}else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}else{
			$data = array(
				'gallery_desc'     => $this->input->post('gallery_desc'),
				'gallery_active'   => $this->input->post('gallery_active'),
				'gallery_updateby' => $updateby,
				'gallery_updateat' => $updateat,
			);

			$result = $this->m_base->update_data('t_gallery', $data, $filter);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');

		$filter = array('gallery_id' => $id);
		$data = array('gallery_active' => 't',
				'gallery_updateby' =>$updateby,
				'gallery_updateat' => $updateat);
		$result = $this->m_base->update_data('t_gallery', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
