<?php
/**
 * Created by PhpStorm.
 * User: 16146
 * Date: 2018/1/10
 * Time: 16:21
 */

class Page{
    private $allRows;//总页数
    private $onePage;//每页条数
    private $nowPage;//当前页码
    private $allPage;//总页数
    private $startRow;//开始行数
    private $last;//上一页
    private $next;//下一页
    private $url;//地址

    //构造函数
    public function __construct($allRows,$onePage,$url){
        $this->allRows = $allRows;
        $this->onePage = $onePage;
        $this->url = $url;

        $this->nowPage = isset($_GET['nowPage']) ? $_GET['nowPage'] : 1;
        $this->allPage = ceil($this->allRows/$this->onePage);//总页数
        $this->startRow = ($this->nowPage - 1) * $this->onePage;//开始查询条数
        $this->last = ($this->nowPage - 1) < 1 ? 1 : $this->nowPage - 1;//上一页
        $this->next = ($this->nowPage + 1) > $this->allPage ? $this->allPage : $this->nowPage + 1;	//下一页
    }

    public function getStart(){
        return $this->startRow;
    }

    public function getOne(){
        return $this->onePage;
    }

    public function showPage(){
        $str = "<span class='pageBtn'>共有{$this->allPage}页，当前{$this->nowPage}/{$this->allPage}页</span>";
        for($i=1;$i<=$this->allPage;$i++){
            $str.= "<a href='{$this->url}&nowPage={$i}' class='pageBtn'>{$i}</a>";
        }
        $str.="<a href='{$this->url}&nowPage=1' class='pageBtn'>[首页]</a><a href='{$this->url}&nowPage={$this->last}' class='pageBtn'>上一页</a>
				   <a href='{$this->url}&nowPage={$this->next}' class='pageBtn'>下一页</a><a href='{$this->url}&nowPage={$this->allPage}' class='pageBtn'>[末页]</a>";
        return $str;
    }
    public function getNum(){
        if($this->allPage == 0){
            return [
                'allRows'=>$this->allRows,
                'nowPage'=>1,
                'allPage'=>1,
                'last'=>1,
                'next'=>1
            ];
        }
        else{
            $pageNum=[];
            for ($i=1;$i<=$this->allPage;$i++){
                $pageNum[]=$i;
            }
            return [
                'allRows'=>$this->allRows,
                'nowPage'=>$this->nowPage,
                'allPage'=>$this->allPage,
                'last'=>$this->last,
                'next'=>$this->next,
                'pageNum'=>$pageNum
            ];
        }
    }
}