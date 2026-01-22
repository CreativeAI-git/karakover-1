<section class="ct_sec_padd">
    <div class="container">
        <div class="row"  data-aos="fade-up" data-aos-duration="1000"> 
            <?php if(!empty($tutorial)){?>
            <div class="col-md-12" >
                <div class="ct_song_card">
                    <img src="<?php echo base_url('/assets/website/tutorial/'.$tutorial[0]['image']); ?>" alt="img">
                </div>
                <div class="ct_description_text mt-4 text-center">
                  <?php echo $tutorial[0]['details']; ?>
                </div>
            </div><?php } ?>
        </div>
    </div>
</section>
