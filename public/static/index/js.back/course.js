var screenheight = window.screen.height / 2;
$("#modelView").width(window.screen.width);
$("#modelView").height(window.screen.height);
var videoheight = $(".zy_media").height() / 2;
var padding_top = screenheight - videoheight;
$(".playvideo").css({"top": padding_top});
// $("#modelView").css({"margin-top": -1 * (padding_top + $(".zy_media").height())});

var time = 0;
var up;

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
    if (sort) {
        sort = sort;
    } else {
        var sort = $('.number-text').attr('data-sort');
    }
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
function getCourseComment() {
    var page = 0;
    //章节ID
    var id = $('#course_info_id').attr('data-id');
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
            _msg({title: e.msg,time:1000});
        }
    })
}

// 留言板
$('.content-but').click(function () {
    var text = $(".content-text textarea").val();
    var id = $('#course_info_id').attr('data-id');
    if (text == '') {
        _msg({title:'请填写评论',time:1000});
        return false;
    }
    $.ajax({
        url: setcommenturl,
        type: "post",
        data: {
            id: id,
            text: text
        },
        dataType: "json",
        success: function (e) {
            if (e.state == 1) {
                _msg({title:e.msg,time:1000});
                getCourseComment();
                $('.content-textbox').removeClass('on');
                $('.comments-com-tem').show();
            }
        }
    })
    $(".content-text textarea").val("");
})

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
        var auth = $('#play' + even).attr('data-auth');
        var buy = $('#play' + even).attr('data-buy');
        var vip = $('#play' + even).attr('data-vip');
        var level = $('#level').attr('data-level');
        var look_time = $('#play' + even).attr('data-time');
        if (buy > 0) {
            $('#play' + even + ' .bofang').show();
            $('#play' + even + ' .play').hide();
            v.currentTime = look_time;
        } else {
            if (level > 0) {
                if (vip == 1) {
                    $('#play' + even + ' .bofang').show();
                    $('#play' + even + ' .play').hide();
                    v.currentTime = look_time;

                } else {
                    if (auth == 1) {
                        $('#play' + even + ' .bofang').show();
                        $('#play' + even + ' .st').hide();
                        v.currentTime = look_time;
                    } else {
                        _msg({title:'请购买课程',time:1000});
                        v.pause();
                    }
                }
            } else {
                if (auth == 1) {
                    $('#play' + even + ' .bofang').show();
                    $('#play' + even + ' .st').hide();
                    v.currentTime = look_time;
                } else {
                    _msg({title:'请购买课程',time:1000});
                    v.pause();
                }
            }
        }


    }, false);
    v.addEventListener('pause', function () {
        var even = $('#course_info_id').attr('data-id')
        var auth = $('#play' + even).attr('data-auth');
        var buy = $('#play' + even).attr('data-buy');
        var vip = $('#play' + even).attr('data-vip');
        var level = $('#level').attr('data-level');
        if (buy > 0) {
            $('#play' + even + ' .bofang').hide();
            $('#play' + even + ' .play').show();
        } else {
            if (level > 0) {
                if (vip == 1) {
                    $('#play' + even + ' .bofang').hide();
                    $('#play' + even + ' .play').show();
                } else {
                    if (auth == 1) {
                        $('#play' + even + ' .bofang').hide();
                        $('#play' + even + ' .st').show();
                    }
                }
            } else {
                if (auth == 1) {
                    $('#play' + even + ' .bofang').hide();
                    $('#play' + even + ' .st').show();
                }
            }
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
    if (buy > 0) {
        var video = document.getElementById('video');
        time = video.currentTime;
        $('#videos').attr('src', url);
        $('#video').attr('poster', pic);
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
            $('#play' + even + ' .play').hide();

        } else {
            video.pause();
            window.clearInterval(up);
            time = document.currentTime;
            $('#play' + even + ' .bofang').hide();
            $('#play' + even + ' .play').show();

        }
    } else {
        if (level > 0) {
            if (vip == 1) {
                var video = document.getElementById('video');
                time = video.currentTime;
                $('#videos').attr('src', url);
                $('#video').attr('poster', pic);
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
                    $('#play' + even + ' .play').hide();

                } else {
                    video.pause();
                    window.clearInterval(up);
                    time = document.currentTime;
                    $('#play' + even + ' .bofang').hide();
                    $('#play' + even + ' .play').show();

                }
            } else {
                if (auth == 1) {
                    // alert('会员可试听')
                    var video = document.getElementById('video');
                    time = video.currentTime;
                    $('#videos').attr('src', url);
                    $('#video').attr('poster', pic);
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
                        $('#play' + even + ' .bofang').show();
                        $('#play' + even + ' .st').hide();
                    } else {
                        video.pause();
                        // window.clearInterval(up);
                        time = document.currentTime;
                        $('#play' + even + ' .bofang').hide();
                        $('#play' + even + ' .st').show();
                    }
                } else {
                    _msg({title:'请购买课程',time:1000});
                }
            }
        } else {
            if (auth == 1) {
                // alert('会员可试听')
                var video = document.getElementById('video');
                time = video.currentTime;
                $('#videos').attr('src', url);
                $('#video').attr('poster', pic);
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
                    $('#play' + even + ' .bofang').show();
                    $('#play' + even + ' .st').hide();
                } else {
                    video.pause();
                    // window.clearInterval(up);
                    time = document.currentTime;
                    $('#play' + even + ' .bofang').hide();
                    $('#play' + even + ' .st').show();
                }
            } else {
                _msg({title:'请购买课程',time:1000});
            }
        }
    }
}