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
  
    <form class="form-horizontal" action="<?php if(!empty($footer[0])){ echo site_url('webadmin/footer_edit/'.$this->uri->segment(3)); }else{ echo  base_url('webadmin/footer_add/'.$this->uri->segment(3));} ?>" method="post"  enctype="multipart/form-data" >
   
      <fieldset>
        <h1 class="h3 mb-3 page-title"><?= $title; ?></h1>
        <div class="form-group" id="main">
          <textarea class="form-control ckeditor" rows="20" name="address" ><?php if(!empty($footer[0])){ echo $footer[0]['address']; } ?></textarea>
          <p><?php echo form_error('address', '<span class="error_msg">', '</span>'); ?></p> 
        </div>
        <div class="form-group" id="main">
          <textarea class="form-control ckeditor" rows="20" name="details" ><?php if(!empty($footer[0])){ echo $footer[0]['details']; } ?></textarea>
          <p><?php echo form_error('details', '<span class="error_msg">', '</span>'); ?></p> 
        </div>
        <div class="form-group" id="main">
        <input type="text" name="number" maxlength="12" class="form-control" placeholder="Number" value="<?php if(!empty($footer[0])){ echo $footer[0]['number']; } ?>">
        <p><?php echo form_error('number', '<span class="error_msg">', '</span>'); ?></p>   
        </div>
        <div class="form-group">
          <div class="text-right">
            <?php if(!empty($footer[0])){ ?>
              <input type="hidden" name="id" value="<?php echo $footer[0]['id']; ?>">
              <input type="submit" name="submit" value="Update" class="btn btn-success">
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
