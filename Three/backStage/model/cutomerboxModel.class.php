<?php

class cutomerboxModel extends Modle
{
    public function getSaffe(){
        $sql="select * FROM staff a INNER JOIN role b on a.s_role = b.r_id WHERE  b.r_name='客服'";
        $data=$this->getNaxdata($sql);
        return  $data;
    }



}