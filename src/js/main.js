$(document).ready(function() {

    //- Всплывающее окно контакты
    $('#footerContactsButton').click(function() {
        $('#footerContactsModal').slideToggle('300');
        $('#footerContactsModal').toggleClass('.footer-contacts-window-active');
    });

    $('#footerContactsClose').click(function() {
        $('#footerContactsModal').slideToggle('300');
    });



    $('input[type=tel]').inputmask("+375(99) 999-99-99");


    var buttonLocked = false;
    $("form").submit(function(event) {
        event.preventDefault();
        var phone_input = $(this).find("input[type=tel]"),
            phone_check = phone_input.val().substring(5, 7),
            phone_number = phone_input.val().replace(/[^0-9]/g,"");

        if (phone_number.length === 0 ) {
            phone_input.notify("Введите номер телефона", {position:"bottom" , className: 'error'});
            return false;
        }
        if (phone_number.length < 12 && phone_number.length >= 4) {
            phone_input.notify("Номер введён не полностью", {position:"bottom" , className: 'warn', gap: 0, autoHideDelay: 3000});
            return false;
        }
        if (!(phone_number.length <= 0 || phone_check === '29' || phone_check === '33' || phone_check === '44' || phone_check === '25' || phone_check === '17')) {
            phone_input.notify("Проверьте введённый номер", {position:"bottom" , className: 'warn', gap: 0, autoHideDelay: 3000});
            return false;
        }
        if ((phone_number.length === 12) && (!buttonLocked) && (phone_check === '29' || phone_check === '33' || phone_check === '44' || phone_check === '25' || phone_check === '17')) {
            buttonLocked = true;
            var data = $(this).serializeArray(),
                thisForm = $(this),
                thisBtn = thisForm.find("button");
            data.push({name: 'user_client', value: client_info});
            data.push({name: 'href', value: href});
            data.push({name: 'search', value: search});
            data.push({name: 'term', value: utm_key_value.utm_term});
            data.push({name: 'content', value: utm_key_value.utm_content});
            data.push({name: 'campaign', value: utm_key_value.utm_campaign});
            data.push({name: 'medium', value: utm_key_value.utm_medium});
            data.push({name: 'source', value: utm_key_value.utm_source});
            data.push({name: 'ref', value: ref});
            $.ajax({
                url: 'php/mail.php',
                type: 'POST',
                data: data,
                beforeSend: function (data) {
                    thisBtn.notify("Отправка заявки", {position: "bottom center", className: 'info'});
                },
                success: function (data) {
                    console.log(data);
                    thisBtn.notify("Заявка принята", {position: "bottom center", className: 'success'});
                    thisForm.trigger("reset");
                    $.cookie('utm_mas', null);
                    $.cookie('refSave', null);
                    buttonLocked = false;
                    dataLayer.push({'event': 'formsend'});
                    // $('.success-window').show();
                    // window.location.replace('alumin.html');
                    // setTimeout('document.location.href="https://www.yandex.ru/";', 4000);
                },
                error: function (data) {
                    thisBtn.notify("Ошибка на сервере", {position: "bottom center", className: 'error'});
                    thisForm.trigger("reset");
                    buttonLocked = false;
                }
            });
            return false;
        }
    });


    function clientInfo() {
        var ua = detect.parse(navigator.userAgent);
        return ua.device.type + ' ' + ua.browser.name + ' ' + ua.os.name + ' Устр. ' + ua.device.family;
    }
    var client_info = clientInfo(),
        href          = window.location.href,
        search        = window.location.search,
        utm_mas       = [],                        /* Пустой массив для хранения UTM меток, разбитых по "&" */
        utm_key_value = {},                        /* Пустой массив в случае отсутствия UTM меток */
        ref = document.referrer;


    if ($.cookie('refSave') !== null) {
        ref = $.cookie('refSave');
    }
    else {
        $.cookie('refSave', ref);
    }

    if (href.indexOf("?") != -1) {
        href = href.slice(0,href.indexOf("?"));    /* Адрес страницы без UTML хвоста */
        search = search.slice(1);                     /* UTM хвост без вопроса */
        utm_mas = search.split("&");                  /* Массив UTM меток (ключ=значение) */
        $.cookie('utm_mas', JSON.stringify(utm_mas));
    }

    if ($.cookie('utm_mas') !== null) {             /* Есть запись в cookie c UTM */
        var utm_mas_key = JSON.parse($.cookie("utm_mas"));

        /* Заполняем объект, создавая свойста и значения */
        for (i = 0; i < utm_mas_key.length; i++) {
            utm_key_value[utm_mas_key[i].split("=")[0]] = utm_mas_key[i].split("=")[1];
        }
        /* Декодируем ключевые слова в UTM метке */
        if (utm_key_value.utm_term != "undefined"){utm_key_value.utm_term = decodeURIComponent(utm_key_value.utm_term);}
        if (utm_key_value.utm_term == "undefined"){utm_key_value.utm_term = "";}
    }

    if (href.indexOf("?") != -1 && $.cookie('utm_mas') == null) {             /* Не поддерживается cookie, но сайт с хвостом */
        for (i=0; i < utm_mas.length; i++){utm_key_value[utm_mas[i].split("=")[0]] = utm_mas[i].split("=")[1];}

        /* Декодируем ключевые слова в UTM метке */
        if (utm_key_value.utm_term != "undefined"){utm_key_value.utm_term = decodeURIComponent(utm_key_value.utm_term);}
        if (utm_key_value.utm_term == "undefined"){utm_key_value.utm_term = "";}
    }


    //-СОХРАНИЕ ДАТ ДЛЯ ОТЗЫВОВ
    $(function() {
        var date = [-2, -5, -7, -11, -15, -17, -20, -24, -25, -28, -33, -34, -37, -38, -42, -46, -48, -50];

        dateNew = date.map(function(n) {
            var d = new Date(parseInt(new Date().getTime()) - (-n * 86400000));
            var month = new Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
            return d.getDate() + '.' + month[d.getMonth()] + '.' + d.getFullYear() + ' г.';
        });

        if (localStorage.getItem('dateFeedback') !== null) {
            dateNewSave = localStorage.dateFeedback ? JSON.parse(localStorage.dateFeedback) : [];
            $('.feedback-person-date').text(function(ind) {
                return dateNewSave[ind - 1];
            });
        }
        else {
            $('.feedback-person-date').text(function(ind) {
                return dateNew[ind - 1];
            });
            localStorage.dateFeedback = JSON.stringify(dateNew);
        }
    });

});
