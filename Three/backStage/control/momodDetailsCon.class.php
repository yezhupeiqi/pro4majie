<?php

class momodDetailsCon extends Contorl
{
    public function doaction($c){
        if($c == 'mcsDetails'){
            $this->mcsDetails();
        }
        else if($c == 'addNMcs'){
            $this->addNMcs();
        }
    }

    //详情
    public function mcsDetails(){
        $mcsid=isset($_GET['id'])?$_GET['id']:"";
        $model=new detailsModel();
        $data=$model->getMcs($mcsid);
        $this->show('./view/momodDetails.php',$data);
    }
}