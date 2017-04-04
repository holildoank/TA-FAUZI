<div class="container reservation-container" id="book">
    <div class="row">
        <div class="col-md-4">
            <div class="opening-time">
                <div class="opening-title">
                    <h4>OPENING TIME</h4>
                </div>
                <div class="openingday">
                    <h3>MONDAY - SUNDAY</h3>
                    <h2>09<span class="smalls">.00</span> - 20<span class="smalls">.00</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="reservation">
                <div class="title">
                   <h2>YOUR <span class="low">RESERVATION</span> </h2>
                   <p>Create your services with our team and this will be guarantee booking for your salon experience</p>

                </div>
                <div class="alert alert-danger" style="display:none">
                    <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                </div>
                <form class="form-input" action="" method="post">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group input-time">
                            <label>Services :*</label>
                            <input type="button" id="btn_hidden" value="" style="display:none">
                            <select class="selectpicker form-control aa" name="staff_id" id="staff_id">
                                <option  value="">-- Select Hair Stylish --</option>
                                <?php foreach ($data_service_reservation->result() as $r): ?>
                                    <?php echo '<option value="'.$r->service_id.'" data-duration="30">'.$r->service_name.'</option>' ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                            <label for="date-set">Date :*</label>
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                <input type="text" class="form-control form-reserve class-datepicker" id="reservasi_date" readonly>
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
                            <button class="btn btn-primary nextBtn pull-right btn-lg btn-sub btn-space" id="btn_reservasi_next" type="button" > Next </button>
                            <!-- <button class="btn btn-success " type="submit" name="button">SEARCH STYLISH</button> -->
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

$('.date-picker').datepicker({
  autoOpen: false,
    orientation: "left",
    autoclose: true
});

$('#btn_reservasi_next').click(function(e) {
    e.preventDefault();
    var reservasi_staff_id = $('#staff_id').val();
    var reservasi_date = $('#reservasi_date').val();
    if (reservasi_staff_id == '' || reservasi_date == '') {
        NotifikasiToast({
            positionClass: 'toast-top-full-width',
            type : 'error', // ini tipe notifikasi success,warning,info,error
            msg : 'Tanda (*) wajib diisi', //ini isi pesan
            title : 'Error', //ini judul pesan
        });
    }else {
        window.location.replace('<?php echo site_url() ?>frontreservation?service_id='+reservasi_staff_id+'&date='+reservasi_date);
    }
});

</script>
