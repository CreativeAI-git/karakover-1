 <div class="container-fluid">
    <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
<div class="card shadow mb-4">
            <div class="card-body">
<div class="table">
  
  <div class="row">
  	<div class="col-sm-12" style="background: #fff; padding-top: 35px;"> 
      <div class="text-center">
        <?php if($mood['image']){
          $image = base_url('/assets/mood/').$mood['image'];
        }else{
          $image = base_url('assets/uploads/dummy.png');
        }
        ?>
         <img style="width: 140px; height:140px; object-fit: cover;" src="<?= $image; ?>" class="avatar img-circle img-thumbnail" alt="avatar">    
      </div>
      <div class="text-center">
        <?= $mood['full_name']; ?>
      </div>
      <hr><br>
             
     
    </div><!--/col-3-->
  	<div class="col-sm-12" style="background: #fff; padding-bottom: 35px">
      
            
      <div class="tab-content">
        <div class="tab-pane active" id="basic">
          <hr>
          <table class="table table-striped">
            <tr><?php if($user['user_type']==1) { ?>
              <th>Artist Name </th>
              <td><?= $user['artist_name']; ?></td>
              <?php } ?>
            </tr>
            <tr>
              <th class="gl_heading_black">Your Music Mood </th>
              <td class="gl_heading_black"><?= $mood['mood_type']; ?></td>
            </tr>
            
          </table>               	  
          <hr>          
        </div>
       
        <div class="tab-pane" id="upload">
          <hr>
          <div class="row">
            <div class="col-md-6">
              <?php if ($user['driving_license_image']) {  ?>
                <h3>Government Id</h3>
                <img src="<?= base_url('assets/uploads/'.$user['image']); ?>" style="width:50%">
              <?php } ?>
            </div>
            <div class="col-md-6">
              <?php if ($user['passport_image']) {  ?>
                <h3>Certificate </h3>
                <img src="<?= base_url('assets/userfile/profile/'.$user['passport_image']); ?>" style="width:50%">
              <?php } ?>
            </div>
          </div>       
        </div>
      </div>
      <?php if($user['user_type'] == 'Provider' || $user['user_type'] == 'Driver'){ ?>
      <!--   <a href="<?= base_url('admin/provderServices/'.$user['id']); ?>" class="btn btn-success user-request">My Services</a> -->
           <a href="<?= base_url('admin/paymentHistory_provider_year/'.$user['id'].'?type=1'); ?>" class="btn btn-warning user-pym-hist">Payment History</a>

            <a href="<?= base_url('admin/ongoing_services/'.$user['id']); ?>" class="btn btn-warning user-pym-hist">Ongoing Services</a>
      
      
       
        <?php }else{ ?>
        
         <!-- <a href="<?= base_url('admin/userRequest/'.$user['id']); ?>" class="btn btn-success user-request">Requested Service</a>  
        <a href="<?= base_url('admin/paymentHistory/'.$user['id'].'?type=0'); ?>" class="btn btn-warning user-pym-hist">Payment History</a>   -->
        
        
        
        <?php } ?>

<!--
         <a href="<?= base_url('admin/send_single_mail/'.$user['id']); ?>" class="btn btn-warning user-pym-hist">Send mail</a>-->
    </div><!--/col-9-->
  </div>
</div>
</div>
</div>
</div>
 