    <div class="container-fluid title-container">
         <div class="container">
             <div class="title-single">
                 <h2>PAYMENT CONFIRMATION</h2>
                 <p>THIS IS PAYMENT CONFIRMATION</p>
                 <ol class="breadcrumb">
                     <li><a href="<?php echo site_url() ?>">Home</a></li>
                     <li class="active">Payment Confirmation</li>
                 </ol>
             </div>
         </div>
     </div>

	 <?php
	 if ($data_payment_konfirmasi->num_rows() > 0) {
		 $dt = $data_payment_konfirmasi->row();
		 ?>
     <div class="container blank">
         <div class="payment-confirmation">
             <div class="">
                 <form class="form-reservation" id="form_konfirmasi">
                     <div class="form-group">
                         <label>Name :</label>
                         <input type="text" class="form-control form-reserve" name="reservation_name" id="reservation_name" value="<?php echo $dt->customer_name ?>" placeholder="Enter Name">
                     </div>
                     <div class="form-group">
                         <label>No Reservation :</label>
                         <input type="text" class="form-control form-reserve" name="reservation_number" id="reservation_number" value="<?php echo $dt->reservation_number ?>" placeholder="Enter No Reservation">
                         <input type="hidden" class="form-control form-reserve" name="reservation_id1" id="reservation_id1" value="<?php echo $dt->reservation_id ?>">
                         <input type="hidden" class="form-control form-reserve" name="service_id" id="service_id" value="<?php echo $dt->service_id ?>">
                     </div>
                     <div class="form-group">
                         <label for="">CHOOSE YOUR BANK</label>
                         <select class="selectpicker form-control" name="reservation_methode" id="reservation_methode">
                             <option disabled="" value="">-- Select Bank --</option>
                             <option value="BCA" data-duration="30">BCA</option>
                             <option value="Mandiri" data-duration="30">Mandiri</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <label> Prize Product  :</label>
                         <input type="text" class="form-control form-reserve" name="service_harga" id="service_harga" value="Rp.<?php echo number_format($dt->jumlah_bayar,0,',','.') ?>" readonly="readonly">
                     </div>
                     <div class="form-group">
                         <?php
                           $setengah_harga=$dt->jumlah_bayar/2;
                          ?>
                         <label>Deposit payment  :</label>
                         <input type="text" class="form-control form-reserve" name="deposit_payment" id="deposit_payment" value="Rp.<?php echo number_format($setengah_harga,0,',','.') ?>" readonly="readonly">
                     </div>
                     <div class="form-group">
                         <label>Amoun Paid :</label>
                         <input type="text" class="form-control form-reserve" name="reservation_amount_paid" id="reservation_amount_paid" value="" placeholder="Jumlah Transfer">
                     </div>
                     <div class="form-group">
                         <button class="btn btn-success btn-sub" type="submit" name="button">SUBMIT NOW</button>
                     </div>
                 </form>
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
     <script type="text/javascript">
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
							 window.location.replace('<?php echo site_url() ?>');
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
