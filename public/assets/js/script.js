var unitPrice;
var selectedCurrency;

$(document).ready(function () {
    changeSelectedCurrency(currencies[0].id);

    $('input[name="currency"]').on("change", function () {
        changeSelectedCurrency($('input[name="currency"]:checked').val());
    });

    $("#submitOrder").on("click", function () {
        if ($(this).hasClass("disable")) return;

        let name, phone, amount, accountType, country, currency;

        $(".err").removeClass("err");

        name = $("#name").val();
        phone = $("#phone").val();
        amount = $("#amount").val();
        accountType = $('input[name="accountType"]:checked').val();
        currency = selectedCurrency;
        country = $('select[name="country"]').val();

        let hasErr = false;

        if (name.length === 0 || phone.length === 0) {
            if (name.length === 0) $("#name").addClass("err");
            if (phone.length === 0) $("#phone").addClass("err");
            hasErr = true;
            $(".buyer").addClass("errBorder");
        } else {
            $("#name").removeClass("err");
            $("#phone").removeClass("err");
            $(".buyer").removeClass("errBorder");
        }

        if (amount.length === 0 || currency === undefined) {
            if (amount.length === 0) $("#amount").addClass("err");
            $(".amount").addClass("errBorder");
            hasErr = true;
        } else {
            $("#amount").removeClass("err");
            $(".amount").removeClass("errBorder");
        }

        if (accountType === undefined) {
            hasErr = true;
            $(".accountType").addClass("errBorder");
        } else {
            $(".accountType").removeClass("errBorder");
        }

        if (country === undefined) {
            hasErr = true;
            $(".country").addClass("errBorder");
        } else {
            $(".country").removeClass("errBorder");
        }

        if (hasErr) {
            $("#errText").removeClass("hidden");
            return;
        } else $("#errText").addClass("hidden");

        $("#submitOrder").addClass("disable");
        $("#loading").removeClass("hidden");

        $.ajax({
            type: "post",
            url: submitOrderUrl,
            data: {
                name: name,
                phone: phone,
                amount: amount,
                accountType: accountType,
                country: country,
                currency: currency.id,
            },
            success: function (res) {
                $("#submitOrder").removeClass("disable");
                $("#loading").addClass("hidden");

                if (res.status === "ok") document.location.href = res.url;
                else document.location.href = res.errUrl;
            },
        });
    });

    $('input[name="amount"]').on("change paste keyup", setTotalPrice);
});

$(document, 'input[name="country"]').on("change", function () {
    setPrice();
});

function isNumber(evt) {
    evt = evt ? evt : window.event;
    var charCode = evt.which ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$.ajaxSetup({
    error: function (XMLHttpRequest, textStatus, errorThrown) {
        var errs = JSON.parse(XMLHttpRequest.responseText).errors;

        if (errs instanceof Object) {
            var errsText = "";

            Object.keys(errs).forEach(function (key) {
                errsText += errs[key] + "<br />";
            });
        } else {
            var errsText = "";

            for (let i = 0; i < errs.length; i++) errsText += errs[i].value;
        }
    },
});

function changeSelectedCurrency(selectedId) {
    // $(".currency_price").addClass("hidden");

    $(".currency").removeClass("selected");
    $("#currency_" + selectedId).addClass("selected");

    selectedCurrency = currencies.find((e) => e.id == selectedId);

    if (selectedCurrency === undefined) return;
    let html = "";
    let options =
        selectedCurrency.countries.length > 1
            ? "<option value='-1'>کشور مقصد</option>"
            : "";

    for (let i = 0; i < selectedCurrency.countries.length; i++) {
        let country = selectedCurrency.countries[i];
        let checked = selectedCurrency.countries.length === 1;

        options +=
            "<option value='" + country.id + "'>" + country.name + "</option>";
        html += "<div>";
        if (checked) {
            html +=
                '<input checked name="country" value="' +
                country.id +
                '" id="' +
                country.id +
                '" type="radio">';
        } else {
            html +=
                '<input name="country" value="' +
                country.id +
                '" id="' +
                country.id +
                '" type="radio">';
        }
        html += '<label for="' + country.id + '">';
        html += "<span>" + country.name + "</span>";
        html += "</label>";
        html += "</div>";
    }

    $("#country_options").empty().append(options);
    $("#countries").empty().append(html);

    unitPrice = selectedCurrency.price;

    // if (selectedCurrency.countries.length > 1) {
    //     unitPrice = selectedCurrency.countries[0].price;
    //     // $("#currency_" + selectedCurrency.id + "_price")
    //     //     .empty()
    //     //     .append(unitPrice);
    //     // $("#currency_" + selectedCurrency.id + "_price_div").removeClass(
    //     //     "hidden"
    //     // );
    //     setTotalPrice();
    // } else setPrice();
}

function setPrice() {
    const selectedCurrencyId = $('input[name="currency"]:checked').val();

    const selectedCurrency = currencies.find((e) => e.id == selectedCurrencyId);
    if (selectedCurrency === undefined) return;

    unitPrice = selectedCurrency.price;

    // $("#currency_" + selectedCurrencyId + "_price")
    //     .empty()
    //     .append(unitPrice);
    // $("#currency_" + selectedCurrencyId + "_price_div").removeClass("hidden");
    setTotalPrice();
}

function setTotalPrice() {
    const amount = $("#amount").val();
    $("#totalPrice").empty();

    if (amount === undefined || amount.length === 0 || amount === 0) return;

    if (unitPrice === undefined) return;

    const totalPrice = unitPrice.replaceAll(",", "") * amount;

    $("#totalPrice").append(totalPrice.formatPrice(0, ",", "") + " تومان");
}

Number.prototype.formatPrice = function (
    decPlaces,
    thouSeparator,
    decSeparator
) {
    var n = this,
        decPlaces = isNaN((decPlaces = Math.abs(decPlaces))) ? 2 : decPlaces,
        decSeparator = decSeparator == undefined ? "." : decSeparator,
        thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
        sign = n < 0 ? "-" : "",
        i = parseInt((n = Math.abs(+n || 0).toFixed(decPlaces))) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return (
        sign +
        (j ? i.substr(0, j) + thouSeparator : "") +
        i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) +
        (decPlaces
            ? decSeparator +
              Math.abs(n - i)
                  .toFixed(decPlaces)
                  .slice(2)
            : "")
    );
};
