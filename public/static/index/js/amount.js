jQuery(window).scroll(function () {
    //获取当前滚动条高度
    var data = {
        docTop: $(document).scrollTop(),
        docHeig: $(document).height(),
        winHeight: $(window).height(),
        innerHeight: window.innerHeight,
    };
    //判断如果滚动区域大于页面高度执行回调
    var max = parseInt($(".wallet-number").height()) + parseInt($('.wallet-con').height()) + 10;
    console.log((data.docTop - max));
    if ((data.docTop - max) < 10) {
        if ($(".fliex-top").hasClass('fliex-top-on') == true) {
            $(".fliex-top").removeClass('fliex-top-on');
        }
    }
    if ((data.docTop - max) > 10) {
        if ($(".fliex-top").hasClass('fliex-top-on') == false) {
            $(".fliex-top").addClass('fliex-top-on');
        }
    }
});

$(function () {
    getAmountlist();
    getAmountjc();
})

$('#ser_list').click(function () {
    var that = $(this);
    var where = that.attr('data-id');
    if (where == 1) {
        $('.wallet-body').hide();
        $('#form').show();
    } else {
        $('.earning-body').hide();
        $('#form').show();
    }
})

function getlist(type) {
    var monthtime = $('input[name=mothtime]').val();
    var daystime = $('input[name=daystime]').val();
    var dayetime = $('input[name=dayetime]').val();
    var wheretype = $('input[name=wheretype]').val();
    var arr = {
        'monthtime': monthtime,
        'daystime': daystime,
        'dayetime': dayetime,
        'wheretype': wheretype
    }
    getAmountlist(arr, type);
    getAmountjc(arr);
}

//钱包里的收益明细
function getAmountlist(where, type) {
    if (where) {
        var whe = where;
    } else {
        var myDate = new Date();

        var year = myDate.getFullYear();        //获取当前年
        var month = myDate.getMonth() + 1;   //获取当前月
        var date = myDate.getDate();            //获取当前日


        var h = myDate.getHours();              //获取当前小时数(0-23)
        var m = myDate.getMinutes();          //获取当前分钟数(0-59)
        var s = myDate.getSeconds();

        var now = year + '-' + getNow(month) + "-" + getNow(date);
        var whe = { 'monthtime': now, 'wheretype': 1 };
    }
    $.ajax({
        url: amountlisturl,
        type: "post",
        data: {
            whe
        },
        dataType: "json",
        success: function (e) {

            $('.amount-list').html(e);
            if (whe.wheretype == 2) {
                str = whe.daystime.split('-');
                var string = str[1] + '月';
            } else {
                str = whe.monthtime.split('-');
                var string = str[1] + '月';
            }
            $('#ser_list').html(string);
            $('#form').hide();
            if (type == 1) {
                $('.wallet-body').show();
            } else {
                $('.earning-body').show();
            }

        }
    })
}

//结余    收益
function getAmountjc(where) {
    if (where) {
        var whe = where;
    } else {
        var myDate = new Date();
        var year = myDate.getFullYear();        //获取当前年
        var month = myDate.getMonth() + 1;   //获取当前月
        var date = myDate.getDate();            //获取当前日
        var h = myDate.getHours();              //获取当前小时数(0-23)
        var m = myDate.getMinutes();          //获取当前分钟数(0-59)
        var s = myDate.getSeconds();
        var now = year + '-' + getNow(month) + "-" + getNow(date);
        var whe = { 'monthtime': now, 'wheretype': 1 };
    }
    $.ajax({
        url: amountjc,
        type: "post",
        data: {
            whe
        },
        dataType: "json",
        success: function (e) {
            $('#jcamount').html(e.jcamount);
            $('#totalamount').html(e.totalamount);
        }
    })
}

function getNow(s) {
    return s < 10 ? '0' + s : s;
}

$.selectDate("#select_3", {
    start: 1994,
    end: 2099,
    select: [2012, 5, 6],
    title: '请选择时间'
}, function (data) {
    $('input[name=dayetime]').val(data.year + '-' + data.month + '-' + data.day);

});
$.selectDate("#select_2", {
    start: 1994,
    end: 2099,
    select: [2012, 5, 6],
    title: '请选择时间'
}, function (data) {
    $('input[name=daystime]').val(data.year + '-' + data.month + '-' + data.day);

});
$.selectDateSimple("#select_1", {
    start: 1994,
    end: 2099,
    select: [2012, 5],
    title: '请选择时间'
}, function (data) {
    $('input[name=mothtime]').val(data.year + '-' + data.month);
});

$('#selectid').change(function () {
    var that = $(this);
    var type = that.val();
    $('input[name=wheretype]').val(type);

    if (type == 2) {
        $('.select-box').show();
        $('#select_1').hide();

    } else {
        $('#select_1').show();
        $('.select-box').hide();


    }
});
