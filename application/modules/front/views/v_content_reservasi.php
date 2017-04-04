<script src="<?php echo base_url() ?>/assets/awank/scripts/front_validation.js" type="text/javascript"></script>
<div class="reservation">
    <div class="title">
       <h2>Halaman <span class="low">RESERVASI</span> </h2>
       <p>SIlahkan Pilih Jadwal Anda</p>

    </div>
    <div class="alert alert-danger" style="display:none">
        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
    </div>
    <form role="form" action="#" method="post"  id="form_reservation_front" class="f1">
        <div class="f1-steps">
            <div class="f1-progress">
                <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
            </div>
            <div class="f1-step active" data-nomortab="1">
                <div class="f1-step-icon">1</i></div>
                <p>Step 1</p>
            </div>
            <div class="f1-step " data-nomortab="2">
                <div class="f1-step-icon">2</div>
                <p>Step 2</p>
            </div>
            <div class="f1-step" data-nomortab="3">
                <div class="f1-step-icon">3</div>
                <p>Step 3</p>
            </div>
        </div>

        <content>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Services :*</label>
                          <select class="selectpicker form-control aa" name="service_id" id="service_id">
                              <option value="option">option</option>
                              <?php foreach ($data_service_reservation->result() as $r): ?>
                                  <?php $terpilih = $r->service_id==@$service_id ? 'selected' :'' ?>
                                 <?php echo '<option value="'.$r->service_id.'"'.$terpilih.' >'.$r->service_name.'</option>' ?>
                             <?php endforeach ?>
                          </select>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label class="control-label">Date :*</label>
                        <div class="input-group input-medium date date-picker" data-date-format="dd MM yyyy" data-date-start-date="+0d">
                            <input type="text" class="form-control form-reserve class-datepicker" name="reservasi_tgl" id="reservasi_tgl" value="<?php echo date('d F y', strtotime(@$reservation_tgl)) ?>" readonly>
                            <span class="input-group-btn">
                                <button class="btn default date-set" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="f1-buttons">
                        <button type="button" class="btn btn-next pull-right btn-lg btn-sub btn-space" id="btn_next_1">Next</button>
                    </div>
                </div>
            </div>
        </content>
        <?php if ($ada == 1): ?>
        <content>
            <div class="row step-2">
                <?php foreach ($ar_staff->result() as $f): ?>
                    <?php
                    $staff_id = $f->staff_id;
                    $asli         = $f->staff_photo;
                    $tanpa_ext    = preg_replace('/\.[^.\s]{3,4}$/', '', $asli);
                    $pathinfo     = pathinfo($asli);
                    $ext          = $pathinfo['extension'];
                    $thumb        = $tanpa_ext.'_thumb.'.$ext;
                    ?>
            <div class="stylish-detail">
                <div class="col-sm-4">
                    <div class="stylish">
                        <!-- <img class="centered-and-cropped" src="front/images/men-hair.jpg" /> -->
                        <?php echo '<img class="centered-and-cropped" src="'.base_url().'/uploads/staff/'.$thumb.'" /> ' ?>
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <h3><?php echo @$f->staff_name  ?></h3>
                    <div class="checkbox-container">
                        <?php foreach ($arr_product->result() as $dp): ?>
                            <?php if ($dp->staff_id==$staff_id): ?>
                                <label class="input-group">
                                    <span>
                                        <input type="radio"  data-staff="<?php echo $f->staff_id ?>" class="radio_product_id" name="product_id"  value="<?php echo $dp->product_id ?>" /> <?php echo @$dp->product_name ?>
                                    </span>
                                </label>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group jam" id="jam_<?php echo $f->staff_id?>">
                        <label for="date-set">Time :*</label>
                        <div class="input-group">
                            <input type="text" size="10" id="jamku_<?php echo $f->staff_id?>" name="jam"  readonly class="form-control form-reserve timepicker timepicker-24">
                            <span class="input-group-btn">
                                <button class="btn default date-set" type="button">
                                    <i class="fa fa-clock-o"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
                <?php endforeach; ?>

            </div>
            <div class="col-md-12">
                <div class="f1-buttons">
                    <button type="button" class="btn btn-previous btn-lg btn-sub btn-space">Previous</button>
                    <button type="button" class="btn btn-next btn-lg btn-sub btn-space">Next</button>
                </div>
            </div>
        </content>
    <?php else: ?>
        Mohon Maaf
    <?php endif ?>
        <content>
            <div class="row">
                <div id="content_biodata">

                </div>
            </div>


        </content>
    </form>
</div>

<script type="text/javascript">

$('.date-picker').datepicker({
  autoOpen: false,
    orientation: "left",
    autoclose: true
});

$('.jam').hide();
$('.radio_product_id').click(function(event) {
    var staff_id=$(this).attr('data-staff');
    $('.jam').hide();
    $('#jam_'+staff_id).show();
});

$('.timepicker-24').timepicker({
    autoclose: true,
    minuteStep: 5,
    showSeconds: false,
    showMeridian: false
});
$('.selectpicker').selectpicker({
style: 'btn-select',
size: 8
});
// handle input group button click
$('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
    e.preventDefault();
    $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
});

