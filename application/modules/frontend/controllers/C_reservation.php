<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reservation extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('base/m_base');
        $this->load->model('m_reservation');
        $is_logged_in = $this->session->userdata(base_url().'is_logged_in');
    		if(!isset($is_logged_in) || $is_logged_in != true)
    		{
    				redirect(site_url());
    		}
    		$this->usergroup_id = $this->session->userdata(base_url().'usergroup_id');
        // session menu
        $data_session = array(
            'menu_parent' => 'frontend',
            'menu_child' => 'reservation',
            'page_title' => 'Mustika | Reservation',
        );
        modules::run('base/c_base/set_session_menu', $data_session);
    }
    public function index()
    {
        $data = array();
        $data['m_product'] = $this->m_base->get_data('m_service', array('service_active'=>'y'), 'service_name, service_id');
        $data_view['content_layout'] = $this->load->view('v_reservation', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
    }

    public function ajax_list()
    {
        $records = $this->m_reservation->ajax_list();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }
    public function ajax_list_front()
    {
        $records = $this->m_reservation->ajax_list_front();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
    }

    public function create()
    {
        $data['mode'] = 'add';
        $data['judul'] = '<i class="fa fa-plus"></i> Add New Reservation';
        $data['data_service'] = $this->m_base->get_data('m_service', array('service_active'=>'y'), 'service_id, service_name');
        $data_view['content_layout'] = $this->load->view('v_reservation_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
    }

    public function get_schedule()
    {
        // $reservation_tgl = date('Y-m-d', strtotime($this->input->post('reservation_tgl')));
        $reservation_id = $this->input->post('reservation_id');
        $service_id = $this->input->post('service_id');
        $customer = $this->input->post('customer_id_update');
        if($customer !==Null || $customer !==''){
          $customer_id = $this->input->post('customer_id_update');
        }else {
          $customer_id=0;
        }
        $reservation_tgl = date('Y-m-d', strtotime($this->input->post('reservation_tgl_mulai')));
        $jamMulai =  date('H:i:s', strtotime($this->input->post('jammulai')));;
        $mulai_tgl =$reservation_tgl.' '.$jamMulai;
        $sampai_reservation_tgl = date('Y-m-d', strtotime($this->input->post('reservation_tgl_selesai')));
        $jamSelesai = date('H:i:s', strtotime($this->input->post('jamselesai')));
        $sampai_tgl =$sampai_reservation_tgl.' '.$jamSelesai ;

        $sql_cek = "
                  select
                      *
                  from v_reservation
                  where
                  service_id =$service_id
                  AND customer_id not in ('$customer_id')
                  AND reservation_startdatetime BETWEEN '$mulai_tgl' AND '$sampai_tgl'
                  OR reservation_enddatetime BETWEEN '$mulai_tgl' AND '$sampai_tgl'
                    ";
        $cek = $this->db->query($sql_cek);
        if($cek->num_rows() > 0){
            $result['stat'] = false;
            $result['pesan'] = 'Maaf, Jadwal Yang Anda Pilih Kosong / Sudah di Booking orang.';
        }else{
            $result['stat'] = true;
            $result['reservation_tgl_mulai'] = $reservation_tgl;
            $result['sampai_reservation_tgl'] = $sampai_reservation_tgl;
            $result['service_id'] = $service_id;
            $result['jamMulai'] = $jamMulai;
            $result['jamSelesai'] = $jamSelesai;
            $result['ar_reservation_id'] = $reservation_id;
            }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    // public function get_time_staff(){
    //     $product_id = $this->input->post('product_id');
    //     $staff_id = $this->input->post('staff_id');
    //     $reservation_id_update = $this->input->post('reservation_id_update');
    //
    //     $reservation_tgl = date('Y-m-d', strtotime($this->input->post('reservation_tgl')));
    //     $jam = date('H:i', strtotime($this->input->post('jam_terpilih')));
    //     $sql_staff = "
    //     select
    //         staff_id,
    //         product_name,
    //         product_duration
    //     from v_product_jadwal_staff
    //     where
    //         product_id=$product_id
    //         AND staff_id=$staff_id
    //         AND staff_active  in ('y')
    //         AND DATE(schedule_date) = '$reservation_tgl'
    //         AND (('$jam' BETWEEN TIME(schedule_starttime) and TIME(schedule_enddatime)) or ('$jam' BETWEEN TIME(schedule_starttime) and TIME(schedule_starttime)))";
    //
    //     $cek = $this->db->query($sql_staff);
    //     $cek_id = $this->db->query($sql_staff)->row();
    //
    //     if($cek->num_rows() < 1){
    //         // jika jadwal tidak ada
    //         $result['stat'] = false;
    //         $result['pesan'] = 'Mohon Jadwal product yang anda pilih tidak ada jadwal pada tanggal dan jam yang anda pilih.';
    //     }else{
    //         $product_duration = $cek_id->product_duration;
    //         $jam_durasi = date('H:i', strtotime("$jam + ".$product_duration." minutes")); //15:47 + durasi
    //         if($reservation_id_update !=0){
    //             $sql_cek = "
    //                 SELECT
    //                     *
    //                 FROM
    //                     v_reservation
    //                 WHERE
    //                 staff_id = $staff_id
    //                 AND reservation_id not in($reservation_id_update)
    //                 AND status_payment_id not in (3,5)
    //                 AND DATE(reservation_startdatetime) = '$reservation_tgl'
    //                 AND (('$jam' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_enddatetime)) or ('$jam_durasi' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_startdatetime)))";
    //         }else{
    //             $sql_cek = "
    //             SELECT
    //             *
    //             FROM
    //             v_reservation
    //             WHERE
    //             staff_id = $staff_id
    //             AND status_payment_id not in (3,5)
    //             AND DATE(reservation_startdatetime) = '$reservation_tgl'
    //             AND (('$jam' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_enddatetime)) or ('$jam_durasi' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_startdatetime)))";
    //         }
    //
    //             $cek = $this->db->query($sql_cek);
    //             // var_dump($this->db->last_query());
    //             if($cek->num_rows() > 0){
    //                 // sudah ada
    //                 $result['stat'] = false;
    //                 $result['pesan'] = 'Mohon Maaf Staff Yang Anda Pilih sedang Melayani Customer Lain pada jam yang sama , Silahkan Pilih Jadwal yang lain.';
    //             }else {
    //                 $result['stat'] = true;
    //                 $result['ar_reservation_id'] = $reservation_id_update;
    //                 $result['ar_jam'] = $jam;
    //             }
    //     }
    //     # code...
    //     $this->output->set_content_type('application/json')->set_output(json_encode($result));
    // }
    public function tab_biodata(){
        $reservation_id = $this->input->post('ar_reservation_id');
        $reservation_tgl_mulai = $this->input->post('reservation_tgl_mulai');
        $reservation_tgl_selesai = $this->input->post('sampai_reservation_tgl');
        $jammulai = $this->input->post('jamMulai');
        $jamselesai = $this->input->post('jamSelesai');
        $data = array();
        $data['reservation_tgl_mulai_pilih'] = $reservation_tgl_mulai.' '.$jammulai;
        $data['reservation_tgl_selesai_pilih'] = $reservation_tgl_selesai.' '.$jamselesai;
        $data['data_reservation'] = $this->m_base->get_data('v_reservation', array('reservation_id'=>$reservation_id), 'reservation_id, customer_name,customer_phone,customer_email,customer_alamat');
        $this->load->view('tab_biodata', $data,FALSE);
    }
    public function tab_waktu_product(){
        $product_id = $this->input->post('ar_product');
        $product_id_update = $this->input->post('product_id_update');
        $staff_id_update = $this->input->post('staff_id_update');
        $jam_update = date('H:i',strtotime($this->input->post('jam_update')));
        // var_dump($product_id_update);
        $data = array();
        // $data['data_product'] = $this->m_base->get_data('t_product',array('product_active' =>'y' , 'product_id'=>$product_id ),'product_name,product_id,staff_id');
        $sql_product="
        select
            product_id,
            product_name,
            staff_id
        from t_product
        where
            product_active='y' and
            product_id in ($product_id)
        ";
        $data_product                = $this->db->query($sql_product);
        $data['data_product'] = $data_product;

        $ar_staff_id = [];
        foreach ($data_product->result() as $r) {
            if(!in_array($r->staff_id, $ar_staff_id)){
                array_push($ar_staff_id, $r->staff_id);
            }
        }
        $str_staff_id = implode(',', $ar_staff_id);
        $sql_staff = "
        select *
        from m_staff
        where staff_id in (".$str_staff_id.")
        ";
        $data['data_staff'] = $this->db->query($sql_staff);
        $data['product_id_update'] = $product_id_update;
        $data['staff_id_update'] = $staff_id_update;
        $data['jam_update'] = $jam_update;
        $this->load->view('tab_waktu_product', $data,FALSE);
    }
    public function get_select_product(){
        $product_id = $this->input->post('product_id');
        $data['staff'] = $this->input->post('staff_id');
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $data = array();

            $cek_jadwal = "
                SELECT
                    *
                FROM
                    v_product_jadwal_staff
                WHERE
                product_id = $product_id
                AND DATE(schedule_starttime) = '$tanggal'";
            $data['tanggalku'] =date('Y-m-d', strtotime($this->input->post('tanggal')));
           	$data['data_jadwal'] =$this->db->query($cek_jadwal);
            $this->load->view('v_wizard_booking', $data,FALSE);
    }
    public function biodata()
    {
        $data = array();
        $this->load->view('v_form_biodata', $data,FALSE);
    }

    public function create_action()
    {
        $createat = date('Y-m-d H:i:s');
        $service_id = $this->input->post('service_id');
        $reservation_tgl_mulai = date('Y-m-d', strtotime($this->input->post('reservation_tgl_mulai'))); //'2016-09-23 15:47:35';
        $jammulai = date('H:i',strtotime($this->input->post('jammulai')));
        $reservation_tgl_selesai = date('Y-m-d', strtotime($this->input->post('reservation_tgl_selesai'))); //'2016-09-23 15:47:35';
        $jamselesai = date('H:i',strtotime($this->input->post('jamselesai')));
        // var_dump($jam_terpilih);
        $customer_phone = $this->input->post('customer_phone');
        $customer_email = $this->input->post('customer_email');
        $reservation_startdatetime = $reservation_tgl_mulai.'  '.$jammulai;
        $reservation_endeetime = $reservation_tgl_selesai.'  '.$jammulai;
        // var_dump($reservation_startdatetime);
        //query untuk cek jam yang barusan di pilih apa masih kosong apa sudah di booking orang ktika dalam proses isi data
        // select
        //     *
        // from v_reservation
        // where
        // service_id = $service_id
        // AND DATE(reservation_startdatetime) = '$reservation_tgl_mulai'
        // AND ('$jammulai' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_enddatetime)) or
        // DATE(reservation_enddatetime) = '$reservation_tgl_selesai'
        // AND ('$jamselesai' BETWEEN TIME(reservation_enddatetime) and TIME(reservation_startdatetime))
        // ";
        $sql_staff = "
        select
            *
        from v_reservation
        where
        service_id =$service_id
        AND reservation_startdatetime BETWEEN '$reservation_startdatetime' AND '$reservation_endeetime'
        OR reservation_enddatetime BETWEEN '$reservation_startdatetime' AND '$reservation_endeetime'";

        $cek = $this->db->query($sql_staff);
        $cek_id = $this->db->query($sql_staff)->row();
        if($cek->num_rows() > 0){
            $result['stat'] = false;
            $result['pesan'] = 'Mohon Maaf product yang anda pilih sudah di booking Customer lain di jam yang sama Silahkan pilih jam yang lain .';
        }else{

            $createat_tanggal = date('Y-m-d');
            $jam_bayar = 60;
            $tambah_jam = date('H:i',strtotime("$createat +".$jam_bayar."minutes"));
            $reservation_endtime_confir = $createat_tanggal.'  '.$tambah_jam;

            //untuk membuat nomor antrian
            $query1=$this->db->query("SELECT * FROM t_reservation ORDER By reservation_id DESC LIMIT 1")->row();
            if($query1 ==NULL){
                $id=0;
            }else{
              $id=$query1->reservation_id;
            }
            $thun=date('Y', strtotime($createat));
            $thn2=substr($thun,-2); //ngambil 2 angka tarhr dari thun
            $tanggal=date('d', strtotime($createat));
            $tanggal2=substr($tanggal,1); //1 angka dari tanggal pesan
            $jam=date('i', strtotime($createat));
            $jam2=substr($jam,-1); //mengambil 1 angka dari belakng
            $s=date('s', strtotime($createat));
            $s2=substr($s,-1);
            $reservation_number=$thn2.''.$tanggal2.''.$jam2.''.$s2.''.$id+1;

                    $sql_cek_langganan = "
                        SELECT
                            *
                        FROM
                            t_customer
                        WHERE
                            customer_phone =$customer_phone
                        ";
                        $cek_member = $this->db->query($sql_cek_langganan);

                        if($cek_member->num_rows() > 0){
                          $ambil_product_name ="
                              select*
                              from
                              m_service
                              where
                              service_id = $service_id";
                              // var_dump($ambil_product_name);
                          $cek_product_name = $this->db->query($ambil_product_name)->row();
                          $product_name = $cek_product_name->service_name;
                          $product_price = $cek_product_name->service_harga;

                            $cek_id_member = $this->db->query($sql_cek_langganan)->row();
                            $customer_id = $cek_id_member->customer_id;
                            $filter = array(
                                'customer_id' =>$customer_id
                            );
                            $cs = array(
                                'customer_name' => $this->input->post('customer_name'),
                                'customer_phone'=> $this->input->post('customer_phone'),
                                'customer_email'=> $this->input->post('customer_email'),
                                'customer_updateat'=> $createat,
                            );
                            $result = $this->m_base->update_data('t_customer', $cs,$filter);
                            $data = array(
                                'customer_id'               => $customer_id,
                                'service_id'                => $service_id,
                                'reservation_startdatetime' => $reservation_startdatetime,
                                'reservation_enddatetime'   => $reservation_endeetime,
                                'reservation_number'        => $reservation_number,
                                'reservation_endtime_confir' =>$reservation_endtime_confir,
                                'reservation_status'        => 'pending',
                                'status_payment_id'            =>1,
                                'reservation_active'        => 'y',
                                'reservation_createat'      => $createat,
                            );
                            $result = $this->m_base->insert_data('t_reservation', $data, true);

                        }else{
                            $cs = array(
                                'customer_name' => $this->input->post('customer_name'),
                                'customer_phone'=> $this->input->post('customer_phone'),
                                'customer_email'=> $this->input->post('customer_email'),
                                'customer_createdat'=> $createat,
                            );
                            $result = $this->m_base->insert_data('t_customer', $cs);
                            $ambil_id ="
                            select
                                customer_id
                            from
                                t_customer
                            where
                            customer_phone = $customer_phone
                            ";
                            $cek_id_member = $this->db->query($ambil_id)->row();
                            $customer_id = $cek_id_member->customer_id;
                            $ambil_product_name ="
                                select*
                                from
                                m_service
                                where
                                service_id = $service_id";
                                // var_dump($ambil_product_name);
                            $cek_product_name = $this->db->query($ambil_product_name)->row();
                            $product_name = $cek_product_name->service_name;
                            $product_price = $cek_product_name->service_harga;
                            // var_dump($product_price);
                            $data = array(
                                'customer_id'               => $customer_id,
                                'service_id'                => $service_id,
                                'reservation_startdatetime' => $reservation_startdatetime,
                                'reservation_enddatetime'   => $reservation_endeetime,
                                'reservation_number'        => $reservation_number,
                                'reservation_endtime_confir' =>$reservation_endtime_confir,
                                'reservation_status'        => 'pending',
                                'status_payment_id'            =>1,
                                'reservation_active'        => 'y',
                                'reservation_createat'      => $createat,
                            );
                            $result = $this->m_base->insert_data('t_reservation', $data, true);
                        }
                $no_tujuan = $customer_phone;
                $isi_pesan = urlencode('Terima kasih telah melakukan Reservasi '.$product_name.' No RES'.$reservation_number.' Silahkan lakukan pembayaran sebesar Rp. '.number_format($product_price,0,',','.').' sebelum '.$tambah_jam.' WIB');
                $this->api_sms($no_tujuan, $isi_pesan);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    }

    public function update($id)
    {
        $data['mode']            = 'edit';
        $data['judul']           = '<i class="fa fa-pencil"></i> Edit Reservation';
        $data['data_reservation'] = $this->m_base->get_data('v_reservation', array('reservation_id' => $id));
        $data['data_service'] = $this->m_base->get_data('m_service', array('service_active'=>'y'), 'service_id, service_name');

        $data_view['content_layout'] = $this->load->view('v_reservation_form', $data, true);
        echo modules::run('base/c_base/main_view', $data_view);
    }

    public function update_action()
    {
        $updateby = $this->session->userdata('user_id');
        $updateat = date('Y-m-d H:i:s');
        $filter = array(
            'reservation_id' => $this->input->post('id')
        );
        $id_customer = array(
            'customer_id' => $this->input->post('customer_id')
        );
        $customer_id_update = $this->input->post('customer_id_update');
        $customer_id =  $this->input->post('customer_id');
        $reservation_id_update = $this->input->post('reservation_id_update');
        $service_id = $this->input->post('service_id');
        // var_dump($jam_terpilih);
        $customer_phone = $this->input->post('customer_phone');
        $customer_email = $this->input->post('customer_email');
        $customer_name = $this->input->post('customer_name');
        // $reservation_startdatetimef_id;
        $reservation_tgl = date('Y-m-d', strtotime($this->input->post('reservation_tgl_mulai_pilih')));
        $reservation_tgl_mulai_pilih = date('Y-m-d H:i', strtotime($this->input->post('reservation_tgl_mulai_pilih')));
        $jamMulai = date('H:i', strtotime($this->input->post('reservation_tgl_mulai_pilih')));
        $reservation_tgl_selesai_pilih = date('Y-m-d H:i', strtotime($this->input->post('reservation_tgl_selesai_pilih')));
        $sampai_reservation_tgl = date('Y-m-d', strtotime($this->input->post('reservation_tgl_selesai_pilih')));
        $jamSelesai = date('H:i', strtotime($this->input->post('reservation_tgl_selesai_pilih')));
                $sql_cek = "
                    SELECT
                        *
                    FROM
                        v_reservation
                    WHERE
                    service_id = $service_id
                    AND reservation_id not in($reservation_id_update)
                    AND status_payment_id not in (3,5)
                    AND DATE(reservation_startdatetime) = '$reservation_tgl'
                    AND ('$jamMulai' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_enddatetime)) AND
                    DATE(reservation_enddatetime) = '$sampai_reservation_tgl'
                    AND ('$jamSelesai' BETWEEN TIME(reservation_enddatetime) and TIME(reservation_startdatetime))";

                $cek = $this->db->query($sql_cek);
                if($cek->num_rows() > 0){
                    // sudah ada
                    $result['stat'] = false;
                    $result['pesan'] = 'Mohon Maaf product yang anda pilih sudah di booking Customer lain di jam yang sama Silahkan pilih jam yang lai.';
                }else {

                $data = array(
                    'customer_id'               => $customer_id_update,
                    'service_id'                => $service_id,
                    'reservation_startdatetime' => $reservation_tgl_mulai_pilih,
                    'reservation_enddatetime'   => $reservation_tgl_selesai_pilih,
                    // 'reservation_endtime_confir' =>$reservation_endtime_confir,
                    // 'reservation_status'        => 'pending',
                    'reservation_active'        => 'y',
                    'reservation_updateat'      => $updateat,
                );
                 $result = $this->m_base->update_data('t_reservation', $data, $filter);
                 $cs = array(
                     'customer_name' => $this->input->post('customer_name'),
                     'customer_phone'=> $this->input->post('customer_phone'),
                     'customer_email'=> $this->input->post('customer_email'),
                     'customer_updateat'=> $updateat,
                 );
                 $result = $this->m_base->update_data('t_customer', $cs,$id_customer);
            }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function delete($id)
    {
        $filter = array('reservation_id' => $id);
        $data = array('reservation_active' => 't',
                        'status_payment_id' =>5,
                        'reservation_status' =>'cancel');
        $result = $this->m_base->update_data('t_reservation', $data, $filter);

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    public function modal_konfirmasi($id){
        $data['mode']           ='modal_konfirmasi';

        $data['judul']           = '<i class="fa fa-pencil"></i>Detail Reservation';
        $data['data_reservation'] = $this->m_base->get_data('v_reservation', array('reservation_id' => $id));
        $data['data_product'] = $this->m_base->get_data('m_service', array('service_active'=>'y'), 'service_id, service_name');
        $this->load->view('v_modal_konfirmasi_reservation', $data, FALSE);

    }
    public function konfirmasi($id)
    {
        $updateby = $this->session->userdata('user_id');
        $updateat = date('Y-m-d H:i:s');
        $filter = array('reservation_id' => $id);
        $data = array('reservation_status' => 'BOOKED',
                    'status_payment_id'         =>4,
                    'reservation_updateby'      => $updateby,
                    'reservation_updateat'      => $updateat,
                );
        $result = $this->m_base->update_data('t_reservation', $data, $filter);

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    public function cencal($id)
    {
        $updateby = $this->session->userdata('user_id');
        $updateat = date('Y-m-d H:i:s');
        $filter = array('reservation_id' => $id);
        $data = array('reservation_status' => 'cancel',
                    'status_payment_id'         =>5,
                    'reservation_updateby'      => $updateby,
                    'reservation_updateat'      => $updateat,
                );
        $result = $this->m_base->update_data('t_reservation', $data, $filter);

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    public function pending($id)
    {
        $updateby = $this->session->userdata('user_id');
        $updateat = date('Y-m-d H:i:s');
        $filter = array('reservation_id' => $id);
        $data = array('reservation_status' => 'pending',
                    'status_payment_id'         =>1,
                    'reservation_updateby'      => $updateby,
                    'reservation_updateat'      => $updateat,
                );
        $result = $this->m_base->update_data('t_reservation', $data, $filter);

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    public function notifikasi()
    {
        $this->db->from('t_reservation');
        $this->db->where('status_payment_id',1);
        $cek=$this->db->count_all_results();;
        $this->output->set_content_type('application/json')->set_output(json_encode($cek));
    }
    public function btn_konfirmasi()
    {   $updateat = date('Y-m-d H:i:s');
        $this->db->from('t_reservation');
        $this->db->where('status_payment_id',2);
        $cek=$this->db->count_all_results();

        $sql_cek_reservasi = "
            SELECT
                *
            FROM
                v_reservation
            WHERE
             now() >= reservation_endtime_confir
             AND reservation_status  in ( 'pending')
        ";
        $data_reservation= $this->db->query($sql_cek_reservasi)->row();
        $reservation_id = $data_reservation->reservation_id;
        $id = array(
            'reservation_id' => $reservation_id
        );

        $cek_reser = $this->m_base->get_data('t_reservation', array('reservation_id'=>$reservation_id,'reservation_status'=>'pending'));
        if($cek_reser->num_rows() > 0){
            $data = array(
                    'reservation_status'  => 'cancel',
                    'status_payment_id' =>5,
                    'reservation_updateat' =>$updateat);
            $result = $this->m_base->update_data('t_reservation', $data, $id);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($cek));
    }
    public function ajax_cancel()
    {
        $updateat = date('Y-m-d H:i');
        $data_tanggal  = $this->m_base->get_data('t_reservation', array('reservation_status'=>'pending'), 'reservation_status, reservation_id,reservation_createat')->row();
        $tanggal_booking=$data_tanggal->reservation_createat;
        $timer=20;
        $reservation_createat = date('Y-m-d H:i', strtotime($reservation_createat )); //'2016-09-23 15:47:35';
        $tahun_booking = date('Y-m-d', strtotime($tanggal_booking )); //'2016-09-23 15:47:35';
        $jam_booking = date('H:i', strtotime("$tanggal_booking + ".$timer." minutes")); //15:47 + durasi
        $reservation_finish = $tahun_booking.' '.$jam_booking;
        $sql_cek = "
            SELECT
                *
            FROM
                t_reservation
            WHERE
            status_payment_id  in (1)
            AND DATE(reservation_createat) = '$tahun_booking'
            AND (('$reservation_starttime' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_enddatetime)) or ('$reservation_endtime' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_startdatetime)))
        ";


        $filter = array('reservation_createat' => $id);
        $data = array('reservation_status' => 'cancel',
                    'status_payment_id'  =>5,
                    'reservation_updateby'      => $updateby,
                    'reservation_updateat'      => $updateat,
                );
        $result = $this->m_base->update_data('t_reservation', $data, $filter);
    }
    public function api_sms($no_tujuan,$isi_pesan)
    {
        $api_sms = 'https://reguler.zenziva.net/apps/smsapi.php?userkey=9neyl7&passkey=awank&nohp='.$no_tujuan.'&pesan='.$isi_pesan.'';
        // var_dump($api_sms);

        $stream_options = array(
            'http' => array(
               'method'  => 'POST',
            ),
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
        );
        $context  = stream_context_create($stream_options);
        $response = file_get_contents($api_sms,false,$context);

    }





}
