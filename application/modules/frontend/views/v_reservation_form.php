<script src="<?php echo base_url() ?>/assets/awank/scripts/form-wizard.js" type="text/javascript"></script>
<?php
if($mode=='edit'){
    $dt = $data_reservation->row();
}
?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="javascript:;">Frontend</a>
                    <i class="fa fa-circle"></i>
                </li>
				<li>
                    <a href="<?php echo site_url() ?>reservation">Reservation</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="javascript:;">Add New Reservation</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Reservation
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="form_wizard_1">
                    <div class="portlet-body form">
                        <form class="form-horizontal" action="#" id="submit_form" method="POST">
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" class="step">
                                                <span class="number"> 1 </span>
                                                <span class="desc">
                                                    <i class="fa fa-check"></i> Tanggal dan Service </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#tab2" data-toggle="tab" class="step active">
                                                <span class="number"> 2 </span>
                                                <span class="desc">
                                                    <i class="fa fa-check"></i> Biodata </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab3" data-toggle="tab" class="step">
                                                <span class="number"> 3 </span>
                                                <span class="desc">
                                                    <i class="fa fa-check"></i> Konfirmasi </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="bar" class="progress progress-striped" role="progressbar">
                                        <div class="progress-bar progress-bar-success"> </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="alert alert-danger display-none">
                                            <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-none">
                                            <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                                        <div class="tab-pane active" id="tab1">
                                            <h3 class="block">Provide your account details</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Tanggal Mulai
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="hidden" value="<?php echo @$dt->customer_id?>" name="customer_id_update" id="customer_id_update">
                                                    <input type="hidden" value="<?php echo @$dt->reservation_id?>" name="reservation_id_update" id="reservation_id_update">
                                                    <input type="text" class="form-control reservation_tgl reservation_tgl_mulai" name="reservation_tgl_mulai" id="reservation_tgl_mulai" value="<?php echo date('d-M-Y', strtotime(@$dt->reservation_startdatetime)) ?>" data-date-format="dd MM yyyy" data-date-start-date="+0d" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                  <input type="text" class="form-control timepicker timepicker-24" name="jammulai" id="jammulai" value="<?php echo date('H:i', strtotime(@$dt->reservation_startdatetime)) ?>" data-date-format="dd MM yyyy" data-date-start-date="+0d" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Tanggal Selesai
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control reservation_tgl  reservation_tgl_selesai" name="reservation_tgl_selesai" id="reservation_tgl_selesai" value="<?php echo date('d-M-Y', strtotime(@$dt->reservation_enddatetime)) ?>" data-date-format="dd MM yyyy" data-date-start-date="+0d" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                  <input type="text" class="form-control timepicker timepicker-24" name="jamselesai" id="jamselesai" value="<?php echo date('H:i', strtotime(@$dt->reservation_startdatetime)) ?>" data-date-format="dd MM yyyy" data-date-start-date="+0d" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Service
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="service_id" id="service_id">
                                                        <option></option>
                                                        <?php foreach ($data_service->result() as $r): ?>
                                                            <?php $terpilih = $r->service_id==@$dt->service_id ? 'selected' :'' ?>
                                                            <?php echo '<option value="'.$r->service_id.'"'.$terpilih.'>'.$r->service_name.'</option>' ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab2">
                                            <div id="content_biodata">

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <h3 class="block">Confirm your Reservation</h3>
                                            <h4 class="form-section">Reservation</h4>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Product:</label> <div class="col-md-4">
                                                    <p class="form-control-static" data-display="service_name"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Tanggal:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="reservation_tgl"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Jam:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="jamku"> </p>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-3">Staff Name:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="staff_name"> </p>
                                                </div>
                                            </div> -->
                                            <h4 class="form-section">Profile</h4>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Fullname:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="customer_name"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Email:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="customer_email"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Phone:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="customer_phone"> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <a href="javascript:;" class="btn default button-previous">
                                                <i class="fa fa-angle-left"></i> Back </a>
                                            <a href="javascript:;" class="btn btn-outline green button-next"> Continues
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                            <?php
                                			if($mode=='add'){
                                				echo '<a href="javascript:;" class="btn green button-submit"> Submit
                                                    <i class="fa fa-check"></i>
                                                </a>';
                                			}elseif($mode=='edit'){
                                                echo '<input type="hidden" name="id" value="'.@$dt->reservation_id.'">';
                								echo '<input type="hidden" name="customer_id" value="'.@$dt->customer_id.'">';
                                				echo '<a href="javascript:;" class="btn green button-submit"> Update
                                                    <i class="fa fa-check"></i>
                                                </a>';
                                			}
                                			?>
                                            <!-- <a href="javascript:;" class="btn green button-submit"> Submit
                                                <i class="fa fa-check"></i>
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

<div id="modal_form" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div>

<script type="text/javascript">

$(".timepicker-24").timepicker({
    autoclose:!0,
    minuteStep:5,
    showSeconds:!1,
    showMeridian:!1
});

$.fn.select2.defaults.set( "theme", "bootstrap" );

$(".reservation_tgl").datepicker({
    rtl:App.isRTL(),
    orientation:"left",autoclose:!0}
);

$('#service_id').select2({
    placeholder: 'Pilih Service',
});

