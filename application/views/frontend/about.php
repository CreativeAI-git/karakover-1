<section class="ct_sec_padd ct_over_flow_hidden">
  <div class="container">
    <div class="row align-items-center">

      <?php if(!empty($about) && !empty($about[0]['image'])) { 
        $aboutimg = explode(',', $about[0]['image']);
        $aboutimg = array_values(array_filter(array_map('trim', $aboutimg)));
      ?>

      <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-duration="1000">
        <div class="ct_about_images">

          <div class="ct_left_abt_img">
            <?php if(isset($aboutimg[0])) { ?>
              <img src="<?php echo base_url('/assets/website/about/'.$aboutimg[0]); ?>" alt="img">
            <?php } ?>

            <?php if(isset($aboutimg[1])) { ?>
              <img src="<?php echo base_url('/assets/website/about/'.$aboutimg[1]); ?>" alt="img">
            <?php } ?>
          </div>

          <div class="ct_right_abt_img">
            <?php if(isset($aboutimg[2])) { ?>
              <img src="<?php echo base_url('/assets/website/about/'.$aboutimg[2]); ?>" alt="img">
            <?php } ?>
          </div>

        </div>
      </div>

      <div class="col-lg-6 mb-4 ps-md-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="ct_about_cnt">
          <?php echo !empty($about[0]['details']) ? $about[0]['details'] : ''; ?>
        </div>
      </div>

      <?php } ?>

    </div>
  </div>
</section>


<!-- ================= SECOND SECTION ================= -->

<section class="ct_sec_padd ct_works_bg ct_over_flow_hidden">
  <div class="container">
    <div class="row align-items-center">

      <?php if(!empty($about) && isset($about[1])) { ?>

      <div class="col-md-5 mb-4" data-aos="fade-right" data-aos-duration="1000">
        <div class="ct_prentation_video">

          <?php if(!empty($about[1]['image'])) { ?>
            <img src="<?php echo base_url('/assets/website/about/'.$about[1]['image']); ?>" alt="img">
          <?php } ?>

          <button class="ct_video_btn">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
              <path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
            </svg>
          </button>

        </div>
      </div>

      <div class="col-md-6 mb-4 offset-md-1" data-aos="fade-left" data-aos-duration="1000">
        <div class="ct_how_works_cnt">
          <?php echo !empty($about[1]['details']) ? $about[1]['details'] : ''; ?>
        </div>
      </div>

      <?php } ?>

    </div>
  </div>
</section>


<!-- ================= TEAM SECTION ================= -->

<section class="ct_team_bg ct_over_flow_hidden">
  <div class="container">
    <div class="ct_heading mb-5 pb-4">
      <h2 class="ct_head_h2">Our Team</h2>
    </div>

    <div class="row">
      <?php if(!empty($ourteam)) { 
        foreach($ourteam as $teamvalue){ ?>
        
        <div class="col-md-4 mb-5" data-aos="fade-up" data-aos-duration="1000">
          <div class="ct_team_card">

            <?php if(!empty($teamvalue['image'])) { ?>
              <img src="<?php echo base_url('/assets/website/ourteam/'.$teamvalue['image']); ?>" alt="">
            <?php } ?>

            <div class="ct_team_info">
              <h4><?php echo !empty($teamvalue['name']) ? $teamvalue['name'] : ''; ?></h4>
              <p class="mb-0"><?php echo !empty($teamvalue['title']) ? $teamvalue['title'] : ''; ?></p>
            </div>

          </div>
        </div>

      <?php } } ?>
    </div>
  </div>
</section>