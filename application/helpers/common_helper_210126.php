<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function user_detail($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $user_detail = $CI->common->getData('user',array('id'=>$id),array('single'));

    if(!empty($user_detail)){
     return $user_detail;
    }
    else{
      return false;
    }
}
function bitpack_name($id)
{
     $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $bitpack_name = $CI->common->getData('bit_pack',array('id'=>$id),array('single'));

    if(!empty($bitpack_name)){
     return $bitpack_name['bit_name'];
    }
    else{
      return false;
    }
}

 
function user_full_name($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $user_detail = $CI->common->getData('tbl_users',array('id'=>$id),array('single'));

    if(!empty($user_detail)){
      return $user_detail['firstname'].' '.$user_detail['lastname'];
    }else{
     return false;
    }
}
function album_name($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $album_detail = $CI->common->getData('tbl_albums',array('id'=>$id),array('single'));

    if(!empty($album_detail)){
      return $album_detail['album_type'];
    }else{
     return false;
    }
}
function zone_type_name($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $layout_detail = $CI->common->getData('tbl_music_zones',array('id'=>$id),array('single'));

    if(!empty($layout_detail)){
      return $layout_detail['layout_name'];
    }else{
     return false;
    }
}
function your_mood_name($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $mood_detail = $CI->common->getData('tbl_your_mood',array('id'=>$id),array('single'));

    if(!empty($mood_detail)){
      return $mood_detail['mood_type'];
    }else{
     return false;
    }
}
function genre_name($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $genre_detail = $CI->common->getData('tbl_genre',array('id'=>$id),array('single'));

    if(!empty($genre_detail)){
      return $genre_detail['genre_type'];
    }else{
     return false;
    }
}
function artist_full_name($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $user_detail = $CI->common->getData('tbl_artists',array('id'=>$id),array('single'));

    if(!empty($user_detail)){
      return $user_detail['artist_name'];
    }else{
     return false;
    }
}
 
function gen_category($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $gen_category = $CI->common->getData('genre_category',array('genre_id'=>$id),array('single'));

    if(!empty($gen_category)){
      return $gen_category['genre_name'];
    }else{
      return false;
    }
}

function category_name($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $user_detail = $CI->common->getData('sell_category',array('id'=>$id),array('single'));

    if(!empty($user_detail)){
      return $user_detail['name'];
    }else{
      return false;
    }
}



  ////End of the function
function user_type($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->model('common');
    $user_detail = $CI->common->getData('user',array('id'=>$id),array('single'));

    if(!empty($user_detail)){
      return $user_detail['user_type'];
    }else{
     return false;
    }
}


if (!function_exists('fileuploadCI')) {
    function fileuploadCI($imagename,$folder)
    {
        $image=$_FILES[$imagename]['name'];
        $CI =& get_instance();
        $config=array(
          'upload_path' => $folder,
          'allowed_types' => '*',
          // 'allowed_types' => 'pdf|jpg|jpeg|png|xlsx|xls|docx|doc',
          'file_name'=>$image
        );
        $CI->load->library('upload',$config);
        $CI->upload->initialize($config);
        if ($CI->upload->do_upload($imagename)) {
          $data = $CI->upload->data();
            // pred($data['file_name']);
            return $data['file_name'];
            // return $image;
        } else {
             return 'Not uploaded';
        }

    }
}

function pred($data){

	echo "<pre>";
	print_r($data);
	echo "<pre>";
	die();

}

function pre($data){

	echo "<pre>";
	print_r($data);
	echo "<pre>";

}
