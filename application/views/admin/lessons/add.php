

  <div class="container">
    <ol class="breadcrumb breadcrumb-col-blue">
      <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fas fa-fw fa-table"></i> Home</a> <i class="fas fa-chevron-right"></i>&nbsp;
      </li>
      <li><a href="<?php echo base_url();?>admin/lessons"> Lessons</a> <i class="fas fa-chevron-right"></i>&nbsp;
      </li>
      <li class="active"><?php if(!isset($details['lesson_id'])){ echo "Add new Lesson";} else { echo "Details";} ?></li>
    </ol>
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="">
                <h1 class="h4 text-gray-900 mb-4">Lesson Details</h1>
              </div>

              <form class="user" role="form" id="userForm" action="<?php echo base_url(); ?>admin/lessons/add" method="post" enctype="multipart/form-data">

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Title</label>
                    <input type="text" class="form-control form-control-user rmerror" id="title" name="title" placeholder="Title" 
                    value="<?php if(isset($details['title'])){ echo $details['title']; }?>">
                  </div>
                </div>
                <?php if(isset($details['video_url'])){ ?>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <iframe width="420" height="315" 
                      src="<?php echo $details['embeded_url'];?>">
                    </iframe>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Youtube Video URL</label>
                    <input type="text" class="form-control form-control-user rmerror" id="video_url" name="video_url" placeholder="Video URL" 
                    value="<?php if(isset($details['video_url'])){ echo $details['video_url']; }?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="pdfFile">Upload PDF</label>
                    <br>
                    <input type="file" id="pdfFile" name="pdfFile"  accept="application/pdf" ><br><span id="fileerror" style="color: #FF0000;"></span>
                  </div>
                  <br>
                </div>
                <br>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea class="form-control form-control-user" name="description" ><?php if(isset($details['description'])){ echo $details['description']; }?></textarea>
                  </div>
                </div>
                <button type="button" id="saveBtn" style="font-size: 1rem;" class="float-right btn btn-primary btn-user" onclick="validate(event)">Save Details</button>
                <br>
                <input type="hidden" id="lesson_id" name="lesson_id" value="<?php if(isset($details['lesson_id'])){ echo $details['lesson_id']; }?>">

              </form>
             
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
<script>
 $(function(){
        $("#pdfFile").on('change', function(event) {
         
            var file = event.target.files[0];
            
            if(!file.type.match('application/pdf')) {
                $('#fileerror').show().text("Please select PDF file.");
                //$("#userForm").get(0).reset(); 
                return;
            }else{
              $('#fileerror').hide().text("");
              // alert("PDF");
            }

            
        });
    });



  function validate(event){
    var lesson_id = $('#lesson_id').val();

    var title = $('#title').val();
    var video_url = $('#video_url').val();
   
    var ext = $("#pdfFile").val().split('.').pop();
    var yVideo = video_url.indexOf("https://www.youtube.com/watch?v=");
    if(title==''){
      $('.rmerror').removeClass('errorborder')
      $('#title').addClass('errorborder');
    }else if(video_url =='' || yVideo == -1){
      $('.rmerror').removeClass('errorborder')
      $('#video_url').addClass('errorborder');
    }else{
      if(lesson_id == ''){
        if(ext != 'pdf' && ext != 'PDF' ){
          $('#fileerror').show().text("Please select PDF file.");
        }else{
          $('.rmerror').removeClass('errorborder')
          $("#userForm").submit();
        }
      }else{
        $('.rmerror').removeClass('errorborder')
        $("#userForm").submit();
      }
        
     
    }
    //applnForm
}
  </script>