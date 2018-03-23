<?php

class LoginCon extends Contorl
{
    public function doaction($c){
        if($c == 'login') {//登录
            $this->login();
        }
        else if($c == 'showLogin'){
            $this->showLogon();
        }
        else if($c == 'code') {//验证码
            $this->code();
        }
        else if($c == 'out'){//注销
            $this->out();
        }
        else if($c == 'showMenu'){
            $this->showMenu();
        }
        else if($c == 'showSchool'){
            $this->showSchool();
        }
        else if($c == 'showColleges'){
            $this->showColleges();
        }
        else if($c == 'showNav'){
            $this->showNav();
        }
    }
    public function showLogon(){
        $this->show('./view/Login.html');
    }
    public function login(){
        $user=isset($_POST['user'])?$_POST['user']:"";
        setcookie('id',$user);
        $psd=isset($_POST['psd'])?$_POST['psd']:"";
        $password=md5($psd);
        $code=isset($_POST['code'])?$_POST['code']:"";
        session_start();
        $session_code=$_SESSION['code'];
        if(strtoupper($code)==strtoupper($session_code)){
            $model=new LoginModel();
            $data=$model->loginM($user,$password);
            if(!empty($data)){
                setcookie('lineid',$user);
                setcookie('customerid',$user,time()+1000,'/');
                session_start();
                $_SESSION['userid']=$user;
                $this->show('./view/homepage.html');
            }
            else{
              $this->show('./view/Login.html');
            }
        }
        else{
            $this->show('./view/Login.html');
        }
    }
    public function code(){
        $code=$_GET['code'];
        session_start();
        $sever_code=$_SESSION['code'];
        if(strtoupper($code)==strtoupper($sever_code)){
            echo 'true';
        }
        else{
            echo 'false';
        }
    }
    public function out(){
        setcookie('lineid');
        echo "<script>alert('注销成功！')</script>";
        $this->show('./view/Login.html');
    }
    public  function showMenu(){
        session_start();
        $uid=$_SESSION['userid'];
        $model=new LoginModel();
        $safArr=$model->getStaff($uid);
        $roleid=$safArr[0]['s_role'];
        $partArr=$model->getParts($roleid);
        $data=$model->getMenu();
        $menu=[];
        foreach ($partArr as $value){
            foreach ($data as $val){
                if($value['m_id'] == $val['a_id']){
                    $menu[]=$val;
                }
            }
        }
        echo json_encode($menu);
    }
    public function showSchool(){
        $model=new LoginModel();
        $data=$model->getSchool();
        echo json_encode($data);
    }
    public function showColleges(){
        $s_id=$_GET['s_id'];
        $model=new LoginModel();
        $data=$model->getColleges($s_id);
        echo json_encode($data);
    }
    public function showNav(){
        session_start();
        $uid=$_SESSION['userid'];
        $model=new LoginModel();
        $data=$model->getUser($uid);
        echo json_encode($data);
    }
}