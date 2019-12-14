$(function () {

    var itemIndex = 0;
    var tabLoadEndArray = [1,2];
    var tabEndArray = [false, false];
    var pageing = [0, 0];
    // dropload函数接口设置
    var dropload = $('.order-box').dropload({
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
        // 2 . 上拉加载更多 回调函数
        loadDownFn: function (me) {
            $.ajax({
                type: 'post',
                url: orderlisturl,
                data: {
                    page: pageing[itemIndex],
                    type:tabLoadEndArray[itemIndex]
                },
                dataType: 'json',
                success: function (data) {
                    if (data.length <= 139) {
                        // 再往下已经没有数据
                        // 锁定
                        if (pageing[itemIndex] == 0) {
                            $('.order-list').eq(itemIndex).children('.empty').show();;
                        }
                        tabEndArray[itemIndex] =false;

                        me.lock();
                        // 显示无数据
                        me.noData();
                        me.resetload();
                        return false;
                    }
                    tabEndArray[itemIndex] =true;
                        // 加载 插入到原有 DOM 之后
                    $('.order-list').eq(itemIndex).append(data);
                    pageing[itemIndex]++; // 每次请求，页码加1
                        // 每次数据加载完，必须重置
                        me.resetload();

                },
                // 加载出错
                error: function (xhr, type) {
                    // alert('Ajax error!');
                    console.log(xhr);
                    // 即使加载出错，也得重置
                    me.resetload();
                }
            });
        },
        threshold: 50 // 什么作用???
    });


    $('.zxj-nav a').click(function () {
        var that = $(this);
        itemIndex = that.index();
        that.addClass('on').siblings().removeClass('on')
        $('.order-list').eq(itemIndex).show().siblings('.order-list').hide();

       if(tabEndArray[itemIndex]){
           dropload.lock('down');
           dropload.noData();
       }else{
           dropload.unlock();
           dropload.noData(false);
       }

        dropload.resetload();


    })
});
