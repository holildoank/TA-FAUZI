<?php
if ($data_jadwal->num_rows() > 0) {
    $dt = $data_jadwal->row();
    // $tgl = $tanggalku->row();
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
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
                                            <i class="fa fa-check"></i> Time Schedula Staff </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                        <span class="number"> 2 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Biodata Reservation </span>
                                    </a>
                                </li>
                                <!-- <li>
                                    <a href="#tab3" data-toggle="tab" class="step active">
                                        <span class="number"> 3 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Billing Setup </span>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="#tab4" data-toggle="tab" class="step">
                                        <span class="number"> 4 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Confirm </span>
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
                                    <h3 class="block">Time Schedule Staff Of product</h3>
                                    <?php foreach ($data_jadwal->result() as $r): ?>
                                        <div class="timeline-item">
                                            <div class="timeline-badge">
                                                <?php echo '<img class="timeline-badge-userpic style="width:30px; height:80px;" src="'.base_url().'/uploads/staff/'.$r->staff_photo.'">'?>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="timeline-body-arrow"> </div>
                                                <div class="timeline-body-head">
                                                    <div class="timeline-body-head-caption">
                                                        <a href="javascript:;" class="timeline-body-title font-blue-madison"><?php echo $r->staff_name ?></a>
                                                        <span class="timeline-body-time font-grey-cascade">Time Wokr <?php echo date('H:i', strtotime(@$r->schedule_starttime)) ?> s/d <?php echo date('H:i', strtotime(@$r->schedule_enddatime)) ?></span>
                                                    </div>
                                                    <div class="timeline-body-head-actions">
                                                        <div class="btn-group">
                                                            <a href="#" class="btn btn-circle green btn-sm dropdown-toggle" data-toggle="modal" data-target="#myModal" onclick="event.preventDefault();btn_detail(<?php echo $r->staff_id ?>);">Cek</a>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-body-content tex-right">
                                                    <div class="form-group">
                                                            <label class="control-label col-md-3">Product And Staff Name
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <input readonly="readonly" type="hidden" name="product_name" id="product_name" value="<?php echo $r->product_name ?>" class="form-control timepicker">
                                                                 </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <input type="hidden" readonly="readonly" name="staff_name" id="staff_name" value="<?php echo $r->staff_name ?>" class="form-control">
                                                                 </div>
                                                            </div>
                                                        </div>
                                                    <div class="form-group">
                                                            <label class="control-label col-md-3">Time
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <input readonly="readonly" min= type="text" name="tanggal" id="tanggal" value="<?php echo $tanggalku ?>" class="form-control timepicker">
                                                                 </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <input type="text" name="jam" id="jam" class="form-control timepicker timepicker-24">
                                                                    <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $r->staff_id ?>" class="form-control">
                                                                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $r->product_id ?>" class="form-control">
                                                                     <span class="input-group-btn">
                                                                         <button class="btn default" type="button">
                                                                             <i class="fa fa-clock-o"></i>
                                                                         </button>
                                                                     </span>
                                                                 </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <h3 class="block">Biodata Reservation</h3>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Fullname
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="customer_name" id="customer_name" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Phone Number
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="customer_phone" id="customer_phone" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="customer_email" id="customer_email" />
                                            <span class="help-block">Dooaankh@gmail.com </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Permintaan Khusus
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <textarea type="text" class="form-control" name="reservation_request" id="reservation_request" /></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane" id="tab3">
                                    <h3 class="block">Provide your billing and credit card details</h3>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Card Holder Name
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="card_name" />
                                            <span class="help-block"> </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Card Number
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="card_number" />
                                            <span class="help-block"> </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">CVC
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" placeholder="" class="form-control" name="card_cvc" />
                                            <span class="help-block"> </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Expiration(MM/YYYY)
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" placeholder="MM/YYYY" maxlength="7" class="form-control" name="card_expiry_date" />
                                            <span class="help-block"> e.g 11/2020 </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Payment Options
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <div class="checkbox-list">
                                                <label>
                                                    <input type="checkbox" name="payment[]" value="1" data-title="Auto-Pay with this Credit Card." /> Auto-Pay with this Credit Card </label>
                                                <label>
                                                    <input type="checkbox" name="payment[]" value="2" data-title="Email me monthly billing." /> Email me monthly billing </label>
                                            </div>
                                            <div id="form_payment_error"> </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="tab-pane" id="tab4">
                                    <h3 class="block">Confirm your Reservation</h3>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Start Reservation Time:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="tanggal"> </p> / <p class="form-control-static" data-display="jam"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Product Name:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="product_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Staff Name:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="staff_name">
                                        </div>
                                    </div>
                                    <h4 class="form-section">Profile</h4>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Name:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="customer_name"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Phone:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="customer_phone"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="customer_email"> </p>
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
                                    <a href="javascript:;" class="btn btn-outline green button-next"> Continue
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    <a href="javascript:;" class="btn green button-submit"> Submit
                                        <i class="fa fa-check"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script src="<?php echo base_url() ?>/assets/awank/scripts/form-wizard.js" type="text/javascript"></script>
<script type="text/javascript">
$(".timepicker-24").timepicker({
    autoclose:!0,
    minuteStep:5,
    showSeconds:!1,
    showMeridian:!1
    });
</script>
<?php
}else {?>
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>Mohon Maaf Tanggal Yang anda pilih Kosong.
    </div>
<?php }

?>
