<div class="container-fluid title-container">
    <div class="container">
        <div class="title-single">
            <h2>Halaman Pemesanan</h2>
            <p></p>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url() ?>">Home</a></li>
            </ol>
        </div>
    </div>
</div>

<div class="container reservation-single" id="book">
    <div class="row">
        <div class="col-md-4">
            <div class="opening-time">
                <div class="opening-title">
                    <h4>OPENING TIME</h4>
                </div>
                <div class="openingday">
                    <h2>06<span class="smalls">.00</span> - 23<span class="smalls">.00</span></h2>
                </div>
            </div>
        </div>
        <form role="form" action="#" method="post"  id="form_reservation_front" class="f1">
          <div class="col-xs-8">
            <div class="form-group input-time">
                <label>Produk  Jasa:*</label>
                <input type="button" id="btn_hidden" value="" style="display:none">
                <select class="selectpicker form-control aa" name="service_id" id="service_id">
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
                    <input type="text" class="form-control form-reserve  class-datepicker" name="tanggalmulai" value="<?php echo @$tanggalmulai ?>"id="reservasi_tgl" readonly>
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
                    <input type="text" size="10" id="jamMulai" name="jamMulai" readonly="readonly" value="<?php echo @$jamMulai ?>"  readonly class="form-control form-reserve timepicker timepicker-24">
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
                    <input type="text" class="form-control form-reserve class-datepicker" name="sampai_reservasi_date" value="<?php echo @$sampai_reservasi_date ?>" id="sampai_reservasi_tgl" readonly>
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
                <label for="date-set">Jam Selesai :*</label>
                <div class="input-group">
                    <input type="text" size="10" id="jamSelesai" name="jamSelesai" value="<?php echo @$jamSelesai ?>"  readonly class="form-control form-reserve timepicker timepicker-24">
                    <span class="input-group-btn">
                        <button class="btn default date-set" type="button">
                            <i class="fa fa-clock-o"></i>
                        </button>
                    </span>
                </div>
            </div>
          </div>
          <div class="col-md-8">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for=""><b> <h3>Total Biaya :</h3></b> </label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for=""><b> <h3><?php echo number_format(@$totalHarga,0,',','.') ?></h3></b></label>
                  <input type="hidden" name="totalHarga"  id ="totalHarga" value="<?php echo @$totalHarga ?>">
                </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                      <label>Name :*</label>
                      <!-- <input type="text" name="f1-facebook" placeholder="Facebook..." class="f1-facebook form-control" id="f1-facebook"> -->
                      <input type="text" name="customer_name" value="" id="customer_name" class="form-control form-reserve" placeholder="Name">
                      <input type="hidden" name="jam_kepilih" value="<?php echo @$jam_kepilih ?>" id="jam_kepilih" class="form-control form-reserve" placeholder="Name">
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email :</label>
                    <input type="email" name="customer_email" id="customer_email" value="" class="form-control form-reserve" placeholder="email">
                  </div>
              </div>
              <div class="clearfix">

              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                    <label>Phone :*</label>
                    <input type="text" name="customer_phone" id="customer_phone" value="" class="form-control form-reserve" placeholder="phone">
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                    <label>Alamat :*</label>
                    <input type="text" name="customer_alamat" id="customer_alamat" value="" class="form-control form-reserve" placeholder="Alamat Anda">
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                    <label>Comment :*</label>
                    <textarea class="form-control" name="reservation_request" id="reservation_request" rows="1" cols="8"></textarea>
                  </div>
              </div>
              <div class="f1-buttons">
                  <!-- <button type="button" class="btn btn-previous btn-lg btn-sub btn-space">Previous</button> -->
                  <button type="submit" class="btn btn-submit btn-lg btn-sub btn-space">Booking</button>
              </div>
          </div>
        </form>

    </div>
</div>

<div class="container-fluid footer2">
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
                        // alert(last_id);
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
