<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-3 text-gray-800"> <?= $title; ?> </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="col-md-12">
				<div class="alertfailurfile"></div> <?php echo $this->session->userdata('msg'); ?> <form class="form-horizontal" method="post" action="<?php echo site_url('admin/edit_instrument/' . $this->uri->segment(3)); ?>" enctype="multipart/form-data">
					<h3 class="text-center gl_heading_black"> <?= $title; ?> </h3>
					<br>

					<div class="form-group gl_text_black">
						<label class="col-sm-2 control-label"> Instrument Name</label>
						<div class="col-sm-8">
							<input type="text" name="instrument" class="form-control" placeholder="Instrument name" value="<?php if (!empty($cat)) {
																																echo $cat['instrument'];
																															} ?>">
							<p> <?php echo form_error('instrument', '<span class="error_msg">', '</span>'); ?> </p>
						</div>
					</div>

					<div class="form-group gl_text_black">
						<label class="col-sm-2 control-label label-input-lg">Category Image</label>
						<div class="col-sm-8" id="admin_profile">
							<input type="file" name="image" id="gl_cover_art" onchange="myFunction()">
							<?php if (!empty($cat)) { ?>
								<br />
								<br /> <img class="img-responsive" src="<?php echo base_url('assets/instrument/' . $cat['image']); ?>" height="250px" width="200" id="blah">
							<?php } else { ?>
								<br />
								<br /> <img class="img-responsive" src="<?php echo base_url('assets/uploads/dummy.png'); ?>" height="250px" width="200" id="blah" style="display:none">
							<?php } ?>
							<?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
						</div>
					</div>

					<div class="col-sm-offset-2"> <?php if (!empty($cat)) { ?> <input type="hidden" name="id" value="
												<?php echo $cat['id']; ?>">
							<input type="submit" name="submit" value="Update" class="btn btn-success gl_btn_bg_blue"> <?php } else { ?> <input type="submit" name="submit" value="Add" class="btn btn-success gl_btn_bg_blue"> <?php } ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>