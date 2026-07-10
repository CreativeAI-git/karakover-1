<footer class="ct_footer_bg ct_sec_padd ct_over_flow_hidden">
  <div class="container">
    <div class="row">
      <div class="col-md-3 mb-4">
        <div class="ct_footer_logo">
          <a href="#">
            <img src="<?php echo site_url('frontendassets/img/logo.png'); ?>" alt="img">
          </a>
          <p><?php if (!empty($footer)) {
                echo $footer[0]['details']; ?></p>
          <!-- <ul class="ct_social_media">
            <li>
              <a href="#">
                <i class="fa-brands fa-facebook-f"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa-brands fa-twitter"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa-brands fa-instagram"></i>
              </a>
            </li>
          </ul> -->
        </div>
      </div>
      <div class="col-md-2 mb-4">
        <div class="ct_footer_links">
          <h4>Sitemap</h4>
          <?php
            $siteUrlUri = $this->uri->segment('2');
            if (empty($siteUrlUri)) {
              $siteUrlUri = $this->uri->segment('1');
            }
          ?>
          <ul>
            <li>
              <a href="<?php echo site_url('/'); ?>" class="<?php echo empty($siteUrlUri) ? 'active' : ''; ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Home </a>
            </li>
            <li>
              <a href="<?php echo site_url('About'); ?>" class="<?php echo ($siteUrlUri == 'About') ? 'active' : ''; ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i> About </a>
            </li>
            <li>
              <a href="<?php echo site_url('Instruments'); ?>" class="<?php echo ($siteUrlUri == 'Instruments') ? 'active' : ''; ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Instruments </a>
            </li>
            <li>
              <a href="<?php echo site_url('Tutorials'); ?>" class="<?php echo ($siteUrlUri == 'Tutorials') ? 'active' : ''; ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Tutorials </a>
            </li>
            <li>
              <a href="<?php echo site_url('Terms'); ?>" class="<?php echo ($siteUrlUri == 'Terms') ? 'active' : ''; ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Terms & Conditions </a>
            </li>
            <li>
              <a href="<?php echo site_url('Privacy'); ?>" class="<?php echo ($siteUrlUri == 'Privacy') ? 'active' : ''; ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Privacy Policy </a>
            </li>
            <!-- <li>
              <a href="<?php //echo site_url('Chat_Room'); 
                        ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i>
                Chat Room</a>
            </li> -->
          </ul>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="ct_footer_add ct_footer_links">
          <h4>Contact Us</h4>
          <ul>
            <!-- <li>
              <div class="ct_contact_info">
                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                <div class="ct_address_cnt">
                  <h6>Our location:</h6>
                  <p><?php echo $footer[0]['address']; ?></p>
                </div>
              </div>
            </li>
            <li>
              <div class="ct_contact_info">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <div class="ct_address_cnt">
                  <h6>Phones:</h6>
                  <p><a href="tel:<?php echo $footer[0]['number']; ?>"><?php echo $footer[0]['number'];
                                                                      } ?></a><br></p>
                </div>
              </div>
            </li> -->
            <?php if (!empty($footer) && !empty($footer[0]['email'])) { ?>
              <li>
                <div class="ct_contact_info">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <div class="ct_address_cnt">
                    <h6>Email:</h6>
                    <p><a href="mailto:<?php echo $footer[0]['email']; ?>"><?php echo $footer[0]['email']; ?></a></p>
                  </div>
                </div>
              </li>
            <?php } ?>
          </ul>
          <br>
          <h4>
            Follow Us
          </h4>
          <ul class="social-links d-flex gap-2 list-unstyled align-items-center">
            <li>
              <a href="https://www.facebook.com/profile.php?id=61574338724268" class="d-flex justify-content-center align-items-center w-100 h-100 text-white text-decoration-none" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <i class="fa-brands fa-facebook-f"></i>
              </a>
            </li>
            <li>
              <a href="https://linkedin.com/in/karakover-undefined-47b94a410" class="d-flex justify-content-center align-items-center w-100 h-100 text-white text-decoration-none" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                <i class="fa-brands fa-linkedin-in"></i>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)" class="d-flex justify-content-center align-items-center w-100 h-100 text-white text-decoration-none" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <i class="fa-brands fa-instagram"></i>
              </a>
            </li>
            <li>
              <a href="https://www.youtube.com/@Karakover-m7f" class="d-flex justify-content-center align-items-center w-100 h-100 text-white text-decoration-none" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                <i class="fa-brands fa-youtube"></i>
              </a>
            </li>

          </ul>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <div class="ct_footer_add ct_footer_links">
          <h4>Download Our App </h4>


          <div class="ct_app_link_btn d-flex flex-wrap gap-2">
            <a href="https://apps.apple.com/us/app/karakover/id6767812443" class="mb-2" target="_blank" rel="noopener noreferrer">
              <img src="<?php echo site_url('frontendassets/img/app-store.svg'); ?>">
            </a>
            <a href="https://play.google.com/store/apps/details?id=com.karakover.music&hl=en_IN" class="mb-2" target="_blank" rel="noopener noreferrer">
              <img src="<?php echo site_url('frontendassets/img/app-google-play-1.svg'); ?>">
            </a>
          </div>


        </div>
      </div>
    </div>
  </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="<?php echo site_url('frontendassets/js/custom.js'); ?>"></script>
</body>

</html>
