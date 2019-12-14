var EventUtil = {
    addHandler: function (element, type, handler) {
        if (element.addEventListener)
            element.addEventListener(type, handler, false);
        else if (element.attachEvent)
            element.attachEvent("on" + type, handler);
        else
            element["on" + type] = handler;
    },
    removeHandler: function (element, type, handler) {
        if (element.removeEventListener)
            element.removeEventListener(type, handler, false);
        else if (element.detachEvent)
            element.detachEvent("on" + type, handler);
        else
            element["on" + type] = handler;
    },
    /**
     * 监听触摸的方向
     * @param target            要绑定监听的目标元素
     * @param isPreventDefault  是否屏蔽掉触摸滑动的默认行为（例如页面的上下滚动，缩放等）
     * @param upCallback        向上滑动的监听回调（若不关心，可以不传，或传false）
     * @param rightCallback     向右滑动的监听回调（若不关心，可以不传，或传false）
     * @param downCallback      向下滑动的监听回调（若不关心，可以不传，或传false）
     * @param leftCallback      向左滑动的监听回调（若不关心，可以不传，或传false）
     */
    listenTouchDirection: function (target, isPreventDefault, upCallback, rightCallback, downCallback, leftCallback) {
        this.addHandler(target, "touchstart", handleTouchEvent);
        this.addHandler(target, "touchend", handleTouchEvent);
        this.addHandler(target, "touchmove", handleTouchEvent);
        var startX;
        var startY;

        function handleTouchEvent(event) {
            switch (event.type) {
                case "touchstart":
                    startX = event.touches[0].pageX;
                    startY = event.touches[0].pageY;
                    break;
                case "touchend":
                    var spanX = event.changedTouches[0].pageX - startX;
                    var spanY = event.changedTouches[0].pageY - startY;

                    if (Math.abs(spanX) > Math.abs(spanY)) {      //认定为水平方向滑动
                        if (spanX > 30) {         //向右
                            if (rightCallback)
                                rightCallback();
                        } else if (spanX < -30) { //向左
                            if (leftCallback)
                                leftCallback();
                        }
                    } else {                                    //认定为垂直方向滑动
                        if (spanY > 30) {         //向下
                            if (downCallback)
                                downCallback();
                        } else if (spanY < -30) {//向上
                            if (upCallback)
                                upCallback();
                        }
                    }

                    break;
                case "touchmove":
                    //阻止默认行为
                    if (isPreventDefault)
                    // event.preventDefault();
                        break;
            }
        }
    }
};


// 调用
function up() {
    console.log("上");
}

function down() {
    console.log("下");
}

function right() {
    var show = parseInt($(".topSwiper").attr('data-show'));
    if (show > 0) {
        $("[data-item]").addClass('hidden');
        $("[data-item]").removeClass('showlevel');
        $(".next").hide();
        $(".left").show();
        $(".left").animate({ 
            width: '100%', 
            top: 0, 
            height: '100%', 
            background:'linear-gradient(127deg,rgba(244,227,193,.7) 0%,rgba(224,182,115,.7) 100%)',
        }, 300, 'swing', function () {
            $(".left").animate({ left: '10%', }, 100, 'swing', function () {
                $("[data-item]").eq(show - 1).removeClass('hidden');
                $("[data-item]").eq(show - 1).addClass('showlevel');

                $(".next").show();
                $(".left").hide();
                $(".left").attr('style', '');
                $(".left").show();
                $(".left").hide();
                $(".topSwiper").attr('data-show', (show - 1));
            });
            var level = $("[data-item]").eq(show - 1).attr('data-level');
            var authlevel = $('input[name=userlevel]').val();
            console.log(level);
            console.log(authlevel);
            if(level!=authlevel){
                $('.agreement').show();
            }else{
                $('.agreement').hide();
            }
        });
    }
    console.log("右");

}

function left() {
    var show = parseInt($(".topSwiper").attr('data-show'));
    if (show < (parseInt($("[data-item]").length) - 1)) {
        $("[data-item]").addClass('hidden');
        $("[data-item]").removeClass('showlevel');

        $(".next").animate({ 
            width: '100%', 
            top: 0, 
            height: '100%', 
            background:'linear-gradient(127deg,rgba(244,227,193,1) 0%,rgba(224,182,115,1) 100%)',
        }, 300, 'swing', function () {
            $(".next").animate({ right: '10%', }, 100, 'swing', function () {
                $("[data-item]").eq(show + 1).removeClass('hidden');
                $("[data-item]").eq(show + 1).addClass('showlevel');
                $(".next").hide();
                $(".next").attr('style', '');
                $(".next").show();
                $(".topSwiper").attr('data-show', (show + 1));
            });

            var level = $("[data-item]").eq(show + 1).attr('data-level');
            var authlevel = $('input[name=userlevel]').val();
            console.log(level);
            console.log(authlevel);
            if(level!=authlevel){
                $('.agreement').show();
            }else{
                $('.agreement').hide();
            }
        });
    }
    console.log("左");

}

EventUtil.listenTouchDirection($(".topSwiper")[0], true, up, right, down, left)




$(function () {
    $('.topUp').click(function () {
        console.log(111111);
        if ($('input[name="chk"]').prop("checked")) {
            $(".topSuspension").css("visibility"," hidden");
            $('.open a').css('pointer-events','auto');
            $(this).removeClass('topUp')
        }else{
            $(".topSuspension").css("visibility","visible");
            $('.open a').css('pointer-events','none');
            $(this).removeClass('topUp')
        }
    });


    $("input[name='chk']").on("change", function () {
        var change = $("input[type='checkbox']").is(':checked'); //checkbox选中判断
        if (change) {
            $(".topSuspension").css("visibility"," hidden");
            $('.open a').css('pointer-events','auto');
            $(this).removeClass('topUp')
        }
    })
})


$("#deleteTop").bind("click", function () {
    $(".topSuspension").css("visibility"," hidden");

})


$(function () {
    var level = $('.showlevel').attr('data-level');
    var authlevel = $('input[name=userlevel]').val();
    console.log(level);
    console.log(authlevel);
    if(level!=authlevel){
        $('.agreement').show();
    }else{
        $('.agreement').hide();
    }
})