<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_testimonial extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('base/m_base');
        $this->load->model('m_testimonial');

        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true)
        {
            redirect(site_url());
        }
        // session menu
        $data_session = array(
            'menu_parent' => 'frontend',
            'menu_child' => 'testimonial',
            'page_title' => 'MustikaMusik | Testimonial',
        );
        modules::run('base/c_base/set_session_menu', $data_session);
    }
    public function index()
    {
        $data = array();

        $data_view['content_layout'] = $this->load->view('v_testimonial', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
    }

    public function ajax_list()
    {
        $records = $this->m_testimonial->ajax_list();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }

    public function create()
    {
        $data['mode'] = 'add';
        $data['judul'] = '<i class="fa fa-plus"></i> Add New Testimonial';
        $data_view['content_layout'] = $this->load->view('v_testimonial_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
    }

    public function create_action()
    {

        $createby = $this->session->userdata('user_id');
        $createat = date('Y-m-d H:i:s');
        if(!empty($_FILES['testimonial_photo']['name'])){
            $upload = $this->m_testimonial->upload_testimonial_photo();
            if($upload['stat']){
                $testimonial_photo = $upload['data']['file_name'];
                $data = array(
                    'testimonial_name'     => $this->input->post('testimonial_name'),
                    'testimonial_desc'     => $this->input->post('testimonial_desc'),
                    'testimonial_active'   => $this->input->post('testimonial_active'),
                    'testimonial_photo'     => $testimonial_photo,
                    'testimonial_createby' => $createby,
                    'testimonial_createat' => $createat,
                );
                $result = $this->m_base->insert_data('t_testimonial', $data);
            }else{
                $result = $upload;
                $result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
            }
        }else{
            $data = array(
                'testimonial_name'     => $this->input->post('testimonial_name'),
                'testimonial_desc'     => $this->input->post('testimonial_desc'),
                'testimonial_active'   => $this->input->post('testimonial_active'),
                'testimonial_createby' => $createby,
                'testimonial_createat' => $createat,
                );
            $result = $this->m_base->insert_data('t_testimonial', $data);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function update($id)
    {
        $data['mode']            = 'edit';
        $data['judul']           = '<i class="fa fa-pencil"></i> Edit Testimonial';
        $data['data_testimonial'] = $this->m_base->get_data('t_testimonial', array('testimonial_id' => $id));
        $data_view['content_layout'] = $this->load->view('v_testimonial_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
    }

    public function update_action()
    {
        $updateby = $this->session->userdata('user_id');
        $updateat = date('Y-m-d H:i:s');
        $filter = array(
            'testimonial_id' => $this->input->post('id')
        );
        if(!empty($_FILES['testimonial_photo']['name'])){
            $upload = $this->m_testimonial->upload_testimonial_photo();
            if($upload['stat']){
                $testimonial_photo = $upload['data']['file_name'];
                $last_photo = $this->m_base->get_data('t_testimonial', $filter, 'testimonial_photo')->row()->testimonial_photo;
                if(file_exists('./uploads/testimonial/'.$last_photo)){
                    unlink('./uploads/testimonial/'.$last_photo);
                }

                if(!empty($this->input->post('testimonial_photo'))){
                    $data = array(
                        'testimonial_name'     => $this->input->post('testimonial_name'),
                        'testimonial_desc'     => $this->input->post('testimonial_desc'),
                        'testimonial_active'   => $this->input->post('testimonial_active'),
                        'testimonial_photo'     => $testimonial_photo,
                        'testimonial_updateby' => $updateby,
                        'testimonial_updateat' => $updateat,
                    );
                }else{
                    $data = array(
                        'testimonial_name'     => $this->input->post('testimonial_name'),
                        'testimonial_desc'     => $this->input->post('testimonial_desc'),
                        'testimonial_active'   => $this->input->post('testimonial_active'),
                        'testimonial_photo'     => $testimonial_photo,
                        'testimonial_updateby' => $updateby,
                        'testimonial_updateat' => $updateat,
                    );
                }
                $result = $this->m_base->update_data('t_testimonial', $data, $filter);
            }else{
                $result = $upload;
                $result['pesan'] = '<button class="close" data-close="alert"></button> '.$upload['data'];
            }
        }else{
            $data = array(
                'testimonial_desc'     => $this->input->post('testimonial_desc'),
                'testimonial_active'   => $this->input->post('testimonial_active'),
                'testimonial_updateby' => $updateby,
                'testimonial_updateat' => $updateat,
            );

            $result = $this->m_base->update_data('t_testimonial', $data, $filter);
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function delete($id)
    {
        $filter = array('testimonial_id' => $id);
        $data = array('testimonial_active' => 't');
        $result = $this->m_base->update_data('t_testimonial', $data, $filter);

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

}

/* End of file C_leadsouce.php */
/* Location: ./application/modules/master/controllers/C_leadsouce.php */
