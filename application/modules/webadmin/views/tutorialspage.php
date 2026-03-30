<!-- <script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script> -->
 <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
 <script src="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.umd.js"></script>
<style>
    .media-card {
        width: 180px;
        height: 130px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        margin: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        background: #f8f8f8;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .media-card img,
    .media-card video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .remove-btn {
        position: absolute;
        top: 6px;
        /* moved inside */
        right: 6px;
        /* moved inside */
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #ff3b3b;
        color: #fff;
        border: 2px solid #fff;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        transition: 0.2s ease;
        z-index: 10;
    }

    .remove-btn:hover {
        background: #e00000;
        transform: scale(1.1);
    }

    .preview-wrapper {
        display: flex;
        flex-wrap: wrap;
    }
</style>
<div class="container-fluid">
    <div class="height20 clear"></div>

    <div class="col-sm-12">
        <div class="container">
            <?php if ($this->session->flashdata('success')) { ?>
                <p class="alert alert-success">
                    <?= $this->session->flashdata('success'); ?>
                </p>
            <?php } else if ($this->session->flashdata('danger')) { ?>
                <p class="alert alert-danger">
                    <?= $this->session->flashdata('danger'); ?>
                </p>
            <?php } ?>
        </div>

        <form class="form-horizontal"
            enctype="multipart/form-data"
            method="post"
            action="<?= base_url('webadmin/tutorial_edit'); ?>">

            <fieldset>
                <h1 class="h3 mb-3 page-title"><?= $title; ?></h1>

                <!-- Tutorial Description -->
                <div class="form-group">
                    <textarea class="form-control ckeditor"
                        id="tutorial_details"
                        rows="20"
                        name="details"
                        required><?= !empty($tutorial[0]) ? $tutorial[0]['details'] : ''; ?></textarea>
                    <?= form_error('details', '<span class="error_msg">', '</span>'); ?>
                </div>

                <!-- Upload Media -->
                <div class="form-group">
                    <label class="col-sm-4 control-label label-input-lg">
                        Upload Images / Videos
                    </label>

                    <div class="col-sm-8">

                        <input type="file"
                            name="media[]"
                            id="mediaInput"
                            multiple
                            accept="image/*,video/*">

                        <br><br>

                        <!-- New File Preview -->
                        <div id="new-preview" style="display:flex;flex-wrap:wrap;"></div>

                        <br>

                        <!-- Existing Media Preview -->
                        <div class="preview-wrapper">
                            <?php
                            if (!empty($tutorial[0]['tutorial_files'])) {
                                $media = json_decode($tutorial[0]['tutorial_files'], true);

                                foreach ($media as $m) {
                            ?>
                                    <div class="media-card">

                                        <?php if ($m['type'] == 'image') { ?>
                                            <img src="<?= base_url('assets/website/tutorial/' . $m['file']); ?>">
                                        <?php } else { ?>
                                            <video controls>
                                                <source src="<?= base_url('assets/website/tutorial/' . $m['file']); ?>">
                                            </video>
                                        <?php } ?>

                                        <div class="remove-btn"
                                            onclick="removeOldFile('<?= $m['file']; ?>', this)">
                                            ✕
                                        </div>

                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>

                        <!-- Hidden input for removed files -->
                        <input type="hidden" name="removed_files" id="removed_files">

                    </div>
                </div>

                <!-- Submit -->
                <div class="form-group">
                    <div class="text-right">
                        <?php if (!empty($tutorial[0])) { ?>
                            <input type="hidden" name="id" value="<?= $tutorial[0]['id']; ?>">
                            <input type="submit"
                                name="submit"
                                value="Update"
                                class="btn btn-success gl_btn_bg_blue"
                                style="min-width:180px;">
                        <?php } else { ?>
                            <input type="submit"
                                name="submit"
                                value="Add"
                                class="btn btn-success gl_btn_bg_blue"
                                style="min-width:180px;">
                        <?php } ?>
                    </div>
                </div>
            </fieldset>
        </form>

        <script>
            let removedFiles = [];
            let selectedFiles = new DataTransfer(); // store new selected files

            const mediaInput = document.getElementById('mediaInput');
            const previewContainer = document.getElementById('new-preview');

            // ===============================
            // HANDLE NEW FILE SELECTION
            // ===============================
            mediaInput.addEventListener('change', function(event) {

                for (let file of event.target.files) {
                    selectedFiles.items.add(file);
                }

                mediaInput.files = selectedFiles.files;
                renderPreview();
            });

            // ===============================
            // RENDER NEW FILE PREVIEW
            // ===============================
            function renderPreview() {

                previewContainer.innerHTML = "";

                Array.from(selectedFiles.files).forEach((file, index) => {

                    let card = document.createElement('div');
                    card.className = "media-card";

                    // IMAGE
                    if (file.type.startsWith('image')) {
                        let img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        card.appendChild(img);
                    }

                    // VIDEO
                    else if (file.type.startsWith('video')) {
                        let video = document.createElement('video');
                        video.src = URL.createObjectURL(file);
                        video.controls = true;
                        card.appendChild(video);
                    }

                    // REMOVE BUTTON
                    let btn = document.createElement('div');
                    btn.className = "remove-btn";
                    btn.innerHTML = "✕";
                    btn.onclick = function() {
                        removeNewFile(index);
                    };

                    card.appendChild(btn);
                    previewContainer.appendChild(card);
                });
            }

            // ===============================
            // REMOVE NEW FILE
            // ===============================
            function removeNewFile(index) {

                let newFiles = new DataTransfer();

                Array.from(selectedFiles.files).forEach((file, i) => {
                    if (i !== index) {
                        newFiles.items.add(file);
                    }
                });

                selectedFiles = newFiles;
                mediaInput.files = selectedFiles.files;

                renderPreview();
            }

            // ===============================
            // REMOVE OLD SAVED FILE
            // ===============================
            function removeOldFile(fileName, button) {

                removedFiles.push(fileName);

                document.getElementById('removed_files').value =
                    JSON.stringify(removedFiles);

                button.parentElement.remove();
            }
        </script>

    </div>
</div>
</div>

<script>
    const {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Underline,
        Font,
        Paragraph,
        List,
        Link,
        Table,
        TableToolbar,
        Heading,
        Alignment
    } = CKEDITOR;

    ClassicEditor.create(document.querySelector('#tutorial_details'), {
        plugins: [
            Essentials,
            Paragraph,
            Heading,
            Bold,
            Italic,
            Underline,
            Font,
            List,
            Link,
            Alignment,

            // Table
            Table,
            TableToolbar
        ],

        toolbar: [
            'heading',
            '|',
            'undo', 'redo',
            '|',
            'bold', 'italic', 'underline',
            '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
            '|',
            'alignment:left',
            'alignment:center',
            'alignment:right',
            'alignment:justify',
            '|',
            'link',
            'insertTable',
            '|',
            'bulletedList', 'numberedList'
        ],

        heading: {
            options: [{
                    model: 'paragraph',
                    title: 'Normal text',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Title',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Subtitle',
                    class: 'ck-heading_heading2'
                },
                {
                    model: 'heading3',
                    view: 'h3',
                    title: 'Heading 1',
                    class: 'ck-heading_heading3'
                },
                {
                    model: 'heading4',
                    view: 'h4',
                    title: 'Heading 2',
                    class: 'ck-heading_heading4'
                },
                {
                    model: 'heading5',
                    view: 'h5',
                    title: 'Heading 3',
                    class: 'ck-heading_heading5'
                },
                {
                    model: 'heading6',
                    view: 'h6',
                    title: 'Heading 4',
                    class: 'ck-heading_heading6'
                }
            ]
        },

        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 24, 28, 32, 36]
        },

        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells'
            ]
        }
    }).catch(console.error);
</script>