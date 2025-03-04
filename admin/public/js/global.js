$(".scroll-item1").niceScroll({});
// $(".scroll-item-table .table").niceScroll({});
var domain = window.location.protocol + "//" + window.location.host + '/admin';
var url_domain = window.location.protocol + "//" + window.location.host + '';

/**
 *******BEGIN****************
 *********AJAX GLOBAL CONFIG*
 ****************************
 */
$.ajaxSetup({ 'global': true });
$.ajaxGlobalRunning = false; //Giá trị global để xác định ajax đang chạy, để cấu hình ngăn ko cho các ajax khác chạy

//Khi ajax bắt đầu chạy thì show thành loading lên
$(document).ajaxStart(function () {
    $.ajaxGlobalRunning = true;
    $("#loading_bar").show();
});

//Ajax complete thì ẩn loading
$(document).ajaxComplete(function () {
    $("#loading_bar").hide();
    $.ajaxGlobalRunning = false;
});

//Ajax dừng lại thì cho chạy tiếp lệnh tiếp theo
$(document).ajaxStop(function () {
    $.ajaxGlobalRunning = false;
});
/**
 ********END*****************
 *********AJAX GLOBAL CONFIG*
 ****************************
 */

$(function () {

    // calenderAndTimer();

    $(".input-number-touch").TouchSpin({});

    // $('#appointed_date').datepicker();

    $(document).on('scroll', function () {
        if ($(window).scrollTop() > 100) {
            $('.back-top').css('display', "block");
        } else {
            $('.back-top').css('display', "none");
        }
    });

    $(document).on("focus", "input", function () {
        $(this).select();
    });

    $(document).on("blur", "input.number-format", function () {
        var value = $(this).val();
        var number = SplitNumber2(value);
        if (isNumber(number)) {
            $(this).val(number_format_replace_cog(number));
        }
    });

    $(document).on("blur", "input.number-format-any", function () {
        var value = $(this).val();
        var decimal = $(this).attr('decimal');
        decimal = decimal == '' ? '2' : decimal;
        var number = SplitNumber2(value);
        if (isNumber(number)) {
            $(this).val(number_format_replace(number, parseInt(decimal), '.', ','));
        }
    });

    $("input, textarea").focus(function () {
        let val = $(this).attr("placeholder");
        $(this).attr("hide-placeholder", val);
        $(this).attr("placeholder", "");
    })
    $("input, textarea").blur(function () {
        let val = $(this).attr("hide-placeholder");
        $(this).attr("placeholder", val);
        $(this).attr("hide-placeholder", "");
    })

    $(".change_password_user").click(function () {
        change_password();
    })

    $(".icon-cate.icon-other-date, .glyphicon.glyphicon-calendar").click(function () {
        $(this).parent().prev().focus();
    })

    $(".menu-item-active").each(function () {
        if ($(this).hasClass("active")) {
            let level = $(this).attr("level");
            let root = $(this).attr("root-id");
            if (root && root != "0") {
                $("#item-menu-" + root).addClass("active");
                root = $("#item-menu-" + root).attr("root-id");
                if (root && root != "0") {
                    $("#item-menu-" + root).addClass("active");
                }
            }
        }
    })
});

//for model when hidden and scrollable
$('body').on('hide.bs.modal', function () {
    setTimeout(function () {
        let exist_modal_in = false;
        $(".modal").each(function () {
            if ($(this).hasClass("in")) {
                exist_modal_in = true;
            }
        })
        if (exist_modal_in && !$("body").hasClass("modal-open")) {
            $("body").addClass("modal-open")
        }
    }, 80);
});

//do ajax with node
function _doAjaxNod(type_, data_, m_, act_, nod_, global_, doSomeThing) {
    if (data_ == '') {
        data_ = new FormData();
        data_.append('browser', _getBrowserName());
    } else {
        data_.append('browser', _getBrowserName());
    }

    $.ajax({
        type: type_,
        url: domain + '/phpjquery/index.php?m=' + m_ + '&act=' + act_ + '&nod=' + nod_,
        data: data_,
        processData: false,
        contentType: false,
        async: true,
        cache: false,
        global: global_,
        success: function (respone) {
            var kq = respone.split("##");
            if (kq.length == 2) {
                // debug_ajaxRunning(kq[0]);
                var obj = $.parseJSON(kq['1']);
                if (obj.status == 200 || obj.status == 201)
                    doSomeThing(obj); //success respone data from server
                else if (obj.status == 401)
                    alert_void(obj.message, 0); //require login
                else if (obj.status == 403) //error message
                    alert_void(obj.message, 0);
                else
                    alert_void(obj.message, 0);
            } else {
                alert_void(respone, 0);
            }
        }
    });
    printLog('doAjax ...');
    return;
}

