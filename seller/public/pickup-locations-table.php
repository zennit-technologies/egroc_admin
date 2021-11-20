<?php
include_once('includes/functions.php');
include_once('includes/custom-functions.php');
$fn = new custom_functions;
$seller_id = $_SESSION['seller_id'];
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<section class="content-header">
    <h1>Add pickup location</h1>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add pickup location</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="../../api-firebase/order-process.php" method="post" id="pickup_location_form">
                    <input type="hidden" name="add_pickup_location" value="1">
                    <input type="hidden" name="seller_id" value="<?= $seller_id ?>">
                    <input type="hidden" name="accesskey" value="90336">
                    <div class="box-body">
                        <div class="col-md-3 form-group">
                            <label for="">Pickup location <small>(Ex. Home)</small></label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="pickup_location" placeholder="Nickname of the new pickup location. Max 8 characters">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Name <small>(Ex. Deadpool)</small></label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="name" placeholder="The shipper's name">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">email <small>(Ex. deadpool@chimichanga.com)</small></label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="email" placeholder="The shipper's email address">
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="">Phone <small>(Ex. 9777777779)</small></label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="phone" placeholder="Shipper's phone number">
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="">City <small>(Ex. Pune)</small></label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="city" placeholder="Pickup location city name">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">State <small>(Ex. Maharashtra)</small></label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="state" placeholder="Pickup location state name">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Country <small>(Ex. India)</small></label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="country" placeholder="Pickup location country">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Pincode <small>(Ex. 110022)</small></label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="pin_code" placeholder="Pickup location pincode">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Address <small>(Ex. Mutant Facility, Sector 3)</small></label><i class="text-danger asterik">*</i>
                            <textarea class="form-control" name="address" placeholder="Shipper's primary address. Min 10 characters Max 80 characters"></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Address 2 <small>(Ex. House number 34
                                    )</small></label>
                            <textarea class="form-control" name="address_2" placeholder="Additional address details"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Latitude <small>(Ex. 22.4064)</small></label>
                            <input type="text" class="form-control" name="latitude" placeholder="Pickup location latitude">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Longitude <small>(Ex. 69.0747)</small></label>
                            <input type="text" class="form-control" name="longitude" placeholder="Pickup location longitude">
                        </div>
                        <div class="col-md-12 form-group">
                            <div id="result"></div>
                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="add_btn">Add</button>
                        <input type="reset" class="btn-warning btn" value="Clear" />
                    </div>

                </form>
            </div><!-- /.box -->
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Pickup locations</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover" data-toggle="table" id="pickup-locations" data-url="get-bootstrap-table-data.php?table=pickup-locations" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true" data-show-columns="true" data-side-pagination="server" data-pagination="true" data-search="true" data-trim-on-search="false" data-sort-name="id" data-sort-order="desc" data-show-export="true" data-export-types='["txt","excel"]' data-export-options='{"fileName": "pickup-locations-list-<?= date('d-m-Y') ?>","ignoreColumn": ["operate"] }'>
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="pickup_location" data-sortable="true">Pickup location</th>
                                <th data-field="name" data-sortable="true">Name</th>
                                <th data-field="email" data-visible="false" data-sortable="true">Email</th>
                                <th data-field="phone" data-sortable="true">Phone</th>
                                <th data-field="address" data-visible="false" data-sortable="true">Address</th>
                                <th data-field="address_2" data-visible="false" data-sortable="true">Address 2</th>
                                <th data-field="city" data-sortable="true">City</th>
                                <th data-field="state" data-sortable="true">State</th>
                                <th data-field="country">Country</th>
                                <th data-field="pin_code">Pin code</th>
                                <th data-field="latitude" data-visible="false">Latitude</th>
                                <th data-field="longitude" data-visible="false">Longitude</th>
                                <!-- <th data-field="verified">Status</th> -->
                                <!-- <th data-field="operate" data-events="actionEvents">Action</th> -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('#pickup_location_form').validate({
        rules: {
            pickup_location: {
                required: true,
                maxlength: 8
            },
            name: "required",
            email: "required",
            phone: "required",
            address: "required",
            city: "required",
            state: "required",
            country: "required",
            pin_code: "required",

        }
    });
</script>
<script>
    $('#pickup_location_form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        if ($("#pickup_location_form").validate().form()) {
            if (confirm('Are you sure?Want to add pickup location')) {
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    beforeSend: function() {
                        $('#add_btn').html('Please wait..').attr('disabled', true);
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(result) {
                        $('#result').html(result.message);
                        $('#result').show().delay(6000).fadeOut();
                        $('#add_btn').html('Add').attr('disabled', false);
                        $('#pickup-locations').bootstrapTable('refresh');
                        if (result.error == false) {
                            $('#pickup_location_form')[0].reset();
                        }

                    }
                });
            }
        }
    });
</script>

<div class="separator"> </div>

<?php $db->disconnect(); ?>