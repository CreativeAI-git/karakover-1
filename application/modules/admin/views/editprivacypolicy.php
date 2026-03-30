<!-- <script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script> -->
 <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
 <script src="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.umd.js"></script>
<div class="container-fluid">
<div class="height20 clear"></div>
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
  
    <form class="form-horizontal" method="post" action="<?php if(!empty($privacy)){ echo base_url('admin/privacyPolicy');}else{
          echo  base_url('admin/addcategory');
        } ?>" >
      <fieldset>
        <h1 class="h3 mb-3 page-title">Update Privacy Policy</h1>
        <div class="form-group" id="main">
          <textarea class="form-control ckeditor" id="privacy_page" rows="20" name="editor" required><?php echo $privacy['info']; ?></textarea>
        </div>
        
       
        <div class="form-group">
          <div class="text-right">
           <?php if(!empty($privacy)){ ?>
          <input type="hidden" name="id" value="<?php echo $privacy['id']; ?>">
                <input type="submit" name="submit" value="Update" class="btn btn-success gl_btn_bg_blue" style="min-width: 180px;">
                <?php } else { ?>
                <input type="submit" name="submit" value="Add" class="btn btn-success gl_btn_bg_blue" style="min-width: 180px;">
                <?php } ?>
          </div>
        </div>
      </fieldset>
    </form>
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

    ClassicEditor.create(document.querySelector('#privacy_page'), {
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