function _doAjaxSync(type_, data_, m_, act_, global_, doSomeThing) {

    if (data_ == '') {
        data_ = new FormData();
        data_.append('browser', _getBrowserName());
    } else {
        data_.append('browser', _getBrowserName());
    }

    $.ajax({
        type: type_,
        url: domain + '/phpjquery/index.php?m=' + m_ + '&act=' + act_, //
        data: data_,
        processData: false,
        contentType: false,
        async: false,
        cache: false,
        global: global_,
        success: function (respone) {
            var kq = respone.split("##");
            if (kq.length == 2) {
                debug_ajaxRunning(kq[0]);
                var obj = $.parseJSON(kq['1']);
                if (obj.status == 200)
                    doSomeThing(obj); //success respone data from server
                else if (obj.status == 401)
                    alert_dialog(obj.message); //require login
                else if (obj.status == 403) //error message
                    alert_dialog(obj.message);
                else
                    alert_dialog(obj.message);
            } else {
                alert_dialog(respone);
            }
        }
    });
    printLog('doAjax ...');
    return;
}

function debug_ajaxRunning(kq_0) {
    if (kq_0 != '') {
        kq_0 = kq_0.substring(1, kq_0.length);
        kq_0 = kq_0.trim();
        if (kq_0 != '' && kq_0 != 'done') {
            alert_void(kq_0.substring(0, kq_0.length - 4));
            printLog("debug_ajaxRunning: Ok: " + kq_0);
        }
    }
    printLog("debug_ajaxRunning:" + kq_0);
    return true;
}

//cat dau cham
function SplitNumber(number) {
    var rt = str_replace('.', '', number);
    var kq = str_replace(',', '', rt);
    return parseInt(kq);
}

function SplitNumber2(number) {
    //var rt = str_replace('.','',number);
    var kq = str_replace(',', '', number);
    return kq;
}

function str_replace(search, replace, subject, count) {
    var i = 0,
        j = 0,
        temp = '',
        repl = '',
        sl = 0,
        fl = 0,
        f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = r instanceof Array,
        sa = s instanceof Array;

    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }

    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }
        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            if (count && s[i] !== temp) {
                this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}

function number_format_replace(number, decimals, dec_point, thousands_sep) {
    let val = number_format(number, decimals, dec_point, thousands_sep);
    val = val.replace('.' + zeroFill(0, decimals), '');
    return val;
}

//hàm format
function number_format_replace_cog(number) {
    let decimals = 2;
    let dec_point = '.';
    let thousands_sep = ',';
    let val = number_format(number, decimals, dec_point, thousands_sep);
    val = val.replace('.' + zeroFill(0, decimals), '');
    return val;
}

//hàm format
function number_format_replace_cog_define(number, decimals) {
    let dec_point = '.';
    let thousands_sep = ',';
    let val = number_format(number, decimals, dec_point, thousands_sep);
    val = val.replace('.' + zeroFill(0, decimals), '');
    return val;
}

function number_format(number, decimals, dec_point, thousands_sep) {
    // Formats a number with grouped thousands
    //
    // version: 906.1806
    // discuss at: http://phpjs.org/functions/number_format
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://getsprink.com)
    // +     bugfix by: Benjamin Lupton
    // +     bugfix by: Allan Jensen (http://www.winternet.no)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +     bugfix by: Howard Yeend
    // +    revised by: Luke Smith (http://lucassmith.name)
    // +     bugfix by: Diogo Resende
    // +     bugfix by: Rival
    // +     input by: Kheang Hok Chin (http://www.distantia.ca/)
    // +     improved by: davook
    // +     improved by: Brett Zamir (http://brett-zamir.me)
    // +     input by: Jay Klehr
    // +     improved by: Brett Zamir (http://brett-zamir.me)
    // +     input by: Amir Habibi (http://www.residence-mixte.com/)
    // +     bugfix by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: number_format(1234.56);
    // *     returns 1: '1,235'
    // *     example 2: number_format(1234.56, 2, ',', ' ');
    // *     returns 2: '1 234,56'
    // *     example 3: number_format(1234.5678, 2, '.', '');
    // *     returns 3: '1234.57'
    // *     example 4: number_format(67, 2, ',', '.');
    // *     returns 4: '67,00'
    // *     example 5: number_format(1000);
    // *     returns 5: '1,000'
    // *     example 6: number_format(67.311, 2);
    // *     returns 6: '67.31'
    // *     example 7: number_format(1000.55, 1);
    // *     returns 7: '1,000.6'
    // *     example 8: number_format(67000, 5, ',', '.');
    // *     returns 8: '67.000,00000'
    // *     example 9: number_format(0.9, 0);
    // *     returns 9: '1'
    // *     example 10: number_format('1.20', 2);
    // *     returns 10: '1.20'
    // *     example 11: number_format('1.20', 4);
    // *     returns 11: '1.2000'
    // *     example 12: number_format('1.2000', 3);
    // *     returns 12: '1.200'
    var n = number,
        prec = decimals;

    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec);
        return (Math.round(n * k) / k).toString();
    };

    n = !isFinite(+n) ? 0 : +n;
    prec = !isFinite(+prec) ? 0 : Math.abs(prec);
    var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
    var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;

    var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;

    var abs = toFixedFix(Math.abs(n), prec);
    var _, i;

    if (abs >= 1000) {
        _ = abs.split(/\D/);
        i = _[0].length % 3 || 3;

        _[0] = s.slice(0, i + (n < 0)) +
            _[0].slice(i).replace(/(\d{3})/g, sep + '$1');
        s = _.join(dec);
    } else {
        s = s.replace('.', dec);
    }

    var decPos = s.indexOf(dec);
    if (prec >= 1 && decPos !== -1 && (s.length - decPos - 1) < prec) {
        s += new Array(prec - (s.length - decPos - 1)).join(0) + '0';
    } else if (prec >= 1 && decPos === -1) {
        s += dec + new Array(prec).join(0) + '0';
    }
    return s;
}

