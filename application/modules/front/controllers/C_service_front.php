<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_service_front extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
	}

	public function index(){
        $data = array();
       	$data['data_service'] = $this->m_base->get_data('m_service', array('service_active'=>'y'), 'service_id, service_name,service_desc');
        $data_view['content_layout'] = $this->load->view('v_service_front', $data, true);
        echo modules::run('base/c_base/front_view', $data_view);
    }
	public function scror_service(){
        $data = array();
				$data['jasa'] = $this->m_base->get_data('m_service', array('service_active'=>'y'), 'service_id, service_name,service_desc,service_harga,hitungan_jam');
        $this->load->view('v_service_front', $data, false);
    }
	public function service()
    {
        $data = array();
        $data_view['content_layout']=$this->load->view('v_single_service_front', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
    }
    public function detail($id){
    	$data = array();

    	$this->db->select('t_product.*,m_service.service_name,m_staff.staff_photo,m_staff.staff_name');
   		$this->db->from('t_product');
   		$this->db->join('m_service', 't_product.service_id = m_service.service_id');
   		$this->db->join('m_staff', 't_product.staff_id = m_staff.staff_id');
		$this->db->where('t_product.service_id', $id);
   		$this->db->where('product_active', 'y');
       	$data['data_product'] =$this->db->get();

       	$data['data_service']=$this->m_base->get_data('m_service', array('service_id' => $id));

		$data_view['content_layout'] = $this->load->view('v_product_of_service_front', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
    }

}
