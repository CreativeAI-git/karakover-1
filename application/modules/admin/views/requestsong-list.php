<!--Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="gl_flex_between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <?php echo $this->session->unset_userdata('msg'); ?>  
    <div class="d-flex align-items-center">
      <div class="pr-2 ">
      </div>   
      <div class="pl-0 ">
      </div>  
    </div> 
  </div>

  <div class="container">
      <?php if($this->session->flashdata('success'))  {
                echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>' ; 
                $this->session->unset_userdata( 'success' ) ;

            } else if($this->session->flashdata('danger')) {

                echo '<p class="alert alert-danger">'.$this->session->flashdata('danger').'</p>' ; 
                $this->session->unset_userdata( 'danger' ) ;
        }
      ?>
   </div>

  
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Request User_Name</th>
                  <th>Request Message</th>
                  <th>Request Date</th>
                  <th style="min-width: 150px;">Action</th>
                   
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($requestsong)){ 
                  foreach ($requestsong as $key => $value) { ?>
                  <tr>
                    
                    <td><?= $key+1; ?></td>
                    <td>
                      <?= ucwords(user_full_name($value['user_id'])); ?>
                    </td>
                    <td>
                    <?= $value['message']; ?>
                    </td>
                    <td>
                    <?= date('d/m/Y h:i:s a',strtotime($value['created_at'])); ?>
                    </td>
                    <td>
                     <a href="<?= base_url('admin/deleterequestsong/'.$value['id']); ?>" onclick="return confirm('Are you sure you want to delete this data?');" class="btn btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                     <!-- <a href="<?= base_url('admin/editUploadSongs/'.$value['id']); ?>"  class="btn btn-warning ml-0" title="" ><i class="fa fa-edit"></i></a>       -->
                    </td>   
                  </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content