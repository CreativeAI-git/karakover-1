<style>
.weak-password {color: red}
.strong-password {color: #74b174}
.medium-password {color: orange}

</style>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Profile Edit</h1>
  </div>
  <!-- Content Row -->
  <div class="row">
    <!-- Project Card Example -->
    <div class="card shadow mb-4 col-md-12">
      <div class="card-header">
        <h5 class="pt-3 text-uppercase gl_heading_black"><i class="fa fa-user-circle mr-1"></i> Personal Info</h5>
      </div>
      <div class="card-body gl_text_black">

          <form method="POST" action="<?php if(!empty($admin)){ echo base_url('admin/edit_admin_profile/'.$admin['id']);}else{echo base_url('admin/add_admin_profile');}?>" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" name="first_name" id="firstname" value="<?php echo $admin['first_name'];?>" placeholder="Enter first name" required>
                 <?php echo form_error('first_name', '<span for="first_name" generated="true" class="error_msg">', '</span>'); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" value="<?php echo $admin['last_name'];?>" name="last_name" id="lastname" placeholder="Enter last name" required>
                 <?php echo form_error('last_name', '<span for="last_name" generated="true" class="error_msg">', '</span>'); ?>
              </div>
              </div> <!-- end col -->
              </div> <!-- end row -->
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="userbio">Bio</label>
                    <textarea class="form-control" name="bio" id="userbio" rows="4" placeholder="Write something..." required><?php echo $admin['bio'];?></textarea>
                  </div>
                  </div> <!-- end col -->
                  </div> <!-- end row -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="useremail">Email Address</label>
                        <input type="email" name="email" class="form-control" id="" placeholder="Enter email" value="<?php echo $admin['email'];?>" onkeyup="checkEmail(this)" maxlength="30" required>
                         <span class="error_msg" id="useremail"></span> 
                         <?php echo form_error('email', '<span for="email" generated="true" class="error_msg">', '</span>'); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" >
                        <label for="userpassword">Password</label>
                        <div class="position-relative">
                          <input type="password" class="form-control" name="password" id="userpassword"  placeholder="Enter password" onkeyup="checkPasswordStrength();">
                            <i class="fa fa-eye-slash toggle-password ct_eye_open" toggle="password-field" aria-hidden="true"></i>
                          
                        </div>
                       <span for="password" generated="true" class="error_msg password-strength-status pswrd" ></span>
                         <?php echo form_error('password', '<span for="password" generated="true" class="error_msg">', '</span>'); ?>
                      </div>
                      </div> <!-- end col -->
                      </div> <!-- end row -->
                      <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="useremail">Location</label>
                        <input type="text" name="location" class="form-control" id="useremail" placeholder="Enter Location" value="<?php echo $admin['location'];?>" required>
                      </div>
                    </div>
                 
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="useremail">Mobile number</label>            
                        <input type="text" name="mobile_number" class="form-control"  placeholder="Enter Mobile number" onkeyup="CheckMobile(this)" value="<?php echo $admin['mobile_number'];?>" minlength="7" maxlength="14" required>  
                        <span class="error_msg" id="mobile"></span> 
                      </div>
                    </div>
                      </div> <!-- end row -->



                  <div class="row">
                    
                    <div class="col-md-3 ct_upload_input" >
                      <div class="form-group" id="admin_profile" onclick="myFunction()">
                        <label for="userpassword">Image</label>
                        <input type="file" class="form-control" name="image" id="" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        
                      </div>
                      </div> <!-- end col -->
                     
                          <div class="col-md-3" >
                            <div class="form-group">
                           <?php if(!empty($admin['image'])){?>
                             <img src="<?php echo base_url(); ?>/assets/uploads/<?php echo $admin['image']; ?>" width="100" height="100" id="blah" >
                                <?php } ?>                      
                            </div>
                          </div> <!-- end col -->
                    
                   </div> <!-- end row -->


     <div class="text-right">
            <?php if(!empty($admin)){ ?>
                <input type="hidden" name="admin_id" value="<?php echo $admin['id']; ?>">
                <input type="submit" name="submit" value="Update" class="btn btn-success mt-2 gl_btn_bg_blue submitBtn">
                <?php } else { ?>
                <input type="submit" name="submit" value="Save" class="btn btn-success mt-2 gl_btn_bg_blue">
                <?php } ?>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>
                                <!-- /.container-fluid -->

            
<script type="text/javascript">

  function myFunction() {
   var element = document.querySelector("#admin_profile");
   element.classList.add("show_img");
}
function CheckPassword(inputtxt) 
{ 
  console.log(inputtxt.value);
var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
if(inputtxt.value.match(decimal)) 
{ 
   $('.pswrd').html("");
}
else
{ 
   $('.pswrd').html("Password should contains at least 1 uppercase,lowercase,number and special character");
 return false;
}
} 
function CheckMobile(input_value) 
{ 
var phone_pattern = /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/; 
if(input_value.value != ""){
  if(phone_pattern.test(input_value.value)) 
  { 
     $('#mobile').html("");
  }
  else
  { 
     $('#mobile').html("The number you passed is not a valid phone number");
     return false;
  }
 }
} 

 function checkEmail(useremail)
 {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  //return regex.test(useremail)
   if(regex.test(useremail.value)) 
  { 
     $('#useremail').html("");
  }
  else
  { 
     $('#useremail').html("The Email does not valid");
     return false;
  }
;
}

function checkPasswordStrength() {
  var number = /([0-9])/;
  var alphabets = /([a-zA-Z])/;
  var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
  var password = $('#userpassword').val().trim();

  console.log(password);
  if (password.length < 6) {
     
    $('.password-strength-status').html("Weak (should be atleast 6 characters.)");
    $('.submitBtn').attr('disabled', 'disabled');
  } else {
    if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
       
      $('.password-strength-status').html("");
      $('.submitBtn').prop("disabled", false);
    }
    else {
       
      $('.password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
            $('.submitBtn').attr('disabled', 'disabled');
    }
  }
  }

</script>
                            