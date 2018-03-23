/*
封装;
    输入参数：$div,表情的路劲或个数 返回什么结果（回调）
    输出;点击表情
方法：
    绘制UI
    显示或隐藏的方法 toggle
    设置的显示的位置 setPosition
 */
function MyExpression($div,imgCount,callback) {
    this.$div=$div;
    this.imgCount=imgCount;
    this.callback=callback;

    this.drawUI();
    this.toggle();
    this.setPosition()
}
//绘制UI
MyExpression.prototype.drawUI=function () {
    this.$div.css({
        width:"300px",
        height:"200px",
        marginTop:"-210px",
        marginLeft:"150px",
        backgroundColor:"white",
        border:"1px solid gray",
        position:"absolute"

    })
    for(var i=1;i<=this.imgCount;i++)
    {
        var $img=$("<img src='./view/imgqq/expression/"+i+".gif'/>");
        $img.click(function (event) {
        //克隆
        var $copy=$(event.target).clone();
        if(this.callback instanceof Function)
        {
            this.callback($copy);
        }
        }.bind(this));
        this.$div.append($img);
    }
}

MyExpression.prototype.toggle=function () {
    this.$div.toggle();
}

MyExpression.prototype.setPosition=function (x,y) {
    this.$div.css({
        top:"y",
        left:"x"
    })
}



