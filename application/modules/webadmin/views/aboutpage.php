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
              <input type="file" name="image[]" id="gl_cover_art" multiple onchange="previewImages()">
              <br/>
              <div id="image-preview<?php echo ($key==0)?'':$key; ?>">
                <?php if(!empty($about)){  foreach(explode(", ",$value['image']) as $keyImg => $valueImg){ if($keyImg == 0){ ?>
                  <br/><br/>
                  <?php } ?>
                <img class="img-responsive" src="<?php echo base_url('/assets/website/about/'.$valueImg); ?>" height="250px" width="200px">
                <?php  }} ?>
              </div>
              <?php echo form_error('image', '<span class="error_msg">', '</span>'); ?>
          </div>
        </div>
        <?php }else{ ?>
          <div class="form-group gl_text_black">
            <label class="col-sm-2 control-label label-input-lg">Secondary Image</label>
            <div class="col-sm-8" id="image-preview-container">
                <input type="file" name="image" id="gl_cover_art1"  onchange="previewImages1()">
                <br/>
                <div id="image-preview<?php echo $key; ?>">
                  <?php if(!empty($about)){  foreach(explode(", ",$value['image']) as $keyImg => $valueImg){ ?><br/><br/>
                  <img class="img-responsive" src="<?php echo base_url('/assets/website/about/'.$valueImg); ?>" height="250px" width="200px">
                  <?php  }} ?>
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
</script>