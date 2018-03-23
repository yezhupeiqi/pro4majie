//只能输入数字正则
function regu1(value){
    //正则判断
    var regu = /^[0-9]+$/;
    var re = new RegExp(regu);
    var rs = re.test(value);
    return rs;
}
//只能输入字母数字下划线正则
function regu2(value){
    //正则判断
    var regu = /^[0-9a-zA-Z_]{1,}$/;
    var re = new RegExp(regu);
    var rs = re.test(value);
    return rs;
}
//只能输入中英文数字的正则
function regNameRs(value){
    var regu = /^[\u4e00-\u9fa5_a-zA-Z0-9]+$/;
    var re = new RegExp(regu);
    var rs = re.test(value);
    return rs;
}
//注册--用户名失焦
$("#userName").blur(function(){
    var userName = $("#userName").val();
    var rs = regNameRs(userName);
    if(!rs)
    {
        $('#prompt_1').html("× 请输入中文、数字或英文！");
        $('#prompt_1').css("color","red");
        //输入非法字符，清空输入框
        $("#regNick").val("");
    }else {
        $('#prompt_1').html("√ 用户名合法！");
        $('#prompt_1').css("color","green");
    }
});
//注册--密码失焦
$("#regPsw").blur(function(){
    var psw = $(event.target).val();
    var pswRs = regu2(psw);
    if(!pswRs){
        $('#prompt_2').html("× 请输入英文、数字或下划线！");
        $('#prompt_2').css("color","red");
    }else {
        $('#prompt_2').html("√ 输入合法");
        $('#prompt_2').css("color","green");
    }
});
//注册--确认密码失焦
$("#rerRePsw").blur(function(){
    var rePsw = $.trim($(event.target).val());
    var psw = $("#regPsw").val();
    if(rePsw != '' && rePsw == psw){
        $('#prompt_3').html("√ 两次密码输入一致！");
        $('#prompt_3').css("color","green");
    }else {
        $('#prompt_3').html("× 两次密码输入不一致！");
        $('#prompt_3').css("color","red");
    }
});
//支付密码失焦验证
$("#payPsw").blur(function(){
    var psw = $(event.target).val();
    var pswRs = regu2(psw);
    if(!pswRs){
        $('#prompt_4').html("× 请输入英文、数字或下划线！");
        $('#prompt_4').css("color","red");
    }else {
        $('#prompt_4').html("√ 输入合法");
        $('#prompt_4').css("color","green");
    }
});
// 注册
$("#button_registration").click(function () {
    var $userName = $.trim($("#userName").val());//用户名
    var $psw = $.trim($("#regPsw").val());//密码
    var $rePsw = $.trim($("#rerRePsw").val());//重复密码
    var $payPsw = $.trim($("#payPsw").val());//支付密码
    var psyPswReg = regu2($payPsw);
    var pswReg = regu2($psw);
    var rePswReg = regu2($rePsw);
    var userNameReg = regNameRs($userName);
    if($userName != '' && $psw != '' && $rePsw != '' && $payPsw != ''){
        if(!userNameReg){//用户名正则
            $.Pop('用户名不合法，请使用中文、英文或数字','alert');
        }else if(!pswReg){//密码正则
            $.Pop('密码不合法，请使用英文、数字或下划线','alert');
        }else if($psw != $rePsw){
            $.Pop('两次密码输入不一致', 'alert');
        }else if(!psyPswReg){//支付密码正则
            $.Pop('支付密码不合法，请使用英文、数字或下划线','alert');
        }else if(userNameReg && pswReg && ($psw == $rePsw)&&psyPswReg){//输入合法 发送注册请求
            $.ajax({
                type: 'post',
                url: "index.php?type=RegistORlogin&cont=regist",
                data:{nickname:$userName,userpsd:$psw,payPsd:$payPsw},
                success: function restult(res){
                   if(res==0){
                       $.Pop("系统繁忙，请稍后重试！");
                   }else{
//                 	console.log(res);
                       $.Pop("注册成功！账号："+res+",是否前往登录？",'confirm', function(){
                            $("#regist").hide();
                            $("#login").show();
                       });
                   }
                }
            })
        }
    }else {
        $.Pop('信息不完善，请填写完整！','alert');
    }
});
//登录--账号失焦
$("#userid").blur(function(){
    var userid = $("#userid").val();
    var useridRs = regu1(userid);
    if(!useridRs){
        $('#userid_prompt').html("× 请输入数字！");
        $('#userid_prompt').css("color","red");
    }else{
        $('#userid_prompt').html("√ 用户名合法！");
        $('#userid_prompt').css("color","green");
    }
})
//登录---密码失焦
$("#userpsd").blur(function(){
    var userpsd = $("#userpsd").val();
    var userpsdRs = regu2(userpsd);
    if(!userpsdRs){
        $('#userpsd_prompt').html("× 请输入英文、数字或下划线！");
        $('#userpsd_prompt').css("color","red");
    }else {
        $('#userpsd_prompt').html("√ 输入合法");
        $('#userpsd_prompt').css("color","green");
    }
})
//登录
$("#logining").click(function () {
    var userid = $("#userid").val();
    var userpsd = $("#userpsd").val();
    //正则判断
    var useridRs = regu1(userid);
    if(!useridRs){
        $('#userid_prompt').html("× 请输入数字！");
        $('#userid_prompt').css("color","green");
    }else{
        $('#userid_prompt').html("√ 用户名合法！");
        $('#userid_prompt').css("color","green");
    }
    var userpsdRs = regu2(userpsd);
    if(!userpsdRs){
        $('#userpsd_prompt').html("× 请输入英文、数字或下划线！");
        $('#userpsd_prompt').css("color","red");
    }else {
        $('#userpsd_prompt').html("√ 输入合法");
        $('#userpsd_prompt').css("color","green");
    }
    if(!sliderRe){
        $.Pop('请拖动滑块向右边拖拽！');
    }else if(useridRs && userpsdRs && sliderRe){
        $.ajax({
            type: 'post',
            url: "index.php?type=RegistORlogin&cont=login",
            data:{userid:userid,userpsd: userpsd},
            success: function(res){
                if(res == 0){
                    $.Pop('账号或密码错误！请重新输入！','alert');
                }else if(res == -1){
                    $.Pop('该账号已被锁定，暂时无法登录！请联系客服处理！');
                }else {
                    var res = JSON.parse(res);
//                  console.log(res);
                    $.Pop('登录成功','alert',function(){
                        $("#shade").hide();
                        $("#login_regist").hide();
                        $("#name_show").show();
                        $("#headimg").attr('src',''+res[0]['headimg']+'');
                        $("#nav_name").text(res[0]['nickname']);
                        location.reload();
                    });
                }
            }
        })
    }
});
$("#zx").click(function () {
    $.Pop('是否确认退出当前账号？','confirm',function(){
        $.ajax({
            type: 'get',
            url: "./index.php?type=RegistORlogin&cont=logout",
            success: function (res) {
                if(res ==1){
                    $.Pop('已退出当前账号','alert',function(){
                        location.reload();
                    });
                }
            }
        })
    });
});
//登录注册页面
$("#really_login").click(function (){
    $("#shade").css({display : 'block'});
    $("#login_type").empty();
    $("#login").css({display : 'block'});
    $("#regist").css({display : 'none'});
}) ;
$("#really_registration").click(function () {
    $("#shade").css({display : 'block'});
    $("#login").css({display : 'none'});
    $("#registration").text("注册");
    $("#regist").css({display : 'block'});
});
$("#loginover").click(function () {
    $("#shade").css({display : 'none'});
});
$("#registration_over").click(function () {
    $("#shade").css({display : 'none'});
});
// 注册失焦验证
//用户名失焦验证
function registOF(registration_Id){
    //用户名格式正则
    var regu = /^[A-Za-z0-9]{4,10}$/;
    //创建正则对象
    var re = new  RegExp(regu);
    //test检验
    var rs = re.test(registration_Id);
    //判断用户名是否为空
    if (registration_Id == '') {
        $("#prompt_1").html("用户名不能为空！");
    }else if(!rs){
        $("#prompt_1").html("用户名格式不正确，只能使用4-10位大小写英文字母！");
    }else {
        $("#prompt_1").empty();
    }
}
//密码失焦验证
$("#ipt_userPwd").blur(function (){
    //获取密码输入内容
    var userPassword = $("#ipt_userPwd").val();
    //如果没有输入密码
    if(userPassword.length == ''){
        $("#prompt_2").html("密码不能为空!");
    }
    else
    {
        $("#prompt_2").empty();
    }
});

//登录用户名矢焦验证
$("#username").blur(function (){
    var userId = $("#username").val();
    if (userId == ''){
        $("#userid_prompt").html("用户名不能为空!");
    }else {
        $("#userid_prompt").empty();
    }
});
//登录密码矢焦验证
$("#password").blur(function (){
    var userId = $("#password").val();
    if (userId == ''){
        $("#userpsd_prompt").html("登陆密码不能为空!");
    }else {
        $("#userpsd_prompt").empty();
    }
});
//滑块
var sliderRe;
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
    callback: function (result) { // 回调函数，true(成功),false(失败)
        sliderRe = result;
        $("#result2").text(result);
    }
});
//首页点击事件
$("#pageHome").click(function(){
  window.location.href='./index.php?type=homepage&cont=homepage';
})
//个人中心点击事件
$("#infomation").click(function () {
    window.location.href='./index.php?type=homepage&cont=showInfo';
});















