<style>
    .tutorial-media {
        height: 450px;
        object-fit: cover;
        border-radius: 15px;
    }

    .carousel-item {
        text-align: center;
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

                                            <img src="<?php echo $filePath; ?>" class="d-block w-100 tutorial-media" alt="image">

                                        <?php } else { ?>

                                            <video class="d-block w-100 tutorial-media" autoplay muted>
                                                <source src="<?php echo $filePath; ?>" type="video/mp4">
                                            </video>

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