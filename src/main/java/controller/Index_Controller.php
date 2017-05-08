<?php

/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/5/8
 * Time: 9:49
 */
class Index_Controller extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
    }

    public function login(){
        $userName=$this->input->post('userName');

        $data['state']=true;
        $data['errorMessage']=null;
        if($userName!='dema'){
            $data['state']=false;
            $data['errorMessage']="The username or password is wrong!";
        }

        echo json_encode($data);
    }

    public function register(){
        $userName=$this->input->post('userName');

        $data['state']=true;
        $data['errorMessage']=null;
        if($userName!='dema'){
            $data['state']=false;
            $data['errorMessage']="The username or password is wrong!";
        }

        echo json_encode($data);
    }

    public function getProfile(){
        $data['state']=true;
        $data['errorMessage']=null;
        $data['resName']="Big Gay";
        $data['userName']="dema";
        $data['address']="China";
        $data['pic']="https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1494209031&di=f69c29660a067128127607a8a87cd9f0&src=http://img5.duitang.com/uploads/item/201505/01/20150501221634_n3Vzj.thumb.224_0.jpeg";
        $data['email']="dema@gmail.com";
        $data['city']="BeiJing";
        $data['country']="Japan";
        $data['postCode']=10044;
        $data['aboutMessage']="Dema is a gay!";

        echo json_encode($data);
    }

    public function setProfile(){
        $data['state']=true;
        $data['errorMessage']=null;

        echo json_encode($data);
    }
}