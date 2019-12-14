//分享
var urlBay = window.location.href.split('#')[0] // 当前页面的url ps:'#'前边的路径
// 首页banner
var IndexindexindexBanner = new Swiper('.banner .swiper-container', {
    autoplay: 2000,
    speed: 500,
    autoplayDisableOnInteraction: false,
    loop: true,
    direction: "horizontal",
});
// 首页tab卡轮播导航
var IndexindexindexNav = new Swiper('.detailstop .swiper-container', {
    slidesPerView: 4
});
// 锦鲤Kid轮播
var IndexgoodslistindexBanner = new Swiper('.goodsbanner .swiper-container', {
    autoplay: 2000,
    speed: 500,
    autoplayDisableOnInteraction: false,
    loop: true
});
// 个人中心轮播
var IndexuserindexBanner = new Swiper('.upgrade-Brocade .swiper-container', {
    pagination: '.upgrade-Brocade .swiper-container .swiper-pagination',
    paginationClickable: true,
    autoplay: 2000,
    speed: 500,
    autoplayDisableOnInteraction: false,
    loop: true
});
// VIP课程介绍课程轮播
// var advertisingswiper = new Swiper('.advertisingbot .swiper-container', {
//     direction: "horizontal",
// })
// // 首页课程轮播
// var advertisingbanner = new Swiper('.advertising-banner .swiper-container.cur', {
//     // autoplay: 2000,
//     autoplayDisableOnInteraction: true,
//     updateOnImagesReady : true,
//     loop: true,
// });
// VIP课程介绍课程列表
var advertisingplayswiper = new Swiper('.advertising-play .swiper-container', {
    slidesPerView: 3.4,
    loop: false,
    spaceBetween: 4,
    direction: "horizontal",
});
var welfareswiper = new Swiper('.upgrade-tab .swiper-container', {
    slidesPerView: 3,
    spaceBetween: 10,
    direction: "horizontal"
});
var welfareswipers = new Swiper('.privilege-body .privilege-banner', {
    slidesPerView: 1,
});

// // 弹窗选项卡
// var upgradetabswiper = new Swiper('.mian .swiper-container', {
//     pagination: '.swiper-pagination',
//     slidesPerView: 3,
//     paginationClickable: true,
//     spaceBetween: 8
// });
// // 购买弹出框轮播
// var welfareswiper = new Swiper('.welfare-two-bot .swiper-container', {
// // 代理页面轮播
// var agencyswiper = new Swiper('.agency-banner .swiper-container', {
//     direction: 'horizontal',
//     // loop: true,
//     slidesPerView: "auto",
//     centeredSlides: true,
//     spaceBetween: 5,
// });
// // 特权
// var privilegeBreakbanner = new Swiper('.privilege-Break-banner .swiper-container', {
//     slidesPerView: 3,
//     spaceBetween: 12
// });

// 课程弹框多选
$('.upgrade-tab .swiper-slide').click(function () {
    var _this = $(this);
    if (_this.find('.upgrade-state').hasClass('show')) {
        _this.find('.upgrade-state').removeClass('show').addClass('hide');
    } else if (_this.find('.upgrade-state').hasClass('hide')) {
        _this.find('.upgrade-state').removeClass('hide').addClass('show');
    } else {
        _this.find('.upgrade-state').addClass('show');
    }
    if ($('.upgrade-state.show').length == 5) {
        $('.upgrade-but').addClass('ok');
    } else if ($('.upgrade-state.show').length < 5) {
        $('.upgrade-but').removeClass('ok');
    } else if ($('.upgrade-state.show').length > 5) {
        layer.msg('只可以选择5个课程', {time: 1000});
        _this.find('.upgrade-state').removeClass('show');
    }
})

$('.upgrade-but').click(function () {
    var auth = $(this).is('.ok');
    if (!auth) {
        layer.msg('该礼包课程请选择5课', {time: 1000})
        return false;
    }
    var len = $('.show').length;
    var str = '';
    for (var i = 0; i < len; i++) {
        if (i > 0) {
            str = str + ',' + $('.show').eq(i).attr('data-id');
        } else {
            str = str + $('.show').eq(i).attr('data-id');
        }
    }
    $.ajax({
        url: setusercourseurl,
        type: "post",
        data: {
            str: str
        },
        dataType: "json",
        success: function (e) {
            layer.msg(e.msg, {time: 1000})
            setInterval(function () {
                location.href = getCache("backUrk");
            }, 2000)
        }
    })
})

