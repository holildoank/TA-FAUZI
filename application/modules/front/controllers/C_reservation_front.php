<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reservation_front extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('base/m_base');
		// $this->load->model('m_reservation');
	}

	public function index(){
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
		$data['tanggalmulai'] = $this->input->get('tanggalmulai');
		$data['jamMulai'] = $this->input->get('jamMulai');
		$data['sampai_reservasi_date'] = $this->input->get('sampai_reservasi_date');
		$data['jamSelesai'] = $this->input->get('JamSelesai');
  	$mulai = $data['tanggalmulai'].' '.$data['jamMulai'];
		$selesai =$data['sampai_reservasi_date'] .' '.$data['jamSelesai'];
		$awal  = strtotime($mulai);
		$akhir = strtotime($selesai);
		$diff  = $akhir - $awal;
		$jam   = floor($diff / (60 * 60));
		$menit = $diff - $jam * (60 * 60);
		$query1=$this->m_base->get_data('m_service', array('service_active'=>'y', 'service_id'=>$data['service_id']), 'service_name,service_harga,hitungan_jam')->row();
		$harga = $query1->service_harga;
		$jamHarga = $query1->hitungan_jam;
		$hargaPerjam= $harga / $jamHarga;
		$total = $hargaPerjam * $jam;
		// var_dump($total);
		if($menit > 49){
			$hargaMenit = $hargaPerjam /2;
		}else{
			$hargaMenit =0;
		}
		$totalHarga = $total + $hargaMenit;
		$data['totalHarga'] = $totalHarga;
		$data['data_service_reservation'] = $this->m_base->get_data('m_service', array('service_active'=>'y', 'service_id'=>$data['service_id']), 'service_name,service_id');
		$data_view['content_layout'] = $this->load->view('v_reservation_single', $data, true);
    echo modules::run('base/c_base/front_view2', $data_view);
	}

	public function get_schedule()
	    {
					$reservation_tgl = date('Y-m-d', strtotime($this->input->post('reservasi_date')));
	        $sampai_reservation_tgl = date('Y-m-d', strtotime($this->input->post('sampai_reservasi_date')));
					$service_id = $this->input->post('reservasi_service_id');
					$jamSelesai =date('H:i:s', strtotime($this->input->post('jamMulai')));
					$jamMulai =date('H:i:s', strtotime($this->input->post('jamSelesai')));
					$mulai_tgl =$reservation_tgl.' '.$jamMulai;
					$sampai_tgl =$sampai_reservation_tgl.' '.$jamSelesai;
		        $sql_cek = "
		                  select
		                      *
		                  from v_reservation
		                  where
		                  service_id =$service_id
		                  AND reservation_startdatetime BETWEEN '$mulai_tgl' AND '$sampai_tgl'
		                  OR reservation_enddatetime BETWEEN '$mulai_tgl' AND '$sampai_tgl'
		                    ";
					// $sql_cek = "
					// 					select
					// 							*
					// 					from v_reservation
					// 				 	where
					// 	 			 	DATE(reservation_startdatetime) = '$reservation_tgl'
					// 	 				AND ('$jamMulai' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_enddatetime)) or
					// 	   			DATE(reservation_enddatetime) = '$sampai_reservation_tgl'
					// 		 			AND ('$jamSelesai' BETWEEN TIME(reservation_enddatetime) and TIME(reservation_startdatetime))";

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
	            }
	        $this->output->set_content_type('application/json')->set_output(json_encode($result));
	    }
  public function create_action(){
				$createat = date('Y-m-d H:i:s');
				$service_id = $this->input->post('service_id');
				$tanggalmulai =  date('Y-m-d', strtotime($this->input->post('tanggalmulai')));
				$jamMulai = date('H:i', strtotime($this->input->post('jamMulai')));
				$sampai_reservasi_date = date('Y-m-d', strtotime($this->input->post('sampai_reservasi_date')));
				$jamSelesai = date('H:i', strtotime($this->input->post('jamSelesai')));

        $customer_phone = $this->input->post('customer_phone');
        $customer_email = $this->input->post('customer_email');
				$reservation_startdatetime = $tanggalmulai.' '.$jamMulai;
        $reservation_startdatetime = $sampai_reservasi_date.' '.$jamSelesai;
        // var_dump($reservation_startdatetime);
        //query untuk cek jam yang barusan di pilih apa masih kosong apa sudah di booking orang ktika dalam proses isi data
        // $sql_staff = "
				// select
				// 		*
				// from v_reservation
				// where
				// DATE(reservation_startdatetime) = '$tanggalmulai'
				// AND ('$jamMulai' BETWEEN TIME(reservation_startdatetime) and TIME(reservation_enddatetime)) or
				// DATE(reservation_enddatetime) = '$sampai_reservasi_date'
				// AND ('$jamSelesai' BETWEEN TIME(reservation_enddatetime) and TIME(reservation_startdatetime))";

				$sql_staff = "
									select
											*
									from v_reservation
									where
									service_id =$service_id
									AND reservation_startdatetime BETWEEN '$reservation_startdatetime' AND '$reservation_startdatetime'
									OR reservation_enddatetime BETWEEN '$reservation_startdatetime' AND '$reservation_startdatetime'";

        $cek = $this->db->query($sql_staff);
				$sql_harga  ="select* from m_service where  service_id ='$service_id'";
				$cek_id = $this->db->query($sql_harga)->row();
				$product_harga = $cek_id->service_harga;
				if($cek->num_rows() > 0){
            // jika jadwal tidak ada
            $result['stat'] = false;
            $result['pesan'] = 'Mohon Maaf pemesanan pada Tanggal yang anda plih sudah tidak ada  .';
        }else{
            $createat_tanggal = date('Y-m-d');
            $jam_bayar = 60;
            $tambah_jam = date('H:i',strtotime("$createat +".$jam_bayar."minutes"));
            $reservation_endtime_confir = $createat_tanggal.'  '.$tambah_jam;

            //untuk membuat nomor antrian
            $query1=$this->db->query("SELECT * FROM t_reservation ORDER By reservation_id DESC LIMIT 1")->row();
						if($query1 == NULL){
							$id =0;
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
													$ambil_product_name ="
														select*
														from
														m_service
														where
														service_id = $service_id";
													$cek_product_name = $this->db->query($ambil_product_name)->row();
													$product_name = $cek_product_name->service_name;
													$product_price = $cek_product_name->service_harga;
													$hargaTotal = $this->input->post('totalHarga');
													$harga_setengah = $hargaTotal/2;

							        		if($cek_member->num_rows() > 0){
														$cek_id_member = $this->db->query($sql_cek_langganan)->row();
														$customer_id = $cek_id_member->customer_id;
														$filter = array(
												            'customer_id' =>$customer_id
												        );
														$cs = array(
															'customer_name' => $this->input->post('customer_name'),
															'customer_phone'=> $this->input->post('customer_phone'),
															'customer_email'=> $this->input->post('customer_email'),
															'customer_alamat'=> $this->input->post('customer_alamat'),
															'customer_updateat'=> $createat,
														);
														$result = $this->m_base->update_data('t_customer', $cs,$filter);
                            $data = array(
                                'customer_id'               => $customer_id,
                                'service_id'                => $service_id,
                                'reservation_startdatetime' => $reservation_startdatetime,
                                'reservation_enddatetime'   => $reservation_startdatetime,
                                'reservation_number'        => $reservation_number,
                                'reservation_endtime_confir' =>$reservation_endtime_confir,
                                'reservation_status'        => 'pending',
																'status_payment_id'            =>1,
                                'reservation_active'        => 'y',
																'jumlah_bayar'							=>$hargaTotal,
                                'reservation_createat'      => $createat,
                            );
                            $result = $this->m_base->insert_data('t_reservation', $data, true);

                        }else{
                            $cs = array(
                                'customer_name' => $this->input->post('customer_name'),
                                'customer_phone'=> $this->input->post('customer_phone'),
                                'customer_email'=> $this->input->post('customer_email'),
																'customer_alamat'=> $this->input->post('customer_alamat'),
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
                            // var_dump($product_price);
                            $data = array(
															'customer_id'               => $customer_id,
															'service_id'                => $service_id,
															'reservation_startdatetime' => $reservation_startdatetime,
															'reservation_enddatetime'   => $reservation_startdatetime,
															'reservation_number'        => $reservation_number,
															'reservation_endtime_confir' =>$reservation_endtime_confir,
															'reservation_status'        => 'pending',
															'status_payment_id'            =>1,
															'reservation_active'        => 'y',
															'jumlah_bayar'							=>$hargaTotal,
															'reservation_createat'      => $createat,
                            );
                            $result = $this->m_base->insert_data('t_reservation', $data, true);
                        }
						$no_tujuan = $customer_phone;
						$isi_pesan = urlencode('Terima kasih telah melakukan Reservasi '.$product_name.' No RES'.$reservation_number.' Silahkan lakukan pembayaran sebesar Rp. '.number_format($harga_setengah,0,',','.').' sebelum '.$tambah_jam.' WIB');
						$this->api_sms($no_tujuan, $isi_pesan);
          }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    }

	public function konfirmasi(){
		$data = array();
		$data_view['content_layout'] = $this->load->view('v_konfirmasi', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
	}

	public function identitas()
	{
		$reservation_number = $this->input->post('reservation_number');
		$data = array();
		$data['data_payment_identitas'] = $this->m_base->get_data('v_reservation', array('reservation_number'=>$reservation_number,'reservation_status'=>'pending'), 'reservation_id,reservation_number,customer_phone,customer_email,customer_name');
		$this->load->view('v_reservation_identitas', $data, false);
	}
	public function payment($id){
		$data = array();
		$data['data_payment'] = $this->m_base->get_data('v_reservation', array('reservation_id'=>$id),'service_harga,reservation_createat,service_name,reservation_endtime_confir,reservation_number,reservation_id,customer_name,customer_phone,customer_email,reservation_startdatetime,reservation_enddatetime,jumlah_bayar');

		$data_view['content_layout'] = $this->load->view('v_payment', $data, true);
		echo modules::run('base/c_base/front_view2', $data_view);
	}
	public function payment_methode($id){
		$data = array();
		$data['data_payment_konfirmasi'] = $this->m_base->get_data('v_reservation', array('reservation_id'=>$id),'service_id,service_harga,reservation_createat,service_name,reservation_endtime_confir,reservation_number,reservation_id,customer_name,customer_phone,customer_email,reservation_startdatetime,reservation_enddatetime,jumlah_bayar');

		$data_view['content_layout'] = $this->load->view('v_confirmation', $data, true);
		echo modules::run('base/c_base/front_view2', $data_view);
	}
	public function savekonfirmasi(){
			$updateat = date('Y-m-d H:i:s');
			$filter = array(
				'reservation_id' => $this->input->post('reservation_id1')
			);
			$reservation_id=$this->input->post('reservation_id1');
			$bayar = $this->input->post('reservation_amount_paid');
			$product_id = $this->input->post('product_id');

			$sql_cek_number = "
				SELECT
					reservation_number,
					service_harga
				FROM
					v_reservation
				WHERE
					reservation_id=$reservation_id
					and status_payment_id in (1)
				";
			$cek = $this->db->query($sql_cek_number);
			// var_dump($setengah_harga);
	        if($cek->num_rows()>0){
				$cek_harga = $this->db->query($sql_cek_number)->row();
				$harga_prodcut = $cek_harga->service_harga;
				$setengah_harga =$harga_prodcut / 2;
				$cek_id_number= $this->db->query($sql_cek_number)->row();
				$reservation_number = $cek_id_number->reservation_number;
				if ($bayar ==$setengah_harga || $bayar == $harga_prodcut) {
					$data = array('reservation_methode'   => $this->input->post('reservation_methode'),
												'reservation_amount_paid' => $this->input->post('reservation_amount_paid'),
												'reservation_active'      => 'y',
												'status_payment_id'			=>2,
												'reservation_status'      => 'confirmation',
												'reservation_updateat'    => $updateat);
					$result = $this->m_base->update_data('t_reservation', $data, $filter);
					$no_tujuan = '085233265657';
					$isi_pesan = urlencode('No Res '.$reservation_number.' Telah melakukan Konfirmasi Pembayaran Sebesar Rp. '.$bayar.'Silahkan Konfirmasi Lewat Sistem');
					$this->api_sms($no_tujuan, $isi_pesan);
				}elseif ($bayar > $harga_prodcut) {
					$result['stat'] = false;
					$result['pesan'] = 'Mohon Maaf nominal yang anda masukan lebih besar dari harga Product.';
				}else{
					$result['stat'] = false;
					$result['pesan'] = 'Mohon Maaf nominal yang anda masukan kurang dari 50% harga product.';
				}

	        }else{
				$result['stat'] = false;
				$result['pesan'] = 'Mohon Maaf No Reservasi Yang Anda masukan sudah masa kadaluarsa atau sudah Lunas.';
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($result));

	}
	public function bookinglist(){
		$data=array();

		$data_view['content_layout'] = $this->load->view('v_booking_list', $data, true);
        echo modules::run('base/c_base/front_view2', $data_view);
	}
	public function api_sms($no_tujuan,$isi_pesan)
    {
        $api_sms ='https://reguler.zenziva.net/apps/smsapi.php?userkey=9neyl7&passkey=awank&nohp='.$no_tujuan.'&pesan='.$isi_pesan.'';

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
