<section class="content">
    <ol class="breadcrumb breadcrumb-col-blue">
        <li><a href="<?= ADMIN_URL ?>"><i class="material-icons">home</i> Home</a></li>
        <li><a href="<?= ADMIN_URL ?>settings/emails"><i class="material-icons">people</i> Email Templates</a></li>
        <li class="active"> Edit Email Template</li>
    </ol>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit Email Template
                        </h2>
                    </div>
                    <div class="body">
                        <form id="clientForm" method="post" action="<?= ADMIN_URL ?>settings/edit/<?= $mail_id ?>">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line <?= form_error('email_title') != '' ? 'error' : '' ?>">
                                            <input type="text" class="form-control" name="email_title" id="email_title" value="<?= set_value('email_title') ? set_value('email_title') : $record->email_title; ?>" required>
                                            <label class="form-label" for="email_title">Email Title *</label>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line <?= form_error('email_subject') != '' ? 'error' : '' ?>">
                                            <input type="text" class="form-control" name="email_subject" id="email_subject" value="<?= set_value('email_subject') ? set_value('email_subject') : $record->email_subject; ?>" required>
                                            <label class="form-label" for="email_subject">Email Subject *</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line <?= form_error('email_template') != '' ? 'error' : '' ?>">
                                            <textarea class="form-control" name="email_template" id="ckeditor"><?= set_value('email_template') ? set_value('email_template') : $record->email_template; ?></textarea>
                                            <label class="form-label" for="email_template">Email Template</label>
                                        </div>
                                    </div>
                                </div>


                                
                                
                                <div class="col-sm-12 text-center">
                                   <!--  <button type="submit" class="btn bg-blue waves-effect"><i class="material-icons">done</i> <span>SAVE</span></button> -->
                                    <a href="javascript:;" onclick="window.history.back()" class="btn btn-default waves-effect"><i class="material-icons">undo</i> <span>BACK</span></a>
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

 <script src="<?= base_url() ?>assets/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(function () {
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;
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
            for (instance in CKEDITOR.instances) {
             CKEDITOR.instances[instance].updateElement();
             }
            $('#success_message, #error_message').hide();
            var formData = new FormData($('#clientForm')[0]);
            formData.append( 'isAjax', '1' );
            $.ajax({
                url: '<?= ADMIN_URL ?>settings/edit/<?= $mail_id ?>',
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
});
</script>
