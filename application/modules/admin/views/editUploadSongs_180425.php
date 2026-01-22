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
  <h2 class="h3 mb-3 text-gray-800"><?= $title; ?> </h2>

   <form class="form-horizontal" method="post"  action="<?php echo base_url('admin/editUploadSongs/')?>" enctype="multipart/form-data" id="mixSongs-upload-edit-form" >

    <div id="loader" class="lds-dual-ring hidden overlay"> </div>

      <div class="gl_main_creator_form pt-0"> 
         <div class="gl_track_div">
            <div class="row align-items-center">
               <div class="col-md-3 mb-4">
                  <div class="gl_upload_cover_img" onchange="myFunction()">
                     <label for="gl_cover_art">
                        <!--  <p>Cover Art</p> -->
                        <h5>+</h5>
                        <img id="blah" alt="your image" width="200" height="200" src="<?= base_url().'/assets/cover/'.$songs['cover_image'];?>" />
                        <input type="file" name="cover_image" id="gl_cover_art"  >
                     </label>
                  </div>
                 
                  <span class="error_msg  gl_cover_art"></span>     
                
               </div>
               <div class=" col-md-9 ct_track_form_div mb-4">
                  <table class="table gl_heading_black">
                  
                     <tr>
                        <td>Track<input  type="text" id="track"  name="track" value="<?php echo $songs['track']; ?>">
                           <span class="error_msg track"></span>                
                        </td>
                        <td>Label <input type="text" name="label" id="label" value="<?php echo $songs['label']; ?>">
                           <span class="error_msg label-error"></span>        
                        </td>
                     </tr>
                     <tr>
                        <td>
                           Select artist 
                           <select name="artist" class="form-control">
                              <?php  
                                 if(!empty($artist)){ foreach($artist as $value){ ?>
                              <option value="<?php echo $value['id']; ?>"
                              	 <?php if($value['id'] == $songs['artist']){
                                   echo "selected='selected'";
                              	}else{
                                 echo "";
                              	}?> >
                                 <?php echo $value['artist_name']; ?>
                              </option>
                              <?php } } ?>
                           </select>
                        </td>
                        <td>
                           Select Category 
                           <select name="genre" class="form-control">
                              <?php  
                                 if(!empty($genre)){ foreach($genre as $value){ ?>
                                  <option value="<?php echo $value['id']; ?>" 
                                  <?php if($value['id'] == $songs['genre']){
                                   echo "selected='selected'";
                              	}else{
                                 echo "";
                              	}?> >
                                    <?php echo $value['genre_type']; ?>
                                  </option>
                              <?php } } ?>
                           </select>
                        </td>
                     </tr>
                     <!--<tr>-->
                        <!--<td>-->
                           <!--Select Albums -->
                           <!--<select name="album_id" class="form-control">-->
                              <?php  
                                 //if(!empty($album)){ foreach($album as $value){ ?>
                              <!--<option value="<?php echo $value['id']; ?>"  -->
                              	<?php //if($value['id'] == $songs['album_id']){
                                  // echo "selected='selected'";
                              	//}else{
                               //  echo "";
                              //	}?>

                                 <?php //echo $value['album_type']; ?>
                              <!--</option>-->
                              <?php //} } ?>
                           <!--</select>-->
                        <!--</td>-->
                        <!--<td>-->
                           <!--Select Your Mood -->
                           <!--<select name="your_mood_id" class="form-control">-->
                              <?php  
                                 //if(!empty($your_mood)){ foreach($your_mood as $value){ ?>
                                  <!--<option value="<?php echo $value['id']; ?>"  -->
                                   	<?php// if($value['id'] == $songs['your_mood_id']){
                                 //  echo "selected='selected'";
                              //	}else{
                                // echo "";
                              //	}?>
                                    <?php //echo $value['mood_type']; ?>
                                  <!--</option>-->
                              <?php //} } ?>
                           <!--</select>-->
                        <!--</td>-->
                     <!--</tr>-->
                     <tr>
                        <td>Release <input type="text" name="release_year" id="release_year" value="<?php echo $songs['release_year']; ?>">
                           <span class="error_msg  release_year"></span>   
                        </td>
                        <td>
                           <div class="gl_track_num_flex">
                              <div> Track No. <input type="number" name="track_no" value="<?php echo $songs['track_no']; ?>">
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td  colspan="2">Library Category  <?php echo $songs['category']; ?>
                        <select name="category" class="form-control">
                        <option value="easy" <?php echo ($songs['category'] === 'easy') ? 'selected' : ''; ?>>Easy</option>
                        <option value="medium" <?php echo ($songs['category'] === 'medium') ? 'selected' : ''; ?>>Medium</option>
                        <option value="high" <?php echo ($songs['category'] === 'high') ? 'selected' : ''; ?>>High</option>

                           </select>
                        </td>
                     </tr>
                     <tr>
                      <td colspan="2">
                        Lyrics
                        <textarea id="" name="lyrics" rows="4" value="<?php echo $songs['lyrics']; ?>"><?php echo $songs['lyrics']; ?></textarea>
                      </td>
                     </tr>
                     <tr>
                        <td  colspan="2">chords upload  
                           <input type="file" name="chords" id="chords">
                           <span class="error_msg  chords"></span>   
                        <?php  
                           if(!empty($file)){ //echo $file['chords_songs']; ?>
                           <video width="200" height="150" controls>
                            <source src="<?= base_url().'/assets/songs/'.$file['chords_songs'];?>">
                           </video>
                           <?php } ?>
                        </td>
                     </tr>
                  </table>
                  <div class="gl_heading_black mt-3 mb-2">
                     Select Zone Type 
                     <select name="zone_type" id="mySelect" class="form-control" >
                        <option value="">Please Select Zone Type</option>
                        <?php  
                           if(!empty($zone)){
                              foreach($zone as $keynum => $value){ if($keynum == 4){ ?>

                            <option value="<?php echo $value['id']; ?>"   
                            	 <?php if($value['id'] == $songs['zone_type']){
                                   echo "selected='selected'";
                              	}else{
                                 echo "";
                              	}?> >
                              <?php echo $value['layout_name']; ?>
                            </option>
                        <?php } }} ?>
                     </select>
                     <span class="error_msg zone_type"></span>  
                  </div>
               </div>
            </div>
         </div>
         <div class="gl_upload_music_bg" <?php if($songs['zone_type'] >= 1){ ?>
            style="display: block;"
            <?php }else{?>
              style="display: none;"
                <?php } ?>>
            <div class="gl_upload_music_div">

               <div class="stem_file" id="stemfiles" <?php if($songs['zone_type'] >= 1){?>
            style="display: block;"
            <?php }else{?>
              style="display: none;"
                <?php } ?> >
                 
                  <label for="gl_audio_1">
                     <div class="gl_upload_box gl_red_brdr" >
                        <div class="gl_upload_text">
                           <h5>Vocals</h5>
                           <div id="file-upload-filename_1" class="text-white"><?php echo $file['vocals']; ?></div>
                        </div>
                        <div class="gl_upload_here gl_red_icon" >
                           <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <input type="file" name="music_file[1]" id="gl_audio_1" >
                     </div>
                  </label>

                  <label for="gl_audio_2">
                     <div class="gl_upload_box gl_yellow_brdr">
                        <div class="gl_upload_text">
                           <h5>Solo</h5>
                           <div id="file-upload-filename_2" class="text-white"><?php echo $file['solo']; ?></div>
                        </div>
                        <div class="gl_upload_here gl_yellow_icon">
                           <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <input type="file" name="music_file[2]" id="gl_audio_2" >
                     </div>
                  </label>

                  <label for="gl_audio_3">
                     <div class="gl_upload_box gl_blue_brdr">
                        <div class="gl_upload_text">
                           <h5>Click_bpm</h5>
                           <div id="file-upload-filename_3" class="text-white"><?php echo $file['click_bpm']; ?></div>
                        </div>
                        <div class="gl_upload_here gl_blue_icon ">
                           <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <input type="file" name="music_file[3]" id="gl_audio_3" >
                     </div>
                  </label>
                </div>  
                <div class="bass_files" id="bassfiles" <?php if($songs['zone_type'] == 1 || $songs['zone_type'] == 5){ ?>
            style="display: block;"
            <?php }else{?>
              style="display: none;"
                <?php } ?>>  
                    <label for="gl_audio_4">
                     <div class="gl_upload_box gl_barry_brdr">
                        <div class="gl_upload_text">
                           <h5>Bass</h5>
                           <div id="file-upload-filename_4" class="text-white"><?php echo $file['bass']; ?></div>
                        </div>
                        <div class="gl_upload_here gl_barry_icon">
                           <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <input type="file" name="music_file[4]" id="gl_audio_4" >
                     </div>
                  </label>
             
                </div>
                <div class="drums_files" id="drumsfiles" <?php if($songs['zone_type'] == 2 || $songs['zone_type'] == 5){ ?>
            style="display: block;"
            <?php }else{?>
              style="display: none;"
                <?php } ?>>                  
                    <label for="gl_audio_5">
                     <div class="gl_upload_box gl_black_brdr">
                        <div class="gl_upload_text">
                           <h5>Drums</h5>
                           <div id="file-upload-filename_5" class="text-white"><?php echo $file['drums']; ?></div>
                        </div>
                        <div class="gl_upload_here gl_black_icon">
                           <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <input type="file" name="music_file[5]" id="gl_audio_5" >
                     </div>
                  </label>
               </div>

                <div class="guitar_files" id="guitarfiles" <?php if($songs['zone_type'] == 3 || $songs['zone_type'] == 5){ ?>
            style="display: block;"
            <?php }else{?>
              style="display: none;"
                <?php } ?>>
                    
                  <label for="gl_audio_6">
                     <div class="gl_upload_box gl_black_brdr">
                        <div class="gl_upload_text">
                           <h5>Guitar</h5>
                           <div id="file-upload-filename_6" class="text-white"><?php echo $file['guitar']; ?></div>
                        </div>
                        <div class="gl_upload_here gl_black_icon">
                           <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <input type="file" name="music_file[6]" id="gl_audio_6" >
                     </div>
                  </label>
                </div>
                <div class="keyboard_files" id="keyboardfiles" <?php if($songs['zone_type'] == 4 || $songs['zone_type'] == 5){ ?>
            style="display: block;"
            <?php }else{?>
              style="display: none;"
                <?php } ?>>
                  <label for="gl_audio_7">
                     <div class="gl_upload_box gl_black_brdr">
                        <div class="gl_upload_text">
                           <h5>Keyboard</h5>
                           <div id="file-upload-filename_7" class="text-white"><?php echo $file['keyboards']; ?></div>
                        </div>
                        <div class="gl_upload_here gl_black_icon">
                           <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <input type="file" name="music_file[7]" id="gl_audio_7" >
                     </div>
                  </label>
               </div>
                <div class="mix_files" id="masterfiles" <?php if( $songs['zone_type'] >= 5){ ?>
            style="display: block;"
            <?php }else{?>
              style="display: none;"
                <?php } ?>>
                  <label for="gl_audio_8">
                     <div class="gl_upload_box gl_black_brdr">
                        <div class="gl_upload_text">
                           <h5>Claps</h5>
                           <div id="file-upload-filename_8" class="text-white"><?php echo $file['claps']; ?></div>
                        </div>
                        <div class="gl_upload_here gl_black_icon">
                           <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <input type="file" name="music_file[8]" id="gl_audio_8" >
                     </div>
                  </label>
               </div>

               <!--<div class="mix_files" id="masterfiles" style="display: none;">-->
             

               <!--   <label for="gl_audio_6">-->
               <!--      <div class="gl_upload_box gl_black_brdr">-->
               <!--         <div class="gl_upload_text">-->
               <!--            <h5>Claps</h5>-->
               <!--            <div id="file-upload-filename_6" class="text-white"></div>-->
               <!--         </div>-->
               <!--         <div class="gl_upload_here gl_black_icon">-->
               <!--            <i class="fa fa-plus" aria-hidden="true"></i>-->
               <!--         </div>-->
               <!--         <input type="file" name="music_file[6]" id="gl_audio_6" >-->
               <!--      </div>-->
               <!--   </label>-->
              
               <!--</div>-->

               <span class="error_msg songs-files"></span>   

            </div>
 
            <span class="error_msg allfile"></span>       
         </div>

         <div class="gl_bypass_btn mt-4 text-right"> 
           <input type="hidden" name="song_id" id="submit_form" value="<?php echo $songs['id'];?>">
            <input type="submit" name="submit" id="submit_form" value="Update" class="btn btn-success gl_btn_bg_blue">
         </div>
   </form>
   </div>
</div>

