<style>
  .ct_music_p_center p{
    text-align:center;
    margin-bottom:10px
  }
</style>

<!-- <section class="ct_sec_padd ct_over_flow_hidden">
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
</section> -->


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
      <h2 class="ct_head_h2">
        <?php
        echo !empty($home_page_banner_settings['title'])
          ? $home_page_banner_settings['title']
          : 'Songs with guitar instrument';
        ?>
      </h2>
    </div>

    <div class="row" data-aos="fade-down" data-aos-duration="1000">
      <div class="col-md-12">

        <div class="owl-carousel owl-theme ct_app_screen_shot">

          <?php if (!empty($home_page_banners)) {
            foreach ($home_page_banners as $banner) { ?>
              <div class="item">
                <div class="ct_song_card">

                  <?php if (!empty($banner['type']) && $banner['type'] === 'image' && !empty($banner['banner'])) { ?>
                    <img src="<?php echo base_url('assets/home_page_banners/' . $banner['banner']); ?>" alt="banner">
                    <div class="ct_overlay_song_filter">
                      <p>Image Banner</p>
                    </div>
                  <?php } else if (!empty($banner['type']) && $banner['type'] === 'video' && !empty($banner['banner'])) { ?>
                    <video class="ct_banner_video" width="100%" height="100%" style="object-fit:cover;" preload="metadata" <?php if (!empty($banner['thumbnail_image'])) { ?>poster="<?php echo base_url('assets/home_page_banners/' . $banner['thumbnail_image']); ?>"<?php } ?>>
                      <source src="<?php echo base_url('assets/home_page_banners/' . $banner['banner']); ?>" type="video/mp4">
                    </video>
                    <button type="button" class="ct_video_play" aria-label="Play video">
                      <i class="fa-solid fa-play"></i>
                    </button>
                    <button type="button" class="ct_video_pause ct_hide_play" aria-label="Pause video">
                      <i class="fa-solid fa-pause"></i>
                    </button>
                    <div class="ct_overlay_song_filter">
                      <p>Video Banner</p>
                    </div>
                  <?php } else { ?>
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; text-align:center; padding:20px; background:#111; color:#fff;">
                      <?php echo !empty($banner['banner']) ? $banner['banner'] : 'Home Page Banner'; ?>
                    </div>
                  <?php } ?>

                </div>
              </div>
          <?php }
          } ?>

        </div>

      </div>
    </div>

  </div>
</section>
