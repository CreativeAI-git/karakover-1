

<div class="container-fluid">

          <!-- Page Heading -->

          <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

          <!-- DataTales Example -->

          <div class="card shadow mb-4">

            <div class="card-body gl_text_black">

<div class="col-md-12"> 

        <div class="alertfailurfile"></div>

    <?php echo $this->session->userdata('msg'); ?> 

<form class="form-horizontal" method="post"  action="<?php if(!empty($user)){ echo site_url('admin/edit_artist/'.$this->uri->segment(3));}else{
          echo  base_url('admin/add_artist/');
        } ?>"  enctype="multipart/form-data" >
        <h3 class="text-center gl_heading_black"><?= $title; ?></h3><br>
       <div class="form-group ">
          <label class="col-sm-2 control-label ">Artist Name</label>
          <div class="col-sm-12">
            <input type="text" name="artist_name"  class="form-control"  placeholder="Enter Artist Name" 
            value="<?php if(!empty($user)){ echo $user['artist_name']; } ?>"
            > 
         <p><?php echo form_error('artist_name', '<span class="error_msg">', '</span>'); ?></p>      
          </div>
        </div>
        <div class="form-group">
                  <label class="col-sm-2 control-label label-input-lg">Artist Image</label>
                  <div class="col-sm-8" id="admin_profile">
                    <input type="file" name="image" class="gl_heading_black" id="gl_cover_art" onchange="myFunction()">
                    <?php if(!empty($user)){ ?>
                      <br/>
                      <br/> <img class="img-responsive" src="<?php echo base_url('assets/artist/'.$user['image']); ?>" height="250px" width="200" id="blah">
                      <?php }else{ ?>
                     <br/>
                      <br/> <img class="img-responsive" src="<?php echo base_url('assets/uploads/dummy.png');?>" height="250px" width="200" id="blah" style="display:none">
                      <?php } ?>
                       <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
                  </div>
                </div>
        <div class="col-sm-offset-2">
          <?php if(!empty($user)){ ?>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
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
 
