//分时段显示
function shou_time() {
    var now_Time =new Date().getHours();//当前小时
    var $ul = $("#buy_timeUl");
    for (var i = now_Time-4;i <= now_Time+4;i++){
        var $li = $("<li></li>").appendTo($ul);
        var $p1 = $("<p></p>").appendTo($li);
        var $span1 = $("<span>"+i+"</span>").appendTo($p1);
        var $span2 = $("<span>:00</span>").appendTo($p1);
        if(i >= now_Time-4 && i < now_Time){
            var $p2 = $("<p>抢购结束</p>").appendTo($li);
        }else if (i == now_Time){
            var $p2 = $("<p>正在抢购</p>").appendTo($li);
            $li.css({
                color:"white"
            })
        }else {
            var $p2 = $("<p>抢购未开始</p>").appendTo($li);
        }
        $li.click(function () {
            var clicktime = $(this).find("span").text();
            showTime(clicktime);
            $("#buy_timeUl").find("li").css({
                color:"#888"
            });
            $(this).css({
                color:"white"
            });
        })
    }
}
// 获取时间段编号
function getTimeNum(i) {
    var re;
    switch (i){
        case -4:re = 1;break;
        case -3:re = 2;break;
        case -2:re = 3;break;
        case -1:re = 4;break;
        case 0:re = 5;break;
        case 1:re = 6;break;
        case 2:re = 7;break;
        case 3:re = 8;break;
        case 4:re = 9;break;
    }
    return re;
}
//倒计时
Timer.prototype.htmlUl = function(){
    this.$div.css({
        color:"red"
    });
    this.$div.text(this.s)
};
Timer.prototype.startT = function () {
    var ss = this.s;
    this.times = window.setInterval(function () {
        ss--;
        if(ss <= 0){
            clearInterval(this.times);
            this.fun();
        }
        this.$div.text(ss)
    }.bind(this),1000)
};
function Timer($div,s,fun) {
    this.$div = $div;
    this.s = s;
    this.fun = fun;
    this.times = '';
    this.htmlUl();
    this.startT();
}
//荣誉墙定时器
function notable(){
    var div = document.getElementById('wall');
    if(div.offsetTop > -65){
        div.style.top = div.offsetTop - 1 + 'px';
    }
    else
    {
        div.style.top = '0px';
    }
}
//动态显示商品
function show_com(msgObj) {
    $div_f = $("#commodity");
    $div = $("<div></div>").appendTo($div_f);
    // <span><img id="1" src=""></span>
    $span_1 = $("<span></span>").appendTo($div);
    $img = $("<img src='"+msgObj.homeimg+"'/>").appendTo($span_1);
    // <span>GTX1060 6G独显旗舰级新品</span>
    $span_2 = $("<span>"+msgObj.homename+"</span>").appendTo($div);
    // <p style="color: red">咨询客服有礼！</p>
    $p_1 = $("<p>"+msgObj.activity+"</p>").appendTo($div);
    $p_1.css({
        color: "red"
    });
    // <p>已抢<b>0</b>件</p>
    $p_2 = $("<p>已抢"+msgObj.payover+"件</p>").appendTo($div);
    // <p>还剩<b>100</b>件</p>
    $p_3 = $("<p>还剩"+msgObj.surplus+"件</p>").appendTo($div);
    // <p style="text-decoration:line-through;color: #888;font-size: 12px">原价：￥9000</p>
    $p_4 = $("<p>原价：￥"+msgObj.originalcost+"</p>").appendTo($div);
    $p_4.css({
        textDecoration:"line-through",
        color: "#888",
        fontSize: "12px"
    });
    // <p style="font-size: 20px;color: red">￥8699</p>
    $p_5 = $("<p>抢购价：￥"+msgObj.price+"件</p>").appendTo($div);
    $p_5.css({
        fontSize: "20px",
        color: "red"
    });
    // <input type="button" value="立即秒杀">
    $ipt = $("<input type='button' value='立即秒杀'/>").appendTo($div);
    $div.click(function () {
        window.open("comDetails.php")
    });
    $div.click(function () {
        localStorage.hf170804Comnumber = msgObj.commodityid
    })
}
/*
    封装：
        输入参数：$div  每页显示几行 一共有多少行 当前是第几页 返回什么结果（回调）
        输出：当前第几页的开始索引和结束索引
    方法：
        绘制UI drawUI
        计算方法：分页方法
 */
