// var screenheight = window.screen.height / 2;
// $("#modelView").width(window.screen.width);
// $("#modelView").height(window.screen.height);
// var videoheight = $(".zy_media").height() / 2;
// var padding_top = screenheight - videoheight + 10;
// $(".playvideo").css({"top": padding_top});
// $("#modelView").css({"margin-top": -1 * (padding_top + $(".zy_media").height())});

var time = 0;
var up;


showTip();
var wH = parseInt($(window).height());
var videoH = parseInt($('.video-box').outerHeight(true));
var videoF = parseInt($('.prd-show-footer').outerHeight(true));
var detailsH = parseInt($('.details-box').outerHeight(true));

// $(".playvideo").css({"top": videoH});
// $(".details-tap").css({'top': (videoH) + 'px',})

var html = '';
html += 'window=' + wH + '<br/>';
html += 'document=' + $(document).height() + '<br/>';
html += 'body=' + $(document.body).height() + '<br/>';
html += 'outerHeight=' + $(document.body).outerHeight(true) + '<br/>';
html += 'video-box=' + (videoH + 3) + '<br/>';
html += 'UA=' + $("body").attr('data-ua') + '<br/>';
$("#w-h-rig").html(html);


// $("[data-tab-iteam]").each(function (k, v) {
//     $(v).css('height', (wH - videoH - videoF));
// });

$("[data-tab-iteam]").each(function (k, v) {
    $(v).css('min-height', (wH - videoF - detailsH));
});

var pos = $('#details-box').offset(); // offset() 获得details-box当前的位置，左上角坐标(x,y)
$(window).scroll(function () { //滚动条滚动事件
    if ($(this).scrollTop() > videoH) {
        $('#details-box').css('width', '100%').css('top', 0).css('position', 'fixed');
        $('.details-tap').css('padding-top', detailsH);
    } else if ($(this).scrollTop() <= videoH) {
        $('#details-box').css('width', '100%').css('top', 0).css('position', 'relative');
        $('.details-tap').css('padding-top', '0');
    }
})

zymedia('video', {
    mediaTitle: '媒体标题',
    nativeControls: false,
    autoplay: false,
    autoLoop: false,
    hideVideoControlsOnLoad: true,
    pauseOtherPlayers: false,
    timeFormatType: 1,
    alwaysShowControls: true,
    success: function (sc) {
        addListen(sc);
        var course_id = $('#course_id').attr('data-course-id');
        getCourseInfo(course_id, 1)
    },
    error: function (er) {

    },
    beforePlay: function (bf) {


    }
})


//获取该课程所有的章节  并排序
function getCourseInfo(id, sort) {
    console.log(id);
    console.log(sort);
    if (sort) {
        sort = sort;
    } else {
        var sort = $('.number-text').attr('data-sort');
    }
    console.log(sort);

    var course_info_id = $('#course_info_id').attr('data-id');
    var datatype = $('.directory').attr('data-type');
    $.ajax({
        url: urlcourseinfolist,
        type: 'post',
        data: {course_id: id, sort: sort, course_info_id: course_info_id},
        dataType: 'json',
        success: function (e) {
            $('.courseinfolist').html(e);
            if (sort == 1) {
                var strtext = '倒序';
                var sortch = 2;
                $('.negativebox').css('background-color', '#FFA6A0');
                $('.isbox').css('background-color', '#fff');
            } else {
                var strtext = '正序';
                var sortch = 1;
                $('.isbox').css('background-color', '#FFA6A0');
                $('.negativebox').css('background-color', '#fff');
            }
            $('.number-text').text(strtext);
            $('.number-text').attr('data-sort', sortch);
        }
    })
}

//交互获取该章节的所有评论
//交互获取该章节的所有评论
function getCourseComment() {
    var page = 0;
    //章节ID
    var id = $('#course_id').attr('data-course-id');
    console.log(id);
    $.ajax({
        url: getcommenturl,
        type: "post",
        data: {id: id, page: page},
        dataType: "json",
        success: function (e) {
            $('.commentslist').html(e);
        }
    })
}

function courseShare(course_id) {
    $.ajax({
        url: courseshareurl,
        type: "post",
        data: {
            id: course_id
        },
        dataType: "json",
        success: function (e) {
            $('.share-box').html(e)
            $('.share-box').show()
        }
    })
}

function setinccourseinfolikenum() {
    var id = $('#course_info_id').attr('data-id');
    $.ajax({
        url: urlsetinclikenum,
        type: "post",
        data: {
            id: id
        },
        dataType: "json",
        success: function (e) {
            $('#dianzan').text(e.course_info_like_num);
            _msg({title: e.msg, time: 1000});
        }
    })
}


function setlook(id) {
    $.ajax({
        url: setlookurl,
        type: "post",
        data: {
            id: id
        },
        dataType: "json",
        success: function (e) {
            console.log('setlook', e);
        }
    })
}

