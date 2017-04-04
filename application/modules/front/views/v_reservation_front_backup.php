<div class="container" id="book">
    <div class="row">
        <div class="col-md-4">
            <div class="opening-time">
                <div class="opening-title">
                    <h4>OPENING TIME</h4>
                </div>
                <div class="openingday">
                    <h3>MONDAY - SUNDAY</h3>
                    <h2>09 <span class="smalls">AM</span> - 09 <span class="smalls">PM</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="reservation">
                <div class="title">
                   <h2>SALON <span class="low">RESERVATION</span> </h2>
                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>

                </div>
                <div class="alert alert-danger" style="display:none">
                    <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                </div>
                <form class="form-reservation" id="form_reservation">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">NAME *:</label>
                                <input type="text" class="form-control form-reserve" name="reservation_name" id="reservation_name" value="" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">ADDRESS * :</label>
                                <input type="text" class="form-control form-reserve" name="reservation_address" id="reservation_address" value="" placeholder="Enter address">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">PHONE *:</label>
                                <input type="text" class="form-control form-reserve" name="reservation_phone" id="reservation_phone" value="" placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">CHOOSE YOUR HAIR STYLISH *</label>
                                <select class="selectpicker form-control" name="staff_id" id="staff_id">
                                    <option  value="">-- Select Hair Stylish --</option>
                                 <?php foreach ($data_staff_reservation->result() as $r): ?>
                                    <?php echo '<option value="'.$r->staff_id.'" data-duration="30">'.$r->staff_name.'</option>' ?>
                                <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">SELECT SERVICE *</label>
                                <div id="select_product">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-space">
                              <label>DATE  *:</label>
                                  <div class="input-group date form_datetime">
                                      <input type="text" size="16" readonly name="reservation_startdatetime" id="reservation_startdatetime" class="form-control form-reserve" placeholder="Select Date">
                                      <span class="input-group-btn">
                                          <button class="btn default date-set" type="button">
                                          <i class="fa fa-calendar"></i>
                                          </button>
                                      </span>
                                  </div>
                          </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-space">
                                <label for="">COMMENT :</label>
                                <textarea class="form-control" name="name" rows="1" cols="20"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button class="btn btn-success btn-sub" type="submit" name="button">SUBMIT NOW</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
FormValidation.init();
$('#staff_id').change(function(e) {
    e.preventDefault();
    var staff_id=$(this).val();

    $('#select_product').load('<?php echo site_url() ?>frontreservation/get_select_product', {staff_id : staff_id}, function() {

    });
});
var dateToday = new Date();
$(".form_datetime").datetimepicker({
    autoclose: true,
    // format: "dd MM yyyy - hh:ii",
    minDate: 0,
    format: "dd-mm-yyyy hh:ii",
    pickerPosition: "bottom-left",

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

</script>