function input_number_decimal(input_id, decimal) {
    var value = $(input_id).val();
    var number = SplitNumber2(value);
    number = parseFloat('0' + number);
    $(input_id).val(number_format(number, decimal, '.', ','));
}

function input_number(input_id) {
    var value = $(input_id).val();
    var number = SplitNumber2(value);

    if (isNumber(number)) {
        $(input_id).css('color', 'black');
        $(input_id).val(number_format(number, setup.decimal, '.', ','));
    } else {
        $(input_id).css('color', 'red');
    }
}

function input_number2(input_id) {
    var value = $(input_id).val();
    var number = SplitNumber2(value);

    if (isNumber(number)) {
        $(input_id).val(number_format(number, setup.decimal, '.', ','));
    }
}

function isNumber(value) {
    // var reg = new RegExp("^[0-9]+$");
    var reg = new RegExp("^[-+]?[0-9]*\.?[0-9]+$");
    return reg.test(value);
}

function isOnlyNumberAndCharacter(value) {//Kiểm tra nếu chỉ số và chữ thì trả về true
    var reg = new RegExp("^[a-zA-Z0-9]*$");
    return reg.test(value);
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
    return;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

function check_all(id_check, class_check) {
    if ($(id_check).is(":checked")) {
        $(class_check).each(function () {
            $(this).prop('checked', true);
        });
    } else {
        $(class_check).each(function () {
            $(this).prop('checked', false);
        });
    }
}

function alert_dialog(message) {
    BootstrapDialog.show({
        title: lang.jstt_noti,
        message: message,
        buttons: [{
            label: 'OK',
            cssClass: 'btn btn-primary btn-width',
            action: function (dialogItself) {
                dialogItself.close();
            }
        }]
    });
    return false;
}

function alert_void(_message, _success) {
    let _id = `alert_${Date.now()}`;
    let z_index = (_id % 100000000);
    let html = '';

    // Kiểm tra nếu container chưa tồn tại thì thêm vào body
    if (!document.getElementById("alert-container")) {
        $("body").append('<div id="alert-container"></div>');
    }

    html = `<div class="alert ${_success == 1 ? 'alert-success' : 'alert-danger'} fade in alert-dismissible alert_auto_remove" style="z-index:${z_index};" role="alert" id="alert_${_id}">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <img src="${domain}/public/images/${_success == 1 ? 'done' : 'error'}.png" alt="" width="24" class="img_edit">
                ${_message}
            </div>`;

    // Thêm vào container
    $("#alert-container").append(html);
    $("#alert_" + _id).show();
    setTimeout(function () {
        $("#alert_" + _id).hide();
    }, 5000);
    setTimeout(function () {
        $("#alert_" + _id).remove();
    }, 6000);
    return false;
}

function zeroPad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
}

function printLog(str) {
    console.log(str);
}

function click_file(id) {
    $("#" + id).click();
}

