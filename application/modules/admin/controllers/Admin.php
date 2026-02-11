<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
use Aws\S3\S3Client;
#[\AllowDynamicProperties]
class Admin extends Admin_Controller
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
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('msg', 'Logged out successfully');
        redirect(base_url('karakover-admin'));
    }
    public function approve_user($id)
    {
        $d = $this->common->updateData('user', array('status' => 1), array('id' => $id));
        $this->session->set_flashdata('success', 'Approved.');
        redirect(base_url('admin/userList'));
    }
    public function disapprove_user($id)
    {
        $d = $this->common->updateData('user', array('status' => 0), array('id' => $id));
        $this->session->set_flashdata('error', ' Not Approved.');
        redirect(base_url('admin/userList'));
    }
    public function disapprove_artist($id)
    {
        $d = $this->common->updateData('user', array('status' => 0), array('id' => $id));
        $this->session->set_flashdata('error', ' Not Approved.');
        redirect(base_url('admin/artistList'));
    }
    public function approve_artist($id)
    {
        $d = $this->common->updateData('user', array('status' => 1), array('id' => $id));
        $this->session->set_flashdata('success', 'Approved.');
        redirect(base_url('admin/artistList'));
    }
    //Genre List Acceptance Function
    public function disapprove_cat($id)
    {
        $d = $this->common->updateData('genre_category', array('status' => 1), array('genre_id' => $id));
        $this->session->set_flashdata('error', 'Not Activate.');
        redirect(base_url('admin/catList'));
    }
    public function approve_cat($id)
    {
        $d = $this->common->updateData('genre_category', array('status' => 0), array('genre_id' => $id));
        $this->session->set_flashdata('success', ' Activate.');
        redirect(base_url('admin/catList'));
    }
    ///End of the Function
    public function delete_user()
    {
        $id = $this->uri->segment(3);
        $type = $this->uri->segment(4);
        $data = $this->common->getData('tbl_users', array('id' => $id), array('single'));
        if ($data) {
            $result = $this->common->deleteData('tbl_users', array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'User deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/userList'), 'refresh');
        }
    }
    public function delete_genre()
    {
        $id = $this->uri->segment(3);
        $type = $this->uri->segment(4);
        $data = $this->common->getData('tbl_genre', array('id' => $id), array('single'));
        if ($data) {
            $result = $this->common->deleteData('tbl_genre', array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Genre deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/genreList'), 'refresh');
        }
    }
    public function deleteSongs()
    {

        $id = $this->uri->segment(3);
        if ($id) {
            $data = $this->common->getData('tbl_songs', array('id' => $id), array('single'));

            $data_music = $this->common->getData('tbl_music_files', array('song_id' => $id), array('single'));

            $result = $this->common->deleteData('tbl_songs', array('id' => $id));
            $result = $this->common->deleteData('tbl_music_files', array('song_id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Data deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/songsList'), 'refresh');
        }
    }

    public function deleterequestsong()
    {

        $id = $this->uri->segment(3);
        if ($id) {
            $result = $this->common->deleteData('request_song', array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Data deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/requestsongList'), 'refresh');
        }
    }

    public function delete_album()
    {
        $id = $this->uri->segment(3);
        $type = $this->uri->segment(4);
        $data = $this->common->getData('tbl_albums', array('id' => $id), array('single'));
        if ($data) {
            $result = $this->common->deleteData('tbl_albums', array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Album deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/albumList'), 'refresh');
        }
    }
    public function delete_mood()
    {
        $id = $this->uri->segment(3);
        $type = $this->uri->segment(4);
        $data = $this->common->getData('tbl_your_mood', array('id' => $id), array('single'));
        if ($data) {
            $result = $this->common->deleteData('tbl_your_mood', array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Music Mood deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/moodList'), 'refresh');
        }
    }
    public function delete_artist()
    {
        $id = $this->uri->segment(3);
        $type = $this->uri->segment(4);
        $data = $this->common->getData('tbl_artists', array('id' => $id), array('single'));
        if ($data) {
            $result = $this->common->deleteData('tbl_artists', array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'User deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/artistList'), 'refresh');
        }
    }
    //////////Upload Bulk songs //////////
    public function uploadfolder()
    {
        $this->adminHtml('Your Mood Details', 'uploadsinglesong', $data = '1');
    }
    public function zoneList()
    {
        $data['zone'] = $this->common->getData('tbl_music_zones_types', array());
        $this->adminHtml('Your Zone List', 'zonelist', $data);
    }
    ////Upload single song

    public function uploadSingleSong()
    {
        $this->form_validation->set_rules('track', 'track', 'required');
        $this->form_validation->set_rules('label', 'label', 'required');
        $this->form_validation->set_rules('release_year', 'release_year', 'required');

        if ($this->form_validation->run() == false) {
            $data['artist'] = $this->common->getData('tbl_artists', array(), array());
            $data['genre'] = $this->common->getData('tbl_genre', array(), array());
            $data['album'] = $this->common->getData('tbl_albums', array(), array());
            $data['your_mood'] = $this->common->getData('tbl_your_mood', array(), array());
            $data['zone'] = $this->common->getData('tbl_music_zones_types', array(), array());
            $this->adminHtml('Upload Single Songs', 'uploadsinglesong', $data);
        } else {
            if (isset($_FILES['cover_image'])) {
                $image_name = $_FILES['cover_image']['name'];
                $fileTempName = $_FILES['cover_image']['tmp_name'];
                $bucket_name = 'glistener';
                $data = $this->common->amazons3UploadBucket($image_name, $fileTempName, $bucket_name = 'glistener');
                if ($data) {
                    $_POST['cover_image'] = $image_name;
                } else {
                    $_POST['cover_image'] = "";
                }
            }

            $post = $this->common->getField('tbl_songs', $_POST);
            $result = $this->common->insertData('tbl_songs', $post);
            if ($result) {
                $songs_id = $this->db->insert_id();

                if (isset($_FILES['music_file'])) {
                    $image_name1 = $_FILES['music_file']['name'];
                    $fileTempName1 = $_FILES['music_file']['tmp_name'];
                    $bucket_name1 = 'glistener';

                    $temp = explode(".", $image_name1);
                    $image_name1 =  uniqid() . '.' . end($temp);

                    // $path = '/var/www/html/assets/songs/'.$image_name1; // 05012024 change
                    $path = './assets/songs/' . $image_name1;

                    //==============
                    $name = $_FILES["music_file"]["name"];
                    $ext = end((explode(".", $name)));

                    $data1 =  shell_exec("ffmpeg -i $fileTempName1 -c:v libx264 -tune zerolatency -preset ultrafast -crf 40 -c:a aac -b:a 64k  $path ");
                    //=================

                    $data1 = $this->common->amazons3UploadBucket($image_name1, $path, $bucket_name1 = 'glistener');
                    if ($data1) {
                        if (file_exists($path)) {
                            unlink($path);
                        }
                        $_POST['music_file'] = $image_name1;
                    } else {
                        $_POST['music_file'] = "";
                    }
                }

                if (!empty($_POST['music_file'])) {
                    $result1 = $this->common->insertData('tbl_music_files', array('song_id' => $songs_id, 'master1' => $_POST['music_file'], 'created_at' => date('Y-m-d h:i:s')));
                }

                $response['type'] = 'success';
                $response['msg'] = 'Upload data successfully';
                $response['redirect'] = base_url('admin/songsList'); // 'http://44.197.223.72/admin/songsList' ;

                echo json_encode($response, true);
            } else {
                $response['type'] = 'error';
                $response['msg'] = 'data not uploaded';
                $response['redirect'] = base_url('admin/songsList');
                echo json_encode($response, true);
            }
        }
    }

    ////Upload Songs on S3 bucket in AWS
    public function  uploadsongsonbucket()
    {
        $image_name = $_FILES['cover_image']['name'];
        $fileTempName = $_FILES['cover_image']['tmp_name'];
        $bucket_name = 'glistener';
        $data = $this->common->amazons3UploadBucket($image_name, $fileTempName, $bucket_name);
        if ($data) {
            $this->session->set_flashdata('success', 'Updated successfully');
        } else {
            $this->session->set_flashdata('danger', 'Some Error occured.');
        }
    }

    public function uploadSongs()
    {
        // phpinfo(); exit;
        $data['artist'] = $this->common->getData('tbl_artists', array(), array());
        $data['instrument'] = $this->common->getData('tbl_instruments', array(), array());
        $data['genre'] = $this->common->getData('tbl_genre', array(), array());
        $data['album'] = $this->common->getData('tbl_albums', array(), array());
        $data['your_mood'] = $this->common->getData('tbl_your_mood', array(), array());
        $data['zone'] = $this->common->getData('tbl_music_zones_types', array(), array());
        $this->adminHtml('Upload Mix Songs', 'uploadsongs-list', $data);
    }
    ////Upload multiple songs
    public function uploadSongs1()
    {

        $this->form_validation->set_rules('track', 'track', 'required');
        $this->form_validation->set_rules('label', 'label', 'required');
        // $this->form_validation->set_rules('cover_image', 'cover image', 'required');
        $this->form_validation->set_rules('zone_type', 'zone type', 'required');
        $this->form_validation->set_rules('release_year', 'release year', 'required');

        if ($this->form_validation->run() == false) {
            $data['artist'] = $this->common->getData('tbl_artists', array(), array());
            $data['genre'] = $this->common->getData('tbl_genre', array(), array());
            $data['album'] = $this->common->getData('tbl_albums', array(), array());
            $data['your_mood'] = $this->common->getData('tbl_your_mood', array(), array());
            $data['zone'] = $this->common->getData('tbl_music_zones_types', array(), array());
            $this->adminHtml('Upload Mix Songs', 'uploadsongs-list', $data);
        } else {

            if (isset($_FILES['cover_image'])) {
                $image_name = $_FILES['cover_image']['name'];
                $fileTempName = $_FILES['cover_image']['tmp_name'];
                $bucket_name = 'glistener';
                $data = $this->common->amazons3UploadBucket($image_name, $fileTempName, $bucket_name = 'glistener');

                if ($data) {
                    $_POST['cover_image'] = $image_name;
                } else {
                    $_POST['cover_image'] = "";
                }
            }

            $song = array();
            $post11 = $this->common->getField('tbl_songs', $_POST);
            $result = $this->common->insertData('tbl_songs', $post11);

            if ($result) {
                $songs_id = $this->db->insert_id();
                if (!empty($_FILES['music_file']['name'][1])) {
                    $filesCount = count($_FILES['music_file']['name']);

                    $zone_type = $_POST['zone_type'];

                    if ($zone_type == '1') {
                        $filesCount = 5;
                    } else {
                        $filesCount = 6;
                    }


                    for ($i = 1; $i <= $filesCount; $i++) {
                        $_FILES['songs']['name'] = $_FILES['music_file']['name'][$i];
                        $_FILES['songs']['type'] = $_FILES['music_file']['type'][$i];
                        $_FILES['songs']['tmp_name'] = $_FILES['music_file']['tmp_name'][$i];
                        $_FILES['songs']['error'] = $_FILES['music_file']['error'][$i];
                        $_FILES['songs']['size'] = $_FILES['music_file']['size'][$i];
                        $bucket_name = 'glistener';
                        $data1 = $this->common->amazons3UploadBucket($_FILES['music_file']['name'][$i], $_FILES['music_file']['tmp_name'][$i], $bucket_name);
                        if ($data1) {
                            $song[] = $_FILES['songs']['name'];
                        }
                    }

                    if (!empty($song)) {
                        $result1 = $this->common->insertData(
                            'tbl_music_files',
                            array(
                                'song_id' => $songs_id,
                                'drums' => isset($song[0]) ? $song[0] : "",
                                'bass' => isset($song[1]) ? $song[1] : "",
                                'guitar' => isset($song[2]) ? $song[2] : "",
                                'vocals' => isset($song[3]) ? $song[3] : "",
                                'master1' =>  isset($song[4]) ? $song[4] : "",
                                'master2' =>  isset($song[5]) ? $song[5] : "",
                                'created_at' => date('Y-m-d h:i:s')
                            )
                        );
                    }


                    // $this->session->set_flashdata('success', 'Upload data successfully');

                    $response['type'] = 'success';
                    $response['msg'] = 'Upload data successfully';
                    $response['redirect'] = base_url('admin/songsList');

                    // 'http://44.197.223.72/admin/songsList' ;

                    echo json_encode($response, true);
                } else {

                    // $this->session->set_flashdata('error', 'Some Error occured.');

                    $response['type'] = 'error';
                    $response['msg'] = 'data not uploaded';
                    $response['redirect'] = base_url('admin/songsList');
                    echo json_encode($response, true);
                }

                // redirect(base_url('admin/songsList'), 'refresh');
            }
        }
    }

    public function editUploadSongs2()
    {
        $songs_id = $this->uri->segment(3);

        $data['songs'] = $this->common->getData('tbl_songs', array('id' => $songs_id), array('single'));
        $data['file'] = $this->common->getData('tbl_music_files', array('song_id' => $songs_id), array('single'));
        $data['artist'] = $this->common->getData('tbl_artists', array(), array());
        $data['genre'] = $this->common->getData('tbl_genre', array(), array());
        $data['album'] = $this->common->getData('tbl_albums', array(), array());
        $data['your_mood'] = $this->common->getData('tbl_your_mood', array(), array());
        $data['zone'] = $this->common->getData('tbl_music_zones_types', array(), array());
        $this->form_validation->set_rules('track', 'track', 'required');
        $this->form_validation->set_rules('label', 'label', 'required');
        $this->form_validation->set_rules('zone_type', 'zone type', 'required');
        $this->form_validation->set_rules('release_year', 'release year', 'required');
        if ($this->form_validation->run() == false) {
            $this->adminHtml('Edit Your Mix Songs', 'editUploadSongs', $data);
        } else {
            unset($_POST["submit"]);
            $id = $this->input->post('song_id');
            unset($_POST["song_id"]);
            $data['songs'] = $this->common->getData('tbl_songs', array('id' => $id), array('single'));


            if (!empty($_FILES['cover_image']['name'])) {
                //      if(!empty($data['songs']['cover_image']))
                // {
                //  $songs_del= $this->common->delete_songs_onS3Bucket('glistener',$data['cover_image']);    
                // }
                $image_name = $_FILES['cover_image']['name'];
                $fileTempName = $_FILES['cover_image']['tmp_name'];
                $bucket_name = 'glistener';
                $data = $this->common->amazons3UploadBucket($image_name, $fileTempName, $bucket_name = 'glistener');
                if ($data) {
                    $_POST['cover_image'] = $image_name;
                } else {
                    $_POST['cover_image'] = "";
                }
            } else {
                $_POST['cover_image'] = $data['songs']['cover_image'];
            }

            $song = array();
            $data  = array();

            $result = $this->common->updateData('tbl_songs', $_POST, array('id' => $id));

            if ($result) {

                $bucket_name = 'glistener';
                $data['file'] = $this->common->getData('tbl_music_files', array('song_id' => $id), array('single'));
                if (!empty($_FILES['music_file']['name'][1])) {

                    $temp = explode(".", $_FILES['music_file']['name'][1]);
                    $_FILES['music_file']['name'][1] =  uniqid() . '.' . end($temp);

                    $data1 = $this->common->amazons3UploadBucket($_FILES['music_file']['name'][1], $_FILES['music_file']['tmp_name'][1], $bucket_name);
                    $song[0] = $_FILES['music_file']['name'][1];
                }
                if (!empty($_FILES['music_file']['name'][2])) {

                    $temp = explode(".", $_FILES['music_file']['name'][2]);
                    $_FILES['music_file']['name'][2] =  uniqid() . '.' . end($temp);

                    $data1 = $this->common->amazons3UploadBucket($_FILES['music_file']['name'][2], $_FILES['music_file']['tmp_name'][2], $bucket_name);
                    $song[1] = $_FILES['music_file']['name'][2];
                }
                if (!empty($_FILES['music_file']['name'][3])) {

                    $temp = explode(".", $_FILES['music_file']['name'][3]);
                    $_FILES['music_file']['name'][3] =  uniqid() . '.' . end($temp);

                    $data1 = $this->common->amazons3UploadBucket($_FILES['music_file']['name'][3], $_FILES['music_file']['tmp_name'][3], $bucket_name);
                    $song[2] = $_FILES['music_file']['name'][3];
                }
                if (!empty($_FILES['music_file']['name'][4])) {

                    $temp = explode(".", $_FILES['music_file']['name'][4]);
                    $_FILES['music_file']['name'][4] =  uniqid() . '.' . end($temp);

                    $data1 = $this->common->amazons3UploadBucket($_FILES['music_file']['name'][4], $_FILES['music_file']['tmp_name'][4], $bucket_name);
                    $song[3] = $_FILES['music_file']['name'][4];
                }
                if (!empty($_FILES['music_file']['name'][5])) {

                    $temp = explode(".", $_FILES['music_file']['name'][5]);
                    $_FILES['music_file']['name'][5] =  uniqid() . '.' . end($temp);
                    $data1 = $this->common->amazons3UploadBucket($_FILES['music_file']['name'][5], $_FILES['music_file']['tmp_name'][5], $bucket_name);
                    $song[4] = $_FILES['music_file']['name'][5];
                }
                if (!empty($_FILES['music_file']['name'][6])) {

                    $temp = explode(".", $_FILES['music_file']['name'][6]);
                    $_FILES['music_file']['name'][6] =  uniqid() . '.' . end($temp);

                    $data1 = $this->common->amazons3UploadBucket($_FILES['music_file']['name'][6], $_FILES['music_file']['tmp_name'][6], $bucket_name);
                    $song[5] = $_FILES['music_file']['name'][6];
                }

                $result1 = $this->common->updateData(
                    'tbl_music_files',
                    array(
                        'drums' => isset($song[0]) ? $song[0] : $data['file']['drums'],
                        'bass' => isset($song[1]) ? $song[1] : $data['file']['bass'],
                        'guitar' => isset($song[2]) ? $song[2] : $data['file']['guitar'],
                        'vocals' => isset($song[3]) ? $song[3] : $data['file']['vocals'],
                        'master1' =>  isset($song[4]) ? $song[4] : $data['file']['master1'],
                        'master2' =>  isset($song[5]) ? $song[5] : $data['file']['master2']
                    ),
                    array('song_id' => $id)
                );
                if ($result1) {
                    $response['type'] = 'success';
                    $response['msg'] = 'Upload data successfully';
                    $response['redirect'] = base_url('admin/songsList');
                    echo json_encode($response, true);
                } else {
                    $response['type'] = 'error';
                    $response['msg'] = 'data not uploaded';
                    $response['redirect'] = base_url('admin/songsList');
                    echo json_encode($response, true);
                }
            }
        }
    }
    /////End/////
    public function userList()
    {
        $data['user'] = $this->common->getData('tbl_users', array('status' => 0), array('sort_by' => 'id', 'sort_direction' => 'DESC'));
        $this->adminHtml('Users List', 'user-list', $data);
    }

    public function artistList()
    {
        $data['artist'] = $this->common->getData('tbl_artists', array());

        $this->adminHtml('Artist List', 'artist-list', $data);
    }

    public function terms()
    {
        $data['terms'] = $this->common->getData('tbl_terms_and_condition', array('id' => '1'), array());
        $this->adminHtml('Terms and Condition', 'edit-terms', $data);
    }
    public function privacy()
    {
        $data['privacy'] = $this->common->getData('tbl_terms_and_condition', array('id' => '2'), array());
        $this->adminHtml('Privacy Policy', 'editprivacypolicy', $data);
    }

    public function genreList()
    {
        $data['genre'] = $this->common->getData('tbl_genre', array());
        $this->adminHtml('Category List', 'genre-list', $data);
    }

    public function instrumentList()
    {
        $data['instrument'] = $this->common->getData('tbl_instruments', array());
        $this->adminHtml('Instrument List', 'instrument-list', $data);
    }

    public function favUsersList()
    {
        $data['favuser'] = $this->common->getData('tbl_favourite_artists', array());
        $this->adminHtml('Favourite User List', 'favuser-list', $data);
    }

    public function songsList()
    {
        $data['songs'] = $this->common->getData('tbl_songs', array(), array('sort_by' => 'id', 'sort_direction' => 'DESC'));
        $data['instruments'] = $this->common->getData('tbl_instruments', array(), array());
        $this->adminHtml('Songs List', 'songs-list', $data);
    }

    public function requestsongList()
    {
        $data['requestsong'] = $this->common->getData('request_song', array(), array('sort_by' => 'id', 'sort_direction' => 'DESC'));
        $this->adminHtml('Request Song List', 'requestsong-list', $data);
    }

    public function albumList()
    {
        $data['album'] = $this->common->getData('tbl_albums', array());

        $this->adminHtml('Album List', 'album-list', $data);
    }
    public function moodList()
    {
        $data['mood'] = $this->common->getData('tbl_your_mood', array());
        $this->adminHtml('Mood List', 'mood-list', $data);
    }
    ////Zone Types Listing 
    public function showStemOnlyList($id)
    {
        $data['stems'] = $this->common->getData('tbl_music_zones', array('zone_type' => $id), array());
        $this->adminHtml('Music Zone Type List', 'stemonly', $data);
    }

    ////End of Code 
    public function edit_artist()
    {
        $user_id = $this->uri->segment(3);
        $this->form_validation->set_rules('artist_name', 'full_name', 'required');

        $data['user'] = $this->common->getData('tbl_artists', array('id' => $user_id), array('single'));
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->common->getData('tbl_artists', array('id' => $user_id), array('single'));
            $this->adminHtml('Update artist details', 'add-artist', $data);
        } else {
            unset($_POST["submit"]);
            $id = $this->input->post('id');
            unset($_POST["id"]);
            if (!empty($_FILES['image']['name'])) {
                $image_name = fileuploadCI('image', './assets/artist/');
                // $image1 = $this->common->do_upload_img('image', './assets/artist');
                if (isset($image_name)) {
                    $_POST['image'] = $image_name;
                }
            }

            $result = $this->common->updateData('tbl_artists', $_POST, array('id' => $user_id));
            if ($result) {
                $this->session->set_flashdata('success', 'Updated successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/artistList'), 'refresh');
        }
    }
    public function edit_user()
    {

        $user_id = $this->uri->segment(3);
        $this->form_validation->set_rules('email ', 'email ', 'required');
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->common->getData('tbl_users', array('id' => $user_id), array('single'));
            $this->adminHtml('Update User Details', 'add-user', $data);
        } else {
            unset($_POST["submit"]);
            $id = $this->input->post('id');
            unset($_POST["id"]);
            $result = $this->common->updateData('tbl_users', $_POST, array('id' => $user_id));
            if ($result) {
                $this->session->set_flashdata('success', 'Updated successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/userList'), 'refresh');
        }
    }


    public function delete_songlist()
    {
        $id = $this->input->post('id');
        $data['reel'] = $this->common->deleteData('songs', array('id' => $id));
        if ($data) {
            echo '1';
        } else {
            echo '0';
        }
    }
    public function delete_gencategory()
    {
        $id = $this->input->post('id');
        $data['cat'] = $this->common->deleteData('genre_category', array('genre_id' => $id));
        if ($data) {
            echo '1';
        } else {
            echo '0';
        }
    }


    public function termServices()
    {
        $this->form_validation->set_rules('editor', 'Info', 'required');
        if ($this->form_validation->run() == false) {
            $data['terms'] = $this->common->getData('tbl_terms_and_condition', array('id' => '1'), array('single'));
            $this->adminHtml('Update Terms and services', 'edit-terms', $data);
        } else {
            $data['info'] = $this->input->post('editor');
            $id = $this->input->post('id');
            $result = $this->common->updateData('tbl_terms_and_condition', $data, array('id' => '1'));
            if ($result) {
                $this->session->set_flashdata('success', 'Terms and Conditions update successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/termServices'), 'refresh');
        }
    }
    public function privacyPolicy()
    {
        $this->form_validation->set_rules('editor', 'Info', 'required');
        if ($this->form_validation->run() == false) {
            $data['privacy'] = $this->common->getData('tbl_terms_and_condition', array('id' => '2'), array('single'));
            $this->adminHtml('Update Terms and services', 'editprivacypolicy', $data);
        } else {
            $data['info'] = $this->input->post('editor');
            $id = $this->input->post('id');
            $result = $this->common->updateData('tbl_terms_and_condition', $data, array('id' => '2'));
            if ($result) {
                $this->session->set_flashdata('success', 'Privacy Policy update successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/privacyPolicy'), 'refresh');
        }
    }

    public function edit_genrecategory()
    {
        $genre_id = $this->uri->segment(3);
        $this->form_validation->set_rules('genre_type', 'genre type', 'required');
        if ($this->form_validation->run() == false) {
            $data['cat'] = $this->common->getData('tbl_genre', array('id' => $genre_id), array('single'));
            $this->adminHtml('Update Category', 'add-genrecat', $data);
        } else {
            unset($_POST["submit"]);
            $id = $this->input->post('id');
            unset($_POST["id"]);
            if (!empty($_FILES['image']['name'])) {
                $image_name = fileuploadCI('image', './assets/genre/');
                // $image1 = $this->common->do_upload_img('image', './assets/genre');
                if (isset($image_name)) {
                    $_POST['image'] = $image_name;
                }
            }

            $result = $this->common->updateData('tbl_genre', $_POST, array('id' => $genre_id));
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data update successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/genreList'), 'refresh');
        }
    }

    public function edit_instrument()
    {
        $inst_id = $this->uri->segment(3);

        $this->form_validation->set_rules('instrument', 'instrument', 'required');

        if ($this->form_validation->run() == false) {
            $data['cat'] = $this->common->getData('tbl_instruments', array('id' => $inst_id), array('single'));
            $this->adminHtml('Update Instrument', 'edit-instrument', $data);
        } else {
            unset($_POST["submit"]);
            $id = $this->input->post('id');
            unset($_POST["id"]);

            $result = $this->common->updateData('tbl_instruments', $_POST, array('id' => $inst_id));
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data update successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/instrumentList'), 'refresh');
        }
    }

    public function edit_moodtype()
    {
        $user_id = $this->uri->segment(3);
        $this->form_validation->set_rules('mood_type', 'mood_type', 'required');

        $data['mood'] = $this->common->getData('tbl_your_mood', array('id' => $user_id), array('single'));
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->common->getData('tbl_your_mood', array('id' => $user_id), array('single'));
            $this->adminHtml('Update music mood details', 'add-mood', $data);
        } else {
            unset($_POST["submit"]);
            $id = $this->input->post('id');
            unset($_POST["id"]);
            if (isset($_FILES['image'])) {
                $image = $this->common->do_upload_img('image', './assets/mood/');
                if (isset($image['upload_data'])) {
                    $image = $image['upload_data']['file_name'];
                    $_POST['image'] = $image;
                }
            }
            $result = $this->common->updateData('tbl_your_mood', $_POST, array('id' => $user_id));
            if ($result) {
                $this->session->set_flashdata('success', 'Updated successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/moodList'), 'refresh');
        }
    }
    public function edit_album()
    {
        $id = $this->uri->segment(3);
        $this->form_validation->set_rules('album_type', 'album name', 'required');
        if ($this->form_validation->run() == false) {
            $data['album'] = $this->common->getData('tbl_albums', array('id' => $id), array('single'));
            $this->adminHtml('Update album', 'add-album', $data);
        } else {
            unset($_POST["submit"]);
            $id = $this->input->post('id');
            unset($_POST["id"]);
            if (isset($_FILES['image'])) {
                $image = $this->common->do_upload_img('image', './assets/albums/');
                if (isset($image['upload_data'])) {
                    $image = $image['upload_data']['file_name'];
                    $_POST['image'] = $image;
                }
            }
            $result = $this->common->updateData('tbl_albums', $_POST, array('id' => $id));
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data update successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/albumList'), 'refresh');
        }
    }
    public function add_album()
    {

        $this->form_validation->set_rules('album_type', 'album type', 'required');
        if ($this->form_validation->run() == false) {
            $data = true;
            $this->adminHtml('Add Album', 'add-album', $data);
        } else {

            if (isset($_FILES['image'])) {

                $image = $this->common->do_upload_img('image', './assets/albums/');
                if (isset($image['upload_data'])) {
                    $image = $image['upload_data']['file_name'];
                    $_POST['image'] = $image;
                }
            }
            // unset($_POST["submit"]);   
            $post = $this->common->getField('tbl_albums', $_POST);
            $result = $this->common->insertData('tbl_albums', $post);
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data added successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/albumList'), 'refresh');
        }
    }
    public function add_mood()
    {

        $this->form_validation->set_rules('mood_type', 'mood type', 'required');
        if ($this->form_validation->run() == false) {
            $data = true;
            $this->adminHtml('Add Mood', 'add-mood', $data);
        } else {

            if (isset($_FILES['image'])) {

                $image = $this->common->do_upload_img('image', './assets/mood/');
                if (isset($image['upload_data'])) {
                    $image = $image['upload_data']['file_name'];
                    $_POST['image'] = $image;
                }
            }
            // unset($_POST["submit"]);   
            $post = $this->common->getField('tbl_your_mood', $_POST);
            $result = $this->common->insertData('tbl_your_mood', $post);
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data added successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/moodList'), 'refresh');
        }
    }
    public function add_user()
    {
        $this->form_validation->set_rules('email', ' email', 'required');
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        if ($this->form_validation->run() == false) {
            $data = true;
            $this->adminHtml('Add User', 'add-user', $data);
        } else {
            unset($_POST["submit"]);
            $post = $this->common->getField('tbl_users', $_POST);
            $result = $this->common->insertData('tbl_users', $post);
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data added successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/userList'), 'refresh');
        }
    }
    public function add_artist()
    {
        $this->form_validation->set_rules('artist_name', 'Artist name', 'required');
        if ($this->form_validation->run() == false) {
            $data = true;
            $this->adminHtml('Add Artist', 'add-artist', $data);
        } else {
            if (isset($_FILES['image'])) {
                // $image = $this->common->do_upload_img('image','./assets/artist/');
                $image =  $image = fileuploadCI('image', './assets/artist/');
                if (isset($image)) {
                    $_POST['image'] = $image;
                }
            }
            unset($_POST["submit"]);
            $post = $this->common->getField('tbl_artists', $_POST);
            $result = $this->common->insertData('tbl_artists', $post);
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data added successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/artistList'), 'refresh');
        }
    }
    public function add_genre()
    {
        $this->form_validation->set_rules('genre_type', 'Genre name', 'required');
        if ($this->form_validation->run() == false) {
            $data = true;
            $this->adminHtml('Add Category', 'add-genrecat', $data);
        } else {

            if (isset($_FILES['image'])) {

                // $image = $this->common->do_upload_img($_FILES['image']['name'],'./assets/genre/');
                $image = fileuploadCI('image', './assets/genre/');
                if (isset($image)) {
                    $_POST['image'] = $image;
                }
            }
            unset($_POST["submit"]);
            $post = $this->common->getField('tbl_genre', $_POST);
            $result = $this->common->insertData('tbl_genre', $post);
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data added successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/genreList'), 'refresh');
        }
    }
    public function add_songs()
    {
        $this->form_validation->set_rules('track', 'track', 'required');
        $this->form_validation->set_rules('label', 'label', 'required');
        $this->form_validation->set_rules('artist', 'artist', 'required');
        $this->form_validation->set_rules('genre', 'genre', 'required');
        $this->form_validation->set_rules('release_year', 'release_year', 'required');
        $this->form_validation->set_rules('track_no', 'track_no', 'required');
        if ($this->form_validation->run() == false) {
            $data = true;
            $this->adminHtml('Add Artist', 'add-songs', $data);
        } else {
            unset($_POST["submit"]);
            $post = $this->common->getField('tbl_songs', $_POST);
            $result = $this->common->insertData('tbl_songs', $post);
            if ($result) {
                $a = $this->session->set_flashdata('success', 'Data added successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/songList'), 'refresh');
        }
    }
    public function admineditprofile()
    {
        $admin_id = $this->uri->segment(3);
        $session = $this->session->userdata('admin');
        $data['admin'] = $this->common->getData('admin', array('id' => $admin_id), array('single'));
        $this->adminHtml('profile', 'profile-edit', $data);
    }
    public function usereditprofile()
    {
        $user_id = $this->uri->segment(3);
        $session = $this->session->userdata('user');
        $data['user'] = $this->common->getData('user', array('id' => $user_id), array('single'));
        $this->adminHtml('profile', 'user-edit', $data);
    }
    public function product_quantity()
    {
        $product_id = $this->uri->segment(3);
        $data['product'] = $this->common->getData('product_quantity', array('product_id' => $product_id));
        $this->adminHtml('Product Quantity List', 'product-quantity-list', $data);
    }

    //notification 12012024 start //
    // public function tested($tokens='', $message='') { 
    //     $userArray = $this->common->getData('tbl_users', array('fcm_token !=' => ''));
    //     $userIds = array();
    //     // Loop through the main array and extract IDs
    //     foreach ($userArray as $user) {
    //         $userIds[] = $user['fcm_token'];
    //         $datadetail = array('receiver_id' => $user['id'], 'message' =>'Hey '.$user['firstname'].', You got new song in your playlist. Start Mixing');
    //         $result1 = $this->common->insertData('tbl_notification', $datadetail);
    //     }
    //     $message = array('data'=>'New Notification','receiver_id' => 'receiver_id' );
    //     $this->send_notificationnew($userIds,$message);
    // }
    public function send_notificationnew($tokens = '', $message = '')
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => $tokens,
            'priority' => 'high',
            'notification' => array('body' => $message['data'], 'title' => 'New Song Upload.')
        );
        $headers = array('Authorization:key = AAAAJzjCdfE:APA91bGc8s7EUN5ucO5lPKiWM7-vwHfzo1hIyrRcU_pQzQd1Clv3dhztd-IfzLLW5WeYAyF4fw9tJCkXwO1daoRpP4YpjE2NuPfmwmS-w7-BdmMVCa9D8b_NxrWXZhhbGtoObUsMUAYo', 'Content-Type: application/json');

        $senddata =  $this->curl($url, $headers, $fields);
        return $senddata;
    }
    //notification 12012024 end //

    public function send_notification($tokens, $message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array('registration_ids' => $tokens, "data" => $message);
        $headers = array('Authorization:key = AAAAA_p0eoY:APA91bFA-fYFpwSsr_C80kzYPxVYR3nBB6fgfWD6VvvmaMipIA-6S7Tmfd16s5CUkZ8p8f3ik9_NWtnM1CSrkxxdxa27vfm-82JT4trstFfdDOU9VMKHGZdGi6tCdoOz0S9ymHVmgywQ', 'Content-Type: application/json');
        return $this->curl($url, $headers, $fields);
    }
    public function send_notification_ios($tokens, $message, $title, $type)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = 'AAAAli86Xtc:APA91bFq8_Nk446lfNtSgIrYt_6HB0Ea62wZoZmkM5LmqIjTPVy0NylOkwPd-QmKeGXsEqRbRUv3fejo7KQe5YE8hX6ShdGNdtDkAI6xl6NF0p85zWdFU8_xut1HV7QrBeNiyeKCvmrR';
        /*	$title = "new notification";*/
        $body = "$message";
        $notification = array('title' => $title, 'text' => $body, 'type' => $type, 'sound' => 'default', 'badge' => '1');
        $fields = array('to' => $tokens, 'notification' => $notification, 'priority' => 'high');
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;
        return $this->curl($url, $headers, $fields);
    }
    public function send_notification_ios1($tokens, $message, $title, $type, $typee)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = 'AAAAli86Xtc:APA91bFq8_Nk446lfNtSgIrYt_6HB0Ea62wZoZmkM5LmqIjTPVy0NylOkwPd-QmKeGXsEqRbRUv3fejo7KQe5YE8hX6ShdGNdtDkAI6xl6NF0p85zWdFU8_xut1HV7QrBeNiyeKCvmrR';
        $body = "$message";
        $data = $typee;
        $notification = array('title' => $title, 'text' => $body, 'type' => $type, 'sound' => 'default', 'badge' => '1');
        $fields = array('to' => $tokens, 'data' => $data, 'notification' => $notification, 'priority' => 'high');
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;
        return $this->curl($url, $headers, $fields);
    }

    public function home()
    {
        $data['home1'] = $this->common->getData('home', array('id' => 1), array('single'));
        $data['home2'] = $this->common->getData('home', array('id' => 2), array('single'));
        $data['home3'] = $this->common->getData('home', array('id' => 3), array('single'));
        $data['home4'] = $this->common->getData('home', array('id' => 4), array('single'));
        $data['home5'] = $this->common->getData('home', array('id' => 5), array('single'));
        $data['home6'] = $this->common->getData('home', array('id' => 6), array('single'));
        $this->adminHtml('home', 'home', $data);
    }


    public function dashboard()
    {
        $data['user'] = $this->common->getData('tbl_users', array(), array('count'));
        $data['follower'] = $this->common->getData('tbl_artists', array(), array('count'));
        $data['concerts'] = $this->common->getData('tbl_favourite_artists', array(), array('count'));
        $data['genre'] = $this->common->getData('tbl_genre', array(), array('count'));

        $this->adminHtml('Dashboard', 'admin/dashboard', $data);
    }

    public function total_revence()
    {
        $user = $this->common->getData('tbl_users', array(), array('count'));
        $favourite = $this->common->getData('tbl_favourite_artists', array(), array('count'));
        $artists = $this->common->getData('tbl_artists', array(), array('count'));
        echo json_encode(array('user' => $user, 'favourite' => $favourite, 'artists' => $artists), true);
    }
    public function adminList()
    {
        $data['user'] = $this->common->getData('admin', array());
        $this->adminHtml('Admin List', 'admin-list', $data);
    }

    public function send_single_mail($user_id)
    {
        $this->form_validation->set_rules('editor', 'Info', 'required');
        if ($this->form_validation->run() == false) {
            $data['user_id'] = $user_id;
            $this->adminHtml('Add Message', 'send-single-email', $data);
        } else {
            $user_id = $this->input->post('user_id');
            $where = "id = '" . $user_id . "'";
            $user_result = $this->common->getData('user', $where, array('single'));
            $to_email = $user_result['email'];
            $message = $this->input->post('editor');
            $template = $this->load->view('template/broadcast-email', array('message' => $message), true);
            $send_mail = $this->common->sendMail($to_email, "kutz Updates", $template);
            if ($send_mail) {
                $this->session->set_flashdata('success', 'Data added successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/send_single_mail/' . $user_id));
        }
    }
    public function profile($id)
    {
        $data['user'] = $this->common->getData('tbl_users', array('id' => $id), array('single'));
        $this->adminHtml('User Profile', 'user-detail', $data);
    }
    public function view_mood($id)
    {
        $data['mood'] = $this->common->getData('tbl_your_mood', array('id' => $id), array('single'));
        $this->adminHtml('Your Mood Details', 'view-mood', $data);
    }
    //Terms and Privacy Policy
    public function edit_term_services()
    {
        $this->form_validation->set_rules('editor', 'Info', 'required');
        if ($this->form_validation->run() == false) {
            $data['terms'] = $this->common->getData('tbl_terms_and_condition', array('id' => '3'), array('single'));
            $this->adminHtml('Update Terms and services', 'edit-terms', $data);
        } else {
            $data['data'] = $this->input->post('editor');
            $id = $this->input->post('id');
            $result = $this->common->updateData('tbl_terms_and_condition', $data, array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Terms and Conditions update successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/edit_term_services'), 'refresh');
        }
    }
    public function edit_privacy_policy()
    {
        $this->form_validation->set_rules('editor', 'Info', 'required');
        if ($this->form_validation->run() == false) {
            $data['privacy'] = $this->common->getData('tbl_terms_and_condition', array('id' => '4'), array('single'));
            $this->adminHtml('Update Terms and services', 'edit_privacy_policy', $data);
        } else {
            $data['data'] = $this->input->post('editor');
            $id = $this->input->post('id');
            $result = $this->common->updateData('tbl_terms_and_condition', $data, array('id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Privacy Policy update successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/edit_privacy_policy'), 'refresh');
        }
    }

    //End of the code
    public function send_request()
    {
        sleep(2);
        if ($this->input->post('send_userid')) {
            $data = array('sender_id' => $this->input->post('send_userid'), 'receiver_id' => $this->input->post('receiver_userid'));
            $this->common->Insert_chat_request($data);
        }
    }
    function load_notification()
    {
        sleep(2);
        if ($this->input->post('action')) {
            $data = $this->common->Fetch_notification_data($this->session->userdata('id'));
            $output = array();
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $row) {
                    $userdata = $this->common->Get_user_data($row->sender_id);
                    $output[] = array('user_id' => $row->sender_id, 'first_name' => $userdata['first_name'], 'last_name' => $userdata['last_name'], 'profile_picture' => $userdata['profile_picture'], 'chat_request_id' => $row->chat_request_id);
                }
            }
            echo json_encode($output);
        }
    }
    public function send_chat()
    {
        $session = $this->session->userdata('admin');
        if ($this->input->post('receiver_id')) {
            $data = array('sender_id' => 0, 'sender_type' => 'admin', 'receiver_id' => $this->input->post('receiver_id'), 'receiver_type' => $this->input->post('receiver_type'), 'chat_messages_text' => $this->input->post('chat_message'), 'chat_messages_status' => 'no', 'chat_messages_datetime' => date('Y-m-d H:i:s'));
            $this->common->Insert_chat_message($data);
        }
    }
    public function load_chat_data()
    {
        $session = $this->session->userdata('admin');
        if ($this->input->post('receiver_id')) {
            $receiver_id = $this->input->post('receiver_id');
            $receiver_type = $this->input->post('receiver_type');
            $session = $this->session->userdata('admin');
            $sender_id = 0;
            $sender_type = 'admin';
            if ($this->input->post('update_data') == 'yes') {
                $this->common->Update_chat_message_status($sender_id);
            }
            $chat_data = $this->common->Fetch_chat_data($sender_id, $sender_type, $receiver_id, $receiver_type);
            if ($chat_data->num_rows() > 0) {
                foreach ($chat_data->result() as $row) {
                    $message_direction = '';
                    if ($row->sender_id == $sender_id && $row->sender_type == $sender_type) {
                        $message_direction = 'right';
                    } else {
                        $message_direction = 'left';
                    }
                    $date = date('D M Y H:i', strtotime($row->chat_messages_datetime));
                    $output[] = array('chat_messages_text' => $row->chat_messages_text, 'chat_messages_datetime' => $date, 'message_direction' => $message_direction);
                }
            }
            echo json_encode($output);
        }
    }
    public function check_chat_notification()
    {
        if ($this->input->post('user_id_array')) {
            $session = $this->session->userdata('admin');
            $receiver_id = $session['id'];
            $this->common->Update_login_data();
            $user_id_array = explode(",", $this->input->post('user_id_array'));
            $output = array();
            foreach ($user_id_array as $sender_id) {
                if ($sender_id != '') {
                    $status = "offline";
                    $last_activity = $this->common->User_last_activity($sender_id);
                    $is_type = '';
                    if ($last_activity != '') {
                        $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
                        $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
                        if ($last_activity > $current_timestamp) {
                            $status = 'online';
                            $is_type = $this->common->Check_type_notification($sender_id, $receiver_id, $current_timestamp);
                        }
                    }
                    $output[] = array('user_id' => $sender_id, 'total_notification' => $this->common->Count_chat_notification($sender_id, $receiver_id), 'status' => $status, 'is_type' => $is_type);
                }
            }
            echo json_encode($output);
        }
    }

    public function import()
    {
        $data = array();
        $memData = array();
        // If import request is submitted
        if ($this->input->post('importSubmit')) {
            // Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_checks');
            // Validate submitted form data
            if ($this->form_validation->run() == true) {
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                // If file uploaded
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    // Insert/update CSV data into database
                    if (!empty($csvData)) {
                        foreach ($csvData as $row) {
                            $rowCount++;
                            // Prepare data for DB insertion
                            $memData = array('vendor_id' => 0, 'category' => $row['category'], 'name' => $row['name'], 'currency' => $row['currency'], 'regular_price' => $row['regular_price'], 'sale_price' => $row['sale_price'], 'product_quantity' => $row['product_quantity'], 'product_description' => $row['product_description'], 'short_desc' => $row['short_desc'], 'long_desc' => $row['long_desc'], 'region' => $row['region'], 'ABV' => $row['ABV'],);
                            // Check whether email already exists in the database
                            $con = array('where' => array('name' => $row['name']), 'returnType' => 'count');
                            $prevCount = $this->common->getRows($con);
                            if ($prevCount > 0) {
                                // Update member data
                                $condition = array('name' => $row['name']);
                                $update = $this->common->update($memData, $condition);
                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                // Insert member data
                                $insert = $this->common->insert($memData);
                                if ($insert) {
                                    $insertCount++;
                                }
                            }
                        }
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Members imported successfully. Total Rows (' . $rowCount . ') | Inserted (' . $insertCount . ') | Updated (' . $updateCount . ') | Not Inserted (' . $notAddCount . ')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
                } else {
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            } else {
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('admin/productlist');
    }
    /*
     * Callback function to check file value and type during validation
    */
    public function file_checks($str)
    {
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if (($ext == 'csv') && in_array($mime, $allowed_mime_types)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }
    public function adminprofile()
    {

        $admin_id = $this->uri->segment(3);
        $session = $this->session->userdata('admin');
        $data['admin_id'] = $admin_id;
        $data['admin'] = $this->common->getData('admin', array('id' => $admin_id), array('single'));
        /*  $data['services'] = $this->common->getData('service_offer_subcategory', array(
         'created_by' => $admin_id) , array(''));*/
        $this->adminHtml('profile', 'profile', $data);
    }
    public function edit_admin_profile()
    {
        ///chandni 11/09/2020
        $session = $this->session->userdata('admin');
        $admin_id = $this->uri->segment(3);
        $this->form_validation->set_rules('first_name', 'first Name', 'required');
        $d = $this->common->getData('admin', array('id' => $admin_id), array('single'));
        if ($this->form_validation->run() == false) {
            $data['admin'] = $this->common->getData('admin', array('id' => $admin_id));
            $this->adminHtml('profile', 'profile-edit', $data);
        } else {
            $image = $d['image'];
            $password = $d['password'];
            if (!empty($_FILES['image']['name'])) {
                $image_name = fileuploadCI('image', './assets/uploads/');
                // $image1 = $this->common->do_upload_img('image', './assets/uploads');
                if (isset($image_name)) {
                    $image = $image_name;
                }
            }
            if (!empty($_POST['password'])) {
                $password = md5($_POST['password']);
            }
            $_POST['image'] = $image;
            $_POST['password'] = $password;
            $admin_id = $_POST['admin_id'];
            $post = $this->common->getField('admin', $_POST);
            $result = $this->common->updateAdminData('admin', $post, array('id' => $admin_id));
            //$afftectedRows=$this->db->affected_rows();
            //print_r($result);exit;
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Profile Updated Successfully.');
                redirect(base_url('admin/adminprofile/') . $admin_id);
            } else if ($result == 0) {
                $this->session->set_flashdata('success', 'Nothing Updated');
                redirect(base_url('admin/adminprofile/') . $admin_id);
            } else {
                $this->session->set_flashdata('danger', 'Profile Not Updated.Please Try Again.');
                redirect(base_url('admin/admineditprofile/') . $admin_id);
            }
        }
    }
    public function add_admin_profile()
    {
        ///chandni 11/09/2020
        $this->form_validation->set_rules('first_name', 'first_name', 'required');
        $this->form_validation->set_rules('last_name', 'last_name', 'required');
        /* $this->form_validation->set_rules('email','Email', 'required|trim|callback_validate_adminemail');*/
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == false) {
            $data = true;
            $this->adminHtml('profile', 'profile-edit', $data);
        } else {
            if (!empty($_FILES['image'])) {
                $image1 = $this->common->do_upload_img('image', './assets/uploads');
                if (isset($image1['upload_data'])) {
                    $image = $image1['upload_data']['file_name'];
                }
            }
            $_POST['image'] = $image;
            $_POST['password'] = md5($_POST['password']);
            if (!empty($_POST['role_id'])) {
                $role_id = $_POST['role_id'];
            }
            $_POST['created_at'] = date('Y-m-d');
            $post = $this->common->getField('admin', $_POST);
            $result = $this->common->insertData('admin', $post);
            $admin_id = $this->db->insert_id();
            if ($result) {
                $sizeof = sizeof($role_id);
                for ($i = 0; $i < $sizeof; $i++) {
                    $datadetail = array('role_id' => $role_id[$i], 'admin_id' => $admin_id, 'created_at' => date('Y-m-d'), 'created_time' => date('H:i:s'));
                    $result1 = $this->common->insertData('user_permission_map', $datadetail);
                }
                $this->session->set_flashdata('success', 'Profile Added Successfully.');
                redirect(base_url('admin/adminprofile/') . $admin_id);
            } else {
                $this->session->set_flashdata('danger', 'Profile Not Added.Please Try Again.');
                redirect(base_url('admin/admineditprofile/') . $admin_id);
            }
        }
    }
    ///////Report User List  Function created by Naincy 17/08/21/////
    public function post_report()
    {
        $data['report'] = $this->common->getData('report_user', array('type' => 0));
        $this->adminHtml('Post Report', 'reportusers-list', $data);
    }
    public function artist_report()
    {
        $data['report'] = $this->common->getData('report_artist', array());
        $this->adminHtml('Artist Report ', 'reportartist-list', $data);
    }
    public function block_report()
    {
        $data['report'] = $this->common->getData('report_user', array());
        $this->adminHtml('Block User List', 'blockusers-list', $data);
    }
    public function unblock_report_user()
    {
        $id = $this->uri->segment(3);
        $artist_report = $this->uri->segment(4);
        if (!empty($artist_report)) {
            $result = $this->common->deleteData('report_artist', array('id' => $artist_report));
        }
        $result = $this->common->deleteData('report_user', array('id' => $id));
        $this->session->set_flashdata('success', ' User UnBlocked.');
        redirect(base_url('admin/block_report'));
    }
    public function block_user()
    {
        $id = $this->uri->segment(3);
        $d = $this->common->updateData('report_user', array('type' => 1), array('id' => $id));
        $this->session->set_flashdata('error', ' User Blocked.');
        redirect(base_url('admin/post_report'));
    }
    public function block_artist()
    {
        $id = $this->uri->segment(3);
        $d = $this->common->getData('report_artist', array('id' => $id), array('single'));
        $arr = array("user_id" => $d['user_id'], "block_id" => $d['block_id'], "type" => 1, "artist_report" => $d['id']);
        $update = $this->common->updateData('report_artist', array('status' => 1), array('id' => $id));
        $insert = $this->common->insertData('report_user', $arr);
        redirect(base_url('admin/artist_report'));
    }
    public function graph_chart()
    {
        $data = array(
            'artist' => array(0 => 10, 1 => 100, 2 => 20, 3 => 0,),
            'users' => array(0 => '2021', 1 => '2021', 2 => '2021', 3 => '2021',),
            'favourite' => array(0 => 8, 1 => 20, 2 => 30, 3 => 0,),
        );
        echo json_encode($data, TRUE);
    }
    public function deleteRoles()
    {
        $id = $this->uri->segment(3);
        $data = $this->common->getData('permission_roles', array('role_id' => $id), array('single'));
        if ($data) {
            $result = $this->common->deleteData('permission_roles', array('role_id' => $id));
            $result1 = $this->common->deleteData('permission_role_map', array('role_id' => $id));
            if ($result) {
                $this->session->set_flashdata('success', 'Roles deleted successfully');
            } else {
                $this->session->set_flashdata('danger', 'Some Error occured.');
            }
            redirect(base_url('admin/roleList'), 'refresh');
        }
    }
    public function permission_denied()
    {
        $data = true;
        $this->adminHtml('Permission', 'permission_denied', $data);
    }

    public function addImages()
    {
        if (isset($_FILES['image'])) {
            $file_name = $image_name = $_FILES['image']['name'];
            $temp_file_location = $fileTempName = $_FILES['image']['tmp_name'];

            $data1 = $this->common->amazons3UploadBucket($image_name, $fileTempName, $bucket_name = 'glistener');

            print_r($data1);
            exit;

            require 'vendor/autoload.php';

            $s3 = new Aws\S3\S3Client([
                'region'  => 'us-east-1',
                'version' => 'latest',
                'credentials' => [
                    'key'    => "AKIAZKVM3XCOJZCRVDB5",
                    'secret' => "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",
                ]
            ]);

            $file_type = $_FILES['image']['type'];

            $result = $s3->putObject([
                'Bucket' => 'glistener',
                'Key'    => $file_name,
                'SourceFile' => $temp_file_location,
            ]);

            var_dump($result);
        } else {
            $data = true;
            $this->adminHtml('Permission', 's3-view', $data);
        }
    }


    // //Upload multiple songs 270423
    // public function uploadSongsNew_270423()
    // {
    //     $this->form_validation->set_rules('track', 'track', 'required');
    //     $this->form_validation->set_rules('label', 'label', 'required');
    //     // $this->form_validation->set_rules('cover_image', 'cover image', 'required');
    //     $this->form_validation->set_rules('zone_type', 'zone type', 'required');
    //     $this->form_validation->set_rules('release_year', 'release year', 'required');

    //     if ($this->form_validation->run() == false) {
    //         $data['artist'] = $this->common->getData('tbl_artists', array(), array());
    //         $data['genre'] = $this->common->getData('tbl_genre', array(), array());
    //         $data['album'] = $this->common->getData('tbl_albums', array(), array());
    //         $data['your_mood'] = $this->common->getData('tbl_your_mood', array(), array());
    //         $data['zone'] = $this->common->getData('tbl_music_zones_types', array(), array());
    //         $this->adminHtml('Upload Mix Songs', 'uploadsongs-list', $data);
    //     } else {
    //         if (isset($_FILES['chords'])) {
    //             $chordfile = fileuploadCI('chords', './assets/songs/');
    //             if (!empty($chordfile)) {
    //                 $chord_name = $chordfile;
    //             } else {
    //                 $chord_name = "";
    //             }
    //         }

    //         // // upload chords after compressed file -- code starts
    //         // if(isset($_FILES['chords'])) {
    //         //     $upload_path = './assets/songs/';
    //         //     $tmp_name = $_FILES['chords']['tmp_name'];
    //         //     $extension = pathinfo($_FILES['chords']['name'], PATHINFO_EXTENSION);
    //         //     $unique_name = uniqid() . '.' . $extension;
    //         //     $file_name = $upload_path . $unique_name;

    //         //     // Construct the FFmpeg command
    //         //     $ffmpeg_command = "ffmpeg -i \"$tmp_name\" -c:v libx264 -tune zerolatency -preset ultrafast -crf 40 -c:a aac -b:a 64k \"$file_name\"";
    //         //     // $ffmpeg_command = "ffmpeg -i \"$tmp_name\" -vcodec libx265 -crf 28 \"$file_name\"";
    //         //     // $ffmpeg_command = "ffmpeg -i \"$tmp_name\" -c:v libx265 -crf 28 -preset medium -c:a aac -b:a 128k \"$file_name\"";

    //         //     // Execute FFmpeg command
    //         //     exec($ffmpeg_command, $output, $return_code);
    //         //     // echo $unique_name;
    //         //     // Check if FFmpeg command executed successfully
    //         //     if ($return_code === 0) {
    //         //         $chord_name = $unique_name;
    //         //     } else {
    //         //         $chord_name = "";
    //         //     }
    //         // }

    //         // upload chords after compressed file -- code ends

    //         if (isset($_FILES['cover_image'])) {
    //             $image_name = fileuploadCI('cover_image', './assets/cover/');
    //             if (!empty($image_name)) {
    //                 $_POST['cover_image'] = $image_name;
    //             } else {
    //                 $_POST['cover_image'] = "";
    //             }
    //         }

    //         $song = array();
    //         $post11 = $this->common->getField('tbl_songs', $_POST);
    //         $result = $this->common->insertData('tbl_songs', $post11);
    //         if ($result) {
    //             $songs_id = $this->db->insert_id();
    //             // 12012024 notification section add //
    //             $userArray = $this->common->getData('tbl_users', array('fcm_token !=' => ''));
    //             $userIds = array();
    //             // Loop through the main array and extract IDs
    //             foreach ($userArray as $user) {
    //                 $userIds[] = $user['fcm_token'];
    //                 $notifydetail = array('receiver_id' => $user['id'], 'message' => 'Hey ' . $user['firstname'] . ', You got new song in your playlist. Start Mixing');
    //                 $result1 = $this->common->insertData('tbl_notification', $notifydetail);
    //             }
    //             // 12012024 notification section add //

    //             // multiple images inserted in 'song_images' table -- starts
    //             if ($songs_id != '') {
    //                 // chord_images saved in song_images' table
    //                 // if (isset($_FILES['chord_images']) && !empty($_FILES['chord_images']['name'][0])) {
    //                 //     $upload_path = './assets/songs/images/';

    //                 //     foreach ($_FILES['chord_images']['name'] as $index => $file_name) {
    //                 //         $tmp_name = $_FILES['chord_images']['tmp_name'][$index];
    //                 //         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                 //         $unique_name = uniqid() . '.' . $extension;

    //                 //         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                 //             $data = array(
    //                 //                 'song_id'       => $songs_id,
    //                 //                 'chords_songs'  => $unique_name,
    //                 //                 'created_at'    => date('Y-m-d H:i:s')
    //                 //             );

    //                 //             $this->db->insert('song_images', $data);
    //                 //         }
    //                 //     }
    //                 // }

    //                 // // vocal_images saved in song_images' table
    //                 // if (isset($_FILES['vocal_images']) && !empty($_FILES['vocal_images']['name'][0])) {
    //                 //     $upload_path = './assets/songs/images/';

    //                 //     foreach ($_FILES['vocal_images']['name'] as $index => $file_name) {
    //                 //         $tmp_name = $_FILES['vocal_images']['tmp_name'][$index];
    //                 //         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                 //         $unique_name = uniqid() . '.' . $extension;

    //                 //         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                 //             $data = array(
    //                 //                 'song_id'       => $songs_id,
    //                 //                 'vocals'        => $unique_name,
    //                 //                 'created_at'    => date('Y-m-d H:i:s')
    //                 //             );

    //                 //             $this->db->insert('song_images', $data);
    //                 //         }
    //                 //     }
    //                 // }

    //                 // // solo_images saved in song_images' table
    //                 // if (isset($_FILES['solo_images']) && !empty($_FILES['solo_images']['name'][0])) {
    //                 //     $upload_path = './assets/songs/images/';

    //                 //     foreach ($_FILES['solo_images']['name'] as $index => $file_name) {
    //                 //         $tmp_name = $_FILES['solo_images']['tmp_name'][$index];
    //                 //         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                 //         $unique_name = uniqid() . '.' . $extension;

    //                 //         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                 //             $data = array(
    //                 //                 'song_id'       => $songs_id,
    //                 //                 'solo'          => $unique_name,
    //                 //                 'created_at'    => date('Y-m-d H:i:s')
    //                 //             );

    //                 //             $this->db->insert('song_images', $data);
    //                 //         }
    //                 //     }
    //                 // }

    //                 // click_bpm_images saved in song_images' table
    //                 // if (isset($_FILES['click_bpm_images']) && !empty($_FILES['click_bpm_images']['name'][0])) {
    //                 //     $upload_path = './assets/songs/images/';

    //                 //     foreach ($_FILES['click_bpm_images']['name'] as $index => $file_name) {
    //                 //         $tmp_name = $_FILES['click_bpm_images']['tmp_name'][$index];
    //                 //         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                 //         $unique_name = uniqid() . '.' . $extension;

    //                 //         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                 //             $data = array(
    //                 //                 'song_id'       => $songs_id,
    //                 //                 'click_bpm'     => $unique_name,
    //                 //                 'created_at'    => date('Y-m-d H:i:s')
    //                 //             );

    //                 //             $this->db->insert('song_images', $data);
    //                 //         }
    //                 //     }
    //                 // }

    //                 // bass_images saved in song_images' table
    //                 if (isset($_FILES['bass_images']) && !empty($_FILES['bass_images']['name'][0])) {
    //                     $upload_path = './assets/songs/images/';

    //                     foreach ($_FILES['bass_images']['name'] as $index => $file_name) {
    //                         $tmp_name = $_FILES['bass_images']['tmp_name'][$index];
    //                         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                         $unique_name = uniqid() . '.' . $extension;

    //                         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                             $data = array(
    //                                 'song_id'       => $songs_id,
    //                                 'bass'          => $unique_name,
    //                                 'created_at'    => date('Y-m-d H:i:s')
    //                             );

    //                             $this->db->insert('song_images', $data);
    //                         }
    //                     }
    //                 }

    //                 // drum_images saved in song_images' table
    //                 if (isset($_FILES['drum_images']) && !empty($_FILES['drum_images']['name'][0])) {
    //                     $upload_path = './assets/songs/images/';

    //                     foreach ($_FILES['drum_images']['name'] as $index => $file_name) {
    //                         $tmp_name = $_FILES['drum_images']['tmp_name'][$index];
    //                         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                         $unique_name = uniqid() . '.' . $extension;

    //                         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                             $data = array(
    //                                 'song_id'       => $songs_id,
    //                                 'drums'         => $unique_name,
    //                                 'created_at'    => date('Y-m-d H:i:s')
    //                             );

    //                             $this->db->insert('song_images', $data);
    //                         }
    //                     }
    //                 }

    //                 // guitar_images saved in song_images' table
    //                 if (isset($_FILES['guitar_images']) && !empty($_FILES['guitar_images']['name'][0])) {
    //                     $upload_path = './assets/songs/images/';

    //                     foreach ($_FILES['guitar_images']['name'] as $index => $file_name) {
    //                         $tmp_name = $_FILES['guitar_images']['tmp_name'][$index];
    //                         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                         $unique_name = uniqid() . '.' . $extension;

    //                         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                             $data = array(
    //                                 'song_id'       => $songs_id,
    //                                 'guitar'        => $unique_name,
    //                                 'created_at'    => date('Y-m-d H:i:s')
    //                             );

    //                             $this->db->insert('song_images', $data);
    //                         }
    //                     }
    //                 }

    //                 // keyboard_images saved in song_images' table
    //                 if (isset($_FILES['keyboard_images']) && !empty($_FILES['keyboard_images']['name'][0])) {
    //                     $upload_path = './assets/songs/images/';

    //                     foreach ($_FILES['keyboard_images']['name'] as $index => $file_name) {
    //                         $tmp_name = $_FILES['keyboard_images']['tmp_name'][$index];
    //                         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                         $unique_name = uniqid() . '.' . $extension;

    //                         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                             $data = array(
    //                                 'song_id'       => $songs_id,
    //                                 'keyboards'     => $unique_name,
    //                                 'created_at'    => date('Y-m-d H:i:s')
    //                             );

    //                             $this->db->insert('song_images', $data);
    //                         }
    //                     }
    //                 }

    //                 // clap_images saved in song_images' table
    //                 // if (isset($_FILES['clap_images']) && !empty($_FILES['clap_images']['name'][0])) {
    //                 //     $upload_path = './assets/songs/images/';

    //                 //     foreach ($_FILES['clap_images']['name'] as $index => $file_name) {
    //                 //         $tmp_name = $_FILES['clap_images']['tmp_name'][$index];
    //                 //         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                 //         $unique_name = uniqid() . '.' . $extension;

    //                 //         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                 //             $data = array(
    //                 //                 'song_id'       => $songs_id,
    //                 //                 'claps'         => $unique_name,
    //                 //                 'created_at'    => date('Y-m-d H:i:s')
    //                 //             );

    //                 //             $this->db->insert('song_images', $data);
    //                 //         }
    //                 //     }
    //                 // }

    //             }
    //             // multiple images inserted in 'song_images' table -- ends

    //             if (!empty($_FILES['music_file']['name'][1])) {
    //                 $filesCount = count($_FILES['music_file']['name']);
    //                 $zone_type = $_POST['zone_type'];
    //                 $song = $this->multiple_files();
    //                 $allFiles = $song[1]['image_name'] . ',' . $song[2]['image_name'] . ',' . $song[3]['image_name'] . ',' . $song[4]['image_name'] . ',' . $song[5]['image_name'] . ',' . $song[6]['image_name'] . ',' . $song[7]['image_name'] . ',' . $song[8]['image_name'];
    //                 $keys =  explode(',', $allFiles);
    //                 $allFile_name = '';

    //                 foreach ($keys as $val) {
    //                     if (!empty($val)) {
    //                         $allFile_name .= ',' . $val;
    //                     }
    //                 }

    //                 if (!empty($song)) {
    //                     $result1 = $this->common->insertData('tbl_music_files', array(
    //                         'song_id' => $songs_id,
    //                         'chords_songs' => isset($chord_name) ? $chord_name : "",
    //                         'vocals' => isset($song[1]['image_name']) ? $song[1]['image_name'] : "",
    //                         'solo' => isset($song[2]['image_name']) ? $song[2]['image_name'] : "",
    //                         'click_bpm' => isset($song[3]['image_name']) ? $song[3]['image_name'] : "",
    //                         'bass' => isset($song[4]['image_name']) ? $song[4]['image_name'] : "",
    //                         'drums' =>  isset($song[5]['image_name']) ? $song[5]['image_name'] : "",
    //                         'guitar' =>  isset($song[6]['image_name']) ? $song[6]['image_name'] : "",
    //                         'keyboards' =>  isset($song[7]['image_name']) ? $song[7]['image_name'] : "",
    //                         'claps' =>  isset($song[8]['image_name']) ? $song[8]['image_name'] : "",
    //                         'all_file_names' => isset($allFile_name) ? substr($allFile_name, 1) : "",
    //                         'created_at' => date('Y-m-d h:i:s')
    //                     ));
    //                 }

    //                 $notifymessage = array('data' => $_POST['track'] . ' song is added in your play list');
    //                 $notifydone =  $this->send_notificationnew($userIds, $notifymessage);
    //                 // $this->session->set_flashdata('success', 'Upload data successfully');
    //                 $response['type'] = 'success';
    //                 $response['msg'] = 'Upload data successfully';
    //                 $response['notification'] = $notifydone;
    //                 $response['redirect'] = base_url('admin/songsList');
    //                 // 'http://44.197.223.72/admin/songsList' ;
    //                 echo json_encode($response, true);
    //             } else {
    //                 // $this->session->set_flashdata('error', 'Some Error occured.');
    //                 $response['type'] = 'error';
    //                 $response['msg'] = 'data not uploaded';
    //                 $response['notification'] = 'no data';
    //                 $response['redirect'] = base_url('admin/songsList');
    //                 echo json_encode($response, true);
    //             }
    //             // redirect(base_url('admin/songsList'), 'refresh');
    //         }
    //     }
    // }

    //Upload multiple songs method created by @Krishn on 24-04-24
    public function uploadSongsNew_current()
    {
        $this->form_validation->set_rules('track', 'track', 'required');
        $this->form_validation->set_rules('label', 'label', 'required');
        // $this->form_validation->set_rules('cover_image', 'cover image', 'required');
        $this->form_validation->set_rules('zone_type', 'zone type', 'required');
        $this->form_validation->set_rules('release_year', 'release year', 'required');

        if ($this->form_validation->run() == false) {
            $data['artist'] = $this->common->getData('tbl_artists', array(), array());
            $data['genre'] = $this->common->getData('tbl_genre', array(), array());
            $data['album'] = $this->common->getData('tbl_albums', array(), array());
            $data['your_mood'] = $this->common->getData('tbl_your_mood', array(), array());
            $data['zone'] = $this->common->getData('tbl_music_zones_types', array(), array());
            $this->adminHtml('Upload Mix Songs', 'uploadsongs-list', $data);
        } else {
            if (isset($_FILES['chords'])) {
                $chordfile = fileuploadCI('chords', './assets/songs/');
                if (!empty($chordfile)) {
                    $chord_name = $chordfile;
                } else {
                    $chord_name = "";
                }
            }

            if (isset($_FILES['master_song'])) {
                $masterSongFile = fileuploadCI('master_song', './assets/songs/');
                if (!empty($masterSongFile)) {
                    $masterSongFileName = $masterSongFile;
                } else {
                    $masterSongFileName = "";
                }
            }

            if (isset($_FILES['cover_image'])) {
                $image_name = fileuploadCI('cover_image', './assets/cover/');
                if (!empty($image_name)) {
                    $_POST['cover_image'] = $image_name;
                } else {
                    $_POST['cover_image'] = "";
                }
            }

            // pred($_FILES);

            $song = array();
            $post11 = $this->common->getField('tbl_songs', $_POST);
            $result = $this->common->insertData('tbl_songs', $post11);
            if ($result) {
                $songs_id = $this->db->insert_id();
                // 12012024 notification section add //
                $userArray = $this->common->getData('tbl_users', array('fcm_token !=' => ''));
                $userIds = array();
                // Loop through the main array and extract IDs
                foreach ($userArray as $user) {
                    $userIds[] = $user['fcm_token'];
                    $notifydetail = array('receiver_id' => $user['id'], 'message' => 'Hey ' . $user['firstname'] . ', You got new song in your playlist. Start Mixing');
                    $result1 = $this->common->insertData('tbl_notification', $notifydetail);
                }
                // 12012024 notification section add //

                // multiple images inserted in 'song_images' table -- starts
                if ($songs_id != '') {
                    // chords_songs saved in 'tbl_music_files' table
                    if (!empty($chord_name)) {
                        $data = array(
                            'song_id'       => $songs_id,
                            'chords_songs'  => $chord_name,
                            'created_at'    => date('Y-m-d H:i:s')
                        );

                        $this->db->insert('tbl_music_files', $data);
                    }

                    // master_song saved in 'tbl_music_files' table
                    if (!empty($masterSongFileName)) {
                        $data = array(
                            'song_id'       => $songs_id,
                            'master_song'  => $masterSongFileName,
                            'created_at'    => date('Y-m-d H:i:s')
                        );

                        $this->db->insert('tbl_music_files', $data);
                    }

                    // code for upload instrument files(images/videos)
                    $upload_path = './assets/songs/images/';

                    // Define fields
                    $fields = [
                        'bass' => 'bass_images',
                        'drums' => 'drum_images',
                        'guitar' => 'guitar_images',
                        'keyboards' => 'keyboard_images'
                    ];

                    // Handle new file uploads for each field
                    $insert_data = [];
                    foreach ($fields as $key => $field_name) {
                        $uploaded_files = []; // New array for each field

                        if (isset($_FILES[$field_name]['name']) && !empty($_FILES[$field_name]['name'][0])) {
                            foreach ($_FILES[$field_name]['name'] as $index => $file_name) {
                                $tmp_name = $_FILES[$field_name]['tmp_name'][$index];

                                // Clean and get file extension
                                $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'webm', 'mkv'];

                                if (in_array($extension, $allowed_extensions)) {
                                    $unique_name = uniqid() . '.' . $extension;

                                    if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
                                        $uploaded_files[] = $unique_name; // Add to uploaded files array
                                    }
                                }
                            }
                        }

                        // Prepare insert data
                        $insert_data[$key] = !empty($uploaded_files) ? implode(',', $uploaded_files) : '';
                    }

                    // Finally insert
                    $insert_data['song_id'] = $songs_id; // Add song_id
                    $this->db->insert('song_images', $insert_data);
                }
            }
            // multiple images inserted in 'song_images' table -- ends

            if (!empty($_FILES['music_file']['name'][1])) {
                $filesCount = count($_FILES['music_file']['name']);
                $zone_type = $_POST['zone_type'];
                $song = $this->multiple_files();
                $allFiles = $song[1]['image_name'] . ',' . $song[2]['image_name'] . ',' . $song[3]['image_name'] . ',' . $song[4]['image_name'] . ',' . $song[5]['image_name'] . ',' . $song[6]['image_name'] . ',' . $song[7]['image_name'] . ',' . $song[8]['image_name'] . ',' . $song[9]['image_name'] . ',' . $song[10]['image_name'] . ',' . $song[11]['image_name'] . ',' . $song[12]['image_name'];
                $keys =  explode(',', $allFiles);
                $allFile_name = '';

                foreach ($keys as $val) {
                    if (!empty($val)) {
                        $allFile_name .= ',' . $val;
                    }
                }

                if (!empty($song)) {
                    $this->db->where('song_id', $songs_id);
                    $existing_record = $this->db->get('tbl_music_files')->row_array();

                    if (!empty($existing_record)) {
                        // If a record exists, update it with the new values
                        $update_data = array(
                            'vocals' => isset($song[1]['image_name']) ? $song[1]['image_name'] : "",
                            'solo' => isset($song[2]['image_name']) ? $song[2]['image_name'] : "",
                            'click_bpm' => isset($song[3]['image_name']) ? $song[3]['image_name'] : "",
                            'bass' => isset($song[4]['image_name']) ? $song[4]['image_name'] : "",
                            'drums' => isset($song[5]['image_name']) ? $song[5]['image_name'] : "",
                            'guitar' => isset($song[6]['image_name']) ? $song[6]['image_name'] : "",
                            'keyboards' => isset($song[7]['image_name']) ? $song[7]['image_name'] : "",
                            'claps' => isset($song[8]['image_name']) ? $song[8]['image_name'] : "",
                            'backing_track_guitar' => isset($song[9]['image_name']) ? $song[9]['image_name'] : "",
                            'backing_track_bass' => isset($song[10]['image_name']) ? $song[10]['image_name'] : "",
                            'backing_track_drums' => isset($song[11]['image_name']) ? $song[11]['image_name'] : "",
                            'backing_track_keys' => isset($song[12]['image_name']) ? $song[12]['image_name'] : "",
                            'all_file_names' => isset($allFile_name) ? ltrim($allFile_name, ',') : ""
                        );

                        $this->db->where('song_id', $songs_id);
                        $this->db->update('tbl_music_files', $update_data);
                    } else {
                        // Insert new record if not exists
                        $insert_data = array(
                            'song_id' => $songs_id,
                            'chords_songs' => !empty($chord_name) ? $chord_name : "",
                            'vocals' => isset($song[1]['image_name']) ? $song[1]['image_name'] : "",
                            'solo' => isset($song[2]['image_name']) ? $song[2]['image_name'] : "",
                            'click_bpm' => isset($song[3]['image_name']) ? $song[3]['image_name'] : "",
                            'bass' => isset($song[4]['image_name']) ? $song[4]['image_name'] : "",
                            'drums' => isset($song[5]['image_name']) ? $song[5]['image_name'] : "",
                            'guitar' => isset($song[6]['image_name']) ? $song[6]['image_name'] : "",
                            'keyboards' => isset($song[7]['image_name']) ? $song[7]['image_name'] : "",
                            'claps' => isset($song[8]['image_name']) ? $song[8]['image_name'] : "",
                            'backing_track_guitar' => isset($song[9]['image_name']) ? $song[9]['image_name'] : "",
                            'backing_track_bass' => isset($song[10]['image_name']) ? $song[10]['image_name'] : "",
                            'backing_track_drums' => isset($song[11]['image_name']) ? $song[11]['image_name'] : "",
                            'backing_track_keys' => isset($song[12]['image_name']) ? $song[12]['image_name'] : "",
                            'all_file_names' => isset($allFile_name) ? ltrim($allFile_name, ',') : "",
                            'created_at' => date('Y-m-d H:i:s')
                        );

                        $this->common->insertData('tbl_music_files', $insert_data);
                    }

                    // $result1 = $this->common->insertData('tbl_music_files', array(
                    //     'song_id' => $songs_id,
                    //     'chords_songs' => !empty($chord_name) ? $chord_name : "",
                    //     'vocals' => isset($song[1]['image_name']) ? $song[1]['image_name'] : "",
                    //     'solo' => isset($song[2]['image_name']) ? $song[2]['image_name'] : "",
                    //     'click_bpm' => isset($song[3]['image_name']) ? $song[3]['image_name'] : "",
                    //     'bass' => isset($song[4]['image_name']) ? $song[4]['image_name'] : "",
                    //     'drums' =>  isset($song[5]['image_name']) ? $song[5]['image_name'] : "",
                    //     'guitar' =>  isset($song[6]['image_name']) ? $song[6]['image_name'] : "",
                    //     'keyboards' =>  isset($song[7]['image_name']) ? $song[7]['image_name'] : "",
                    //     'claps' =>  isset($song[8]['image_name']) ? $song[8]['image_name'] : "",
                    //     'back_track' =>  isset($song[9]['image_name']) ? $song[9]['image_name'] : "",
                    //     'all_file_names' => isset($allFile_name) ? substr($allFile_name, 1) : "",
                    //     'created_at' => date('Y-m-d h:i:s')
                    // ));
                }

                $notifymessage = array('data' => $_POST['track'] . ' song is added in your play list');
                $notifydone =  $this->send_notificationnew($userIds, $notifymessage);
                // $this->session->set_flashdata('success', 'Upload data successfully');
                $response['type'] = 'success';
                $response['msg'] = 'Upload data successfully';
                $response['notification'] = $notifydone;
                $response['redirect'] = base_url('admin/songsList');
                // 'http://44.197.223.72/admin/songsList' ;
                echo json_encode($response, true);
            } else {
                // $this->session->set_flashdata('error', 'Some Error occured.');
                $response['type'] = 'error';
                $response['msg'] = 'data not uploaded';
                $response['notification'] = 'no data';
                $response['redirect'] = base_url('admin/songsList');
                echo json_encode($response, true);
            }
            // redirect(base_url('admin/songsList'), 'refresh');
        }
    }

    public function uploadSongsNew()
    {
        $this->form_validation->set_rules('track', 'track', 'required');
        $this->form_validation->set_rules('label', 'label', 'required');
        $this->form_validation->set_rules('zone_type', 'zone type', 'required');
        $this->form_validation->set_rules('release_year', 'release year', 'required');

        if ($this->form_validation->run() == false) {
            $data['artist'] = $this->common->getData('tbl_artists', [], []);
            $data['genre'] = $this->common->getData('tbl_genre', [], []);
            $data['album'] = $this->common->getData('tbl_albums', [], []);
            $data['your_mood'] = $this->common->getData('tbl_your_mood', [], []);
            $data['zone'] = $this->common->getData('tbl_music_zones_types', [], []);
            $this->adminHtml('Upload Mix Songs', 'uploadsongs-list', $data);
            return;
        }

        // ========= FILE UPLOADS =========
        $chord_name = '';
        if (!empty($_FILES['chords']['name'])) {
            $chord_name = fileuploadCI('chords', './assets/songs/');
        }

        $masterSongFileName = '';
        if (!empty($_FILES['master_song']['name'])) {
            $masterSongFileName = fileuploadCI('master_song', './assets/songs/');
        }

        if (!empty($_FILES['cover_image']['name'])) {
            $_POST['cover_image'] = fileuploadCI('cover_image', './assets/cover/');
        }

        // ========= INSERT SONG =========
        $post11 = $this->common->getField('tbl_songs', $_POST);
        $result = $this->common->insertData('tbl_songs', $post11);

        if (!$result) {
            echo json_encode(['type' => 'error', 'msg' => 'Song not added']);
            return;
        }

        $songs_id = $this->db->insert_id();

        // ========= NOTIFICATIONS =========
        $userArray = $this->common->getData('tbl_users', ['fcm_token !=' => '']);
        $userIds = [];
        foreach ($userArray as $user) {
            $userIds[] = $user['fcm_token'];
            $this->common->insertData('tbl_notification', [
                'receiver_id' => $user['id'],
                'message' => 'Hey ' . $user['firstname'] . ', You got new song in your playlist. Start Mixing'
            ]);
        }

        // ========= ENSURE SINGLE ROW IN tbl_music_files =========
        $this->db->where('song_id', $songs_id);
        $musicRow = $this->db->get('tbl_music_files')->row_array();

        $baseData = [];
        if (!empty($chord_name)) $baseData['chords_songs'] = $chord_name;
        if (!empty($masterSongFileName)) $baseData['master_song'] = $masterSongFileName;

        if (!empty($baseData)) {
            if ($musicRow) {
                $this->db->where('song_id', $songs_id)->update('tbl_music_files', $baseData);
            } else {
                $baseData['song_id'] = $songs_id;
                $baseData['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('tbl_music_files', $baseData);
            }
        }

        // ========= SONG IMAGES =========
        $upload_path = './assets/songs/images/';
        $fields = [
            'bass' => 'bass_images',
            'drums' => 'drum_images',
            'guitar' => 'guitar_images',
            'keyboards' => 'keyboard_images'
        ];

        $insert_images = ['song_id' => $songs_id];

        foreach ($fields as $key => $field_name) {
            $uploaded = [];
            if (!empty($_FILES[$field_name]['name'][0])) {
                foreach ($_FILES[$field_name]['name'] as $i => $name) {
                    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'webm', 'mkv'])) {
                        $new = uniqid() . '.' . $ext;
                        if (move_uploaded_file($_FILES[$field_name]['tmp_name'][$i], $upload_path . $new)) {
                            $uploaded[] = $new;
                        }
                    }
                }
            }
            $insert_images[$key] = implode(',', $uploaded);
        }

        $this->db->insert('song_images', $insert_images);

        // ========= MULTIPLE FILES =========
        if (!empty($_FILES['music_file']['name'][1])) {

            $song = $this->multiple_files();
            $allFile_name = '';

            foreach ($song as $s) {
                if (!empty($s['image_name'])) {
                    $allFile_name .= ',' . $s['image_name'];
                }
            }

            $update_data = [];
            $map = [
                1 => 'vocals',
                2 => 'solo',
                3 => 'click_bpm',
                4 => 'bass',
                5 => 'drums',
                6 => 'guitar',
                7 => 'keyboards',
                8 => 'claps',
                9 => 'backing_track_guitar',
                10 => 'backing_track_bass',
                11 => 'backing_track_drums',
                12 => 'backing_track_keys'
            ];

            foreach ($map as $i => $col) {
                if (!empty($song[$i]['image_name'])) {
                    $update_data[$col] = $song[$i]['image_name'];
                }
            }

            if (!empty($allFile_name)) {
                $update_data['all_file_names'] = ltrim($allFile_name, ',');
            }

            $this->db->where('song_id', $songs_id)->update('tbl_music_files', $update_data);

            $notifydone = $this->send_notificationnew($userIds, [
                'data' => $_POST['track'] . ' song is added in your play list'
            ]);

            echo json_encode([
                'type' => 'success',
                'msg' => 'Upload data successfully',
                'notification' => $notifydone,
                'redirect' => base_url('admin/songsList')
            ]);
            return;
        }

        echo json_encode([
            'type' => 'error',
            'msg' => 'data not uploaded',
            'redirect' => base_url('admin/songsList')
        ]);
    }

    public function uploadSongsNew_070226()
    {
        $this->form_validation->set_rules('track', 'track', 'required');
        $this->form_validation->set_rules('label', 'label', 'required');
        $this->form_validation->set_rules('zone_type', 'zone type', 'required');
        $this->form_validation->set_rules('release_year', 'release year', 'required');

        if ($this->form_validation->run() == false) {
            $data['artist'] = $this->common->getData('tbl_artists');
            $data['genre'] = $this->common->getData('tbl_genre');
            $data['album'] = $this->common->getData('tbl_albums');
            $data['your_mood'] = $this->common->getData('tbl_your_mood');
            $data['zone'] = $this->common->getData('tbl_music_zones_types');
            $this->adminHtml('Upload Mix Songs', 'uploadsongs-list', $data);
            return;
        }

        $this->db->trans_start(); // 🔒 TRANSACTION START

        /* ================= FILE UPLOADS ================= */

        $chord_name = '';
        if (!empty($_FILES['chords']['name'])) {
            $chord_name = fileuploadCI('chords', './assets/songs/');
        }

        $masterSongFileName = '';
        if (!empty($_FILES['master_song']['name'])) {
            $masterSongFileName = fileuploadCI('master_song', './assets/songs/');
        }

        if (!empty($_FILES['cover_image']['name'])) {
            $_POST['cover_image'] = fileuploadCI('cover_image', './assets/cover/');
        }

        /* ================= INSERT SONG ================= */

        $songData = $this->common->getField('tbl_songs', $_POST);
        $this->common->insertData('tbl_songs', $songData);
        $songs_id = $this->db->insert_id();

        /* ================= BASE MUSIC FILE ROW (ONE TIME) ================= */

        $this->db->insert('tbl_music_files', [
            'song_id'       => $songs_id,
            'chords_songs'  => $chord_name,
            'master_song'  => $masterSongFileName,
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        /* ================= SONG IMAGES ================= */

        $upload_path = './assets/songs/images/';
        $fields = [
            'bass' => 'bass_images',
            'drums' => 'drum_images',
            'guitar' => 'guitar_images',
            'keyboards' => 'keyboard_images'
        ];

        $insert_images = ['song_id' => $songs_id];

        foreach ($fields as $key => $field_name) {
            $uploaded_files = [];

            if (!empty($_FILES[$field_name]['name'][0])) {
                foreach ($_FILES[$field_name]['name'] as $i => $name) {
                    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'webm', 'mkv'])) {
                        $newName = uniqid() . '.' . $ext;
                        move_uploaded_file($_FILES[$field_name]['tmp_name'][$i], $upload_path . $newName);
                        $uploaded_files[] = $newName;
                    }
                }
            }
            $insert_images[$key] = implode(',', $uploaded_files);
        }

        $this->db->insert('song_images', $insert_images);

        /* ================= MULTIPLE MUSIC FILES ================= */

        if (!empty($_FILES['music_file']['name'])) {

            $song = $this->multiple_files();
            $existing = $this->db->get_where('tbl_music_files', ['song_id' => $songs_id])->row_array();

            $allFiles = [];
            for ($i = 1; $i <= 12; $i++) {
                if (!empty($song[$i]['image_name'])) {
                    $allFiles[] = $song[$i]['image_name'];
                }
            }

            $update_data = [
                'vocals' => $song[1]['image_name'] ?? '',
                'solo' => $song[2]['image_name'] ?? '',
                'click_bpm' => $song[3]['image_name'] ?? '',
                'bass' => $song[4]['image_name'] ?? '',
                'drums' => $song[5]['image_name'] ?? '',
                'guitar' => $song[6]['image_name'] ?? '',
                'keyboards' => $song[7]['image_name'] ?? '',
                'claps' => $song[8]['image_name'] ?? '',
                'backing_track_guitar' => $song[9]['image_name'] ?? '',
                'backing_track_bass' => $song[10]['image_name'] ?? '',
                'backing_track_drums' => $song[11]['image_name'] ?? '',
                'backing_track_keys' => $song[12]['image_name'] ?? '',
                'all_file_names' => implode(',', $allFiles),

                // 🔐 PRESERVE MASTER SONG
                'master_song' => $existing['master_song']
            ];

            $this->db->where('song_id', $songs_id)->update('tbl_music_files', $update_data);
        }

        /* ================= NOTIFICATIONS ================= */

        $users = $this->common->getData('tbl_users', ['fcm_token !=' => '']);
        $userIds = [];

        foreach ($users as $u) {
            $userIds[] = $u['fcm_token'];
            $this->common->insertData('tbl_notification', [
                'receiver_id' => $u['id'],
                'message' => 'Hey ' . $u['firstname'] . ', You got new song in your playlist. Start Mixing'
            ]);
        }

        $this->db->trans_complete(); // 🔓 TRANSACTION END

        /* ================= RESPONSE ================= */

        echo json_encode([
            'type' => 'success',
            'msg' => 'Upload data successfully',
            'redirect' => base_url('admin/songsList')
        ]);
    }

    public function uploadSongsNew111225()
    {
        $this->form_validation->set_rules('track', 'track', 'required');
        $this->form_validation->set_rules('label', 'label', 'required');
        // $this->form_validation->set_rules('cover_image', 'cover image', 'required');
        $this->form_validation->set_rules('zone_type', 'zone type', 'required');
        $this->form_validation->set_rules('release_year', 'release year', 'required');

        if ($this->form_validation->run() == false) {
            $data['artist'] = $this->common->getData('tbl_artists', array(), array());
            $data['genre'] = $this->common->getData('tbl_genre', array(), array());
            $data['album'] = $this->common->getData('tbl_albums', array(), array());
            $data['your_mood'] = $this->common->getData('tbl_your_mood', array(), array());
            $data['zone'] = $this->common->getData('tbl_music_zones_types', array(), array());
            $this->adminHtml('Upload Mix Songs', 'uploadsongs-list', $data);
        } else {
            if (isset($_FILES['chords'])) {
                $chordfile = fileuploadCI('chords', './assets/songs/');
                if (!empty($chordfile)) {
                    $chord_name = $chordfile;
                } else {
                    $chord_name = "";
                }
            }

            if (isset($_FILES['cover_image'])) {
                $image_name = fileuploadCI('cover_image', './assets/cover/');
                if (!empty($image_name)) {
                    $_POST['cover_image'] = $image_name;
                } else {
                    $_POST['cover_image'] = "";
                }
            }

            // pred($_FILES);

            $song = array();
            $post11 = $this->common->getField('tbl_songs', $_POST);
            $result = $this->common->insertData('tbl_songs', $post11);
            if ($result) {
                $songs_id = $this->db->insert_id();
                // 12012024 notification section add //
                $userArray = $this->common->getData('tbl_users', array('fcm_token !=' => ''));
                $userIds = array();
                // Loop through the main array and extract IDs
                foreach ($userArray as $user) {
                    $userIds[] = $user['fcm_token'];
                    $notifydetail = array('receiver_id' => $user['id'], 'message' => 'Hey ' . $user['firstname'] . ', You got new song in your playlist. Start Mixing');
                    $result1 = $this->common->insertData('tbl_notification', $notifydetail);
                }
                // 12012024 notification section add //

                // multiple images inserted in 'song_images' table -- starts
                if ($songs_id != '') {
                    // chords_songs saved in 'tbl_music_files' table
                    if (!empty($chord_name)) {
                        $data = array(
                            'song_id'       => $songs_id,
                            'chords_songs'  => $chord_name,
                            'created_at'    => date('Y-m-d H:i:s')
                        );

                        $this->db->insert('tbl_music_files', $data);
                    }

                    // code for upload instrument files(images/videos)
                    $upload_path = './assets/songs/images/';

                    // Define fields
                    $fields = [
                        'bass' => 'bass_images',
                        'drums' => 'drum_images',
                        'guitar' => 'guitar_images',
                        'keyboards' => 'keyboard_images'
                    ];

                    // Handle new file uploads for each field
                    $insert_data = [];
                    foreach ($fields as $key => $field_name) {
                        $uploaded_files = []; // New array for each field

                        if (isset($_FILES[$field_name]['name']) && !empty($_FILES[$field_name]['name'][0])) {
                            foreach ($_FILES[$field_name]['name'] as $index => $file_name) {
                                $tmp_name = $_FILES[$field_name]['tmp_name'][$index];

                                // Clean and get file extension
                                $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'webm', 'mkv'];

                                if (in_array($extension, $allowed_extensions)) {
                                    $unique_name = uniqid() . '.' . $extension;

                                    if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
                                        $uploaded_files[] = $unique_name; // Add to uploaded files array
                                    }
                                }
                            }
                        }

                        // Prepare insert data
                        $insert_data[$key] = !empty($uploaded_files) ? implode(',', $uploaded_files) : '';
                    }

                    // Finally insert
                    $insert_data['song_id'] = $songs_id; // Add song_id
                    $this->db->insert('song_images', $insert_data);
                }
            }
            // multiple images inserted in 'song_images' table -- ends

            if (!empty($_FILES['music_file']['name'][1])) {
                $filesCount = count($_FILES['music_file']['name']);
                $zone_type = $_POST['zone_type'];
                $song = $this->multiple_files();
                $allFiles = $song[1]['image_name'] . ',' . $song[2]['image_name'] . ',' . $song[3]['image_name'] . ',' . $song[4]['image_name'] . ',' . $song[5]['image_name'] . ',' . $song[6]['image_name'] . ',' . $song[7]['image_name'] . ',' . $song[8]['image_name'];
                $keys =  explode(',', $allFiles);
                $allFile_name = '';

                foreach ($keys as $val) {
                    if (!empty($val)) {
                        $allFile_name .= ',' . $val;
                    }
                }

                if (!empty($song)) {
                    $this->db->where('song_id', $songs_id);
                    $existing_record = $this->db->get('tbl_music_files')->row_array();

                    if (!empty($existing_record)) {
                        // If a record exists, update it with the new values
                        $update_data = array(
                            'vocals' => isset($song[1]['image_name']) ? $song[1]['image_name'] : "",
                            'solo' => isset($song[2]['image_name']) ? $song[2]['image_name'] : "",
                            'click_bpm' => isset($song[3]['image_name']) ? $song[3]['image_name'] : "",
                            'bass' => isset($song[4]['image_name']) ? $song[4]['image_name'] : "",
                            'drums' => isset($song[5]['image_name']) ? $song[5]['image_name'] : "",
                            'guitar' => isset($song[6]['image_name']) ? $song[6]['image_name'] : "",
                            'keyboards' => isset($song[7]['image_name']) ? $song[7]['image_name'] : "",
                            'claps' => isset($song[8]['image_name']) ? $song[8]['image_name'] : "",
                            // 'back_track' => isset($song[9]['image_name']) ? $song[9]['image_name'] : "",
                            'all_file_names' => isset($allFile_name) ? ltrim($allFile_name, ',') : ""
                        );

                        $this->db->where('song_id', $songs_id);
                        $this->db->update('tbl_music_files', $update_data);
                    } else {
                        // Insert new record if not exists
                        $insert_data = array(
                            'song_id' => $songs_id,
                            'chords_songs' => !empty($chord_name) ? $chord_name : "",
                            'vocals' => isset($song[1]['image_name']) ? $song[1]['image_name'] : "",
                            'solo' => isset($song[2]['image_name']) ? $song[2]['image_name'] : "",
                            'click_bpm' => isset($song[3]['image_name']) ? $song[3]['image_name'] : "",
                            'bass' => isset($song[4]['image_name']) ? $song[4]['image_name'] : "",
                            'drums' => isset($song[5]['image_name']) ? $song[5]['image_name'] : "",
                            'guitar' => isset($song[6]['image_name']) ? $song[6]['image_name'] : "",
                            'keyboards' => isset($song[7]['image_name']) ? $song[7]['image_name'] : "",
                            'claps' => isset($song[8]['image_name']) ? $song[8]['image_name'] : "",
                            // 'back_track' => isset($song[9]['image_name']) ? $song[9]['image_name'] : "",
                            'all_file_names' => isset($allFile_name) ? ltrim($allFile_name, ',') : "",
                            'created_at' => date('Y-m-d H:i:s')
                        );

                        $this->common->insertData('tbl_music_files', $insert_data);
                    }

                    // $result1 = $this->common->insertData('tbl_music_files', array(
                    //     'song_id' => $songs_id,
                    //     'chords_songs' => !empty($chord_name) ? $chord_name : "",
                    //     'vocals' => isset($song[1]['image_name']) ? $song[1]['image_name'] : "",
                    //     'solo' => isset($song[2]['image_name']) ? $song[2]['image_name'] : "",
                    //     'click_bpm' => isset($song[3]['image_name']) ? $song[3]['image_name'] : "",
                    //     'bass' => isset($song[4]['image_name']) ? $song[4]['image_name'] : "",
                    //     'drums' =>  isset($song[5]['image_name']) ? $song[5]['image_name'] : "",
                    //     'guitar' =>  isset($song[6]['image_name']) ? $song[6]['image_name'] : "",
                    //     'keyboards' =>  isset($song[7]['image_name']) ? $song[7]['image_name'] : "",
                    //     'claps' =>  isset($song[8]['image_name']) ? $song[8]['image_name'] : "",
                    //     'back_track' =>  isset($song[9]['image_name']) ? $song[9]['image_name'] : "",
                    //     'all_file_names' => isset($allFile_name) ? substr($allFile_name, 1) : "",
                    //     'created_at' => date('Y-m-d h:i:s')
                    // ));
                }

                $notifymessage = array('data' => $_POST['track'] . ' song is added in your play list');
                $notifydone =  $this->send_notificationnew($userIds, $notifymessage);
                // $this->session->set_flashdata('success', 'Upload data successfully');
                $response['type'] = 'success';
                $response['msg'] = 'Upload data successfully';
                $response['notification'] = $notifydone;
                $response['redirect'] = base_url('admin/songsList');
                // 'http://44.197.223.72/admin/songsList' ;
                echo json_encode($response, true);
            } else {
                // $this->session->set_flashdata('error', 'Some Error occured.');
                $response['type'] = 'error';
                $response['msg'] = 'data not uploaded';
                $response['notification'] = 'no data';
                $response['redirect'] = base_url('admin/songsList');
                echo json_encode($response, true);
            }
            // redirect(base_url('admin/songsList'), 'refresh');
        }
    }

    //updated by @krishn on 06-02-26
    public function editUploadSongs()
    {
        $songs_id = $this->uri->segment(3);

        $data['songs'] = $this->common->getData('tbl_songs', array('id' => $songs_id), array('single'));
        $data['file'] = $this->common->getData('tbl_music_files', array('song_id' => $songs_id), array('single'));

        // Start the code for getting song images
        $instrument_images = $this->common->getData('song_images', array('song_id' => $songs_id), array());

        $song_images = [
            'bass' => [],
            'drums' => [],
            'guitar' => [],
            'keyboards' => [],
        ];

        foreach ($instrument_images as $image) {
            // Split CSV values into arrays
            if (!empty($image['bass'])) {
                $song_images['bass'] = array_merge($song_images['bass'], explode(',', $image['bass']));
            }
            if (!empty($image['drums'])) {
                $song_images['drums'] = array_merge($song_images['drums'], explode(',', $image['drums']));
            }
            if (!empty($image['guitar'])) {
                $song_images['guitar'] = array_merge($song_images['guitar'], explode(',', $image['guitar']));
            }
            if (!empty($image['keyboards'])) {
                $song_images['keyboards'] = array_merge($song_images['keyboards'], explode(',', $image['keyboards']));
            }
        }

        $data['song_images_grouped'] = $song_images;
        // End the code for getting song images

        $data['artist'] = $this->common->getData('tbl_artists', array(), array());
        $data['instrument'] = $this->common->getData('tbl_instruments', array(), array());
        $data['genre'] = $this->common->getData('tbl_genre', array(), array());
        $data['album'] = $this->common->getData('tbl_albums', array(), array());
        $data['your_mood'] = $this->common->getData('tbl_your_mood', array(), array());
        $data['zone'] = $this->common->getData('tbl_music_zones_types', array(), array());
        $this->form_validation->set_rules('track', 'track', 'required');
        $this->form_validation->set_rules('label', 'label', 'required');
        $this->form_validation->set_rules('zone_type', 'zone type', 'required');
        $this->form_validation->set_rules('release_year', 'release year', 'required');
        if ($this->form_validation->run() == false) {
            $this->adminHtml('Edit Your Mix Songs', 'editUploadSongs', $data);
        } else {
            unset($_POST["submit"]);
            $id = $this->input->post('song_id');
            unset($_POST["song_id"]);

            // pred($_POST);
            $deleteFiles = array();
            $deleteFiles['bass'] = $_POST["deleted_bass_files"];
            unset($_POST["deleted_bass_files"]);
            $deleteFiles['drums'] = $_POST["deleted_drums_files"];
            unset($_POST["deleted_drums_files"]);
            $deleteFiles['guitar'] = $_POST["deleted_guitar_files"];
            unset($_POST["deleted_guitar_files"]);
            $deleteFiles['keyboards'] = $_POST["deleted_keyboards_files"];
            unset($_POST["deleted_keyboards_files"]);
            $data['songs'] = $this->common->getData('tbl_songs', array('id' => $id), array('single'));


            if (!empty($_FILES['cover_image']['name'])) {
                $image_name = fileuploadCI('cover_image', './assets/cover/');

                if (!empty($image_name)) {
                    $_POST['cover_image'] = $image_name;
                } else {
                    $_POST['cover_image'] = "";
                }
            } else {
                $_POST['cover_image'] = $data['songs']['cover_image'];
            }

            $song = array();
            $data  = array();
            $result = $this->common->updateData('tbl_songs', $_POST, array('id' => $id));
            $songs_id = $id;
            if ($result) {
                $upload_path = './assets/songs/';
                $data['file'] = $this->common->getData('tbl_music_files', array('song_id' => $songs_id), array('single'));

                $song = $this->multiple_files();

                // multiple images inserted in 'song_images' table -- starts
                if ($songs_id != '') {
                    // Get existing row once
                    $existing = $this->db
                        ->get_where('tbl_music_files', ['song_id' => $songs_id])
                        ->row();

                    $updateData = [];
                    $insertData = ['song_id' => $songs_id];

                    // =======================
                    // CHORDS FILE
                    // =======================
                    if (isset($_FILES['chords']) && !empty($_FILES['chords']['name'])) {

                        $chordsFile = fileuploadCI('chords', $upload_path);

                        if (!empty($chordsFile)) {

                            // Delete old chords file (only if updating)
                            if ($existing && !empty($existing->chords_songs)) {
                                $old_file = $upload_path . $existing->chords_songs;
                                if (file_exists($old_file)) {
                                    unlink($old_file);
                                }
                            }

                            $updateData['chords_songs'] = $chordsFile;
                            $insertData['chords_songs'] = $chordsFile;
                        }
                    }

                    // =======================
                    // MASTER SONG FILE
                    // =======================
                    if (isset($_FILES['master_song']) && !empty($_FILES['master_song']['name'])) {

                        $masterSong = fileuploadCI('master_song', $upload_path);

                        if (!empty($masterSong)) {

                            // Delete old master song (only if updating)
                            if ($existing && !empty($existing->master_song)) {
                                $old_file = $upload_path . $existing->master_song;
                                if (file_exists($old_file)) {
                                    unlink($old_file);
                                }
                            }

                            $updateData['master_song'] = $masterSong;
                            $insertData['master_song'] = $masterSong;
                        }
                    }

                    // =======================
                    // INSERT OR UPDATE
                    // =======================
                    if (!empty($updateData)) {

                        if ($existing) {
                            // UPDATE only provided fields
                            $this->db->where('song_id', $songs_id);
                            $this->db->update('tbl_music_files', $updateData);
                        } else {
                            // INSERT new row
                            $this->db->insert('tbl_music_files', $insertData);
                        }
                    }

                    // code for upload instrument files(images/videos)
                    $upload_path = './assets/songs/images/';

                    // Define fields
                    $fields = [
                        'bass' => 'bass_images',
                        'drums' => 'drum_images',
                        'guitar' => 'guitar_images',
                        'keyboards' => 'keyboard_images'
                    ];

                    // Fetch old images from `song_images` table
                    $song_images = $this->db->where('song_id', $songs_id)->get('song_images')->row();

                    // Initialize old_files array
                    $old_files = [];
                    foreach ($fields as $key => $field_name) {
                        $old_files[$key] = !empty($song_images->$key) ? explode(',', $song_images->$key) : [];
                    }

                    // Handle file removal separately for each field
                    foreach ($fields as $key => $field_name) {
                        if (!empty($deleteFiles[$key])) {
                            $deleted_files = is_array($deleteFiles[$key]) ? $deleteFiles[$key] : explode(',', $deleteFiles[$key]);

                            foreach ($deleted_files as $remove_filename) {
                                $remove_filename = trim($remove_filename);
                                if (!empty($remove_filename)) {
                                    $file_path = $upload_path . $remove_filename;

                                    if (file_exists($file_path)) {
                                        unlink($file_path); // delete from folder
                                    }

                                    // remove from old_files list
                                    if (($file_key = array_search($remove_filename, $old_files[$key])) !== false) {
                                        unset($old_files[$key][$file_key]);
                                    }
                                }
                            }

                            // reset index
                            $old_files[$key] = array_values($old_files[$key]);
                        }
                    }

                    // Handle new file uploads for each field
                    foreach ($fields as $key => $field_name) {
                        if (isset($_FILES[$field_name]['name']) && !empty($_FILES[$field_name]['name'][0])) {
                            foreach ($_FILES[$field_name]['name'] as $index => $file_name) {
                                $tmp_name = $_FILES[$field_name]['tmp_name'][$index];
                                $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'webm', 'mkv'];

                                if (in_array($extension, $allowed_extensions)) {
                                    $unique_name = uniqid() . '.' . $extension;
                                    if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
                                        $old_files[$key][] = $unique_name;
                                    }
                                }
                            }
                        }
                    }

                    // Prepare update data
                    // pred($old_files);
                    $update_data = [];
                    foreach ($fields as $key => $field_name) {
                        if (!empty($old_files[$key])) {
                            $update_data[$key] = implode(',', $old_files[$key]);
                        } else {
                            $update_data[$key] = null; // set to NULL if empty
                        }
                    }

                    // Update database
                    $this->db->where('song_id', $songs_id)->update('song_images', $update_data);
                }

                $result1 = $this->common->updateData(
                    'tbl_music_files',
                    array(
                        'vocals' => isset($song[1]['image_name']) ? $song[1]['image_name']  : $data['file']['vocals'],
                        'solo' => isset($song[2]['image_name']) ? $song[2]['image_name'] : $data['file']['solo'],
                        'click_bpm' => isset($song[3]['image_name']) ? $song[3]['image_name'] : $data['file']['click_bpm'],
                        'bass' => isset($song[4]['image_name']) ? $song[4]['image_name'] : $data['file']['bass'],
                        'drums' =>  isset($song[5]['image_name']) ? $song[5]['image_name'] : $data['file']['drums'],
                        'guitar' =>  isset($song[6]['image_name']) ? $song[6]['image_name'] : $data['file']['guitar'],
                        'keyboards' =>  isset($song[7]['image_name']) ? $song[7]['image_name'] : $data['file']['keyboards'],
                        'claps' =>  isset($song[8]['image_name']) ? $song[8]['image_name'] : $data['file']['claps'],
                        'backing_track_guitar' =>  isset($song[9]['image_name']) ? $song[9]['image_name'] : $data['file']['backing_track_guitar'],
                        'backing_track_bass' =>  isset($song[10]['image_name']) ? $song[10]['image_name'] : $data['file']['backing_track_bass'],
                        'backing_track_drums' =>  isset($song[11]['image_name']) ? $song[11]['image_name'] : $data['file']['backing_track_drums'],
                        'backing_track_keys' =>  isset($song[12]['image_name']) ? $song[12]['image_name'] : $data['file']['backing_track_keys']
                    ),
                    array('song_id' => $songs_id)
                );

                if ($result1) {
                    $response['type'] = 'success';
                    $response['msg'] = 'Upload data successfully';
                    $response['redirect'] = base_url('admin/songsList');
                    echo json_encode($response, true);
                } else {
                    $response['type'] = 'error';
                    $response['msg'] = 'data not uploaded';
                    $response['redirect'] = base_url('admin/songsList');
                    echo json_encode($response, true);
                }
            }
        }
    }
    // end code for update music files written by @krishn on 06-02-26 

    // public function editUploadSongs()
    // {
    //     $songs_id = $this->uri->segment(3);

    //     $data['songs'] = $this->common->getData('tbl_songs', array('id' => $songs_id), array('single'));
    //     $data['file'] = $this->common->getData('tbl_music_files', array('song_id' => $songs_id), array('single'));

    //     // start the code for get song images
    //     $instrument_images = $this->common->getData('song_images', array('song_id' => $songs_id), array());

    //     $song_images = [
    //         'bass' => [],
    //         'drums' => [],
    //         'guitar' => [],
    //         'keyboards' => [],
    //     ];

    //     foreach ($instrument_images as $image) {
    //         if (!empty($image['bass'])) {
    //             $song_images['bass'][] = $image['bass'];
    //         }
    //         if (!empty($image['drums'])) {
    //             $song_images['drums'][] = $image['drums'];
    //         }
    //         if (!empty($image['guitar'])) {
    //             $song_images['guitar'][] = $image['guitar'];
    //         }
    //         if (!empty($image['keyboards'])) {
    //             $song_images['keyboards'][] = $image['keyboards'];
    //         }
    //     }

    //     $data['song_images_grouped'] = $song_images;

    //     // end the code for get song images
    //     $data['artist'] = $this->common->getData('tbl_artists', array(), array());
    //     $data['instrument'] = $this->common->getData('tbl_instruments', array(), array());
    //     $data['genre'] = $this->common->getData('tbl_genre', array(), array());
    //     $data['album'] = $this->common->getData('tbl_albums', array(), array());
    //     $data['your_mood'] = $this->common->getData('tbl_your_mood', array(), array());
    //     $data['zone'] = $this->common->getData('tbl_music_zones_types', array(), array());
    //     $this->form_validation->set_rules('track', 'track', 'required');
    //     $this->form_validation->set_rules('label', 'label', 'required');
    //     $this->form_validation->set_rules('zone_type', 'zone type', 'required');
    //     $this->form_validation->set_rules('release_year', 'release year', 'required');
    //     if ($this->form_validation->run() == false) {
    //         $this->adminHtml('Edit Your Mix Songs', 'editUploadSongs', $data);
    //     } else {
    //         unset($_POST["submit"]);
    //         $id = $this->input->post('song_id');
    //         unset($_POST["song_id"]);
    //         $data['songs'] = $this->common->getData('tbl_songs', array('id' => $id), array('single'));


    //         if (!empty($_FILES['cover_image']['name'])) {
    //             $image_name = fileuploadCI('cover_image', './assets/cover/');

    //             if (!empty($image_name)) {
    //                 $_POST['cover_image'] = $image_name;
    //             } else {
    //                 $_POST['cover_image'] = "";
    //             }
    //         } else {
    //             $_POST['cover_image'] = $data['songs']['cover_image'];
    //         }

    //         $song = array();
    //         $data  = array();
    //         $result = $this->common->updateData('tbl_songs', $_POST, array('id' => $id));
    //         $songs_id = $id;
    //         if ($result) {
    //             $data['file'] = $this->common->getData('tbl_music_files', array('song_id' => $songs_id), array('single'));

    //             if (isset($_FILES['chords']) && !empty($_FILES['chords']['name'])) {
    //                 $upload_path = './assets/songs/';
    //                 $file_name = $_FILES['chords']['name'];
    //                 $tmp_name = $_FILES['chords']['tmp_name'];
    //                 $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                 $unique_name = uniqid('chords_') . '.' . $extension;

    //                 // Check if file already exists for this song
    //                 $existing = $this->db->get_where('tbl_music_files', ['song_id' => $songs_id])->row();

    //                 // Delete the old file if it exists
    //                 if ($existing && !empty($existing->chords_songs)) {
    //                     $old_file_path = $upload_path . $existing->chords_songs;
    //                     if (file_exists($old_file_path)) {
    //                         unlink($old_file_path);
    //                     }
    //                 }

    //                 // Move the new file
    //                 if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                     $data = [
    //                         'song_id'      => $songs_id,
    //                         'chords_songs' => $unique_name,
    //                         'created_at'   => date('Y-m-d H:i:s')
    //                     ];

    //                     if ($existing) {
    //                         // Update existing record
    //                         $this->db->where('song_id', $songs_id);
    //                         $this->db->update('tbl_music_files', $data);
    //                     } else {
    //                         // Insert new record
    //                         $this->db->insert('tbl_music_files', $data);
    //                     }
    //                 }
    //             }

    //             // if (!empty($_FILES['chords']['name'])) {
    //             //     $chordfile = fileuploadCI('chords', './assets/songs/');
    //             //     if (!empty($chordfile)) {
    //             //         $chord_name = $chordfile;
    //             //     } else {
    //             //         $chord_name = "";
    //             //     }
    //             // }

    //             // upload chords after compressed file -- code starts
    //             // if (isset($_FILES['chords'])) {
    //             //     $upload_path = './assets/songs/';
    //             //     $tmp_name = $_FILES['chords']['tmp_name'];
    //             //     $extension = pathinfo($_FILES['chords']['name'], PATHINFO_EXTENSION);
    //             //     $unique_name = uniqid() . '.' . $extension;
    //             //     $file_name = $upload_path . $unique_name;

    //             //     // Construct the FFmpeg command
    //             //     $ffmpeg_command = "ffmpeg -i \"$tmp_name\" -c:v libx264 -tune zerolatency -preset ultrafast -crf 40 -c:a aac -b:a 64k \"$file_name\"";
    //             //     // $ffmpeg_command = "ffmpeg -i \"$tmp_name\" -vcodec libx265 -crf 28 \"$file_name\"";
    //             //     // $ffmpeg_command = "ffmpeg -i \"$tmp_name\" -c:v libx265 -crf 28 -preset medium -c:a aac -b:a 128k \"$file_name\"";

    //             //     // Execute FFmpeg command
    //             //     exec($ffmpeg_command, $output, $return_code);
    //             //     // echo $unique_name;
    //             //     // Check if FFmpeg command executed successfully
    //             //     if ($return_code === 0) {
    //             //         $chord_name = $unique_name;
    //             //     } else {
    //             //         $chord_name = "";
    //             //     }
    //             // }


    //             $song = $this->multiple_files();

    //             // multiple images inserted in 'song_images' table -- starts
    //             if ($songs_id != '') {
    //                 // bass_images saved in song_images' table
    //                 if (isset($_FILES['bass_images']) && !empty($_FILES['bass_images']['name'][0])) {
    //                     $upload_path = './assets/songs/images/';

    //                     foreach ($_FILES['bass_images']['name'] as $index => $file_name) {
    //                         $tmp_name = $_FILES['bass_images']['tmp_name'][$index];
    //                         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                         $unique_name = uniqid() . '.' . $extension;

    //                         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                             $data = array(
    //                                 'song_id'       => $songs_id,
    //                                 'bass'          => $unique_name,
    //                                 'created_at'    => date('Y-m-d H:i:s')
    //                             );

    //                             $this->db->insert('song_images', $data);
    //                         }
    //                     }
    //                 }

    //                 // drum_images saved in song_images' table
    //                 if (isset($_FILES['drum_images']) && !empty($_FILES['drum_images']['name'][0])) {
    //                     $upload_path = './assets/songs/images/';

    //                     foreach ($_FILES['drum_images']['name'] as $index => $file_name) {
    //                         $tmp_name = $_FILES['drum_images']['tmp_name'][$index];
    //                         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                         $unique_name = uniqid() . '.' . $extension;

    //                         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                             $data = array(
    //                                 'song_id'       => $songs_id,
    //                                 'drums'         => $unique_name,
    //                                 'created_at'    => date('Y-m-d H:i:s')
    //                             );

    //                             $this->db->insert('song_images', $data);
    //                         }
    //                     }
    //                 }

    //                 // guitar_images saved in song_images' table
    //                 if (isset($_FILES['guitar_images']) && !empty($_FILES['guitar_images']['name'][0])) {
    //                     $upload_path = './assets/songs/images/';

    //                     foreach ($_FILES['guitar_images']['name'] as $index => $file_name) {
    //                         $tmp_name = $_FILES['guitar_images']['tmp_name'][$index];
    //                         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                         $unique_name = uniqid() . '.' . $extension;

    //                         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                             $data = array(
    //                                 'song_id'       => $songs_id,
    //                                 'guitar'        => $unique_name,
    //                                 'created_at'    => date('Y-m-d H:i:s')
    //                             );

    //                             $this->db->insert('song_images', $data);
    //                         }
    //                     }
    //                 }

    //                 // keyboard_images saved in song_images' table
    //                 if (isset($_FILES['keyboard_images']) && !empty($_FILES['keyboard_images']['name'][0])) {
    //                     $upload_path = './assets/songs/images/';

    //                     foreach ($_FILES['keyboard_images']['name'] as $index => $file_name) {
    //                         $tmp_name = $_FILES['keyboard_images']['tmp_name'][$index];
    //                         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    //                         $unique_name = uniqid() . '.' . $extension;

    //                         if (move_uploaded_file($tmp_name, $upload_path . $unique_name)) {
    //                             $data = array(
    //                                 'song_id'       => $songs_id,
    //                                 'keyboards'     => $unique_name,
    //                                 'created_at'    => date('Y-m-d H:i:s')
    //                             );

    //                             $this->db->insert('song_images', $data);
    //                         }
    //                     }
    //                 }
    //             }

    //             $result1 = $this->common->updateData(
    //                 'tbl_music_files',
    //                 array(
    //                     'chords_songs' => $_FILES['chords']['name'] ? $chord_name  : $data['file']['chords_songs'],
    //                     'vocals' => isset($song[1]['image_name']) ? $song[1]['image_name']  : $data['file']['vocals'],
    //                     'solo' => isset($song[2]['image_name']) ? $song[2]['image_name'] : $data['file']['solo'],
    //                     'click_bpm' => isset($song[3]['image_name']) ? $song[3]['image_name'] : $data['file']['click_bpm'],
    //                     'bass' => isset($song[4]['image_name']) ? $song[4]['image_name'] : $data['file']['bass'],
    //                     'drums' =>  isset($song[5]['image_name']) ? $song[5]['image_name'] : $data['file']['drums'],
    //                     'guitar' =>  isset($song[6]['image_name']) ? $song[6]['image_name'] : $data['file']['guitar'],
    //                     'keyboards' =>  isset($song[7]['image_name']) ? $song[7]['image_name'] : $data['file']['keyboards'],
    //                     'claps' =>  isset($song[8]['image_name']) ? $song[8]['image_name'] : $data['file']['claps']
    //                 ),
    //                 array('song_id' => $id)
    //             );

    //             if ($result1) {
    //                 $response['type'] = 'success';
    //                 $response['msg'] = 'Upload data successfully';
    //                 $response['redirect'] = base_url('admin/songsList');
    //                 echo json_encode($response, true);
    //             } else {
    //                 $response['type'] = 'error';
    //                 $response['msg'] = 'data not uploaded';
    //                 $response['redirect'] = base_url('admin/songsList');
    //                 echo json_encode($response, true);
    //             }
    //         }
    //     }
    // }



    public function multiple_files_old()
    {
        $this->load->library('upload');
        $image = array();
        $ImageCount = count($_FILES['music_file']['name']);
        for ($i = 1; $i <= $ImageCount; $i++) {
            $_FILES['file']['name']       = $_FILES['music_file']['name'][$i];
            $_FILES['file']['type']       = $_FILES['music_file']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['music_file']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['music_file']['error'][$i];
            $_FILES['file']['size']       = $_FILES['music_file']['size'][$i];

            // File upload configuration
            $uploadPath = './assets/songs/';
            $config['upload_path'] = $uploadPath;
            // $config['allowed_types'] = 'jpg|jpeg|png|gif|mp3';
            $config['allowed_types'] = 'wav|mp3|m4a';

            // Load and initialize upload library
            //    $this->load->library('upload', $config);
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

    public function multiple_files()
    {
        $this->load->library('upload');
        $uploadImgData = [];

        if (!isset($_FILES['music_file']) || empty($_FILES['music_file']['name'])) {
            return [];
        }

        foreach ($_FILES['music_file']['name'] as $index => $name) {

            // UPDATE time pe empty indexes skip honge
            if (empty($name)) {
                continue;
            }

            $_FILES['file']['name']     = $name;
            $_FILES['file']['type']     = $_FILES['music_file']['type'][$index];
            $_FILES['file']['tmp_name'] = $_FILES['music_file']['tmp_name'][$index];
            $_FILES['file']['error']    = $_FILES['music_file']['error'][$index];
            $_FILES['file']['size']     = $_FILES['music_file']['size'][$index];

            $config = [
                'upload_path'   => './assets/songs/',
                'allowed_types' => 'wav|mp3|m4a'
            ];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $data = $this->upload->data();

                // Same response structure jo UPDATE expect karta hai
                $uploadImgData[$index] = [
                    'image_name' => $data['file_name']
                ];
            }
        }

        return $uploadImgData;
    }
}