mode = <?php echo json_encode($mode) ?>;
function get_content_tab2(ar_product,product_id_update,staff_id_update,jam_update) {
    $('#content_tabwaktuproduct').load('<?php echo site_url(); ?>/reservation/tab_waktu_product', {ar_product:ar_product,product_id_update:product_id_update,staff_id_update:staff_id_update,jam_update:jam_update}, function(){

    });
}
function get_content_tab3(ar_reservation_id,reservation_tgl_mulai,sampai_reservation_tgl,jamMulai,jamSelesai) {
    // alert(sampai_reservation_tgl);
    $('#content_biodata').load('<?php echo site_url(); ?>/reservation/tab_biodata',{
        ar_reservation_id:ar_reservation_id,
        reservation_tgl_mulai : reservation_tgl_mulai,
        sampai_reservation_tgl : sampai_reservation_tgl,
        jamMulai : jamMulai,
        jamSelesai : jamSelesai,
    }, function(){

    });

}

var hasil_tab1 = false;
function get_schedule() {
  var reservation_tgl_mulai = $('.reservation_tgl_mulai').val();
  var reservation_tgl_selesai = $('.reservation_tgl_selesai').val();
  var jammulai = $('#jammulai').val();
  var jamselesai = $('#jamselesai').val();
  var service_id = $('#service_id').val();
  var customer_id_update = $('#customer_id_update').val();
  var reservation_id = $('#reservation_id_update').val();

    $.ajax({
        url: '<?php echo site_url() ?>reservation/get_schedule',
        type: 'post',
        data: {reservation_tgl_mulai:reservation_tgl_mulai,reservation_tgl_selesai:reservation_tgl_selesai,
          jammulai:jammulai,jamselesai:jamselesai,service_id:service_id,customer_id_update:customer_id_update,reservation_id:reservation_id},
        async: false
    })
    .done(function(res) {
        if(res.stat){
            get_content_tab3(res.ar_reservation_id,res.reservation_tgl_mulai,res.sampai_reservation_tgl,res.jamMulai,res.jamSelesai);
        }else{
            NotifikasiToast({
				type : 'error', // ini tipe notifikasi success,warning,info,error
				msg : res.pesan, //ini isi pesan
				title : 'Error', //ini judul pesan
			});
        }
        hasil_tab1 = res.stat;
    })
    .fail(function() {
        console.log("error");
    })
    ;
    return hasil_tab1;
}
// function get_time_staff() {
//     var product_id            = $('input[name=product_id]:checked').val();
//     var staff_id              = $('input[name=product_id]:checked').attr('data-staff');
//     var jam_terpilih          = $('#jamku_'+staff_id).val();
//     var reservation_tgl       = $('#reservation_tgl').val();
//     var reservation_id_update = $('#reservation_id_update').val();
//     var jam = $('#jamku').val();
//     $.ajax({
//         url: '<?php echo site_url() ?>reservation/get_time_staff',
//         type: 'post',
//         data: {product_id:product_id, jam_terpilih:jam_terpilih,staff_id:staff_id, reservation_tgl:reservation_tgl,reservation_id_update:reservation_id_update},
//         async: false
//     })
//     .done(function(res) {
//         if(res.stat){
//             get_content_tab3(res.ar_reservation_id,res.ar_jam);
//         }else{
//             NotifikasiToast({
// 				type : 'error', // ini tipe notifikasi success,warning,info,error
// 				msg : res.pesan, //ini isi pesan
// 				title : 'Error', //ini judul pesan
// 			});
//         }
//         hasil_tab1 = res.stat;
//     })
//     .fail(function() {
//         console.log("error");
//     })
//     ;
//     return hasil_tab1;
// }

$('#product_id').change(function(e) {
    e.preventDefault();
    var product_id = $(this).val();
    var tanggal= $('#tanggal').val();
    var staff_id = <?php echo json_encode(@$dt->staff_id) ?>;
    $('#wizard-jadwal').load('<?php echo site_url() ?>reservation/get_select_product', {staff_id : staff_id, product_id:product_id,tanggal:tanggal}, function() {
    });
});
$('#tanggal').change(function(event) {
    $('#product_id').trigger('change');
});

if(mode=='edit'){
    $('#product_id').trigger('change');
}





function btnInsert () {

    var formData = new FormData($('#submit_form')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/reservation/create_action',
		type: 'post',
        data: formData,
        contentType: false,
        processData: false,
	})
	.done(function(res) {
		if(res.stat){
            swal({
        				title: "Success!",
        				text: "Your data has been saved.",
        				type: "success",
        				showCancelButton: false,
        				confirmButtonClass: "btn-info",
        				confirmButtonText: "Done!",
        				closeOnConfirm: false
        			},
        			function(){
        				window.location.replace('<?php echo site_url() ?>reservation');
        			});
		}else{
            NotifikasiToast({
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
function btnUpdate () {
	// var formData = $('#form_reservation_edit').serialize();
    var formData = new FormData($('#submit_form')[0]);
	$.ajax({
		url: '<?php echo site_url(); ?>/reservation/update_action',
		type: 'post',
		data: formData,
        contentType: false,
        processData: false,
	})
	.done(function(res) {
        if(res.stat){
            swal({
                        title: "Success!",
                        text: "Your data has been updated.",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-info",
                        confirmButtonText: "Done!",
                        closeOnConfirm: false
                    },
                    function(){
                        var last_id = res.last_id;
                        window.location.replace('<?php echo site_url() ?>reservation');
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
