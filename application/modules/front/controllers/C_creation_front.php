<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_creation_front extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
	}

    public function detail($id){
    	$data = array();
    	$this->db->select('t_creation.*,m_service.service_name,creation_file');
   		$this->db->from('t_creation');
   		$this->db->join('m_service', 't_creation.service_id = m_service.service_id');
		$this->db->where('t_creation.service_id', $id);
   		$this->db->where('t_creation.creation_active', 'y');

       	$data['data_creation'] =$this->db->get();
       	$data['data_service']=$this->m_base->get_data('m_service', array('service_id' => $id));
		$data_view['content_layout'] = $this->load->view('v_our_creation', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
    }

}
