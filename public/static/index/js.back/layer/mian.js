
// 弹窗选项卡
var upgradetabswiper = new Swiper('.mian .swiper-container', {
    pagination: '.swiper-pagination',
    slidesPerView: 3,
    paginationClickable: true,
    spaceBetween: 8
});


// 购买弹出框轮播
var welfareswiper = new Swiper('.welfare-two-bot .swiper-container', {
    slidesPerView: 3,
    spaceBetween: 10,
    direction: "horizontal"
});
// 代理页面轮播
var agencyswiper = new Swiper('.agency-banner .swiper-container', {
    direction: 'horizontal',
    // loop: true,
    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween: 5,
});
// 锦鲤Kid轮播
var goodsswiper = new Swiper('.goodsbanner .swiper-container', {
    autoplay: 2000,
    speed: 500,
    autoplayDisableOnInteraction: false,
    loop: true
});
// 特权
var privilegeBreakbanner = new Swiper('.privilege-Break-banner .swiper-container', {
    slidesPerView: 3,
    spaceBetween: 12
});


// 个人中心轮播
var Brocadeswiper = new Swiper('.upgrade-Brocade .swiper-container', {
    pagination: '.upgrade-Brocade .swiper-container .swiper-pagination',
    paginationClickable: true,
    autoplay: 2000,
    speed: 500,
    autoplayDisableOnInteraction: false,
    loop: true
});

// 首页banner

var bannerswiper = new Swiper('.banner .swiper-container', {
    autoplay: 2000,
    speed: 500,
    autoplayDisableOnInteraction: false,
    loop: true,
    direction: "horizontal",
});

// 首页标题轮播
var advertisingswiper = new Swiper('.advertisingbot .swiper-container', {
    direction: "horizontal",
})
// 首页课程轮播
var advertisingbanner = new Swiper('.advertising-banner .swiper-container.cur', {
    loop: true,
});
// 首页tab卡轮播导航
var detailstopswiper = new Swiper('.detailstop .swiper-container', {
    slidesPerView: 4

});
// 首页播放跳转轮播
var advertisingplayswiper = new Swiper('.advertising-play .swiper-container', {
    slidesPerView: 3,
    loop: true,
    spaceBetween: 4,
    direction: "horizontal",
});


$(function () {
    $('.upgrade-tkhide').click(function(){
        $('.upgrade-tk').css({
            'opacity':0,
            'z-index':-1
        })
        $('.bg').hide();
    })
    // 首页tab卡点击效果
    $('.detailsa').click(function () {
        var this_ = $(this);
        this_.addClass('on').siblings().removeClass('on');
    })
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
        } else if ($('.upgrade-state.show').length<5) {
            $('.upgrade-but').removeClass('ok');
        }else if($('.upgrade-state.show').length>5){
            layer.msg('只可以选择5个课程',{time:1000});
             _this.find('.upgrade-state').removeClass('show');
        }
    })
    // 提现金额判断
    $('.money').blur(function () {
        console.log($('.money').val());
        if ($('.money').val() >= 100) {
            $('.withdrawal-fom-submit').addClass('ok');
        } else {
            $('.withdrawal-fom-submit').removeClass('ok');
        }
    })
    // 客服中心弹窗背景
    $('.service-bot-cont').click(function () {
        $('.bg').show();
    })
    $('.Select-but').click(function () {
        if ($('.Select-but').hasClass('on')) {
            if ($('#codema').val() != "") {
                $('.btn-disabled').addClass('on');
                $('.btn-disabled').css('pointer-events', 'auto');

            }
        } else {
            $('.btn-disabled').removeClass('on');
            $('.btn-disabled').css('pointer-events', 'none');

        }
    })

    // 点击切换留言板输入框
    $(".comments-Ten").on('click', function () {
        $(".content-textbox").addClass("on").siblings().hide();
        $('.touming').show();
    })
    $('.touming').click(function(){
          $(".content-textbox").removeClass("on").siblings().show();
          $('.touming').hide();
    })
    //tab卡切换
    var tableBoxDom = $('[data-action="tabBox"]');
    tableBoxDom.find('[data-tab]').click(function (e) {
        var index = $(this).index();
        tableBoxDom.find("[data-tab]").removeClass("on");
        tableBoxDom.find("[data-tab]").eq(index).addClass("on");
        // console.log(tableBoxDom.find("[data-tab]"),index,$(this).text(),$(this));
        // console.log(tableBoxDom.data('item'))
        var tableItelBOx = $("[data-itel-box='" + tableBoxDom.data('item') + "']").find("[data-tab-iteam]");
        tableItelBOx.hide();
        tableItelBOx.eq(index).fadeIn();

        //tab切入切出视频
        var $videImgIndex = e.target.dataset.index;
        if($videImgIndex == 0) {
            $('.playvideo .zy_media').css('display','none');
            $('.playvideo #modelView').css('display','block');
        }else if($videImgIndex == 1) {
            $('.playvideo .zy_media').css('display','block');
            $('.playvideo #modelView').css('display','none');
        };
    });

    // 弹窗隐藏
    $("[__close]").click(function () {
        var down = $("[__close]");
        var name = down.data('for').split("|");
        for (var i = 0; i < name.length; i++) {
            $("." + name[i]).hide();
        }
    })
});

