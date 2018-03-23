var count=0;
var userid='';
//获取cookie
function getCookie(cookie_name)
{
    var allcookies = document.cookie;
    var cookie_pos = allcookies.indexOf(cookie_name);   //索引的长度

    // 如果找到了索引，就代表cookie存在，
    // 反之，就说明不存在。
    if (cookie_pos != -1)
    {
        // 把cookie_pos放在值的开始，只要给值加1即可。
        cookie_pos += cookie_name.length + 1;      //这里容易出问题，所以请大家参考的时候自己好好研究一下
        var cookie_end = allcookies.indexOf(";", cookie_pos);

        if (cookie_end == -1)
        {
            cookie_end = allcookies.length;
        }

        var value = unescape(allcookies.substring(cookie_pos, cookie_end));         //这里就可以得到你想要的cookie的值了。。。
    }
    return value;
}

var customerid = getCookie("lineid");
//1.连接服务器：url
var ws=new WebSocket("ws://localhost:8888");
//ws.就是一个网络对象
/*
send：发送信息
参数：字符串
close：关闭网咯连接
*/
//事件机制：onopen
ws.onopen=function (resuie) {
    console.log("连接成功了");
    //发送消息
    $.ajax({
        type: "post",      //请求方式 ("POST" 或 "GET")， 默认为 "GET"
        url: "./index.php?a=cutomerbox&c=sendData",  //发送请求的地址
        dataType:"json",        //规定返回值的类型
        success: function(res) {//请求成功后的回调函数
            sendSever(res[0],'rever','online','content');
        },
        error: function(res) {  //请求失败时调用此函数。
            console.log(res);
        }
    });
};



ws.onmessage=function (resule) {
    var msgObj=JSON.parse(resule.data);
    switch (msgObj.type){
        case "chat":
            if(customerid == msgObj.sender){

            }
            else {
                userid=msgObj.sender;
            }
            var centent=msgObj.content;
            console.log(userid,customerid)
            var flag=false;
            var $pobject=$("#stroe_xin>p");
            var $chat=$("#chat_box>div");
            if($pobject.length == 0)
            {

            }
            else {
                for (var i=0;i<$pobject.length;i++)
                {
                    if($($pobject[i]).children().attr('id') ==userid||$($pobject[i]).children().attr('id') == customerid)
                    {
                        flag =true;
                        break;
                    }
                }
            }
            if(flag == false)//否
            {
                count++;
            }
            if($pobject.length>=count)
            {
                for (var i=0;i<$pobject.length;i++)
                {
                    if($($pobject[i]).children().attr('id') ==userid||$($pobject[i]).children().attr('id') == customerid)
                    {
                        var $chat = $('#chat_box');//聊天框
                        var $div = $('<div></div>');
                        var $p1 = $('<p style="color:black">'+customerid+'：</p>');
                        var $p2 = $('<p style="color:black">'+centent+'</p>');
                        $div.append($p1);
                        $div.append($p2);
                        if(msgObj.sender == customerid){
                            $div.css({
                                'textAlign':'right'
                            });
                            $p2.css({
                                'marginRight':'10px'
                            })
                        }
                        else{
                            $div.css({
                                'textAlign':'left'
                            });
                            $p2.css({
                                'marginLeft':'10px'
                            })
                        }
                        $($chat[i]).append($div);
                    }
                }
            }
            else{
                if(msgObj.sender !=customerid)
                {
                    var $user=$("#stroe_xin");//买家
                    var $p=$('<p></p>');
                    var $span=$("<span>用户"+userid+"#</span>");
                    $span.attr('id',userid);
                    $p.append($span);
                    $p.css({
                        width: "150px",
                        height: "20px",
                        border: "1px solid black",
                        borderRadius: "3px"
                    });
                    $user.append($p);
                    $p.click(function () {
                        alert("切换用户成功！");
                        var id=$(this).children().attr('id');
                        userid=id
                    });
                    var $chat = $('#chat_box');//聊天框
                    var $div = $('<div></div>');
                    var $p1 = $('<p style="color:black">'+userid+'：</p>');
                    var $p2 = $('<p style="color:black">'+centent+'</p>');
                    $div.append($p1);
                    $div.append($p2);
                    if(msgObj.sender == customerid){
                        $div.css({
                            'textAlign':'right'
                        });
                        $p2.css({
                            'marginRight':'10px'
                        })
                    }
                    else{
                        $div.css({
                            'textAlign':'left'
                        });
                        $p2.css({
                            'marginLeft':'10px'
                        })
                    }
                    $chat.append($div);
                }
                if(msgObj.sender ==customerid){
                    var $chat = $('#chat_box');//聊天框
                    var $div = $('<div></div>');
                    var $p1 = $('<p style="color:black">'+userid+'：</p>');
                    var $p2 = $('<p style="color:black">'+centent+'</p>');
                    $div.append($p1);
                    $div.append($p2);
                    if(msgObj.sender == customerid){
                        $div.css({
                            'textAlign':'right'
                        });
                        $p2.css({
                            'marginRight':'10px'
                        })
                    }
                    else{
                        $div.css({
                            'textAlign':'left'
                        });
                        $p2.css({
                            'marginLeft':'10px'
                        })
                    }
                    $chat.append($div);
                }

            }
            break;
    }
};
//事件机制;onerror 出错
ws.onerror=function (err) {
    console.log(err)
};
//事件机制;onclose
ws.onclose=function () {

};

//聊天信息发送
$("#shoot").click(function () {
    var txt=$("#chat_input").html();
    sendSever(customerid,userid,'chat',txt);
});
/*****************表情封装************************/
var express=new MyExpression($("#express"),75,function ($img) {
    var $inputDiv=$("#chat_input");
    $inputDiv.append($img)
});
$("#exp").click(function () {
    $("#express").toggle(1000)
});

//客服在线或离线
function cusemer(online,arr) {
    $("#stroe_xin").empty();
    var $severnum=$("#stroe_xin>p");

    var $online=$("#no_online");
    $online.empty();
    for(var i=0;i<arr.length;i++){
        var $div=$("#stroe_xin");
        var $p=$("<p></p>");
        $p.css({
            width: "150px",
            height: "30px",
            float: "left",
            borderBottom: "1px solid black",
        })
        var $span=$("<span>客服"+arr[i].customerid+"#</span>");
        $span.attr('id',arr[i].customerid);
        $p.append($span);
        $div.append($p);
        // $p.click(function () {
        //     alert("切换客服成功！");
        //     var id=$(this).children().attr('id');
        //     localStorage.customerid=id
        // })
        if(online[i] == 0){
            var $p2=$("<p>(离线)</p>");
            $p2.css({
                color:"black",
                width: "40px",
                height: "30px",
                float: "left",
                fontSize: "12px"
            });
            $online.append($p2)
        }
        else {
            var $p2=$("<p>(在线)</p>");
            $p2.css({
                color:"red",
                width: "40px",
                height: "30px",
                float: "left",
                fontSize: "12px"
            });
            $online.append($p2)
        }
    }
}










//发送到服务器
function sendSever(sender,rever,type,content) {
    var msg={
        sender:sender,//发送这
        rever:rever,//接收者
        type:type,//消息类型
        content:content,//消息内容
        msgtime:(new Date()).getTime()//消息时间戳
    };
    //将对象转变为Json格式字符串
    var msgStr=JSON.stringify(msg);
    ws.send(msgStr);//只能发送字符串
}



