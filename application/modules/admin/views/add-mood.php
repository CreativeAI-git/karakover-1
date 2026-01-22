

<div class="container-fluid">

          <!-- Page Heading -->

          <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

          <!-- DataTales Example -->

          <div class="card shadow mb-4">

            <div class="card-body">

<div class="col-md-12"> 

        <div class="alertfailurfile"></div>

    <?php echo $this->session->userdata('msg'); ?> 

<form class="form-horizontal" method="post"  action="<?php if(!empty($mood)){ echo site_url('admin/edit_moodtype/'.$this->uri->segment(3));}else{
          echo  base_url('admin/add_mood/');
        } ?>"  enctype="multipart/form-data" >
        <h3 class="text-center gl_heading_black"><?= $title; ?></h3><br>
       <div class="form-group gl_text_black">
          <label class="col-sm-2 control-label">Mood Name</label>
          <div class="col-sm-12">
            <input type="text" name="mood_type"  class="form-control"  placeholder="Enter Your mood type" 
            value="<?php if(!empty($mood)){ echo $mood['mood_type']; } ?>"
            > 
         <p><?php echo form_error('mood_type', '<span class="error_msg">', '</span>'); ?></p>      
          </div>
        </div>
        <div class="form-group gl_text_black">
                  <label class="col-sm-2 control-label label-input-lg">Mood Image</label>
                  <div class="col-sm-8">
                    <input type="file" name="image" class="gl_heading_black" id="gl_cover_art" onchange="myFunction()" >
                    <?php if(!empty($mood)){ ?>
                      <br/>
                      <br/> <img class="img-responsive" src="<?php echo base_url('assets/mood/'.$mood['image']); ?>" height="250px" width="200" id="blah">
                      <?php }else{ ?>
                     <br/>
                      <br/> <img class="img-responsive" src="<?php echo base_url('assets/uploads/dummy.png');?>" height="250px" width="200" id="blah">
                      <?php } ?>
                      <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
                  </div>
                </div>
        <div class="col-sm-offset-2">
          <?php if(!empty($mood)){ ?>
            <input type="hidden" name="id" value="<?php echo $mood['id']; ?>">
                <input type="submit" name="submit" value="Update" class="btn btn-success gl_btn_bg_blue">
                <?php } else { ?>
                <input type="submit" name="submit" value="Add" class="btn btn-success gl_btn_bg_blue">
                <?php } ?>
            </div>
      </form>
     </div>
    </div>
        </div>

        </div>
        <script type="text/javascript">

  function myFunction() {
   var element = document.querySelector("#admin_profile");
   element.classList.add("show_img");
}


</script>
 
