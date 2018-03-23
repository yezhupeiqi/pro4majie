<?php


class Code
{
    private $width;
    private $height;
    private $size;
    private $img;
    private $font;
    //构造函数
    public function __construct($width,$height,$size=4)
    {
        $this->width=$width;
        $this->height=$height;
        $this->size=$size;
        imagecreate(200,50);
    }
    //析构函数
    private function __destruct()
    {
        // TODO: Implement __destruct() method.
        imagedestroy($this->img);
    }

    //生成画板
    private function createImg(){
        $this->img=imagecreate($this->width,$this->height);
        imagecolorallocate($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    }
    //生成文字
    private function createFont(){
        for ($i=0;$i<$this->size;$i++){
            $this->font.=chr(mt_rand(97,122));
        }
    }
    //插入文字
    private function insertFont(){
        for($i=0;$i<strlen($this->font);$i++){
            $color=imagecolorallocate($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagettftext($this->img,30,mt_rand(-45,45),($i*50)+30,mt_rand(25,35),$color,'../public/code/RAVIE.TTF',$this->font[$i]);
        }
    }
    public function getcode(){
        return $this->font;
    }
    //
    private function addX(){

    }
    //输出
    public function outPut(){
        //清除页面内容
        ob_clean();
        header("Content-type: image/png");
        $this->createImg();
        $this->createFont();
        $this->insertFont();
        imagepng($this->img);
    }


}