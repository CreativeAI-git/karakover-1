<script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
<div class="container-fluid">
    <div class="height20 clear"></div>
    <div class="pl-0 mb-0">
      <!-- <a href="<?= base_url('webadmin/instrumentpage'); ?>" class="btn btn-info pull-right "><i class="fa fa-arrow mr-2"></i>Back</a> -->
      <h1 class="h3 mb-3 page-title"><?= $title; ?></h1>
    </div> 
  <div class="col-sm-12"> 
   <div class="container">
      <?php if($this->session->flashdata('success'))  {
                echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>' ; 
                $this->session->unset_userdata ( 'success' ) ;

            } else if($this->session->flashdata('danger')) {

                echo '<p class="alert alert-danger">'.$this->session->flashdata('danger').'</p>' ; 
                $this->session->unset_userdata ( 'danger' ) ;
        }
      ?>
   </div>
  
   <?php 
    if(!empty($tutorial)){
      foreach($tutorial as $key => $value){   ?>
    <form class="form-horizontal" action="<?php if(!empty($tutorial)){ echo site_url('webadmin/bg_image_change_edit/'.$this->uri->segment(3)); }else{ echo  base_url('webadmin/bg_image_change_edit/'.$this->uri->segment(3));} ?>" method="post"  enctype="multipart/form-data" >
      <fieldset>
        <?php if($key==0){ ?>
        <div class="form-group gl_text_black">
          <label class="col-sm-2 control-label label-input-lg">Home BgImage</label>
          <div class="col-sm-8" id="image-preview-container">
              <input type="file" name="image" id="gl_cover_art"  onchange="previewImages()">
              <br/>
              <div id="image-preview<?php echo ($key==0)?'':$key; ?>">
              <img class="img-responsive" src="<?php echo base_url('/assets/website/bgimage/'.$value['image']); ?>" height="250px" width="200px">
              </div>
              <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
          </div>
        </div>
        <?php }else{ ?>
          <div class="form-group gl_text_black">
            <label class="col-sm-2 control-label label-input-lg">Other BgImage</label>
            <div class="col-sm-8" id="image-preview-container">
                <input type="file" name="image" id="gl_cover_art1"  onchange="previewImages1()">
                <br/>
                <div id="image-preview<?php echo $key; ?>">
                <img class="img-responsive" src="<?php echo base_url('/assets/website/bgimage/'.$value['image']); ?>" height="250px" width="200px">
                </div>
                <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
            </div>
          </div>
        <?php } ?>
        <div class="form-group">
          <div class="text-right">
            <?php if(!empty($tutorial)){ ?>
              <input type="hidden" name="title" value="<?php echo $value['title']; ?>">
              <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
              <input type="submit" name="submit" value="Update" class="btn btn-success">
            <?php } else { ?>
                <input type="submit" name="submit" value="Add" class="btn btn-success gl_btn_bg_blue" style="min-width: 180px;">
            <?php } ?>    
          </div>
        </div>
      </fieldset>
    </form>
    <?php }} ?>

  </div>
</div>
</div>
