<!--Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="gl_flex_between mt-4 mb-3">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <div class="pl-0 mb-0">
      <a href="<?= base_url('admin/add_mood'); ?>" class="btn btn-info pull-right "><i class="fa fa-plus mr-2"></i>Add Music Mood</a>
    </div> 
  </div>
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
                
                   <th>Mood Type</th>
                   <th>Image</th>
                   <th>Date/Time</th>
                   <th>Action</th>
                  <!-- <th style="min-width: 200px;">Action</th> -->
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($mood)){ 

                foreach ($mood as $key => $value) { ?>
                  <tr>
           
                   
                     <td><?= $key+1; ?></td>
                    
                    <td>
                      <?= $value['mood_type']; ?>
                    </td>
                    <td>
                          <?php if(!empty($value['image'])){ ?>
                        
                          <img src="<?= base_url('/assets/mood/').$value['image']; ?>" width="100" height="100">
                           <?php
                        }else{?>
                              <img src="<?= base_url('/assets/uploads/dummy.png').$value['image']; ?>" width="100" height="100">
                        <?php }?>
                        </td>
                    <td>
                      <?= date("d-M-Y", strtotime($value['created_at'])); ?>
                    </td>
                    <td>
                    <a href="<?= base_url('admin/delete_mood/'.$value['id']); ?>" onclick="return confirm('Are you sure you want to delete this music mood?');" class="btn btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                 <a href="<?= base_url('admin/view_mood/'.$value['id']); ?>" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>  
                  <a href="<?= base_url('admin/edit_moodtype/'.$value['id']); ?>"  class="btn btn-warning ml-0" title="" ><i class="fa fa-edit"></i></a>      
              
            </td> 
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