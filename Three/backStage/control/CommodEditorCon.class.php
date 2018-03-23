<?php

class CommodEditorCon extends Contorl
{
    public function doaction($c){
        if($c == 'mcsEditor'){
            $this->mcsEditor();
        }
        else if($c == 'addNMcs'){
            $this->addNMcs();
        }
    }

    //编辑
    public function mcsEditor(){
        $mcsid=isset($_GET['id'])?$_GET['id']:"";
        $model=new editorModel();
        $data=$model->getMcs($mcsid);
        $this->show('./view/CommodEditor.php',$data);
    }
    //修改
    public function addNMcs(){
        $name=isset($_POST['tradeName'])?$_POST['tradeName']:"";//商品名
        $price=isset($_POST['price'])?$_POST['price']:"";//价格
        $invent=isset($_POST['invent'])?$_POST['invent']:"";//库存
        $note=isset($_POST['note'])?$_POST['note']:"";//备注
        $mcsid=isset($_POST['mcs'])?$_POST['mcs']:"";//ID
        $path='';
        //商品图片
        if($_FILES['file']['error']==0) {
            $allow_file = explode("|", "gif|jpg|png"); //允许上传的文件类型组
            $new_upload_file_ext = strtolower(end(explode(".", $_FILES['file']['name']))); //取得被.隔开的最后字符串
            if (!in_array($new_upload_file_ext, $allow_file)) { //如果不在组类，提示处理
                echo '<script>alert("图片类型出错!")</script>';//图片类型出错
                $this->show('./view/CommodEditor.php');
            }
            else {
                $path = './view/images/' . $_FILES['file']['name'];//商品图片路径
                $path = iconv("utf-8", "gbk", $path);
                move_uploaded_file($_FILES['file']['tmp_name'], $path);
            }
        }
        if($name != ''&&$price != ''&&$invent != ''&&$note != ''){
            $model=new editorModel();
            $res=$model->addSentry($name,$path,$price,$invent,$note,$mcsid);
            if($res == '1'){
                echo '<script>alert("发布成功!")</script>';
                $this->show('./view/mcsinform.php');
            }
            else{
                echo '<script>alert("发布失败!")</script>';
                $this->show('./view/mcsinform.php');
            }
        }
        else{
            echo '<script>alert("发布的内容不能为空!")</script>';
            $this->show('./view/mcsinform.php');
        }

    }
}