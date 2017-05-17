<?php
include_once "self/login/User_Login.php";
include_once "self/register/User_Register.php";
include_once "self/User.php";
include_once "self/Token.php";
include_once "self/info/Info.php";
/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/5/8
 * Time: 9:49
 */
class Index_Controller extends CI_Controller  {
    function __construct(){
        parent::__construct();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        //$this->load->model('Index_Model');
    }

    public function login(){
        $data['userName']=$this->input->post('userName');
        $data['passWord']=$this->input->post('passWord');

        $user=new User();

        echo json_encode($user->login(new User_Login($data)));
    }

    public function register(){
        $data['userName']=$this->input->post('userName');
        $data['passWord']=$this->input->post('passWord');
        $data['phoneNum']=$this->input->post('phoneNum');

        $user=new User();

        echo json_encode($user->Register(new User_Register($data)));
    }

    public function getProfile(){
        //$this->load->model('Index_Model');
        $data['token']=$this->input->post('token');

        //decrypt the token
        $data['phoneNum']=Token::decrypted($data['token']);

        $user=new User();


        echo json_encode($user->getProfile(new Info($data)));

    }

    public function setProfile(){
        $data['resName']=$this->input->post('resName');
        $data['userName']=$this->input->post('userName');
        $data['address']=$this->input->post('address');
        $data['pic']=$this->input->post('pic');
        $data['email']=$this->input->post('email');
        $data['city']=$this->input->post('city');
        $data['country']=$this->input->post('country');
        $data['postCode']=$this->input->post('postCode');
        $data['aboutMe']=$this->input->post('aboutMe');

        $data['token']=$this->input->post('token');

        //decrypt the token
        $data['phoneNum']=Token::decrypted($data['token']);

        $result=$this->Index_Model->setUserInfo($data);

        $result['state']=true;
        if(!$result){
            $result['state']=false;
            $result['errorMessage']="发生不可知的错误!";
        }

        echo json_encode($result);
    }
}