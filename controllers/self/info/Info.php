<?php
/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/5/17
 * Time: 12:00
 */
class info extends CI_Controller{
    private $data;
    public function __construct($data){
        parent::__construct();
        $this->data=$data;
        $this->load->model('Index_Model');
    }

    public function getProfile(){
        if(empty($this->data['phoneNum'])){
            $result['state']=false;
            $result['errorMessage']="请先登录";
        }

        //check the num
        if(!$this->Index_Model->IsTeleUnique($this->data)){
            $result['state']=false;
            $result['errorMessage']="该帐号不存在!";
        }

        $result=$this->Index_Model->getUserInfo($this->data);
       // $result=$this->data;
        return $result;
    }

    public function setProfile(){
        if(!isset($this->data['phoneNum'])){
            $result['state']=false;
            $result['errorMessage']="不允许修改手机!";
        }

        $result1=$this->Index_Model->setUserInfo($this->data);

        if($result1){
            $result['state']=true;
            //$result['errorMessage']="不允许修改手机!";
        }else{
            $result['state']=false;
            $result['errorMessage']="修改失败!";
        }

        return $result;
    }
}