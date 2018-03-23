<?php
//data_defalult_timezone_set('PTC');
class RegistORloginCon extends Control
{
    //注册
    public function regist(){
       $model = new RegistORloginMod();
       //获取用户表的长度并成用户ID
       $res = $model->getCount(t_user);
       $count = $res[0]['allCount'];
       if($count<=10 || empty($res)){
           $idx = '0'.($count+1);
       }else {
           $idx =$count+1;
       }
       $userid = '100'.$idx;
       $nickname = $_POST['nickname'];
       $userpsd = md5($_POST['userpsd']);
       $registime = date("Y-m-d H:i:s");
       $headimg = './view/img/headImg1.jpg';
       $balance = 0;
       $payPsd = md5($_POST['payPsd']);
       $state = '使用';
       $condition = ['userid'=>$userid,"nickname"=>$nickname,"userpsd"=>$userpsd,"registime"=>$registime,"headimg"=>$headimg,"balance"=>$balance,"payPsd"=>$payPsd,"state"=>$state];
       $res = $model->insertData('t_user',$condition);
       if($res){
           echo $userid;
       }else{
           echo 0;
       }
   }
    //登录
    public function login(){
        $userid = $_POST['userid'];
        $userpsd = md5($_POST['userpsd']);
        $condition = ['userid'=>$userid,'userpsd'=>$userpsd];
        $model = new Model();
        $res = $model->queryData('t_user',$condition);
        if(empty($res)){
            echo 0;
        }else{
            if($res[0]['state']=='使用'){
                session_start();
                $_SESSION['userid'] = $userid;
                $_SESSION['nickname'] = $res[0]['nickname'];
                $_SESSION['headimg'] = $res[0]['headimg'];
                echo json_encode($res);
            }else{
                echo -1;
            }
        }
    }
    //注销
    public function logout(){
        session_start();
        unset($_SESSION['userid']);
        unset($_SESSION['nickname']);
        unset($_SESSION['headimg']);
        echo 1;
    }
}