<?php
include_once 'self/ExtraFunction.php';
/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/6/2
 * Time: 13:36
 */
class Admin_Controller extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Admin_Model');
        $this->load->model('Index_Model');
        $this->load->model('Core_Model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index(){
        $this->load->view('index');
    }

    public function loginHandle(){
        $data['email']=$this->input->post('email');
        $data['password']=$this->input->post('password');

        var_dump($data);
        if('123@123.com'==$data['email']&&'demaisgay'==$data['password']){
            redirect('Admin_Controller/user');
        }
        //else{
//            redirect('Admin_Controller/index');
//        }
    }

    public function user(){
        $data['user']=$this->Admin_Model->getAllres();
        $data['label']='user';
        $data['open']=1;

        //var_dump($data);
        $this->load->view('templates/header');
        $this->load->view('templates/left',$data);
        $this->load->view('user',$data);
    }

    public function handleAccount($phone,$state){
        $data['phoneNum']=$phone;
        $data['state']=$state;

        $this->Admin_Model->setState($data);

        redirect('Admin_Controller/user');
        //var_dump($data);
    }

    public function userInfo($phoneNum){
        $data['phoneNum']=$phoneNum;
        $data=$this->Index_Model->getUserInfo($data);
        $data['label']='userInfo';
        $data['open']=1;

        //var_dump($data);
        $this->load->view('templates/header');
        $this->load->view('templates/left',$data);
        $this->load->view('useInfo',$data);
    }

    //申请页面
    public function check_show(){
        $data['user']=$this->Admin_Model->getAllres();

        //var_dump($data['user']);
        $answer=array();
        $answer['user']=array();
        $answer['label']='check';
        $answer['open']=1;
        foreach ($data['user'] as $key=>$value){
            if(!$value['status'])
                array_push($answer['user'],$value);
        }

        //var_dump($data);
        $this->load->view('templates/header');
        $this->load->view('templates/left',$answer);
        $this->load->view('check',$answer);
    }

    //备份
    public function backups(){
        $this->load->helper('download');
        $data=$this->Core_Model->exportRedis();
//        $myFile=fopen('d://backup.txt','w');
//        fwrite($myFile,$data);
//        fclose($myFile);

//        download("D:\\",basename('backup','.'.'txt'));
        force_download('backup.txt',$data,false);
    }

    //comments
    public function getComments(){
        //get all the user information
        $data=$this->Admin_Model->getAllres();
        $answer['user']=array();
        $answer['label']='comment';
        $answer['open']=2;

        //loop all the user information,if there exist the comments,push it into answer
        foreach ($data as $key=>$value){
            $currentData['phoneNum']=$key;
            $result=$this->Admin_Model->getComment($currentData);

            if($result['score']){
                $result['phoneNum']=$key;
                $result['resName']=$value['resName'];
                array_push($answer['user'],$result);
            }

        }
       // echo json_encode($answer);

        //show the page
        $this->load->view('templates/header');
        $this->load->view('templates/left',$answer);
        $this->load->view('comment',$answer);
    }

    public function log($phoneNum){
        $data['phoneNum']=$phoneNum;

        $answer['user']=$this->Admin_Model->getShopLog($data);
        $answer['label']='user';
        $answer['open']=1;
        $this->load->view('templates/header');
        $this->load->view('templates/left',$answer);
        $this->load->view('log',$answer);

//        echo json_encode($answer);
    }
}