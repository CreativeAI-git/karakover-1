<!--Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="gl_flex_between mt-4 mb-3">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>

    <div class="pl-0 mb-0">
      <a href="<?= base_url('webadmin/add_homepage_banner'); ?>" class="btn btn-info pull-right "><i class="fa fa-plus mr-2"></i>Add Home Page Banner</a>
    </div>
  </div>

  <div class="container">
    <?php if ($this->session->flashdata('success')) {
      echo '<p class="alert alert-success">' . $this->session->flashdata('success') . '</p>';
      $this->session->unset_userdata('success');
    } else if ($this->session->flashdata('danger')) {
      echo '<p class="alert alert-danger">' . $this->session->flashdata('danger') . '</p>';
      $this->session->unset_userdata('danger');
    }
    ?>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Type</th>
              <th>Banner</th>
              <th>Date/Time</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($banners)) {
              foreach ($banners as $key => $value) { ?>
                <tr>
                  <td><?= $key + 1; ?></td>
                  <td><?= !empty($value['type']) ? ucfirst($value['type']) : '-'; ?></td>
                  <td>
                    <?php if (!empty($value['type']) && $value['type'] === 'image' && !empty($value['banner'])) { ?>
                      <img src="<?= base_url('/assets/home_page_banners/') . $value['banner']; ?>" width="100" height="100">
                    <?php } else if (!empty($value['type']) && $value['type'] === 'video' && !empty($value['banner'])) { ?>
                      <video width="150" height="100" controls <?php if (!empty($value['thumbnail_image'])) { ?>poster="<?= base_url('/assets/home_page_banners/') . $value['thumbnail_image']; ?>"<?php } ?>>
                        <source src="<?= base_url('/assets/home_page_banners/') . $value['banner']; ?>" type="video/mp4">
                      </video>
                    <?php } else if (!empty($value['banner'])) { ?>
                      <?= $value['banner']; ?>
                    <?php } else { ?>
                      -
                    <?php } ?>
                  </td>
                  <td>
                    <?php if (!empty($value['created_at'])) {
                      echo date("d-M-Y", strtotime($value['created_at']));
                    } ?>
                  </td>
                  <td>
                    <a href="<?= base_url('webadmin/delete_homepage_banner/' . $value['id']); ?>" onclick="return confirm('Are you sure you want to delete this banner?');" class="btn btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                    <a href="<?= base_url('webadmin/edit_homepage_banner/' . $value['id']); ?>" class="btn btn-warning ml-0" title=""><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
            <?php }
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
