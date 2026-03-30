<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
#[\AllowDynamicProperties]
class Webadmin extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('common');
        $this->load->helper('file');
        $this->load->library('input');

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');
    }
    // Home Start //
    public function homepage()
    {
        $data['home'] = $this->common->getData('web_home', array(), array());
        $this->adminHtml('Home Page', 'homepage', $data);
    }
    public function home_edit()
    {

        $data['home'] =  $this->common->getData('web_home', array('id' => $_POST['id']), array());
        $path = './assets/website/home/' . $data['home'][0]['image'];

        if (!empty($_FILES['image']['name'])) {
            if (file_exists($path)) {
                unlink($path);
            }
            $image_name = fileuploadCI('image', './assets/website/home/');
            if (isset($image_name)) {
                $_POST['image'] = $image_name;
            }
        }
        unset($_POST["submit"]);
        $result = $this->common->updateData('web_home', $_POST, array('id' => $_POST['id']));
        if ($result) {
            $a = $this->session->set_flashdata('success', 'Data Update successfully');
        } else {
            $this->session->set_flashdata('danger', 'Some Error occured.');
        }
        redirect(base_url('webadmin/homepage'), 'refresh');
    }
    // Home End //

    // About Start //
    public function aboutpage()
    {
        $data['about'] = $this->common->getData('web_about', array());
        $this->adminHtml('About Page', 'aboutpage', $data);
    }
    // public function about_add()
    // {
    //     if(isset($_FILES['image'])){
    //         $image = $this->multiple_files($_FILES['image'],'./assets/website/about/','jpg|jpeg|png|gif');
    //         if (isset($image)) {
    //             $image_names = array_column($image, 'image_name');
    //             $_POST['image']=implode(', ', $image_names);
    //         }
    //     }
    //         unset($_POST["submit"]);  
    //         $post = $this->common->getField('web_about', $_POST);
    //         $result = $this->common->insertData('web_about', $post);
    //         if ($result) {
    //             $a = $this->session->set_flashdata('success', 'Data added successfully');
    //         } else {
    //             $this->session->set_flashdata('danger', 'Some Error occured.');
    //         }
    //         redirect(base_url('webadmin/aboutpage'), 'refresh');
    // }
    public function about_edit()
    {
        $id = $_POST['id'];

        // Get old data first
        $oldData = $this->common->getData('web_about', ['id' => $id]);

        // ================= SINGLE IMAGE =================
        if (!empty($_FILES['image']['name']) && $_POST['checkstatus'] !== 'multiplecheck') {

            $image_name = fileuploadCI('image', './assets/website/about/');

            if (!empty($image_name)) {

                // delete old image
                if (!empty($oldData['image']) && file_exists('./assets/website/about/' . $oldData['image'])) {
                    unlink('./assets/website/about/' . $oldData['image']);
                }

                $_POST['image'] = $image_name;
            }
        }
        // ================= MULTIPLE IMAGE =================
        else if (!empty($_FILES['image']['name'][0]) && $_POST['checkstatus'] == 'multiplecheck') {

            $image = $this->multiple_files($_FILES['image'], './assets/website/about/', 'jpg|jpeg|png|gif');

            if (!empty($image)) {

                $image_names = array_column($image, 'image_name');

                // delete old images
                if (!empty($oldData['image'])) {
                    $oldImages = explode(',', $oldData['image']);
                    foreach ($oldImages as $oldImg) {
                        $oldImg = trim($oldImg);
                        if (file_exists('./assets/website/about/' . $oldImg)) {
                            unlink('./assets/website/about/' . $oldImg);
                        }
                    }
                }

                $_POST['image'] = implode(',', $image_names);
            }
        } else {
            // IMPORTANT: if no new image → keep old image
            unset($_POST['image']);
        }
        unset($_POST["checkstatus"]);
        unset($_POST["submit"]);

        $result = $this->common->updateData('web_about', $_POST, ['id' => $id]);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Updated successfully');
        } else {
            $this->session->set_flashdata('danger', 'Some Error occurred.');
        }
        redirect(base_url('webadmin/aboutpage'), 'refresh');
    }
    // About End //

    // Instrument Start //
    public function instrumentpage()
    {
        $data['instrument'] = $this->common->getData('web_instrument', array());
        $this->adminHtml('Instrument Page', 'instrumentpage', $data);
    }

    public function instrument_add()
    {
        $this->form_validation->set_rules('title', 'Instrument name', 'required');
        $this->form_validation->set_rules('details', 'Description', 'required');

        if ($this->form_validation->run() == false) {
            $this->adminHtml('Add Instrument ', 'instrument_add');
        } else {

            if (!empty($_FILES['image']['name'])) {
                $image_name = fileuploadCI('image', './assets/website/instrument/');
                if (isset($image_name)) {
                    $_POST['image'] = $image_name;
                }
            }
            unset($_POST["submit"]);
            $post = $this->common->getField('web_instrument', $_POST);
            $result = $this->common->insertData('web_instrument', $post);
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data added successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('webadmin/instrumentpage'), 'refresh');
        }
    }

    public function instrument_edit()
    {
        $inst_id = $this->uri->segment(3);
        $this->form_validation->set_rules('title', 'Instrument name', 'required');
        $this->form_validation->set_rules('details', 'Description', 'required');
        $data['instrument'] =  $this->common->getData('web_instrument', array('id' => $inst_id), array('single'));
        if ($this->form_validation->run() == false) {
            $this->adminHtml('Update Instrument ', 'instrument_add', $data);
        } else {
            $path = './assets/website/instrument/' . $data['instrument']['image'];

            if (!empty($_FILES['image']['name'])) {
                if (file_exists($path)) {
                    unlink($path);
                }
                $image_name = fileuploadCI('image', './assets/website/instrument/');
                if (isset($image_name)) {
                    $_POST['image'] = $image_name;
                }
            }
            unset($_POST["submit"]);
            unset($_POST["id"]);
            $result = $this->common->updateData('web_instrument', $_POST, array('id' => $inst_id));
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data Update successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('webadmin/instrumentpage'), 'refresh');
        }
    }

    public function instrument_delete()
    {
        $id = $this->uri->segment(3);
        $data = $this->common->getData('web_instrument', array('id' => $id), array('single'));
        $path = './assets/website/instrument/' . $data['image'];
        if (file_exists($path)) {
            unlink($path);
        }
        if ($data) {
            $result = $this->common->deleteData('web_instrument', array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Instrument deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('webadmin/instrumentpage'), 'refresh');
        }
    }
    // Instrument End //

    // Ourteam Start //
    public function ourteampage()
    {
        $data['ourteam'] = $this->common->getData('web_ourteam', array());
        $this->adminHtml('OurTeam Page', 'ourteampage', $data);
    }

    public function ourteam_add()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->adminHtml('Add OurTeam ', 'ourteam_add');
        } else {

            if (!empty($_FILES['image']['name'])) {
                $image_name = fileuploadCI('image', './assets/website/ourteam/');
                if (isset($image_name)) {
                    $_POST['image'] = $image_name;
                }
            }
            unset($_POST["submit"]);
            $post = $this->common->getField('web_ourteam', $_POST);
            $result = $this->common->insertData('web_ourteam', $post);
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data added successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('webadmin/ourteampage'), 'refresh');
        }
    }

    public function ourteam_edit()
    {
        $inst_id = $this->uri->segment(3);
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $data['ourteam'] =  $this->common->getData('web_ourteam', array('id' => $inst_id), array('single'));
        if ($this->form_validation->run() == false) {
            $this->adminHtml('Update OurTeam ', 'ourteam_add', $data);
        } else {
            $path = './assets/website/ourteam/' . $data['ourteam']['image'];

            if (!empty($_FILES['image']['name'])) {
                if (file_exists($path)) {
                    unlink($path);
                }
                $image_name = fileuploadCI('image', './assets/website/ourteam/');
                if (isset($image_name)) {
                    $_POST['image'] = $image_name;
                }
            }
            unset($_POST["submit"]);
            unset($_POST["id"]);
            $result = $this->common->updateData('web_ourteam', $_POST, array('id' => $inst_id));
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data Update successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('webadmin/ourteampage'), 'refresh');
        }
    }

    public function ourteam_delete()
    {
        $id = $this->uri->segment(3);
        $data = $this->common->getData('web_ourteam', array('id' => $id), array('single'));
        $path = './assets/website/ourteam/' . $data['image'];
        if (file_exists($path)) {
            unlink($path);
        }
        if ($data) {
            $result = $this->common->deleteData('web_ourteam', array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Ourteam deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('webadmin/ourteampage'), 'refresh');
        }
    }
    // Ourteam End //

    // footer content Start //
    public function footerdetails()
    {
        $data['footer'] = $this->common->getData('web_footer', array());
        $this->adminHtml('Footer Details Page', 'footerdetails', $data);
    }

    public function footer_edit()
    {
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('details', 'Details', 'required');
        $this->form_validation->set_rules('number', 'Number', 'required|numeric|min_length[10]|max_length[12]');
        $data['footer'] = $this->common->getData('web_footer', array());
        if ($this->form_validation->run() == false) {
            $this->adminHtml('Footer Details Page', 'footerdetails', $data);
        } else {
            unset($_POST["submit"]);
            $result = $this->common->updateData('web_footer', $_POST, array('id' => $_POST["id"]));
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data Update successfully');
            } else {
                $this->session->set_flashdata('danger', 'All field are required...');
            }
            redirect(base_url('webadmin/footerdetails'), 'refresh');
        }
    }
    // footer content End //

    // Tutorial Start //
    public function tutorialspage()
    {
        $data['tutorial'] = $this->common->getData('web_tutorial', array());
        $this->adminHtml('Tutorial Page', 'tutorialspage', $data);
    }

    public function tutorial_edit_old()
    {
        $this->form_validation->set_rules('details', 'Description', 'required');

        if ($this->form_validation->run() == false) {
            $data['tutorial'] = $this->common->getData('web_tutorial', array());
            $this->adminHtml('Tutorial Page', 'tutorialspage', $data);
        } else {

            $data['tutorial'] =  $this->common->getData('web_tutorial', array('id' => $_POST['id']), array());
            $path = './assets/website/tutorial/' . $data['tutorial'][0]['image'];

            if (!empty($_FILES['image']['name'])) {
                if (file_exists($path)) {
                    unlink($path);
                }
                $image_name = fileuploadCI('image', './assets/website/tutorial/');
                if (isset($image_name)) {
                    $_POST['image'] = $image_name;
                }
            }
            unset($_POST["submit"]);
            $result = $this->common->updateData('web_tutorial', $_POST, array('id' => $_POST['id']));
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data Update successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('webadmin/tutorialspage'), 'refresh');
        }
    }

    // Tutorial End //

    // created by @krishn at 11-02-26
    public function tutorial_edit()
    {
        $this->form_validation->set_rules('details', 'Description', 'required');

        if ($this->form_validation->run() == false) {
            $data['tutorial'] = $this->common->getData('web_tutorial', array());
            $this->adminHtml('Tutorial Page', 'tutorialspage', $data);
            return;
        }

        $mediaData = [];

        // =========================
        // FETCH OLD DATA (IF EDIT)
        // =========================
        if (!empty($_POST['id'])) {

            $tutorial = $this->common->getData(
                'web_tutorial',
                array('id' => $_POST['id'])
            );

            if (!empty($tutorial[0]['tutorial_files'])) {
                $mediaData = json_decode($tutorial[0]['tutorial_files'], true) ?? [];
            }
        }

        // =========================
        // REMOVE DELETED FILES
        // =========================
        if (!empty($_POST['removed_files'])) {

            $removedFiles = json_decode($_POST['removed_files'], true);

            if (!empty($removedFiles)) {
                foreach ($removedFiles as $file) {

                    $filePath = './assets/website/tutorial/' . $file;

                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }

                    // Remove from media array
                    foreach ($mediaData as $key => $m) {
                        if ($m['file'] == $file) {
                            unset($mediaData[$key]);
                        }
                    }
                }

                $mediaData = array_values($mediaData);
            }
        }

        // =========================
        // HANDLE MULTIPLE UPLOADS
        // =========================
        if (!empty($_FILES['media']['name'][0])) {

            $filesCount = count($_FILES['media']['name']);

            for ($i = 0; $i < $filesCount; $i++) {

                $_FILES['file']['name']     = $_FILES['media']['name'][$i];
                $_FILES['file']['type']     = $_FILES['media']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['media']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['media']['error'][$i];
                $_FILES['file']['size']     = $_FILES['media']['size'][$i];

                $config['upload_path']   = './assets/website/tutorial/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp|mp4|mov|avi';
                $config['encrypt_name']  = true;
                $config['max_size']      = 51200; // 50MB

                $this->load->library('upload');
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {

                    $uploadData = $this->upload->data();

                    $type = (strpos($uploadData['file_type'], 'video') !== false)
                        ? 'video'
                        : 'image';

                    $mediaData[] = [
                        'type' => $type,
                        'file' => $uploadData['file_name']
                    ];
                }
            }
        }

        // =========================
        // PREPARE SAVE DATA
        // =========================
        $saveData = [
            'details' => $_POST['details'],
            'tutorial_files' => json_encode($mediaData),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // =========================
        // INSERT OR UPDATE
        // =========================
        if (!empty($_POST['id'])) {

            $result = $this->common->updateData(
                'web_tutorial',
                $saveData,
                array('id' => $_POST['id'])
            );
        } else {

            $saveData['created_at'] = date('Y-m-d H:i:s');

            $result = $this->common->insertData(
                'web_tutorial',
                $saveData
            );
        }

        // =========================
        // RESPONSE
        // =========================
        if ($result) {
            $this->session->set_flashdata('success', 'Tutorial saved successfully');
        } else {
            $this->session->set_flashdata('danger', 'Some error occurred');
        }

        redirect(base_url('webadmin/tutorialspage'), 'refresh');
    }


    // Bgchange Image Start //
    public function bg_image_change()
    {
        $data['tutorial'] = $this->common->getData('web_bgimage', array());
        $this->adminHtml('Backgroun Image Change Page', 'bg_image_changespage', $data);
    }
    public function bg_image_change_edit()
    {
        $data['tutorial'] =  $this->common->getData('web_bgimage', array('id' => $_POST['id']), array());
        $path = './assets/website/bgimage/' . $data['tutorial'][0]['image'];
        if (isset($_FILES['image'])) {
            $image_name = fileuploadCI('image', './assets/website/bgimage/');
            if (isset($image_name)) {
                if (file_exists($path)) {
                    unlink($path);
                }
                $_POST['image'] = $image_name;
            }
        }
        unset($_POST["checkstatus"]);
        unset($_POST["submit"]);
        $result = $this->common->updateData('web_bgimage', $_POST, array('id' => $_POST["id"]));
        if ($result) {
            $a = $this->session->set_flashdata('success', 'Data Update successfully');
        } else {
            $this->session->set_flashdata('danger', 'Some Error occured.');
        }
        redirect(base_url('webadmin/bg_image_change'), 'refresh');
    }
    // Bgchange Image End //

    // Multiple Image uploadfunction Start //
    public function multiple_files($files, $pathfile, $typefile = '')
    {

        $this->load->library('upload');
        $image = array();
        $ImageCount = count($files['name']);
        for ($i = 0; $i <= $ImageCount; $i++) {
            $_FILES['file']['name']       = $_FILES['image']['name'][$i];
            $_FILES['file']['type']       = $_FILES['image']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['image']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['image']['error'][$i];
            $_FILES['file']['size']       = $_FILES['image']['size'][$i];

            //File upload configuration
            $uploadPath = $pathfile;
            $config['upload_path'] = $uploadPath;
            //   $config['allowed_types'] = 'jpg|jpeg|png|gif|mp3';
            $config['allowed_types'] = $typefile;
            //$config['allowed_types'] = 'wav|mp3|m4a';

            // Load and initialize upload library
            //$this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                $imageData = $this->upload->data();
                $uploadImgData[$i]['image_name'] = $imageData['file_name'];
            }
        }
        return $uploadImgData;
    }
    // Multiple Image uploadfunction End //

}
