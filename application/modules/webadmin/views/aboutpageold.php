<script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
<div class="container-fluid">
<div class="height20 clear"></div>
<div class="col-sm-12"> 
   <div class="container">
      <?php 
        if($this->session->flashdata('success'))  {
          echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>' ; 
          $this->session->unset_userdata ( 'success' ) ;
        } else if($this->session->flashdata('danger')) {
          echo '<p class="alert alert-danger">'.$this->session->flashdata('danger').'</p>' ; 
          $this->session->unset_userdata ( 'danger' ) ;
        }
      ?>
   </div>
  
    <form class="form-horizontal" action="<?php echo base_url('webadmin/addabout');?>" method="post"  enctype="multipart/form-data" >
      <fieldset>
        <h1 class="h3 mb-3 page-title"><?= $title; ?></h1>
        <div class="form-group" id="main">
          <textarea class="form-control ckeditor" rows="20" name="details" required><?php echo $privacy['info']; ?></textarea>
        </div>
        <div class="form-group gl_text_black">
          <label class="col-sm-2 control-label label-input-lg">Category  Image</label>
          <div class="col-sm-8" id="admin_profile">
            <input type="file" name="image" id="gl_cover_art" onchange="myFunction()">
              <br/> <img class="img-responsive" src="<?php echo base_url('assets/uploads/dummy.png');?>" height="250px" width="200" id="blah" style="display:none">
              <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
          </div>
        </div>
        <div class="form-group">
          <div class="text-right">
                <input type="submit" name="submit" value="Add" class="btn btn-success gl_btn_bg_blue" style="min-width: 180px;">
          </div>
        </div>
      </fieldset>
    </form>
</div>
</div>
</div>
