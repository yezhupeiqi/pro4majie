<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
    <link rel="stylesheet" href="./view/style/publicStyle.css" type="text/css">
    <link rel="stylesheet" href="./view/style/infomation.css" type="text/css">
    <script type="text/javascript" src="./view/jquery-easyui-1.5.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./view/jquery-easyui-1.5.4/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="./view/jquery-easyui-1.5.4/themes/default/easyui.css">
</head>
<body id="body">
<!--导航条-->
<?php
require_once "./view/public_head.php";
?>
<!--中间-->
<div id="contenter">
    <div class="safe">
        <div id="myCenterDiv">
            <div id="myCenterLeft">
                <!--个人信息-->
                <div id="personDiv">
                    <div id="personImg">
                        <?php echo "<img id=\"headimg\" src='{$data[0]['headimg']}'/>";?>
                    </div>
                    <div id="personInfo">
                        <b><p id="showuserName"></p></b>
                        <p>注册日期：<br/><span id="registTme"><?php echo "{$data[0]['registime']}"?></span></p>
                    </div>
                </div>
                <!--标签页导航-->
                <div >
                    <ul id="centerNav">
                        <li id="myInfo"><b>个人信息</b>
                            <ul id="infomation">
                                <li>我的等级</li>
                                <li>我的消息</li>
                                <li>我的收藏</li>
                                <li>浏览记录</li>
                                <li>我的评价</li>
                            </ul>
                        </li>
                        <li id="myChat"><b>我的聊天</b></li>
                        <li id="myMoney"><b>我的钱包</b></li>
                        <li id="order_for_goods"><b>我的订单</b></li>
                    </ul>
                </div>
            </div>
            <!--个人信息显示-->
            <div id="safe_content">
                <div id="infomation_cont"><b id="title">个人信息</b></div>
                <div id="infomation_show">
                    <div id="adress_content"></div>
                    <!--进页面看到的详情-->
                    <div id="infomationPage" style="display: none">
                        <p>账号：<b id="infomation_show_id"></b></p>
                        <p>密码：<b>已设置</b><input id="password" class="modInfo" type="button" value="修改"></p>
                        <p>昵称：<b id="infomation_show_nick"></b><input id="username" class="modInfo" type="button" value="修改"></p>
                        <!--<p>年龄：<b id="infomation_show_age"></b><input id="age" class="modInfo" type="button" value="修改"></p>
                        <p>性别：<b id="infomation_show_sex"></b><input id="sex" class="modInfo" type="button" value="修改"></p>-->
                        <p>收货地址：<b style="margin-left: 25%" id="infomation_show_address"></b><input id="address" class="modInfo" type="button" value="修改"></p>
                        <!--<p>邮箱：<b id="infomation_show_email"></b><input id="email" class="modInfo" type="button" value="修改"></p>-->
                        <p>支付密码：<b style="margin-left: 25%" id="infomation_show_paypsd"></b><input id="paypsd" class="modInfo" type="button" value="修改"></p>
                    </div>
                    <!--我的聊天-->
<!--                    <div id="myChat_cont">-->
<!--                        <div id="chatingName">-->
<!--                            <span>与客服<b id="chat_friendName" style="color: white"></b>聊天中...</span>-->
<!--                        </div>-->
<!--                        <div id="friedChat_cont" ></div>-->
<!--                        <div id="chat_text">-->
<!--                            <img src="./view/img/46.png" id="expression">-->
<!--                            <div id="chatCont" contenteditable="true"></div>-->
<!--                            <input id="go_chat" type="button" value="发送">-->
<!--                            <input id="chated" type="button" value="聊天记录">-->
<!--                        </div>-->
<!--                    </div>-->
                    <!--我的钱包-->
                    <div id="money">
                        <div id="money_balance">
                            <div style="padding: 10px 0">
                                余额：<b id="balance_cont" style="color: red"><?php echo "{$data[0]['balance']}"?></b>
                            </div>
                            <div>
                                <input id="balance" type="button" value="点击充值">
                            </div>
                        </div>
                        <!--常见问题-->
                        <div id="moneyQA">
                            <div style="margin:10px 0 0 38px;color: red;font-size: 20px"><b>常见问题</b></div>
                            <ul>
                                <li><b>余额如何使用？</b></li>
                                <li>A：余额可在淘宝特卖商城购物时使用，也可提现。</li>
                                <li><b>Q：提现支持哪些银行？</b></li>
                                <li>A：目前提现支持国内多家主流银行，包括：支付宝、中国工商银行、中国农业银行、中国								建设银行、中国交通银行、中国银行、招商银行。</li>
                                <li><b>Q：提现申请提交成功后，多久可以到账？</b></li>
                                <li>A：您的提现申请提交成功后，若提现至支付宝，钱款将在1天之内到账；若提现至银行，钱							款将在1-3天内到账。</li>
                            </ul>
                        </div>
                    </div>
                    <!--我的订单-->
                    <div id="OF_goods"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--充值的弹窗-->
<div id="dlg1" class="easyui-dialog" style="font-size:18px;width:400px;height:280px;padding:10px 20px;top:100px;"
     closed="true" buttons="#dlg-buttons">
    <div class="ftitle" id="ftitle">充值</div>
    <form id="fm" method="post">
        <div class="fitem fName">
            <label>请输入充值金额:</label>
            <input id="addMoney" min="1" type="number" name="firstname" class="easyui-validatebox" required="true" maxlength="8" style="border: 1px solid #333;height: 30px;line-height: 30px;font-size: 16px">
            <br/>
            <span style="color: orangered;margin-left: 8em">请输入正整数</span>
        </div>
    </form>
</div>
<div id="dlg-buttons">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="addMoney()">确定</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg1').dialog('close')">取消</a>
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
<script type="text/javascript" src="./view/js/dataOpr.js"></script>
<script type="text/javascript" src="./view/js/public.js"></script>
<script type="text/javascript" src="./view/js/infomation.js"></script>
<script type="text/javascript" src="./view/js/plug-in.js"></script>
<script type="text/javascript" src="./view/jquery-easyui-1.5.4/jquery.easyui.min.js"></script>
<script type="text/javascript" src="./view/jquery-easyui-1.5.4/locale/easyui-lang-zh_CN.js"></script>
</html>