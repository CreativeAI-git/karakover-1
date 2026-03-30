<style>
  .ct_music_p_center p{
    text-align:center;
    margin-bottom:10px
  }
</style>

<section class="ct_sec_padd ct_over_flow_hidden">
  <div class="container">
    <div class="row align-items-center">
      <?php if(!empty($about)) { 
        $aboutimg = explode(',', $about[0]['image']); 
      ?>

      <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-duration="1000">
        <div class="ct_about_images">

          <div class="ct_left_abt_img">
            <?php if(isset($aboutimg[0])) { ?>
              <img src="<?php echo base_url('/assets/website/about/'.trim($aboutimg[0])); ?>" alt="img">
            <?php } ?>

            <?php if(isset($aboutimg[1])) { ?>
              <img src="<?php echo base_url('/assets/website/about/'.trim($aboutimg[1])); ?>" alt="img">
            <?php } ?>
          </div>

          <div class="ct_right_abt_img">
            <?php if(isset($aboutimg[2])) { ?>
              <img src="<?php echo base_url('/assets/website/about/'.trim($aboutimg[2])); ?>" alt="img">
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


<!-- ================= MUSIC CLASSES ================= -->

<section class="ct_sec_padd ct_bg_grey ct_over_flow_hidden">
  <div class="container">
    <h2 class="ct_head_h2 text-center mb-5">Music Classes</h2>

    <div class="row">
      <?php if(!empty($instrument)) { 
        foreach($instrument as $valinstru){ ?>
        
        <div class="col-md-4 mb-4" data-aos="fade-right" data-aos-duration="1000">
          <div class="ct_music_class_box ct_music_p_center">
            
            <div class="ct_music_icon">
              <?php if(!empty($valinstru['image'])) { ?>
                <img src="<?php echo base_url('/assets/website/instrument/'.$valinstru['image']); ?>" alt="img">
              <?php } ?>
            </div>

            <h6 class="ct_head_h6 text-center">
              <?php echo !empty($valinstru['title']) ? $valinstru['title'] : ''; ?>
            </h6>

            <p class="text-center">
              <?php echo !empty($valinstru['details']) ? substr($valinstru['details'],0,150) : ''; ?>
            </p>

          </div>
        </div>

      <?php } } ?>
    </div>
  </div>
</section>


<!-- ================= SONG SECTION ================= -->

<section class="ct_sec_padd ct_music_tabs_bg ct_over_flow_hidden">
  <div class="container">

    <div class="ct_heading mb-5" data-aos="fade-down" data-aos-duration="1000">
      <h2 class="ct_head_h2">Songs with guitar instrument</h2>
    </div>

    <div class="row" data-aos="fade-down" data-aos-duration="1000">
      <div class="col-md-12">

        <div class="owl-carousel owl-theme ct_app_screen_shot">

          <?php for($i=0; $i<6; $i++) { ?>
          <div class="item">
            <div class="ct_song_card">

              <img src="<?php echo site_url('frontendassets/img/music_thumb_1.png'); ?>" alt="img">

              <div class="ct_overlay_song_filter">
                <p>Let Me Love You</p>

                <div class="ct_filter_item">
                  <ul>
                    <li>
                      <img src="<?php echo site_url('frontendassets/img/play.png'); ?>" alt="play">
                    </li>
                    <li>
                      <img src="<?php echo site_url('frontendassets/img/mix_icon.png'); ?>" alt="mix">
                    </li>
                  </ul>
                </div>

              </div>

            </div>
          </div>
          <?php } ?>

        </div>

      </div>
    </div>

  </div>
</section>