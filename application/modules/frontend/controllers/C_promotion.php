<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_promotion extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('m_promotion');
		$is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true)
        {
            redirect(site_url());
        }
		// session menu
		$data_session = array(
			'menu_parent' => 'frontend',
			'menu_child' => 'promotion',
			'page_title' => 'MustikaMusik | Promotion',
		);
		modules::run('base/c_base/set_session_menu', $data_session);
	}
	public function index()
	{
		$data = array();

		$data_view['content_layout'] = $this->load->view('v_promotion', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function ajax_list()
	{
		$records = $this->m_promotion->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode'] = 'add';
        $data['judul'] = '<i class="fa fa-plus"></i> Add New Promotion';
		$data_view['content_layout'] = $this->load->view('v_promotion_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function create_action()
	{
		$promotion_startat = date('Y-m-d H:i:s', strtotime($this->input->post('promotion_startat')));
		$promotion_endat = date('Y-m-d H:i:s', strtotime($this->input->post('promotion_endat')));
		// var_dump($x);
       	$createby = $this->session->userdata('user_id');
       	$createat = date('Y-m-d H:i:s');
		if(!empty($_FILES['promotion_file']['name'])){
			$upload = $this->m_promotion->upload_promotion_photo();
			if($upload['stat']){
				$promotion_file = $upload['data']['file_name'];
				$data = array(
					'promotion_name'     => $this->input->post('promotion_name'),
					'promotion_desc'     => $this->input->post('promotion_desc'),
					'promotion_startat'  => $promotion_startat,/// date('Y-m-d', strtotime($this->req['tanggal'])),
					'promotion_endat'    => $promotion_endat,
					'promotion_active'   => $this->input->post('promotion_active'),
					'promotion_file'     => $promotion_file,
					'promotion_createby' => $createby,
					'promotion_createat' => $createat,
	            );
				$result = $this->m_base->insert_data('t_promotion', $data);
			}else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}else{
			$data = array(
				'promotion_name'     => $this->input->post('promotion_name'),
				'promotion_desc'     => $this->input->post('promotion_desc'),
				'promotion_startat'  => $promotion_startat,/// date('Y-m-d', strtotime($this->req['tanggal'])),
				'promotion_endat'    => $promotion_endat,
				'promotion_active'   => $this->input->post('promotion_active'),
				'promotion_createby' => $createby,
				'promotion_createat' => $createat,
				);
			$result = $this->m_base->insert_data('t_promotion', $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['mode']            = 'edit';
		$data['judul']           = '<i class="fa fa-pencil"></i> Edit Promotion';
		$data['data_promotion'] = $this->m_base->get_data('t_promotion', array('promotion_id' => $id));
		$data_view['content_layout'] = $this->load->view('v_promotion_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$promotion_startat = date('Y-m-d H:i:s', strtotime($this->input->post('promotion_startat')));
		$promotion_endat = date('Y-m-d H:i:s', strtotime($this->input->post('promotion_endat')));
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'promotion_id' => $this->input->post('id')
		);
		if(!empty($_FILES['promotion_file']['name'])){
			$upload = $this->m_promotion->upload_promotion_photo();
			if($upload['stat']){
				$promotion_file = $upload['data']['file_name'];
				$last_photo = $this->m_base->get_data('t_promotion', $filter, 'promotion_file')->row()->promotion_file;
				if(file_exists('./uploads/promotion/'.$last_photo)){
					unlink('./uploads/promotion/'.$last_photo);
				}

				if(!empty($this->input->post('promotion_file'))){
					$data = array(
						'promotion_name'     => $this->input->post('promotion_name'),
						'promotion_desc'     => $this->input->post('promotion_desc'),
						'promotion_startat'  => $promotion_startat,/// date('Y-m-d', strtotime($this->req['tanggal'])),
						'promotion_endat'    => $promotion_endat,
						'promotion_active'   => $this->input->post('promotion_active'),
						'promotion_file'     => $promotion_file,
						'promotion_updateby' => $updateby,
						'promotion_updateat' => $updateat,
					);
				}else{
					$data = array(

						'promotion_name'     => $this->input->post('promotion_name'),
						'promotion_desc'     => $this->input->post('promotion_desc'),
						'promotion_startat'  => $promotion_startat,/// date('Y-m-d', strtotime($this->req['tanggal'])),
						'promotion_endat'    => $promotion_endat,
						'promotion_active'   => $this->input->post('promotion_active'),
						'promotion_file'     => $promotion_file,
						'promotion_updateby' => $updateby,
						'promotion_updateat' => $updateat,
					);
				}
				$result = $this->m_base->update_data('t_promotion', $data, $filter);
			}else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}else{
			$data = array(
				'promotion_name'     => $this->input->post('promotion_name'),
				'promotion_desc'     => $this->input->post('promotion_desc'),
				'promotion_active'   => $this->input->post('promotion_active'),
				'promotion_startat'  => $promotion_startat,/// date('Y-m-d', strtotime($this->req['tanggal'])),
				'promotion_endat'    => $promotion_endat,
				'promotion_updateby' => $updateby,
				'promotion_updateat' => $updateat,
			);

			$result = $this->m_base->update_data('t_promotion', $data, $filter);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array('promotion_id' => $id);
		$data = array('promotion_active' => 't',
				'promotion_updateby' => $updateby,
				'promotion_updateat' => $updateat);
		$result = $this->m_base->update_data('t_promotion', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
