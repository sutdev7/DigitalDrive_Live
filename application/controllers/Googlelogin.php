<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Googlelogin extends CI_Controller {

public function __construct()
{
	parent::__construct();
	require_once APPPATH.'third_party/src/Google_Client.php';
	require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
	$this->load->model('Users');
}
	
	public function index()
	{
		$this->load->view('login_view');
	}
	
	public function login($type='')
	{
		if(empty($type)){
			$type="Client";
		}
		$clientId = '705398889517-2q0m1imu0j6iih51emka4tp269pt8315.apps.googleusercontent.com'; //Google client ID
		$clientSecret = 'wu_YGKR_fliKaIlxQPl9yocL'; //Google client secret
		$redirectURL = 'https://www.drivedigitally.com/live/Googlelogin/login';
		
		

		//Call Google API
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectURL);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		
		if(isset($_GET['code']))
		{
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
			
		}
		
		if (isset($_SESSION['token'])) 
		{
			$gClient->setAccessToken($_SESSION['token']);
		}
		
		if ($gClient->getAccessToken()) {
			
            $userProfile = $google_oauthV2->userinfo->get();
          	
            $mobile=$userProfile['id'];
            $email=$userProfile['email'];
            $username=$userProfile['email'];
            $picture=$userProfile['picture'];
            $name=$userProfile['name'];
            $type;
			$url_to_image = $userProfile['picture'];
			#changes For Image upload in folder
            if(!empty($url_to_image)){
            	 $digits = 3;
			$uni_val= rand(pow(10, $digits-1), pow(10, $digits)-1);
             $my_save_dir ='uploads/user/profile_image/'.$uni_val;
             
            $filename = basename($url_to_image);
            $imge_url= $uni_val.$filename;
           
            $complete_save_loc = $my_save_dir.$filename;
            file_put_contents($complete_save_loc,file_get_contents($url_to_image));
            }
           
            else{
            	$imge_url='';
            }
            $data =  array($username ,$email,$mobile,$imge_url,$name,$type);
            	

            $userdata = $this->db->get_where('user_login',array('username'=>$username))->row();
              if(empty($userdata)){
            	$content = $this->Users->register_user_google($data);

            	$welcome = "Thank You Register";
            	redirect('user/welcome_singhin/'.$welcome);
            	die();
            }
            else{
            	redirect('user/welcome_singhin');
            }
          
			
			

        } 
		else 
		{
            $url = $gClient->createAuthUrl();
		    header("Location: $url");
            exit;
        }
	}	
}
