<?php

session_start();
$nickname = isset($_SESSION['nickname'])?$_SESSION['nickname']:'';
$headimg = isset($_SESSION['headimg'])?$_SESSION['headimg']:'';
echo "<!--登陆注册-->
<div id=\"shade\">
    <!--登陆-->
    <div id=\"login\">
        <div class=\"registration_name\" style='margin-bottom: -20px'>
            <b>登录</b>
        </div>
        <div id=\"login_01\">
            <form id=\"lg_form\" method=\"post\" enctype=\"multipart/form-data\">
                <div id=\"login_type\" style=\"height: 30px;margin-bottom: 15px\"></div>
                <p class=\"login_ipt\"><img src=\"./view/images/userlogin.jpg\">
                    <input id=\"userid\" name=\"id\" type=\"text\" value=\"10001\" placeholder=\"请输入账号\">
                </p>
                <p id=\"userid_prompt\" class=\"warning\"></p>
                <p class=\"login_ipt\"><img src=\"./view/images/loginpsd.jpg\">
                    <input id=\"userpsd\" name=\"pwd\" type=\"password\" value=\"123\" placeholder=\"请输入密码\">
                </p>
                <p id=\"userpsd_prompt\" class=\"warning\" style=\"margin-bottom: 10px\"></p>
                <!--滑块验证-->
                <div id=\"slider2\" class=\"slider\"></div>
                <input id=\"logining\" class=\"loginrel\" type=\"button\" value=\"登陆\">
                <input id=\"loginover\" class=\"loginrel\" type=\"button\" value=\"关闭\">
            </form>
        </div>
    </div>
    <!--注册-->
    <div id=\"regist\">
        <div class=\"registration_name\">
            <b id=\"registration\">注册</b>
        </div>
        <div>
            <form id=\"re_form\" method=\"post\" enctype=\"multipart/form-data\">
                <!--账号-->
               <div style=\"margin-left: -14px\">用户名：<input name=\"id\" id=\"userName\" class=\"registration_ipt\" value=\"10000\"
                       maxlength=\"8\"  type=\"text\" placeholder=\"请输入用户名（4-8位英文字母或数字）\"></div>
                <div class=\"registration_ipt_text\">
                    <span id=\"prompt_1\"></span>
                </div>
                <!--密码-->
                密码：<input name=\"pwd\" id=\"regPsw\" class=\"registration_ipt\" value=\"123\" type=\"password\" placeholder=\"请输入密码（6-12位英文字母或数字）\">
                <div class=\"registration_ipt_text\">
                    <span id=\"prompt_2\"></span>
                </div>
                <!--重复密码-->
                <div style=\"margin-left: -31px\">重复密码：<input name=\"rerRePsw\" id=\"rerRePsw\" class=\"registration_ipt\" value=\"123\" type=\"password\" placeholder=\"请重新输入密码（6-12位英文字母或数字）\"></div>
                <div class=\"registration_ipt_text\">
                    <span  id=\"prompt_3\"></span>
                </div>
                <!--昵称-->
                <div style=\"margin-left: -31px\">支付密码：<input name=\"userName\" id=\"payPsw\" class=\"registration_ipt\" value=\"123\" type=\"password\" placeholder=\"请输入支付密码\"></div>
                <div class=\"registration_ipt_text\">
                    <span id=\"prompt_4\"></span>
                </div>
            </form>
            <div class=\"registration_button\">
                <button id=\"button_registration\" class=\"registration_button_content\">注册</button>
                <button id=\"registration_over\" class=\"registration_button_content\">关闭</button>
            </div>
        </div>
    </div>
</div>
<!--导航条-->
<div id=\"nav\">
    <div id=\"logo\">
        <img src=\"./view/images/logo.png\">
    </div>
    <div id=\"nav_cont\">
        <ul id=\"nav_cont_ul\">
            <li id='pageHome'>首页</li>
            <!--<li>品牌抢购</li>-->
            <li id=\"infomation\">个人中心</li>
        </ul>
        <img src=\"./view/images/shop-nav28.png\">";
        if($nickname != ''){
            echo " <div id=\"name_show\">
            欢迎您：<p><img id='headimg' src='$headimg'><span id=\"nav_name\">$nickname</span>
            <input id=\"zx\" type=\"button\" value=\"注销\"></p>
        </div>";
        }else{
            echo "<div id=\"login_regist\">
            <span id=\"really_login\">亲，请登录</span>
            <span id=\"really_registration\">免费注册</span>
        </div>";
        }
   echo "</div>";
echo "</div>";
?>