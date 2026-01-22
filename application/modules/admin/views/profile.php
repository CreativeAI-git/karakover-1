<style type="text/css">
         
    .bg-primary {
        background-color: #21323a!important
    }
</style>

        <div class="container">
            <?php if($this->session->flashdata('success')) 
                {
                    echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>';
                    $this->session->unset_userdata ( 'success' ) ;
                }
                else if($this->session->flashdata('danger')) 
                {
                    echo '<p class="alert alert-danger">'.$this->session->flashdata('danger').'</p>'; 
                    $this->session->unset_userdata ( 'danger' ) ;
                }
            ?>
        </div>

        <div class="container-fluid">
          <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title mb-3">Profile</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Profile -->
                                <div class="card bg-primary">
                                    <div class="card-body profile-user-box">

                                        <div class="row align-items-center">
                                            <div class="col-sm-8">
                                                <div class="media">
                                                    <span class="float-left m-2 mr-4"><img src="<?php echo base_url(); ?>/assets/uploads/<?php echo $admin['image']; ?>" style="height: 100px;" alt="" class="rounded-circle img-thumbnail"></span>
                                                    <div class="media-body">

                                                        <h4 class="mt-1 mb-1 text-white"><?php echo $admin['first_name'].' '.$admin['last_name'];?></h4>
                                               
                                                    </div> <!-- end media-body-->
                                                </div>
                                            </div> <!-- end col-->

                                            <div class="col-sm-4">
                                                <div class="text-center mt-sm-0 mt-3 text-sm-right">
                                                    <a href="<?php echo base_url('admin/admineditprofile/').$admin_id;?>" class="btn btn-light">
                                                        <i class="fa fa-user-edit mr-1"></i> Edit Profile
                                                    </a>
                                                </div>
                                            </div> <!-- end col-->
                                        </div> <!-- end row -->

                                    </div> <!-- end card-body/ profile-user-box-->
                                </div><!--end profile/ card -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <!-- Personal-Information -->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3 gl_heading_black">Information</h4>
                                        <p class="text-muted font-13">
                                            <?php echo $admin['bio']; ?>
                                        </p>

                                        <hr/>

                                        <div class="text-left">
                                            <p class="gl_heading_black"><strong>Full Name :</strong> <span class="ml-2"><?php echo $admin['first_name'].' '.$admin['last_name'];?></span></p>

                                            <p class="gl_heading_black"><strong>Mobile :</strong><span class="ml-2"><?php echo $admin['mobile_number'];?></span></p>

                                            <p class="gl_heading_black"><strong>Email :</strong> <span class="ml-2"><?php echo $admin['email'];?></span></p>

                                            <p class="gl_heading_black"><strong>Location :</strong> <span class="ml-2"><?php echo $admin['location'];?></span></p>

                                            <p class="gl_heading_black"><strong>Languages :</strong>
                                                <span class="ml-2"> <?php echo $admin['language'];?> </span>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                               
                            </div> <!-- end col-->                            

                        </div>
                        <!-- end row -->

        </div>
        <!-- /.container-fluid -->