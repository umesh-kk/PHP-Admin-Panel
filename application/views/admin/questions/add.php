

  <div class="container">

  <ol class="breadcrumb breadcrumb-col-blue">
    <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fas fa-fw fa-table"></i> Home</a> <i class="fas fa-chevron-right"></i>&nbsp;
    </li>
    <li><a href="<?php echo base_url();?>admin/questions"> Question</a> <i class="fas fa-chevron-right"></i>&nbsp;
    </li>
    <li class="active"> <?php if(!isset($details['question_id'])){ echo "Add new Question";} else { echo "Details";} ?></li>
  </ol>

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="">
                <h1 class="h4 text-gray-900 mb-4">Question Details</h1>
              </div>
              <form class="user" role="form" id="userForm" action="<?php echo ADMIN_URL; ?>questions/add" method="post">

              <input type="hidden"  value="<?php if(isset($details['question_id'])){ echo $details['question_id']; }?>" id="question_id" name="question_id"/>

                
               
               
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Lesson</label>
                  
                    <select name="lesson_id" id="lesson_id" style="width: 100%;" class="form-control" tabindex="-1" aria-hidden="true">
                      <option selected="selected" value="">Select Lesson</option>
                      <?php
                      foreach($lessons as $val){ ?>
                        <option <?php if(isset($details['lesson_id']) && $details['lesson_id'] == $val['lesson_id']){ ?>selected="selected"<?php }  ?> 
                        value="<?php if(isset($val['lesson_id'])){ echo $val['lesson_id']; }?>" ><?php echo $val['title'];?></option>
                      <?php 
                      }
                      ?>
                    </select>


                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Type</label>
                    <select name="answer_type" id="answer_type" style="width: 100%;" class="form-control" tabindex="-1" aria-hidden="true">
                      <option selected="selected" value="">Select Type</option>
                      <option <?php if(isset($details['answer_type']) && $details['answer_type']=='objective'){ ?>selected="selected"<?php }  ?>>Objective</option>
                      <option <?php if(isset($details['answer_type']) && $details['answer_type']=='descriptive'){ ?>selected="selected"<?php }  ?>>Descriptive</option>
                      
                    </select>
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Question</label>
                    <input type="text" class="form-control form-control-user rmerror" id="question" name="question" placeholder="Question" value="<?php if(isset($details['question'])){ echo $details['question']; }?>">
                  </div>
                  
                </div>

                <button type="button" id="saveBtn" style="font-size: 1rem;" class="float-right btn btn-primary btn-user" onclick="validate()">Save Details</button>
                
                <br>
             
              

               
              </form>
             
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
<script>
  function validate(){


    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();


    if(first_name==''){
      $('.rmerror').removeClass('errorborder')
      $('#first_name').addClass('errorborder');
    }else if(last_name==''){
      $('.rmerror').removeClass('errorborder')
      $('#last_name').addClass('errorborder');
    }else{
      $('.rmerror').removeClass('errorborder')
      $("#userForm").submit();
    }
    //applnForm
}
  </script>  
  
  <script type="text/javascript">
      $(function () {
          $('#datetimepicker1').datetimepicker(
            {
                format: 'YYYY-MM-DD',
                date: "<?php if(isset($details['dob'])){ echo $details['dob']; }?>",
                maxDate: Date()
            }
          );
      });
  </script>