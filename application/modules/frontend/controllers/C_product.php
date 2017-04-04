<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_product extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		$this->load->model('m_product');
		$is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true)
        {
            redirect(site_url());
        }
		// session menu
		$data_session = array(
			'menu_parent' => 'frontend',
			'menu_child' => 'product',
			'page_title' => 'Glam | Product',
		);
		modules::run('base/c_base/set_session_menu', $data_session);
	}
	public function index()
	{
		$data = array();
		$data['m_service'] = $this->m_base->get_data('m_service', array('service_active'=>'y'), 'service_id, service_name');
		$data['m_staff'] = $this->m_base->get_data('m_staff', array('staff_active'=>'y'), 'staff_id, staff_name');

		$data_view['content_layout'] = $this->load->view('v_product', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function ajax_list()
	{
		$records = $this->m_product->ajax_list();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function create()
	{
		$data['mode'] = 'add';
        $data['judul'] = '<i class="fa fa-plus"></i> Add New Product';
		$data['m_service'] = $this->m_base->get_data('m_service', array('service_active'=>'y','service_jenis'=>'OUR SERVICES'), 'service_id, service_name');
		$data['m_staff'] = $this->m_base->get_data('m_staff', array('staff_active'=>'y'), 'staff_id, staff_name');

		$data_view['content_layout'] = $this->load->view('v_product_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}
	public function get_harga(){
		$data['service_id'] = $this->input->post('service_id');
		$data['harga_men'] = $this->input->post('harga_men');
		$data['harga_women'] = $this->input->post('harga_women');
		$this->load->view('v_harga', $data, FALSE);
	}

	public function create_action()
	{
       	$createby = $this->session->userdata('user_id');
       	$createat = date('Y-m-d H:i:s');
			$data = array(
					'product_name'       => $this->input->post('product_name'),
					'product_desc'       => $this->input->post('product_desc'),
					'product_duration'	 => $this->input->post('product_duration'),
					'service_id'         => $this->input->post('service_id'),
					'staff_id'           => $this->input->post('staff_id'),
					'product_price_men'	=> $this->input->post('product_price_men'),
					'product_price'      => $this->input->post('product_price'),
					'product_active'     => $this->input->post('product_active'),
					'product_createby' => $createby,
					'product_createat' => $createat,
				);
			$result = $this->m_base->insert_data('t_product', $data);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update($id)
	{
		$data['mode']            = 'edit';
		$data['judul']           = '<i class="fa fa-pencil"></i> Edit Product';
		$data['data_product'] = $this->m_base->get_data('t_product', array('product_id' => $id));
		$data['m_service'] = $this->m_base->get_data('m_service', array('service_active'=>'y','service_jenis'=>'OUR SERVICES'), 'service_id, service_name');
		$data['m_staff'] = $this->m_base->get_data('m_staff', array('staff_active'=>'y'), 'staff_id, staff_name');

		$data_view['content_layout'] = $this->load->view('v_product_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
	}

	public function update_action()
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array(
			'product_id' => $this->input->post('id')
		);
		$data = array(
			'product_name'     => $this->input->post('product_name'),
			'product_desc'     => $this->input->post('product_desc'),
			'service_id'       => $this->input->post('service_id'),
			'product_duration' => $this->input->post('product_duration'),
			'staff_id'         => $this->input->post('staff_id'),
			'product_price_men'	=> $this->input->post('product_price_men'),
			'product_price'    => $this->input->post('product_price'),
			'product_active'   => $this->input->post('product_active'),
			'product_updateby' => $updateby,
			'product_updateat' => $updateat,
		);

		$result = $this->m_base->update_data('t_product', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function delete($id)
	{
		$updateby = $this->session->userdata('user_id');
		$updateat = date('Y-m-d H:i:s');
		$filter = array('product_id' => $id);
		$data = array('product_active' => 't',
					'product_updateby' => $updateby,
					'product_updateat' => $updateat);
		$result = $this->m_base->update_data('t_product', $data, $filter);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