function MyPage($div,pageSize,totalRows,currPage,callback) {
    this.$div = $div;
    this.pageSize = pageSize;//每页行数
    this.totalRows = totalRows;//总行数
    this.currPage = currPage;//当前页
    this.callback = callback;//返回值
}
MyPage.prototype.drawUI=function (){
    $frist = $("<span>首页</span>");
    $frist.click(function () {
        this.currPage=1;
        this.compute();
    }.bind(this));
    $prev = $("<span>上一页</span>");
    $prev.click(function () {
        if(this.currPage < 1){
            alert("已经是第一页");
            return;
        }
        this.currPage--;
        this.compute();
    }.bind(this));
    $next = $("<span>下一页</span>");
    $next.click(function () {
        if(this.currPage > this.pages){
            alert("已经是第一页");
            return;
        }
        this.currPage++;
        this.compute();
    }.bind(this));
    $last = $("<span>尾页</span>");
    $last.click(function () {
        this.currPage = this.pages;
        this.compute();
    }.bind(this));
    $input = $("<input type='number' min='1' value='1'>");
    $go = $("<span>go</span>");
    $go.click(function () {
        var p = parseInt($input.val());
        if(p > this.pages){
            alert("超出了最大页");
            return;
        }
        this.currPage = p;
        this.compute();
    }.bind(this));
    this.$div.append($frist);
    this.$div.append($prev);
    this.$div.append($input);
    this.$div.append($next);
    this.$div.append($last);
    this.$div.append($go);
};
MyPage.prototype.compute=function () {
    //已经 一页有多少行、总行数、当前是第几页
    //计算总页数 当前页的开始做引和结束索引
    var pages = Math.ceil(this.totalRows/this.pageSize);
    var start = (this.currpage-1)*this.pageSize;
    var end = this.currPage*this.pageSize;
    if(end >= this.totalRows){
        end = this.totalRows-1;
    }
    this.callback(start,end);
};
//个人信息显示
function showInfo(infomation,serviceName){
    $("#showuserName").html(infomation.username);
    $("#registTme").html(infomation.registtime);
    $("#headimg").attr("src",infomation.headimg);
    //账号显示
    if(!infomation.logintype){
        $("#infomation_show_id").html(infomation.userid);
    }else {
        $("#infomation_show_id").html(infomation.serviceid+"(客服)")
    }
    $("#infomation_show_psd").html(infomation.registtime);//密码
    $("#infomation_show_nick").html(infomation.username);//昵称
    $("#infomation_show_age").html(infomation.age);//年龄
    $("#infomation_show_sex").html(infomation.sex);//性别
    if(infomation.address == null){$("#infomation_show_address").html("地址还未设置")}//默认地址
    else {
        $("#adress_content").html(infomation.address);
        $address = $("#infomation_show_address");
        var $reAddress = $("<input type='button' value='点击查看/关闭'/>").appendTo($address);
        $reAddress.click(function () {
            $("#adress_content").toggle();
        })
    }
    if(infomation.email != null){$("#infomation_show_email").html(infomation.email)}//邮箱
    else {$("#infomation_show_email").html("邮箱未设置")}
    if(infomation.paypsd != null){$("#infomation_show_paypsd").html(infomation.paypsd)}//支付密码
    else {$("#infomation_show_paypsd").html("支付密码未设置")}
    // 与客服聊天
    if(!serviceName){
        $("#chatingName").html("客服未在线")
    }else {
        $("#chat_friendName").html(serviceName);
    }
}







