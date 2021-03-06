<?php
include_once "self/Token.php";
include_once "self/ExtraFunction.php";
/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/5/8
 * Time: 10:10
 */
class Core_Controller extends CI_Controller {
    function __construct(){
        parent::__construct();
        header('Access-Control-Allow-Origin:*');
        header("Access-Control-Allow-Methods:GET,POST");
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        $this->load->model('Core_Model');
        $this->load->model('Index_Model');
    }

    public function getCommentLine(){
        $data['token']=$this->input->post('token');

        //decrypt the token
        $data['phoneNum']=Token::decrypted($data['token']);

        $userInfo=$this->Index_Model->getUserInfo($data);

        if($userInfo['state']!=2){
            $result['state']=false;
            $result['errorMsg']="用户信息未通过审核!";
            echo json_encode($result);
            return;
        }

        $result=$this->Core_Model->getLinedata($data);

        if(!$result){
            $result['state']=false;
            $result['errorMsg']="发生错误!请稍候再试";
            echo json_encode($result);
            return;
        }

        $answer[0]['name']="好评";

        $other=substr($result['good'],1,strlen($result['good'])-2);
        $answer[0]['data']=explode(',',$other);

        $answer[1]['name']="中评";
        $other=substr($result['medium'],1,strlen($result['medium'])-2);
        $answer[1]['data']=explode(',',$other);

        $answer[2]['name']="差评";
        $other=substr($result['bad'],1,strlen($result['bad'])-2);
        $answer[2]['data']=explode(',',$other);

        $answer['state']=true;
        echo json_encode($answer);

    }

    public function getCommentPie(){
        $data['token']=$this->input->post('token');

        //decrypt the token
        $data['phoneNum']=Token::decrypted($data['token']);

        $userInfo=$this->Index_Model->getUserInfo($data);

        if($userInfo['state']!=2){
            $result['state']=false;
            $result['errorMsg']="用户信息未通过审核!";
            echo json_encode($result);
            return;
        }

        $result=$this->Core_Model->getPiedata($data);
        if(!$result){
            $result['status']=false;
            $result['errorMsg']="发生错误!请稍候再试";
            echo json_encode($result);
            return;
        }

        //handle the data
        //cut the []
        $result=substr($result,1,strlen($result)-2);
        $result=explode(',',$result);
        $answer['state']=true;
        $answer['errorMessage']=null;

        $answer[0]['value']=$result[0];
        $answer[0]['name']="好评";

        $answer[1]['value']=$result[1];
        $answer[1]['name']="中评";

        $answer[2]['value']=$result[2];
        $answer[2]['name']="差评";

        echo json_encode($answer);

    }

    public function getCommentBar(){
        $data['token']=$this->input->post('token');

        //decrypt the token
        $data['phoneNum']=Token::decrypted($data['token']);

        $userInfo=$this->Index_Model->getUserInfo($data);

        if($userInfo['state']!=2){
            $result['state']=false;
            $result['errorMsg']="用户信息未通过审核!";
            echo json_encode($result);
            return;
        }

        $result=$this->Core_Model->getBardata($data);
        if(!$result){
            $result['state']=false;
            $result['errorMsg']="发生错误!请稍候再试";
            echo json_encode($result);
            return;
        }

        $keyOther=$result['keywords'];
       // $keyOther=substr($keyOther,1,strlen($keyOther)-2);
        $answer['keyword']=explode(',',$keyOther);

        $keyOther=$result['data'];
        $keyOther=substr($keyOther,1,strlen($keyOther)-2);
        $answer['data']=explode(',',$keyOther);
        $answer['state']=true;
        $answer['errorMsg']=null;

        echo json_encode($answer);

    }

    public function predict($day,$top){
        $data['state']=true;
        $data['errorMessage']=null;
        $data['dishName']="rice";

        for ($i=0;$i<$day;$i++)
            $data['volume'][$i]=2;


        $result=array();
        for ($i=0;$i<$top;$i++)
            array_push($result,$data);

        echo json_encode($result);

    }


    public function test(){
        $this->Core_Model->writeRedis();
    }

}