<?php

class sentryModel extends Modle
{
    public function addSentry($name,$typeid,$path,$price,$invent,$note,$check){
        if($check == '上架'){
            $sql="INSERT INTO s_merchandise(s_mcsidname,s_typeid,s_mcsimg,s_originalprice,s_secondprice,s_alltory,s_surplus,s_num,s_startdates,s_stopdates,s_secondid,s_note,s_shelves,s_releaseTime,s_mcsState,s_publishType)VALUES('{$name}','{$typeid}','{$path}',0,{$price},{$invent},0,0,'','',1,'{$note}',NOW(),NOW(),'上架','普通')";
            $res=$this->addData($sql);
            return  $res;
        }
        else{
            $sql="INSERT INTO s_merchandise(s_mcsidname,s_typeid,s_mcsimg,s_originalprice,s_secondprice,s_alltory,s_surplus,s_num,s_startdates,s_stopdates,s_secondid,s_note,s_shelves,s_releaseTime,s_mcsState,s_publishType)VALUES('{$name}','{$typeid}','{$path}',0,{$price},{$invent},0,0,'','',1,'{$note}','',NOW(),'下架','普通')";
            $res=$this->addData($sql);
            return  $res;
        }

    }
    public function addSconed($name,$typeid,$startTime,$endTime,$sId,$orPrice,$price,$invent,$purchas,$note,$path,$check){
        if($check == '上架'){
            $sql="INSERT INTO s_merchandise(s_mcsidname,s_typeid,s_mcsimg,s_originalprice,s_secondprice,s_alltory,s_surplus,s_num,s_startdates,s_stopdates,s_secondid,s_note,s_shelves,s_releaseTime,s_mcsState,s_publishType)VALUES('{$name}','{$typeid}','{$path}',{$orPrice},{$price},{$invent},0,'{$purchas}','{$startTime}','{$endTime}',{$sId},'{$note}','',NOW(),'上架','秒杀')";
            $res=$this->addData($sql);
            return  $res;
        }
        else{
            $sql="INSERT INTO s_merchandise(s_mcsidname,s_typeid,s_mcsimg,s_originalprice,s_secondprice,s_alltory,s_surplus,s_num,s_startdates,s_stopdates,s_secondid,s_note,s_shelves,s_releaseTime,s_mcsState,s_publishType)VALUES('{$name}','{$typeid}','{$path}',{$orPrice},{$price},{$invent},0,'{$purchas}','{$startTime}','{$endTime}',{$sId},'{$note}','',NOW(),'未上架','秒杀')";
            $res=$this->addData($sql);
            return  $res;
        }
    }
}