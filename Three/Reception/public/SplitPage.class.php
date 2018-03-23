<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/1/10
 * Time: 16:22
 */

class SplitPage
{
    private $allrows; //总条数
    private $onepage; //每页条数
    private $nowpage; //当前页码
    private $allpage; //总页数
    private $startPage; //开始行数
    private $lastpage; //上一页
    private $nextpage; //下一页
    private $url;
    public function __construct($allrows,$onepage,$url)
    {
        $this->allrows = $allrows;
        $this->onepage = $onepage;
        $this->url = $url;
        $this->nowpage = isset($_GET['nowPage'])?$_GET['nowPage']:1; //当前页码
        $this->allpage = ceil($this->allrows/$this->onepage);//总页数
        $this->startPage = ($this->nowpage -1)*$this->onepage;//开始查询
        $this->lastpage = ($this->nowpage - 1)<1?1:$this->nowpage-1;//上一页
        $this->nextpage = ($this->nowpage + 1)<$this->allpage?$this->nowpage + 1:$this->allpage;//下一页
    }
    //返回开始查询的条数
    public function startPage(){
        return $this->startPage;
    }
    //每页显示的条数
    public function onePage(){
        return $this->onepage;
    }
    //显示页码操作
    public function showPage(){
        $str = "共有{$this->allpage}页，当前{$this->nowpage}页";
        $str.= "<a href='{$this->url}?nowpage={$this->lastpage}'>上一页</a><a href='{$this->url}?nowpage={$this->nextpage}'>下一页</a>";
        return $str;
    }
    //获取分页信息
    public function getPage(){
        $arr = ['nowPage'=>$this->nowpage,'last'=>$this->lastpage,'next'=>$this->nextpage,'allPage'=>$this->allpage];
        return $arr;
    }
}