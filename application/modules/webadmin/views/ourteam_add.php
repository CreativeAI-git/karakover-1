<script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
<div class="container-fluid">
<div class="height20 clear"></div>
    <div class="pl-0 mb-0">
      <a href="<?= base_url('webadmin/ourteampage'); ?>" class="btn btn-info pull-right "><i class="fa fa-arrow mr-2"></i>Back</a>
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
  
    <form class="form-horizontal" action="<?php if(!empty($ourteam)){ echo site_url('webadmin/ourteam_edit/'.$this->uri->segment(3)); }else{ echo  base_url('webadmin/ourteam_add/'.$this->uri->segment(3));} ?>" method="post"  enctype="multipart/form-data" >
   
      <fieldset>
        <h1 class="h3 mb-3 page-title"><?= $title; ?></h1>
        <div class="form-group" id="main">
        <input type="text" name="title" maxlength="50" class="form-control" placeholder="title" value="<?php if(!empty($ourteam)){ echo $ourteam['title']; } ?>">
        <p><?php echo form_error('title', '<span class="error_msg">', '</span>'); ?></p>  
        </div>
        <div class="form-group" id="main">
        <input type="text" name="name" maxlength="50" class="form-control" placeholder="Name" value="<?php if(!empty($ourteam)){ echo $ourteam['name']; } ?>">
        <p><?php echo form_error('name', '<span class="error_msg">', '</span>'); ?></p>   
        </div>
        <div class="form-group gl_text_black">
          <label class="col-sm-2 control-label label-input-lg">Upload Image</label>
          <div class="col-sm-8" id="image-preview-container">
              <input type="file" name="image" id="gl_cover_art" onchange="previewImages()">
              <br/>
              <div id="image-preview">
                <?php if(!empty($ourteam)){ ?><br/><br/>
                <img class="img-responsive" src="<?php echo base_url('/assets/website/ourteam/'.$ourteam['image']); ?>" height="250px" width="200px">
                <?php } ?>
              </div>
              <span class="gl_cover_art_error" style="color:red"> </span>
              <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
          </div>
        </div>
        <div class="form-group">
          <div class="text-right">
            <?php if(!empty($ourteam)){ ?>
              <input type="hidden" name="id" value="<?php echo $ourteam['id']; ?>">
              <input type="submit" name="submit" value="Update" class="btn btn-success">
            <?php } else { ?>
                <input type="submit" name="submit" value="Add" class="btn btn-success addimg_submit gl_btn_bg_blue" style="min-width: 180px;">
            <?php } ?>    
          </div>
        </div>
      </fieldset>
    </form>
</div>
</div>
</div>
