<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_testimonial_front extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
	}

	public function index()
    {
        $data = array();
       	$data['data_testimonial'] = $this->m_base->get_data('t_testimonial', array('testimonial_active'=>'y'), 'testimonial_id, testimonial_name,testimonial_desc,testimonial_photo');
       $this->load->view('v_testimonial_front', $data, false);
        // echo modules::run('base/c_base/front_view', $data_view);
    }
	public function testimonial()
    {
        $data = array();
       	$data['data_testimonial'] = $this->m_base->get_data('t_testimonial', array('testimonial_active'=>'y'), 'testimonial_id, testimonial_name,testimonial_desc,testimonial_photo');
       	$data_view['content_layout']=$this->load->view('v_testimonial', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
    }
	public function detail($id){

	$data['data_testimonial']=$this->m_base->get_data('t_testimonial', array('testimonial_id'=>$id));
	$this->load->view('v_modal_testimonial',$data,FALSE);
	}
}
