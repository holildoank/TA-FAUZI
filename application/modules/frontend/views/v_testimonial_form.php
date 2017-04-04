<?php
if($mode=='edit'){
    $dt = $data_testimonial->row();
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
                    <a href="<?php echo site_url() ?>testimonial">Clients Recommendation</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="javascript:;">Add New Clients Recommendation</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Testimonial
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject bold uppercase"><?php echo $judul ?></span>
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php if ($mode=='add'): ?>
                            <form class="horizontal-form" id="form_testimonial" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Photo</label>
                                                <input type="file" name="testimonial_photo" id="testimonial_photo" class="form-control file" value="<?php echo base_url().'/uploads/testimonial/'.@$dt->testimonial_photo ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Name *</label>
                                                <input type="text" name="testimonial_name" rows="2" id="testimonial_name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Description *</label>
                                                <textarea name="testimonial_desc" rows="2" id="testimonial_desc" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Is Active *</label>
                                                <select class="form-control" name="testimonial_active" id="testimonial_active">
                                                    <option value="y">Yes</option>
                                                    <option value="n">No</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                            if($mode=='add'){
                                                echo '<button type="submit" class="btn blue">Add</button>';
                                            }elseif($mode=='edit'){
                                                echo '<input type="hidden" name="id" value="'.@$dt->testimonial_id.'">';
                                                echo '<button type="submit" class="btn green">Update</button>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php elseif ($mode=='edit'): ?>
                            <form class="horizontal-form" id="form_testimonial_edit" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if (@$dt->testimonial_photo != ''): ?>
                                                <div class="form-group">
                                                    <label class="control-label">Last Pic </label>
                                                    <br>
                                                    <img src="<?php echo base_url().'/uploads/testimonial/'.@$dt->testimonial_photo ?>" alt="" width="200" height="200"/>
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-group">
                                                <label class="control-label">Upload Photo </label>
                                                <input type="file" name="testimonial_photo" id="testimonial_photo" class="form-control file"/>
                                            </div>
                                             <div class="form-group">
                                                <label class="control-label">Name *</label>
                                                <input type="text" name="testimonial_name" rows="2" id="testimonial_name" value="<?php echo @$dt->testimonial_name ?>" class="form-control">
                                            </div>
                                             <div class="form-group">
                                                <label class="control-label">Description *</label>
                                                <textarea name="testimonial_desc" rows="2" id="testimonial_desc" class="form-control"><?php echo @$dt->testimonial_desc ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Is Active*</label>
                                                <select class="form-control" name="testimonial_active" id="testimonial_active">
                                                    <option value="y" <?php echo @$dt->testimonial_active=='y' ? 'selected' : '' ?>>Yes</option>
                                                    <option value="n" <?php echo @$dt->testimonial_active=='n' ? 'selected' : '' ?>>No</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                            if($mode=='add'){
                                                echo '<button type="submit" class="btn blue">Add</button>';
                                            }elseif($mode=='edit'){
                                                echo '<input type="hidden" name="id" value="'.@$dt->testimonial_id.'">';
                                                echo '<button type="submit" class="btn green">Update</button>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

<div id="modal_form" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div>

<script type="text/javascript">
mode = <?php echo json_encode($mode) ?>;

$.fn.select2.defaults.set( "theme", "bootstrap" );
$('#testimonial_active').select2({});

$("#testimonial_photo").fileinput({
    'showUpload':false,
    'previewFileType':'any',
    allowedFileExtensions : ['jpg', 'jpeg', 'png']
});

function btnInsert () {
    // var formData = $('#form_user').serialize();
  ///form_user di ganti form_testimonial
    var formData = new FormData($('#form_testimonial')[0]);
    $.ajax({
        url: '<?php echo site_url(); ?>/testimonial/create_action',
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
                        window.location.replace('<?php echo site_url() ?>testimonial');
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
    // var formData = $('#form_user').serialize();
    var formData = new FormData($('#form_testimonial_edit')[0]);
    $.ajax({
        url: '<?php echo site_url(); ?>/testimonial/update_action',
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
                        window.location.replace('<?php echo site_url() ?>testimonial');
                    });
        }
    })
    .fail(function() {
        console.log("error");
    });
}

</script>