function _getBrowserName() {
    var nVer = navigator.appVersion;
    var nAgt = navigator.userAgent;
    var browserName = navigator.appName;
    var fullVersion = '' + parseFloat(navigator.appVersion);
    var majorVersion = parseInt(navigator.appVersion, 10);
    var nameOffset, verOffset, ix;

    // In Opera, the true version is after "Opera" or after "Version"
    if ((verOffset = nAgt.indexOf("Opera")) != -1) {
        browserName = "Opera";
        fullVersion = nAgt.substring(verOffset + 6);
        if ((verOffset = nAgt.indexOf("Version")) != -1)
            fullVersion = nAgt.substring(verOffset + 8);
    }
    // In MSIE, the true version is after "MSIE" in userAgent
    else if ((verOffset = nAgt.indexOf("MSIE")) != -1) {
        browserName = "Microsoft Internet Explorer";
        fullVersion = nAgt.substring(verOffset + 5);
    }
    // In Chrome, the true version is after "Chrome" 
    else if ((verOffset = nAgt.indexOf("Chrome")) != -1) {
        browserName = "Chrome";
        fullVersion = nAgt.substring(verOffset + 7);
    }
    // In Safari, the true version is after "Safari" or after "Version" 
    else if ((verOffset = nAgt.indexOf("Safari")) != -1) {
        browserName = "Safari";
        fullVersion = nAgt.substring(verOffset + 7);
        if ((verOffset = nAgt.indexOf("Version")) != -1)
            fullVersion = nAgt.substring(verOffset + 8);
    }
    // In Firefox, the true version is after "Firefox" 
    else if ((verOffset = nAgt.indexOf("Firefox")) != -1) {
        browserName = "Firefox";
        fullVersion = nAgt.substring(verOffset + 8);
    }
    // In most other browsers, "name/version" is at the end of userAgent 
    else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) <
        (verOffset = nAgt.lastIndexOf('/'))) {
        browserName = nAgt.substring(nameOffset, verOffset);
        fullVersion = nAgt.substring(verOffset + 1);
        if (browserName.toLowerCase() == browserName.toUpperCase()) {
            browserName = navigator.appName;
        }
    }

    return browserName;
}

