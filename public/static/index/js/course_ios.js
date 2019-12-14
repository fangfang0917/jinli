var timer = {
    id: null,
    run: function (callback, time) {
        this.id = window.setInterval(callback, time);
    },
    clean: function () {
        var that = this;
        this.id = window.clearInterval(that.id);
    }
};
var keyboardHeight = 0,
    screenHeight = window.innerHeight;

// 点击切换留言板输入框
$(".comments-Ten").on('click', function () {
    $(".content-textbox").addClass("on");
    $("#liuyanText").focus();
    $('.touming').show();
    $('.bg').show();
})

$("#liuyanText").on('focus', function (evt) {
    if (!keyboardHeight) {
        timer.run(function () {
            if (screenHeight !== window.innerHeight) {
                keyboardHeight = screenHeight - window.innerHeight;
                timer.clean()
                if ($("body").attr('data-ua') == 'IOS') {
                    $("div.app-main").css({    //跟页面容器元素
                        'position': 'absolute',
                        'top': (keyboardHeight + 10) + 'px',
                    });
                }
            }
        }, 50);
        $(".touming").css({
            'height': (parseInt($(document.body).height()) - parseInt($(".content-textbox").height()) - 20)
        });
        $("#liuyanText").val();
    }
})

// document.body.addEventListener('focusout', function () { //软键盘关闭事件
//     $('.bg').hide();
//     $(".content-textbox").removeClass("on");
//     $(".app-main").removeAttr('style');
//     $('.touming').hide();
// });
$(".touming").on('click', function (evt) {
    $('.bg').hide();
    $(".content-textbox").removeClass("on");
    $(".app-main").removeAttr('style');
    $('.touming').hide();
    keyboardHeight = 0;
//     $(".content-textbox").removeClass("on");
//     $("#liuyanText").val("");
//     $('.touming').hide();
//     $('.bg').hide();
//     if ($("body").attr('data-ua') == 'IOS') {
//         $(".app-main").removeAttr('style');
//     }
})


// 留言板
$(".content-but").on('click', function (evt) {
    var text = $(".content-text textarea").val();
    var id = $('#course_id').attr('data-course-id');
    if (text == '') {
        $('.touming').hide();
        $('.bg').hide();
        $(".app-main").removeAttr('style');
        $(".content-textbox").removeClass("on");
        keyboardHeight = 0;
        _msg({title: '请填写评论', time: 1000},function () {
        });
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
                $(".app-main").removeAttr('style');
                $('.touming').hide();
                $('.bg').hide();
                $(".content-textbox").removeClass("on");
                keyboardHeight = 0;
                _msg({title: e.msg, time: 1000});
                getCourseComment();
                $('.content-textbox').removeClass('on');
                $('.comments-com-tem').show();
            }
        }
    })
    $(".content-text textarea").val("");
})