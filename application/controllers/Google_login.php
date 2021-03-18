<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {

   public function __construct()
{
    parent::__construct();
    require_once APPPATH.'third_party/src/Google_Client.php';
    require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
    $this->load->helper('cookie');
    $this->load->model('Users'); 
    $this->load->model('Notifications'); 
    $this->load->library('Laccount');
    $this->load->helper('security');
    $this->load->library('session');
}
    
    public function index()
    {
        $this->load->view('google_login');
    }
    
    public function login(){
       
        $clientId = '705398889517-2q0m1imu0j6iih51emka4tp269pt8315.apps.googleusercontent.com'; //Google client ID
        $clientSecret = 'wu_YGKR_fliKaIlxQPl9yocL'; //Google client secret
        $redirectURL = 'https://www.drivedigitally.com/live/Googlelogin/login';
        
        //https://curl.haxx.se/docs/caextract.html

        //Call Google API
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);
        
        //echo"<pre>";print_r($dd);exit;
        //echo"<pre>";print_r($google_oauthV2->userinfo->get());
        //print_r($_GET['code']);exit;
             // die('11');
            
        if(isset($_GET['code'])) {
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
            header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
        }

        if(isset($_SESSION['token'])) {
            $gClient->setAccessToken($_SESSION['token']);
        }
        
        if($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            //echo"<pre>";print_r($userProfile);exit;
            
            $mobile         = $userProfile['id'];
            $email          = $userProfile['email'];
            $username       = $userProfile['email'];
            $picture        = $userProfile['picture'];
            $name           = $userProfile['name'];
            $url_to_image   = $userProfile['picture'];
            $utype          = 'freelancer';
            #changes For Image upload in folder
            if(!empty($url_to_image)){
                $digits = 3;
                $uni_val= rand(pow(10, $digits-1), pow(10, $digits)-1);
                $my_save_dir ='uploads/user/profile_image/'.$uni_val;
             
                $filename = basename($url_to_image);
                $imge_url= $uni_val.$filename;
               
                $complete_save_loc = $my_save_dir.$filename;
                file_put_contents($complete_save_loc,file_get_contents($url_to_image));
            } else{
                $imge_url='';
            }

            $user_Gdata =  array($username,$email,$mobile,$imge_url,$name,$utype);
            
            $result = $this->Users->check_gmail_valid_user_google($email);
            //print_r($result);exit;
            if ($result){
                $key = md5(time());
                $key = str_replace("1", "z", $key);
                $key = str_replace("2", "J", $key);
                $key = str_replace("3", "y", $key);
                $key = str_replace("4", "R", $key);
                $key = str_replace("5", "Kd", $key);
                $key = str_replace("6", "jX", $key);
                $key = str_replace("7", "dH", $key);
                $key = str_replace("8", "p", $key);
                $key = str_replace("9", "Uf", $key);
                $key = str_replace("0", "eXnyiKFj", $key);
                $sid_web = substr($key, rand(0, 3), rand(28, 32));

                $user_profile_image = $result[0]['profile_image'];
                if(empty($user_profile_image)) {
                    $user_profile_image = base_url('assets/img/no-image.png');
                } else {
                    $user_profile_image = base_url('uploads/user/profile_image/'.$user_profile_image);          
                }           
            
                $notifications=$this->Notifications->get_all_user_notification($result[0]['user_id']);
                $count_notification=count($notifications);
            
                // codeigniter session stored data          
                $user_data = array(
                    'sid_web'       => $sid_web,
                    'user_id'       => $result[0]['user_id'],
                    'profile_id'    => $result[0]['profile_id'],
                    'user_type'     => $result[0]['user_type'],
                    'user_name'     => $result[0]['name'],
                    'user_email'    => $result[0]['email'],
                    'user_mobile'   => $result[0]['mobile'],
                    'user_image'    => $result[0]['profile_image'],
                    'user_site_image'   => $user_profile_image,
                    'is_mobile_verified' => $result[0]['is_mobile_verified'],
                    'receive_transactional_notification'    => $result[0]['receive_transactional_notification'],
                    'receive_task_update_notification'  => $result[0]['receive_task_update_notification'],
                    'receive_task_reminder_notification'    => $result[0]['receive_task_reminder_notification'],
                    'receive_helpful_notification'  => $result[0]['receive_helpful_notification'],
                    'total_points' => $result[0]['total_points'],
                    'profile_status'=> $result[0]['profile_status'],
                    'count_notification'=>$count_notification
                );
                //print_r($user_data);exit;
                $this->session->set_userdata($user_data);
                //redirect('user-bio', 'refresh');
                redirect('dashboard', 'refresh');
            }else{
                $this->session->set_flashdata('errmsg', $email. ' this email not in our database, try with another');    
                $contentGG = $this->laccount->sign_in_page();
                $dataGG = array(
                    'content' => $contentGG,
                    'title' => display('Sign-in :: Hire-n-Work'),
                );      
                $this->template->full_website_html_view($dataGG);
                
                /*$contentRG = $this->Users->register_user_google($user_Gdata);

                if($contentRG['status']){
                    $resultG = $this->Users->check_gmail_valid_user_google($email);
                    if($resultG){
                        $key = md5(time());
                        $key = str_replace("1", "z", $key);
                        $key = str_replace("2", "J", $key);
                        $key = str_replace("3", "y", $key);
                        $key = str_replace("4", "R", $key);
                        $key = str_replace("5", "Kd", $key);
                        $key = str_replace("6", "jX", $key);
                        $key = str_replace("7", "dH", $key);
                        $key = str_replace("8", "p", $key);
                        $key = str_replace("9", "Uf", $key);
                        $key = str_replace("0", "eXnyiKFj", $key);
                        $sid_webG = substr($key, rand(0, 3), rand(28, 32));

                        $user_profile_image = $resultG[0]['profile_image'];
                        if(empty($user_profile_image)) {
                            $user_profile_image = base_url('assets/img/no-image.png');
                        } else {
                            $user_profile_image = base_url('uploads/user/profile_image/'.$user_profile_image);          
                        }           
                    
                        $notifications=$this->Notifications->get_all_user_notification($resultG[0]['user_id']);
                        $count_notification=count($notifications);
                    
                        // codeigniter session stored data          
                        $userDataG = array(
                            'sid_web'       => $sid_webG,
                            'user_id'       => $resultG[0]['user_id'],
                            'profile_id'    => $resultG[0]['profile_id'],
                            'user_type'     => $resultG[0]['user_type'],
                            'user_name'     => $resultG[0]['name'],
                            'user_email'    => $resultG[0]['email'],
                            'user_mobile'   => $resultG[0]['mobile'],
                            'user_image'    => $resultG[0]['profile_image'],
                            'user_site_image' => $user_profile_image,
                            'is_mobile_verified' => $resultG[0]['is_mobile_verified'],
                            'receive_transactional_notification' => $resultG[0]['receive_transactional_notification'],
                            'receive_task_update_notification' => $resultG[0]['receive_task_update_notification'],
                            'receive_task_reminder_notification' => $resultG[0]['receive_task_reminder_notification'],
                            'receive_helpful_notification' => $resultG[0]['receive_helpful_notification'],
                            'total_points' => $resultG[0]['total_points'],
                            'profile_status'=> $resultG[0]['profile_status'],
                            'count_notification'=>$count_notification
                        );
                        //print_r($user_data);exit;
                        $this->session->set_userdata($userDataG);
                        redirect('user-bio', 'refresh');
                        //redirect('dashboard', 'refresh');
                    }else{
                        $this->session->set_flashdata('errmsg', $email. ' this email not in our database, try with another');    
                        $contentG = $this->laccount->sign_in_page();
                        $dataG = array(
                                    'content' => $contentG,
                                    'title' => display('Sign-in :: Hire-n-Work'),
                                );      
                        $this->template->full_website_html_view($dataG);
                    }                   
                }else{
                    $this->session->set_flashdata('errmsg', $email. ' this email not in our database, try with another');    
                    $contentGG = $this->laccount->sign_in_page();
                    $dataGG = array(
                        'content' => $contentGG,
                        'title' => display('Sign-in :: Hire-n-Work'),
                    );      
                    $this->template->full_website_html_view($dataGG);
                }*/
            }

        } else {
            $url = $gClient->createAuthUrl();
            header("Location: $url");
            exit;
        }
    }   
}

?>