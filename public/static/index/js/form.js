$('#search').change(function () {
    var where = $(this).val();
    $.ajax({
        url: formurl,
        type: 'post',
        data: {
            where: where
        },
        dataType: 'json',
        success: function (e) {
            $('.detailsbot').html(e);
        }
    })
})
