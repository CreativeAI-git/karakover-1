<!--Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="gl_flex_between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <?php echo $this->session->unset_userdata('msg'); ?>
    <div class="d-flex align-items-center">
      <div class="pr-2 ">
        <a href="<?= base_url('admin/uploadSongs'); ?>" class="btn btn-info pull-right "><i class="fa fa-plus mr-2"></i>Upload Mix Songs</a>
      </div>

      <div class="pl-0 ">
        <!--270423 mohd-->
        <!--<a href="<?= base_url('admin/uploadSingleSong'); ?>" class="btn btn-info pull-right "><i class="fa fa-plus mr-2"></i>Upload Song</a>-->
        <!--270423 mohd-->

      </div>
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
              <th>S.No.</th>
              <th>Track</th>
              <th>Artist</th>
              <th>Release Year</th>
              <th>Label</th>
              <th>Category</th>
              <th style="display:none;">Instrument</th>
              <!--<th>Track No.</th>-->
              <th>Cover Image</th>
              <th>Chords</th>
              <!--<th>Album Name</th>-->
              <!--<th>Music Mood</th>-->
              <!-- commneted by krishna on 21-01-2026 -->
              <!-- <th>Songs Name</th> -->
              <!--       <th>original_name</th> -->
              <th style="min-width: 100px;">Action</th>

            </tr>
          </thead>
          <tbody>
            <?php if (!empty($songs)) {

              foreach ($songs as $key => $value) { ?>
                <tr>

                  <td><?= $key + 1; ?></td>
                  <td>
                    <?= $value['track']; ?>
                  </td>
                  <td>
                    <?= artist_full_name($value['artist']); ?>
                  </td>
                  <td>
                    <?= $value['release_year']; ?>
                  </td>


                  <td>
                    <?= $value['label']; ?>
                  </td>
                  <td>
                    <?= genre_name($value['genre']); ?>
                  </td>
                  <td style="display:none;">
                    <?= instrument_name($value['instrument_id']); ?>
                  </td>

                  <!--      <td>-->
                  <!--      <?= $value['track_no']; ?>  -->
                  <!--</td>-->
                  <td>
                    <?php if (!empty($value['cover_image'])) { ?>

                      <img src="<?= base_url() . '/assets/cover/' . $value['cover_image']; ?>" width="100" height="100">
                    <?php
                    } else { ?>
                      <img src="<?= base_url('/assets/uploads/dummy.png') . $value['image']; ?>" width="100" height="100">
                    <?php } ?>
                  </td>
                  <!--<td>-->
                  <!--  <?= album_name($value['album_id']); ?>   -->
                  <!--</td>-->
                  <!--<td>-->
                  <!--      <?= your_mood_name($value['your_mood_id']); ?>  -->
                  <!--      </td>-->

                  <td>
                    <?php
                    $chordshow = $this->common->getData('tbl_music_files', array('song_id' => $value['id']), array('single'));
                    if (!empty($chordshow['chords_songs'])) {
                    ?>
                      <video width="170" height="100" controls>
                        <source src="<?= base_url() . '/assets/songs/' . $chordshow['chords_songs']; ?>">
                      </video>
                    <?php } else {
                      echo "Not Available..!";
                    } ?>
                  </td>
                  <!-- <td> -->
                  <?php
                  // $songs_name = $this->common->getData('tbl_music_files', array('song_id' => $value['id']), array('single'));
                  // //  print_r($songs_name);
                  // echo $songs_name['all_file_names'];
                  // $keysToRemove = array("id", "song_id", "all_file_names", "song_type", "created_at");
                  // foreach ($keysToRemove as $key) {
                  //   unset($songs_name[$key]); // Removes the keys "key1" and "key3" from the array
                  // }
                  // $song_list =   implode(",", $songs_name);
                  //  echo rtrim($song_list,",");

                  //  if(!empty($songs_name))
                  //  {
                  //   echo $data = $songs_name['drums'].','. $songs_name['bass'].','. $songs_name['vocals'].','. $songs_name['master1'].','. $songs_name['master2'].','. $songs_name['guitar'];
                  // }else
                  // {
                  //   echo $data ="";
                  //  } 
                  ?>
                  <!-- </td> -->
                  <!-- commneted by krishna on 21-01-2026 -->
                  <!-- <td>
                    <?php
                    // echo $value['all_file_names'];
                    ?>  
                  </td> -->
                  <td>
                    <a href="<?= base_url('admin/deleteSongs/' . $value['id']); ?>" onclick="return confirm('Are you sure you want to delete this data?');" class="btn btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                    <a href="<?= base_url('admin/editUploadSongs/' . $value['id']); ?>" class="btn btn-warning ml-0" title=""><i class="fa fa-edit"></i></a>

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
<!-- End of Main Content