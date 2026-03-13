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
            background: rgba(0, 0, 0, .8);
            z-index: 999;
            opacity: 1;
            transition: all 0.5s;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* css added by @krishn */
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preview-item {
            position: relative;
            display: inline-block;
        }

        .preview-item img,
        .preview-item video {
            display: block;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            cursor: pointer;
            font-size: 16px;
            line-height: 20px;
        }
    </style>

    <div class="container-fluid">
        <h2 class="h3 mb-3 text-gray-800"><?= $title; ?> </h2>

        <form class="form-horizontal" method="POST" action="<?php echo base_url('admin/uploadSongsNew/') ?>" enctype="multipart/form-data" id="mixSongs-upload-form">

            <div id="loader" class="lds-dual-ring hidden overlay"> </div>

            <div class="gl_main_creator_form pt-0">
                <div class="gl_track_div">
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-4">
                            <div class="gl_upload_cover_img" onchange="myFunction()">
                                <label for="gl_cover_art">
                                    <!--  <p>Cover Art</p> -->
                                    <h5>+</h5>
                                    <img id="blah" alt="" width="200" height="200" src="../../assets/img/preview_img.png" />
                                    <input type="file" name="cover_image" id="gl_cover_art" accept="image/*">
                                </label>
                            </div>

                            <span class="error_msg  gl_cover_art_error"></span>

                        </div>
                        <div class=" col-md-9 ct_track_form_div mb-4">
                            <table class="table gl_heading_black">
                                <tr>
                                    <td>Track <input type="text" id="track" name="track">
                                        <span class="error_msg track"></span>
                                    </td>
                                    <td>Label <input type="text" name="label" id="label">
                                        <span class="error_msg label-error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Select artist
                                        <select name="artist" class="form-control">
                                            <?php
                                            if (!empty($artist)) {
                                                foreach ($artist as $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>">
                                                        <?php echo $value['artist_name']; ?>
                                                    </option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </td>
                                    <td>
                                        Select Category
                                        <select name="genre" class="form-control">
                                            <?php
                                            if (!empty($genre)) {
                                                foreach ($genre as $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>">
                                                        <?php echo $value['genre_type']; ?>
                                                    </option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </td>
                                </tr>
                                <!--<tr>-->
                                <!--<td>-->
                                <!--Select Albums -->
                                <!--<select name="album_id" class="form-control">-->
                                <?php
                                //  if(!empty($album)){ foreach($album as $value){ 
                                ?>
                                <!--<option value="<?php echo $value['id']; ?>" >  -->
                                <?php //echo $value['album_type']; 
                                ?>
                                <!--</option>-->
                                <?php // } } 
                                ?>
                                <!--</select>-->
                                <!--</td>-->
                                <!--<td>-->
                                <!--Select Your Mood -->
                                <!--<select name="your_mood_id" class="form-control">-->
                                <?php
                                //if(!empty($your_mood)){ foreach($your_mood as $value){ 
                                ?>
                                <!--<option value="<?php echo $value['id']; ?>" >  -->
                                <?php // echo $value['mood_type']; 
                                ?>
                                <!--</option>-->
                                <?php //} } 
                                ?>
                                <!--</select>-->
                                <!--</td>-->
                                <!--</tr>-->
                                <tr>
                                    <td>Release <input type="text" name="release_year" id="release_year">
                                        <span class="error_msg  release_year"></span>
                                    </td>
                                    <td>
                                        <div class="gl_track_num_flex">
                                            <div> Track No. <input type="number" name="track_no">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Library Category
                                        <select name="category" class="form-control">
                                            <option value="easy">Easy</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                    </td>

                                    <td>Select Instruments
                                        <select name="instrument_id" class="form-control">
                                            <?php
                                            if (!empty($instrument)) {
                                                foreach ($instrument as $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>">
                                                        <?php echo $value['instrument']; ?>
                                                    </option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        Lyrics
                                        <textarea id="" name="lyrics" rows="4"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Chords Upload:
                                        <input type="file" name="chords" id="chords" onchange="previewChords(this)" accept="video/*">
                                        <br>
                                        <video id="videoPreview" style="display:none; width: 200px; margin-top: 10px;" controls>
                                            <source src="" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <br>
                                        <span class="error_msg chords"></span>
                                    </td>
                                    <td>
                                        Master Song:
                                        <input type="file" name="master_song" id="master_song" onchange="previewMasterSong(this)" accept="audio/*">
                                        <br>

                                        <audio id="audioPreview"
                                            style="display:none; width: 200px; margin-top: 10px;"
                                            controls>
                                            Your browser does not support the audio element.
                                        </audio>

                                        <br>
                                        <span class="error_msg master_song"></span>
                                    </td>

                                </tr>

                            </table>

                            <div class="gl_heading_black mt-3 ">
                                <h5>Upload Multiple Files(Optional)</h5>
                                <table class="table gl_heading_black">
                                    <tr>
                                        <!-- <td>chord images upload
                                    <input type="file" name="chord_images[]" id="chord_images" multiple>
                                    <span class="error_msg  chord_images"></span>
                                </td> -->
                                        <!-- <td>vocal images upload
                                    <input type="file" name="vocal_images[]" id="vocal_images" multiple>
                                    <span class="error_msg  vocal_images"></span>
                                </td> -->
                                    </tr>
                                    <tr>
                                        <!-- <td>solo images upload
                                    <input type="file" name="solo_images[]" id="solo_images" multiple>
                                    <span class="error_msg  solo_images"></span>
                                </td> -->
                                        <!-- <td>click bpm images upload
                                    <input type="file" name="click_bpm_images[]" id="click_bpm_images" multiple>
                                    <span class="error_msg  click_bpm_images"></span>
                                </td> -->
                                    <tr>
                                        <td>
                                            <label for="bass_images">Bass Files Upload</label>
                                            <input type="file" name="bass_images[]" id="bass_images" multiple accept="image/*,video/*" onchange="previewFiles(this, 'bassPreview')">
                                            <span class="error_msg bass_images"></span>
                                            <div id="bassPreview" class="preview-container"></div>
                                        </td>
                                        <td>
                                            <label for="drum_images">Drum Files Upload</label>
                                            <input type="file" name="drum_images[]" id="drum_images" multiple accept="image/*,video/*" onchange="previewFiles(this, 'drumPreview')">
                                            <span class="error_msg drum_images"></span>
                                            <div id="drumPreview" class="preview-container"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="guitar_images">Guitar Files Upload</label>
                                            <input type="file" name="guitar_images[]" id="guitar_images" multiple accept="image/*,video/*" onchange="previewFiles(this, 'guitarPreview')">
                                            <span class="error_msg guitar_images"></span>
                                            <div id="guitarPreview" class="preview-container"></div>
                                        </td>
                                        <td>
                                            <label for="keyboard_images">Keyboard Files Upload</label>
                                            <input type="file" name="keyboard_images[]" id="keyboard_images" multiple accept="image/*,video/*" onchange="previewFiles(this, 'keyboardPreview')">
                                            <span class="error_msg keyboard_images"></span>
                                            <div id="keyboardPreview" class="preview-container"></div>
                                        </td>
                                    </tr>
                                    <!-- <td colspan="2">clap images upload
                                    <input type="file" name="clap_images[]" id="clap_images" multiple>
                                    <span class="error_msg  clap_images"></span>
                                </td> -->
                                    </tr>
                                </table>
                            </div>

                            <div class="gl_heading_black mt-3 ">
                                Select Zone Type
                                <select name="zone_type" id="mySelect" class="form-control">
                                    <option value="">Please Select Zone Type</option>
                                    <?php
                                    if (!empty($zone)) {
                                        foreach ($zone as $keynum => $value) { ?>

                                            <option value="<?php echo $value['id']; ?>">
                                                <?php echo $value['layout_name']; ?>
                                            </option>
                                    <?php
                                        }
                                    } ?>
                                </select>
                                <span class="error_msg zone_type"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gl_upload_music_bg" style="display: none;">
                    <div class="gl_upload_music_div">

                        <div class="vocal_file" id="vocalfiles" style="display: none;">
                            <label for="gl_audio_1">
                                <div class="gl_upload_box gl_red_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Vocals</h5>
                                        <div id="file-upload-filename_1" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_red_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[1]" id="gl_audio_1">
                                </div>
                            </label>
                        </div>

                        <div class="solo_file" id="solofiles" style="display: none;">
                            <label for="gl_audio_2">
                                <div class="gl_upload_box gl_yellow_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Solo</h5>
                                        <div id="file-upload-filename_2" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_yellow_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[2]" id="gl_audio_2">
                                </div>
                            </label>
                        </div>

                        <div class="click_file" id="clickfiles" style="display: none;">
                            <label for="gl_audio_3">
                                <div class="gl_upload_box gl_blue_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Click</h5>
                                        <div id="file-upload-filename_3" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_blue_icon ">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[3]" id="gl_audio_3">
                                </div>
                            </label>
                        </div>
                        <div class="bass_files" id="bassfiles" style="display: none;">
                            <label for="gl_audio_4">
                                <div class="gl_upload_box gl_barry_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Bass</h5>
                                        <div id="file-upload-filename_4" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_barry_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[4]" id="gl_audio_4">
                                </div>
                            </label>

                        </div>
                        <div class="drums_files" id="drumsfiles" style="display: none;">
                            <label for="gl_audio_5">
                                <div class="gl_upload_box gl_purple_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Drums</h5>
                                        <div id="file-upload-filename_5" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_purple_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[5]" id="gl_audio_5">
                                </div>
                            </label>
                        </div>

                        <div class="guitar_files" id="guitarfiles" style="display: none;">

                            <label for="gl_audio_6">
                                <div class="gl_upload_box gl_green_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Guitar</h5>
                                        <div id="file-upload-filename_6" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_green_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[6]" id="gl_audio_6">
                                </div>
                            </label>
                        </div>
                        <div class="keyboard_files" id="keyboardfiles" style="display: none;">
                            <label for="gl_audio_7">
                                <div class="gl_upload_box gl_orange_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Keyboard</h5>
                                        <div id="file-upload-filename_7" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_orange_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[7]" id="gl_audio_7">
                                </div>
                            </label>
                        </div>
                        <div class="mix_files" id="masterfiles" style="display: none;">
                            <label for="gl_audio_8">
                                <div class="gl_upload_box gl_teal_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Miscellaneous</h5>
                                        <div id="file-upload-filename_8" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_teal_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[8]" id="gl_audio_8">
                                </div>
                            </label>
                        </div>

                        <div class="backing_track_files" id="backingtrackguitarfiles" style="display: none;">
                            <label for="gl_audio_9">
                                <div class="gl_upload_box gl_black_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Backing Track Guitar</h5>
                                        <div id="file-upload-filename_9" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_black_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[9]" id="gl_audio_9">
                                </div>
                            </label>
                        </div>

                        <div class="backing_track_files" id="backingtrackbassfiles" style="display: none;">
                            <label for="gl_audio_10">
                                <div class="gl_upload_box gl_black_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Backing Track Bass</h5>
                                        <div id="file-upload-filename_10" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_black_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[10]" id="gl_audio_10">
                                </div>
                            </label>
                        </div>

                        <div class="backing_track_files" id="backingtrackdrumsfiles" style="display: none;">
                            <label for="gl_audio_11">
                                <div class="gl_upload_box gl_black_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Backing Track Drums</h5>
                                        <div id="file-upload-filename_11" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_black_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[11]" id="gl_audio_11">
                                </div>
                            </label>
                        </div>

                        <div class="backing_track_files" id="backingtrackkeysfiles" style="display: none;">
                            <label for="gl_audio_12">
                                <div class="gl_upload_box gl_black_brdr">
                                    <div class="gl_upload_text">
                                        <h5>Backing Track Keys</h5>
                                        <div id="file-upload-filename_12" class="text-white"></div>
                                    </div>
                                    <div class="gl_upload_here gl_black_icon">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <input type="file" name="music_file[12]" id="gl_audio_12">
                                </div>
                            </label>
                        </div>

                        <span class="error_msg songs-files"></span>

                    </div>

                    <span class="error_msg allfile"></span>
                </div>

                <div class="gl_bypass_btn mt-4 text-right">
                    <input type="submit" name="submit" id="submit_form" value="Add" class="btn btn-success gl_btn_bg_blue">
                </div>
        </form>
    </div>
</div>