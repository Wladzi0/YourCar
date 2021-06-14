$('.rating i').on('click', function (where, html) {
    let searchObj = $('.rating').data('object');
    let isEngine = $('.rating').data('engine');
    let ratingNum = $(this).data('value');
    $.ajax({
        method: 'POST',
        url: '/rating',
        data: {
            'isEngine': isEngine,
            'searchObj': searchObj,
            'ratingNum': ratingNum,
        },
        dataType: 'json',
        success: function (data) {
            if (data['count'] !== null) {
                document.getElementById('count').innerHTML = "(" + data['count'] + ")";
            }
            if (data['user'] === false) {
                $(".rating").append('<span class="far fa-check-circle text-success"></span>');
            }
            $(".rating i").each(function () {
                if ($(this).data('value') <= parseInt(data['rating'])) {
                    $(this).removeClass('far ');
                    $(this).addClass('fas text-warning');
                } else {
                    $(this).removeClass('fas text-warning');
                    $(this).addClass('far');
                }
            });
        }

    });
});