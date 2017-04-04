<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_front extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
	}
	public function index()
    {
        $data = array();

			$data['data_slide']   = $this->m_base->get_data('t_slide', array('slide_active'=>'y'), 'slide_id, slide_file', array('nama_kolom'=>'slide_order', 'order'=>'asc'));
			$data_view['content_layout'] = $this->load->view('v_front', $data, true);
			echo modules::run('base/c_base/front_view', $data_view);
    }

}
