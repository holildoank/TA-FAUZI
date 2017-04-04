<div class="reservation">
    <div class="title">
       <h2>YOUR <span class="low">RESERVATION</span> </h2>
       <p>Create your services with our team and this will be guarantee booking for your salon experience</p>

    </div>
    <div class="alert alert-danger" style="display:none">
        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
    </div>
    <form role="form" action="" method="post" class="f1">
        <div class="f1-steps">
            <div class="f1-progress">
                <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
            </div>
            <div class="f1-step active">
                <div class="f1-step-icon">1</i></div>
                <p>Step 1</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon">2</div>
                <p>Step 2</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon">3</div>
                <p>Step 3</p>
            </div>
        </div>

        <fieldset>
            <div class="row step_1">
                    <?php echo modules::run('front/c_reservation_front/get_stepp1'); ?>
            </div>
        </fieldset>

        <fieldset>
            <div class="row step-2">
                <input type="hidden" name="reservation_tgl" id="reservation_tgl" value="<?php echo @$reservation_tgl?>">
                <?php foreach ($ar_staff->result() as $f): ?>
                    <?php
                    $staff_id = $f->staff_id;
                    $asli         = $f->staff_photo;
                    $tanpa_ext    = preg_replace('/\.[^.\s]{3,4}$/', '', $asli);
                    $pathinfo     = pathinfo($asli);
                    $ext          = $pathinfo['extension'];
                    $thumb        = $tanpa_ext.'_thumb.'.$ext;
                    ?>
                <div class="col-xs-3">
                    <div class="stylish">
                        <!-- <img class="centered-and-cropped" src="front/images/men-hair.jpg" /> -->
                        <?php echo '<img class="centered-and-cropped" src="'.base_url().'/uploads/staff/'.$thumb.'" /> ' ?>
                    </div>
                </div>
                <div class="col-xs-4">
                    <h3><?php echo @$f->staff_name  ?></h3>
                    <div class="checkbox-container">
                        <?php foreach ($arr_product->result() as $dp): ?>
                            <?php if ($dp->staff_id==$staff_id): ?>
                                <label class="input-group">
                                    <span>
                                        <input type="radio" data-staff="<?php echo $f->staff_id ?>" class="radio_product_id" name="product_id"  value="<?php echo $dp->product_id ?>" /><?php echo @$dp->product_name ?>
                                    </span>
                                </label>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="form-group jam" id="jam_<?php echo $f->staff_id?>">
                        <label for="date-set">Time :*</label>
                        <div class="input-group">
                            <input type="text" size="10" id="jamku_<?php echo $f->staff_id?>"  readonly class="form-control form-reserve timepicker timepicker-24">
                            <span class="input-group-btn">
                                <button class="btn default date-set" type="button">
                                    <i class="fa fa-clock-o"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous btn-lg btn-sub btn-space">Previous</button>
                <button type="button" class="btn btn-next btn-lg btn-sub btn-space">Next</button>
            </div> -->
            <!-- <div class="form-group">
                <label class="sr-only" for="f1-email">Email</label>
                <input type="text" name="f1-email" placeholder="Email..." class="f1-email form-control" id="f1-email">
            </div>
            <div class="form-group">
                <label class="sr-only" for="f1-password">Password</label>
                <input type="password" name="f1-password" placeholder="Password..." class="f1-password form-control" id="f1-password">
            </div>
            <div class="form-group">
                <label class="sr-only" for="f1-repeat-password">Repeat password</label>
                <input type="password" name="f1-repeat-password" placeholder="Repeat password..."
                                    class="f1-repeat-password form-control" id="f1-repeat-password">
            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous">Previous</button>
                <button type="button" class="btn btn-next">Next</button>
            </div> -->
        </fieldset>

        <fieldset>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Name :*</label>
                        <!-- <input type="text" name="f1-facebook" placeholder="Facebook..." class="f1-facebook form-control" id="f1-facebook"> -->
                        <input type="text" name="name" value="" class="form-control form-reserve" placeholder="Name">

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label>Email :*</label>
                      <input type="email" name="name" value="" class="form-control form-reserve" placeholder="email">
                    </div>
                </div>
                <div class="clearfix">

                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label>Phone :*</label>
                      <input type="email" name="name" value="" class="form-control form-reserve" placeholder="phone">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label>Comment :*</label>
                      <textarea class="form-control" name="name" rows="1" cols="8"></textarea>
                    </div>
                </div>
            </div>

            <div class="f1-buttons">
                <button type="button" class="btn btn-previous btn-lg btn-sub btn-space">Previous</button>
                <button type="submit" class="btn btn-submit btn-lg btn-sub btn-space">Submit</button>
            </div>
        </fieldset>

    </form>

</div>

<script type="text/javascript">

$('.date-picker').datepicker({
  autoOpen: false,
    orientation: "left",
    autoclose: true
});

// $('.jam').hide();
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
// handle input group button click
$('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
    e.preventDefault();
    $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
});

function btnInsert () {
    // var formData = $('#form_reservation').serialize();
    var formData = new FormData($('#form_reservation')[0]);
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
                        document.getElementById("form_reservation").reset();
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

    $('.f1 fieldset:first').fadeIn('slow');

    $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });

    // next step
    $('.f1 .btn-next').on('click', function() {
    	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    	var progress_line = $(this).parents('.f1').find('.f1-progress-line');

    	// fields validation
    	parent_fieldset.find('input[type="text"], input[type="password"],input.is(":radio") && input.is(":''"), textarea').each(function() {
    		if( $(this).val() == "" ) {
    			$(this).addClass('input-error');
    			next_step = false;
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation
        console.log(next_step);
    	if( next_step ) {
    		parent_fieldset.fadeOut(400, function() {
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

    	$(this).parents('fieldset').fadeOut(400, function() {
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

    // submit
    $('.f1').on('submit', function(e) {

    	// fields validation
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function() {
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation

    });


});


</script>
