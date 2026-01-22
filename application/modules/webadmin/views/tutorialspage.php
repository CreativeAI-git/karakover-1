<script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
<div class="container-fluid">
<div class="height20 clear"></div>
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
  
   <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php if(!empty($tutorial[0])){ echo base_url('webadmin/tutorial_edit');}else{
          echo  base_url('webadmin/tutorial_edit');
        } ?>" >
      <fieldset>
        <h1 class="h3 mb-3 page-title"><?= $title; ?></h1>
        <div class="form-group" id="main">
          <textarea class="form-control ckeditor" rows="20" name="details" required><?php echo $tutorial[0]['details']; ?></textarea>
          <?php echo form_error('details', '<span class="error_msg">', '</span>'); ?>
        </div>
        <div class="form-group gl_text_black">
          <label class="col-sm-2 control-label label-input-lg">upload Image</label>
          <div class="col-sm-8" id="image-preview-container">
              <input type="file" name="image" id="gl_cover_art" onchange="previewImages()">
              <br/>
              <div id="image-preview">
                <?php if(!empty($tutorial[0])){ ?><br/><br/>
                <img class="img-responsive" src="<?php echo base_url('/assets/website/tutorial/'.$tutorial[0]['image']); ?>" height="250px" width="200px">
                <?php } ?>
              </div>
              <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
          </div>
        </div>
        
       
        <div class="form-group">
          <div class="text-right">
           <?php if(!empty($tutorial[0])){ ?>
                <input type="hidden" name="id" value="<?php echo $tutorial[0]['id']; ?>">
                <input type="submit" name="submit" value="Update" class="btn btn-success gl_btn_bg_blue" style="min-width: 180px;">
                <?php } else { ?>
                <input type="submit" name="submit" value="Add" class="btn btn-success gl_btn_bg_blue" style="min-width: 180px;">
                <?php } ?>
          </div>
        </div>
      </fieldset>
    </form>
</div>
</div>
</div>
