<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>DIGTALRESERVATION</title>

<!-- Bootstrap -->
<link href="<?php echo base_url() ?>/front/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>/front/assets/css/styles.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500i,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,700" rel="stylesheet">
<link href="<?php echo base_url() ?>/front/assets/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>/front/assets/css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo base_url() ?>/front/assets/css/owl.theme.css" rel="stylesheet">
<link href="<?php echo base_url() ?>/front/assets/css/colorbox.css" rel="stylesheet">
<link href="<?php echo base_url() ?>/front/assets/css/responsive.css" rel="stylesheet">
<link href="<?php echo base_url() ?>/front/assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/global/plugins/bootstrap-sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/global/plugins/bootstrap-toastr/toastr.min.css">
<link href="<?php echo base_url() ?>front/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>front/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/front/assets/css/bootstrap-timepicker.css" rel="stylesheet">


<script src="<?php echo base_url() ?>/front/assets/js/jquery.js"></script>
<script src="<?php echo base_url() ?>/front/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>/front/assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url() ?>/front/assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>/front/assets/js/owl.carousel.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url() ?>/front/assets/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url() ?>/front/assets/js/jquery.colorbox.js"></script>
<script src="<?php echo base_url() ?>/front/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url() ?>/front/assets/js/jquery.downCount.js"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/awank/scripts/front_validation.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-toastr/custom_toast.js"></script>
<script src="<?php echo base_url() ?>front/assets/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>front/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>


<script type="text/javascript">
    //jQuery to collapse the navbar on scroll
    $(window).scroll(function() {
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
        }
    });

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $(function() {
        $('a.page-scroll').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top -60
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });



    $(document).bind('cbox_complete', function(){
        var cboxTitleHeight = $('#cboxTitle').height();
        var cboxContentHeight = $('#cboxContent').height();
        var cboxWrapperHeight = $('#cboxWrapper').height();
        var colorboxHeight = $('#colorbox').height();

        $('#cboxMiddleLeft, #cboxMiddleRight, #cboxContent').css('height', (cboxContentHeight + cboxTitleHeight) + 'px');
        $('#cboxWrapper').css('height', (cboxWrapperHeight + cboxTitleHeight) + 'px');
        $('#colorbox').css('height', (colorboxHeight + cboxTitleHeight) + 'px');
    });

    $('.selectpicker').selectpicker({
    style: 'btn-select',
    size: 8
    });




    /* ============ Count Down ================*/

</script>
