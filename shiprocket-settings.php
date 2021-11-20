<?php

session_start();
include_once('includes/custom-functions.php');
$function = new custom_functions;
// set time for session timeout
$currentTime = time() + 25200;
$expired = 3600;

// if session not set go to login page
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}

// if current time is more than session timeout back to login page
if ($currentTime > $_SESSION['timeout']) {
    session_destroy();
    header("location:index.php");
}

// destroy previous session timeout and create new one
unset($_SESSION['timeout']);
$_SESSION['timeout'] = $currentTime + $expired;
$store_settings = $function->get_settings('shiprocket', true);
include "header.php"; ?>
<html>

<head>
    <title>Shiprocket Settings | <?= $settings['app_name'] ?> - Dashboard</title>
</head>
</body>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">

        <h2>Shiprocket Settings</h2>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
        </ol>
        <hr />
    </section>
    <?php if ($permissions['settings']['read'] == 1) { ?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Shiprocket Settings</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="col-md-12">
                                <form method="post" id="shiprocket_settings_form">
                                <input type="hidden" id="shiprocket_settings" name="shiprocket_settings" required="" value="1" aria-required="true">
                                    <div class="row">

                                        <div class="form-group col-md-12">
                                            <label for="">Standard delivery method (Shiprocket) <small>( Enable/Disable ) <a href="https://app.shiprocket.in/api-user" target="_blank">Click here</a> to get credentials. <a href="https://www.shiprocket.in/" target="_blank">What is shiprocket?</a></small></label><br>
                                            <input type="checkbox" id="shiprocket_btn" class="js-switch" <?= isset($store_settings['shiprocket']) && $store_settings['shiprocket'] == '1' ? "checked" : "" ?>>
                                            <input type="hidden" id="shiprocket" name="shiprocket" value="<?= isset($store_settings['shiprocket']) && $store_settings['shiprocket'] == '1' ? $store_settings['shiprocket'] : 0; ?>">
                                        </div>
                                        <?php $dnone = isset($store_settings['shiprocket']) && $store_settings['shiprocket'] == '1' ? '' : 'd-none' ?>
                                        <div class="form-group col-md-3">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" name="shiprocket_email" id="shiprocket_email" value="<?= $store_settings['shiprocket_email'] ?>" placeholder='Shiprocket account email' />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="">Password</label>
                                            <input type="password" class="form-control" name="shiprocket_password" id="shiprocket_password" value="<?= $store_settings['shiprocket_password'] ?>" placeholder='Shiprocket account password' />
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="submit" id="btn_update" class="btn-primary btn" value="Save" name="btn_update" />
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div id="result"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    <?php } else { ?>
        <div class="alert alert-danger">You have no permission to view settings</div>
    <?php } ?>
    <div class="separator"> </div>
</div><!-- /.content-wrapper -->
</body>
<script>
    var changeCheckbox = document.querySelector('#shiprocket_btn');
    var init = new Switchery(changeCheckbox);
    changeCheckbox.onchange = function() {
        if ($(this).is(':checked')) {
            // $(".shiprocket_email").show();
            // $(".shiprocket_password").show();
            $('#shiprocket').val(1);

        } else {
            // $(".shiprocket_email").hide();
            // $(".shiprocket_password").hide();
            $('#shiprocket').val(0);
        }
    };
</script>
<script>
    $('#shiprocket_settings_form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'public/db-operation.php',
            data: formData,
            beforeSend: function() {
                $('#btn_update').val('Please wait..').attr('disabled', true);
            },
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                $('#result').html(result);
                $('#result').show().delay(5000).fadeOut();
                $('#btn_update').val('Save').attr('disabled', false);
            }
        });
    });
</script>

</html>
<?php include "footer.php"; ?>