$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    } else {
        return results[1] || 0;
    }
}
$.setURLParam = (param, paramVal) => {

    var url = window.location.href;
    var TheAnchor = null;
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";

    if (additionalURL) {
        var tmpAnchor = additionalURL.split("#");
        var TheParams = tmpAnchor[0];
        TheAnchor = tmpAnchor[1];
        if (TheAnchor)
            additionalURL = TheParams;

        tempArray = additionalURL.split("&");

        for (var i = 0; i < tempArray.length; i++) {
            if (tempArray[i].split('=')[0] != param) {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }
    else {
        var tmpAnchor = baseURL.split("#");
        var TheParams = tmpAnchor[0];
        TheAnchor = tmpAnchor[1];

        if (TheParams)
            baseURL = TheParams;
    }

    if (TheAnchor)
        paramVal += "#" + TheAnchor;

    var rows_txt = temp + "" + param + "=" + paramVal;
    window.history.pushState('page', 'Title', baseURL + "?" + newAdditionalURL + rows_txt);

}

function _getOSName() {
    var OSName = "Unknown OS";
    if (navigator.appVersion.indexOf("Win") != -1) OSName = "Windows";
    if (navigator.appVersion.indexOf("Mac") != -1) OSName = "MacOS";
    if (navigator.appVersion.indexOf("X11") != -1) OSName = "UNIX";
    if (navigator.appVersion.indexOf("Linux") != -1) OSName = "Linux";
    return OSName;
}

function isNumberDecimal(value) {
    var reg = new RegExp("^[0-9]*[.][0-9]|[0-9]+$");
    return reg.test(value);
}

function isEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function isNotSpecialCharacter(val) {
    var re = /[#$%^&*':"\\|,.<>\/?]/;;
    return !re.test(val);
}

/**FOR PRINT BILL**/
function print_bill_to_epson(printer, _shop_id, _order_id, _created_at) {
    var data = new FormData();
    data.append('shop_id', _shop_id);
    data.append('order_id', _order_id);
    data.append('created_at', _created_at);
    _doAjaxPrint('POST', data, 'print', 'all_to_epson', true, function (response) {
        genetalTemplateBillToEpson(printer, response.data.dOrder.shop_name,
            response.data.dOrder.shop_address, response.data.dOrder.shop_mobile,
            response.data.dOrder, response.data.lDetail,
            response.data.lDetailReturn, response.data.show_vat);
        printer.send();
    });
}


function print_online_bill_to_epson(printer, _cart_id, _created_at) {
    var data = new FormData();
    data.append('cart_id', _cart_id);
    data.append('created_at', _created_at);
    _doAjaxPrint('POST', data, 'print', 'orderonline_to_epson', true, function (response) {

        var show_vat = response.data.show_vat;
        var dCart = response.data.dCart;
        var lDetailCart = response.data.lDetailCart;
        var lDetailReturn = response.data.lDetailReturn;

        genetalTemplateBillOnlineToEpson(printer, dCart.shop_name,
            dCart.shop_address, dCart.shop_mobile,
            dCart, lDetailCart,
            lDetailReturn, show_vat);

        printer.send();
    });
}

function genetalTemplateBillToEpson(printer, shop_name, shop_address, shop_mobile, dOrder, lDetail, lDetailReturn, show_vat) {

    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addTextSize(2, 2);
    printer.addText(shop_name + '\n'); //shop_name
    printer.addFeedLine(1);
    printer.addTextSize(1, 1);
    printer.addTextAlign(printer.ALIGN_LEFT);
    printer.addText(lang.lb_billAddr + shop_address + '\n'); //[Địa Chỉ]
    printer.addText(lang.lb_billMobile + shop_mobile + '\n'); //[Số ĐT]
    printer.addFeedLine(1);
    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addTextStyle(false, false, true, printer.COLOR_1);
    printer.addText(lang.lb_bill + '\n');
    printer.addTextStyle(false, false, false, printer.COLOR_1);
    printer.addTextAlign(printer.ALIGN_LEFT);
    printer.addText(lang.lb_billDate + dOrder.last_update + '\n');
    printer.addText(lang.lb_billCashier + dOrder.user_add + '\n');
    printer.addText(lang.lb_billCus + dOrder.mobile_customer + '\n');
    printer.addText('------------------------------------------------\n');

    var sum = 0;
    var giam_gia = 0;
    var stt = 0;
    for (var i = 0; i < lDetail.length; i++) {
        var item = lDetail[i];
        if (item.decrement > 0) {
            var item_giam = number_format_replace_cog(item.amount * item.price * ((item.decrement) / 100));
            giam_gia += item_giam;
            printer.addText(stt + '. ' + item.name + '\n');
            printer.addText(item.amount + 'x              ' + number_format_replace_cog(item.price) + '        (↓' + number_format_replace_cog(item.decrement) + '%) ' + number_format_replace_cog(item.amount * item.price - item_giam) + '\n');
        } else {
            printer.addText(item.name + '\n');
            printer.addText(number_format_replace_cog(item.amount) + 'x              ' + number_format_replace_cog(item.price) + '            ' + number_format_replace_cog(item.amount * item.price) + '\n');
        }
        sum += item.price * item.amount;
        stt++;
    };

    if (lDetailReturn.length > 0) {
        printer.addText(lang.lb_billReturn + '\n');
        for (var i = 0; i < lDetailReturn.length; i++) {
            var rtItem = lDetailReturn[i];
            if (rtItem.decrement > 0) {
                var item_giam = rtItem.amount * rtItem.price * ((rtItem.decrement) / 100);
                giam_gia += item_giam;
                printer.addText(stt + '. ' + rtItem.name + '\n');
                printer.addText(number_format_replace_cog(rtItem.amount) + 'x          ' + number_format_replace_cog(rtItem.price) + '          (↓' + number_format_replace_cog(rtItem.decrement) + '%) ' + number_format_replace_cog(rtItem.amount * rtItem.price - item_giam) + '\n');
            } else {
                printer.addText(rtItem.name + '\n');
                printer.addText(number_format_replace_cog(rtItem.amount) + 'x          ' + number_format_replace_cog(rtItem.price) + '          ' + number_format_replace_cog(rtItem.amount * rtItem.price) + '\n');
            }
            sum += rtItem.price * rtItem.amount;
            stt++;
        };
    }
    if (dOrder.note != '')
        printer.addText(lang.lb_billNote + dOrder.note + '\n');

    printer.addText('------------------------------------------------\n');

    printer.addTextAlign(printer.ALIGN_RIGHT);
    if (giam_gia > 0) {

        if (show_vat == 1)
            printer.addText(lang.lb_billSubTotal + ((sum / (100 + dOrder.vat)) * 100) + '   \n');

        printer.addText(lang.lb_billDiscount + giam_gia + '   \n');

        if (show_vat == 1)
            printer.addText(lang.lb_billVAT + ((sum / (100 + dOrder.vat)) * dOrder.vat) + '   \n');

        printer.addText(lang.lb_billCommi + '0\n');
        printer.addTextStyle(false, false, true, printer.COLOR_1);
        printer.addText(lang.lb_billTotal + (sum - giam_gia) + '   \n');

    } else {
        if (show_vat == 1) {
            printer.addText(lang.lb_billSubTotal + ((sum / (100 + dOrder.vat)) * 100) + '   \n');
            printer.addText(lang.lb_billVAT + ((sum / (100 + dOrder.vat)) * dOrder.vat) + '   \n');
            printer.addText(lang.lb_billCommi + '0   \n');
        }

        printer.addTextStyle(false, false, true, printer.COLOR_1);
        printer.addText(lang.lb_billTotal + (sum - giam_gia) + '   \n');
    }

    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addText(lang.lb_billTks + '\n');
    printer.addBarcode(dOrder.id, printer.BARCODE_CODE39, printer.HRI_NONE, printer.FONT_A, 2, 32); //create barcode
    printer.addFeedUnit(10);
    printer.addText(dOrder.code + '\n'); //text code

    if (dOrder.ship_name != '' || dOrder.ship_mobile != '' ||
        dOrder.ship_address != '' || dOrder.ship_note != '') {

        printer.addFeedUnit(15);
        printer.addText('------------------------------------------------\n');
        printer.addText('             ' + lang.lb_billDevInfo + '\n');
        printer.addText(lang.lb_billCus + dOrder.ship_name + '\n'); //Tên:
        printer.addText(lang.lb_billMobile + dOrder.ship_mobile + '\n'); //SDT:
        printer.addText(lang.lb_billAddr + dOrder.ship_address + '\n'); //Dia chi:
        printer.addText(lang.lb_billNote + dOrder.ship_note + '\n'); //Ghi chu:
        printer.addFeedUnit(15);

    }
    printer.addCut(printer.CUT_FEED);
}

function genetalTemplateBillOnlineToEpson(printer, shop_name, shop_address, shop_mobile, dOrder, lDetail, lDetailReturn, show_vat) {

    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addTextSize(2, 2);
    printer.addText(shop_name + '\n'); //shop_name
    printer.addFeedLine(1);
    printer.addTextSize(1, 1);
    printer.addTextAlign(printer.ALIGN_LEFT);
    printer.addText(lang.lb_billAddr + shop_address + '\n'); //[Địa Chỉ]
    printer.addText(lang.lb_billMobile + shop_mobile + '\n'); //[Số ĐT]
    printer.addFeedLine(1);
    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addTextStyle(false, false, true, printer.COLOR_1);
    printer.addText(lang.lb_bill + '\n');
    printer.addTextStyle(false, false, false, printer.COLOR_1);
    printer.addTextAlign(printer.ALIGN_LEFT);
    printer.addText(lang.lb_billDate + dOrder.last_update + '\n');
    printer.addText(lang.lb_billCashier + dOrder.user_add + '\n');
    printer.addText(lang.lb_billCus + dOrder.customer_mobile + '\n');
    printer.addText('------------------------------------------------\n');

    var sum = 0;
    var giam_gia = 0;
    var stt = 0;
    for (var i = 0; i < lDetail.length; i++) {
        var item = lDetail[i];
        if (item.decrement > 0) {
            var item_giam = item.quantity * item.price * ((item.decrement) / 100);
            giam_gia += item_giam;
            printer.addText(stt + '. ' + item.name + '\n');
            printer.addText(item.quantity + 'x              ' + item.price + '        (↓' + item.decrement + '%) ' + (item.quantity * item.price - item_giam) + '\n');
        } else {
            printer.addText(item.name + '\n');
            printer.addText(item.quantity + 'x              ' + item.price + '            ' + (item.quantity * item.price) + '\n');
        }
        sum += item.price * item.quantity;
        stt++;
    };

    if (lDetailReturn.length > 0) {
        printer.addText(lang.lb_billReturn + '\n');
        for (var i = 0; i < lDetailReturn.length; i++) {
            var rtItem = lDetailReturn[i];
            if (rtItem.decrement > 0) {
                var item_giam = rtItem.amount * rtItem.price * ((rtItem.decrement) / 100);
                giam_gia += item_giam;
                printer.addText(stt + '. ' + rtItem.name + '\n');
                printer.addText(rtItem.amount + 'x          ' + rtItem.price + '          (↓' + rtItem.decrement + '%) ' + (rtItem.amount * rtItem.price - item_giam) + '\n');
            } else {
                printer.addText(rtItem.name + '\n');
                printer.addText(rtItem.amount + 'x          ' + rtItem.price + '          ' + (rtItem.amount * rtItem.price) + '\n');
            }
            sum += rtItem.price * rtItem.amount;
            stt++;
        };
    }
    if (dOrder.note != '')
        printer.addText(lang.lb_billNote + dOrder.note + '\n');

    printer.addText('------------------------------------------------\n');

    printer.addTextAlign(printer.ALIGN_RIGHT);
    if (giam_gia > 0) {

        if (show_vat == 1)
            printer.addText(lang.lb_billSubTotal + ((sum / (100 + dOrder.vat)) * 100) + '   \n');

        printer.addText(lang.lb_billDiscount + giam_gia + '   \n');

        if (show_vat == 1)
            printer.addText(lang.lb_billVAT + ((sum / (100 + dOrder.vat)) * dOrder.vat) + '   \n');

        printer.addText(lang.lb_billCommi + '0\n');
        printer.addTextStyle(false, false, true, printer.COLOR_1);
        printer.addText(lang.lb_billTotal + (sum - giam_gia) + '   \n');

    } else {
        if (show_vat == 1) {
            printer.addText(lang.lb_billSubTotal + ((sum / (100 + dOrder.vat)) * 100) + '   \n');
            printer.addText(lang.lb_billVAT + ((sum / (100 + dOrder.vat)) * dOrder.vat) + '   \n');
            printer.addText(lang.lb_billCommi + '0   \n');
        }

        printer.addTextStyle(false, false, true, printer.COLOR_1);
        printer.addText(lang.lb_billTotal + (sum - giam_gia) + '   \n');
    }

    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addText(lang.lb_billTks + '\n');
    printer.addBarcode(dOrder.id, printer.BARCODE_CODE39, printer.HRI_NONE, printer.FONT_A, 2, 32); //create barcode
    printer.addFeedUnit(10);
    printer.addText(dOrder.code + '\n'); //text code

    if (dOrder.ship_name != '' || dOrder.ship_mobile != '' ||
        dOrder.ship_address != '' || dOrder.ship_note != '') {

        printer.addFeedUnit(15);
        printer.addText('------------------------------------------------\n');
        printer.addText('             ' + lang.lb_billDevInfo + '\n');

        printer.addTextAlign(printer.ALIGN_LEFT);
        printer.addFeedUnit(6);
        printer.addText(lang.lb_billCus + dOrder.fullname + '\n'); //Tên:
        printer.addText(lang.lb_billMobile + dOrder.mobile + '\n'); //SDT:
        printer.addText(lang.lb_billAddr + dOrder.address + '\n'); //Dia chi:
        printer.addText(lang.lb_billNote + dOrder.note + '\n'); //Ghi chu:
        printer.addFeedUnit(15);

    }
    printer.addCut(printer.CUT_FEED);
}

function _downloadTheLink(_link) {
    if (getFileExtension(_link) != 'pdf' && _getBrowserName() != 'Firefox') {
        $('#downloadFrame').remove(); // This shouldn't fail if frame doesn't exist
        $('body').append('<iframe id="downloadFrame" src="' + _link + '" style="display:none"></iframe>');
    } else {
        BootstrapDialog.show({
            title: lang.jstt_noti,
            message: lang.jslb_click2down + ': <a class="color_blue" download="" href="' + _link + '">' + lang.jslb_click2downlink + '</a>',
            buttons: [{
                label: 'OK',
                cssClass: 'btn btn-default btn-width',
                action: function (dialogItself) {
                    dialogItself.close();
                }
            }]
        });
    }
}

var randomString = (len) => {
    var text = "";
    var possible = "ABCDEFGHIJKMNLOPQRSTUVWXYZ1234567890";
    for (var i = 0; i < len; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text.toUpperCase();
}

function date_format(_type, times) {
    var strdate = new Date(times * 1000);

    if (_type == 'd/m')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2);
    else if (_type == 'd/m/Y')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear();
    else if (_type == 'Y')
        return strdate.getFullYear();
    else if (_type == 'm/Y')
        return zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear();
    else if (_type == 'd/m/y')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear().toString().substring(2, 4);
    else if (_type == 'd/m/Y H:i')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear() + '&nbsp;' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2);
    else if (_type == 'd/m/Y H:i:s')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear() + '&nbsp;' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2) + ':' + zeroFill(strdate.getSeconds(), 2);
    else if (_type == 'd/m/y H:i')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear().toString().substring(2, 4) + '&nbsp;' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2);
    else if (_type == 'd/m/y H:i:s')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear().toString().substring(2, 4) + '&nbsp;' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2) + ':' + zeroFill(strdate.getSeconds(), 2);
    else if (_type == 'd/m H:i')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '&nbsp;' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2);
    else if (_type == 'H:i')
        return zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2);
    return '-';
}

