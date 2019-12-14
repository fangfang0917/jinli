$(".share-nav a").click(function () {
    var this_ = $(this);
    var i = $(this).index();
    var type = $(this).attr('data-type')
    this_.addClass('on').siblings().removeClass('on');
})




$(document).find("input[name=cdkey]").bind("input propertychange", function (event) {
    var cdkey = $(document).find("input[name=cdkey]");
    var type = $('.on').attr('data-type');
    console.log(cdkey.val().length);
    if (cdkey.val().length ==8) {

        $('.zxj-over').addClass('no');
        $('.zxj-over').css('pointer-events', 'auto');
    } else {
        $('.zxj-over').removeClass('no');
        $('.zxj-over').css('pointer-events', 'none');
    }
});


$("[_setCdkey]").click(function () {
    var cdkey = $(document).find("input[name=cdkey]").val();
    var type = $('.on').attr('data-type');
    if(cdkey.length != 8){
        _msg({title:'兑换码不正确,请检查后填写',time:1000})
        return false;
    }
    var data = {
        cdkey:cdkey,
        codeType:type
    };
    _ajax(setCancodekUrl,data,function (e) {
        if(e.status == 1){
            _msg({title:e.msg,time:1000},function(){
                location.href = cdkeysuccUrl;
            })
        }else{
            _msg({title:e.msg,time:1000})
        }

    },function (e) {
        _msg({title:'网络错误!请重试',time:1000})
    })
})