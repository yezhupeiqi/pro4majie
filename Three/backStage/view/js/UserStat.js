

$(function()
{
    //发送ajax请求
    $.ajax({

        url:'./index.php?a=userMarket&c=getUserData',

        type:'post',

        dataType:'json',

        success:function (data)
        {
            postChart(data);

        }
    });

});

//用户统计图
function postChart(data)
{
    myChart = echarts.init(document.getElementById('UserStat'));

    myChart.setOption({
        //标题
        title : {
            text: '2018年用户统计'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['注册人数']
        },
        //工具栏显示
        toolbox: {
            show : true,
            iconStyle:{
                color:"rgb(93, 187, 160)"
            },
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        //x轴
        xAxis : [
            {
                type : 'category',
                data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
                //设置字体倾斜
                axisLabel:{
                    interval:0,
                    rotate:45,//倾斜度 -90 至 90 默认为0
                    margin:2,
                    textStyle:{
                        fontWeight:"bolder",
                        color:"#000000"
                    }
                }
            }
        ],
        //y轴
        yAxis : [
            {
                type : 'value',
                splitArea : {show : true}
            }
        ],
        series : [
            {
                name:'注册人数',
                type:'bar',
                data:data,
                //顶部数字展示pzr
                itemStyle:
                    {
                    normal:
                        {
                        label:
                            {
                                show: true,//是否展示
                                textStyle:
                                {
                                    fontWeight:'bolder',
                                    fontSize : '12',
                                    fontFamily : '微软雅黑'
                                }
                            }
                        }
                    }
            }
        ]
    });
}