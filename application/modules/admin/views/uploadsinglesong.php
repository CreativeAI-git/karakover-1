<div class="gl_music_form_bg">
<style>
   body {
   background: #ececec;
      }
      .lds-dual-ring.hidden { 
      display: none;
      }
      .lds-dual-ring {
      display: inline-block;
      width: 80px;
      height: 80px;
      }
      .lds-dual-ring:after {
      content: " ";
      display: block;
      width: 64px;
      height: 64px;
      margin: 5% auto;
      border-radius: 50%;
      border: 6px solid #fff;
      border-color: #fff transparent #fff transparent;
      animation: lds-dual-ring 1.2s linear infinite;
      }
      @keyframes lds-dual-ring {
      0% {
         transform: rotate(0deg);
      }
      100% {
         transform: rotate(360deg);
      }
      }
      .overlay {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100vh;
         background: rgba(0,0,0,.8);
         z-index: 999;
         opacity: 1;
         transition: all 0.5s;
         display: flex;
         justify-content: center;
         align-items: center;
      }
   </style>

 <div class="container-fluid">
  <h2 class="h3 mb-3 text-gray-800"><?= $title ; ?></h2>
   <form class="form-horizontal" method="post" action="<?php echo base_url('admin/uploadSingleSong/')?>" enctype="multipart/form-data" id="singleSongs-upload-form" >

   <div id="loader" class="lds-dual-ring hidden overlay"> </div>
   
    <div class="gl_main_creator_form pt-0">
      <div class="gl_track_div">
        <div class="row align-items-center">
         <div class="col-md-3 mb-4">
          <div class="gl_upload_cover_img" onchange="myFunction()" >
            <label for="gl_cover_art">
             <!-- <p>Cover Art</p> -->
              <h5>+</h5>
                <img  id="blah" alt="your image" width="200" height="200" src="../../assets/img/preview_img.png" />
              <input type="file" name="cover_image" id="gl_cover_art">
            </label>  
            </div>
            <span class="error_msg  gl_cover_art"></span>   
          </div>
          <div class=" col-md-9 ct_track_form_div mb-4">
            <table class="table gl_heading_black">
              <tr>
                <td> Track <input type="text" name="track" id="track" >
                   <?php echo form_error('track', '<span class="error_msg">', '</span>'); ?> 
                   <span class="error_msg track"></span>  
                </td>  

                <td>Label <input type="text" name="label" id="label">
                   <span class="error_msg label-error"></span> 
                   <?php echo form_error('label', '<span class="error_msg">', '</span>'); ?>
                </td>
              </tr>

               <tr>
                <td>
                  Select artist 
                  <select name="artist" class="form-control" >
                     <?php if(!empty($artist)){ foreach($artist as $value) { ?>
                       <option value="<?php echo $value['id']; ?>" >  
                        <?php echo $value['artist_name']; ?> </option>
                     <?php } } ?>
                  </select> 
                </td>
                <td> Select Genre <select name="genre" class="form-control">
                  <?php  
                   if(!empty($genre)){ foreach($genre as $value){ ?>
                    <option value="<?php echo $value['id']; ?>" >  
                          <?php echo $value['genre_type']; ?></option>
                            <?php } } ?>
                       </select></td>
              </tr>
               <tr>
                <td>Select Albums <select name="album_id" class="form-control">
                  <?php  
                   if(!empty($album)){ foreach($album as $value){ ?>
                    <option value="<?php echo $value['id']; ?>" >  
                          <?php echo $value['album_type']; ?></option>
                            <?php } } ?>
                       </select></td>
                <td>Select Your Mood <select name="your_mood_id" class="form-control">
                  <?php  
                   if(!empty($your_mood)){ foreach($your_mood as $value){ ?>
                    <option value="<?php echo $value['id']; ?>" >  
                          <?php echo $value['mood_type']; ?></option>
                            <?php } } ?>
                       </select></td>
              </tr>
                <tr>
                <td>Release <input type="text" name="release_year"  id="release_year">
                   <span class="error_msg  release_year"></span>   
                 <?php echo form_error('release_year', '<span class="error_msg">', '</span>'); ?></td>
                <td>
                  <div class="gl_track_num_flex">
                    <div>  Track No. <input type="number" name="track_no." >
                  
                    </div>    
                  </div>
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  Lyrics
                  <textarea id="" name="lyrics" rows="4"></textarea>
                  
                </td>
              </tr>
            </table>
          </div>     
        </div>
      </div>
      <div class="gl_upload_music_bg">
        <div class="gl_upload_music_div">
          
        <label for="gl_audio_5">
          <div class="gl_upload_box gl_black_brdr">
           <div class="gl_upload_text">
             <h5>Master File</h5>
              <div id="file-upload-filename_5" class="text-white"></div>
           </div>
            <div class="gl_upload_here gl_black_icon">
            <i class="fa fa-plus" aria-hidden="true"></i>
           </div>
            <input type="file" name="music_file" id="gl_audio_5">
 
          </div>
        </label>
        </div>
        <span class="error_msg songs-files"></span> 
      </div>
    <div class="gl_bypass_btn mt-4 text-right"> 

       <input type="hidden" name="song_type" value="1" >

       <input type="hidden" name="zone_type" value="1" >

       

      <input type="submit" name="submit" value="Add" class="btn btn-success gl_btn_bg_blue" id="singleSong_submit_form" >
    </div>
</form>


</div>

</div>


<script type="text/javascript">
 ///five box
    let input4 = document.getElementById( 'gl_audio_5');
    let infoArea4 = document.getElementById( 'file-upload-filename_5');
    input4.addEventListener( 'change', showFileName5);
    function showFileName5( event ) 
    {
         var file = document.querySelector("#gl_audio_5");
        if ( /\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false ) 
        {
         alert("Please select Mp3 file and Wav,m4a files only!");
         }else{
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea4.textContent = fileName;
       }
       // console.log(input.files) ; 
       
    }
</script>

