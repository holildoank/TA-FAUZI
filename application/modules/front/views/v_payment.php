
<?php
if ($data_payment->num_rows() > 0) {
	@$dt = $data_payment->row();
?>
<div class="container-fluid title-container">
          <div class="container">
              <div class="title-single">
                  <h2>PAYMENT METHODS</h2>
                  <p>THIS IS PAYMENT METHODS</p>
                  <ol class="breadcrumb">
                      <li><a href="<?php echo site_url() ?>">Home</a></li>
                      <li class="active">Payment Methods</li>
                  </ol>
              </div>
          </div>
      </div>

	  <div class="container blank">
          <div class="title-content">
              <h2>Reviews Reservations</h2><br>
			  <h4>No Reservasi : <?php echo @$dt->reservation_number ?></h4>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="customer-detail">
                      <h4>Customer Detail</h4>
                      <div class="row">

                          <div class="col-sm-4">
                              <div class="data-pemesan">
                                  <p class="title-pemesan">Name :</p>
                                  <p> <?php echo @$dt->customer_name ?></p>
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="data-pemesan">
                                  <p class="title-pemesan">Email :</p>
                                  <p> <?php echo @$dt->customer_email ?></p>
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="data-pemesan">
                                  <p class="title-pemesan">Phone :</p>
                                  <p> <?php echo @$dt->customer_phone ?></p>
                              </div>
                          </div>
                      </div>
                       <hr style="border-bottom:1px #6b6b6b dotted">
                      <div class="order-detail">
                        <h4>Order Detail</h4>
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- <?php echo '<img src="'.base_url().'/uploads/staff/'.@$dt->staff_photo.'" class="img-responsive" alt="" />'?> -->
                            </div>
                            <div class="col-sm-12">
                                <!-- <h4>Nama  <?php echo @$dt->staff_name?></h4> -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="data-pemesan">
                                            <p class="title-pemesan">Product :</p>
                                            <p><?php echo @$dt->service_name ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="data-pemesan">
                                            <p class="title-pemesan">Star DateTime :</p>
                                            <p><?php echo date('d F Y H:i', strtotime(@$dt->reservation_startdatetime)) ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="data-pemesan">
                                            <p class="title-pemesan">Finish DateTime  :</p>
                                            <p><?php echo date('d F Y H:i', strtotime(@$dt->reservation_enddatetime)) ?></p>
                                        </div>
                                    </div>
																			<div class="col-md-8">
                                        <div class="data-pemesan">
                                            <p class="title-pemesan">Batas Konfirmasi Pembayaran :</p>
                                            <p><?php echo date('d F Y  H:i', strtotime(@$dt->reservation_endtime_confir)) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="total">
                      <div class="row">
                          <div class="col-xs-6">
                            <h3>Price</h3>
                          </div>
                          <div class="col-xs-6">
                            <h3 style="float:right">Rp.<?php echo number_format(@$dt->jumlah_bayar,0,',','.') ?></h3>
                          </div>
												  <div class="col-xs-6">
													<h3> Deposit Payment </h3>
												  </div>
												  <div class="col-xs-6">
													  <?php
													  	$setengah_harga=@$dt->jumlah_bayar/2;
													   ?>
														 <h3 style="float:right">Rp.<?php echo number_format($setengah_harga,0,',','.') ?></h3>
												  </div>
										  </div>
					         </div>
              </div>
              <div class="col-md-6">
                  <div class="`pembayaran`">
                      <div class="row bank-container">
                          <div class="col-md-6">
                              <div class="bank">
                                  <img src="<?php echo base_url() ?>/front/images/bca.png" alt="" />
                                  <p><strong>862 000 8118</strong></p>
                                  <p>FAUZI BOWO</p>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="bank">
                                  <img src="<?php echo base_url() ?>/front/images/cimb.jpg" alt="" />
                                  <p><strong>702 639924 000</strong></p>
                                  <p>FAUZI BOWO</p>
                              </div>
                          </div>

                          <div class="ket">
                              <h4 class="ketentuan">ketentuan :</h4>
                              <ol>
                                  <li>Harap melakukan pembayaran dengan waktu maksimal 1 jam setelah melakukan pemesanan.</li>
                                  <li>Pemesanan akan dibatalkan otomatis jika melewati batas waktu maksimal.</li>
                                  <li>Harap melakukan Konfirmasi Pembayaran setelah selesai melakukan pembayaran. </li>
                                  <li>Jika pelanggan melakukan Pembatalan secara sepihak Uang yang sudah dibayar tidak dapat dikembalikan </li>
                              </ol>
                          </div>
                          <div class="konfirmasi">
                              <a href="<?php echo base_url() ?>konfirmasi/payment_methode/<?php echo @$dt->reservation_id ?>">Konfirmasi Pembayaran</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="container-fluid footer">
          <div class="container">
              <div class="row">
                  <div class="col-md-6">
                      <img src="<?php echo base_url() ?>/front/images/mustika2.png" alt="" />
                  </div>
                  <div class="col-md-6">
                      <p class="right">
                          Copyright (c) 2017 Copyright Mustika Musik Kamal All Rights Reserved.
                      </p>
                  </div>
              </div>

          </div>
      </div>
<?php
  }else {
	  echo '
      <div class="container blank">
          <div class="row">
          <h3><center> DATA NOT FOUND </center></h3>
          </div>
    </div>';
  }
  ?>
