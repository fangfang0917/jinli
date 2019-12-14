wx.config({
    debug: wxCofnigData.debug,
    appId: wxCofnigData.appId,
    timestamp: wxCofnigData.timestamp,
    nonceStr: wxCofnigData.nonceStr,
    signature: wxCofnigData.signature,
    jsApiList: [
        // 'checkJsApi',
        'updateAppMessageShareData',
        'updateTimelineShareData',
        'onMenuShareAppMessage',
        'onMenuShareTimeline',
        'showOptionMenu',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
    ] // 必填，需要使用的JS接口列表 声明
});
wx.error(function (res) {
    console.log(res.errMsg);
});
wx.ready(function () {
    wx.onMenuShareAppMessage({
        debug: false,
        title: shareTitle,
        desc: shareDesc,
        link: shareUrl,
        imgUrl: shareIcon, // 分享图标
        success: function (e) {
            // 用户点击了分享后执行的回调函数
            shareBack();
        }
    });
    wx.onMenuShareTimeline({
        debug: false,
        title: shareTitle,
        desc: shareDesc,
        link: shareUrl,
        imgUrl: shareIcon, // 分享图标
        success: function (e) {
            // 用户点击了分享后执行的回调函数
            shareBack();
        }
    });
    wx.updateAppMessageShareData({
        debug: false,
        title: shareTitle,
        desc: shareDesc,
        link: shareUrl,
        imgUrl: shareIcon, // 分享图标
        success: function (e) {
            // 用户点击了分享后执行的回调函数
            shareBack();
        }
    });
    wx.updateTimelineShareData({
        debug: false,
        title: shareTitle,
        desc: shareDesc,
        link: shareUrl,
        imgUrl: shareIcon, // 分享图标
        success: function (e) {
            // 用户点击了分享后执行的回调函数
            shareBack(e);
        }
    });
});

$("[share-pyq]").click(function () {
    alert("pyq");
    wx.onMenuShareTimeline({
        title: shareTitle,
        link: shareUrl,
        imgUrl: shareIcon, // 分享图标
        success: function () {
            // 用户点击了分享后执行的回调函数
        }
    });
})
$("[share-wx]").click(function () {
    wx.onMenuShareAppMessage({
        title: shareTitle,
        desc: shareDesc,
        link: shareUrl,
        imgUrl: shareIcon, // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
            // 用户点击了分享后执行的回调函数
        }
    });
})

function shareBack(e) {
    console.log('分享创建成功...');
}

// 四叶草小图标组件显示
$('.floating-box').click(function () {
    $('.bg').show();
    $('.floating-nav').show();
    $(".floating-box").hide();
})
// 弹窗隐藏
$("[__close]").click(function () {
    if (typeof ($(this).attr('data-ref')) != 'undefined') {
        window.location.reload();
    }
    var down = $("[__close]");
    var name = down.data('for').split("|");
    for (var i = 0; i < name.length; i++) {
        $("." + name[i]).hide();
    }
    if ($("body.Index_index").length > 0) {

    } else {
        $('.floating-box').show();
    }

})
// 客服中心弹窗背景
$('.service-bot-cont').click(function () {
    $('.bg').show();
});
// 提现金额判断
$('.money').blur(function () {
    if ($('.money').val() >= 100) {
        $('.withdrawal-fom-submit').addClass('ok');
    } else {
        $('.withdrawal-fom-submit').removeClass('ok');
    }
})
// 点击切换留言板输入框
$(".comments-Ten").on('click', function () {
    $(".content-textbox").addClass("on").siblings().hide();
    $(".content-textbox textarea").focus();
    $('.touming').show();
})
//留言板显示字数
$(".content-textbox textarea").keydown(function (e) {
    var $text = $(".content-textbox textarea");
    var len = $text.val().length;
    $text.next('.content-number').children('.showinfo-numder').text(len);
    if (len >= 140) {
        $text.val($text.val())
    }
})
$('.touming').click(function () {
    $(".content-textbox").removeClass("on").siblings().show();
    $('.touming').hide();
})
// 首页搜索结果页清除
$('.bi').click(function () {
    $('#search').val('');
})

//替换弹窗地址
function showtop(url, title, type) {
    $('.rwm .rwm-img img').attr('src', url)
    $('.rwm .rwm-t h2').text(title)
    $('.rwm .rwm-b span').text(type)
    $('.rwm').show();
}

if ($("[data-showAuth]").length == 1) {
    if ($("[data-showAuth]").attr('data-showAuth') == 1) {
        $("[data-showAuth]").show();
        $('.bg').show();
    }
}

$(".side").click(function () {
    $(".share-box").hide();
});
// 首页tab卡点击效果
$('.detailsa').click(function () {
    var this_ = $(this);
    this_.addClass('on').siblings().removeClass('on');
})
//tab卡切换
var tableBoxDom = $('[data-action="tabBox"]');
tableBoxDom.find('[data-tab]').click(function (e) {
    var index = $(this).index();
    tableBoxDom.find("[data-tab]").removeClass("on");
    tableBoxDom.find("[data-tab]").eq(index).addClass("on");
    var tableItelBOx = $("[data-itel-box='" + tableBoxDom.data('item') + "']").find("[data-tab-iteam]");
    tableItelBOx.hide();
    tableItelBOx.eq(index).fadeIn();
});
$('.Select-but').click(function () {
    if ($('.Select-but').hasClass('on')) {
        if ($('#codema').val() != "") {
            $('.saveUppButton').addClass('on');
            $('.saveUppButton').css('pointer-events', 'auto');
        }
    } else {
        $('.saveUppButton').removeClass('on');
        $('.saveUppButton').css('pointer-events', 'none');
    }
})

