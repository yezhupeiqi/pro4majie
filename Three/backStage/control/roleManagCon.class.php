<?php

class roleManagCon extends Contorl
{
    public function doaction($c){
        if($c == 'showrole'){
            $this->showrole();
        }
        else if($c == 'soleLimt'){
            $this->soleLimt();
        }
        else if($c == 'addRole'){
            $this->addRole();
        }
        else if($c == 'showModify'){
            $this->showModify();
        }
        else if($c == 'modName'){
            $this->modName();
        }
        else if($c == 'modRibe'){
            $this->modRibe();
        }
        else if($c == 'deletRole'){
            $this->deletRole();
        }
        else if($c == 'getRole'){
            $this->getRole();
        }
        else if($c == 'modPerm'){
            $this->modPerm();
        }
        else if($c == 'getMenu'){
            $this->getMenu();
        }
    }

    public function showrole(){
        $this->show('./view/roleManag.html');
    }
    //显示角色表
    public function soleLimt(){
        $model=new roleModel();
        $data=$model->getSole();
        echo json_encode($data);
    }
    //添加角色
    public function addRole(){
        $r_name=isset($_POST['r_name'])?$_POST['r_name']:"";
        $ribe=isset($_POST['ribe'])?$_POST['ribe']:"";
        if($r_name != '' && $ribe !=''){
            $model=new roleModel();
            $data=$model->addR($r_name,$ribe);
            if($data == 'true'){
                echo 'yes';
            }else{
                echo 'no';
            }
        }
        else{
            echo '0';
        }
    }
    //显示修改
    public function showModify(){
        $r_id=isset($_POST['id'])?$_POST['id']:"";
        $model=new roleModel();
        $data=$model->role($r_id);
        echo json_encode($data);
    }
    //修改角色名称
    public function modName(){
        $r_id=isset($_POST['id'])?$_POST['id']:"";
        $r_name=isset($_POST['r_name'])?$_POST['r_name']:"";
        $model=new roleModel();
        $res=$model->upSoleName($r_id,$r_name);
        echo $res;
    }
    //修改角色名称
    public function modRibe(){
        $r_id=isset($_POST['id'])?$_POST['id']:"";
        $ribe=isset($_POST['ribe'])?$_POST['ribe']:"";
        $model=new roleModel();
        $res=$model->upSoleribe($r_id,$ribe);
        echo $res;
    }
    //删除角色
    public function deletRole(){
        $r_id=isset($_POST['id'])?$_POST['id']:"";
        $model=new roleModel();
        $res=$model->deletR($r_id);
        echo $res;
    }
    //获取角色分配
    public function getRole(){
        $r_id=isset($_POST['id'])?$_POST['id']:"";
        $model=new roleModel();
        $data=$model->roleParts($r_id);
        echo json_encode($data);
    }
    //修改权限
    public function modPerm(){
        $role_id=isset($_POST['id'])?$_POST['id']:"";
        $roleArr=isset($_POST['arr'])?$_POST['arr']:"";
        $array=json_decode($roleArr);
        $model=new roleModel();
        $res1=$model->deleRolePart($role_id);
        $res2=$model->inssetPerm($role_id,$array);
        echo $res2;
    }
    //获取插件信息
    public function getMenu(){
        $model=new roleModel();
        $data=$model->getAccessMenu();
        echo json_encode($data);
    }
}