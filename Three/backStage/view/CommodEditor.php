<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品编辑</title>
    <link rel="stylesheet" href="./view/css/CommodEditor.css" type="text/css">
</head>
<body>
<h2>商品信息</h2>
<div id="mcsDiv">
    <p id="mcs_tit">
        商品编辑
    </p>
    <form  method="post" action="./index.php?a=CommodEditor&c=addNMcs" enctype='multipart/form-data' id="mcsForm">
        <p class="mcsIpt">
            <span>发布商品名：</span>
            <span>
                <input type="text" name="tradeName" value="<?php echo $data[0]['s_mcsidname']?>">
                <input type="hidden" name="mcs" value="<?php echo $data[0]['s_mcsid']?>">
            </span>
        </p>
        <p class="mcsIpt">
            <span>商品价格：</span>
            <span>
                <input type="num" name="price" value="<?php echo $data[0]['s_originalprice']?>">
            </span>
        </p>
        <p class="mcsIpt">
            <span>库存：</span>
            <span>
                <input type="num" name="invent" value="<?php echo $data[0]['s_alltory']?>">
            </span>
        </p>
        <p class="mcsIpt">
            <span>商品图片：</span>
            <span>
                <input type='file' name='file' onchange='imageshowN(this)' value="<?php echo $data[0]['s_mcsimg']?>">
            </span>
        </p class="mcsIpt">
        <p id='showImg' style='position: absolute;margin-left: 300px;margin-top: -100px' >
            <span>
                <img src='<?php echo $data[0]['s_mcsimg']?>' style='width: 150px;height: 150px'id='portraitl'>
            </span>
        </p>
        <p class="mcsIpt">
            <span>备注：</span>
            <span>
                <input type="text" name="note" value="<?php echo $data[0]['s_note']?>">
            </span>
        </p>
        <p class="mcsIpt">
            <input type="submit" value="提交" id="normalMsc">
            <input type="button" value="取消" id="cancel">
        </p>
    </form>
</div>
</body>
<script src="./view/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script>
    function imageshowN(source){
        var file = source.files[0];
        var imageid = source.id;
        if (window.FileReader)
        {
            var fr = new FileReader();
            fr.onloadend = function(e) {
                document.getElementById("portraitl"+imageid).src = e.target.result;
            };
            fr.readAsDataURL(file);
        }
        $("#showImg").show();
    }
    $('#cancel').click(function () {
        window.location.href="./index.php?a=mcsinform&c=showMcsPage";
    })

</script>
</html>