function showLingQu() {
    $('.upgrade-tk').css('opacity', 1);
    $('.upgrade-tk').css('z-index', 25);
    $('[data-auth="qy"]').hide();
}

function succbuyvip() {
    $.post(authPhoneurl, {url: urlBay, type: 1}, function (e) {
        if (e.state == 1) {
            showLingQu();
            return false
        } else {
            location.href = setCoursePhoneUrl;
            return false
        }
    })
}


function buyCourse(id) {
    var is_online = $('#on_line').attr('data-on-line');
    var url = window.location.href;
    if (is_online == 2) {
        $.post(authPhoneurl, {url: url, type: 2}, function (e) {
            if (e.state == 2) {
                layer.msg("请绑定手机号后购买!", {time: 1000}, function () {
                    setCache('backUrk', urlBay);
                    setCache('backAction', "buyCourse");
                    location.href = setCoursePhoneUrl + '?bk=2';
                    return false;
                });
            }
        })
    }
    $.ajax({
        url: buyCourseUrl,
        type: "post",
        data: {
            id: id,
            url: urlBay,
        },
        dataType: "json",
        success: function (e) {
            if (e.data.status == 1) {
                onBridgeReady(e.WxConifg, e.data, 'buyCourse');
            }
        }
    })
}

/**
 * 自主升级
 * @param level
 */
function levelUpNotBuy(level) {
    $.ajax({
        url: levelUpNotBuyUrl,
        type: "post",
        data: {
            level: level
        },
        dataType: "json",
        success: function (e) {
            if (e.status == 1) {
                layer.msg(e.msg, {time: 1000})
            } else {
                layer.msg('网络错误!请重试', {time: 1000})

            }
            setInterval(function () {
                location.reload();
            }, 1500)
        }
    })
}

function levelUp(level) {
    $.ajax({
        url: buyLevelUrl,
        type: "post",
        data: {
            level: level,
            url: urlBay
        },
        dataType: "json",
        success: function (e) {
            if (e.data.status == 1) {
                onBridgeReady(e.WxConifg, e.data, 'levelUp');
            } else {
                layer.msg(e.data.msg, {time: 1000});
            }
        }
    })
}

function buyVip() {
    $.ajax({
        url: buyVipUrl,
        type: "post",
        data: {
            url: urlBay,
        },
        dataType: "json",
        success: function (e) {
            if (e.data.status == 1) {
                onBridgeReady(e.WxConifg, e.data, 'buyVip');
            } else {
                layer.msg(e.data.msg, {time: 1000});
            }
        }
    })
}

function noVip() {
    $.ajax({
        url: noVipUrl,
        type: "post",
        data: {t: 1},
        dataType: "json",
        success: function (e) {
            layer.msg(e.msg, {time: 1000}, function () {
                window.location.href = '/Index/index/index.html';
            })
        }
    })
}

function onBridgeReady(WxConfig, data, buy_type) {
    // paySuc(WxConfig, data, buy_type);
    // return false;
    WeixinJSBridge.invoke('getBrandWCPayRequest', WxConfig, function (res) {
        switch (res.err_msg) {
            case 'get_brand_wcpay_request:ok':
                paySuc(WxConfig, data, buy_type);
                break;
            case 'get_brand_wcpay_request:cancel':
                layer.msg('取消支付', {time: 1000})
                break;
            default:
                alert(res.err_msg, 'xxxxxxxxxxxxxx');
                break;
        }
    });
}


function paySuc(WxConfig, data, buy_type) {
    setCache('backUrk', urlBay)
    setCache('backAction', buy_type)
    if (buy_type == 'buyCourse') {
        layer.msg('购买成功!', {time: 1000}, function () {
            window.location.reload();
        })
    } else if (buy_type == 'buyVip' && data.is_vip_libao == 0) {
        $('[data-auth="qy"]').show();
        $('.bg').show();
    } else if (buy_type == 'levelUp' && data.is_vip_libao == 0) {
        $('[data-auth="qy"]').show();
        $('.bg').show();
    } else if (buy_type == 'levelUp' && data.is_vip_libao == 1) {
        $('.bg').show();
        $('[data-auth="hz"]').show();
        $('[data-auth="hz"]').find('.vip-biaoti').html('恭喜您成为锦鲤' + data.levelText);
        $('[data-auth="hz"]').find('.close').show();
        $('#VIPZ' + data.level).show().siblings().hide();
    }
    return false;
}



function ll() {
console.log(111111111);
}


function showlibao() {
    $('[data-auth="qy"]').show();
    $('.bg').show();
}