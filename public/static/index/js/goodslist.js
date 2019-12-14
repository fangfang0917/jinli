var page = 0;
$(function () {
    var page = 0;//页码数
    // dropload函数接口设置
    $('.goodslist-con').dropload({
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
        loadDownFn: function (me) {
            var id = $('.zxjyx').attr('data-id');
            $.ajax({
                type: 'post',
                url: urlgoodslist,
                data: {
                    page: page,
                    classify_id: id
                },
                dataType: 'json',
                success: function (data) {

                    console.log(data);
                    if (data.data.length <= 0) {
                        // 再往下已经没有数据
                        if(page == 0){
                            $('.empty').show();
                        }
                        // 锁定
                        me.lock();
                        // 显示无数据
                        me.noData();
                        me.resetload();
                        return false;
                    }
                    var html = '';
                    var list = data.data;
                    for(var i=0;i<list.length;i++){
                        if(list[i].buy_type == 1){
                            if(list[i].on_line == 2){
                                var r ='<p class="zyj">已报名</span></p>'
                            }else{
                                var r ='<p class="zyj">已购买</span></p>'
                            }

                        }else{
                            var r ='<p class="zpvip">VIP ￥<span>'+list[i].course_vip_money+'</span></p>' +
                                '<p class="zyj">原价 <span>'+list[i].course_money+'元</span></p>'
                        }

                        html += '<a href="'+list[i].url+'">' +
                                    '<div class="done">' +
                                        '<div class="zxjleftimg">' +
                                            '<img class="zxjbigimg" src="'+list[i].course_pic+'" alt="">' +
                                            '<img class="zxjxsqg" src="'+list[i].course_pic_jiao+'" alt="">' +
                                            '<div class="zxjsee">' +
                                            '<img src="'+list[i].yanurl+'" alt="">' +
                                            '<span>'+list[i].course_look+'</span>人已观看</div>' +
                                        '</div>' +
                                        '<div class="zrightword">' +
                                            '<p class="pone">'+list[i].course_title+'</p>' +
                                            '<div class="zbotword">' +r+'</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</a>';
                    }
                        // 加载 插入到原有 DOM 之后
                        $('.zxjyxklist').append(html);
                        page++; // 每次请求，页码加1
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
});