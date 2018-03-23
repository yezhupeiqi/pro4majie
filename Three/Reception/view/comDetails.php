<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品详情</title>
    <link rel="stylesheet" href="./view/style/publicStyle.css" type="text/css">
    <link rel="stylesheet" href="./view/style/comDetails.css" type="text/css">
    <link rel="stylesheet" href="./view/style/jquery.slider.css" />
</head>
<body>

<!--导航条-->
<?php
require_once "./view/public_head.php";
?>
<!--商品详情-->
<div class="safe">
    <div id="comDetails"><b>商品详情</b></div>
</div>
<!--商品详情内容-->
<div class="safe">
    <div id="comDetails_cont">
        <!--左边图片详情-->
        <div id="com_img">
            <div>
                <!--大图显示-->
                <?php
                    echo "<img id=\"com_img_b\" style=\"width:407px;height: 418px;border-bottom: 1px solid black\" src='{$data[0]['s_mcsimg']}'>";
                    echo "<!--小图-->
                    <div id=\"com_img_s\">
                        <img id=\"com_img_s1\" src='{$data[0]['s_mcsimg']}'>
                        <img id=\"com_img_s2\" src='{$data[0]['s_mcsimg']}'>
                        <img id=\"com_img_s3\" src='{$data[0]['s_mcsimg']}'>
                        <img id=\"com_img_s4\" src='{$data[0]['s_mcsimg']}'>
                    </div>"
                ?>
            </div>
            <div id="com_footer">
                <span>
                    <img style="width:15px;height: 15px" src="./view/images/timg.jpg">分享
                </span>
                <span style="margin: 0 50px">
                    <img style="width:17px;height: 17px" src="./view/images/collect.jpg">收藏
                </span>
                <span>
                    举报
                </span>
            </div>
        </div>
        <!--右边文字详情-->
        <div id="buy_com">
            <!--商品信息-->
            <div id="com_name">
                <!--基本信息区-->
                <div id="com_basic">
                    <b id="comDetails_name" style="font-size: 20px"><?php echo $data[0]['s_mcsidname']?></b>
                    <p id="synopsis" style="color: red "></p>
                    <div id="com_price">
                        <p style="font-size: 20px;margin-top: 10px">促销价：￥<span id="price" style="color: red;font-size: 30px"><?php echo $data[0]['s_originalprice'] ?></span></p>
                        <p style="font-size: 15px;margin-top: 10px">月销量：<span id="payover">12</span>累计评价：<span id="evaluate">123</span>送积分：100</p>
                        <p style="margin-top: 20px">还剩<b id="surplus"><?php echo $data[0]['s_surplus']?></b>件</p>
                    </div>
                </div>
                <!--秒杀按钮-->
                <div id="secKill_button">
                    <!--购买数量-->
                    <div id="com_number">
                        <span>购买数量</span>
                        <input id="buyNum" type="number" min="1" value="1">
                    </div>
                    <!--限购-->
<!--                    <p style="margin: 0 auto;width: 40%">(限购：每人<b style="color: red" id="limitbuy"></b>件)</p>-->
                    <!--防暴力刷新-->
                    <div id="slide">
                        <div id="slider2" class="slider"></div>
                    </div>
                    <!--秒杀按钮-->
                    <div style="width: 100%;text-align: center;margin: 10px 0px">
                        <input id="secKill" type="button" goodsid ="<?php echo"{$data[0]['s_mcsid']}" ?>"  value="立即购买">
                    </div>
                    <!--秒杀规则-->
                    <div id="secKill_rule">
                        <p>1.请提前<span style="color: red">绑定手机号></span>。</p>
                        <p>2.秒杀将直接默认<span style="color: red">收货地址></span>，请提前设置正确。</p>
                        <p>3.在防黄牛的路上，我们一直在努力，所以需要您拖动滑块完成验证，和我们一起防黄牛！<span style="color: red">提前练习秒杀速度></span>。</p>
                        <p>4.秒杀成功后，请您在<span style="color: red">30分钟内</span>付款，过期将自动取消订单。</p>
                    </div>
                </div>
            </div>
            <!--商家和客服-->
            <div id="business_mation">
                <!--商家信息-->
                <div id="business"></div>
                <!--客服信息-->
                <div id="custom_service"></div>
            </div>
        </div>
        <!--详情、评论、成交记录-->
        <div id="details">
            <div id="content">
                <input type="button" value="宝贝详情">
                <input type="button" value="评价" style="box-shadow: 2px 2px black">
                <input type="button" value="成交记录">
            </div>
            <div id="details_cont"></div>
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
<script type="text/javascript" src="./view/js/md5.js"></script>
<script type="text/javascript" src="./view/js/jquery.slider.min.js"></script>
<script type="text/javascript">
    var sliderRe1;
    $("#slider1").slider({
        width: 340, // width
        height: 40, // height
        sliderBg: "rgb(134, 134, 131)", // 滑块背景颜色
        color: "#fff", // 文字颜色
        fontSize: 14, // 文字大小
        bgColor: "#33CC00", // 背景颜色
        textMsg: "按住滑块，拖拽验证", // 提示文字
        successMsg: "验证通过", // 验证成功提示文字
        successColor: "white", // 滑块验证成功提示文字颜色
        time: 400, // 返回时间
        callback: function(result) { // 回调函数，true(成功),false(失败)
            sliderRe = result;
            $("#result2").text(result);
        }
    });
    var sliderRe2;
    $("#slider2").slider({
        width: 340, // width
        height: 40, // height
        sliderBg: "rgb(134, 134, 131)", // 滑块背景颜色
        color: "#fff", // 文字颜色
        fontSize: 14, // 文字大小
        bgColor: "#33CC00", // 背景颜色
        textMsg: "按住滑块，拖拽验证", // 提示文字
        successMsg: "验证通过", // 验证成功提示文字
        successColor: "white", // 滑块验证成功提示文字颜色
        time: 400, // 返回时间
        callback: function(result) { // 回调函数，true(成功),false(失败)
            sliderRe = result;
            $("#result2").text(result);
        }
    });
</script>
<script type="text/javascript" src="./view/js/public.js"></script>
<script type="text/javascript" src="./view/js/comDetails.js"></script>
<script type="text/javascript" src="./view/js/plug-in.js"></script>
</html>