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

    private function generate_video_thumbnail($videoPath, $thumbPath)
    {
        if (!file_exists($videoPath)) {
            return false;
        }

        $command = "ffmpeg -y -i " . escapeshellarg($videoPath) . " -ss 00:00:01 -vframes 1 -q:v 2 " . escapeshellarg($thumbPath) . " 2>&1";
        @shell_exec($command);

        return file_exists($thumbPath);
    }

    // Home Page Banner Start //
    public function homepagebanner()
    {
        $options = [
            'sort_by' => 'id',
            'sort_direction' => 'ASC'
        ];

        $data['banners'] = $this->common->getData('home_page_banners', "", $options);
        $data['banner_settings'] = $this->common->getData('home_page_banner_settings', array('id' => 1), array('single'));
        $this->adminHtml('Home Page Banners', 'home-page-banner-list', $data);
    }

    public function update_homepage_banner_title()
    {
        $this->form_validation->set_rules('section_title', 'Section Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('danger', strip_tags(validation_errors()));
            redirect(base_url('webadmin/homepagebanner'), 'refresh');
            return;
        }

        $title = $this->input->post('section_title', true);
        $existing = $this->common->getData('home_page_banner_settings', array('id' => 1), array('single'));

        $payload = array(
            'title' => $title,
            'updated_at' => date('Y-m-d H:i:s')
        );

        if (!empty($existing)) {
            $result = $this->common->updateData('home_page_banner_settings', $payload, array('id' => 1));
        } else {
            $payload['id'] = 1;
            $payload['created_at'] = date('Y-m-d H:i:s');
            $result = $this->common->insertData('home_page_banner_settings', $payload);
        }

        if ($result) {
            $this->session->set_flashdata('success', 'Banner section title updated successfully');
        } else {
            $this->session->set_flashdata('danger', 'Some error occurred while updating the title.');
        }

        redirect(base_url('webadmin/homepagebanner'), 'refresh');
    }

    public function add_homepage_banner()
    {
        $this->form_validation->set_rules('type', 'Type', 'required');
        $type = $this->input->post('type');
        if ($type === 'text') {
            $this->form_validation->set_rules('banner_text', 'Banner', 'required');
        }

        if ($this->form_validation->run() == false) {
            $this->adminHtml('Add Home Page Banner', 'add-home-page-banner');
        } else {
            unset($_POST["submit"]);

            if ($type === 'text') {
                $_POST['banner'] = $this->input->post('banner_text');
                $_POST['thumbnail_image'] = null;
            } else {
                if (!empty($_FILES['banner_file']['name'])) {
                    $allowed_types = ($type === 'image')
                        ? 'jpg|jpeg|png|webp|gif'
                        : 'mp4|mov|avi|mkv|webm';

                    $config = [
                        'upload_path' => './assets/home_page_banners/',
                        'allowed_types' => $allowed_types,
                        'encrypt_name' => true,
                        'max_size' => 51200
                    ];

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('banner_file')) {
                        $this->session->set_flashdata('danger', strip_tags($this->upload->display_errors()));
                        redirect(base_url('webadmin/add_homepage_banner'), 'refresh');
                        return;
                    }

                    $uploadData = $this->upload->data();
                    $_POST['banner'] = $uploadData['file_name'];

                    if ($type === 'video') {
                        $_POST['thumbnail_image'] = null;
                        if (!empty($_FILES['thumbnail_image']['name'])) {
                            $thumb_config = [
                                'upload_path' => './assets/home_page_banners/',
                                'allowed_types' => 'jpg|jpeg|png|webp|gif',
                                'encrypt_name' => true,
                                'max_size' => 51200
                            ];
                            $this->upload->initialize($thumb_config);
                            if (!$this->upload->do_upload('thumbnail_image')) {
                                $this->session->set_flashdata('danger', strip_tags($this->upload->display_errors()));
                                redirect(base_url('webadmin/add_homepage_banner'), 'refresh');
                                return;
                            }
                            $thumbData = $this->upload->data();
                            $_POST['thumbnail_image'] = $thumbData['file_name'];
                        } else {
                            $videoPath = './assets/home_page_banners/' . $_POST['banner'];
                            $thumbName = 'thumb_' . uniqid() . '.jpg';
                            $thumbPath = './assets/home_page_banners/' . $thumbName;
                            if ($this->generate_video_thumbnail($videoPath, $thumbPath)) {
                                $_POST['thumbnail_image'] = $thumbName;
                            }
                        }
                    } else {
                        $_POST['thumbnail_image'] = null;
                    }
                } else {
                    $this->session->set_flashdata('danger', 'Please select a banner file.');
                    redirect(base_url('webadmin/add_homepage_banner'), 'refresh');
                    return;
                }
            }
            unset($_POST["banner_text"]);

            $post = $this->common->getField('home_page_banners', $_POST);
            $result = $this->common->insertData('home_page_banners', $post);
            if ($result) {
                $this->session->set_flashdata('success', 'Data added successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('webadmin/homepagebanner'), 'refresh');
        }
    }

    public function edit_homepage_banner()
    {
        $banner_id = $this->uri->segment(3);
        $data['banner'] = $this->common->getData('home_page_banners', array('id' => $banner_id), array('single'));

        $this->form_validation->set_rules('type', 'Type', 'required');
        $type = $this->input->post('type');
        if ($type === 'text') {
            $this->form_validation->set_rules('banner_text', 'Banner', 'required');
        }

        if ($this->form_validation->run() == false) {
            $this->adminHtml('Update Home Page Banner', 'add-home-page-banner', $data);
        } else {
            unset($_POST["submit"]);
            unset($_POST["id"]);

            $existing = $data['banner'];

            if ($type === 'text') {
                $_POST['banner'] = $this->input->post('banner_text');
                $_POST['thumbnail_image'] = null;
                if (!empty($existing) && !empty($existing['thumbnail_image'])) {
                    $old_thumb = './assets/home_page_banners/' . $existing['thumbnail_image'];
                    if (file_exists($old_thumb)) {
                        unlink($old_thumb);
                    }
                }
            } else {
                if (!empty($_FILES['banner_file']['name'])) {
                    $allowed_types = ($type === 'image')
                        ? 'jpg|jpeg|png|webp|gif'
                        : 'mp4|mov|avi|mkv|webm';

                    $config = [
                        'upload_path' => './assets/home_page_banners/',
                        'allowed_types' => $allowed_types,
                        'encrypt_name' => true,
                        'max_size' => 51200
                    ];

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('banner_file')) {
                        $this->session->set_flashdata('danger', strip_tags($this->upload->display_errors()));
                        redirect(base_url('webadmin/edit_homepage_banner/' . $banner_id), 'refresh');
                        return;
                    }

                    $uploadData = $this->upload->data();
                    $_POST['banner'] = $uploadData['file_name'];

                    if (!empty($existing) && in_array($existing['type'], array('image', 'video')) && !empty($existing['banner'])) {
                        $old_file = './assets/home_page_banners/' . $existing['banner'];
                        if (file_exists($old_file)) {
                            unlink($old_file);
                        }
                    }

                    if ($type === 'video') {
                        if (!empty($_FILES['thumbnail_image']['name'])) {
                            $thumb_config = [
                                'upload_path' => './assets/home_page_banners/',
                                'allowed_types' => 'jpg|jpeg|png|webp|gif',
                                'encrypt_name' => true,
                                'max_size' => 51200
                            ];
                            $this->upload->initialize($thumb_config);
                            if (!$this->upload->do_upload('thumbnail_image')) {
                                $this->session->set_flashdata('danger', strip_tags($this->upload->display_errors()));
                                redirect(base_url('webadmin/edit_homepage_banner/' . $banner_id), 'refresh');
                                return;
                            }
                            $thumbData = $this->upload->data();
                            $_POST['thumbnail_image'] = $thumbData['file_name'];
                            if (!empty($existing) && !empty($existing['thumbnail_image'])) {
                                $old_thumb = './assets/home_page_banners/' . $existing['thumbnail_image'];
                                if (file_exists($old_thumb)) {
                                    unlink($old_thumb);
                                }
                            }
                        } else if (empty($existing['thumbnail_image'])) {
                            $videoPath = './assets/home_page_banners/' . $_POST['banner'];
                            $thumbName = 'thumb_' . uniqid() . '.jpg';
                            $thumbPath = './assets/home_page_banners/' . $thumbName;
                            if ($this->generate_video_thumbnail($videoPath, $thumbPath)) {
                                $_POST['thumbnail_image'] = $thumbName;
                                if (!empty($existing) && !empty($existing['thumbnail_image'])) {
                                    $old_thumb = './assets/home_page_banners/' . $existing['thumbnail_image'];
                                    if (file_exists($old_thumb)) {
                                        unlink($old_thumb);
                                    }
                                }
                            }
                        }
                    } else {
                        $_POST['thumbnail_image'] = null;
                        if (!empty($existing) && !empty($existing['thumbnail_image'])) {
                            $old_thumb = './assets/home_page_banners/' . $existing['thumbnail_image'];
                            if (file_exists($old_thumb)) {
                                unlink($old_thumb);
                            }
                        }
                    }
                } else {
                    if (empty($existing) || empty($existing['banner']) || $existing['type'] !== $type) {
                        $this->session->set_flashdata('danger', 'Please select a banner file.');
                        redirect(base_url('webadmin/edit_homepage_banner/' . $banner_id), 'refresh');
                        return;
                    }
                    unset($_POST['banner']);
                    if ($type !== 'video') {
                        $_POST['thumbnail_image'] = null;
                        if (!empty($existing) && !empty($existing['thumbnail_image'])) {
                            $old_thumb = './assets/home_page_banners/' . $existing['thumbnail_image'];
                            if (file_exists($old_thumb)) {
                                unlink($old_thumb);
                            }
                        }
                    } else {
                        if (!empty($_FILES['thumbnail_image']['name'])) {
                            $thumb_config = [
                                'upload_path' => './assets/home_page_banners/',
                                'allowed_types' => 'jpg|jpeg|png|webp|gif',
                                'encrypt_name' => true,
                                'max_size' => 51200
                            ];
                            $this->upload->initialize($thumb_config);
                            if (!$this->upload->do_upload('thumbnail_image')) {
                                $this->session->set_flashdata('danger', strip_tags($this->upload->display_errors()));
                                redirect(base_url('webadmin/edit_homepage_banner/' . $banner_id), 'refresh');
                                return;
                            }
                            $thumbData = $this->upload->data();
                            $_POST['thumbnail_image'] = $thumbData['file_name'];
                            if (!empty($existing) && !empty($existing['thumbnail_image'])) {
                                $old_thumb = './assets/home_page_banners/' . $existing['thumbnail_image'];
                                if (file_exists($old_thumb)) {
                                    unlink($old_thumb);
                                }
                            }
                        } else if (empty($existing['thumbnail_image']) && !empty($existing['banner'])) {
                            $videoPath = './assets/home_page_banners/' . $existing['banner'];
                            $thumbName = 'thumb_' . uniqid() . '.jpg';
                            $thumbPath = './assets/home_page_banners/' . $thumbName;
                            if ($this->generate_video_thumbnail($videoPath, $thumbPath)) {
                                $_POST['thumbnail_image'] = $thumbName;
                            }
                        }
                    }
                }
            }
            unset($_POST["banner_text"]);

            $result = $this->common->updateData('home_page_banners', $_POST, array('id' => $banner_id));
            if ($result) {
                $this->session->set_flashdata('success', 'Data updated successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some error occurred.');
            }
            redirect(base_url('webadmin/homepagebanner'), 'refresh');
        }
    }

    public function delete_homepage_banner()
    {
        $id = $this->uri->segment(3);
        $data = $this->common->getData('home_page_banners', array('id' => $id), array('single'));
        if ($data) {
            if (in_array($data['type'], array('image', 'video')) && !empty($data['banner'])) {
                $file = './assets/home_page_banners/' . $data['banner'];
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            if (!empty($data['thumbnail_image'])) {
                $thumb = './assets/home_page_banners/' . $data['thumbnail_image'];
                if (file_exists($thumb)) {
                    unlink($thumb);
                }
            }
            $result = $this->common->deleteData('home_page_banners', array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Home page banner deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('webadmin/homepagebanner'), 'refresh');
        }
    }
    // Home Page Banner End //

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
        $oldData = $this->common->getData('web_about', ['id' => $id], ['single']);
        $oldImages = [];
        if (!empty($oldData['image'])) {
            $oldImages = array_values(array_filter(array_map('trim', explode(',', $oldData['image']))));
        }

        // ================= REMOVE SELECTED IMAGES =================
        if (!empty($_POST['removed_images']) && is_array($_POST['removed_images'])) {
            $removeList = array_values(array_filter(array_map('trim', $_POST['removed_images'])));
            if (!empty($removeList)) {
                foreach ($removeList as $removeImg) {
                    $path = './assets/website/about/' . $removeImg;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                $oldImages = array_values(array_diff($oldImages, $removeList));
            }
        }

        // ================= SINGLE IMAGE =================
        if (!empty($_FILES['image']['name']) && $_POST['checkstatus'] !== 'multiplecheck') {
            if (is_array($_FILES['image']['name'])) {
                $uploadNames = array_filter($_FILES['image']['name']);
                if (count($uploadNames) > 1) {
                    $this->session->set_flashdata('danger', 'Only 1 image is allowed for the secondary section.');
                    redirect(base_url('webadmin/aboutpage'), 'refresh');
                    return;
                }
            }

            $image_name = fileuploadCI('image', './assets/website/about/');

            if (!empty($image_name)) {

                // delete old image
                if (!empty($oldImages)) {
                    foreach ($oldImages as $oldImg) {
                        if (file_exists('./assets/website/about/' . $oldImg)) {
                            unlink('./assets/website/about/' . $oldImg);
                        }
                    }
                }

                $_POST['image'] = $image_name;
            }
        }
        // ================= MULTIPLE IMAGE =================
        else if (!empty($_FILES['image']['name'][0]) && $_POST['checkstatus'] == 'multiplecheck') {
            $uploadNames = array_filter($_FILES['image']['name']);
            $remaining = count($oldImages);
            if (count($uploadNames) + $remaining > 3) {
                $this->session->set_flashdata('danger', 'Only 3 images are allowed for the primary section.');
                redirect(base_url('webadmin/aboutpage'), 'refresh');
                return;
            }

            $image = $this->multiple_files($_FILES['image'], './assets/website/about/', 'jpg|jpeg|png|gif');

            if (!empty($image)) {

                $image_names = array_column($image, 'image_name');
                $mergedImages = array_merge($oldImages, $image_names);
                $_POST['image'] = implode(', ', $mergedImages);
            }
        } else {
            // IMPORTANT: if no new image → keep old image
            if (!empty($oldImages)) {
                $_POST['image'] = implode(', ', $oldImages);
            } else {
                $_POST['image'] = '';
            }
        }
        unset($_POST['removed_images']);
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
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
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
        $uploadImgData = []; //uploadImgData
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