function zeroFill(n, p, c) {
    var pad_char = typeof c !== 'undefined' ? c : '0';
    var pad = new Array(1 + p).join(pad_char);
    var str = (pad + n).slice(-pad.length) + "";
    return str;
}

function onlyNumberAndCharacter(_str) {
    return _str.toUpperCase().replace(/[^a-zA-Z0-9]/g, '');
}

function onlyNumber(_str) {
    return _str.toUpperCase().replace(/[^0-9]/g, '');
}

function firstDayOfMonth() {
    var d = new Date();
    return '01/' + zeroFill((d.getMonth() + 1), 2) + '/' + d.getFullYear();
}

function getSortField(_sortBy) {

    let item = {};
    item.field = '';
    item.sort = '';

    $("." + _sortBy).each(function () {
        if ($(this).hasClass('active')) {
            item.field = $(this).attr('field');
            if ($(this).hasClass('fa-caret-up'))
                item.sort = 'ASC';
            else
                item.sort = 'DESC';
        }
    })

    return item;
}

function run_something(m, act, nod) {
    _doAjaxNod('POST', '', m, act, nod, true, function (response) { })
}

function dropdownCheckListHandleAllSelected(
    _id_selected /*ID của selected box này*/,
    _val_just_selected /*Giá trị của selected box này*/,
    _val_all_option = '' /*Giá trị của lựa chọn tất cả*/) {

    let val = $(`#${_id_selected}`).val();

    if (_val_just_selected == _val_all_option || (val && val.length == 1 && val[0] == _val_just_selected && _val_just_selected != _val_all_option)) {
        //Nếu bấm vào nút all => bỏ chọn tất cả và chỉ chọn all
        //Hoặc
        //Nếu bấm vào nút != all và chỉ có 1 giá trị đang được chọn bằng giá trị vừa bấm vào 
        //=>Thì bỏ chọn tất cả mọi cái => chỉ chọn all
        if (val && val.length == 1 && val[0] == _val_all_option) {
            //Nếu all đang được chọn, bấm thêm 1 cái nữa thì bỏ chọn all => chọn tất cả những cái còn lại
            $(`#${_id_selected} option`).prop("selected", true);
            $(`#${_id_selected} option[value='']`).prop("selected", false);
        } else {
            $(`#${_id_selected} option`).prop("selected", false);
            $(`#${_id_selected} option[value='']`).prop("selected", true);
        }

    } else {

        //Giá trị đã chọn khác all và giá trị đang được chọn nhiều hơn 1;
        $(`#${_id_selected} option[value='']`).prop("selected", false);
        let exist_before = false; //giá trị xác định đã chọn trước đó chưa
        if (val && val.length > 0) { //danh sách id đang được chọn
            val.forEach(id => {
                if (id != '')
                    $(`#${_id_selected} option[value='${id}']`).prop("selected", true); //Đánh dấu là selected cho tất cả trong mãng này


                exist_before = id === _val_just_selected && !exist_before ? true : exist_before; //Giá trị vừa chọn đã có trong list đc chọn trước đó phải ko?
            });
        }

        if (exist_before && val.length > 1) //Đã chọn trước đó nên giờ remove nó ra khỏi danh sách được chọn
            $(`#${_id_selected} option[value='${_val_just_selected}']`).prop("selected", false);
        else
            $(`#${_id_selected} option[value='${_val_just_selected}']`).prop("selected", true); //Nếu không có thì thêm nó vào danh sách được chọn
    }
    $(`#${_id_selected}`).dropdownchecklist('refresh');
}

