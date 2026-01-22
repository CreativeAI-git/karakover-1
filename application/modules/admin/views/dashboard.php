       <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 page-title">Dashboard</h1>
 
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

          </div>

          <div class="row dash-boxes">

            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card border-left-primary shadow">

                <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total (Users)</div>

                      <div class="h5 mb-0 title-md"><?php echo $user;?></div>

                    </div>

                    <div class="col-auto">

                      <i class="fa fa-user fa-2x color-1"></i>
                    
                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card border-left-success shadow">

                <div class="card-body">

                  <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total (Artist)</div>

                      <div class="h5 mb-0 title-md"><?php echo $follower;?></div>

                    </div>

                    <div class="col-auto">

                     <i class="fa fa-star  fa-2x color-2"></i>
                  
                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card border-left-info shadow">

                <div class="card-body overflow-h">

                  <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Favourite Artist</div>

                      <div class="row no-gutters align-items-center">

                        <div class="col-auto">

                          <div class="h5 mb-0 title-md"><?php echo $concerts; ?></div>

                        </div>
 
                      </div>
 
                    </div>
 
                    <div class="col-auto">

                    <i class='fa fa-microphone fa-2x color-3'></i>  
                  
                    </div>

                  </div>

                </div>

              </div>

            </div>
 
            <!-- Pending Requests Card Example -->

            <div class="col-xl-3 col-md-6 mb-4">

              <div class="card border-left-warning shadow">

                <div class="card-body">

                  <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
 
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Genre Type</div>
 
                      <div class="h5 mb-0 title-md"><?php echo $genre; ?></div>
 
                    </div>
 
                    <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x color-2"></i>
                   
                    </div>

                  </div>

                </div>

              </div>

            </div>
            <!--   <canvas id="myAreaChart"></canvas> -->

          <div class="col-md-12"> 
          <div class="card ">
            <div class="card-body">      
          <div id="line_top_x"></div>
          </div>
          </div>
          </div>
          <div class="col-md-12">
          <div class="card mt-4">
            <div class="card-body">
          <div id="barchart_material" style="width: 100%; height: 300px;">     
          </div>
          </div>
          </div>
          </div>
            
            

          </div>
  
        </div>
 
      </div>