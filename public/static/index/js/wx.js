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
        'hideMenuItems',
    ] // 必填，需要使用的JS接口列表 声明
});
wx.error(function (res) {
    console.log(res.errMsg);
});
wx.ready(function () {
    wx.hideMenuItems({
        menuList: [
            'menuItem:editTag',
            'menuItem:delete',
            'menuItem:copyUrl',
            'menuItem:originPage',
            'menuItem:readMode',
            'menuItem:openWithQQBrowser',
            'menuItem:openWithSafari',
            'menuItem:share:email',
            'menuItem:share:brand',
            'menuItem:share:qq',
            'menuItem:share:weiboApp',
            'menuItem:share:facebook',
            'menuItem:share:QZone',
            'menuItem:setFont',
            'menuItem:exposeArticle',
        ] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
    });
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
    // console.info(e);
}

$(document).on('click', "a[data-banner-type]", function () {
    var dom = $(this);
    var b_type = dom.attr('data-banner-type');
    var b_level = dom.attr('data-banner-level');
    switch (b_type) {
        case "5":
            window.location.href = '/index/user/equity2.html';
            break;
        case "4":
            // succbuyvip();
            break;
        case "6":
            window.location.href = '/index/user/equity2.html?level=' + b_level;
            break;
        case "3":
            window.location.href = '/index/user/share.html';
            break;
        case "7":
            if (dom.attr('t-href').length != 0) {
                window.location.href = dom.attr('t-href');
            }
            break;
    }
    return false;
});

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
$("#liuyanText").bind("input propertychange", function (event) {
    var $text = $("#liuyanText");
    var len = $text.val().length;
    $text.next('.content-number').children('.showinfo-numder').text(len);
    if (len >= 140) {
        $text.val($text.val())
    }
});


// 首页搜索结果页清除
$('.bi').click(function () {
    $('#search').val('');
})


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
    if ($("body").hasClass('Course_detail')) {
        showTip();
    }
});



function checkPhoneHasOn() {

    if ($(document).find("body.User_phone").find('div.Select-but').length == 1) {
        if ($(document).find("body.User_phone").find('div.Select-but').hasClass('on')) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}
$(document).find("body.User_phone").find("input[name='phone']").bind("input propertychange", function (event) {
    var phone = $(document).find("body.User_phone").find("input[name='phone']");
    var code = $(document).find("body.User_phone").find("input[name='code']");
    if (phone.val().length == 11 && code.val().length == 6 && checkPhoneHasOn()) {
        $('.saveUppButton').addClass('on');
        $('.saveUppButton').css('pointer-events', 'auto');
    } else {
        $('.saveUppButton').removeClass('on');
        $('.saveUppButton').css('pointer-events', 'none');
    }
});
$(document).find("body.User_phone").find("input[name='code']").bind("input propertychange", function (event) {
    var phone = $(document).find("body.User_phone").find("input[name='phone']");
    var code = $(document).find("body.User_phone").find("input[name='code']");
    if (phone.val().length == 11 && code.val().length == 6 && checkPhoneHasOn()) {
        $('.saveUppButton').addClass('on');
        $('.saveUppButton').css('pointer-events', 'auto');
    } else {
        $('.saveUppButton').removeClass('on');
        $('.saveUppButton').css('pointer-events', 'none');
    }
});



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
        _msg({title: '手机号码有误，请重填!', time: 1000});
        return false;
    }
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
                _msg({title: '已发送', time: 1000});
            } else if (e.status == 2) {
                _msg({title: e.msg, time: 1000});
            } else {
                _msg({title: '网络错误!请重试', time: 1000});
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
    $("[data-auth]").hide();
    window.location.reload();
    $('.bg').hide();
})

