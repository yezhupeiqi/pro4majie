<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品录入</title>
</head>
<script src="./view/js/angular.js"></script>
<body>
<h2>商品录入</h2>
<p>
    <span>商品类型：</span>
    <span>
        <select name="promote" onchange="modPromote()">
            <option>普通商品</option>
            <option>限时秒杀</option>
        </select>
    </span>
</p>
<div id="normal">
    <form  method="post" action="./index.php?a=goodsentry&c=addNMcs" enctype='multipart/form-data' id="formN">
        <p>
            <span>发布商品名：</span>
            <span>
                <input type="text" name="tradeName">
            </span>
        </p>
        <p>
            <span>商品价格：</span>
            <span>
                <input type="num" name="price">
            </span>
        </p>
        <p>
            <span>商品类型：</span>
            <span>
                   <select class="sele" name="typeid" size=1>
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
        </p>
        <p>
            <span>库存：</span>
            <span>
                <input type="num" name="invent">
            </span>
        </p>
        <p>
            <span>商品图片：</span>
            <span>
                <input type='file' name='file' onchange='imageshowN(this)'>
            </span>
        </p>
        <p id='showImg' style='position: absolute;margin-left: 350px;margin-top: -200px' >
            <span>
                <img src='' style='width: 200px;height: 200px'id='portraitl'>
            </span>
        </p>
        <p>
            <span>备注：</span>
            <span>
                <input type="text" name="note">
            </span>
        </p>
        <p>
            <span><input type="checkbox" name="check" value="上架"></span>
            <span>
                立即上架
            </span>
        </p>
        <p>
            <input type="submit" value="提交" id="normalMsc">
        </p>
    </form>
</div>
<div id="secondsKill" style="display: none">
    <form method="post" action="./index.php?a=goodsentry&c=addSMcs" enctype='multipart/form-data' id="formS">
        <p>
            <span>促销商品名：</span>
            <span>
                <input type="text" name="tradeName">
            </span>
        </p>
        <p>
            <span>促销商品类型：</span>
            <span>
                   <select class="sele" name="typeid" size=1>
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
        </p>
        <p>
            <span>促销日期：</span>
            <span style="font-size: 12px">
                开始日期：
                <input type="date" name="startTime">
            </span>
            <span style="font-size: 12px">
                结束日期：
                <input type="date" name="endTime">
            </span>
        </p>
        <p>
            <span>促销时间：</span>
            <span>
                   <select class="sele" name="sId" size=1>
                        <option value=1>8:00-9:00</option>
                        <option value=2>9:00-10:00</option>
                        <option value=3>10:00-11:00</option>
                        <option value=4>11:00-12:00</option>
                        <option value=5>12:00-13:00</option>
                        <option value=6>13:00-14:00</option>
                        <option value=7>14:00-15:00</option>
                        <option value=8>15:00-16:00</option>
                        <option value=9>16:00-17:00</option>
                        <option value=10>17:00-18:00</option>
                    </select>
            </span>
        </p>
        <p>
            <span>原价：</span>
            <span>
                <input type="num" name="orPrice">
            </span>
        </p>
        <p>
            <span>促销价：</span>
            <span>
                <input type="num" name="price">
            </span>
        </p>
        <p>
            <span>库存：</span>
            <span>
                <input type="num" name="invent">
            </span>
        </p>
        <p>
            <span>限购数量：</span>
            <span><input type="num" name="purchas"></span>
            <span>个</span>
        </p>
        <p>
            <span>商品图片：</span>
            <span>
                 <input type='file' name='file' onchange='imageshowS(this)'>
            </span>
        </p>
        <p id='showImgS' style='position: absolute;margin-left: 350px;margin-top: -200px'>
            <span>
                <img src='' style='width: 200px;height: 200px'id='portraitlS'>
            </span>
        </p>
        <p>
            <span>备注：</span>
            <span>
                <input type="text" name="note">
            </span>
        </p>
        <p>
            <span><input type="checkbox" name="check" value="上架"></span>
            <span>立即上架</span>
        </p>
        <p>
            <input type="submit" value="提交" id="sconedMsc">
        </p>
    </form>
</div>
</body>
<script src="./view/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script>
    function modPromote() {
        var promote=$(event.target).val();
        if(promote != '普通商品'){
            $('#normal').css('display','none');
            $('#secondsKill').css('display','block');
        }
        else {
            $('#normal').css('display','block');
            $('#secondsKill').css('display','none');
        }
    }
    //普通预览图片
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
    //秒杀预览图片
    function imageshowS(source){
        var file = source.files[0];
        var imageid = source.id;
        if (window.FileReader)
        {
            var fr = new FileReader();
            fr.onloadend = function(e) {
                document.getElementById("portraitlS"+imageid).src = e.target.result;
            };
            fr.readAsDataURL(file);
        }
        $("#showImgS").show();
    }
</script>
</html>