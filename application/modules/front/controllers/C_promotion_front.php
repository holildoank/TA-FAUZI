<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_promotion_front extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
	}

	public function index()
    {
        $data = array();
        $sql = "
        SELECT
			*
		FROM
			t_promotion
		WHERE
			now() >= promotion_startat
		AND now() <= promotion_endat
		ORDER BY
			promotion_startat ASC
		LIMIT 3
        ";
       	$data['data_promotion'] = $this->db->query($sql);
         $this->load->view('v_promotion_front', $data, false);
        // echo modules::run('base/c_base/front_view', $data_view);
    }
	public function promo()
    {
        $data = array();
        $sql = "
        SELECT
			*
		FROM
			t_promotion
		WHERE
			now() >= promotion_startat
		AND now() <= promotion_endat
		ORDER BY
			promotion_startat ASC
		
        ";
       	$data['data_promotion'] = $this->db->query($sql);
         $data_view['content_layout']=$this->load->view('v_single_promo_front', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
    }
    public function detail($id)
    {
        $data['data_promotion'] = $this->m_base->get_data('t_promotion', array('promotion_id' => $id));
        $this->load->view('v_modal_promotion_front', $data, FALSE);
    }

}
