

  <div class="container">
  <ol class="breadcrumb breadcrumb-col-blue">
      <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fas fa-fw fa-table"></i> Home</a> <i class="fas fa-chevron-right"></i>&nbsp;
      </li>
      <li><a href="<?php echo base_url();?>admin/musics"> Music</a> <i class="fas fa-chevron-right"></i>&nbsp;
      </li>
      <li class="active"> <?php if(!isset($details['id'])){ echo "Add new Music";} else { echo "Details";} ?></li>
    </ol>
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="">
                <h1 class="h4 text-gray-900 mb-4">Musics Details</h1>
              </div>
              <form class="user" role="form" id="userForm" action="<?php echo base_url(); ?>admin/musics/add" method="post" enctype="multipart/form-data">

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Title</label>
                    <input type="text" class="form-control form-control-user rmerror" id="title" name="title" placeholder="Title" 
                    value="<?php if(isset($details['title'])){ echo $details['title']; }?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="audioFile">Upload Audio</label>
                    <br>
                    <input type="file" id="audioFile" name="audioFile"  accept="audio/mp3" ><br><span id="fileerror" style="color: #FF0000;"></span>
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
                <input type="hidden" id="id" name="id" value="<?php if(isset($details['id'])){ echo $details['id']; }?>">

              </form>
             
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
<script>
    $(function(){
        $("#audioFile").on('change', function(event) {
         
            var file = event.target.files[0];
            console.log(file.type );
            if(!file.type.match('audio/mp3')) {
                $('#fileerror').show().text("Please select mp3 file.");
                //$("#userForm").get(0).reset(); 
                return;
            }else{
              $('#fileerror').hide().text("");
            }

            
        });
    });



  function validate(event){

    var id = $('#id').val();
    var title = $('#title').val();
    var ext = $("#audioFile").val().split('.').pop();
   
    if(title==''){
      $('.rmerror').removeClass('errorborder')
      $('#title').addClass('errorborder');
    }else{
      if(id == ''){
        if(ext =='' || ext != 'mp3'){
          $('.rmerror').removeClass('errorborder')
          $('#audioFile').addClass('errorborder');
        }else{
          $('.rmerror').removeClass('errorborder')
          $("#userForm").submit();
        }
      }else{
        if(ext == '' || ext== 'mp3'){
          $('.rmerror').removeClass('errorborder')
          $("#userForm").submit();
        }else{
          $('#fileerror').show().text("Please select mp3 file.");
        }
        
      }
      
    }
    //applnForm
}
  </script>