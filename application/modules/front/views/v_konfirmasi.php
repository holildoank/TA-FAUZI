
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
          <div class="pembayaran2">

              <div class="row bank-container">
                  <div class="col-md-6">
                      <div class="bank">
                          <img src="<?php echo base_url() ?>/front/images/bca.png" alt="" />
                          <p><strong>862 000 8118</strong></p>
                          <p>Mustika</p>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="bank">
                          <img src="<?php echo base_url() ?>/front/images/cimb.jpg" alt="" />
                          <p><strong>702 639924 000</strong></p>
                          <p>MUSTIKA</p>
                      </div>
                  </div>
                  <div class="ket">
                      <h4 class="ketentuan">ketentuan :</h4>
                      <ol>
                          <li>Harap melakukan pembayaran dengan waktu maksimal 1 jam setelah melakukan pemesanan.</li>
                          <li>Pemesanan akan dibatalkan otomatis jika melewati batas waktu maksimal.</li>
                          <li>Harap melakukan Konfirmasi Pembayaran setelah selesai melakukan pembayaran. </li>
                      </ol>
                  </div>
                  <div class="konfirmasi">
                      <!-- <a href="<?php echo base_url() ?>konfirmasi/payment_methode/">Konfirmasi Pembayaran</a> -->
                  </div>
                  <hr>
                  <h3>Payment Confirmation</h3>
                  <form class="form-reservation" id="form_konfirmasi">
                      <div class="row">
                         <div class="col-md-10" style="text-align:left !IMPORTANT;">
                             <div class="form-group">
                                 <label>No Reservation :</label>
                                 <div class="input-group">
                                     <span class="input-group-addon">
                                         RES
                                     </span>
                                     <input type="text" class="form-control form-reserve" name="reservation_number" id="reservation_number" value="" placeholder="Res-">
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-2">
                             <button class="button btn-sub" style="margin-top:25px; margin-left:-10px; color:#fff; padding:10px 10px;"type="button" id="btn_cekb">Cek</button>
                         </div>
                      </div>
                      <div class="form-group" style="text-align:left !IMPORTANT;">
                          <label for="">CHOOSE YOUR BANK</label>
                          <select class="selectpicker form-control" name="reservation_methode">
                              <option disabled="" value="">-- Select Bank --</option>
                              <option value="BCA" data-duration="30">BCA</option>
                              <option value="Mandiri" data-duration="30">Mandiri</option>
                          </select>
                      </div>
                      <div id="nama_reservasi">
                      </div>
                  </form>
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
     <script type="text/javascript">
     $('#btn_cekb').click(function(e) {
         e.preventDefault();
         var reservation_number=$('#reservation_number').val();
         console.log(reservation_number);
         $('#nama_reservasi').load('<?php echo site_url() ?>konfirmasi/identitas/', {reservation_number : reservation_number}, function() {

         });
     });
     function btnInsert () {
         var formData = new FormData($('#form_konfirmasi')[0]);
         $.ajax({
             url: '<?php echo site_url(); ?>/konfirmasi/savekonfirmasi',
             type: 'post',
             data: formData,
             contentType: false,
             processData: false,
         })
         .done(function(res) {
             if(res.stat){
                 swal({
                             title: "Success!",
                             text: "Your resevation code is RES-"+res.last_id,
                             type: "success",
                             showCancelButton: false,
                             confirmButtonClass: "btn-info",
                             confirmButtonText: "Done!",
                             closeOnConfirm: true
                         },
                         function(){
                             var last_id = res.last_id;
                             document.getElementById("form_konfirmasi").reset();
                             $('#staff_id').val('').change();
                             $('#staff_id').trigger('change');
                             // window.location.replace('<?php echo site_url() ?>konfirmasi/payment/'+last_id);
                         });
             }else{
                 NotifikasiToast({
                     positionClass: 'toast-top-full-width',
                     type : 'error', // ini tipe notifikasi success,warning,info,error
                     msg : res.pesan, //ini isi pesan
                     title : 'Error', //ini judul pesan
                 });
             }
         })
         .fail(function() {
             console.log("error");
         });
     }
     </script>
