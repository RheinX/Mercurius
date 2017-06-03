<?php

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

        //var_dump($data);
        $this->load->view('templates/header');
        $this->load->view('templates/left');
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

        //var_dump($data);
        $this->load->view('templates/header');
        $this->load->view('templates/left');
        $this->load->view('useInfo',$data);
    }

    //申请页面
    public function check_show(){
        $data['user']=$this->Admin_Model->getAllres();
        //var_dump($data['user']);
        $answer=array();
        $answer['user']=array();
        foreach ($data['user'] as $key=>$value){
            if(!$value['status'])
                array_push($answer['user'],$value);
        }

        //var_dump($data);
        $this->load->view('templates/header');
        $this->load->view('templates/left');
        $this->load->view('check',$answer);
    }

}