//点击navDOM，对应的列表显示其余的其他的隐藏
// Cname--点击的元素数组
//AClass--新增名称
// boxDOM--对应切换的盒子名称
function Tab(Cname, AClass, boxDOM) {
    $("." + Cname).on('click', function () {
        var this_ = $(this);
        var i = this_.index();
        this_.addClass(AClass).siblings().removeClass(AClass);
        $('.' + boxDOM).eq(i).fadeIn().siblings().fadeOut();
    })
}
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



// 时间选择
$('.lajitong').click(function () {
    $('[ _on]').html("选择日期");
    $('[_an]').html("起始日期");
    $('[_bn]').html("结束日期");
})
$("[_rwm]").click(function () {
    $('[_cou]').show();
    $('[ _hide]').hide();

})
// // 首页搜索跳转
// $('.index-shousuo').focus(function () {
//     window.location.href = "index-search.html";
// })
// 首页搜索结果页清除
$('.bi').click(function () {
    $('#search').val('');
})
// 视频播放
// document.body.style.overflow='hidden';


function buyVip() {
    $.ajax({
        url: buyVipUrl,
        type: "post",
        dataType: "json",
        success: function (e) {
            $('.bag-box').show();
            $('.bg').show();
        }
    })
}

function buyCourse(id) {
    $.ajax({
        url: buyCourseUrl,
        type: "post",
        data: {
            id: id
        },
        dataType: "json",
        success: function (e) {
            layer.msg(e.msg, {time: 1000})
            setInterval(function () {
                location.reload();
            }, 2000)
        },
        error: function (e) {
            console.log(e)
        }
    })
}

function levelUp(level) {
    console.log(level);
    $.ajax({
        url: buyLevelUrl,
        type: "post",
        data: {
            level: level
        },
        dataType: "json",
        success: function (e) {
            layer.msg(e.msg, {time: 1000})
            setInterval(function () {
                location.reload();
            }, 2000)
        },
        error: function (e) {
            console.log(e)
        }
    })
}


//分享页面切换卡
$('.share-tabimg').eq(0).show().siblings().hide();
$(".share-nav a").click(function () {
    var this_ = $(this);
    var i = $(this).index();
    this_.addClass('on').siblings().removeClass('on');
    $('.share-tabimg').eq(i).show().siblings().hide();
})
var IndexNum = 0; 
$('.share-btnleft').click(function () {
    // .attr("data-index");
    var a =$('.share-tabimg.a img');
    IndexNum = a+1;
    console.log(a,IndexNum);
    for(var key in a){
        var it = a[key]
        if(it){
            console.log(it);
        }
    }
    if(a>$('.share-tabimg.a img').length-1){
    var b =$('.share-tabimg.a img').length-1;
    console.log(b);
    $('.share-tabimg.a img').attr("data-index",b);
    }

})
$('.share-btnright').click(function () {
$('.share-tabimg img').next().attr("data-i","1").siblings().attr("data-i","0");
})


