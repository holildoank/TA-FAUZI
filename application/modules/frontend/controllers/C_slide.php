<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_slide extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('m_slide');
		$is_logged_in = $this->session->userdata(base_url().'is_logged_in');
    if(!isset($is_logged_in) || $is_logged_in != true)
    {
        redirect(site_url());
    }
		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'frontend';
		$this->menu_child   = 'slide';
		$this->menu_kode    = 'slide';
		//session menu
		$data_sess = array(
			base_url().'menu_parent' => $this->menu_parent,
			base_url().'menu_child'  => $this->menu_child,
			'page_title' => 'DigiReservation | slide',
		);
		modules::run('base/c_base/set_session_menu', $data_sess);
	}
	public function index()
	{
		$data = array();
		cek_hak_akses($this->usergroup_id, $this->menu_kode);
		$data['ar_haklistakses'] = get_listakses($this->usergroup_id, $this->menu_kode);
		$data_view['content_layout'] = $this->load->view('v_slide', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function ajax_list()
	{
		$records = $this->m_slide->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode'] = 'add';
        $data['judul'] = '<i class="fa fa-plus"></i> Add New Slide';
		$data_view['content_layout'] = $this->load->view('v_slide_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function create_action()
	{
        $slide_order = $this->input->post('slide_order');

        $cek = $this->m_base->get_data('t_slide', array('slide_order'=>$slide_order));

        if($cek->num_rows()>0){
            $result['stat'] = false;
            $result['pesan'] = 'No Urut Slide Sudah Ada. Silahkan ganti dengan yang lain.';
        }else{
            $createby = $this->session->userdata('user_id');
            $createat = date('Y-m-d H:i:s');
			if(!empty($_FILES['slide_file']['name'])){
				$upload = $this->m_slide->upload_slide_photo();
				if($upload['stat']){
					$slide_file = $upload['data']['file_name'];
					$data = array(
						'slide_order' => $this->input->post('slide_order'),
						'slide_active' => $this->input->post('slide_active'),
		                'slide_file' => $slide_file,
		                'slide_createby' => $createby,
		                'slide_createat' => $createat,
		            );
					$result = $this->m_base->insert_data('t_slide', $data);
				}else{
					$result = $upload;
					$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
				}
			}else{
				$data = array(
					'slide_order' => $this->input->post('slide_order'),
					'slide_active' => $this->input->post('slide_active'),
					'slide_createby' => $createby,
					'slide_createat' => $createat,
				);
				$result = $this->m_base->insert_data('t_slide', $data);
			}
        }
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['mode']            = 'edit';
		$data['judul']           = '<i class="fa fa-pencil"></i> Edit Slide';
		$data['data_slide'] = $this->m_base->get_data('t_slide', array('slide_id' => $id));
		$data_view['content_layout'] = $this->load->view('v_slide_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'slide_id' => $this->input->post('id')
		);
		if(!empty($_FILES['slide_file']['name'])){
			$upload = $this->m_slide->upload_slide_photo();
			if($upload['stat']){
				$slide_file = $upload['data']['file_name'];
				$last_photo = $this->m_base->get_data('t_slide', $filter, 'slide_file')->row()->slide_file;
				if(file_exists('./uploads/slide/'.$last_photo)){
					unlink('./uploads/slide/'.$last_photo);
				}

				if(!empty($this->input->post('slide_order'))){
					$data = array(
						'slide_order' => $this->input->post('slide_order'),
						'slide_active' => $this->input->post('slide_active'),
						'slide_file' => $slide_file,
						'slide_updateby' => $updateby,
						'slide_updateat' => $updateat,
					);
				}else{
					$data = array(
						'slide_order' => $this->input->post('slide_order'),
						'slide_active' => $this->input->post('slide_active'),
						'slide_file' => $slide_file,
						'slide_updateby' => $updateby,
						'slide_updateat' => $updateat,
					);
				}
				$result = $this->m_base->update_data('t_slide', $data, $filter);
			}else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}else{

				$data = array(
					'slide_order' => $this->input->post('slide_order'),
					'slide_active' => $this->input->post('slide_active'),
					'slide_updateby' => $updateby,
					'slide_updateat' => $updateat,
				);

			$result = $this->m_base->update_data('t_slide', $data, $filter);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$filter = array('slide_id' => $id);
		$data = array('slide_active' => 't');
		$result = $this->m_base->update_data('t_slide', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
