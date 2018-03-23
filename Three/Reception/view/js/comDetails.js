/***************************************************************客户端操作************************************************/
////    1.链接服务器
////    ws：协议 localhost（127.0.0.1)本机
//var ws = new WebSocket("ws://localhost:8888");
///*
//    send:发送消息
//    参数：字符串
//    close：关闭网络连接
// */
////2.事件机制：onopen 是否连接成功
//var comnumber = localStorage.hf170804Comnumber;
//var userid = localStorage.HF170804LoginUser;
//ws.onopen = function () {
//    console.log("连接服务器成功！");
//    var msg = {
//        timeNumber:comnumber,
//        type:'com'
//    };
//    ws.send(JSON.stringify(msg));
//};
////3.事件机制：onmessage 接收消息
//ws.onmessage = function (result) {
//    //需要把Josn格式的字符串转变为对象
//    var msgObj = JSON.parse(result.data);
//    // console.log(msgObj);
//    switch(msgObj.type){
//        // 登陆
//        case"loginResp":
//            if(msgObj.cont){
//                alert("登陆成功！");
//                var sel = confirm('是否前去个人中心完善信息（填写默认地址）？');
//                if(sel)
//                {
//                    $("#shade").hide(1000);
//                    localStorage.hf170804 = msgObj.onlineUser;
//                    window.open('infomation.html');//打开新页面进入
//                }else {
//                    $("#shade").hide(1000);
//                }
//                localStorage.HF170804LoginUser = msgObj.onlineUser;
//            }else {
//                alert("登陆失败！");
//            }
//            break;
//        // 注册
//        case"registResp":
//            if(msgObj.cont){
//                alert("恭喜你注册成功！");
//                var sel = confirm('是否马上登陆？');
//                if(sel)
//                {
//                    $("#login").css({display : 'block'});
//                    $("#regist").css({display : 'none'});
//                }else {
//                    $("#shade").hide(1000);
//                }
//            }else {
//                alert("注册失败！");
//            }
//            break;
//        // 重名验证
//        case"donameResp":
//            if(msgObj.cont){
//                $("#prompt_1").html("用户名已存在！")
//            }else {
//                registOF(msgObj.id);
//            }
//            break;
//        //获取商品详情显示
//        case"comResp":
//            console.log(msgObj.cont[0]);
//            // 详情大图
//            $("#com_img_b").attr("src",msgObj.cont[0].detailsbig);
//            // 详情小图
//            $("#com_img_s1").attr("src",msgObj.cont[0].detailsimg);
//            $("#com_img_s2").attr("src",msgObj.cont[0].detailsimg);
//            $("#com_img_s3").attr("src",msgObj.cont[0].detailsimg);
//            $("#com_img_s4").attr("src",msgObj.cont[0].detailsimg);
//            // 详情商品名字
//            $("#comDetails_name").html(msgObj.cont[0].detailsname);
//            // 商品详情简介
//            $("#synopsis").html(msgObj.cont[0].detailssynopsis);
//            // 秒杀价
//            $("#price").html(msgObj.cont[0].price);
//            // 已抢数量
//            $("#payover").html(msgObj.cont[0].payover);
//            // 累计评价
//            $("#evaluate").html(msgObj.cont[0].evaluate);
//            // 剩余数量
//            $("#surplus").html(msgObj.cont[0].surplus);
//            // 限购数
//            $("#limitbuy").html(msgObj.cont[0].limitbuy);
//        break;
//        // 秒杀
//        case"secKillResp":
//            if(msgObj.cont){
//                alert("秒杀成功！")
//            }
//        break
//    }
//};
////登录
//$("#logining").click(function () {
//    var id = $("#username").val();
//    var password = $("#password").val();
//    if(id != "" && password != "" && sliderRe){
//        var msg={
//            id:id,   //账号
//            psd:hex_md5(password),  //密码
//            type:'login' //消息类型
//        };
//        ws.send(JSON.stringify(msg));//只能发字符串
//    }else {
//        alert("账号密码错误（滑块必须验证）！")
//    }
//
//});
//注册
// $("#button_registration").click(function () {
//     var id = $("#ipt_userID").val();//账号
//     var psd = $("#ipt_userPwd").val();//密码
//     var dbpsd = $("#ipt_repeatPwd").val();//重复密码
//     var nickName = $("#nickname").val();//昵称
//     if(id != '' && psd != '' && nickName != '' && dbpsd != ''){
//         var d = new Date().getTime();
//         var reTime =(new Date(d)).toLocaleDateString();//注册时间
//         var userobj = {
//             type:'regist',
//             password:hex_md5(psd),
//             userid:id,
//             nickname:nickName,
//             registday:reTime
//         };
//         //将对象转换成JSON格式的字符串
//         var userStr = JSON.stringify(userobj);
//         ws.send(userStr);//只能发字符串
//     }else {
//         alert('信息没有填写完整！')
//     }
// });
//秒杀
//$("#secKill").click(function () {
//    var msg = {
//        type:'secKill',
//        cont:comnumber,
//        user:userid
//    };
//    ws.send(JSON.stringify(msg));//只能发字符串
//});
////重名验证
//$("#ipt_userID").blur(function () {
//    var registration_Id = $("#ipt_userID").val();//用户名
//    var msg={
//        id:registration_Id,   //账号
//        type:'doname' //消息类型(重名)
//    };
//    ws.send(JSON.stringify(msg));//只能发字符串
//});
//=====================================================================================================================
//购买点击事件
var goodsid;
$("#secKill").click(function(){
    var isLogin = $("#really_login").text();
    goodsid = $(event.target).attr('goodsid');
    if(isLogin == '亲，请登录'){
        $.Pop('您当前还未登录，请先登录');
    }else{
        $.Pop('是否确认购买？','confirm',function(){
            var buyNum = parseInt($("#buyNum").val());
            var surplus = parseInt($("#surplus").text());
            if(buyNum>surplus){
                $.Pop('当前库存不足！','alert');
            }else {
                var price = parseFloat($("#price").text());
                var buyNum = parseInt($("#buyNum").val());
                var cost = parseFloat(price*buyNum);
                var goodsimg = $("#com_img_b").attr('src');
                var goodsName = $("#comDetails_name").text();
                var num = parseInt(surplus-buyNum);
                $.ajax({
                    type:"post",
                    url: "index.php?type=Homepage&cont=buyGoods",
                    data:{money:cost,goodsid:goodsid,goodsimg:goodsimg,goodsname:goodsName,num:num},
                    success:function(res){
                        console.log(res);
                        if(res==0){
                            $.Pop('余额不足','alert');
                        }else {
                            $.Pop('购买成功','alert',function(){
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    }
})