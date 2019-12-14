$(function () {
    getShare(1)
})




//分享页面切换卡
$('.share-tabimg').eq(0).show().siblings().hide();
$(".share-nav a").click(function () {
    var this_ = $(this);
    var i = $(this).index();
    var type = $(this).attr('data-type')
    this_.addClass('on').siblings().removeClass('on');
    $('.share-tabimg').eq(i).show().siblings().hide();
    getShare(type);
})

function getShare(type) {
    $.ajax({
        url: getSharePicDateUrl,
        type: "post",
        data: {
            type: type
        },
        dataType: "json",
        success: function (e) {
            $('.share-tab').html(e)
        }
    })
}


function getequity() {
    $.ajax({
        url: getequityurl,
        type: "post",
        dataType: "json",
        success: function (e) {

            $('.FenXiang-duize-tanchuang-con').html(e);
        }
    })
    $('.FenXiang-duize-tanchuang').show();
    $('.FenXiang-duize-tanchuang-top').show();
    $('.bg').show();
}


function closeq() {
    $('.FenXiang-duize-tanchuang').hide();
    $('.bg').hide();

}

