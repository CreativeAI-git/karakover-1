<style>
    .tutorial-media {
        width: 100%;
        aspect-ratio: 16 / 9;
        height: auto;
        border-radius: 5px;
    }

    .carousel-item {
        text-align: center;
    }

    .ct_song_card.ct_tutorial_card {
        height: auto;
    }

    .ct_song_card.ct_tutorial_card:before {
        opacity: 0;
    }

    .tutorial-video {
        object-fit: contain;
        background: #000;
    }

    .tutorial-image {
        object-fit: cover;
        background: #f5f5f5;
    }

    .ct_song_card.ct_tutorial_card {
        background: #f5f5f5;
        border-color: #df1c62;
    }

    #tutorialCarousel.ct_carousel_locked .carousel-control-prev,
    #tutorialCarousel.ct_carousel_locked .carousel-control-next,
    #tutorialCarousel.ct_carousel_locked .carousel-indicators button {
        pointer-events: none;
        opacity: 0.4;
    }

    #tutorialCarousel .carousel-control-prev,
    #tutorialCarousel .carousel-control-next {
        width: 48px;
        height: 48px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.55);
        border-radius: 50%;
        opacity: 1;
        transition: 0.25s ease all;
        border: 2px solid #fff;
    }

    #tutorialCarousel .carousel-control-prev {
        left: 12px;
    }

    #tutorialCarousel .carousel-control-next {
        right: 12px;
    }

    #tutorialCarousel .carousel-control-prev:hover,
    #tutorialCarousel .carousel-control-next:hover {
        background: rgba(223, 28, 98, 0.85);
        border-color: #df1c62;
    }

    #tutorialCarousel .carousel-control-prev-icon,
    #tutorialCarousel .carousel-control-next-icon {
        filter: invert(1);
        width: 22px;
        height: 22px;
    }

    #tutorialCarousel button.carousel-control-prev,
    #tutorialCarousel button.carousel-control-next {
        z-index: 9999;
    }

    #tutorialCarousel button.carousel-control-prev .carousel-control-prev-icon,
    #tutorialCarousel button.carousel-control-next .carousel-control-next-icon {
        filter: invert(0) !important;
    }

    .ct_video_pause {
        position: absolute;
        inset: 0;
        margin: auto;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        border: 2px solid #fff;
        background: rgba(0, 0, 0, 0.55);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        transition: 0.3s ease all;
    }


    google-cast-launcher {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 10px;
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 3;
        /* filter: invert(1) !important; */
        padding: 8px;
        background: #fff !important;
        display: block !important;
        border-radius: 5px;
    }
</style>
<section class="ct_sec_padd">
    <div class="container">
        <div class="row" data-aos="fade-up" data-aos-duration="1000">

            <?php if (!empty($tutorial)) { ?>

                <div class="col-md-12">

                    <div id="tutorialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">

                        <div class="carousel-inner">

                            <?php
                            $files = json_decode($tutorial[0]['tutorial_files'], true);
                            if (!empty($files)) {
                                $active = "active";
                                foreach ($files as $file) {

                                    $filePath = base_url('assets/website/tutorial/' . $file['file']);
                            ?>

                                    <div class="carousel-item <?php echo $active; ?>">

                                        <?php if ($file['type'] == 'image') { ?>

                                            <div class="ct_song_card ct_tutorial_card">
                                                <img src="<?php echo $filePath; ?>" class="d-block w-100 tutorial-media tutorial-image" alt="image">
                                            </div>

                                        <?php } else { ?>

                                            <div class="ct_song_card ct_tutorial_card">
                                                <!-- <video class="d-block w-100 tutorial-media tutorial-video" preload="metadata" playsinline>
                                                    <source src="<?php echo $filePath; ?>" type="video/mp4">
                                                </video> -->
                                                <div class="position-relative">
                                                    <google-cast-launcher></google-cast-launcher>
                                                    <video
                                                        class="d-block w-100 tutorial-media tutorial-video"
                                                        preload="metadata"
                                                        playsinline>
                                                        <source src="<?php echo $filePath; ?>" type="video/mp4">
                                                    </video>
                                                </div>
                                                <button type="button" class="ct_video_play" aria-label="Play video">
                                                    <i class="fa-solid fa-play"></i>
                                                </button>
                                                <button type="button" class="ct_video_pause  ct_hide_play" aria-label="Pause video">
                                                    <i class="fa-solid fa-pause"></i>
                                                </button>
                                            </div>

                                        <?php } ?>

                                    </div>

                            <?php
                                    $active = ""; // only first item active
                                }
                            }
                            ?>

                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#tutorialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#tutorialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>

                    </div>

                    <div class="ct_description_text mt-4 text-center">
                        <?php echo $tutorial[0]['details']; ?>
                    </div>

                </div>

            <?php } ?>

        </div>
    </div>
</section>

<script type="text/javascript"
    src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1">
</script>
<script>
    window.__onGCastApiAvailable = function(isAvailable) {
        if (isAvailable) {
            cast.framework.CastContext.getInstance().setOptions({
                receiverApplicationId: chrome.cast.media.DEFAULT_MEDIA_RECEIVER_APP_ID,
                autoJoinPolicy: chrome.cast.AutoJoinPolicy.ORIGIN_SCOPED
            });
        }
    };
</script>