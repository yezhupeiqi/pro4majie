<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品信息</title>
    <link rel="stylesheet" href="./view/css/mcsinfo.css" type="text/css">
    <script src="./view/js/angular.js"></script>
</head>
<body ng-app="myApp">
    <h2>商品信息</h2>
    <div id="mcsDiv" ng-controller="myCtrl" style="border:none">
        <p id="mcs_sle">
           <span class="ipt">
               商品类型：
                <select ng-model="mcsTypeT" ng-change="mcsType()" id="type">
                        <option value="" selected>全部</option>
                        <option value=1>女装</option>
                        <option value=2>女鞋</option>
                        <option value=3>男装</option>
                        <option value=4>男鞋</option>
                        <option value=5>美妆</option>
                        <option value=6>食品</option>
                        <option value=7>数码电器</option>
                        <option value=8>户外运动</option>
                        <option value=9>家纺家居</option>
                        <option value=10>医药保健</option>
                        <option value=11>手表配饰</option>
                </select>
            </span>
            <span class="ipt">
                商品状态：
                <select ng-model="mcsTypeS" ng-change="mcsType()" id="state">
                        <option value="" selected>全部</option>
                        <option>上架</option>
                        <option>未上架</option>
                        <option>下架</option>
                </select>
            </span>
           <span class="ipt">
                <span>商品名：</span>
                <input type="text" id="mcsNmae" ng-model="mcsTypeN">
                <input type="button" value="查找" ng-click="mcsType()">
            </span>
        </p>
        <p id="mcsP">
            <span style="margin-left: 8px" class="mcsTh">ID</span>
            <span style="margin-left: 12px" class="mcsTh">商品名称</span>
            <span style="margin-left: 30px" class="mcsTh">图片</span>
            <span style="margin-left: 10px" class="mcsTh">价格</span>
            <span style="margin-left: 10px" class="mcsTh">库存</span>
            <span style="margin-left: 8px" class="mcsTh">发布类型</span>
            <span style="margin-left: 8px" class="mcsTh">上架时间</span>
            <span style="margin-left: 45px" class="mcsTh">发布时间</span>
            <span style="margin-left: 80px" class="mcsTh">操作</span>
        </p>
        <table class='mcsTab' ng-repeat="x in mcsArr">
            <tr class='mcsTr'>
                <td class='td_id'>{{x.s_mcsid}}</td>
                <td class='td_name'>{{x.s_mcsidname}}</td>
                <td class='td_img'><img ng-src="{{x.s_mcsimg}}" style='width: 60px;height: 60px'></td>
                <td class='td_pri'>￥{{x.s_secondprice}}</td>
                <td class='td_all'>{{x.s_alltory}}</td>
                <td class='td_pub'>{{x.s_publishType}}</td>
                <td class='td_ves'>{{x.s_shelves}}</td>
                <td class='td_rel'>{{x.s_releaseTime}}</td>
                <td class='td_zuo'>
                    <span id="{{x.s_mcsid}}" onclick="editor()">编辑 |</span>
                    <span id="{{x.s_mcsid}}" onclick="state()" ng-if="x.s_mcsState=='上架'">下架</span>
                    <span id="{{x.s_mcsid}}" onclick="state()" ng-if="x.s_mcsState=='未上架'">上架</span>
                    <span id="{{x.s_mcsid}}" onclick="state()" ng-if="x.s_mcsState=='下架'">上架</span>
                    <span id="{{x.s_mcsid}}" onclick="details()"> 详情</span>
                </td>
            </tr>
        </table>
        <p id="page">
            <span class="pageBtn">共{{page.allPage}}页,当前页{{page.nowPage}}/{{page.allPage}}页</span>
            <span ng-click="changePage(1)"  class="pageBtn">[首页]</span>
            <span ng-click="changePage(page.last)"  class="pageBtn">上一页</span>
            <span ng-repeat="x in pageNum" ng-click="changePage(x)"  class="pageBtn">[{{x}}]</span>
            <span ng-click="changePage(page.next)"  class="pageBtn">下一页</span>
            <span ng-click="changePage(page.allPage)"  class="pageBtn">[尾页]</span>
        </p>
    </div>
</body>
<script src="./view/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script>
    var app=angular.module('myApp',[]);
    app.controller('myCtrl',function ($scope,$http) {
        //显示商品
        $http({
            mothod:"get",
            url:"./index.php?a=mcsinform&c=showmcs"
        }).then(function success(res) {
            $scope.mcsArr=res.data[0];
            $scope.page=res.data[1];
            $scope.pageNum=res.data[1].pageNum;
            $scope.changePage=function (num) {
                $http({
                    mothod:"get",
                    url:"./index.php?a=mcsinform&c=showmcs&nowPage="+num
                }).then(function success(res) {
                    $scope.mcsArr=res.data[0];
                    $scope.page=res.data[1];
                    $scope.pageNum=res.data[1].pageNum;

                },function error(res) {
                    console.log(res,1);
                });
            }
        },function error(res) {
            console.log(res,1);
        });
        //查找商品
        $scope.mcsType=function () {
            var type=$scope.mcsTypeT;
            var state=$scope.mcsTypeS;
            var name=$scope.mcsTypeN;
            $http({
                url:"./index.php?a=mcsinform&c=showType",
                method:"POST",
                data:{type:type,state:state,name:name}
            }).then(function success(res) {
                $scope.mcsArr=res.data[0];
                $scope.page=res.data[1];
                $scope.pageNum=res.data[1].pageNum;
                //分页
                $scope.changePage=function (num) {
                    $http({
                        url:"./index.php?a=mcsinform&c=showType&nowPage="+num,
                        method:"POST",
                        data:{type:type,state:state,name:name}
                    }).then(function success(res) {
                        $scope.mcsArr=res.data[0];
                        $scope.page=res.data[1];
                        $scope.pageNum=res.data[1].pageNum;
                    },function error(res) {
                        console.log(res,1);
                    });
                };
            },function error(res) {
                console.log(res,1);
            });
        };
    });
    //编辑
    function editor() {
        var mcsId=$(event.target).attr('id');
        window.location.href="./index.php?a=CommodEditor&c=mcsEditor&id="+mcsId;
    }
    //状态
    function state() {
        var mcsId=$(event.target).attr('id');
        var state=$(event.target).html();
        var re=confirm("是否修改商品状态！");
        if(re){
            $.ajax({
                type: "post",      //请求方式 ("POST" 或 "GET")， 默认为 "GET"
                url: "./index.php?a=mcsinform&c=modState",  //发送请求的地址
                data:  'mcsId='+mcsId+'&state='+state,       //类型：String,发送到服务器的数据
                dataType:"json",        //规定返回值的类型
                success: function(res) {//请求成功后的回调函数
                    if(res == '1'){
                        alert('修改成功！');
                        window.location.reload();
                    }
                    else {
                        alert('修改失败！');
                    }
                },
                error: function(res) {  //请求失败时调用此函数。
                    console.log(res);
                }
            });
        }
    }
    //详情
    function details() {
        var mcsId=$(event.target).attr('id');
        window.location.href="./index.php?a=momodDetails&c=mcsDetails&id="+mcsId;
    }

</script>
</html>