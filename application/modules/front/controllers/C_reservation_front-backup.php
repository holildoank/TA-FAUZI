<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reservation_front extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		// $this->load->model('m_reservation');
	}

	public function index()
    {
       $data = array();
		$data['data_service_reservation'] = $this->m_base->get_data('m_service', array('service_active'=>'y'), 'service_id, service_name');
        $this->load->view('v_reservation_front', $data, FALSE);
        // echo modules::run('base/c_base/front_head');
    }
	public function get_stepp1()
    {
       $data = array();
		$data['data_service_reservation'] = $this->m_base->get_data('m_service', array('service_active'=>'y'), 'service_id, service_name');
        $this->load->view('v_step_1', $data, FALSE);
        // echo modules::run('base/c_base/front_head');
    }
	public function reservation(){
		$data = array();
		$data['service_id'] = $this->input->get('service_id');
		$data['tanggal'] = $this->input->get('tanggal');

		$data_view['content_layout'] = $this->load->view('v_reservation_single', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);

	}

	public function get_content_reservasi()
	{
		$reservation_tgl = date('Y-m-d', strtotime($this->input->post('tanggal')));
		// var_dump($reservation_tgl);
        $service_id = $this->input->post('service_id');

        $data_staff = $this->m_base->get_data('t_schedule_staff', array('schedule_active'=>'y', 'schedule_date'=>$reservation_tgl), 'staff_id');
		$result['data_service_reservation'] = $this->m_base->get_data('m_service', array('service_active'=>'y'), 'service_id, service_name');
        if($data_staff->num_rows()==0){
			$result['ada'] = 0;
            $result['stat'] = false;
            $result['pesan'] = 'Maaf, Tidak ada Hair Stylish yang tersedia pada tanggal tersebut.';
        }else{
            $ar_staff = [];
            foreach ($data_staff->result() as $r) {
                array_push($ar_staff, $r->staff_id);
            }

            $staff_tersedia = implode(',', $ar_staff);
            $sql_cek_product = "
            select product_id,product_name,staff_id from t_product where service_id='$service_id' and staff_id in ($staff_tersedia) and product_active='y'
            ";
            $data_product = $this->db->query($sql_cek_product);
            if ($data_product->num_rows() == 0) {
                $result['stat'] = false;
                $result['pesan'] = 'Maaf, Tidak ada Product yang tersedia pada tanggal tersebut.';
				$result['ada'] = 0;
            }else {
				$sql = "select * from m_staff where staff_id in ($staff_tersedia)";
				$result['data_staff'] = $this->db->query($sql);
                $ar_product = [];
                foreach ($data_product->result() as $r) {
                    array_push($ar_product, $r->product_id);
                }
                $product_tersedia = implode(',', $ar_product);
				$arr_staff = $this->db->query($sql);
				// var_dump($product_tersedia);

                $result['stat'] = true;
				$result['reservation_tgl'] = $reservation_tgl;
				$result['service_id'] = $service_id;
				$result['arr_product'] = $this->db->query($sql_cek_product);
                $result['ar_staff'] = $arr_staff;
				$result['ada'] = 1;
            }

        }
		$this->load->view('v_content_reservasi', $result,FALSE);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	public function get_schedule()
    {
        $reservation_tgl = date('Y-m-d', strtotime($this->input->post('reservasi_date')));
        $service_id = $this->input->post('reservasi_service_id');
		// var_dump($reservation_tgl);
        $data_staff = $this->m_base->get_data('t_schedule_staff', array('schedule_active'=>'y', 'schedule_date'=>$reservation_tgl), 'staff_id');

        if($data_staff->num_rows()==0){
            $result['stat'] = false;
            $result['pesan'] = 'Maaf, Tidak ada Hair Stylish yang tersedia pada tanggal tersebut.';
        }else{
            $ar_staff = [];
            foreach ($data_staff->result() as $r) {
                array_push($ar_staff, $r->staff_id);
            }

            $staff_tersedia = implode(',', $ar_staff);
            $sql_cek_product = "
            select product_id from t_product where service_id='$service_id' and staff_id in ($staff_tersedia) and product_active='y'
            ";
            $data_product = $this->db->query($sql_cek_product);
            if ($data_product->num_rows() == 0) {
                $result['stat'] = false;
                $result['pesan'] = 'Maaf, Tidak ada Product yang tersedia pada tanggal tersebut.';
            }else {
                $ar_product = [];
                // $product_id_update = [];
                foreach ($data_product->result() as $r) {
                    array_push($ar_product, $r->product_id);
                }
                $product_tersedia = implode(',', $ar_product);
                $result['stat'] = true;
                $result['ar_product'] = $product_tersedia;
            }


        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
	public function get_time_staff(){
        $product_id = $this->input->post('product_id');
        $staff_id = $this->input->post('staff_id');
        $reservation_tgl = date('Y-m-d', strtotime($this->input->post('reservation_tgl')));
        $jam = date('H:i', strtotime($this->input->post('jam_terpilih')));
        $sql_staff = "
        select
            staff_id,
            product_name,
            product_duration
        from v_product_jadwal_staff
        where
            product_id=$product_id
            AND staff_id=$staff_id
            AND staff_active  in ('y')
            AND DATE(schedule_date) = '$reservation_tgl'
            AND (('$jam' BETWEEN TIME(schedule_starttime) and TIME(schedule_enddatime)) or ('$jam' BETWEEN TIME(schedule_starttime) and TIME(schedule_starttime)))";

        $cek = $this->db->query($sql_staff);
        $cek_id = $this->db->query($sql_staff)->row();

        if($cek->num_rows()==0){
            // jika jadwal tidak ada
            $result['stat'] = false;
            $result['pesan'] = 'Mohon Maff Jadwal product yang anda pilih tidak ada jadwal pada tanggal dan jam yang anda pilih.';
        }else{
            $product_duration = $cek_id->product_duration;
            $jam_durasi = date('H:i', strtotime("$jam + ".$product_duration." minutes")); //15:47 + durasi

                $sql_cek = "
                SELECT
                *
                FROM
                v_reservation
                WHERE
                staff_id = $staff_id
                AND reservation_status not in ('canceled')
                AND DATE(reservation_startdatetime) = '$reservation_tgl'
                AND (('$jam' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_enddatetime)) or ('$jam_durasi' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_startdatetime)))";


                $cek = $this->db->query($sql_cek);
                // var_dump($this->db->last_query());
                if($cek->num_rows() > 0){
                    // sudah ada
                    $result['stat'] = false;
                    $result['pesan'] = 'Mohon Maaf Staff Yang Anda Pilih sedang Melayani Customer Lain pada jam yang sama , Silahkan Pilih Jadwal yang lain.';
                }else {
                    $result['stat'] = true;
                }
        }
        # code...
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
	public function tab_biodata(){
        $reservation_id = $this->input->post('ar_reservation_id');
        $data = array();
            $data['data_reservation'] = $this->m_base->get_data('v_reservation', array('reservation_id'=>$reservation_id), 'reservation_id, customer_name,customer_phone,customer_email');
        $this->load->view('v_step_3', $data,FALSE);
    }
    public function create_action()
    {
		$createat = date('Y-m-d H:i:s');
        $product_id = $this->input->post('product_id');
        $reservation_tgl = date('Y-m-d', strtotime($this->input->post('reservasi_tgl'))); //'2016-09-23 15:47:35';
		$jam_terpilih = date('H:i', strtotime($this->input->post('jamku')));
        // var_dump($jam_terpilih);
        $customer_phone = $this->input->post('customer_phone');
        $customer_email = $this->input->post('customer_email');
        $reservation_startdatetime = $reservation_tgl.'  '.$jam_terpilih;
        // var_dump($reservation_startdatetime);
        //query untuk cek jam yang barusan di pilih apa masih kosong apa sudah di booking orang ktika dalam proses isi data
        $sql_staff = "
        select
            staff_id,
            product_name,
            product_duration
        from v_product_jadwal_staff
        where
            product_id=$product_id
            AND staff_active  in ('y')
            AND DATE(schedule_date) = '$reservation_tgl'
            AND (('$jam_terpilih' BETWEEN TIME(schedule_starttime) and TIME(schedule_enddatime)) or ('$jam_terpilih' BETWEEN TIME(schedule_starttime) and TIME(schedule_starttime)))";
        $cek = $this->db->query($sql_staff);
        $cek_id = $this->db->query($sql_staff)->row();
        $product_duration = $cek_id->product_duration;
        if($cek->num_rows() < 1){
            // jika jadwal tidak ada
            $result['stat'] = false;
            $result['pesan'] = 'Mohon Maaf hair Stylish Pada tanggal dan jam yang anda pilih tidak tersedia  .';
        }else{
            $product_duration = $cek_id->product_duration;
            $staff_id = $cek_id->staff_id;

            $jam_durasi = date('H:i',strtotime("$jam_terpilih +".$product_duration."minutes")); //15:47 + durasi
            $reservation_enddatetime = $reservation_tgl.'  '.$jam_durasi;
            // var_dump($reservation_enddatetime);

            $createat_tanggal = date('Y-m-d');
            $jam_bayar = 60;
            $tambah_jam = date('H:i',strtotime("$createat +".$jam_bayar."minutes"));
            $reservation_endtime_confir = $createat_tanggal.'  '.$tambah_jam;

            //untuk membuat nomor antrian
            $query1=$this->db->query("SELECT * FROM t_reservation ORDER By reservation_id DESC LIMIT 1")->row();
            $id=$query1->reservation_id;
            $thun=date('Y', strtotime($createat));
            $thn2=substr($thun,-2); //ngambil 2 angka tarhr dari thun
            $tanggal=date('d', strtotime($createat));
            $tanggal2=substr($tanggal,1); //1 angka dari tanggal pesan
            $jam=date('i', strtotime($createat));
            $jam2=substr($jam,-1); //mengambil 1 angka dari belakng
            $s=date('s', strtotime($createat));
            $s2=substr($s,-1);
            $reservation_number=$thn2.''.$tanggal2.''.$jam2.''.$s2.''.$id+1;

                $sql_cek = "
                    SELECT
                        *
                    FROM
                        v_reservation
                    WHERE
                    staff_id = $staff_id
                    AND reservation_status not in ('canceled')
                    AND DATE(reservation_startdatetime) = '$reservation_tgl'
                    AND (('$jam_terpilih' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_enddatetime)) or ('$jam_durasi' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_startdatetime)))";

                $cek = $this->db->query($sql_cek);
                if($cek->num_rows() > 0){
                    // sudah ada
                    $result['stat'] = false;
                    $result['pesan'] = 'Mohon Maaf product yang anda pilih sudah di booking Customer lain di jam yang sama Silahkan pilih jam yang lain.';
                }else {
                    $sql_cek_langganan = "
                        SELECT
                            *
                        FROM
                            t_customer
                        WHERE
                            customer_phone =$customer_phone OR customer_email = ('$customer_email')
                        ";
                        $cek_member = $this->db->query($sql_cek_langganan);

                        if($cek_member->num_rows() > 1){
                            $cek_id_member = $this->db->query($sql_cek_langganan)->row();
                            $customer_id = $cek_id_member->customer_id;
                            $data = array(
                                'customer_id'               => $customer_id,
                                'product_id'                => $product_id,
                                'reservation_startdatetime' => $reservation_startdatetime,
                                'reservation_enddatetime'   => $reservation_enddatetime,
                                'reservation_number'        => $reservation_number,
                                'reservation_endtime_confir' =>$reservation_endtime_confir,
                                'reservation_status'        => 'pending',
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
                            $data = array(
                                'customer_id'               => $customer_id,
                                'product_id'                => $product_id,
                                'reservation_startdatetime' => $reservation_startdatetime,
                                'reservation_enddatetime'   => $reservation_enddatetime,
                                'reservation_number'        => $reservation_number,
                                'reservation_endtime_confir' =>$reservation_endtime_confir,
                                'reservation_status'        => 'pending',
                                'reservation_active'        => 'y',
                                'reservation_createat'      => $createat,
                            );
                            $result = $this->m_base->insert_data('t_reservation', $data, true);

							$no_tujuan = $customer_phone;
							$isi_pesan = 'Silahkan Lakukan Pembayaran Atas pemesanan Anda sebelum reservasi terbatal';
							$this->api_sms($no_tujuan, $isi_pesan);

                        }
                }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    }

	public function konfirmasi(){
		$data = array();
		$data_view['content_layout'] = $this->load->view('v_konfirmasi', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
	}

	public function savekonfirmasi(){
			$updateat = date('Y-m-d H:i:s');
			$filter = array(
				'reservation_id' => $this->input->post('reservation_id1')
			);
			$reservation_id=$this->input->post('reservation_id1');
			// $reservation_status=>pen
			$cek = $this->m_base->get_data('t_reservation', array('reservation_id'=>$reservation_id,
																	'reservation_status'=>'pending'));
	        if($cek->num_rows()>0){
				$data = array('reservation_methode'   => $this->input->post('reservation_methode'),
		                'reservation_amount_paid' => $this->input->post('reservation_amount_paid'),
		                'reservation_active'      => 'y',
		                'reservation_status'      => 'confirmation',
		                'reservation_updateat'    => $updateat);
				$result = $this->m_base->update_data('t_reservation', $data, $filter);
	        }else{
				$result['stat'] = false;
				$result['pesan'] = 'Mohon Maaf No Reservasi ini sudah masa kadaluarsa atau sudah Lunas.';
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($result));

	}
	public function identitas()
	{
		$reservation_number = $this->input->post('reservation_number');
		$data = array();
       	$data['data_payment_identitas'] = $this->m_base->get_data('v_reservation', array('reservation_number'=>$reservation_number), 'reservation_id,reservation_number,customer_phone,customer_email,customer_name');
		$this->load->view('v_reservation_identitas', $data, false);
	}
	public function payment($id){
    	$data = array();
       	$data['data_payment'] = $this->m_base->get_data('v_reservation', array('reservation_id'=>$id),'product_price,reservation_createat,product_name,reservation_endtime_confir,reservation_number,reservation_id,customer_name,customer_phone,customer_email');
		$data_view['content_layout'] = $this->load->view('v_payment', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
    }
	public function payment_methode($id){
    	$data = array();
       	$data['data_payment_konfirmasi'] = $this->m_base->get_data('v_reservation', array('reservation_id'=>$id),'product_name,reservation_endtime_confir,reservation_number,reservation_id,customer_name,customer_phone,customer_email');
		$data_view['content_layout'] = $this->load->view('v_confirmation', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
    }
	public function bookinglist(){
		$data=array();

		$data_view['content_layout'] = $this->load->view('v_booking_list', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
	}

	public function api_sms($no_tujuan)
    {
        $api_sms = 'https://reguler.zenziva.net/apps/smsapi.php?userkey=9neyl7&passkey=awank&nohp='.$no_tujuan.'&pesan=silahkan konfirmasi';
        $stream_options = array(
            'http' => array(
               'method'  => 'POST',
            ),
        );
        $context  = stream_context_create($stream_options);
        $response = file_get_contents($api_sms);

        // return $response;
    }

}