function addListen(v) {
    var v = $(v)[0];
    v.addEventListener('play', function () {

        var even = $('#course_info_id').attr('data-id')
        var buy = $('#play' + even).attr('data-buy');
        var look_time = $('#play' + even).attr('data-time');
        if (buy == 1) {
            $('#play' + even + ' .bofang').show();
            $('#play' + even + ' .play').hide();
            console.log(111111133333);
            v.currentTime = look_time;
        } else if (buy == 2) {
            $('#play' + even + ' .bofang').show();
            $('#play' + even + ' .st').hide();
            v.currentTime = look_time;
            console.log(111111144444);
        } else {
            _msg({title: '请购买课程', time: 1000});
            v.pause();
        }
    }, false);
    v.addEventListener('pause', function () {
        var even = $('#course_info_id').attr('data-id')
        var buy = $('#play' + even).attr('data-buy');
        if (buy == 1) {
            $('#play' + even + ' .bofang').hide();
            $('#play' + even + ' .play').show();
            console.log(1111111);
        } else if (buy == 2) {
            $('#play' + even + ' .st').show();
            $('#play' + even + ' .bofang').hide();
            console.log(1111111222);
        }

    }, false);
    var videoWrong;//定时器
    var videoJudje = false;//用于判断无法解析
    var currentTime = 0;//用于判断无法播放
    v.addEventListener("timeupdate", videoShow, false);

    function videoShow() {
        videoJudje = true;
        currentTime = v.currentTime;
        if (currentTime > 1) {
            v.removeEventListener("timeupdate", videoShow, "false");
            // clearTimeout(v);
        }
    }

    videoWrong = setTimeout(function () {
        if (videoJudje == false || currentTime == 0) {
            //此处添加发现错误视频之后的处理函数
            v.removeEventListener("timeupdate", videoShow, "false");
        }
    }, 5000);
}


function updatetime(time, course_id, course_info_id, id) {
    $.ajax({
        url: updatetimeurl,
        type: "post",
        data: {
            time: time,
            course_id: course_id,
            course_info_id: course_info_id
        },
        dataType: "json",
        success: function (e) {
            if (e.state == 1) {
                var look_time = $('#play' + id).attr('data-time');
            }
        }
    })
}

function bf(even) {
    showTip();
    var url = $('#play' + even).attr('data-url');
    var auth = $('#play' + even).attr('data-auth');
    var buy = $('#play' + even).attr('data-buy');
    var pic = $('#play' + even).attr('data-pic');
    var level = $('#play' + even).attr('data-level');
    var id = $('#play' + even).attr('data-id');
    var vip = $('#play' + even).attr('data-vip');
    var course_id = $('#play' + even).attr('data-course-id');
    var bid = $('#video').attr('data-id');
    var look_time = $('#play' + even).attr('data-time');
    var video = document.getElementById('video');
    time = video.currentTime;
    if (buy == 1) {
        $('#videos').attr('src', url);
        if (id != bid) {
            $('#video').attr('data-id', id);
            $('#course_info_id').attr('data-id', id);
            video.load();
            time = 0;
            $('.courseinfolist li div.directory-li-left div.bofang').hide();
            $('.courseinfolist li div.directory-li-left div.play').show();
        }
        if (video.paused) {
            setlook(id);
            video.play();
            video.currentTime = look_time;
            window.clearInterval(up);
            up = setInterval(function () {
                if (Math.floor(video.currentTime) > 0) {
                    updatetime(Math.floor(video.currentTime), course_id, id, even);
                }
            }, 3000);

            $('#play' + even + ' .bofang').show();
            $('.courseinfolist li div.directory-li-left div.play').show();
            console.log(video.paused+'播放');
            console.log(even);

        } else {
            video.pause();
            window.clearInterval(up);
            time = document.currentTime;
            $('.courseinfolist li div.directory-li-left div.bofang').hide();
            $('.courseinfolist li div.directory-li-left div.play').show();
            console.log(video.paused+'暂停');
            console.log(even);

        }
    } else if(buy==2) {
        $('#videos').attr('src', url);
        if (id != bid) {
            $('#video').attr('data-id', id);
            $('#course_info_id').attr('data-id', id);
            video.load();
            time = 0;
            $('.courseinfolist li div.directory-li-left div.bofang').hide();
            $('.courseinfolist li div.directory-li-left div.st').show();
        }
        if (video.paused) {
            setlook(id);
            video.play();
            video.currentTime = look_time;
            window.clearInterval(up);
            up = setInterval(function () {
                if (Math.floor(video.currentTime) > 0) {
                    updatetime(Math.floor(video.currentTime), course_id, id, even);
                }
            }, 3000);

            $('#play' + even + ' .bofang').show();
            $('#play' + even + ' .st').hide();
            console.log(video.paused+'开始');
            console.log(even);
        } else {
            video.pause();
            window.clearInterval(up);
            time = document.currentTime;
            $('#play' + even + ' .bofang').hide();
            $('#play' + even + ' .st').show();
            console.log(video.paused+'暂停');
            console.log(even);
        }
    }else{
        _msg({title: '请购买课程', time: 1000});
        video.pause();
    }
}