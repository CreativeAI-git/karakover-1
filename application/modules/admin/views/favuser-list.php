<!--Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
   
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
   
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>User Name</th>
                  <th>Artist Name</th>
                  <th>Date/Time</th>
                  <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($favuser)){ 

                foreach ($favuser as $key => $value) { ?>
                  <tr>
                    
                     <td><?= $key+1; ?></td>
                     <td>
                      <?= user_full_name($value['user_id']); ?>
                    </td>
                    <td>
                      <?= artist_full_name($value['artist_id']); ?>
                    </td>
                  
                    <td>
                    <?= date("d-M-Y", strtotime($value['created_at'])); ?>  
              </td>
                 <!--<td>
                  <a href="#" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger" title="delete"><i class="fa fa-trash"></i></a> -->
       <!-- <a href=" #" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>                  
       <a href="#"  class="btn btn-warning ml-0" title="" ><i class="fa fa-edit"></i></a>   </td> -->
                    </tr>
                  <?php }
            } ?>
              </tbody>
            </table>
          </div>
        </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content