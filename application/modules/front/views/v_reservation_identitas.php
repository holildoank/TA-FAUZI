<?php
if ($data_payment_identitas->num_rows() > 0) {
    $dt = $data_payment_identitas->row();
    ?>
    <div class="form-group">
        <label>Name :</label>
        <input type="text" class="form-control form-reserve" name="customer_name" id="customer_name" value="<?php echo $dt->customer_name ?>" placeholder="Enter Name">
        <input type="hidden" class="form-control form-reserve" name="reservation_id1" id="reservation_id1" value="<?php echo $dt->reservation_id ?>" placeholder="Enter Name">
    </div>
    <div class="form-group">
        <label>Amoun Paid :</label>
        <input type="text" class="form-control form-reserve" name="reservation_amount_paid" id="reservation_amount_paid" value="" placeholder="Jumlah Transfer">
    </div>
    <div class="form-group">
        <button class="btn btn-success btn-sub" type="submit" name="button">SUBMIT NOW</button>
    </div>
    <?php
}else {
    echo'
    <div class="container blank">
        <div class="row">
        <h4><center style="color:red;"> Nomor Reservasi ini sudah kadaluarsa / Sudah Terbayar  </center></h4>
        </div>
  </div>
    ';
}

?>
