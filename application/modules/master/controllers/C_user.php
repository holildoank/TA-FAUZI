<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('m_user');

		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
		$this->menu_parent  = 'setting-user';
		$this->menu_child   = 'user';
		$this->menu_kode    = 'user';
		//session menu
		$data_sess = array(

			base_url().'menu_parent' => $this->menu_parent,
			base_url().'menu_child'  => $this->menu_child,
		);
		modules::run('base/c_base/set_session_menu', $data_sess);
	}
	public function index()
	{
		$data = array();
		cek_hak_akses($this->usergroup_id, $this->menu_kode);
		$data['ar_haklistakses'] = get_listakses($this->usergroup_id, $this->menu_kode);
		$data_view['content_layout'] = $this->load->view('v_user', $data, true);
    echo modules::run('base/c_base/main_view', $data_view);
	}

	public function ajax_list()
	{
		$records = $this->m_user->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode'] = 'add';
    $data['judul'] = '<i class="fa fa-plus"></i> Add New User';
		$data['data_usergroup'] = $this->m_base->get_data('m_usergroup', array('usergroup_active'=>'y'), 'usergroup_id, usergroup_name');

		// $this->load->view('v_user_modal_form', $data);
		$data_view['content_layout'] = $this->load->view('v_user_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function create_action(){
        $user_username = $this->input->post('user_username');
        $cek = $this->m_base->get_data('m_user', array('user_username'=>$user_username));
        if($cek->num_rows()>0){
            $result['stat'] = false;
            $result['pesan'] = 'User Name tersebut sudah ada. Silahkan ganti dengan yang lain.';
        }else{
            $createby = $this->session->userdata('user_id');
            $createat = date('Y-m-d H:i:s');
			if(!empty($_FILES['user_photo']['name'])){
				$upload = $this->m_user->upload_user_photo();
				if($upload['stat']){
					$user_photo = $upload['data']['file_name'];
					$data = array(
										'user_username' => $this->input->post('user_username'),
		                'user_password' => md5($this->input->post('user_password')),
		                'usergroup_id' => $this->input->post('usergroup_id'),
										'user_photo' => $user_photo,
		                'user_createby' => $createby,
		                'user_createat' => $createat,
		            );
					$result = $this->m_base->insert_data('m_user', $data);
				}else{
					$result = $upload;
					$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
				}
			}else{
				$data = array(
					'user_username' => $this->input->post('user_username'),
					'user_password' => md5($this->input->post('user_password')),
					'usergroup_id' => $this->input->post('usergroup_id'),
					'user_createby' => $createby,
					'user_createat' => $createat,
				);
				$result = $this->m_base->insert_data('m_user', $data);
			}
        }
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['mode']            = 'edit';
		$data['judul']           = '<i class="fa fa-pencil"></i> Edit User';
		$data['data_usergroup'] = $this->m_base->get_data('m_usergroup', array('usergroup_active'=>'y'), 'usergroup_id, usergroup_name');
		$data['data_user'] = $this->m_base->get_data('m_user', array('user_id' => $id));

		// $this->load->view('v_user_modal_form', $data, FALSE);
		$data_view['content_layout'] = $this->load->view('v_user_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'user_id' => $this->input->post('id')
		);
		if(!empty($_FILES['user_photo']['name'])){
			$upload = $this->m_user->upload_user_photo();
			if($upload['stat']){
				$user_photo = $upload['data']['file_name'];
				$last_photo = $this->m_base->get_data('m_user', $filter, 'user_photo')->row()->user_photo;
				if(file_exists('./uploads/user/'.$last_photo)){
					unlink('./uploads/user/'.$last_photo);
				}

				if(!empty($this->input->post('user_password'))){
					$data = array(
						'user_username' => $this->input->post('user_username'),
						'user_password' => md5($this->input->post('user_password')),
						'usergroup_id' => $this->input->post('usergroup_id'),
						'user_photo' => $user_photo,
						'user_updateby' => $updateby,
						'user_updateat' => $updateat,
					);
				}else{
					$data = array(
						'user_username' => $this->input->post('user_username'),
						'usergroup_id' => $this->input->post('usergroup_id'),
						'user_photo' => $user_photo,
						'user_updateby' => $updateby,
						'user_updateat' => $updateat,
					);
				}
				$result = $this->m_base->update_data('m_user', $data, $filter);
			}else{
				$result = $upload;
				$result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
			}
		}else{
			if(!empty($this->input->post('user_password'))){
				$data = array(
					'user_username' => $this->input->post('user_username'),
					'user_password' => md5($this->input->post('user_password')),
					'usergroup_id' => $this->input->post('usergroup_id'),
					'user_updateby' => $updateby,
					'user_updateat' => $updateat,
				);
			}else{
				$data = array(
					'user_username' => $this->input->post('user_username'),
					'usergroup_id' => $this->input->post('usergroup_id'),
					'user_updateby' => $updateby,
					'user_updateat' => $updateat,
				);
			}
			$result = $this->m_base->update_data('m_user', $data, $filter);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$filter = array('user_id' => $id);
		$data = array('user_active' => 't');
		$result = $this->m_base->update_data('m_user', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
