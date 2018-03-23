<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>电商秒杀主页</title>
    <link rel="stylesheet" href="./view/style/publicStyle.css" type="text/css">
    <link rel="stylesheet" href="./view/style/jquery.slider.css" type="text/css"/>
    <link rel="stylesheet" href="./view/style/homepage.css" type="text/css">
</head>
<body>
<?php
require_once "./view/public_head.php";
?>
<!--banner轮播-->
<div class="safe" style="background-color: #ddd">
    <div id="banner_box">
        <div id="banner">
            <img src="./view/images/banner_1.jpg"><img src="./view/images/banner_2.jpg"><img src="./view/images/banner_3.jpg">
        </div>
    </div>
</div>
<!--秒杀倒计时-->
<div class="safe">
    <div id="count_downbox">
        <div id="countDown_L">
            <div id="count_down">
                <img src="./view/images/shop-nav_50.gif">
                <img src="./view/images/shop-nav_52.gif">
            </div>
            <!--动态显示商品-->
            <div id="commodity_show">
                <!--商品显示-->
                <div class="goodsBox">
                    <div>
                    	<!--./view/img/mz1.jpg-->
                        <img class="goodsImg" src="">
                    </div>
                    <div class="goodsInfo">
                        <h4>屈臣氏超薄嫩白巨补水面膜</h4>
                        <p class="goodsTxt">正品专卖</p>
                        <p class="priceP">
                            <span>￥</span><span id="price">1880</span><span>元</span>
                        </p>
                        <p class="numBox">
                            <span class="number">已售<span>1</span>/<span>100</span>件</span><span class="buy">购买</span>
                        </p>
                    </div>
                </div>
                <!--分页-->
                <p id="page_nameber"></p>
            </div>
        </div>
        <div id="countDown_R">
            <!--荣誉墙-->
            <div id="countDown_Rcontent">
                <img src="./view/images/honor_wall.png">
                <div id="honor" >
                    <div id="wall">

                    </div>
                    <div id="wall2">

                    </div>
                </div>
            </div>
            <!--客服-->
            <div id="service">
                <div id="service_img">
                    <img src="./view/images/server_ico.gif">
                </div>
                <div id="service_button">
                    <input id="fund_service" type="button" value="联系客服">
                </div>
            </div>
        </div>
    </div>
</div>
<!--页脚-->
<div id="footer">
    <p>关于天猫 帮助中心 开放平台 诚聘英才 联系我们 网站合作 法律声明及隐私权政策 知识产权 廉正举报</p>
    <p style="font-size: 15px">阿里巴巴集团| 淘宝网 | 天猫 | 聚划算 | 全球速卖通 | 阿里巴巴国际交易市场| 1688 | 阿里妈妈 | 飞猪 | 阿里云计算 | YunOS | 阿里通信 | 万网 | 高德 | UC | 友盟 | 虾米 | 阿里星球 | 来往 | 钉钉 | 支付宝</p>
    <p>增值电信业务经营许可证： 浙B2-20110446 网络文化经营许可证：浙网文[2015]0295-065号 12318举报</p>
    <p>互联网药品信息服务资质证书编号：浙-（经营性）-2017-0005   浙公网安备 33010002000120号</p>
    <p>© 2003-2017 TMALL.COM 版权所有</p>
</div>
</body>
<script type="text/javascript" src="./view/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script type="text/javascript" src="./view/js/jquery.slider.min.js"></script>
<script type="text/javascript" src="./view/js/plug-in.js"></script>
<!--<script type="text/javascript">-->
    <!--var sliderRe;-->
    <!--$("#slider2").slider({-->
        <!--width: 340, // width-->
        <!--height: 40, // height-->
        <!--sliderBg: "rgb(134, 134, 131)", // 滑块背景颜色-->
        <!--color: "#fff", // 文字颜色-->
        <!--fontSize: 14, // 文字大小-->
        <!--bgColor: "#33CC00", // 背景颜色-->
        <!--textMsg: "按住滑块，拖拽验证", // 提示文字-->
        <!--successMsg: "验证通过", // 验证成功提示文字-->
        <!--successColor: "white", // 滑块验证成功提示文字颜色-->
        <!--time: 400, // 返回时间-->
        <!--callback: function(result) { // 回调函数，true(成功),false(失败)-->
            <!--sliderRe = result;-->
            <!--$("#result2").text(result);-->
        <!--}-->
    <!--});-->
<!--</script>-->
<script type="text/javascript" src="./view/js/dataOpr.js"></script>
<script type="text/javascript" src="./view/js/homepage.js"></script>
<script type="text/javascript" src="./view/js/public.js"></script>
</html>