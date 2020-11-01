<section class="content">
    <ol class="breadcrumb breadcrumb-col-blue">
        <li><a href="<?= ADMIN_URL ?>"><i class="material-icons">home</i> Home</a></li>
        <li class="active"> Settings</li>
    </ol>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            GENERAL SETTINGS
                        </h2>
                    </div>
                    <div class="body">
                        <form id="clientForm" method="post" action="<?= ADMIN_URL ?>settings">
                            <div class="row clearfix">
                                <?php foreach ($configs as $key => $config) : ?>
                                    <div class="col-sm-6">
                                        <div class="form-group form-float">
                                            <div class="form-line <?= form_error($config->field) != '' ? 'error' : '' ?>">
                                                <input type="text" class="form-control" name="<?= $config->field ?>" id="<?= $config->field ?>" value="<?= $config->value ?>" required>
                                                <label class="form-label" for="<?= $config->field ?>"><?= $config->title ?> *</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>    
                            </div>                                
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn bg-blue waves-effect"><i class="material-icons">done</i> <span>SAVE</span></button>
                                    <a href="javascript:;" onclick="window.history.back()" class="btn btn-default waves-effect pull-right"><i class="material-icons">undo</i> <span>BACK</span></a>
                                </div>
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="alert alert-danger" id="error_message" role="alert" <?= isset($form_error) ? '' : 'style="display:none"' ?>>
                                        <span class="message"><?= isset($form_error) ? $form_error : '' ?></span>
                                    </div>
                                    <div class="alert alert-success" id="success_message" role="alert" <?= isset($success_message) ? '' : 'style="display:none"' ?>>
                                        <span class="message"><?= isset($success_message) ? $success_message : '' ?></span>
                                    </div>
                                </div>
                            </div>    
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
<script type="text/javascript">
$(function () {
    var $loader = $('.page-loader-wrapper');

    var validator = $('#clientForm').validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function(form) {
            $loader.show();
            $('#success_message, #error_message').hide();
            var formData = new FormData($('#clientForm')[0]);
            formData.append( 'isAjax', '1' );
            $.ajax({
                url: '<?= ADMIN_URL ?>settings',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response) {
                    let result = JSON.parse(response);
                    if(result.status == 'success') {
                        showNotification(result.message, 'bg-green');
                    } else {
                        $('#error_message .message').html(result.message);
                        $('#error_message').fadeIn(500, function () {
                            $(this).fadeOut(5000);
                        });
                    }
                    $loader.hide();
                },
                error: function() {
                    $('#error_message .message').html('ERROR!!!');
                    $('#error_message').fadeIn(500, function () {
                        $(this).fadeOut(5000);
                    });
                    $loader.hide();
                }
            });
        }
    });

    //validator.destroy();
});
</script>