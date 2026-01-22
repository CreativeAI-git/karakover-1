
<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

error_reporting(0);
class Base_Controller extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->authkey = 'ODQ3ODk0NzY5'; 
		
	}

	// public function frontHtml($title="Artist Army App",$page,$data="")
	// {
	// 	$header['title'] = $title;
	// 	$this->load->view('header',$header);
	// 	$this->load->view($page,$data);
	// 	$this->load->view('footer');
	// }

	public function adminHtml($title="",$page,$data="")
	{
		$header['title'] = $title;
		$this->load->view('admin_header',$header);
		$this->load->view('sidebar');
		$this->load->view($page,$data);
		$this->load->view('admin_footer');
	}

	public function checkAuth()
	{
		foreach($_SERVER as $key => $value) {
	        if (substr($key, 0, 5) <> 'HTTP_') {
	            continue;
	        }
	        $header = str_replace(' ','-', ucwords(str_replace('_',' ', strtolower(substr($key,5)))));
	        $headers[$header] = $value;
	    }	    

		if($headers['Authorization'] == ""){	
			$message = "Auth key required";
			$this->response(false,$message); exit;
		} 

		if($headers['Authorization'] != $this->authkey){	
			$message = "wrong Authentication key";
			$this->response(false,$message); exit;
		}

		if($headers['Is-Update']==1){
		// Login,Registration and Singup API
		}elseif($headers['Is-Update']==0){

			$user_table_count=$this->common->getData('users',array('session_id'=>$headers['Session-Id'],'user_id'=>$headers['User-Id']),array('count'));

			

			if($user_table_count==1){

			}else{

				$response['message'] = "You account is already logged in other device.";
				$response['session_message']=606; // Session Expired Code 
				echo json_encode($response); exit;
			}	
		}elseif($headers['Is-Update']==2){

		}
		   
	}

	public function block($table,$id,$url1='',$url2='',$url3='')
	{	

		echo $url3;
		die();
		$user = $this->common->getData($table,array('user_id'=> $id),array('field'=> 'login_status','single'));
		$status = 0;
		if($user['login_status'] == 0 ){ 
			$status = 1;
		}
		$result = $this->common->updateData($table,array('login_status' => $status),array('user_id' => $id));
		
		if($result){
			if($status == 0){
				$message = $table.' verified successfully';
			}else{
				$message = $table.' unverify successfully';
			}
			$this->flashMsg('success',$message);
		}else{
			$this->flashMsg('danger','Some Error occured.');
		} 
		redirect(base_url($url1.'/'.$url2.'/'.$url3));
	}


	

	public function generateCode($length=8)
	{
		if (function_exists("random_bytes")) {
	        $bytes = random_bytes(ceil($lenght / 2));
	    } elseif (function_exists("openssl_random_pseudo_bytes")) {
	        $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
	    } else {
	        throw new Exception("no cryptographically secure random function available");
	    }
	    echo substr(bin2hex($bytes), 0, $length);
	}

	public function flashMsg($class,$msg)
	{
		$msg1 = '<div class="alert alert-'.$class.' alert-dismissible" role="alert">'.$msg.'
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
      	<div class="clearfix"></div>';	
        $this->session->set_flashdata('msg',$msg1);   
        return true;      
	}

	public function response($status=true,$message,$other_option= array())
	{
		$response = array(
				"code" => $status ? "1" : "0",	
				"message" => ucwords($message)
		    );	
		if(!empty($other_option)){
			foreach ($other_option as $key => $value) {
				$response[$key] = $value;
			}
		}
		echo json_encode($response);
	}

	public function curl($url,$headers,$fields){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);

		           
		if ($result === FALSE) {
		   die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;

		
		
	}

	function Apn($deviceToken,$message){  

		$fields = array
		(
			'to'	=> $deviceToken,
			'priority' => 'high',
			'notification' => array	('body'	=> $message['message'],	'title'	=> $message['title'],		'sound' => 'chime.aiff'),
			'data'  => $message
		);

		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY_ios,
			'Content-Type: application/json'
		);

		$this->curl($headers,$fields);
	}

	public function send_notification($tokens, $message)
	{	
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
				 	'registration_ids' => $tokens,
				 	 
				 	  "data" => $message
				);

		$headers = array(
			'Authorization:key = AIzaSyAcymHb0gntFbvPPlR28bAQ3D2euus3Zjo',
			'Content-Type: application/json'
		);

		$this->curl($url,$headers,$fields);
	}

	public function pagination($url,$table,$segment)
  {
    $this->load->library('pagination');
    $config = [
      'base_url'      =>  base_url($url),
      'per_page'      =>  10,
      'total_rows'    =>  $this->common->getData($table,array(),array('count')),
      'full_tag_open'   =>  "<ul class='pagination'>",
      'full_tag_close'  =>  "</ul>",
      'first_tag_open'  =>  '<li>',
      'first_tag_close' =>  '</li>',
      'last_tag_open'   =>  '<li>',
      'last_tag_close'  =>  '</li>',
      'next_tag_open'   =>  '<li>',
      'next_tag_close'  =>  '</li>',
      'prev_tag_open'   =>  '<li>',
      'prev_tag_close'  =>  '</li>',
      'num_tag_open'    =>  '<li>',
      'num_tag_close'   =>  '</li>',
      'cur_tag_open'    =>  "<li class='active'><a>",
      'cur_tag_close'   =>  '</a></li>',
    ];
    $this->pagination->initialize($config);
    $data = $this->common->getData($table,array(),array('limit' => $config['per_page'],'offset'=> $this->uri->segment($segment) ));
    return $data;
  }

  public function imageLib($path,$option=array())
  {
  	$config['image_library'] = 'gd2';
	$config['source_image'] = $path;
	$config['create_thumb'] = false;
	$config['maintain_ratio'] = TRUE;
	$config['width']         = 65;
	$config['height']       = 45;
	if(!empty($option)){
		foreach ($option as $key => $value) {
			$config[$key] = $value;
		}
	}
	$this->load->library('image_lib');
	$this->image_lib->initialize($config);
	
  }

  public function resizeImage($path,$config=array())
  {
  	$this->imageLib($path,$config);
  	return $this->image_lib->resize();
  }


}