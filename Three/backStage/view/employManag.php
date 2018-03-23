<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户管理</title>
    <link rel="stylesheet" href="./view/css/employManag.css" type="text/css">
    <script src="./view/js/angular.js"></script>
</head>
<body ng-app="myApp">
<div id="mcsDiv" ng-controller="myCtrl">
    <p id="mcs_tit">
        用户管理
    </p>
    <p id="mcs_sle">
        <span class="ipt">
            <span>关键字：</span>
            <input type="text" id="mcsNmae" ng-model="userN">
            <input type="button" value="查找" ng-click="selectUser()">
        </span>
        <span>
            <input type="button" value="使用/锁定" id="us_lock">
        </span>
    </p>
    <table class='mcsTab' id="maxTab">
        <tr id="mcsP">
            <td><input type="checkbox" id="allBox" onchange='thBox()'></td>
            <td>账号</td>
            <td>昵称</td>
            <td>头像</td>
            <td>余额</td>
            <td>注册时间</td>
            <td>状态</td>
            <td>操作</td>
        </tr>
        <tr class='mcsTr' ng-repeat="x in userArr">
            <td class='td_id'><input type="checkbox" value="{{x.userid}}"></td>
            <td class='td_id'>{{x.userid}}</td>
            <td class='td_name'>{{x.nickname}}</td>
            <td class='td_img'><img ng-src="{{x.headimg}}" style='width: 60px;height: 60px'></td>
            <td class='td_pri'>${{x.balance}}</td>
            <td class='td_pub'>{{x.registime}}</td>
            <td class='td_ves'>{{x.state}}</td>
            <td class='td_zuo'>
                <button id="{{x.userid}}" onclick="modifyPwd()">重置密码</button>
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
        //显示用户
        $http({
            mothod:"get",
            url:"./index.php?a=employManag&c=showUser"
        }).then(function success(res) {
            $scope.userArr=res.data[0];
            $scope.page=res.data[1];
            $scope.pageNum=res.data[1].pageNum;
            $scope.changePage=function (num) {
                $http({
                    mothod:"get",
                    url:"./index.php?a=employManag&c=showUser&nowPage="+num
                }).then(function success(res) {
                    $scope.userArr=res.data[0];
                    $scope.page=res.data[1];
                    $scope.pageNum=res.data[1].pageNum;
                },function error(res) {
                    console.log(res,1);
                });
            }
        },function error(res) {
            console.log(res,1);
        });
        //查找
        $scope.selectUser=function () {
            var name=$scope.userN;
            $http({
                url:"./index.php?a=employManag&c=showSlect",
                method:"POST",
                data:{name:name}
            }).then(function success(res) {
                $scope.userArr=res.data[0];
                $scope.page=res.data[1];
                $scope.pageNum=res.data[1].pageNum;
                //分页
                $scope.changePage=function (num) {
                    $http({
                        url:"./index.php?a=employManag&c=showSlect&nowPage="+num,
                        method:"POST",
                        data:{name:name}
                    }).then(function success(res) {
                        $scope.userArr=res.data[0];
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
    //重置密码
    function modifyPwd() {
        var userid=$(event.target).attr('id');
        var re=confirm('是否重置密码？');
        if(re){
            $.ajax({
                type: "post",      //请求方式 ("POST" 或 "GET")， 默认为 "GET"
                url: "./index.php?a=employManag&c=modPwd",  //发送请求的地址
                data:  'id='+userid,       //类型：String,发送到服务器的数据
                dataType:"text",        //规定返回值的类型
                success: function(res) {//请求成功后的回调函数
                    if(res == '1'){
                        alert('重置成功！');
                    }
                    else if(res == 'no'){
                        alert('用户被锁定，重置失败！');
                    }
                },
                error: function(res) {  //请求失败时调用此函数。
                    console.log(res);
                }
            });


        }

    }

    //全选
    function thBox() {
        $('#maxTab').find('tr').find('input').prop('checked',$(event.target).prop('checked'));
    }
    $('#us_lock').click(function () {
        var check=$('#maxTab').find('tr').find('input');
        $arr=[];
        for(var i=0;i<check.length;i++){
            if($(check[i]).prop('checked') == true){
                if(i != 0){
                    var id=$(check[i]).val();
                    $arr.push(id);
                }
            }
        }
        if($arr.length != 0){
            var stafArr=JSON.stringify($arr);
            $.ajax({
                type: "post",      //请求方式 ("POST" 或 "GET")， 默认为 "GET"
                url: "./index.php?a=employManag&c=modState",  //发送请求的地址
                data: 'arr='+stafArr,       //类型：String,发送到服务器的数据
                dataType:"text",        //规定返回值的类型
                success: function(res) {//请求成功后的回调函数
                    if(res == '1'){
                        alert('修改成功');
                        window.location.reload();
                    }
                    else {
                        alert('修改失败');
                    }
                },
                error: function(res) {  //请求失败时调用此函数。
                    console.log(res);
                }
            });
        }
        else {
            alert('操作错误！');
        }
    });

</script>
</html>