$(document).on("click", ".hd-file img", function () {
    let link = $(this).parent().attr("link");
    let type = $(this).parent().attr("image-type");
    if (link && link.length > 20) {
        if (type == 'true') {
            alert_dialog(`<div class="text-center"><img id="holder_img_show" src="${link}" class="" style="max-width: 100%;"></div>`);
        } else {
            window.open(link);
        }
    }
})
$(document).on("click", ".hd-file .delete", function () {
    $(this).parent().remove();
})

//is an url is image
function isUrlImage(url) {
    return (url.match(/\.(jpeg|jpg|gif|png|svg)$/) != null); //return true;
}

//is URL exist 
function isUrlExists(url) {//check File Existing; url image/ file/ web
    try {
        var http = new XMLHttpRequest();
        http.open('HEAD', url, false);
        http.send();
        return http.status != 404;
    } catch (e) {
        return false;
    }
}

//is valid Url
function isUrl(url) {
    try {
        new URL(url);
    } catch (_) {
        return false;
    }
    return true;
}

//get file name of an url file name
function getFileName(url) {
    return url.substring(url.lastIndexOf('/') + 1);
}

//get extension of file in url
function getFileExtension(url) {
    let file_name = getFileName(url);
    let str = file_name.split('.');
    return str[str.length - 1];
}

