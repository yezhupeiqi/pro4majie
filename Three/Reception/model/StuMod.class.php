<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/1/12
 * Time: 11:25
 */

class StuMod
{
    public function stuinfo(){
        require_once "./public/Database.class.php";
        require_once "./config/config.php";
        require_once "./public/SplitPage.class.php";
        $db = Database::linkDB($config);
        $sql = "select count(*) count from students";
        $count = $db->select($sql);
        $allRows = $count[0]['count']; //总条数
        $onePage = 4; //每页条数
        $page = new SplitPage($allRows,$onePage,'stuManage.php');
        $sql2 = "select * from students limit {$page->startPage()},{$page->onePage()};";
        $data = $db->select($sql2);
        include './view/menu/StuManage.php';
        echo $page->showPage();
    }
}