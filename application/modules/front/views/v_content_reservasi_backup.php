<div class="reservation">
    <div class="title">
       <h2>YOUR <span class="low">RESERVATION</span> </h2>
       <p>Create your services with our team and this will be guarantee booking for your salon experience</p>

    </div>
    <div class="alert alert-danger" style="display:none">
        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
    </div>

    <div class="stepwizard">
      <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
          <a href="#step-1" type="button" class="btn btn-primary btn-circle btn-step step_1">1</a>
          <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
          <a href="#step-2" type="button" class="btn btn-default btn-circle step_2" >2</a>
          <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
          <a href="#step-3" type="button" class="btn btn-default btn-circle step_3" >3</a>
          <p>Step 3</p>
        </div>
      </div>
    </div>

    <form role="form" action="" method="post">
      <div class="row setup-content " id="step-1">
        <div class="col-xs-12">
          <div class="form-group">
              <label class="control-label">Services :*</label>
                <input type="button" required="required" id="btn_hidden" value="" style="display:none">
                  <select class="selectpicker form-control aa" name="staff_id" id="staff_id">
                      <option  value="">-- Select Hair Stylish --</option>
                  </select>
          </div>
        </div>
        <div class="col-md-9">
          <div class="form-group">
              <label class="control-label">Date :*</label>
              <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                  <input type="text" required="required" class="form-control form-reserve class-datepicker" readonly>
                  <span class="input-group-btn">
                      <button class="btn default date-set" type="button">
                          <i class="fa fa-calendar"></i>
                      </button>
                  </span>
              </div>

          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
              <button class="btn btn-primary nextBtn pull-right btn-lg btn-sub btn-space" type="button" > Next </button>
              <!-- <button class="btn btn-success " type="submit" name="button">SEARCH STYLISH</button> -->
          </div>
        </div>
      </div>

      <div class="row setup-content" id="step-2">
        <div class="col-xs-12 step-2">
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
                <div class="stylish-detail">

            <div class="stylish">
                <?php echo '<img class="centered-and-cropped" src="'.base_url().'/uploads/staff/'.$thumb.'" /> ' ?>
            </div>
            <h3><?php echo @$f->staff_name  ?></h3>
            <hr>
            <div class="row">
              <div class="col-xs-6">
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
              <div class="col-xs-6">
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
            </div>
          </div>
        <?php endforeach; ?>
        </div>
        <div class="col-md-9">
        </div>
        <div class="col-md-3">
          <div class="form-group">
              <!-- <a href="javascript:;" class="btn btn-primary extBtn pull-right btn-lg btn-sub btn-space nextBtn get_time_staff"> Next
                  <i class="fa fa-angle-right"></i> -->
                  <button class="btn btn-primary get_time_staff pull-right btn-lg btn-sub btn-space" id="get_time_staff" type="button" > Next </button>
             </a>
          </div>
        </div>
      </div>

      <div class="row setup-content" id="step-3">
        <div class="content_biodata" id="content_biodata"></div>
        </div>
      </div>
    </form>
</div>

<script type="text/javascript">
FormValidation.init();

function tab_btn_3() {

    $('#content_biodata').load('<?php echo site_url(); ?>/frontreservation/tab_biodata', {}, function(){
    });

}

$('#get_time_staff').click(function(e) {
        e.preventDefault();
    var product_id            = $('input[name=product_id]:checked').val();
    var staff_id              = $('input[name=product_id]:checked').attr('data-staff');
    var jam_terpilih          = $('#jamku_'+staff_id).val();
    var reservation_tgl       = $('#reservation_tgl').val();
    $.ajax({
        url: '<?php echo site_url() ?>frontreservation/get_time_staff',
        type: 'post',
        data: {product_id:product_id, jam_terpilih:jam_terpilih,staff_id:staff_id, reservation_tgl:reservation_tgl},
        async: false
    })
    .done(function(res) {
        if(res.stat){
            tab_btn_3();
        }else{
            NotifikasiToast({
				type : 'error', // ini tipe notifikasi success,warning,info,error
				msg : res.pesan, //ini isi pesan
				title : 'Error', //ini judul pesan
			});
        }
        hasil_tab1 = res.stat;
    })
    // .fail(function() {
    //     console.log("error");
    // })
    // ;
    return hasil_tab1;
});
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


$(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();

      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
    //   alert(isValid);
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
  $('.step_2').trigger('click');

});
</script>
