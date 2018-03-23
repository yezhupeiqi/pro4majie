<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品详情</title>
    <link rel="stylesheet" href="./view/css/momodDetails.css" type="text/css">
</head>
<body>
<h2 style="margin-top: 10px;margin-left: 10px">商品详情</h2>

<div id="commodities">
    <div id="dataM">
        <p class="mcsData"><span>商品ID：</span><span><?php echo $data[0]['s_mcsid']?></span></p>
        <p class="mcsData"><span>商品名称：</span><span><?php echo $data[0]['s_mcsidname']?></span></p>
        <p class="mcsData"><span>发布类型：</span><span><?php echo $data[0]['s_publishType']?></span></p>
        <p class="mcsData"><span>商品类型：</span><span><?php echo $data[0]['t_name']?></span></p>
        <p class="mcsData"><span>商品价格：</span><span><?php echo $data[0]['s_originalprice']?></span></p>
        <p class="mcsData"><span>商品库存：</span><span><?php echo $data[0]['s_alltory']?></span></p>
        <p id="mcsImg" class="mcsData"><img src="<?php echo $data[0]['s_mcsimg']?>" style="width: 300px;height: 300px" ></p>
        <?php
        if($data[0]['s_publishType'] == '秒杀'){
            echo " <p class='mcsData'><span>秒杀价格：</span><span>{$data[0]['s_secondprice']}</span></p>";
            echo " <p class='mcsData'><span>限购数量：</span><span>{$data[0]['s_num']}</span></p>";
            echo " <p class='mcsData'><span>秒杀开始日期：</span><span>{$data[0]['s_startdates']}</span></p>";
            echo " <p class='mcsData'><span>秒杀结束日期：</span><span>{$data[0]['s_stopdates']}</span></p>";
            echo " <p class=\"mcsData\"><span>秒杀时间：</span><span>{$data[0]['starttime']}:00-{$data[0]['endtime']}:00</span></p>";
        }
        ?>
        <p class='mcsData'><span>销售数量：</span><span><?php echo $data[0]['s_surplus']?></span></p>
        <p class='mcsData'><span>商品状态：</span><span><?php echo $data[0]['s_mcsState']?></span></p>
        <p class='mcsData'><span>上架时间：</span><span><?php echo $data[0]['s_shelves']?></span></p>
        <p class='mcsData'><span>发布时间：</span><span><?php echo $data[0]['s_releaseTime']?></span></p>
        <p class='mcsData'><span>商品备注：</span><span><?php echo $data[0]['s_note']?></span></p>
        <P><span><input type="button" id="comeBack" value="返回"></span></P>
    </div>

</div>

</body>
<script src="./view/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script>
    $('#comeBack').click(function () {
        window.location.href="./index.php?a=mcsinform&c=showMcsPage";
    })
</script>
</html>