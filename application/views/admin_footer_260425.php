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
            // $(function() {
            // // Multiple images preview in browser
            // var imagesPreview = function(input, placeToInsertImagePreview) {

            //     if (input.files) {
            //         var filesAmount = input.files.length;

            //         for (i = 0; i < filesAmount; i++) {
            //             var reader = new FileReader();

            //             reader.onload = function(event) {
            //                 $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
            //             }

            //             reader.readAsDataURL(input.files[i]);
            //         }
            //     }

            // };

            // $('#gallery-photo-add').on('change', function() {
            //     imagesPreview(this, 'div.gallery');
            // });
            // });
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

            // created by @ krishn on 24-04-24
            function previewFiles(input, previewId) {
                const previewContainer = document.getElementById(previewId);
                previewContainer.innerHTML = ''; // Clear existing previews

                const files = Array.from(input.files);
                const newFileList = [];

                files.forEach((file, index) => {
                    const fileURL = URL.createObjectURL(file);
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('preview-item');

                    let element;
                    if (file.type.startsWith('video/')) {
                        element = document.createElement('video');
                        element.controls = true;
                        element.width = 150;
                        element.innerHTML = `<source src="${fileURL}" type="${file.type}">`;
                    } else if (file.type.startsWith('image/')) {
                        element = document.createElement('img');
                        element.src = fileURL;
                        element.style.width = '100px';
                        element.style.height = '100px';
                    }

                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = '×';
                    removeBtn.className = 'remove-btn';
                    removeBtn.onclick = () => {
                        files.splice(index, 1); // remove from original list
                        updateFileInput(input, files); // update input
                        previewFiles(input, previewId); // re-render preview
                    };

                    wrapper.appendChild(element);
                    wrapper.appendChild(removeBtn);
                    previewContainer.appendChild(wrapper);
                    newFileList.push(file);
                });
            }

            // Helper to update the input's FileList (read-only workaround)
            function updateFileInput(input, files) {
                const dataTransfer = new DataTransfer();
                files.forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;
            }



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
                    $("#stemfiles").hide();
                    $("#bassfiles").hide();
                    $("#drumsfiles").hide();
                    $("#guitarfiles").hide();
                    $("#keyboardfiles").hide();
                    $("#masterfiles").hide();
                } else if (value == 1) {
                    $('.gl_upload_music_bg').show();
                    $("#stemfiles").show();
                    $("#bassfiles").show();
                    $("#drumsfiles").hide();
                    $("#guitarfiles").hide();
                    $("#keyboardfiles").hide();
                    $("#masterfiles").hide();
                } else if (value == 2) {
                    $('.gl_upload_music_bg').show();
                    $("#stemfiles").show();
                    $("#bassfiles").hide();
                    $("#drumsfiles").show();
                    $("#guitarfiles").hide();
                    $("#keyboardfiles").hide();
                    $("#masterfiles").hide();
                } else if (value == 3) {
                    $('.gl_upload_music_bg').show();
                    $("#stemfiles").show();
                    $("#bassfiles").hide();
                    $("#drumsfiles").hide();
                    $("#guitarfiles").show();
                    $("#keyboardfiles").hide();
                    $("#masterfiles").hide();
                } else if (value == 4) {
                    $('.gl_upload_music_bg').show();
                    $("#stemfiles").show();
                    $("#bassfiles").hide();
                    $("#drumsfiles").hide();
                    $("#guitarfiles").hide();
                    $("#keyboardfiles").show();
                    $("#masterfiles").hide();
                } else {
                    $('.gl_upload_music_bg').show();
                    $("#stemfiles").show();
                    $("#bassfiles").show();
                    $("#drumsfiles").show();
                    $("#guitarfiles").show();
                    $("#keyboardfiles").show();
                    $("#masterfiles").show();
                }
                // if(value == 0)
                // {
                //   $('.gl_upload_music_bg').hide();
                //     $("#stemfiles").hide(); 
                //     $("#masterfiles").hide();
                // }
                // else if(value == 1)
                // {   
                //     $('.gl_upload_music_bg').show(); 
                //     $("#stemfiles").show(); 
                //     $("#masterfiles").hide();
                // } 
                // else
                // {
                //     $('.gl_upload_music_bg').show();
                //     $("#stemfiles").show(); 
                //     $("#masterfiles").show();
                // }
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

                    var file = document.querySelector("#gl_cover_art");

                    if (file.files[0] == undefined) {
                        $('.gl_cover_art').html('Cover Image is required.');
                        return false;
                    } else {
                        $('.gl_cover_art').html('');
                    }

                    var fileInput = document.querySelector("#chords");

                    // Check if a file has been selected
                    if (fileInput.files.length === 0 || !fileInput.files[0]) {
                        $('.chords').html('Chord file is required.');
                        return false;
                    }

                    var file = fileInput.files[0];
                    var fileSizeInBytes = file.size;
                    var fileSizeInMb = fileSizeInBytes / (1024 * 1024);

                    // console.log('File size in bytes:', fileSizeInBytes);
                    // console.log('File size in MB:', fileSizeInMb);

                    // Checking if file size is larger than 50MB
                    if (fileSizeInMb > 50) {
                        $('.chords').html('The selected file is too large. Please upload a file smaller than 50 MB.');
                        return false;
                    } else {
                        $('.chords').html('');
                    }


                    var zone_type = $('select[name=zone_type]').val();
                    if (zone_type == "") {
                        $('.zone_type').html('Select Zone Type is required.');
                        return false;
                    } else {
                        $('.zone_type').html('');
                    }

                    var input1 = document.getElementById('gl_audio_1').value;
                    var input2 = document.getElementById('gl_audio_2').value;
                    var input3 = document.getElementById('gl_audio_3').value;
                    var input4 = document.getElementById('gl_audio_4').value;
                    var input5 = document.getElementById('gl_audio_5').value;
                    var input6 = document.getElementById('gl_audio_6').value;
                    var input7 = document.getElementById('gl_audio_7').value;
                    var input8 = document.getElementById('gl_audio_8').value;

                    if (zone_type == 1) {
                        if (input1 == "" || input2 == "" || input3 == "" || input4 == "") {
                            $('.songs-files').html('Please select all 4 files.');
                            return false;
                        } else {
                            $('.songs-files').html('');
                        }
                    } else if (zone_type == 2) {
                        if (input1 == "" || input2 == "" || input3 == "" || input5 == "") {
                            $('.songs-files').html('Please select all 4 files.');
                            return false;
                        } else {
                            $('.songs-files').html('');
                        }
                    } else if (zone_type == 3) {
                        if (input1 == "" || input2 == "" || input3 == "" || input6 == "") {
                            $('.songs-files').html('Please select all 4 files.');
                            return false;
                        } else {
                            $('.songs-files').html('');
                        }
                    } else if (zone_type == 4) {
                        if (input1 == "" || input2 == "" || input3 == "" || input7 == "") {
                            $('.songs-files').html('Please select all 4 files.');
                            return false;
                        } else {
                            $('.songs-files').html('');
                        }
                    } else {
                        // if( input1 == "" || input2 == "" || input3 == "" || input4 == "" || input5 == "" || input6 == "" || input7 == "" || input8 == "" )
                        // {
                        //     $('.songs-files').html('Please select all 8 files.');
                        //     return false;
                        // } else {
                        //     $('.songs-files').html('');
                        // }
                    }

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

                //Single upload sogs validation
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
                        // console.log('>>>>>>>>>>>>>>>111',fileSizeInBytes);
                        // console.log('>>>>>>>>>>>>>>>222',fileSizeInMb);
                        // Checking if file size is larger than 50MB
                        if (fileSizeInMb > 50) {
                            // alert("File size is larger than 50MB.");
                            $('.chords').html('The selected file is too large. Please upload a file smaller than 50 MB.');
                            return false;
                        } else {
                            $('.chords').html('');
                        }
                    }

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


                }

            });
        </script>

        <script>
            $(document).ready(function($) {
                // 16012024
                $('.addimg_submit').click(function() {
                    var file = document.querySelector("#gl_cover_art");
                    if (file.files[0] == undefined) {
                        $('.gl_cover_art_error').html('Image is required.');
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