$('#J_GetCode').on('click', function () {
    $('#J_GetCode').sendCode({
        disClass: 'btn-disabled',
        secs: 60,
        run: false,
        runStr: '{%s}秒后重新获取',
        resetStr: '重新获取验证码'
    });
    var phone = $('input[name=phone]').val();
    if (!(/^1[13456789]\d{9}$/.test(phone))) {
        layer.msg("手机号码有误，请重填", {time: 1000});
        return false;
    }
    // YDUI.dialog.loading.open('发送中');
    $.ajax({
        url: Phoneurl,
        type: "post",
        data: {
            phone: phone
        },
        dataType: "json",
        success: function (e) {
            YDUI.dialog.loading.close();
            if (e.status == 1) {
                $('#J_GetCode').sendCode('start');
                // YDUI.dialog.toast('已发送', 'success', 1500);
            } else if (e.status == 2) {
                YDUI.dialog.toast(e.msg, 'error', 1500);
            } else {
                YDUI.dialog.toast('网络错误!请重试', 'error', 1500);
            }

        }
    })
});
// 时间选择
$('.lajitong').click(function () {
    $('[_on]').html("选择日期");
    $('[_an]').html("起始日期");
    $('[_bn]').html("结束日期");
})
// 首页弹窗单选
$('[_cur]').click(function () {
    var this_ = $(this);
    var i = this_.index();
    var dom = this_.find('.boutique-box');
    $('[_cur]').find('.boutique-box').removeClass('on');
    dom.addClass('on');
    $('.choose').hide();
    $('.choose').eq(i).show();

})
$('.upgrade-tkhide').click(function () {
    $('.upgrade-tk').css({
        'opacity': 0,
        'z-index': -1
    })
    $('.bg').hide();
})
$('[_phone]').click(function () {
    var t = $(this).is('.on');
    $(this).css('pointer-events', 'none');
    var phone = $('input[name=phone]').val()
    var code = $('input[name=code]').val()
    if (!t) {
        return false;
    }
    $.ajax({
        url: setPhoneurl,
        type: "post",
        data: {
            phone: phone,
            code: code
        },
        dataType: "json",
        success: function (e) {
            if (e.state == 1) {
                layer.msg(e.msg, {time: 1000}, function () {
                    if (e.type != 0) {
                        if (getCache('backAction') == 'buyVip') {
                            location.href = getCache("backUrk");
                        }
                        if (getCache('backAction') == 'buyCourse') {
                            location.href = getCache("backUrk");
                        }
                    } else {
                        location.href = userindexURl;
                    }
                });
            } else {
                layer.msg(e.msg, {time: 1000})
            }
        }
    })
})
//点击navDOM，对应的列表显示其余的其他的隐藏
// Cname--点击的元素数组
// AClass--新增名称
// boxDOM--对应切换的盒子名称
function Tab(Cname, AClass, boxDOM) {
    $("." + Cname).on('click', function () {
        var this_ = $(this);
        var i = this_.index();
        this_.addClass(AClass).siblings().removeClass(AClass);
        $('.' + boxDOM).eq(i).fadeIn().siblings().fadeOut();
    })
}

$("[_rwm]").click(function () {
    $('[_cou]').show();
    $('[ _hide]').hide();
})


$(function () {
    var IndexNum = 0;
    $('.share-btnleft').click(function () {
        var boxlen = $('.share-tabimg').length;
        for (var i = 0; i < boxlen; i++) {
            if ($('.share-tabimg').eq(i).css('display') != 'none') {
                var num = i
            }
        }
        var $a = $('.share-tabimg').eq(num).children('img');
        var len = $('.share-tabimg').eq(num).children('img').length;
        if (len > 1) {
            $a.attr('data-i', 0);
            IndexNum--;
            if (IndexNum < 0) {
                IndexNum = len;
            }
            ;
            for (var key in $a) {
                var it = $a[key];
                if (it.constructor === HTMLImageElement) {
                    var newIndex = parseInt(it.dataset.index);
                    if (parseInt(IndexNum) === newIndex) {
                        $(`[data-index=${newIndex}]`).attr('data-i', 1);
                        $(`[data-index=${newIndex}]`).show().siblings().hide();
                    }
                }
            }
        }
    })
    $('.share-btnright').click(function () {
        var boxlen = $('.share-tabimg').length;
        for (var i = 0; i < boxlen; i++) {
            if ($('.share-tabimg').eq(i).css('display') != 'none') {
                var num = i
            }
        }
        var $a = $('.share-tabimg').eq(num).children('img');
        var len = $('.share-tabimg').eq(num).children('img').length;
        if (len > 1) {
            $a.attr('data-i', 0);
            IndexNum++;
            if (IndexNum > len) {
                IndexNum = 0;
            }
            ;
            for (var key in $a) {
                var it = $a[key];

                if (it.constructor === HTMLImageElement) {
                    var newIndex = parseInt(it.dataset.index);
                    if (parseInt(IndexNum) === newIndex) {
                        $(`[data-index=${newIndex}]`).attr('data-i', 1);
                        $(`[data-index=${newIndex}]`).show().siblings().hide();

                    }
                }
            }
        }
    })
});



function _msg(json, close) {
    var title = json.title ? json.title : false;
    var time = json.time ? json.time : 2000;
    layer.msg(title, {
        time: time,
        shade: 0,
        anim: parseInt(5 * Math.random() + 1),
        tips: [2, '#000000']
    }, function () {
        if (jQuery.isFunction(close)) {
            return close();
        }
    });
}