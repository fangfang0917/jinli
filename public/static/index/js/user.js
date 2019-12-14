$(".Select-but").click(function () {
    if ($(".Select-but").hasClass('on')) {
        $(".Select-but").removeClass('on');
        $(".Select-but i").hide();
        $('.saveUppButton').css('pointer-events','none');
        $('.saveUppButton').removeClass('on');

    } else {
        var code = $('input[name=code]').val();
        if(code.length >= 6){
            $('.saveUppButton').css('pointer-events','auto');
            $('.saveUppButton').addClass('on');
        }
        $(".Select-but").addClass('on');
        $(".Select-but.on i").show();
    }
})

// 提现金额判断
$(".money").bind("input propertychange", function (event) {
    if ($('.money').val() >= 100) {
        $('.withdrawal-fom-submit').addClass('ok');
    } else {
        $('.withdrawal-fom-submit').removeClass('ok');
    }
})

$('[_tx]').click(function () {
    var auth = $(this).is('.ok');
    if (!auth) {
        return false;
    }
    $(this).css('pointer-events', 'none');

    var _tx = parseInt($('input[name=tx_amount]').val());
    var _kx = parseInt($('input[name=kt_amount]').val());

    if (_tx == '' || _tx < 100) {
        _msg({title: '提现金额错误！', time: 1000});
        $(this).css('pointer-events', 'auto');

        return false;
    }
    if (_tx > _kx) {
        _msg({title: '超出可提现金额', time: 1000});
        $(this).css('pointer-events', 'auto');

        return false;
    }
    // console.log(_tx);
    // console.log(_kx);
    // return false;
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
                _msg({title: '网络错误!请重试', time: 1000});
            }
        },
        error: function (e) {
            _msg({title: '网络错误!请重试', time: 1000});
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
var mySwiper = new Swiper('.app .swiper-container', {
    slidesPerView: 'auto',
    centeredSlides: true,
    watchSlidesProgress: true,
    pagination: '.swiper-pagination',
    paginationClickable: true,
    onProgress: function (swiper) {
        for (var i = 0; i < swiper.slides.length; i++) {
            var slide = swiper.slides[i];
            var progress = slide.progress;
            scale = 1 - Math.min(Math.abs(progress * 0.2), 1);

            es = slide.style;
            es.opacity = 1 - Math.min(Math.abs(progress / 2), 1);
            es.transform = 'translate3d(0px,0,' + (-Math.abs(progress * 150)) + 'px)';

        }
    },
});


$(document).find("input[name=card]").bind("input propertychange", function (event) {
    var card = $(document).find("input[name=card]");
    var bankcode = $(document).find("input[name=bankcode]");
    var bankname = $(document).find("input[name=bankname]");
    var realname = $(document).find("input[name=realname]");
    if (realname.val().length >=2 && bankname.val().length >=4 && bankcode.val().length >=16 && card.val().length >=15) {
        $('.btn-disabled').addClass('on');
        $('.btn-disabled').css('pointer-events', 'auto');
    } else {
        $('.btn-disabled').removeClass('on');
        $('.btn-disabled').css('pointer-events', 'none');

    }
});

$(document).find("input[name=bankcode]").bind("input propertychange", function (event) {
    var card = $(document).find("input[name=card]");
    var bankcode = $(document).find("input[name=bankcode]");
    var bankname = $(document).find("input[name=bankname]");
    var realname = $(document).find("input[name=realname]");
    if (realname.val().length >=2 && bankname.val().length >=4 && bankcode.val().length >=16 && card.val().length >=15) {
        $('.btn-disabled').addClass('on');
        $('.btn-disabled').css('pointer-events', 'auto');
    } else {
        $('.btn-disabled').removeClass('on');
        $('.btn-disabled').css('pointer-events', 'none');

    }
});
$(document).find("input[name=bankname]").bind("input propertychange", function (event) {
    var card = $(document).find("input[name=card]");
    var bankcode = $(document).find("input[name=bankcode]");
    var bankname = $(document).find("input[name=bankname]");
    var realname = $(document).find("input[name=realname]");
    if (realname.val().length >=2 && bankname.val().length >=4 && bankcode.val().length >=16 && card.val().length >=15) {

        $('.btn-disabled').addClass('on');
        $('.btn-disabled').css('pointer-events', 'auto');
    } else {
        $('.btn-disabled').removeClass('on');
        $('.btn-disabled').css('pointer-events', 'none');
    }
});
$(document).find("input[name=realname]").bind("input propertychange", function (event) {
    var card = $(document).find("input[name=card]");
    var bankcode = $(document).find("input[name=bankcode]");
    var bankname = $(document).find("input[name=bankname]");
    var realname = $(document).find("input[name=realname]");
    if (realname.val().length >=2 && bankname.val().length >=4 && bankcode.val().length >=16 && card.val().length >=15) {

        $('.btn-disabled').addClass('on');
        $('.btn-disabled').css('pointer-events', 'auto');
    } else {
        $('.btn-disabled').removeClass('on');
        $('.btn-disabled').css('pointer-events', 'none');
    }
});



$('[_setrenz]').click(function () {
    var data = {
        card:$('[name=card]').val(),
        bankcode:$('[name=bankcode]').val(),
        bankname:$('[name=bankname]').val(),
        realname:$('[name=realname]').val(),
    };
    _ajax(setBankUrl,data,function (e) {
        if(e.status == 1){
            _msg({title:e.msg,time:1000},function(){
                console.log(1111);
                location.href = userindexURl;
            })
        }else{
            _msg({title:'网络错误!请重试',time:1000},function(){
                window.location.reload()
            })
        }

    },function (e) {
        _msg({title:'网络错误!请重试',time:1000,function(){
            window.location.reload()
        }})
    })
})

$('[_zjagent]').click(function () {
    var data = {
        addr:$('[name=addr]').val(),
        realnamee:$('[name=realnamee]').val(),
    };
    _ajax('setAgent',data,function (e) {
        if(e.status == 1){
            _msg({title:e.msg,time:1000},function(){
                console.log(1111);
                location.href = userindexURl;
            })
        }else{
            _msg({title:e.msg,time:1000},function(){
                location.href = userindexURl;
            })
        }

    },function (e) {
        _msg({title:'网络错误!请重试',time:1000,function(){
                window.location.reload()
            }})
    })
})

