$(function () {
    getShare(1)
})


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

function getShare() {
    $.ajax({
        url: getSharePicDateUrl,
        type: "post",
        dataType: "json",
        success: function (e) {
            $('.share-tab').html(e)
        }
    })
}


function getequity() {
    var  type = $('.on').attr('data-type')
    console.log(type);
    $.ajax({
        url: getequityurl,
        type: "post",
        data:{
            type:1
        },
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

