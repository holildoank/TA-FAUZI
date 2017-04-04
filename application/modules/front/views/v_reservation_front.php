<div class="container reservation-container" id="book">
    <div class="row">
        <!-- <div class="col-md-4">
            <div class="opening-time">
                <div class="opening-title">
                    <h4>Jam Buka </h4>
                </div>
                <div class="openingday"> -->
                    <!-- <h3>MONDAY - SUNDAY</h3> -->
                    <!-- <h2>06<span class="smalls">.00</span> - 23<span class="smalls">.00</span></h2>
                </div>
            </div>
        </div> -->
        <div class="col-md-12">
            <div class="reservation">
                <div class="title">
                   <h2>Lakukan  <span class="low">Pemesanan Anda</span> </h2>
                   <p>Silahkan Pilih Tanggal dan Jam Anda Inginkan</p>

                </div>
                <div class="alert alert-danger" style="display:none">
                    <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                </div>
                <form class="form-input" action="" method="post">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group input-time">
                            <label>Produk  Jasa:*</label>
                            <input type="button" id="btn_hidden" value="" style="display:none">
                            <select class="selectpicker form-control aa" name="service_id" id="service_id">
                                <option  value="">-- Pilih Produk Jasa --</option>
                                 <?php foreach ($data_service_reservation->result() as $r): ?>
                                    <?php echo '<option value="'.$r->service_id.'" data-duration="30">'.$r->service_name.'</option>' ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                            <label for="date-set">Mulai Tanggal :*</label>
                            <div class="input-group input-medium date date-picker" data-date-format="dd MM yyyy" data-date-start-date="+0d">
                                <input type="text" class="form-control form-reserve class-datepicker" id="reservasi_tgl" readonly>
                                <span class="input-group-btn">
                                    <button class="btn default date-set" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group jam" >
                            <label for="date-set">Jam :*</label>
                            <div class="input-group">
                                <input type="text" size="10" id="jamMulai" name="jamMulai"  readonly class="form-control form-reserve timepicker timepicker-24">
                                <span class="input-group-btn">
                                    <button class="btn default date-set" type="button">
                                        <i class="fa fa-clock-o"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                            <label for="date-set"> Sampai Tanggal :*</label>
                            <div class="input-group input-medium date date-picker" data-date-format="dd MM yyyy" data-date-start-date="+0d">
                                <input type="text" class="form-control form-reserve class-datepicker" id="sampai_reservasi_tgl" readonly>
                                <span class="input-group-btn">
                                    <button class="btn default date-set" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group jam" >
                            <label for="date-set">Jam :*</label>
                            <div class="input-group">
                                <input type="text" size="10" id="jamSelesai" name="jamSelesai"  readonly class="form-control form-reserve timepicker timepicker-24">
                                <span class="input-group-btn">
                                    <button class="btn default date-set" type="button">
                                        <i class="fa fa-clock-o"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-2">
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
    orientation: "right",
    autoclose: true
});
$('.timepicker-24').timepicker({
    autoclose: true,
    minuteStep: 5,
    showSeconds: false,
    showMeridian: false
});
var hasil_tab1 = false;
$('#btn_reservasi_next').click(function(e) {
    e.preventDefault();
    var reservasi_date = $('#reservasi_tgl').val();
    var sampai_reservasi_date = $('#sampai_reservasi_tgl').val();
    var reservasi_service_id = $('#service_id').val();
    var jamMulai = $('#jamMulai').val();
    var jamSelesai = $('#jamSelesai').val();
    if (reservasi_service_id == '' || reservasi_date == '' || sampai_reservasi_date =='' || jamMulai =='' || jamSelesai =='') {
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
        data: {reservasi_date:reservasi_date, reservasi_service_id:reservasi_service_id,sampai_reservasi_date:sampai_reservasi_date,jamMulai:jamMulai,jamSelesai:jamSelesai},
        async: false
    })
    .done(function(res) {
        if(res.stat){

            window.location.replace('<?php echo site_url() ?>frontreservation?service_id='+reservasi_service_id+'&tanggalmulai='+reservasi_date+'&jamMulai='+jamMulai+'&sampai_reservasi_date='+sampai_reservasi_date+'&JamSelesai='+jamSelesai);

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
});

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
</script>
