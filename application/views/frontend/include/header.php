<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url(); ?>assets/fav-icon.png" />
  <title>Karakover</title>
  <meta charset="UTF-8">
  <meta name="description" content="Karakover">
  <meta name="keywords" content="Karakover">
  <meta name="author" content="Karakover">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;300;500;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?php echo site_url('frontendassets/css/style.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <header style="background-color: #e5e5e5;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <section class="navigation">
            <div class="nav-container">
              <div class="brand">
                <a href="#">
                  <img src="<?php echo site_url('frontendassets/img/logo.png'); ?>" alt="img/logo.png">
                </a>
              </div>
              <nav>
                <div class="nav-mobile"><a id="navbar-toggle" href="#!"><span></span></a></div>
                <?php
                $segment = $this->uri->segment(1);
                $page_title = str_replace('_', ' ', $segment);
                ?>

                <ul class="nav-list">

                  <li>
                    <a href="<?php echo site_url('/'); ?>"
                      class="text-dark <?php echo empty($segment) ? 'active' : ''; ?>">
                      Home
                    </a>
                  </li>

                  <li>
                    <a href="<?php echo site_url('About'); ?>"
                      class="text-dark <?php echo ($segment == 'About') ? 'active' : ''; ?>">
                      About
                    </a>
                  </li>

                  <li>
                    <a href="<?php echo site_url('Instruments'); ?>"
                      class="text-dark <?php echo ($segment == 'Instruments') ? 'active' : ''; ?>">
                      Instruments
                    </a>
                  </li>

                  <li>
                    <a href="<?php echo site_url('Tutorials'); ?>"
                      class="text-dark <?php echo ($segment == 'Tutorials') ? 'active' : ''; ?>">
                      Tutorials
                    </a>
                  </li>

                  <div class="ct_mobile_close">
                    <i class="fa-solid fa-xmark"></i>
                  </div>

                </ul>
              </nav>
            </div>
          </section>
        </div>
      </div>
    </div>
  </header>
  <!-- home page Bg_img -->
  <?php if ($this->uri->segment(1) == '') { ?>
    <section class="ct_banner_bg" style="background-image: url(<?php echo  base_url('/assets/website/bgimage/' . $bgimage[0]['image']); ?>);">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 animate__animated  animate__fadeInLeft animate__delay-1s">
            <div class="ct_banner_cnt ">
              <div class="ct_font_70 text-white ct_banner_overflow_h"> <?php echo $home[0]['details']; ?></div>
              <div class="ct_app_link_btn">
                <a href="https://apps.apple.com/us/app/karakover/id6767812443" class="mb-2" target="_blank" rel="noopener noreferrer">
                  <img src="<?php echo site_url('frontendassets/img/app-store.svg'); ?>">
                </a>
                <a href="https://play.google.com/store/apps/details?id=com.karakover.music&hl=en_IN" class="mb-2" target="_blank" rel="noopener noreferrer">
                  <img src="<?php echo site_url('frontendassets/img/app-google-play-1.svg'); ?>">
                </a>
              </div>
            </div>
          </div>

          <div class="col-md-6 animate__animated  animate__fadeInRight animate__delay-1s">
            <div class="ct_banner_right_img">
              <img src="<?php echo base_url('/assets/website/home/' . $home[0]['image']); ?>" alt="img" class="w-100">
            </div>
          </div>

        </div>

      </div>
    </section>
  <?php } else { ?>
    <!-- home page Bg_img -->
    <!-- other page Bg_img -->
    <section class="ct_inner_bg" style="background-image: url(<?php echo  base_url('/assets/website/bgimage/' . $bgimage[1]['image']); ?>);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="ct_innter_title">
              <h2><?php echo $page_title; ?></h2>
              <ul class="ps-0mb-0">
                <li>
                  <a href="<?php echo site_url('/'); ?>">Home</a>
                </li>
                <li>
                  /
                </li>
                <li>
                  <?php echo $page_title; ?>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>
  <!-- other page Bg_img -->
