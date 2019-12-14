$(function () {
    var page = $('#page').attr('data-id');
    // dropload函数接口设置
    $('.detailsbot').dropload({
        scrollArea: window,
        // 下拉刷新模块显示内容
        autoLoad: true,
        distance: 50,
        domUp: {
            domClass: 'dropload-up',
            // 下拉过程显示内容
            domRefresh: '<div class="dropload-refresh">↓下拉刷新</div>',
            // 下拉到一定程度显示提示内容
            domUpdate: '<div class="dropload-update">↑释放更新</div>',
            // 释放后显示内容
            domLoad: '<div class="dropload-load"><span class="loading"></span>加载中...</div>'
        },
        domDown: {
            domClass: 'dropload-down',
            // 滑动到底部显示内容
            domRefresh: '<div class="dropload-refresh">↑上拉加载更多</div>',
            // 内容加载过程中显示内容
            domLoad: '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
            // 没有更多内容-显示提示
            domNoData: '<div class="dropload-noData"></div>'
        },
        // // 1 . 下拉刷新 回调函数
        // loadUpFn : function(me){
        //     page = 0;
        //     var classify_id = $('#course_classify_id').attr('data-id');
        //     $.ajax({
        //         type: 'post',
        //         // 每次获取最新的数据即可
        //         url: urlindex,
        //         data:{
        //             page:page,
        //             classify_id:classify_id
        //         },
        //         dataType: 'json',
        //         success: function(data){;
        //             // 为了测试，延迟1秒加载
        //             setTimeout(function(){
        //                 // 插入加载使用 html() 重置 DOM
        //                 $('.course_list').html(data);
        //                 // 每次数据加载完，必须重置
        //                 me.resetload();
        //             },1000);
        //         },
        //         // 加载出错
        //         error: function(xhr, type){
        //             // alert('Ajax error!');
        //             // // 即使加载出错，也得重置
        //             // me.resetload();
        //         }
        //     });
        // },
        // 2 . 上拉加载更多 回调函数
        loadDownFn: function (me) {
            var classify_id = $('#course_classify_id').attr('data-id');
            $.ajax({
                type: 'post',
                url: urlindex,
                data: {

                    page: page,
                    classify_id: classify_id
                },
                dataType: 'json',
                success: function (data) {
                    if (data.length <= 103) {
                        // 再往下已经没有数据
                        // 锁定
                        if (page == 0) {
                            $('.course_list').append(data);
                        }
                        me.lock();
                        // 显示无数据
                        me.noData();
                        me.resetload();
                        return false;
                    }
                    // 为了测试，延迟1秒加载
                    setTimeout(function () {
                        // 加载 插入到原有 DOM 之后
                        $('.course_list').append(data);
                        page++; // 每次请求，页码加1
                        // 每次数据加载完，必须重置
                        me.resetload();
                    }, 1000);
                },
                // 加载出错
                error: function (xhr, type) {
                    // alert('Ajax error!');
                    // 即使加载出错，也得重置
                    // me.resetload();
                }
            });
        },
        threshold: 50 // 什么作用???
    });
    //自动更新课程列表高度
    var $selfHeight = $('.advertising-play .swiper-slide').css('height');
    $('.self-lib-load-more').css('height', $selfHeight);
    // var len = $('.advertising-banner .swiper-slide .advertisingbot').length;
    // console.log(len);
    // for(var i=0;i<len;i++){
    //     var course_id = $('.advertisingbot').eq(i).attr('data-courseId');
    //     // console.log(course_id,6);
    //     getZcourseinfo(course_id,6,i)
    // }
});

$.ajax({
    url: "/Index/index/uppSharePic.html",
    type: "post",
    data: {
        page: 0,
    },
    dataType: "json",
    success: function (e) {
        console.log(e);
    }
})


function getCourselist(course_classify_id, page, url) {
    $.ajax({
        url: urlindex,
        type: "post",
        data: {
            page: 0,
            classify_id: course_classify_id
        },
        dataType: "json",
        success: function (e) {
            $('#course_classify_id').attr('data-id', course_classify_id);
            $('#page').attr('data-id', page);
            $('.course_list').html(e);
        }
    })
}

function getZcourseinfo(id, num, even) {
    window.location.href = "/index/course/detail/id/" + id;
    // var that = $(even);
    // console.log(that.parents('div.advertising-play'));
    // $.ajax({
    //     url: getZcourseinfoUrl,
    //     type: "post",
    //     data: {
    //         id: id, num: num
    //     },
    //     dataType: "json",
    //     success: function (e) {
    //         that.parents('div.advertising-play').html(e)
    //         var advertisingplayswiper = new Swiper('.advertising-play .swiper-container', {
    //             slidesPerView: 3.4,
    //             loop: false,
    //             spaceBetween: 4,
    //             direction: "horizontal",
    //         });
    //     },
    //     error: function (e) {
    //         console.log(e);
    //     }
    // })
}