$('[_phone]').click(function () {
    var t = $(this).is('.on');
    $(this).css('pointer-events', 'none');
    var phone = $('input[name=phone]').val()
    var code = $('input[name=code]').val()
    var realname = $('input[name=realname]').val()
    var card = $('input[name=card]').val()
    var bankname = $('input[name=bankname]').val()
    if (!t) {
        return false;
    }
    $.ajax({
        url: setPhoneurl,
        type: "post",
        data: {
            phone: phone,
            code: code,
            realname: realname,
            card: card,
            bankname: bankname,
        },
        dataType: "json",
        success: function (e) {
            if (e.state == 1) {
                _msg({title: e.msg, time: 1000}, function () {
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
                _msg({title: e.msg, time: 1000});
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

jQuery(window).ready(function () {
    // alert(2222);
    if (browserInit().direction != 'vertical') {
        layer.closeAll();
        $(".app-main").hide();
        $(".vertical").show();
    } else {
        $(".app-main").show();
        $(".vertical").hide();
    }
});

//替换弹窗地址
function showtop(url, title, type) {
    $('.bg').show();
    $('.rwm .rwm-img img').attr('src', url)
    $('.rwm .rwm-t h2').text(title)
    $('.rwm .rwm-b span').text(type)
    $('.rwm').show();
}

function showTip() {
    layer.tips('分享邀好友轻松赚奖金', '.courseShare', {
        tips: [1, '#FFFFFF'],
        time: 3000,
        success: function (e) {
            e.css({
                top: '.9rem',
                left: '63%',
            });
        }
    });
}

function browserInit() {
    var u = navigator.userAgent;
    var versions = {
        trident: u.indexOf('Trident') > -1, //IE内核
        presto: u.indexOf('Presto') > -1, //opera内核
        webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
        gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
        mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
        ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
        android: u.indexOf('Android') > -1 || u.indexOf('Adr') > -1, //android终端
        iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
        iPad: u.indexOf('iPad') > -1, //是否iPad
        webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
        weixin: u.indexOf('MicroMessenger') > -1, //是否微信 （2015-01-22新增）
        qq: u.match(/\sQQ/i) == "qq" //是否QQ
    };
    var UA = {};
    var Height = document.documentElement.clientHeight;
    var Width = document.documentElement.clientWidth;
    var direction = (Height > Width) ? 'vertical' : ((Width > Height) ? 'transverse' : 'null');
    if (versions.weixin) {
        UA = {
            title: '微信端',
            type: 'weixin',
            versions: versions,
            direction: direction,
            language: (navigator.browserLanguage || navigator.language).toLowerCase(),
        };
    } else if (versions.iPad) {
        UA = {
            title: 'PAD端',
            type: 'pad',
            versions: versions,
            direction: direction,
            language: (navigator.browserLanguage || navigator.language).toLowerCase(),
        };
    } else if (versions.ios || versions.android || versions.mobile) {
        UA = {
            title: '移动端',
            type: 'mobile',
            versions: versions,
            direction: direction,
            language: (navigator.browserLanguage || navigator.language).toLowerCase(),
        };
    } else {
        UA = {
            title: 'PC端',
            type: 'pc',
            versions: versions,
            direction: direction,
            language: (navigator.browserLanguage || navigator.language).toLowerCase(),
        };
    }
    return UA;
}

function _msg(json, close) {
    var title = json.title ? json.title : false;
    var time = json.time ? json.time : 2000;
    var offset = json.offset ? json.offset : 'auto';
    layer.msg(title, {
        time: time,
        shade: 0,
        offset: offset,
        anim: parseInt(5 * Math.random() + 1),
        tips: [2, '#000000']
    }, function () {
        if (jQuery.isFunction(close)) {
            return close(close);
        }
    });
}

function _ajax(url,data,callback,error,type,dataType) {
    var type  =  type ? type : 'post' ;
    var dataType  =  dataType ? dataType : 'json' ;
    if(jQuery.isFunction(callback)){
        var succ = callback;
    }else{
        console.error('is not function');
        return false;
    }
    if(jQuery.isFunction(error)){
        var err = error;
    }else{
        console.error('is not function');
        return false;
    }
      $.ajax({
          url:url,
          type:type,
          data:data,
          dataType:dataType,
          success:succ,
          error:err
      })
}
