
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<div class="container-fluid">

          <!-- Page Heading -->

          <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

          <!-- DataTales Example -->

          <div class="card shadow mb-4">

            <div class="card-body">

<div class="col-md-12"> 

        <div class="alertfailurfile"></div>

    <?php echo $this->session->userdata('msg'); ?> 

<form class="form-horizontal" method="post"  action="<?php if(!empty($user)){ echo site_url('admin/edit_user/'.$this->uri->segment(3));}else{

          echo  base_url('admin/add_user/');

        } ?>"  enctype="multipart/form-data" >

        <h3 class="text-center"><?= $title; ?></h3><br>
         <div class="form-group">

          <label class="col-sm-2 control-label"> User email </label>

          <div class="col-sm-8">

            <input type="text" name="email"  class="form-control"  placeholder="Enter your email " 

            value="<?php if(!empty($user)){ echo $user['email']; } ?>"

            > 
         <p><?php echo form_error('email`1', '<span class="error_msg">', '</span>'); ?></p> 

          </div>

        </div>
      
        <div class="form-group">

          <label class="col-sm-2 control-label">firstname</label>

          <div class="col-sm-8">
            <input type="text" name="firstname"  class="form-control"  placeholder="Enter your Email" 

            value="<?php if(!empty($user)){ echo $user['firstname']; } ?>"
            > 
         <p><?php echo form_error('firstname', '<span class="error_msg">', '</span>'); ?></p> 

          </div>


        </div>

       
              <div class="form-group">

          <label class="col-sm-2 control-label">lastname</label>

          <div class="col-sm-8">

            <input type="text" name="lastname"  class="form-control"  placeholder="Enter lastname" 

            value="<?php if(!empty($user)){ echo $user['lastname']; } ?>"

            > 
         <p><?php echo form_error('lastname', '<span for="lastname" generated="true" class="error_msg">', '</span>'); ?></p> 

          </div>

        </div>
        
        <div class="form-group">

<label class="col-sm-2 control-label">phone</label>

<div class="col-sm-8">

  <input type="text" name="phone"  class="form-control"  placeholder="Enter phone" 

  value="<?php if(!empty($user)){ echo $user['phone']; } ?>"

  > 
<p><?php echo form_error('phone', '<span for="phone" generated="true" class="error_msg">', '</span>'); ?></p> 

</div>

</div>
<!--Language select -->
  
                       
<!--End -->
           <!--  <div class="form-group">
                  <label class="col-sm-2 control-label label-input-lg">Profile Image</label>
                  <div class="col-sm-8">
                    <input type="file" name="image">
                    <?php if(!empty($user)){ ?>
                      <br/>
                      <br/> <img class="img-responsive" src="<?php echo base_url('/assets/userfile/profile/'.$user['profile_image']); ?>" height="250px" width="200">
                      <?php }                    ?>
                      <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
                  </div>
                </div>-->
    
        <div class="col-sm-offset-2">
          <?php if(!empty($user)){ ?>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <input type="submit" name="submit" value="Update" class="btn btn-success">
                <?php } else { ?>
                <input type="submit" name="submit" value="Add" class="btn btn-success">
                <?php } ?>
            </div>
      </form>
     </div>
    </div>
        </div>

        </div>







