<!--Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
  <?php echo $this->session->unset_userdata('msg'); ?>  
 
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
                  <th>layout_name</th>
                  <th>description</th>
                  <th>zone1</th>
                  <th>zone2</th> 
                  <th>zone3</th>
                  <th>zone4</th>
                  <th>zone5</th>
                  <th>zone6</th>
                  <th>zone7</th>
                  <th>zone8</th>
                   <th>zone9</th>
                  <th>zone10</th>
                  <th>zone11</th>
                  <th>zone12</th>
                  <th>zone13</th>
                  <th>Action</th> 

                </tr>
              </thead>
              <tbody>
                <?php if (!empty($zone)){ 

                foreach ($zone as $key => $value) { ?>
                  <tr>
                    
                     <td><?= $key+1; ?></td>
                     <td>
                      <?= $value['layout_name']; ?>
                    </td>
                                    <td>
                    <?=  $value['description']; ?>  
              </td>
                    <td>
                      <?=  $value['zone1']; ?>
                    </td>
                    <td>
                      <?= $value['zone2']; ?>
                    </td>
                      
                  
                    <td>
                    <?=  $value['zone3']; ?>  
              </td>
               <td>
                    <?=  $value['zone4']; ?>  
              </td>
               <td>
                    <?=  $value['zone5']; ?>  
              </td>
               <td>
                    <?=  $value['zone6']; ?>  
              </td>
               <td>
                    <?=  $value['zone7']; ?>  
              </td>
               <td>
                    <?=  $value['zone8']; ?>  
              </td>
               
                    <td>
                    <?=  $value['zone9']; ?>  
              </td>
               <td>
                    <?=  $value['zone10']; ?>  
              </td>
               <td>
                    <?=  $value['zone11']; ?>  
              </td>
               <td>
                    <?=  $value['zone12']; ?>  
              </td>
               <td>
                    <?=  $value['zone13']; ?>  
              </td>
             <td>   
                <a href="<?= base_url('admin/showStemOnlyList/'.$value['id']); ?>" class="btn btn-info "  ><i class="plus"></i>View</a>
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