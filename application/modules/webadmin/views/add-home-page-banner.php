
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="col-md-12">
        <div class="alertfailurfile"></div>
        <?php echo $this->session->userdata('msg'); ?>
        <?php
        $selectedType = !empty($banner) && !empty($banner['type']) ? $banner['type'] : 'text';
        $bannerValue = !empty($banner) && !empty($banner['banner']) ? $banner['banner'] : '';
        $thumbnailValue = !empty($banner) && !empty($banner['thumbnail_image']) ? $banner['thumbnail_image'] : '';
        $hasExistingBanner = !empty($bannerValue) ? '1' : '0';
        $existingType = !empty($banner) && !empty($banner['type']) ? $banner['type'] : '';
        ?>
        <form class="form-horizontal" method="post" action="<?php if (!empty($banner)) {
                                                              echo site_url('webadmin/edit_homepage_banner/' . $this->uri->segment(3));
                                                            } else {
                                                              echo base_url('webadmin/add_homepage_banner');
                                                            } ?>" enctype="multipart/form-data">

          <h3 class="text-center gl_heading_black"><?= $title; ?></h3><br>

          <div class="form-group gl_text_black">
            <label class="col-sm-2 control-label">Type</label>
            <div class="col-sm-8">
              <select name="type" id="banner_type" class="form-control">
                <option value="text" <?= $selectedType === 'text' ? 'selected' : ''; ?>>Text</option>
                <option value="image" <?= $selectedType === 'image' ? 'selected' : ''; ?>>Image</option>
                <option value="video" <?= $selectedType === 'video' ? 'selected' : ''; ?>>Video</option>
              </select>
              <p><?php echo form_error('type', '<span class="error_msg">', '</span>'); ?></p>
            </div>
          </div>

          <div class="form-group gl_text_black" id="banner_text_group">
            <label class="col-sm-2 control-label">Banner</label>
            <div class="col-sm-8">
              <textarea name="banner_text" class="form-control" rows="4" placeholder="Banner text"><?php if ($selectedType === 'text') {
                                                                                                    echo $bannerValue;
                                                                                                  } ?></textarea>
              <p><?php echo form_error('banner_text', '<span class="error_msg">', '</span>'); ?></p>
            </div>
          </div>

          <div class="form-group gl_text_black" id="banner_file_group">
            <label class="col-sm-2 control-label label-input-lg">Banner File</label>
            <div class="col-sm-8" id="admin_profile">
              <input type="file" name="banner_file" id="banner_file" class="form-control" data-has-existing="<?= $hasExistingBanner; ?>" data-existing-type="<?= $existingType; ?>">
              <div class="mt-3">
                <img class="img-responsive" src="<?php if ($selectedType === 'image' && !empty($bannerValue)) {
                                                    echo base_url('assets/home_page_banners/' . $bannerValue);
                                                  } ?>" height="250px" width="200" id="banner_image_preview" style="<?php echo ($selectedType === 'image' && !empty($bannerValue)) ? '' : 'display:none'; ?>">
                <video id="banner_video_preview" width="250" height="200" controls style="<?php echo ($selectedType === 'video' && !empty($bannerValue)) ? '' : 'display:none'; ?>">
                  <source id="banner_video_source" src="<?php if ($selectedType === 'video' && !empty($bannerValue)) {
                                                          echo base_url('assets/home_page_banners/' . $bannerValue);
                                                        } ?>" type="video/mp4">
                </video>
              </div>
            </div>
          </div>

          <div class="form-group gl_text_black" id="thumbnail_group">
            <label class="col-sm-2 control-label label-input-lg">Thumbnail Image</label>
            <div class="col-sm-8" id="admin_profile">
              <input type="file" name="thumbnail_image" id="thumbnail_image" class="form-control" accept="image/*">
              <small class="text-muted">If you don't upload a thumbnail, it will be auto-generated from the video.</small>
              <div class="mt-3">
                <img class="img-responsive" src="<?php if ($selectedType === 'video' && !empty($thumbnailValue)) {
                                                    echo base_url('assets/home_page_banners/' . $thumbnailValue);
                                                  } ?>" height="200px" width="200" id="thumbnail_preview" style="<?php echo ($selectedType === 'video' && !empty($thumbnailValue)) ? '' : 'display:none'; ?>">
              </div>
            </div>
          </div>

          <div class="col-sm-offset-2">
            <?php if (!empty($banner)) { ?>
              <input type="hidden" name="id" value="<?php echo $banner['id']; ?>">
              <input type="submit" name="submit" value="Update" class="btn btn-success gl_btn_bg_blue">
            <?php } else { ?>
              <input type="submit" name="submit" value="Add" class="btn btn-success gl_btn_bg_blue">
            <?php } ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  (function() {
    var typeSelect = document.getElementById('banner_type');
    var textGroup = document.getElementById('banner_text_group');
    var fileGroup = document.getElementById('banner_file_group');
    var fileInput = document.getElementById('banner_file');
    var imagePreview = document.getElementById('banner_image_preview');
    var videoPreview = document.getElementById('banner_video_preview');
    var videoSource = document.getElementById('banner_video_source');
    var thumbnailGroup = document.getElementById('thumbnail_group');
    var thumbnailInput = document.getElementById('thumbnail_image');
    var thumbnailPreview = document.getElementById('thumbnail_preview');

    function setVisibility() {
      var type = typeSelect.value;

      if (type === 'text') {
        textGroup.style.display = 'block';
        fileGroup.style.display = 'none';
        fileInput.value = '';
        fileInput.removeAttribute('required');
        thumbnailGroup.style.display = 'none';
        thumbnailInput.value = '';
        thumbnailInput.removeAttribute('required');
      } else {
        textGroup.style.display = 'none';
        fileGroup.style.display = 'block';
      }

      var hasExisting = fileInput.getAttribute('data-has-existing') === '1';
      var existingType = fileInput.getAttribute('data-existing-type');
      var canReuseExisting = hasExisting && existingType === type;

      if (type === 'image') {
        fileInput.setAttribute('accept', 'image/*');
        if (!canReuseExisting) {
          fileInput.setAttribute('required', 'required');
        } else {
          fileInput.removeAttribute('required');
        }
        thumbnailGroup.style.display = 'none';
        thumbnailInput.value = '';
        thumbnailInput.removeAttribute('required');
      } else if (type === 'video') {
        fileInput.setAttribute('accept', 'video/*');
        if (!canReuseExisting) {
          fileInput.setAttribute('required', 'required');
        } else {
          fileInput.removeAttribute('required');
        }
        thumbnailGroup.style.display = 'block';
        thumbnailInput.removeAttribute('required');
      }

      if (type !== 'image') {
        imagePreview.style.display = 'none';
      }

      if (type !== 'video') {
        videoPreview.style.display = 'none';
      }
    }

    function updatePreview() {
      var file = fileInput.files && fileInput.files[0];
      if (!file) return;

      var type = typeSelect.value;
      var url = window.URL.createObjectURL(file);

      if (type === 'image') {
        imagePreview.src = url;
        imagePreview.style.display = 'block';
        videoPreview.style.display = 'none';
      } else if (type === 'video') {
        videoSource.src = url;
        videoPreview.load();
        videoPreview.style.display = 'block';
        imagePreview.style.display = 'none';
      }
    }

    typeSelect.addEventListener('change', setVisibility);
    fileInput.addEventListener('change', updatePreview);
    thumbnailInput.addEventListener('change', function() {
      var file = thumbnailInput.files && thumbnailInput.files[0];
      if (!file) return;
      var url = window.URL.createObjectURL(file);
      thumbnailPreview.src = url;
      thumbnailPreview.style.display = 'block';
    });

    setVisibility();
  })();
</script>
