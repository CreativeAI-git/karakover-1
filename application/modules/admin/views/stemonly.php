<!--Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
  <?php echo $this->session->unset_userdata('msg'); ?>  
   
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>S.No</th>
                    <th>Stem 1</th>
                    <th>Stem 2</th>
                    <th>Stem 3</th>
                    <th>Stem 4</th>
                    <th>Mix 1</th>
                    <th>Mix 2</th>
                    <th>Zone type</th>
                    <th>No. Stems</th>
                    <th>No. Mixes</th>
                    <th>Steam Mix</th>
                    <th>Threshold(dB)</th>
                    <th>Output gain(dB)</th>
                    <th>Release(ms)</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($stems)){ 
                   
                foreach ($stems as $key => $value) { ?>
                <tr>
                <td><?= $key+1; ?></td>
                <td>
                <?= $value['stem1']; ?>
                </td>
                <td>
                <?=  $value['stem2']; ?>  
                </td>
                <td>
                <?=  $value['stem3']; ?>
                </td>
                <td>
                <?= $value['stem4']; ?>
                </td>
                <td>
                <?=  $value['Mix1']; ?>  
                </td>
                <td>
                <?=  $value['Mix2']; ?>  
                </td>
                <td>
                <?=  zone_type_name($value['zone_type']); ?>  
                </td>
                <td>
                <?=  $value['no_stems']; ?>  
                </td>
                <td>
                <?=  $value['no_mixes']; ?>  
                </td>
                <td>
                <?=  $value['stem_mix']; ?>  
                </td>
                <td>
                <?=  $value['limiter_threshold(db)']; ?>  
                </td>
                <td>
                <?=  $value['limiter_outputgain(db)']; ?>  
                </td>
                <td>
                <?=  $value['limiter_release(ms)']; ?>  
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