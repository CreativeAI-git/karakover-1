<!-- <script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script> -->
 <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
 <script src="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.umd.js"></script>
<div class="container-fluid">
    <div class="height20 clear"></div>
    <div class="pl-0 mb-0">
      <!-- <a href="<?= base_url('webadmin/instrumentpage'); ?>" class="btn btn-info pull-right "><i class="fa fa-arrow mr-2"></i>Back</a> -->
      <h1 class="h3 mb-3 page-title"><?= $title; ?></h1>
    </div> 
  <div class="col-sm-12"> 
   <div class="container">
      <?php if($this->session->flashdata('success'))  {
                echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>' ; 
                $this->session->unset_userdata ( 'success' ) ;

            } else if($this->session->flashdata('danger')) {

                echo '<p class="alert alert-danger">'.$this->session->flashdata('danger').'</p>' ; 
                $this->session->unset_userdata ( 'danger' ) ;
        }
      ?>
   </div>
  
   <?php 
    if(!empty($about)){
      foreach($about as $key => $value){   ?>
    <form class="form-horizontal" action="<?php if(!empty($about)){ echo site_url('webadmin/about_edit/'.$this->uri->segment(3)); }else{ echo  base_url('webadmin/about_add/'.$this->uri->segment(3));} ?>" method="post"  enctype="multipart/form-data" >
      <fieldset>
        <div class="form-group" id="main">
          <textarea class="form-control ckeditor" id="editor_<?php echo $key; ?>" rows="20" name="details" ><?php echo $value['details']; ?></textarea>
          <p><?php echo form_error('details', '<span class="error_msg">', '</span>'); ?></p> 
        </div>
        <?php if($key==0){ ?>
        <div class="form-group gl_text_black">
          <label class="col-sm-2 control-label label-input-lg">Primary Image</label>
          <div class="col-sm-8" id="image-preview-container">
              <input type="hidden" name="checkstatus" value="multiplecheck">
              <input type="file" name="image[]" id="gl_cover_art" multiple onchange="handlePrimarySelection(this);">
              <br/>
              <small id="primary-image-error" class="text-danger"></small>
              <div id="image-preview<?php echo ($key==0)?'':$key; ?>" class="about-image-preview" data-max="3">
                <?php
                  $imageList = array_values(array_filter(array_map('trim', explode(',', $value['image']))));
                  if (!empty($imageList)) {
                    foreach ($imageList as $valueImg) {
                ?>
                  <div class="about-image-item">
                    <img class="img-responsive" src="<?php echo base_url('/assets/website/about/'.$valueImg); ?>" height="250px" width="200px">
                    <button type="button" class="about-remove-btn" aria-label="Remove image">x</button>
                    <input type="checkbox" class="about-remove-input" name="removed_images[]" value="<?php echo $valueImg; ?>" hidden>
                  </div>
                <?php
                    }
                  }
                ?>
              </div>
              <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
          </div>
        </div>
        <?php }else{ ?>
          <div class="form-group gl_text_black">
            <label class="col-sm-2 control-label label-input-lg">Secondary Image</label>
            <div class="col-sm-8" id="image-preview-container">
                <input type="file" name="image" id="gl_cover_art1"  onchange="handleSecondarySelection(this);">
                <br/>
                <small id="secondary-image-error" class="text-danger"></small>
                <div id="image-preview<?php echo $key; ?>" class="about-image-preview" data-max="1">
                  <?php
                    $imageList = array_values(array_filter(array_map('trim', explode(',', $value['image']))));
                    if (!empty($imageList)) {
                      foreach ($imageList as $valueImg) {
                  ?>
                    <div class="about-image-item">
                      <img class="img-responsive" src="<?php echo base_url('/assets/website/about/'.$valueImg); ?>" height="250px" width="200px">
                      <button type="button" class="about-remove-btn" aria-label="Remove image">x</button>
                      <input type="checkbox" class="about-remove-input" name="removed_images[]" value="<?php echo $valueImg; ?>" hidden>
                    </div>
                  <?php
                      }
                    }
                  ?>
                </div>
                <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
            </div>
          </div>
        <?php } ?>
        <div class="form-group">
          <div class="text-right">
            <?php if(!empty($about)){ ?>
              <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
              <input type="submit" name="submit" value="Update" class="btn btn-success">
            <?php } else { ?>
                <input type="submit" name="submit" value="Add" class="btn btn-success gl_btn_bg_blue" style="min-width: 180px;">
            <?php } ?>    
          </div>
        </div>
      </fieldset>
    </form>
    <?php }} ?>

  </div>
