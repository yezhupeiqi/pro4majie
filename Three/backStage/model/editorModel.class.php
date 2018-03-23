<?php

class editorModel extends Modle
{
    //获取编辑数据
    public function getMcs($mcsid){
        $condition=['s_mcsid'=>$mcsid];
        $data=$this->selectWhere(s_merchandise,$condition);
        return  $data;
    }
    public function addSentry($name,$path,$price,$invent,$note,$mcsid){
        if($path != ''){
            $sql="UPDATE s_merchandise SET s_mcsidname='{$name}',s_mcsimg='{$path}',s_originalprice={$price},s_alltory={$invent},s_note='{$note}' WHERE s_mcsid={$mcsid}";
            $res=$this->addData($sql);
            return $res;
        }
        else{
            $sql="UPDATE s_merchandise SET s_mcsidname='{$name}',s_originalprice={$price},s_alltory={$invent},s_note='{$note}' WHERE s_mcsid={$mcsid}";
            $res=$this->addData($sql);
            return $res;
        }

    }

}