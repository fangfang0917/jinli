$(".Select-but").click(function () {
    if ($(".Select-but").hasClass('on')) {
        $(".Select-but").removeClass('on');
        $(".Select-but i").hide();

    } else {
        $(".Select-but").addClass('on');
        $(".Select-but.on i").show();
    }
})


$('[_tx]').click(function () {
    var auth = $(this).is('.ok');
    if (!auth) {
        return false;
    }
    $(this).css('pointer-events', 'none');

    var _tx = $('input[name=tx_amount]').val();
    var _kx = $('input[name=kt_amount]').val();

    if (_tx == '' || _tx < 100) {
        layer.msg('提现金额错误', {time: 1000});
        return false;
    }
    if (_tx > _kx) {
        layer.msg('超出可提现金额', {time: 1000});
        return false;
    }
    $.ajax({
        url: usertxurl,
        type: 'post',
        data: {
            amount: _tx
        },
        dataType: "json",
        success: function (e) {
            if (e.state == 1) {
                location.href = usertxlisturl;
            } else {
                layer.msg('网络错误!请重试', {icon: 5, time: 1000})
            }
        },
        error: function (e) {
            layer.msg('网络错误!请重试', {time: 1000})
        }
    })
})

$('#total_tx').click(function () {
    $('input[name=tx_amount]').val($('input[name=kt_amount]').val());
})


// 分享页面弹窗
$('.FenXiang-duize').on('click', function () {
    $('.FenXiang-duize-tanchuang-top').show();
})
$('.FenXiang-duize-tanchuang-hide').on('click', function () {
    $('.FenXiang-duize-tanchuang-top').hide();
})
//分享页面切换卡
$('.Fenxiang-con').eq(0).show().siblings().hide();
$(".FenXiang-nav a").click(function () {
    var this_ = $(this);
    var i = $(this).index();
    this_.addClass('on').siblings().removeClass('on');
    $('.Fenxiang-con').eq(i).show().siblings().hide();
})
$('.FenXiang-leftbut').click(function () {
    var a = $('.FenXiang-nav a.on').index();
    $('.Fenxiang-con').eq(a - 1).show().siblings().hide();
    $(".FenXiang-nav a").eq(a - 1).addClass('on').siblings().removeClass('on');
})
$('.FenXiang-rightbut').click(function () {
    var a = $('.FenXiang-nav a.on').index() + 1;
    if (a > 2) {
        a = 0;
    }
    $('.Fenxiang-con').eq(a).show().siblings().hide();
    $(".FenXiang-nav a").eq(a).addClass('on').siblings().removeClass('on');

})


function downloadIamge(selector, name) {
    // 通过选择器获取img元素，
    var img = document.querySelector(selector)
    // 将图片的src属性作为URL地址
    var url = img.src
    var a = document.createElement('a')
    var event = new MouseEvent('click')
    a.download = name || '下载图片名称'
    a.href = url
    a.dispatchEvent(event)
}

$('.new').blur(function () {
    var code = $('#codema').val();
    if (code != '') {
        $('.upphone').addClass('on');
        $('.upphone').css('pointer-events', 'auto');
        ;
    }
})

var mySwiper = new Swiper('.app .swiper-container',{
    slidesPerView : 'auto',
    centeredSlides : true,
    watchSlidesProgress: true,
    pagination : '.swiper-pagination',
    paginationClickable: true,

    onProgress: function(swiper){
        for (var i = 0; i < swiper.slides.length; i++){
            var slide = swiper.slides[i];
            var progress = slide.progress;
            scale = 1 - Math.min(Math.abs(progress * 0.2), 1);

            es = slide.style;
            es.opacity = 1 - Math.min(Math.abs(progress/2),1);
            es.transform = 'translate3d(0px,0,'+(-Math.abs(progress*150))+'px)';

        }
    },

});



