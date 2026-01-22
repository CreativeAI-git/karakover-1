<script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
<div class="container-fluid">
<div class="height20 clear"></div>
    <div class="pl-0 mb-0">
      <a href="<?= base_url('webadmin/instrumentpage'); ?>" class="btn btn-info pull-right "><i class="fa fa-arrow mr-2"></i>Back</a>
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
  
    <form class="form-horizontal" action="<?php if(!empty($instrument)){ echo site_url('webadmin/instrument_edit/'.$this->uri->segment(3)); }else{ echo  base_url('webadmin/instrument_add/'.$this->uri->segment(3));} ?>" method="post"  enctype="multipart/form-data" >
   
      <fieldset>
        <h1 class="h3 mb-3 page-title"><?= $title; ?></h1>
        <div class="form-group" id="main">
        <input type="text" name="title" maxlength="50" class="form-control" id="instrument_name"  placeholder="Instrument name" value="<?php if(!empty($instrument)){ echo $instrument['title']; } ?>">
        <span class="error_msg  instrument_name"></span>   
        <p><?php echo form_error('title', '<span class="error_msg">', '</span>'); ?></p>  
        </div>
        <div class="form-group" id="main">
          <textarea class="form-control ckeditor" rows="20" name="details" ><?php echo $instrument['details']; ?></textarea>
          <p><?php echo form_error('details', '<span class="error_msg">', '</span>'); ?></p> 
        </div>
        <div class="form-group gl_text_black">
          <label class="col-sm-2 control-label label-input-lg">instrument Image</label>
          <!-- <div class="col-sm-8" id="">
            <input type="file" name="image[]" id="gl_cover_art" multiple onchange="myFunction()">
              <br/> <img class="img-responsive" src="<?php echo base_url('assets/uploads/dummy.png');?>" height="250px" width="200" id="blah" style="display:none">
              <?php// echo form_error('image', '<span class="error_msg">', '</span>'); ?>
          </div> -->
         
          <div class="col-sm-8" id="image-preview-container">
              <input type="file" name="image" id="gl_cover_art" onchange="previewImages()">
              <br/>
              <div id="image-preview">
                <?php if(!empty($instrument)){ ?><br/><br/>
                <img class="img-responsive" src="<?php echo base_url('/assets/website/instrument/'.$instrument['image']); ?>" height="250px" width="200px">
                <?php } ?>
              </div>
              <span class="gl_cover_art_error" style="color:red"> </span>
              <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
          </div>
        </div>
        <div class="form-group">
          <div class="text-right">
            <?php if(!empty($instrument)){ ?>
              <input type="hidden" name="id" value="<?php echo $instrument['id']; ?>">
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
