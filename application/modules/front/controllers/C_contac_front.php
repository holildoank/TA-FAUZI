<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_contac_front extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
	}
	public function index()
    {

    }
    public function contact()
    {
        $data = array();
        $data_view['content_layout']=$this->load->view('v_single_contact', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
    }

}