function get_content_tab3(ar_jam) {
    // alert(ar_jam);
    $('#content_biodata').load('<?php echo site_url(); ?>/frontreservation/tab_biodata', {ar_jam:ar_jam}, function(){

    });

}
// var hasil_tab1 = false;
var hasil_tab1 = false;
function get_schedule() {

    var reservasi_date = $('#reservasi_tgl').val();
    var reservasi_service_id = $('#service_id').val();
    if (reservasi_service_id == '' || reservasi_date == '') {
        NotifikasiToast({
            positionClass: 'toast-top-full-width',
            type : 'error', // ini tipe notifikasi success,warning,info,error
            msg : 'Tanda (*) wajib diisi', //ini isi pesan
            title : 'Error', //ini judul pesan
        });
    }else {
    $.ajax({
        url: '<?php echo site_url() ?>frontreservation/get_schedule',
        type: 'post',
        data: {reservasi_date:reservasi_date, reservasi_service_id:reservasi_service_id},
        async: false
    })
    .done(function(res) {
        if(res.stat){
            // get_content_tab2(res.ar_product,res.product_id_update,res.staff_id_update);
            // window.location.replace('<?php echo site_url() ?>frontreservation?service_id='+reservasi_service_id+'&tanggal='+reservasi_date);
        }else{
            NotifikasiToast({
                positionClass: 'toast-top-full-width',
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
}
function get_time_staff() {
    var product_id            = $('input[name=product_id]:checked').val();
    var staff_id              = $('input[name=product_id]:checked').attr('data-staff');
    var jam_terpilih          = $('#jamku_'+staff_id).val();
    var reservation_tgl       = $('#reservasi_tgl').val();
    var reservation_id_update = $('#reservation_id_update').val();
    var jam = $('#jamku').val();
    if ($('input[name=product_id]:checked').length == 0 || jam_terpilih == '') {
        NotifikasiToast({
            positionClass: 'toast-top-full-width',
            type : 'error', // ini tipe notifikasi success,warning,info,error
            msg : 'Anda Belum memilih Product Service', //ini isi pesan
            title : 'Pesan', //ini judul pesan
        });
        return false;
    }else{
        $.ajax({
            url: '<?php echo site_url() ?>frontreservation/get_time_staff',
            type: 'post',
            data: {product_id:product_id, jam_terpilih:jam_terpilih,staff_id:staff_id, reservation_tgl:reservation_tgl,reservation_id_update:reservation_id_update},
            async: false
        })
        .done(function(res) {
            if(res.stat){
                get_content_tab3(res.ar_jam);
            }else{
                NotifikasiToast({
                    positionClass: 'toast-top-full-width',
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

}


function btnInsert () {
    // var formData = $('#form_reservation').serialize();
    var formData = new FormData($('#form_reservation_front')[0]);
    $.ajax({
        url: '<?php echo site_url(); ?>/frontreservation/create_action',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
    })
    .done(function(res) {
        if(res.stat){
            swal({
                        title: "Success!",
                        text: "Your resevation code is",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-info",
                        confirmButtonText: "Done!",
                        closeOnConfirm: true
                    },
                    function(){
                        var last_id = res.last_id;
                        document.getElementById("form_reservation_front").reset();
                        $('#staff_id').val('').change();
                        $('#staff_id').trigger('change');
                        window.location.replace('<?php echo site_url() ?>konfirmasi/payment/'+last_id);
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


function scroll_to_class(element_class, removed_height) {
	var scroll_to = $(element_class).offset().top - removed_height;
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 0);
	}
}

function bar_progress(progress_line_object, direction) {
	var number_of_steps = progress_line_object.data('number-of-steps');
	var now_value = progress_line_object.data('now-value');
	var new_value = 0;
	if(direction == 'right') {
		new_value = now_value + ( 100 / number_of_steps );
	}
	else if(direction == 'left') {
		new_value = now_value - ( 100 / number_of_steps );
	}
	progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}




jQuery(document).ready(function() {

    $('.f1 content:first').fadeIn('slow');

    $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });

    // next step
    $('.f1 .btn-next').on('click', function() {
    	var parent_content = $(this).parents('content');
    	var next_step = false;
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        var nomortab_sekarang = current_active_step.attr('data-nomortab');
        // console.log(nomortab_sekarang);
        if (nomortab_sekarang ==1) {
            var hasila = get_schedule();
            var next_step = hasila;

        }else if (nomortab_sekarang ==2 ) {

            var hasila = get_time_staff();
            // console.log(hasila);
            if(!hasila){
                var next_step = hasila;        // consolo
            }else{
                var next_step = hasila;
            }
        }
    	if( next_step ) {
    		parent_content.fadeOut(400, function() {
    			// change icons
    			current_active_step.removeClass('active').addClass('activated').next().addClass('active');
    			// progress bar
    			bar_progress(progress_line, 'right');
    			// show next step
	    		$(this).next().fadeIn();
	    		// scroll window to beginning of the form
    			scroll_to_class( $('.f1'), 20 );
	    	});
    	}

    });

    // previous step
    $('.f1 .btn-previous').on('click', function() {
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');

    	$(this).parents('content').fadeOut(400, function() {
    		// change icons
    		current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
    		// progress bar
    		bar_progress(progress_line, 'left');
    		// show previous step
    		$(this).prev().fadeIn();
    		// scroll window to beginning of the form
			scroll_to_class( $('.f1'), 20 );
    	});
    });



    $('#btn_next_1').trigger('click');

});


</script>
