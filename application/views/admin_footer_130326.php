        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Karakover <?php echo date('Y'); ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <?php $siteUrlUri = $this->uri->segment('2'); ?>

        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

        <!-- class test JavaScript-->
        <!-- 04012024 -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- 04012024 -->

        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url(); ?>assets/js/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <?php if ($siteUrlUri == 'dashboard') { ?>
            <script src="<?php echo base_url(); ?>assets/js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/demo/chart-pie-demo.js"></script>
        <?php } ?>

        <!-- Page level plugins -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dropzone.css">
        <script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>

        <!-- Page level custom scripts -->
        <script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

        <!-- <script src="<?php echo base_url(); ?>assets/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/toastr.min.css"> -->

        <script src="<?php echo base_url(); ?>assets/js/dobpicker.js"></script>

        <?php if ($siteUrlUri == "dashboard") { ?>
            <!-- Page level plugins -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <?php } ?>

        <script>
            var fileUri = '<?php echo $this->uri->segment(2); ?>';
            // upload songs ui changes when upload imge
            function myFunction() {
                var fileInput = document.getElementById('gl_cover_art');
                var filePath = fileInput.value;
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

                if (!allowedExtensions.exec(filePath)) {
                    alert('Invalid file type,Please select jpg|png|gif');
                    fileInput.value = '';
                    return false;
                } else {
                    var file = document.getElementById("gl_cover_art");
                    var element = document.querySelector(".gl_upload_cover_img");
                    var element1 = document.getElementById("blah");
                    element1.setAttribute("src", window.URL.createObjectURL(file.files[0]));
                    document.getElementById("blah").style.display = 'block';
                    element.classList.add("show_img");
                }
            }


            function checkNumberStatus() {
                //alert("came");
                var phone = $(".phone-no").val(); // value in field email
                var country = $(".country-code").val(); // value in field email
                var user_type = $(".user_type").val(); // value in field email
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>home/checknumber', // put your real file name
                    data: {
                        phone: phone,
                        country: country,
                        user_type: user_type
                    },
                    success: function(msg) {
                        //alert(msg); // your message will come here.
                        if (msg == 1) {
                            $(".submitternamee").text("Mobile Number Already Exists");
                            document.getElementById("myBtn1").disabled = true;
                        } else {
                            $(".submitternamee").text("");
                            document.getElementById("myBtn1").disabled = false;
                        }
                    }
                });
            }


            function checkMailStatus() {
                var email = $(".email").val(); // value in field email
                var user_type = $(".user_type").val(); // value in field email
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>home/checkmail', // put your real file name
                    data: {
                        email: email,
                        user_type: user_type
                    },
                    success: function(msg) {
                        //alert(msg); // your message will come here.
                        if (msg == 1) {
                            $(".submittername").text("Email Already Exists");
                            document.getElementById("myBtn1").disabled = true;
                        } else {
                            $(".submittername").text("");
                            document.getElementById("myBtn1").disabled = false;
                        }
                    }
                });
            }
        </script>

        <script type="text/javascript">
            Dropzone.options.myDropzone = {
                url: "<?php echo base_url('admin/uploadfolder_songs'); ?>",
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,
                acceptedFiles: "image/*,audio/*",

                init: function() {
                    var submitButton = document.querySelector("#submit-all");
                    var wrapperThis = this;

                    submitButton.addEventListener("click", function() {
                        wrapperThis.processQueue();
                    });

                    this.on("addedfile", function(file) {
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<button class='btn btn-danger btn-sm mt-2 w-100'>Remove</button>");

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                            // Make sure the button click doesn't submit the form:
                            e.preventDefault();
                            e.stopPropagation();
                            // Remove the file preview.
                            wrapperThis.removeFile(file);
                            // If you want to the delete the file on the server as well,
                            // you can do the AJAX request here.
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });

                    this.on('sendingmultiple', function(data, xhr, formData) {
                        //formData.append("Username", $("#Username").val());
                    });

                    this.on("success", function(file) {
                        var idvar = $.trim(file.xhr.response);
                        if (idvar == 1) {
                            toastr.success("Songs Added Successfully!");
                            window.location.href = "<?php echo base_url('admin/songsList'); ?>";
                        }

                        if (idvar == 0) {
                            toastr.error("Something Went Wrong.!");
                            window.location.href = "<?php echo base_url('admin/songsList'); ?>";
                        }

                        console.log(idvar, file);
                        //window.location.replace("/admin/ShopList);
                    });
                }
            };
        </script>

        <script type="text/javascript">
            $("document").ready(function() {
                setTimeout(function() {
                    $(".alert").slideUp();
                }, 3000); // 3 secs
            });

            $(".toggle-password").click(function() {
                $(this).toggleClass("fa-eye-slash fa-eye");
                var input = $('#userpassword');
                if (input.attr("type") == "password") {
                    $('body').find('#userpassword').prop("type", "text");
                } else {
                    input.prop("type", "password");
                }
            });

            $("document").ready(function() {
                if (fileUri == 'dashboard') {
                    google.charts.load('current', {
                        'packages': ['line']
                    });
                    google.charts.setOnLoadCallback(drawChart);
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawBar);

                    function drawChart() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('number', 'Plays');
                        data.addColumn('number', 'Artist');
                        data.addColumn('number', 'Favourite');
                        data.addColumn('number', 'Users');

                        data.addRows([
                            [1, 37.8, 80.8, 41.8],
                            [2, 30.9, 69.5, 32.4],
                            [3, 25.4, 57, 25.7],
                            [4, 11.7, 18.8, 10.5],
                            [5, 11.9, 17.6, 10.4],
                            [6, 8.8, 13.6, 7.7],
                            [7, 7.6, 12.3, 9.6],
                            [8, 12.3, 29.2, 10.6],
                            [9, 16.9, 42.9, 14.8],
                            [10, 12.8, 30.9, 11.6],
                            [11, 5.3, 7.9, 4.7],
                            [12, 6.6, 8.4, 5.2],
                            [13, 4.8, 6.3, 3.6],
                            [14, 4.2, 6.2, 3.4]
                        ]);

                        var options = {
                            chart: {
                                title: 'Total Plays',
                            },
                            width: '100%',
                            height: '300',
                            axes: {
                                x: {
                                    0: {
                                        side: 'top'
                                    }
                                }
                            }
                        };

                        var chart = new google.charts.Line(document.getElementById('line_top_x'));
                        chart.draw(data, google.charts.Line.convertOptions(options));
                    }

                    //Add Bar Chart
                    function drawBar() {
                        var data = google.visualization.arrayToDataTable([
                            ['Music Zones', 'Artist', 'Users', 'Favourite'],
                            ['V1', 400, 400, 200],
                            ['V2', 470, 260, 250],
                            ['V3', 460, 520, 300],
                            ['V4', 260, 220, 180],
                        ]);

                        var options = {
                            chart: {
                                title: 'Section popularity',
                            },
                            bars: 'vertical' // Required for Material Bar Charts.
                        };
                        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                }
            });
        </script>
        </body>

        </html>


        <script type="text/javascript">
            $('#select_user').on('change', function() {
                var value = $(this).val();
                if (value == 1) {
                    $('.artistclass').css('display', 'block');
                } else {
                    $('.artistclass').css('display', 'none');
                }
            });
        </script>

        <script type="text/javascript">
            function previewImages() {
                var input = document.getElementById('gl_cover_art');
                var previewContainer = document.getElementById('image-preview');
                var files = input.files;

                previewContainer.innerHTML = '';

                if (files) {
                    for (var i = 0; i < files.length; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(previewContainer).width(200).height(250);
                        };

                        reader.readAsDataURL(files[i]);
                    }
                }
            }

            function previewChords(input) {
                const preview = document.getElementById('videoPreview');
                const source = preview.querySelector('source');

                if (input.files && input.files[0]) {
                    const fileURL = URL.createObjectURL(input.files[0]);
                    source.src = fileURL;
                    preview.style.display = 'block';
                    preview.load(); // Refresh video source
                }
            }

            function previewMasterSong(input) {
                const audio = document.getElementById('audioPreview');

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const url = URL.createObjectURL(file);

                    audio.src = url;
                    audio.style.display = 'block';
                } else {
                    audio.src = '';
                    audio.style.display = 'none';
                }
            }

            // Store selected files for each input
            const selectedFiles = {
                drum_images: [],
                guitar_images: [],
                keyboard_images: [],
                bass_images: []
            };

            // Main Preview Function
            function previewFiles(input, previewId) {
                const preview = document.getElementById(previewId);
                const errorSpan = document.querySelector(`.error_msg.${input.id}`);
                errorSpan.innerHTML = '';

                if (!input.files) return;

                const newFiles = Array.from(input.files);
                let hasError = false;

                if (!selectedFiles[input.id]) {
                    selectedFiles[input.id] = [];
                }

                const existingFiles = selectedFiles[input.id];

                newFiles.forEach(file => {
                    const fileSizeMB = file.size / (1024 * 1024);
                    const fileType = file.type;

                    if (fileType.startsWith('image/')) {
                        if (fileSizeMB > 5) {
                            errorSpan.innerHTML = `Image "${file.name}" is too large. Max allowed is 5 MB.`;
                            hasError = true;
                            return;
                        }
                    } else if (fileType.startsWith('video/')) {
                        if (fileSizeMB > 50) {
                            errorSpan.innerHTML = `Video "${file.name}" is too large. Max allowed is 50 MB.`;
                            hasError = true;
                            return;
                        }
                    } else {
                        errorSpan.innerHTML = `Unsupported file type: ${file.name}`;
                        hasError = true;
                        return;
                    }

                    // Prevent duplicates
                    if (!existingFiles.some(f => f.name === file.name && f.size === file.size)) {
                        existingFiles.push(file);
                    }
                });

                if (!hasError) {
                    renderPreviews(input.id, preview);
                }
            }


            // Renders previews properly (FULL REPLACE)
            function renderPreviews(inputId, previewContainer) {
                previewContainer.innerHTML = ""; // CLEAR old previews first

                selectedFiles[inputId].forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'preview-item';

                        let previewHtml = '';

                        if (file.type.startsWith('image/')) {
                            previewHtml = `<img src="${e.target.result}" width="100" height="100">`;
                        } else if (file.type.startsWith('video/')) {
                            previewHtml = `
                    <video width="175" height="100" controls>
                        <source src="${e.target.result}" type="${file.type}">
                    </video>
                `;
                        }

                        div.innerHTML = `
                ${previewHtml}
                <button type="button" class="remove-btn" onclick="removeNewFile('${inputId}', ${index})">×</button>
            `;

                        previewContainer.appendChild(div);
                    };

                    reader.readAsDataURL(file);
                });
            }


            // Remove File + Re-render
            function removeNewFile(inputId, index) {
                selectedFiles[inputId].splice(index, 1);

                // PREVIEW CONTAINER MAP (corrected)
                const previewIdMap = {
                    drum_images: "drumPreview",
                    guitar_images: "guitarPreview",
                    keyboard_images: "keyboardPreview",
                    bass_images: "bassPreview"
                };

                const preview = document.getElementById(previewIdMap[inputId]);
                renderPreviews(inputId, preview);
            }


            // Remove existing (already uploaded) file
            function removeExistingFile(button, type, filename) {
                if (confirm('Are you sure you want to remove this file?')) {
                    const div = button.parentNode;
                    div.remove();

                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'deleted_' + type + '_files[]';
                    input.value = filename;

                    document.getElementById('mixSongs-upload-edit-form').appendChild(input);
                }
            }

            // end code created by @krishn on 26-04-25
            function previewImages1() {
                var input = document.getElementById('gl_cover_art1');
                var previewContainer = document.getElementById('image-preview1');
                var files = input.files;

                previewContainer.innerHTML = '';

                if (files) {
                    for (var i = 0; i < files.length; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(previewContainer).width(200).height(250);
                        };

                        reader.readAsDataURL(files[i]);
                    }
                }
            }
        </script>


        <?php if ($siteUrlUri == "dashboard") { ?>

        <?php } ?>

        <script type="text/javascript">
            ////Zone TYpe select
            $('#mySelect').on('change', function() {
                var value = $(this).val();
                if (value == 0) {
                    $('.gl_upload_music_bg').hide();
                    $("#vocalfiles").hide();
                    $("#solofiles").hide();
                    $("#bassfiles").hide();
                    $("#clickfiles").hide();
                    $("#drumsfiles").hide();
                    $("#guitarfiles").hide();
                    $("#keyboardfiles").hide();
                    $("#masterfiles").hide();
                    $("#backingtrackguitarfiles").hide();
                    $("#backingtrackbassfiles").hide();
                    $("#backingtrackdrumsfiles").hide();
                    $("#backingtrackkeysfiles").hide();
                } else if (value == 1) {
                    $('.gl_upload_music_bg').show();
                    $("#vocalfiles").show();
                    $("#solofiles").hide();
                    $("#bassfiles").show();
                    $("#clickfiles").show();
                    $("#drumsfiles").hide();
                    $("#guitarfiles").hide();
                    $("#keyboardfiles").hide();
                    $("#masterfiles").hide();
                    $("#backingtrackguitarfiles").hide();
                    $("#backingtrackbassfiles").show();
                    $("#backingtrackdrumsfiles").hide();
                    $("#backingtrackkeysfiles").hide();
                } else if (value == 2) {
                    $('.gl_upload_music_bg').show();
                    $("#vocalfiles").show();
                    $("#solofiles").hide();
                    $("#bassfiles").hide();
                    $("#clickfiles").show();
                    $("#drumsfiles").show();
                    $("#guitarfiles").hide();
                    $("#keyboardfiles").hide();
                    $("#masterfiles").hide();
                    $("#backingtrackguitarfiles").hide();
                    $("#backingtrackbassfiles").hide();
                    $("#backingtrackdrumsfiles").show();
                    $("#backingtrackkeysfiles").hide();
                } else if (value == 3) {
                    $('.gl_upload_music_bg').show();
                    $("#vocalfiles").show();
                    $("#solofiles").hide();
                    $("#solofiles").show();
                    $("#bassfiles").hide();
                    $("#clickfiles").show();
                    $("#drumsfiles").hide();
                    $("#guitarfiles").show();
                    $("#keyboardfiles").hide();
                    $("#masterfiles").hide();
                    $("#backingtrackguitarfiles").show();
                    $("#backingtrackbassfiles").hide();
                    $("#backingtrackdrumsfiles").hide();
                    $("#backingtrackkeysfiles").hide();
                } else if (value == 4) {
                    $('.gl_upload_music_bg').show();
                    $("#vocalfiles").show();
                    $("#solofiles").hide();
                    $("#bassfiles").hide();
                    $("#clickfiles").show();
                    $("#drumsfiles").hide();
                    $("#guitarfiles").hide();
                    $("#keyboardfiles").show();
                    $("#masterfiles").hide();
                    $("#backingtrackguitarfiles").hide();
                    $("#backingtrackbassfiles").hide();
                    $("#backingtrackdrumsfiles").hide();
                    $("#backingtrackkeysfiles").show();
                } else {
                    $('.gl_upload_music_bg').show();
                    $("#vocalfiles").show();
                    $("#solofiles").show();
                    $("#bassfiles").show();
                    $("#clickfiles").show();
                    $("#drumsfiles").show();
                    $("#guitarfiles").show();
                    $("#keyboardfiles").show();
                    $("#masterfiles").show();
                    $("#backingtrackguitarfiles").hide();
                    $("#backingtrackbassfiles").hide();
                    $("#backingtrackdrumsfiles").hide();
                    $("#backingtrackkeysfiles").hide();
                }
            });


            $(document).ready(function($) {
                $("#mixSongs-upload-form").on('submit', function(e) {
                    e.preventDefault();
                    var track = $('#track').val();

                    if (track == "") {
                        $('.track').html('The track field is required.');
                        return false;
                    } else {
                        $('.track').html('');
                    }

                    var label = $('#label').val();

                    if (label == "") {
                        $('.label-error').html('The label field is required.');
                        return false;
                    } else {
                        $('.label-error').html('');
                    }

                    var release = $('#release_year').val();

                    if (release == "") {
                        $('.release_year').html('The release year field is required.');
                        return false;
                    } else {
                        $('.release_year').html('');
                    }

                    // ---------------- Cover Image Validation ----------------
                    var coverInput = document.querySelector("#gl_cover_art");

                    if (!coverInput || coverInput.files.length === 0) {
                        $('.gl_cover_art_error').html('Cover image is required.');
                        return false;
                    } else {

                        var coverFile = coverInput.files[0];
                        var coverSizeMB = coverFile.size / (1024 * 1024);

                        // Allowed image types
                        var allowedImageTypes = [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                            'image/webp'
                        ];

                        // Check extension fallback
                        var extension = coverFile.name.split('.').pop().toLowerCase();
                        var allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

                        if (!allowedImageTypes.includes(coverFile.type) && !allowedExtensions.includes(extension)) {
                            $('.gl_cover_art_error').html('Please upload a valid image file (JPG, JPEG, PNG, WEBP).');
                            return false;
                        }

                        // Check file size (5MB)
                        if (coverSizeMB > 5) {
                            $('.gl_cover_art_error').html('Image size must be less than 5 MB.');
                            return false;
                        } else {
                            $('.gl_cover_art_error').html('');
                        }
                    }

                    // ---------------- Chord File Validation ----------------
                    var chordsInput = document.querySelector("#chords");

                    if (!chordsInput || chordsInput.files.length === 0) {
                        $('.chords').html('Chord file is required.');
                        return false;
                    } else {
                        var chordFile = chordsInput.files[0];
                        var chordSizeBytes = chordFile.size;
                        var chordSizeMB = chordSizeBytes / (1024 * 1024);

                        // Check if file size is larger than 50MB
                        if (chordSizeMB > 50) {
                            $('.chords').html('The selected file is too large. Please upload a file smaller than 50 MB.');
                            return false;
                        } else {
                            $('.chords').html('');
                        }
                    }


                    // ---------------- Master Song Validation ----------------
                    var masterSongInput = document.querySelector("#master_song");

                    if (!masterSongInput || masterSongInput.files.length === 0) {
                        $('.master_song').html('Master song file is required.');
                        return false;
                    } else {

                        var masterFile = masterSongInput.files[0];
                        var masterFileSizeBytes = masterFile.size;
                        var masterFileSizeMB = masterFileSizeBytes / (1024 * 1024);

                        // Allowed audio types
                        var allowedTypes = [
                            'audio/mpeg', // mp3
                            'audio/wav', // wav
                            'audio/mp4', // m4a
                            'audio/aac'
                        ];

                        // Also check extension in case MIME type is empty
                        var fileExtension = masterFile.name.split('.').pop().toLowerCase();
                        var allowedExtensions = ['mp3', 'wav', 'm4a', 'aac'];

                        if (!allowedTypes.includes(masterFile.type) && !allowedExtensions.includes(fileExtension)) {
                            $('.master_song').html('Please upload a valid audio file (MP3, WAV, M4A, AAC).');
                            return false;
                        }

                        // Check file size (50MB)
                        if (masterFileSizeMB > 50) {
                            $('.master_song').html('The selected file is too large. Please upload a file smaller than 50 MB.');
                            return false;
                        } else {
                            $('.master_song').html('');
                        }
                    }

                    // --------------------------------------------------------------------------

                    const inputs = {};
                    for (let i = 1; i <= 12; i++) {
                        const el = document.getElementById(`gl_audio_${i}`);
                        inputs[i] = el && el.files ? el.files.length : 0;
                    }

                    const zoneRules = {
                        1: [1, 3, 4, 10], // Bass
                        2: [1, 3, 5, 11], // Drums
                        3: [1, 2, 3, 6, 9], // Guitar
                        4: [1, 3, 7, 12], // Keyboard
                        5: [1, 2, 3, 4, 5, 6, 7, 8] // Full Access
                    };

                    const zone_type = $('select[name=zone_type]').val();

                    if (!zone_type) {
                        $('.zone_type').html('Select Zone Type is required.');
                        return false;
                    } else {
                        $('.zone_type').html('');
                    }

                    const requiredFields = zoneRules[zone_type];

                    if (requiredFields) {
                        const missing = requiredFields.filter(i => inputs[i] === 0);

                        if (missing.length > 0) {
                            $('.songs-files').html(
                                `Please select ${missing.length} more file(s).`
                            );
                            return false;
                        } else {
                            $('.songs-files').html('');
                        }
                    }
                    // ---------------------------------------------------------------------

                    actionurl = $('#mixSongs-upload-form').attr('action');
                    $.ajax({
                        url: actionurl,
                        type: 'post',
                        dataType: "JSON",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,

                        beforeSend: function() {
                            $('#loader').removeClass('hidden')
                        },

                        success: function(data) {
                            toastr.success(data.msg);
                            window.location.href = data.redirect;
                        },

                        complete: function() {
                            $('#loader').addClass('hidden')
                        },
                    });
                });

                //Single upload songs validation
                $("#singleSongs-upload-form").on('submit', function(e) {
                    e.preventDefault();
                    var track = $('#track').val();

                    if (track == "") {
                        $('.track').html('The track field is required.');
                        return false;
                    } else {
                        $('.track').html('');
                    }

                    var label = $('#label').val();
                    if (label == "") {
                        $('.label-error').html('The label field is required.');
                        return false;
                    } else {
                        $('.label-error').html('');
                    }

                    var release = $('#release_year').val();
                    if (release == "") {
                        $('.release_year').html('The release year field is required.');
                        return false;
                    } else {
                        $('.release_year').html('');
                    }

                    var coverImg = document.getElementById('gl_cover_art').value;
                    if (coverImg == "") {
                        $('.gl_cover_art').html('Please select file.');
                        return false;
                    } else {
                        $('.gl_cover_art').html('');
                    }

                    var input1 = document.getElementById('gl_audio_5').value;
                    if (input1 == "") {
                        $('.songs-files').html('Please select file.');
                        return false;
                    } else {
                        $('.songs-files').html('');
                    }

                    actionurl = $('#singleSongs-upload-form').attr('action');
                    $.ajax({
                        url: actionurl,
                        type: 'post',
                        dataType: "JSON",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,

                        beforeSend: function() {
                            $('#loader').removeClass('hidden')
                        },

                        success: function(data) {
                            toastr.success(data.msg);
                            window.location.href = data.redirect;
                        },

                        complete: function() {
                            $('#loader').addClass('hidden')
                        },
                    });
                });

                //Edit Multiple Songs validation
                $("#mixSongs-upload-edit-form").on('submit', function(e) {
                    e.preventDefault();
                    var track = $('#track').val();

                    if (track == "") {
                        $('.track').html('The track field is required.');
                        return false;
                    } else {
                        $('.track').html('');
                    }

                    var label = $('#label').val();
                    if (label == "") {
                        $('.label-error').html('The label field is required.');
                        return false;
                    } else {
                        $('.label-error').html('');
                    }

                    var release = $('#release_year').val();
                    if (release == "") {
                        $('.release_year').html('The release year field is required.');
                        return false;
                    } else {
                        $('.release_year').html('');
                    }

                    var file = document.querySelector("#chords");
                    // console.log(file);
                    if (file.files[0]) {
                        var fileSizeInBytes = file.files[0].size; // Use file.files[0].size to get the size of the selected file
                        var fileSizeInMb = fileSizeInBytes / (1024 * 1024); // Convert bytes to Megabytes
                        // Checking if file size is larger than 50MB
                        if (fileSizeInMb > 50) {
                            // alert("File size is larger than 50MB.");
                            $('.chords').html('The selected file is too large. Please upload a file smaller than 50 MB.');
                            return false;
                        } else {
                            $('.chords').html('');
                        }
                    }

                    var masterSongfile = document.querySelector("#master_song");
                    if (masterSongfile.files[0]) {
                        var fileSizeInBytes = masterSongfile.files[0].size; // Use file.files[0].size to get the size of the selected file
                        var fileSizeInMb = fileSizeInBytes / (1024 * 1024); // Convert bytes to Megabytes
                        // Checking if file size is larger than 50MB
                        if (fileSizeInMb > 50) {
                            // alert("File size is larger than 50MB.");
                            $('.master_song').html('The selected file is too large. Please upload a file smaller than 50 MB.');
                            return false;
                        } else {
                            $('.master_song').html('');
                        }
                    }

                    // validation for bass files added by @krishn on 19-05-25
                    document.querySelector("#bass_images").addEventListener("change", function() {
                        const files = this.files;
                        let isValid = true;
                        let errorMsg = "";

                        if (files.length > 0) {
                            for (let i = 0; i < files.length; i++) {
                                const file = files[i];
                                const fileType = file.type;
                                const fileSizeMB = file.size / (1024 * 1024);

                                if (fileType.startsWith("image/")) {
                                    if (fileSizeMB > 5) {
                                        isValid = false;
                                        errorMsg = "Each image must be less than 5 MB.";
                                        break;
                                    }
                                } else if (fileType.startsWith("video/")) {
                                    if (fileSizeMB > 50) {
                                        isValid = false;
                                        errorMsg = "Each video must be less than 50 MB.";
                                        break;
                                    }
                                } else {
                                    isValid = false;
                                    errorMsg = "Only image and video files are allowed.";
                                    break;
                                }
                            }
                        }

                        if (!isValid) {
                            $('.bass_images').html(errorMsg);
                            this.value = ""; // Reset file input
                        } else {
                            $('.bass_images').html("");
                        }
                    });

                    // validation for drum files added by @krishn on 19-05-25
                    document.querySelector("#drum_images").addEventListener("change", function() {
                        const files = this.files;
                        let errorMsg = '';

                        for (let i = 0; i < files.length; i++) {
                            const file = files[i];
                            const fileType = file.type;
                            const fileSizeMB = file.size / (1024 * 1024);

                            if (fileType.startsWith("image/")) {
                                if (fileSizeMB > 5) {
                                    errorMsg = `Image "${file.name}" exceeds 5 MB limit.`;
                                    break;
                                }
                            } else if (fileType.startsWith("video/")) {
                                if (fileSizeMB > 50) {
                                    errorMsg = `Video "${file.name}" exceeds 50 MB limit.`;
                                    break;
                                }
                            } else {
                                errorMsg = `File "${file.name}" is not a supported image or video format.`;
                                break;
                            }
                        }

                        if (errorMsg) {
                            $('.drum_images').html(errorMsg);
                            this.value = ""; // Reset file input
                        } else {
                            $('.drum_images').html(""); // Clear previous errors
                        }
                    });

                    // validation for guitar files added by @krishn on 19-05-25
                    document.querySelector("#guitar_images").addEventListener("change", function() {
                        const files = this.files;
                        let errorMsg = '';

                        for (let i = 0; i < files.length; i++) {
                            const file = files[i];
                            const fileType = file.type;
                            const fileSizeMB = file.size / (1024 * 1024);

                            if (fileType.startsWith("image/")) {
                                if (fileSizeMB > 5) {
                                    errorMsg = `Image "${file.name}" exceeds 5 MB limit.`;
                                    break;
                                }
                            } else if (fileType.startsWith("video/")) {
                                if (fileSizeMB > 50) {
                                    errorMsg = `Video "${file.name}" exceeds 50 MB limit.`;
                                    break;
                                }
                            } else {
                                errorMsg = `File "${file.name}" is not a supported image or video format.`;
                                break;
                            }
                        }

                        if (errorMsg) {
                            $('.guitar_images').html(errorMsg);
                            this.value = ""; // Clear invalid files
                        } else {
                            $('.guitar_images').html("");
                        }
                    });

                    // validation for keyboard files added by @krishn on 19-05-25
                    document.querySelector("#keyboard_images").addEventListener("change", function() {
                        const files = this.files;
                        let errorMsg = '';

                        for (let i = 0; i < files.length; i++) {
                            const file = files[i];
                            const fileType = file.type;
                            const fileSizeMB = file.size / (1024 * 1024);

                            if (fileType.startsWith("image/")) {
                                if (fileSizeMB > 5) {
                                    errorMsg = `Image "${file.name}" exceeds 5 MB limit.`;
                                    break;
                                }
                            } else if (fileType.startsWith("video/")) {
                                if (fileSizeMB > 50) {
                                    errorMsg = `Video "${file.name}" exceeds 50 MB limit.`;
                                    break;
                                }
                            } else {
                                errorMsg = `File "${file.name}" is not a supported image or video format.`;
                                break;
                            }
                        }

                        if (errorMsg) {
                            $('.keyboard_images').html(errorMsg);
                            this.value = ""; // Clear invalid files
                        } else {
                            $('.keyboard_images').html("");
                        }
                    });

                    var zone_type = $('select[name=zone_type]').val();
                    if (zone_type == "") {
                        $('.zone_type').html('Select Zone Type is required.');
                        return false;
                    } else {
                        $('.zone_type').html('');
                    }

                    actionurl = $('#mixSongs-upload-edit-form').attr('action');

                    $.ajax({
                        url: actionurl,
                        type: 'post',
                        dataType: "JSON",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,

                        beforeSend: function() {
                            $('#loader').removeClass('hidden')
                        },

                        success: function(data) {
                            toastr.success(data.msg);
                            window.location.href = data.redirect;
                        },

                        complete: function() {
                            $('#loader').addClass('hidden')
                        },
                    });
                });
            });
        </script>


        <script type="text/javascript">
            <?php if ($this->session->flashdata('success')) { ?>
                toastr.success("<?php echo $this->session->flashdata('success'); ?>");
            <?php } else if ($this->session->flashdata('error')) {  ?>
                toastr.error("<?php echo $this->session->flashdata('error'); ?>");
            <?php } else if ($this->session->flashdata('warning')) {  ?>
                toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
            <?php } else if ($this->session->flashdata('info')) {  ?>
                toastr.info("<?php echo $this->session->flashdata('info'); ?>");
            <?php } ?>
        </script>

        <script type="text/javascript">
            $(document).ready(function($) {
                $(".playbutton").click(function() {
                    $(".playbutton").toggleClass("pause");
                });

                if (fileUri == 'uploadSongs' || fileUri == 'uploadSongsNew' || fileUri == 'editUploadSongs' || fileUri == 'uploadSingleSong') {
                    // first box
                    let input = document.getElementById('gl_audio_1');
                    let infoArea = document.getElementById('file-upload-filename_1');
                    input.addEventListener('change', showFileName);

                    function showFileName(event) {
                        var file = document.querySelector("#gl_audio_1");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 files and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea.textContent = fileName;
                        }

                    }
                    ///second box
                    let input1 = document.getElementById('gl_audio_2');
                    let infoArea1 = document.getElementById('file-upload-filename_2');
                    input1.addEventListener('change', showFileName1);

                    function showFileName1(event) {
                        var file = document.querySelector("#gl_audio_2");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea1.textContent = fileName;
                        }
                    }
                    ///third box
                    let input2 = document.getElementById('gl_audio_3');
                    let infoArea2 = document.getElementById('file-upload-filename_3');
                    input2.addEventListener('change', showFileName2);

                    function showFileName2(event) {
                        var file = document.querySelector("#gl_audio_3");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea2.textContent = fileName;
                        }
                    }
                    ///four box
                    let input3 = document.getElementById('gl_audio_4');
                    let infoArea3 = document.getElementById('file-upload-filename_4');
                    input3.addEventListener('change', showFileName3);

                    function showFileName3(event) {
                        var file = document.querySelector("#gl_audio_4");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea3.textContent = fileName;
                        }
                    }
                    ///five box
                    let input4 = document.getElementById('gl_audio_5');
                    let infoArea4 = document.getElementById('file-upload-filename_5');
                    input4.addEventListener('change', showFileName4);

                    function showFileName4(event) {
                        var file = document.querySelector("#gl_audio_5");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea4.textContent = fileName;
                        }
                        // console.log(input.files) ; 

                    }
                    ///six box
                    let input5 = document.getElementById('gl_audio_6');
                    let infoArea5 = document.getElementById('file-upload-filename_6');
                    input5.addEventListener('change', showFileName5);

                    function showFileName5(event) {
                        var file = document.querySelector("#gl_audio_6");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea5.textContent = fileName;
                        }
                    }

                    ///seven box
                    let input6 = document.getElementById('gl_audio_7');
                    let infoArea6 = document.getElementById('file-upload-filename_7');
                    input6.addEventListener('change', showFileName6);

                    function showFileName6(event) {
                        var file = document.querySelector("#gl_audio_7");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea6.textContent = fileName;
                        }
                    }

                    ///eight box
                    let input7 = document.getElementById('gl_audio_8');
                    let infoArea7 = document.getElementById('file-upload-filename_8');
                    input7.addEventListener('change', showFileName7);

                    function showFileName7(event) {
                        var file = document.querySelector("#gl_audio_8");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea7.textContent = fileName;
                        }
                    }

                    ///nine box
                    let input8 = document.getElementById('gl_audio_9');
                    let infoArea8 = document.getElementById('file-upload-filename_9');
                    input8.addEventListener('change', showFileName8);

                    function showFileName8(event) {
                        var file = document.querySelector("#gl_audio_9");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea8.textContent = fileName;
                        }
                    }

                    ///ten box
                    let input9 = document.getElementById('gl_audio_10');
                    let infoArea9 = document.getElementById('file-upload-filename_10');
                    input9.addEventListener('change', showFileName9);

                    function showFileName9(event) {
                        var file = document.querySelector("#gl_audio_10");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea9.textContent = fileName;
                        }
                    }

                    ///eleven box
                    let input10 = document.getElementById('gl_audio_11');
                    let infoArea10 = document.getElementById('file-upload-filename_11');
                    input10.addEventListener('change', showFileName10);

                    function showFileName10(event) {
                        var file = document.querySelector("#gl_audio_11");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea10.textContent = fileName;
                        }
                    }

                    ///twelve box
                    let input11 = document.getElementById('gl_audio_12');
                    let infoArea11 = document.getElementById('file-upload-filename_12');
                    input11.addEventListener('change', showFileName11);

                    function showFileName11(event) {
                        var file = document.querySelector("#gl_audio_12");
                        if (/\.(wav|mp3|m4a)$/i.test(file.files[0].name) === false) {
                            alert("Please select Mp3 file and Wav,m4a files only!");
                        } else {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea11.textContent = fileName;
                        }
                    }


                }

            });
        </script>

        <script>
            $(document).ready(function($) {
                // 16012024
                $('.addimg_submit').click(function() {
                    var file = document.querySelector("#gl_cover_art");
                    if (file.files[0] == undefined) {
                        $('.gl_cover_art_error').html('Cover Image is required.');
                        return false;
                    }
                });
                // 16012024

                // $('.collapse-item').click(function(){
                //     alert('1');
                //     var User_List=$(this).data('name');
                //     var url=$(this).attr('href');
                //     alert(url);
                //     alert($(this).data('name'));
                //     if(User_List=='User_List'){
                //         $(this).addClass("active");
                //         alert('aaaaa');
                //     }else{
                //         alert('bbbb');
                //     }
                //     $(this).data('name')
                // })
            });
        </script>

        <?php if ($siteUrlUri == 'songsList') { ?>
            <script>
                $(document).ready(function() {

                    // Get already initialized DataTable
                    var table = $('#dataTable').DataTable();

                    // Move instrument filter before search
                    if ($('#instrumentFilter').length === 0) {
                        $('#dataTable_filter').prepend(`
                    <select id="instrumentFilter" class="form-control mr-2" style="width:220px; display:inline-block;">
                        <option value="">All Instruments</option>
                        <?php foreach ($instruments as $instrument) { ?>
                        <option value="<?= $instrument['instrument']; ?>">
                            <?= $instrument['instrument']; ?>
                        </option>
                        <?php } ?>
                    </select>
                    `);
                    }

                    // Filter logic
                    $('#instrumentFilter').on('change', function() {
                        table.column(6).search(this.value).draw(); // instrument column index
                    });

                });
            </script>
        <?php } ?>

        <script type="text/javascript">
            $(document).ready(function() {

                const zoneToInstrumentMap = {
                    1: 2,
                    2: 3,
                    3: 1,
                    4: 4,
                    5: 5
                };

                function autoSelectInstrument(zoneValue) {

                    const instrumentSelect = $('select[name="instrument_id"]');

                    if (!instrumentSelect.length) return;

                    if (zoneToInstrumentMap[zoneValue]) {

                        instrumentSelect.val(zoneToInstrumentMap[zoneValue]);
                        instrumentSelect.prop('disabled', true);

                        // ensure value submits even if disabled
                        if ($('#instrument_hidden').length === 0) {
                            instrumentSelect.after('<input type="hidden" id="instrument_hidden" name="instrument_id">');
                        }

                        $('#instrument_hidden').val(zoneToInstrumentMap[zoneValue]);

                    } else {
                        instrumentSelect.prop('disabled', false);
                        $('#instrument_hidden').remove();
                    }
                }

                // On zone change
                $('#mySelect').on('change', function() {
                    autoSelectInstrument($(this).val());
                });

                // On page load (important for edit page)
                if ($('#mySelect').val()) {
                    autoSelectInstrument($('#mySelect').val());
                }

            });
        </script>