function succbuyvip() {
    var url = window.location.href;
    $.getJSON(authPhoneurl,{url:url},function (e) {
          if(e.state == 1){
              $('.upgrade-tk').css('opacity',1);
              $('.upgrade-tk').css('z-index',25);
              $('.bg').show();
              $('.bag-box').hide();
          }else{
              location.href =setCoursePhoneUrl;
          }
    })
}
function setusercourse() {
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
                location.reload();
            }, 2000)
        },
        error: function (e) {
            console.log(e)
        }
    })
}


//分享
var urlBay = window.location.href.split('#')[0] // 当前页面的url ps:'#'前边的路径
$.ajax({
    url: shareweixin, //请求后台加载数据的路径改成你自己的
    type:"post",
    data: "urlBay=" + encodeURIComponent(urlBay),  //强烈注意：这里需要这样写
    success: function(data) { //此处的data为后台返回的json 数据
        // console.log(data);
        wx.config({
            debug: false, //是否 开启调试模式,建议调试的时候debug 改为true
            appId: data.wxConfig.appId, // 必填，公众号的唯一标识
            timestamp: data.wxConfig.timestamp, // 必填，生成签名的时间戳
            nonceStr: data.wxConfig.nonceStr, // 必填，生成签名的随机串
            signature: data.wxConfig.signature, // 必填，签名，见附录1
            jsApiList: [
                // 'checkJsApi',
                'updateAppMessageShareData',
                'updateTimelineShareData',
                'onMenuShareAppMessage',
                'onMenuShareTimeline',
                'showOptionMenu',
            ] // 必填，需要使用的JS接口列表 声明
        });
        wx.error(function(res) {
            // console.log(res.errMsg);
        });
        window.onload = function() {
            // alert("当前域名是："+url);
            // console.log(data.url);
        }
        wx.ready(function() {
            wx.onMenuShareAppMessage({
                debug: false,
                title: '锦鲤妈妈', // 分享标题
                desc: '欢迎加入我们', // 分享描述
                link: data.url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: "http://jinli.sxzywl.net/static/uploads/img/20191009/be516671a4bddc7501b0b74adb7ea0c3.png", // 分享图标
                success: function(e) {
                    // 用户点击了分享后执行的回调函数
                    // console.log(e);
                }
            });
            wx.onMenuShareTimeline({
                debug: false,
                title: '锦鲤妈妈', // 分享标题
                desc: '欢迎加入我们', // 分享描述
                link: data.url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: "http://jinli.sxzywl.net/static/uploads/img/20191009/be516671a4bddc7501b0b74adb7ea0c3.png", // 分享图标
                success: function(e) {
                    // 用户点击了分享后执行的回调函数
                    // console.log(e);
                }
            });
            wx.updateAppMessageShareData({
                debug: false,
                title: '锦鲤妈妈', // 分享标题
                desc: '欢迎加入我们', // 分享描述
                link: data.url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: "http://jinli.sxzywl.net/static/uploads/img/20191009/be516671a4bddc7501b0b74adb7ea0c3.png", // 分享图标
                success: function(e) {
                    // 用户点击了分享后执行的回调函数
                    // console.log(e);
                }
            });
            wx.updateTimelineShareData({
                debug: false,
                title: '锦鲤妈妈', // 分享标题
                desc: '欢迎加入我们', // 分享描述
                link: data.url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: "http://jinli.sxzywl.net/static/uploads/img/20191009/be516671a4bddc7501b0b74adb7ea0c3.png", // 分享图标
                success: function(e) {
                    // 用户点击了分享后执行的回调函数
                    // console.log(e);
                }
            });
        });
    }
})
