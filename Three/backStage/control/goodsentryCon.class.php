<?php

class goodsentryCon extends Contorl
{
    public function doaction($c){
        if($c == 'showcom'){
            $this->showcom();
        }
        else  if($c == 'addNMcs'){
            $this->addNMcs();
        }
        else  if($c == 'addSMcs'){
            $this->addSMcs();
        }



    }

    public function showcom(){
        $this->show('./view/goodsentry.php');
    }
    //添加普通商品
    public function addNMcs(){
        $name=isset($_POST['tradeName'])?$_POST['tradeName']:"";//商品名
        $price=isset($_POST['price'])?$_POST['price']:"";//价格
        $typeid=isset($_POST['typeid'])?$_POST['typeid']:"";//类型
        $invent=isset($_POST['invent'])?$_POST['invent']:"";//库存
        $note=isset($_POST['note'])?$_POST['note']:"";//备注
        $check=isset($_POST['check'])?$_POST['check']:"";//上架
        //商品图片
        if($_FILES['file']['error']==0) {
            $allow_file = explode("|", "gif|jpg|png"); //允许上传的文件类型组
            $new_upload_file_ext = strtolower(end(explode(".", $_FILES['file']['name']))); //取得被.隔开的最后字符串
            if (!in_array($new_upload_file_ext, $allow_file)) { //如果不在组类，提示处理
                echo '<script>alert("图片类型出错!")</script>';//图片类型出错
                $this->show('./view/goodsentry.php');
            } else {
                $path = 'view/images/' . $_FILES['file']['name'];//商品图片路径
                $path = iconv("utf-8", "gbk", $path);
                move_uploaded_file($_FILES['file']['tmp_name'], $path);
            }
        }
        else{
            echo '<script>alert("图片出错!")</script>';//图片出错
            $this->show('./view/goodsentry.php');
        }
        if($name != ''&&$price != ''&&$typeid != ''&&$invent != ''&&$note != ''&&$path != ''){
            $model=new sentryModel();
            $res=$model->addSentry($name,$typeid,$path,$price,$invent,$note,$check);
            if($res == '1'){
                echo '<script>alert("发布成功!")</script>';
                $this->show('./view/goodsentry.php');
            }
            else{
                echo '<script>alert("发布失败!")</script>';
                $this->show('./view/goodsentry.php');
            }
        }
        else{
            echo '<script>alert("发布的内容不能为空!")</script>';
            $this->show('./view/goodsentry.php');
        }

    }
    //添加秒杀商品
    public function addSMcs(){
        $name=isset($_POST['tradeName'])?$_POST['tradeName']:"";//商品名
        $typeid=isset($_POST['typeid'])?$_POST['typeid']:"";//类型
        $startTime=isset($_POST['startTime'])?$_POST['startTime']:"";//开始时间
        $endTime=isset($_POST['endTime'])?$_POST['endTime']:"";//结束时间
        $sId=isset($_POST['sId'])?$_POST['sId']:"";//秒杀时间id
        $orPrice=isset($_POST['orPrice'])?$_POST['orPrice']:"";//原价
        $price=isset($_POST['price'])?$_POST['price']:"";//促销价格
        $invent=isset($_POST['invent'])?$_POST['invent']:"";//库存
        $purchas=isset($_POST['purchas'])?$_POST['purchas']:"";//限购数量
        $note=isset($_POST['note'])?$_POST['note']:"";//备注
        $check=isset($_POST['check'])?$_POST['check']:"";//上架
        //商品图片
        if($_FILES['file']['error']==0) {
            $allow_file = explode("|", "gif|jpg|png"); //允许上传的文件类型组
            $new_upload_file_ext = strtolower(end(explode(".", $_FILES['file']['name']))); //取得被.隔开的最后字符串
            if (!in_array($new_upload_file_ext, $allow_file)) { //如果不在组类，提示处理
                echo '<script>alert("图片类型出错!")</script>';//图片类型出错
                $this->show('./view/goodsentry.php');
            } else {
                $path = 'view/images/' . $_FILES['file']['name'];//商品图片路径
                $path = iconv("utf-8", "gbk", $path);
                move_uploaded_file($_FILES['file']['tmp_name'], $path);
            }
        }
        else{
            echo '<script>alert("图片出错!")</script>';//图片出错
            $this->show('./view/goodsentry.php');
        }
        if($name != ''&&$typeid != ''&&$startTime != ''&&$endTime != ''&&$sId!= ''&&$orPrice != ''&&$price != ''&&$invent != ''&&$purchas != ''&&$note != ''&&$path != ''){
            $model=new sentryModel();
            $res=$model->addSconed($name,$typeid,$startTime,$endTime,$sId,$orPrice,$price,$invent,$purchas,$note,$path,$check);
            if($res == '1'){
                echo '<script>alert("发布成功!")</script>';
                $this->show('./view/goodsentry.php');
            }
            else{
                echo '<script>alert("发布失败!")</script>';
                $this->show('./view/goodsentry.php');
            }

        }
        else{
            echo '<script>alert("发布的内容不能为空!")</script>';
            $this->show('./view/goodsentry.php');
        }
    }
}