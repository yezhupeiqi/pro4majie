//var user = localStorage.HF170804LoginUser;
//var service = localStorage.HF170804LoginService;
// 隐藏地址
$("#adress_content").hide();
// 隐藏我的聊天
$("#myChat_cont").hide();
// 隐藏我的钱包
$("#money").hide();
// 隐藏我的订单
$("#OF_goods").hide();
// $("#infomationPage").hide();
/***************************************************************客户端操作************************************************/
//    链接服务器
//    ws：协议 localhost（127.0.0.1)本机
//var ws = new WebSocket("ws://localhost:8888");
////    事件机制：onopen 是否连接成功
//ws.onopen = function () {
//    console.log("连接服务器成功！");
//    if(user != ''){
//        var msg = {
//            id:user,
//            type:"getUserInfo"
//        };
//    }else {
//        var msg = {
//            id:service,
//            type:"getServiceInfo"
//        };
//    }
//    ws.send(JSON.stringify(msg));
//};
////     事件机制：onmessage 接收消息
//ws.onmessage = function (result) {
//    //需要把Josn格式的字符串转变为对象
//    var msgObj = JSON.parse(result.data);
//    switch(msgObj.type){
//        //个人信息显示
//        case"getUserInfoResp":
//            showInfo(msgObj.cont[0],msgObj.serviceName);
//            onlineService = msgObj.service;
//        break;
//        //客服信息显示
//        case"getServiceInfoResp":
//            showInfo(msgObj.cont[0]);
//        break;
//        //个人信息修改
//        case"reviseInfomationResp":
//            if(msgObj.cont){
//                alert("修改成功！");
//                location.reload();
//            }else {
//                alert("服务器出错，修改失败！")
//            }
//        break;
//        //余额显示
//        case"moneyResp":
//            $("#balance_cont").text(msgObj.cont[0].balance);
//        break;
//        //充值
//        case"rechargeResp":
//            if(msgObj.cont){
//                alert("充值成功！");
//                $("#balance_cont").text(sum);
//                console.log(sum);
//            }
//        break;
//        //充值
//        case"chat":
//            var $div = $("#friedChat_cont");
//            var $newdiv = $("<div></div>").appendTo($div);
//            $newdiv.css({
//                textAlign:"right"
//            });
//            var $p1 = $("<p>您说：</p>").appendTo($newdiv);
//            var $p2 = $("<p>"+msgObj.cont+"</p>").appendTo($newdiv);
//        break;
//    }
//};
//个人信息修改
$("[value='修改']").click(function (){
    var id = this.id;
    var cont = prompt("请输入修改内容：");
    if(cont != null){

    }
});
// 个人信息
$("#myInfo").click(function (){
    $("#infomationPage").show();
    $("#money").hide();
    $("#myChat_cont").hide();
    $("#OF_goods").hide();
    $("#title").text("个人信息");
});
// 我的聊天
$("#myChat").click(function (){
    $("#myChat_cont").show();
    $("#OF_goods").hide();
    $("#infomationPage").hide();
    $("#money").hide();
    $("#title").text("与客服聊天中...");
});
//// 发送消息
//$("#go_chat").click(function (){
//    var chat = $("#chatCont").html();
//    if(user != ''){
//        var msg = {
//            type:'chat',
//            sender:user,
//            rever:onlineService,
//            cont:chat
//        };
//    }
//    ws.send(JSON.stringify(msg));//发给服务器
//});
//我的余额
$("#myMoney").click(function () {
    $("#infomationPage").hide();
    $("#myChat_cont").hide();
    $("#OF_goods").hide();
    $("#money").show();
    $("#title").text("我的钱包");

});
// 充值
//var sum;
//$("#balance").click(function () {
//    var recharge = prompt("输入充值金额：");
//    if(recharge != null && parseInt(recharge) >= 0) {
//        var balance = $("#balance_cont").text();
//        sum = parseInt(recharge) + parseInt(balance);
//    }
//
//});
//我的订单
$("#order_for_goods").click(function () {
    $("#myChat_cont").hide();
    $("#OF_goods").show();
    $("#infomationPage").hide();
    $("#money").hide();
    $("#title").text("我的订单");
});
//=======================================================
//充值
$("#balance").click(function(){
    $("#dlg1").window("open");
});
function addMoney(){
    var money = parseFloat($.trim($("#addMoney").val()));
    var moneyRs = regu1(money);
    var balance_cont = parseFloat($("#balance_cont").text());
    var payMoney  = parseFloat(balance_cont+money);
    console.log(payMoney);
    if(!moneyRs){
        $.Pop('请输入正整数','alert');
    }else {
        $.Pop('充值金额为'+money+'元，是否确认充值？','confirm',function(){
            $.ajax({
                type:"post",
                url: "index.php?type=Homepage&cont=recharge",
                data:{money:payMoney},
                success:function(res){
                    if(res==1){
                        $.Pop('充值成功','alert',function(){
                            $("#dlg1").window("close");
                            location.reload();
                        });
                    }
                }
            });
        })
    }
}
//只能输入数字正则
function regu1(value){
    //正则判断
    var regu = /^[0-9]+$/;
    var re = new RegExp(regu);
    var rs = re.test(value);
    return rs;
}

















































