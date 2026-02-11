 <?php
    ob_start();
   defined('BASEPATH') OR exit('No direct script access allowed');
   #[\AllowDynamicProperties]
   class AdminController extends Admin_Controller {
     public function __construct() {
        parent::__construct();
       
        $this->load->helper('url');
        $this->load->helper('common');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');

     }

    //Upload multiple songs
    public function uploadSongs1()
    { 
        
       $this->form_validation->set_rules('track', 'track', 'required');
       $this->form_validation->set_rules('label', 'label', 'required');
       // $this->form_validation->set_rules('cover_image', 'cover image', 'required');
       $this->form_validation->set_rules('zone_type', 'zone type', 'required');
       $this->form_validation->set_rules('release_year', 'release year', 'required');
      
       if($this->form_validation->run() == false) 
        {
            $data['artist'] = $this->common->getData('tbl_artists', array(), array());
            $data['genre'] = $this->common->getData('tbl_genre', array(), array());
            $data['album'] = $this->common->getData('tbl_albums', array(), array());
            $data['your_mood'] = $this->common->getData('tbl_your_mood', array(), array());
            $data['zone'] = $this->common->getData('tbl_music_zones_types', array(), array());
            $this->adminHtml('Upload Mix Songs', 'uploadsongs-list', $data);

         } else {

              if(isset($_FILES['cover_image'])){ 
                $image_name = $_FILES['cover_image']['name'];   
                $fileTempName = $_FILES['cover_image']['tmp_name'];
                $bucket_name = 'glistener';
                $data = $this->common->amazons3UploadBucket($image_name, $fileTempName, $bucket_name='glistener');
 
                if($data)
                {
                    $_POST['cover_image'] = $image_name ;
                 } else {
                    $_POST['cover_image'] = "" ;
                }   
              }
 
            $song = array() ; 
            $post11 = $this->common->getField('tbl_songs', $_POST) ;
            $result = $this->common->insertData('tbl_songs', $post11) ; 
 
          if ($result) {
             $songs_id = $this->db->insert_id() ;
             if (!empty($_FILES['music_file']['name'][1])) {  
            $filesCount = count($_FILES['music_file']['name']);

            $zone_type = $_POST['zone_type'] ;

            if($zone_type == '1') { $filesCount=5; } else { $filesCount=6; }
 
              for($i = 1 ;$i <= $filesCount;$i++) {

               $fileName = $_FILES['songs']['name'] = $_FILES['music_file']['name'][$i];
                $_FILES['songs']['type'] = $_FILES['music_file']['type'][$i];
                $_FILES['songs']['tmp_name'] = $_FILES['music_file']['tmp_name'][$i];
                $_FILES['songs']['error'] = $_FILES['music_file']['error'][$i];
                $_FILES['songs']['size'] = $_FILES['music_file']['size'][$i];
                $bucket_name = 'glistener';

                $myFileName[$i] = "" ;
                $temp = explode(".", $fileName);
               // $myFileName[$i] = round(microtime(true)) . '.' . end($temp) ;
                $myFileName[$i] =  uniqid() . '.' . end($temp) ;
                
                $path = '/var/www/html/assets/songs/'.$myFileName[$i];
                $trmpfilesss = $_FILES['music_file']['tmp_name'][$i];
 
               // $data1 =  shell_exec("ffmpeg -i  $trmpfilesss -b:v 64k -bufsize 64k $path &");
                $data1 =  shell_exec("ffmpeg -i $trmpfilesss -c:v libx264 -tune zerolatency -preset ultrafast -crf 40 -c:a aac -b:a 64k $path ");

                $data1 = $this->common->amazons3UploadBucket( $myFileName[$i] ,  $path ,$bucket_name);

                   if($data1)
                    {
                      if(file_exists($path)){
                          unlink($path);
                      }
                       $song[] = $_FILES['songs']['name'] ;

                      
                    }     
                                    
                 $all_file_names[] = $myFileName[$i]  ;
              } 
       
               $allFiles = $song[0].','.$song[1].','.$song[2].','.$song[3].','.$song[4].','.$song[5] ; 
            
               if(!empty($song)) {  
                 $result1 = $this->common->insertData('tbl_music_files', 
                  array('song_id' => $songs_id,
                    
                    'drums' =>isset($all_file_names[0]) ? $all_file_names[0] : "" ,
                    'bass' => isset($all_file_names[1]) ? $all_file_names[1] : ""  ,
                    'guitar' => isset($all_file_names[2]) ? $all_file_names[2] : "",
                    'vocals' => isset($all_file_names[3]) ? $all_file_names[3] : "" ,
                    'master1' =>  isset($all_file_names[4]) ? $all_file_names[4] : "" ,
                    'master2'=>  isset($all_file_names[5]) ? $all_file_names[5] : "",
                    'all_file_names' => isset($allFiles) ? $allFiles : "",
                    'created_at' => date('Y-m-d h:i:s')));   
               }
           
                // $this->session->set_flashdata('success', 'Upload data successfully');

                $response['type'] = 'success' ;
                $response['msg'] = 'Upload data successfully' ;
                $response['redirect'] = base_url('admin/songsList') ; 

                // 'http://44.197.223.72/admin/songsList' ;
                
                echo json_encode($response,true);

              } else {

               // $this->session->set_flashdata('error', 'Some Error occured.');

               $response['type'] = 'error';
               $response['msg'] = 'data not uploaded';
               $response['redirect'] = base_url('admin/songsList') ;
               echo json_encode($response,true);

             }

             // redirect(base_url('admin/songsList'), 'refresh');
           }
        }

    }

  }