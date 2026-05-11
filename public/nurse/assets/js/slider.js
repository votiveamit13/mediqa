// Requires jQuery

// Initialize slider:
$(document).ready(function () {
    $(".noUi-handle").on("click", function () {
        $(this).width(50);
    });
    var rangeSlider = document.getElementById("slider-range");
    var rangeSlider2 = $("#slider-range");
    if (rangeSlider2.length > 0) {
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            prefix: ""
        });
        noUiSlider.create(rangeSlider, {
            start: 2,
            animate: false,
            tooltips: true,
            step: 1,
            range: {
                min: 2,
                max: 12
            },
            format: moneyFormat
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider.noUiSlider.on("update", function (values, handle) {
            $(".min-value-money").val(values[0]);
            $(".max-value-money").val(values[1]);
            $(".min-value").val(moneyFormat.from(values[0]));
            $(".max-value").val(moneyFormat.from(values[1]));
        });
    }
});


$(document).ready(function () {
    $(".noUi-handle").on("click", function () {
        $(this).width(50);
    });
    var rangeSlider = document.getElementById("slider-range-2");
    var rangeSlider2 = $("#slider-range-2");
    if (rangeSlider2.length > 0) {
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            prefix: ""
        });
        noUiSlider.create(rangeSlider, {
            start: 0,
            animate: false,
            tooltips: true,
            step: 10,
            range: {
                min: 0,
                max: 500
            },
            format: moneyFormat
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider.noUiSlider.on("update", function (values, handle) {
            $(".min-value-money").val(values[0]);
            $(".max-value-money").val(values[1]);
            $(".min-value").val(moneyFormat.from(values[0]));
            $(".max-value").val(moneyFormat.from(values[1]));
        });
    }
});