</div>
</div>

<script>
    (function() {
        var style = document.createElement('style');
        style.textContent = `
          .about-image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
          }
          .about-image-item {
            display: inline-flex;
            flex-direction: column;
            gap: 6px;
            position: relative;
          }
          .about-remove-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: none;
            background: #e43b3b;
            color: #fff;
            font-size: 18px;
            line-height: 26px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
          }
          .about-image-item.is-removed {
            opacity: 0.5;
          }
        `;
        document.head.appendChild(style);
    })();

    function wireRemoveButtons() {
        document.querySelectorAll('.about-image-item').forEach(function(item) {
            var btn = item.querySelector('.about-remove-btn');
            var input = item.querySelector('.about-remove-input');
            if (!btn || !input) return;
            btn.addEventListener('click', function() {
                input.checked = true;
                item.classList.add('is-removed');
                item.style.display = 'none';
                updatePrimaryError();
            });
        });
    }

    function getRemainingCount(container) {
        var items = container.querySelectorAll('.about-image-item');
        var count = 0;
        items.forEach(function(item) {
            if (!item.classList.contains('is-removed')) {
                count += 1;
            }
        });
        return count;
    }

    var primarySelected = [];
    var secondarySelected = [];

    function updatePrimaryError() {
        var errorEl = document.getElementById('primary-image-error');
        if (!errorEl) return;
        var container = document.getElementById('image-preview');
        var existing = container ? getRemainingCount(container) : 0;
        var max = 3;
        var total = existing + primarySelected.length;
        var available = Math.max(0, max - existing);
        if (total > max) {
            errorEl.textContent = 'You can upload only ' + available + ' more image(s) for the primary section.';
        } else {
            errorEl.textContent = '';
        }
    }

    function updateSecondaryError() {
        var errorEl = document.getElementById('secondary-image-error');
        if (!errorEl) return;
        var max = 1;
        if (secondarySelected.length > max) {
            errorEl.textContent = 'Only 1 image is allowed for the secondary section.';
        } else {
            errorEl.textContent = '';
        }
    }

    function syncInputFiles(input, files) {
        var dt = new DataTransfer();
        files.forEach(function(file) {
            dt.items.add(file);
        });
        input.files = dt.files;
    }

    function renderSelectedPreviews(container, files, onRemove) {
        var old = container.querySelectorAll('.about-image-new');
        old.forEach(function(node) {
            node.remove();
        });
        files.forEach(function(file, index) {
            var wrapper = document.createElement('div');
            wrapper.className = 'about-image-item about-image-new';
            var img = document.createElement('img');
            img.className = 'img-responsive';
            img.height = 250;
            img.width = 200;
            img.src = URL.createObjectURL(file);
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'about-remove-btn';
            btn.textContent = 'x';
            btn.setAttribute('aria-label', 'Remove image');
            btn.addEventListener('click', function() {
                onRemove(index, img.src);
            });
            wrapper.appendChild(img);
            wrapper.appendChild(btn);
            container.appendChild(wrapper);
        });
    }

    function handlePrimarySelection(input) {
        primarySelected = Array.from(input.files || []);
        var container = document.getElementById('image-preview');
        if (container) {
            var renderPrimary = function() {
                renderSelectedPreviews(container, primarySelected, function(index, url) {
                    if (url) {
                        URL.revokeObjectURL(url);
                    }
                    primarySelected.splice(index, 1);
                    syncInputFiles(input, primarySelected);
                    renderPrimary();
                    updatePrimaryError();
                });
            };
            renderPrimary();
        }
        updatePrimaryError();
    }

    function handleSecondarySelection(input) {
        secondarySelected = Array.from(input.files || []);
        var container = document.getElementById('image-preview1');
        if (container) {
            var renderSecondary = function() {
                renderSelectedPreviews(container, secondarySelected, function(index, url) {
                    if (url) {
                        URL.revokeObjectURL(url);
                    }
                    secondarySelected.splice(index, 1);
                    syncInputFiles(input, secondarySelected);
                    renderSecondary();
                    updateSecondaryError();
                });
            };
            renderSecondary();
        }
        updateSecondaryError();
    }

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

    const editorConfig = {
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
        },
    };

    // Initialize multiple editors safely
    document.querySelectorAll('textarea[id^="editor_"]').forEach(function(el) {
        ClassicEditor.create(el, editorConfig).catch(error => {
            console.error(error);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        wireRemoveButtons();
        updatePrimaryError();
        updateSecondaryError();
    });
</script>


