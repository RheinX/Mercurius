<?php

/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/5/8
 * Time: 10:10
 */
class Core_Controller extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
    }

    public function getCommentLine(){
        $data['state']=true;
        $data['errorMsg']=null;
        $data[0]['name']="好评";
        $data[0]['data']=[10,20,30,40,50,60,70];

        $data[1]['name']="中评";
        $data[1]['data']=[70,60,50,40,30,20,10];

        $data[2]['name']="差评";
        $data[2]['data']=[20,20,20,20,20,20,20];

        echo json_encode($data);
    }

    public function getCommentPie(){
        $data['state']=true;
        $data['errorMsg']=null;

        $data[0]['value']=65;
        $data[0]['name']="好评";

        $data[1]['value']=17;
        $data[1]['name']="中评";

        $data[2]['value']=18;
        $data[2]['name']="差评";

        echo json_encode($data);
    }

    public function getCommentBar(){
        $data['state']=true;
        $data['errorMsg']=null;

        $data['keyword']=["好吃","便宜","垃圾","送餐太慢","肉太少","还行","一般般"];
        $data['data']=[43,54,32,65,3,32,3];

        echo json_encode($data);
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
}