//get first url is image in list url: url1;url2;
function getFirstUrlIsImageInStrList(url) {

    let l = url.split(';');
    let r = '';
    l.forEach(el => {
        if (r == '' && el != '' && isUrl(el) && isUrlImage(el)) {
            r = el;
        }
    });

    return r;
}

//Chuyển dữ liệu dạng object thành FormData để submit POST cho api
function objectToFormData(o) {
    let d = new FormData();
    Object.keys(o).forEach(k => d.append(k, o[k]));
    return d;
}

function isJSON(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

// duy592022
function mobileIsValid(mobile) {
    return /((09|03|07|08|05)+([0-9]{8})\b)/g.test(mobile)
}

/**
 * Hàm setClass dùng để thêm hoặc xóa class của jquery element
 * @param {HTMLElement} elements JQuery Element HTML
 * @param {String} className Tên class
 * @param {Boolean} status true: add class, false: remove class
 */
function setClass(elements, className, status) {
    if (status) {
        elements.addClass(className);
    } else {
        elements.removeClass(className);
    }
}

/**
 * Phương thức chuyển chuỗi tên đầy đủ thành chuỗi tên viết tắt. VD: Tran Thanh Dat => TTD
 * @param {String} fullname // Tên đầy đủ
 * @param {String} separator // Kí tự phân cách của fullname. Mặc định là khoảng cách " ".
 * @returns String
 */
function firstNameChar(fullname, separator = " ") {
    let substring = fullname.split(separator);
    return substring.map((str) => {
        return str[0];
    }).join("");
}

//Func to get Random Color
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}