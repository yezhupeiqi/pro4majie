shou_time();
var s = 60 - new Date().getSeconds();//获取剩余秒
var m = 59 - new Date().getMinutes();//获取剩余分钟
$("#min").text(m);
var timers = new Timer($("#second"),s,function () {
    var now_m = parseInt($("#min").text()) - 1;
    $("#min").text(now_m);
});
var times = setInterval(function (){
    var now_s = parseInt($("#second").text());
    if(now_s == 0){
        var s = 60 - new Date().getSeconds();
        var timers = new Timer($("#second"),s,function () {
            var now_m = parseInt($("#min").text()) - 1;
            $("#min").text(now_m);
        })
    }
},1000);
/*banner轮播*/
var index = 0;//圆点标记
var timer = setInterval("roasting()",1000);//开启定时器
// var points = document.getElementById('points').children;//获取圆点位置
// 定时器
function roasting()
{
    var div = document.getElementById('banner');
    // console.log(div)
    if(div.offsetLeft > -1200 * 2)
    {
        div.style.left = div.offsetLeft - 1200 + 'px';
        // index++;//圆点跟着图片变化
    }
    else
    {
        div.style.left = '0px';
        // index = 0;
    }
}

//获取商品信息和荣誉墙信息
$(function(){
    $.ajax({
        type: 'get',
        url: "index.php?type=Homepage&cont=getGoods",
        dataType:"json",
        success: function(res){
//      	console.log(res);
            if(res!=0){
//          	console.log(res);
                var data = res;
                showGoods(data);
            }
        }
    })
    //荣誉墙
    $.ajax({
        type: 'get',
        url: "index.php?type=Homepage&cont=getHonor",
        dataType:"json",
        success: function(res){
//      	console.log(res);
            if(res!=0){
                var data = res;
//              console.log(res);
                showHonor(data);
            }
        }
    })
})
//分页显示商品信息
function showGoods(data){
    var goodsShow = $("#commodity_show");
    goodsShow.empty();
    for(var i = 0;i<data['goodsData'].length;i++){
        var num1 = parseInt(data['goodsData'][i].s_alltory-data['goodsData'][i].s_surplus);
        var div1 = $("<div class = 'goodsBox' onclick='showDetial(event)' goodsid = "+data['goodsData'][i].s_mcsid+" ></div>").appendTo(goodsShow);
        $("<div><img class='goodsImg' src="+data['goodsData'][i].s_mcsimg+"></div>").appendTo(div1);
        var div3 = $("<div class='goodsInfo'></div>").appendTo(div1);
        $("<h4>"+data['goodsData'][i].s_mcsidname+"</h4>").appendTo(div3);
        $("<p class='goodsTxt'>"+data['goodsData'][i].s_note+"</p>").appendTo(div3);
        $("<p class='priceP'><span>￥</span><span id='price'>"+data['goodsData'][i].s_originalprice+"</span><span>元</span></p>").appendTo(div3);
        $("<p class='numBox'><span class='number'>已售<span>"+num1+"</span>/<span>"+data['goodsData'][i].s_alltory+"</span>件</span><span class='buy'>购买</span></p>").appendTo(div3);
    }
    //添加分页
    var page = $("<p class='pageBox'></p>");
    goodsShow.append(page);
    $("<span>共有"+data['pageInfo'].allPage+"页</span>").appendTo(page);
    $("<span idx ='"+data['pageInfo'].last+"' class='lastPage toPintPage' >上一页</span>").appendTo(page);
    for(var i = 1;i <= data['pageInfo'].allPage;i++){
        $("<span idx='"+i+"' class='toPintPage pageBtn'>"+i+"</span>").appendTo(page);
    }
    $("<span idx='"+data['pageInfo'].next+"' class='nextPage toPintPage'>下一页</span>").appendTo(page);
    $("<span>当前第"+data['pageInfo'].nowPage+"页</span>").appendTo(page);
    //分页按钮的点击事件
    $(".toPintPage").click(function(){
        var idx = $(this).attr("idx");
        $.ajax({
            type:"get",
            url: "index.php?type=Homepage&cont=getGoods&nowPage="+idx,
            dataType:"json",
            success:function(res){
                if(res==0){
					console.log(res);
                }else{
                    var data = res;
                    console.log(res);
                    showGoods(data);
                }
            }
        });
    });
}
//显示荣誉墙信息
function showHonor(data){
    var wall1 = $("#wall");
    for(var i = 0;i<data.length;i++){
        $("<p>恭喜<span>"+data[i].u_id+"</span>抢到了<span>"+data[i].mcsname+"</span></p>").appendTo(wall1);
    }
    var wall2 = $("#wall2");
    for(var i = 0;i<data.length;i++){
        $("<p>恭喜<span>"+data[i].u_id+"</span>抢到了<span>"+data[i].mcsname+"</span></p>").appendTo(wall2);
    }
    wall1.css("position","absolute");//将样式设为absolute
    //动态显示荣誉墙信息
    wall2.css("position","absolute");//将样式设为absolute
    var idx = 0;
    //计时器
    var timer = setInterval(function(){
        idx--;//表示移动的高度
        if(idx <(-(wall1.height()))){
            idx = 0;
        }
        wall1.css({top:idx+"px"});
        wall2.css({top:idx+wall2.height()+"px"});
    },50);//每20毫秒移动1px
}
//商品点击事件
function showDetial(event){
    var goodsid = $(event.currentTarget).attr('goodsid');
    //window.location.op='./index.php?c=Main&a=goodsDetail&goodsID='+goodsID;
    window.location.href='./index.php?type=Homepage&cont=showDetail&goodsid='+goodsid;
}







