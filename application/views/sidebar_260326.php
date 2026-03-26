         <style>
         .ct_inner_drop a.collapse-item {
    display: block;
    padding: 0.5rem 1rem;
        margin: 5px;
    text-decoration: none;
    font-weight: 600;
    border-radius: 0.35rem;
    white-space: nowrap;
    font-size:13.6px;
}
            
.ct_inner_drop a:hover {
    background-color: #0D8EC5!important;
    background-image: none;
    transition: .5s;
    padding-left: 1.3rem;
    color: #fff !important;
    font-weight: 600;
}

         </style>
         <!-- Sidebar -->
         <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
          <!-- Sidebar - Brand -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="
		      <?php echo base_url('admin/dashboard'); ?>">
           <div class="sidebar-brand-text mx-8" style="inline-size: -webkit-fill-available;">
            <img src="<?php echo base_url(); ?>assets/logo-icon.png" alt="..." class="img-fluid" >
           </div>
           <div class="sidebar-brand-text mx-2">
            <img src="<?php echo base_url(); ?>assets/logo.png" alt="..." class="img-fluid" >
           </div>
          </a> 
          <?php
            $session = $this->session->userdata('admin');
            $admin_id = $session['id'];
            $data = $this->common->getData('admin',array('id',$admin_id),array('single'));

            $fullname = $session['full_name'];
            $image = $session['image'];
            $is_admin = $session['is_admin'];
            $siteUrlUri = $this->uri->segment('2');
            $siteSubUrlUri = $this->uri->segment('3');
          ?>
          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
           <a class="nav-link" href="<?=base_url('admin/dashboard'); ?>" >
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
           </a>
          </li>
          <!-- Heading -->
          <div class="sidebar-heading"> MAIN NAVIGATION </div>
          <!-- Nav Item - Pages Collapse Menu -->
          
          <!-- Web start -->
          <li class="nav-item">
           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWeb" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>Web Pages</span>
           </a>
           <div id="collapseWeb" class="collapse  
				  	<?php echo ($siteUrlUri == 'homepage') || ($siteUrlUri == 'aboutpage') || ($siteUrlUri == 'instrumentpage') || ($siteUrlUri == 'tutorialspage') || ($siteUrlUri == 'ourteampage')  || ($siteUrlUri == 'footerdetails') ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white menu py-2 collapse-inner rounded">
             <a class="collapse-item  <?php echo ($siteUrlUri == 'homepage')? 'active' : ''; ?>" href="<?php echo base_url('webadmin/homepage/'); ?>"> Home Page </a>
             <a class="collapse-item  <?php echo ($siteUrlUri == 'aboutpage')? 'active' : ''; ?>" href="<?php echo base_url('webadmin/aboutpage/'); ?>"> About Page </a>
             <a class="collapse-item  <?php echo ($siteUrlUri == 'ourteampage')? 'active' : ''; ?>" href="<?php echo base_url('webadmin/ourteampage/'); ?>"> OurTeam Page </a>
             <a class="collapse-item  <?php echo ($siteUrlUri == 'instrumentpage')? 'active' : ''; ?>" href="<?php echo base_url('webadmin/instrumentpage/'); ?>"> Instrument Page </a>
             <a class="collapse-item  <?php echo ($siteUrlUri == 'tutorialspage')? 'active' : ''; ?>" href="<?php echo base_url('webadmin/tutorialspage/'); ?>"> Tutorials Page </a>
             <a class="collapse-item  <?php echo ($siteUrlUri == 'footerdetails')? 'active' : ''; ?>" href="<?php echo base_url('webadmin/footerdetails/'); ?>"> Footer Details Page </a>
             <a class="collapse-item  <?php echo ($siteUrlUri == 'bg_image_change')? 'active' : ''; ?>" href="<?php echo base_url('webadmin/bg_image_change/'); ?>"> Background Image Change  </a>
            </div>
           </div>
          </li>
          <!-- Web end -->



          <li class="nav-item">
           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>Admin</span>
           </a>
           <div id="collapseAdmin" class="collapse  
				  	<?php echo ($siteUrlUri == 'adminprofile') || ($siteUrlUri == 'admineditprofile') ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white menu py-2 collapse-inner rounded">
             <a class="collapse-item" href="
							<?php echo base_url('admin/adminprofile/') . $admin_id; ?>"> Admin Profile </a>
            </div>
           </div>
          </li>

          <li class="nav-item">
           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-users teal-color "></i> <span>Users</span> </a>
            
             <div id="collapseTwo" class="collapse<?php echo ($siteUrlUri == 'userList') || ($siteUrlUri == 'artistList') || ($siteUrlUri == 'profile') || ($siteUrlUri == 'edit_user') || ($siteUrlUri == 'edit_artist') ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" >

            <div class="bg-white menu py-2 collapse-inner rounded ct_inner_drop">
             
              <a class="collapse-item" data-name='User_List' href="<?=base_url('admin/userList'); ?>"> User List </a>
              <a class="collapse-item" data-name='Artist_List' href="<?=base_url('admin/artistList'); ?>"> Artist List </a>

            </div>

           </div>
          </li>

          <!---Instrument-->
          <li class="nav-item">
           <a class="nav-link" href="<?=base_url('admin/instrumentList'); ?>" >
            <i class="fas fa-fw fa-cog"></i>
             <span> Instrument List </span>
           </a>
          </li>

          <!---Genre-->
          <li class="nav-item">
           <a class="nav-link" href="<?=base_url('admin/genreList'); ?>" >
            <i class="fas fa-fw fa-cog"></i>
            <span>Category List</span>
           </a>
          </li>
          
          <!--270423 mohd start-->

          <!--<li class="nav-item">-->
          <!-- <a class="nav-link" href="<?=base_url('admin/albumList'); ?>">-->
          <!--  <i class="far fa-smile-beam"></i>-->
          <!--  <span>Album List</span>-->
          <!-- </a>-->
          <!--</li>-->

          <!--<li class="nav-item">-->
          <!-- <a class="nav-link" href="<?=base_url('admin/moodList'); ?>">-->
          <!--  <i class="fa fa-user-secret"></i>-->
          <!--  <span>Music Mood List</span>-->
          <!-- </a>-->
          <!--</li>-->
          
          <!--270423 mohd end-->
          
          <li class="nav-item">
           <a class="nav-link" href="<?=base_url('admin/songsList'); ?>">
            <i class="fas fa fa-music"></i>
            <span>Song List</span>
           </a>
          </li>

          <li class="nav-item">
           <a class="nav-link" href="<?=base_url('admin/requestsongList'); ?>">
            <i class="fas fa fa-music"></i>
            <span>Request Song List</span>
           </a>
          </li>
          
          <li class="nav-item">
           <a class="nav-link" href="<?=base_url('admin/termServices'); ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Terms and Services</span>
           </a>
          </li>

          <!-- Nav Item - Tables -->
          <li class="nav-item">
           <a class="nav-link" href="<?=base_url('admin/privacyPolicy'); ?>">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Privacy Policy</span>
           </a>
          </li>
          <hr class="sidebar-divider d-none d-md-block">
          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
           <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>
         </ul>
         <!-- End of Sidebar -->
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
          <!-- Main Content -->
          <div id="content">
           <!-- Topbar -->
           <nav class="navbar navbar-expand navbar-light header-box bg-theme topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
             <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
             <!-- Nav Item - Search Dropdown (Visible Only XS) -->
             <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
               <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                 <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                 <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                   <i class="fas fa-search fa-sm"></i>
                  </button>
                 </div>
                </div>
               </form>
              </div>
             </li>
             <div class="topbar-divider d-none d-sm-block"></div>
             <!-- Nav Item - User Information -->
             <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle user-click-box" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span class="mr-2 d-none d-lg-inline font-weight-800 small"> <?php if(!empty($data['first_name']) )
                { echo $data['first_name']; }else{ echo "Admin";} ?> </span> <?php if (!empty($data)) { ?> <img class="img-profile rounded-circle" src="<?php echo base_url('/assets/uploads/') . $data['image']; ?>"> <?php
                } else { ?> <img class="img-profile rounded-circle" src="
                                <?php echo base_url('/assets/userfile/profile/2020-11-23-18-13-30dym.jpg'); ?>"> <?php
                } ?> </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in menu" aria-labelledby="userDropdown">
               
               <div class="dropdown-divider"></div>
                
               <a class="dropdown-item" href="
													<?=base_url('admin/logout'); ?>">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout </a>
              </div>
             </li>
            </ul>
           </nav>
           <!-- End of Topbar -->