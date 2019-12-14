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
    autoplay: 4000,
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
        _msg({title: '只可以选择5个课程', time: 1000}, function () {
            _this.find('.upgrade-state').removeClass('show');
        });
    }
})

$('.upgrade-but').click(function () {
    var auth = $(this).is('.ok');
    if (!auth) {
        _msg({title: '该礼包课程请选择5课', time: 1000});
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
            _msg({title: e.msg, time: 1000}, function () {
                setInterval(function () {
                    location.href = getCache("backUrk");
                }, 2000)
            });
        }
    })
})

function showLingQu() {
    $('.bg').show();
    $('.upgrade-tk').css('opacity', 1);
    $('.upgrade-tk').css('z-index', 25);
    $('[data-auth="qy"]').hide();
    $('.bg').show();
}

function succbuyvip() {
    if (checkPhoneStr() == false) {
        _msg({title: '请绑定手机号后购买!', time: 1000}, function () {
            setCache('backUrk', urlBay);
            setCache('backAction', "buyCourse");
            location.href = setCoursePhoneUrl + '?bk=2';
        });
    } else {
        showLingQu();
    }
    return false;
}


function checkPhoneStr() {
    var p = $("body").attr("data-phone").length;
    if (p == 11) {
        return true;
    } else {
        return false;
    }
}

function buyCourse(id) {
    if (checkPhoneStr() == false) {
        _msg({title: '请绑定手机号后购买!', time: 1000}, function () {
            setCache('backUrk', urlBay);
            setCache('backAction', "buyCourse");
            location.href = setCoursePhoneUrl + '?bk=2';
            return false;
        });
        return false;
    } else {
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
                    onBridgeReady(e.WxConifg, e.data, 'buyCourse', id);
                } else {
                    _msg({title: e.data.msg, time: 1000}, function () {
                        location.href = OrderUrl;
                    });
                }
            }
        })
    }
}

/**
 * 自主升级
 * @param level
 */
function levelUpNotBuy(level) {
    if (checkPhoneStr() == false) {
        _msg({title: '请绑定手机号后购买!', time: 1000}, function () {
            setCache('backUrk', urlBay);
            setCache('backAction', "levelUp");
            location.href = setCoursePhoneUrl + '?bk=2';
            return false;
        });
        return false;
    } else {
        $.ajax({
            url: levelUpNotBuyUrl,
            type: "post",
            data: {
                level: level
            },
            dataType: "json",
            success: function (e) {
                if (e.status == 1) {
                    if (level == 2) {
                        var leveltext = '院长';
                    } else if (level == 3) {
                        var leveltext = '联创';

                    } else if (level == 4) {
                        var leveltext = '合伙人';

                    }
                    var data = {is_vip_libao: 1, level: level, levelText: leveltext}
                    paySuc(data, 'levelUp');
                } else {
                    _msg({title: '网络错误!请重试', time: 1000}, function () {
                        location.reload();
                    });
                }
            }
        })
    }
}

function levelUp(level) {
    if (checkPhoneStr() == false) {
        _msg({title: '请绑定手机号后购买!', time: 1000}, function () {
            setCache('backUrk', urlBay);
            setCache('backAction', "levelUp");
            location.href = setCoursePhoneUrl + '?bk=2';
            return false;
        });
        return false;
    } else {
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
                    _msg({title: e.data.msg, time: 1000});
                }
            }
        })
    }
}

function buyVip() {
    if (checkPhoneStr() == false) {
        _msg({title: '请绑定手机号后购买!', time: 1000}, function () {
            setCache('backUrk', urlBay);
            setCache('backAction', "buyVip");
            location.href = setCoursePhoneUrl + '?bk=2';
            return false;
        });
        return false;
    } else {
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
                    _msg({title: e.data.msg, time: 1000});
                }
            }
        })
    }
}

function noVip() {
    $.ajax({
        url: noVipUrl,
        type: "post",
        data: {t: 1},
        dataType: "json",
        success: function (e) {
            _msg({title: e.msg, time: 1000}, function () {
                window.location.href = '/Index/index/index.html';
            });
        }
    })
}

function onBridgeReady(WxConfig, data, buy_type, id = 0) {
    // paySuc(data, buy_type);
    // return false;
    WeixinJSBridge.invoke('getBrandWCPayRequest', WxConfig, function (res) {
        switch (res.err_msg) {
            case 'get_brand_wcpay_request:ok':
                paySuc(data, buy_type, id);
                break;
            case 'get_brand_wcpay_request:cancel':
                _msg({title: '取消支付', time: 1000});
                break;
            default:
                _msg({title: res.err_msg, time: 1000});
                break;
        }
    });
}


