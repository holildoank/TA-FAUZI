<div class="container-fluid title-container">
    <div class="container">
        <div class="title-single">
            <h2>BOOKING LIST</h2>
            <p>THIS IS BOOKING LIST</p>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url() ?>">Home</a></li>
                <li class="active">Booking List</li>
            </ol>
        </div>
    </div>
</div>

<div class="container blank">
    <table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Stylish</th>
                <th>Service</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
</div>
<script type="text/javascript">
table = $('#example').DataTable({
    buttons: [

    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('reservation/list_front')?>",
        "type": "POST",
        data: function (d) {
        }
    },

    "columns": [

        {"orderable": false},
        {"orderable": true},
        {"orderable": true},
        {"orderable": true},
        {"orderable": true},
        {"orderable": true},
    ],
    "order": [
        [2, "asc"]
    ],
    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

});
$('.filter').change(function(event) {
    table.ajax.reload();
});


</script>
