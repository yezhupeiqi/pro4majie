alert('注册成功！');
var sel = confirm('是否立即登陆？');
if(sel)
{
    $("#shade").css({display : 'block'});
// $("#login_type").empty();
    $("#login").css({display : 'block'});
    $("#regist").css({display : 'none'});
}else {
}