function paySuc(data, buy_type, id) {
    setCache('backUrk', urlBay)
    setCache('backAction', buy_type)
    $('.FenXiang-duize-tanchuang').hide();
    $('.bg').hide();
    if (buy_type == 'buyCourse') {
        _msg({title: '购买成功', time: 1000}, function () {
            location.href = coursesuccUrl + "?id=" + id;
        });
    } else if (buy_type == 'buyVip' && data.is_vip_libao == 0) {
        $('.bg').show();
        $('[data-auth="hz"]').show();
        $('[data-auth="hz"]').find('.vip-biaoti').html('恭喜您成为锦鲤' + data.levelText);
        $('[data-auth="hz"]').find('.close').show();
        $('#VIPZ' + data.level).show().siblings().hide();
    } else if (buy_type == 'levelUp' && data.is_vip_libao == 0) {
        $('.bg').show();
        $('[data-auth="hz"]').show();
        $('[data-auth="hz"]').find('.vip-biaoti').html('恭喜您成为锦鲤' + data.levelText);
        $('[data-auth="hz"]').find('.close').show();
        $('#VIPZ' + data.level).show().siblings().hide();
    } else if (buy_type == 'levelUp' && data.is_vip_libao == 1) {
        $('.bg').show();
        $('[data-auth="hz"]').show();
        $('[data-auth="hz"]').find('.vip-biaoti').html('恭喜您成为锦鲤' + data.levelText);
        $('[data-auth="hz"]').find('.close').show();
        $('#VIPZ' + data.level).show().siblings().hide();
    }
    return false;
}

function showlibao() {
    $('.upgrade-tk').show();
    $('.bg').show();
}

function checkCardStr() {
    var c = $("body").attr("data-card");
    if (c != 0) {
        return true;
    } else {
        return false;
    }
}


//提现前置
function goUserTx() {
    if (checkPhoneStr() == false) {
        _msg({title: '请绑定手机号后提现!', time: 1000}, function () {
            setCache('backUrk', urlBay);
            setCache('backAction', "buyVip");
            location.href = setCoursePhoneUrl + '?bk=2';
            return false;
        });
        return false;
    } else {
        if (checkCardStr() == false) {
            _msg({title: '请进行实名认证!', time: 1000}, function () {
                setCache('backUrk', urlBay);
                setCache('backAction', "buyVip");
                location.href = setBankUrl + '?bk=2';
                return false;
            });
            return false;
        } else {
            location.href = UserTxUrl;
        }
    }
}


/**
 * 申请终极代理
 */
function setAgent() {

    location.href = 'zjagent';

}


$("[_renz]").click(function (e) {
    var phone = $('.User_index').attr('data-phone');
    if (phone == 0) {
        location.href = setCoursePhoneUrl;
    } else {
        location.href = setBankUrl;
    }

})


///测试购买课程
//
// function buyCourse(id) {
//     if (checkPhoneStr() == false) {
//         _msg({title: '请绑定手机号后购买!', time: 1000}, function () {
//             setCache('backUrk', urlBay);
//             setCache('backAction', "buyCourse");
//             location.href = setCoursePhoneUrl + '?bk=2';
//             return false;
//         });
//         return false;
//     } else {
//         $.ajax({
//             url: buyCourseUrl,
//             type: "post",
//             data: {
//                 id: id,
//                 url: urlBay,
//             },
//             dataType: "json",
//             success: function (e) {
//                 if (e.data.status == 1) {
//                     location.href =coursesuccUrl+ "?id="+id;
//                 }else{
//                     _msg({title: e.data.msg, time: 1000}, function () {
//                         location.href = OrderUrl;
//                     });
//                 }
//             }
//         })
//     }
// }
//
function closeq() {
    $('.FenXiang-duize-tanchuang').hide();
    $('.bg').hide();
}


$(function () {
    $("#checkbox").click(function () {
        if (this.checked == true) {
            $('.zxj-lj').css('opacity', '1')
        } else {
            $('.zxj-lj').css('opacity', '0')
        }
    })
})


$('.zxjdone .zxj-buy a').click(function () {
    $('.FenXiang-duize-tanchuang').css('display', 'block');
    $('.bg').show()
    var level = $(this).attr('data-level');
    console.log(level);
    if(level == 1){
    var str = "<a class='zxj-lj' onclick='buyVip()'>立即购买</a>"
        $('.innertc').after(str);
    }else if(level == 2||level == 3||level == 4){
        var str = "<a class='zxj-lj' onclick='levelUp("+level+")'>立即购买</a>"
        $('.innertc').after(str);
    }else if(level == 5){
        var str = "<a class='zxj-lj' onclick='setAgent()'>立即购买</a>"
        $('.innertc').after(str);
    }
})


















