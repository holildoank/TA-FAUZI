<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_gallery_front extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
	}

	public function index()
    {
        $data = array();
		$this->db->from('t_gallery');
		$this->db->where('gallery_active','y');
	   	$this->db->limit(8);
		$data['data_gallery'] =$this->db->get();
        $this->load->view('v_gallery_front', $data, false);
        // echo modules::run('base/c_base/front_view', $data_view);
    }
	public function gallery()
    {
        $data = array();
       	$data['data_gallery'] = $this->m_base->get_data('t_gallery', array('gallery_active'=>'y'), 'gallery_id, gallery_file,gallery_desc');
        $data_view['content_layout']=$this->load->view('v_single_gallery_front', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
    }
    public function allgallery(){
    	$data = array();
       	$data['data_gallery'] = $this->m_base->get_data('t_gallery', array('gallery_active'=>'y'), 'gallery_id, gallery_file,gallery_desc');
		$data_view['content_layout'] = $this->load->view('v_all_gallery_front', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
    }

}
