<style>
  .ct_music_p_center p{
    text-align:center;
    margin-bottom:10px
  }
</style>
<section class="ct_sec_padd ct_over_flow_hidden">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4"  data-aos="fade-up" data-aos-duration="1000">
        <div class="ct_about_images">
        <?php if(!empty($about)){ $aboutimg = explode(', ',$about[0]['image']);  ?>
          <div class="ct_left_abt_img">
            <img src="<?php echo base_url('/assets/website/about/'.$aboutimg[0]); ?>"  alt="img">
            <img src="<?php echo base_url('/assets/website/about/'.$aboutimg[1]); ?>"  alt="img">
          </div>
          <div class="ct_right_abt_img">
          <img src="<?php echo base_url('/assets/website/about/'.$aboutimg[2]); ?>"  alt="img">
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4 ps-md-5 "  data-aos="fade-up" data-aos-duration="1000">
        <div class="ct_about_cnt">
        <?php echo $about[0]['details']; } ?>
      </div>

      </div>

    </div>
  </div>
 </section>

 <section class="ct_sec_padd ct_bg_grey ct_over_flow_hidden">
  <div class="container">
    <h2 class="ct_head_h2 text-start mb-5  text-center ">Music Classes</h1>
    <div class="row">
      <?php if(!empty($instrument)){ foreach($instrument as $keyinstru=>$valinstru){ ?>
      <div class="col-md-4 mb-4" data-aos="fade-right"  data-aos-duration="1000">
        <div class="ct_music_class_box ct_music_p_center">
          <div class="ct_music_icon">
            <!-- <i class="fa-solid fa-music"></i> -->
            <img src="<?php echo base_url('/assets/website/instrument/'.$valinstru['image']); ?>" alt="img">
          </div>
          <h6 class="ct_head_h6 text-center"><?php echo $valinstru['title']; ?></h6>
          <p class="text-center"><?php echo substr($valinstru['details'],0,150); ?></p>
        </div>
      </div>
      <?php } } ?>
      <!-- <div class="col-md-4 mb-4"  data-aos="fade-up"  data-aos-duration="1500">
        <div class="ct_music_class_box">
          <div class="ct_music_icon">
            <i class="fa-solid fa-guitar"></i>
          </div>
          <h6 class="ct_head_h6 text-center">Rhythm Guitar</h6>
          <p class="text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, officia hic voluptatum, reprehenderit qui,
          </p>
        </div>
      </div>
       <div class="col-md-4 mb-4"  data-aos="fade-left"  data-aos-duration="1000">
        <div class="ct_music_class_box">
          <div class="ct_music_icon">
            <i class="fa-solid fa-microphone"></i>
          </div>
          <h6 class="ct_head_h6 text-center">Lead Guitar</h6>
          <p class="text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, officia hic voluptatum, reprehenderit qui,
          </p>
        </div>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-right" data-aos-duration="1000">
        <div class="ct_music_class_box">
          <div class="ct_music_icon">
            <i class="fa-solid fa-drum"></i>
          </div>
          <h6 class="ct_head_h6 text-center">Drum</h6>
          <p class="text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, officia hic voluptatum, reprehenderit qui,
          </p>
        </div>
      </div>
      <div class="col-md-4 mb-4"  data-aos="fade-down" data-aos-duration="1500">
        <div class="ct_music_class_box">
          <div class="ct_music_icon">
            <i class="fa-solid fa-sliders"></i>
          </div>
          <h6 class="ct_head_h6 text-center">Guitar Theory</h6>
          <p class="text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, officia hic voluptatum, reprehenderit qui,
          </p>
        </div>
      </div>
      <div class="col-md-4 mb-4"  data-aos="fade-left" data-aos-duration="1000">
        <div class="ct_music_class_box">
          <div class="ct_music_icon">
            <i class="fa-solid fa-ear-listen"></i>
          </div>
          <h6 class="ct_head_h6 text-center">Live Guitar</h6>
          <p class="text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, officia hic voluptatum, reprehenderit qui,
          </p>
        </div>
      </div> -->
    </div>
  </div>
 </section>


 <section class="ct_sec_padd ct_music_tabs_bg ct_over_flow_hidden">
  <div class="container">
    <div class="ct_heading mb-5"  data-aos="fade-down"  data-aos-duration="1000">
      <h2 class="ct_head_h2">Songs with guitar instrument</h2>
  </div>
    <div class="row" data-aos="fade-down"  data-aos-duration="1000" >

      
      <div class="col-md-12">
        <div class="owl-carousel owl-theme ct_app_screen_shot">
         
          <div class="item">
            <div class="ct_song_card">
              <img src="<?php echo site_url('frontendassets/img/music_thumb_1.png'); ?>" alt="img/music_thumb_1.png">
              <div class="ct_overlay_song_filter">
                <P>Let Me Love You</P>
                <div class="ct_filter_item">
                 <ul>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/play.png'); ?>" alt="img/play.png">
                  </li>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/mix_icon.png'); ?>" alt="img/mix_icon.png">
                  </li>
                 </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="ct_song_card">
              <img src="<?php echo site_url('frontendassets/img/music_thumb_1.png'); ?>" alt="img/music_thumb_1.png">
              <div class="ct_overlay_song_filter">
                <P>Let Me Love You</P>
                <div class="ct_filter_item">
                 <ul>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/play.png'); ?>" alt="img/play.png">
                  </li>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/mix_icon.png'); ?>" alt="img/mix_icon.png">
                  </li>
                 </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="ct_song_card">
              <img src="<?php echo site_url('frontendassets/img/music_thumb_1.png'); ?>" alt="img/music_thumb_1.png">
              <div class="ct_overlay_song_filter">
                <P>Let Me Love You</P>
                <div class="ct_filter_item">
                 <ul>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/play.png'); ?>" alt="img/play.png">
                  </li>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/mix_icon.png'); ?>" alt="img/mix_icon.png">
                  </li>
                 </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="ct_song_card">
              <img src="<?php echo site_url('frontendassets/img/music_thumb_1.png'); ?>" alt="img/music_thumb_1.png">
              <div class="ct_overlay_song_filter">
                <P>Let Me Love You</P>
                <div class="ct_filter_item">
                 <ul>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/play.png'); ?>" alt="img/play.png">
                  </li>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/mix_icon.png'); ?>" alt="img/mix_icon.png">
                  </li>
                 </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="ct_song_card">
              <img src="<?php echo site_url('frontendassets/img/music_thumb_1.png'); ?>" alt="img/music_thumb_1.png">
              <div class="ct_overlay_song_filter">
                <P>Let Me Love You</P>
                <div class="ct_filter_item">
                 <ul>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/play.png'); ?>" alt="img/play.png">
                  </li>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/mix_icon.png'); ?>" alt="img/mix_icon.png">
                  </li>
                 </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="ct_song_card">
              <img src="<?php echo site_url('frontendassets/img/music_thumb_1.png'); ?>" alt="img/music_thumb_1.png">
              <div class="ct_overlay_song_filter">
                <P>Let Me Love You</P>
                <div class="ct_filter_item">
                 <ul>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/play.png'); ?>" alt="img/play.png">
                  </li>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/mix_icon.png'); ?>" alt="img/mix_icon.png">
                  </li>
                 </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="ct_song_card">
              <img src="<?php echo site_url('frontendassets/img/music_thumb_1.png'); ?>" alt="img/music_thumb_1.png">
              <div class="ct_overlay_song_filter">
                <P>Let Me Love You</P>
                <div class="ct_filter_item">
                 <ul>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/play.png'); ?>" alt="img/play.png">
                  </li>
                  <li>
                    <img src="<?php echo site_url('frontendassets/img/mix_icon.png'); ?>" alt="img/mix_icon.png">
                  </li>
                 </ul>
                </div>
              </div>
            </div>
          </div>
         
          </div>
       
      </div>
     
    
     
    </div>

  </div>
 </section>

 