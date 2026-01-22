<section class="ct_sec_padd ct_over_flow_hidden">
   <div class="container">
      <div class="ct_heading mb-5 pb-4">
         <h2 class="ct_head_h2 ">Instruments List</h2>
      </div>
      <div class="row">
         <?php if(!empty($instrument)){ foreach($instrument as $keyinstru=>$valinstru){ ?>
         <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000" >
            <div class="ct_instrument_box">
               <div class="ct_overflow_hidden">
               <img src="<?php echo base_url('/assets/website/instrument/'.$valinstru['image']); ?>" alt="img">
               </div>
               <div class="ct_instrumnet_dtl">
               <h4><?php echo $valinstru['title']; ?></h4>
                  <p>
                  <?php echo $valinstru['details']; ?>
                  </p>
               </div>
            </div>
         </div>
         <?php }} ?>
      </div>
   </div>
</section>