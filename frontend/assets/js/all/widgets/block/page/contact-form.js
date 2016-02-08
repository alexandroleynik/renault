app.view.wfn['contact-form'] = (function () {
    /*** process   ***/


    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/contact-form.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        setDefaultValues();
        loadSalons(data);
        //loadTemplate(data);
    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        data.kiev = [];
        $.each(data.dealers, function(key, value) {
            if (value.city_id == '3') {
                data.kiev.push(value);

            }


        });
        data.kiev.name = [];
        $.each(data.kiev, function(key, value){


            switch (app.router.locale){
                case 'ru':
                    data.kiev[key].name = value.dealers_name_ru;
                    break;
                default:
                    data.kiev[key].name = value.dealers_name_ua;
                    break;
            }
        });





        var v = app.config.frontend_app_files_midified[template];

        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html) {
        app.logger.func('renderWidget(html)');
        $('#widget-wrapper-' + widget.uniqueKey).append(html);

        app.view.afterWidget(widget);
    }

    function loadSalons(data) {
        var params = {
            "controller": 'dealer',
            "action": 'index',
            "city_id": '3'
        };

        $.getJSON(
            'http://dealers.renault.ua/platformAjaxRequest.php',
            params,
            function (dealersData) {


                app.view.dealers = dealersData;
                data.dealers = app.view.dealers;


                loadTemplate(data);
            });
    }

    //function loadServices(data) {
    //    var params = {
    //        "controller": 'service',
    //        "action": 'index'
    //    };
    //
    //    $.getJSON(
    //        'http://dealers.renault.ua/platformAjaxRequest.php',
    //        params,
    //        function (serviceData) {
    //
    //            $.each(app.view.dealers, function (k, v) {
    //                $.each(serviceData, function (k2, v2) {
    //                    if (v2.gps_coords == v.gps_coords && v2.dealers_id == v.dealers_id) {
    //                        $.extend(app.view.dealers[k], v2);
    //                        serviceData[k2] = false;
    //                    }
    //                });
    //            });
    //
    //            $.each(serviceData, function (k, v) {
    //                if (!$.isEmptyObject(v)) {
    //                    app.view.dealers.push(v);
    //                }
    //            });
    //
    //            data.dealers = getPreparedDealers(app.view.dealers);
    //            console.log('data.dealers');
    //            console.log(data.dealers);
    //
    //            data.kiev = [];
    //            $.each(data.dealers, function(key, value){
    //                if(value.city_id == '3'){
    //                    data.kiev.push(value);
    //                }
    //
    //            });
    //            console.log(data.kiev);
    //            loadTemplate(data);
    //        });
    //}

    function getPreparedDealers(dealers) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        $.each(dealers, function (k, dealer) {
            dealers[k].title = dealer['dealers_name_' + locale];
            dealers[k].town = dealer['city_name_' + locale];

            if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
                dealers[k].street = dealer['service_adres_' + locale];
            }
            if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
                dealers[k].street = dealer['salon_adres_' + locale];
            }

            dealers[k].gpsUrl = 'https://www.google.com.ua/maps/place/@' + dealer.gps_coords.replace(/\ /g, '') + ',17z/data=!4m2!3m1!1s0x40d4cefec397bd8f:0xd344af779861fc77';

            dealers[k].dataFilter = toCodeValue(dealer['city_name_ru']) + ' ' + toCodeValue(dealer['city_name_ua']);

            //var gps = dealer.gps_coords.replace(/\ /g, '').split(',');
            //dealers[k].gps_x = gps[0];
            //dealers[k].gps_y = gps[1];

            if (!$.isEmptyObject(dealer['salon_id'])) {
                dealers[k].websiteUrl = dealer['salon_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-salon';
            }

            if (!$.isEmptyObject(dealer['service_id'])) {
                dealers[k].websiteUrl = dealer['service_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-service';
            }

            if (!$.isEmptyObject(dealer['dealers_pro'])) {
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-pro';
            }

            if (k % 3 == 0) {
                dealers[k].firstInRow = true;
            }

            if ((k + 1) % 3 == 0) {
                dealers[k].lastInRow = true;
            }

        });

        return dealers;
    }

    /**
     * @param variable
     * @returns {*}
     */
    window.getQueryVariable = function(variable) {
        var query = document.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++)
        {
            var pair = vars[i].split("=");
            if (pair[0] == variable)
            {
                return decodeURIComponent(pair[1]);
            }
        }
        return null;
    };

    function setDefaultValues() {
        var d = new Date();

        var curr_date = d.getDate() + 1;
        var curr_month = d.getMonth() + 1;
        if (curr_month < 10) {
            curr_month = '0' + curr_month;
        }
        var curr_year = d.getFullYear();
        window.testDriveData = {
            'selected_id': '30',
            'punkt[5]': 'Captur',
        'field-lastname':'1',
        'punkt[1]': 'WIFIBAR',
        'field-firstname': '2',
        'punkt[2]':'тест',
        'field-secondname':'3',
        'punkt[3]':'WIFIBAR',
        'massive':'Array',
        'punkt[4]':'WIFIBAR',
        'field-email':'6',
        'punkt[6]':'WIFIBAR',
        'field-phone':'7',
        'code_select':'093',
        'code': '',
            'punkt7':'5012553',
        'punkt[8]':'WIFIBAR',
        'punkt[9]':'WIFIBAR',
        'punkt[10]':'yes',
        'punkt[11]':'true',
        'punkt[12]':'1',
        'punkt[13]':'1',
        'submit-val':'1',
            //'selected_id': '', //dealer
            //'punkt[5]': 'Captur', //Модель*
            //'field-firstname': '2',
            //'field-secondname': '3',
            //'field-lastname': '1',
            //'punkt[1]': 'WIFIBAR', //firstname
            //'punkt[2]': 'WIFIBAR', //secondname
            //'punkt[3]': 'WIFIBAR', //lastname
            //'massive': 'Array',
            //'punkt[4]': 'WIFIBAR', //bd
            //'field-email': '6',
            //'punkt[6]': 'WIFIBAR', //email
            //'field-phone': '7',
            //'punkt7': 'WIFIBAR', //phone
            //'punkt[8]': curr_date + '.' + curr_month + '.' + curr_year, //Желаемая дата тест-драйва
            //'punkt[9]': '9:00-10:00', //Желаемое время тест-драйва
            //'punkt[10]': 'yes', //Даю своё согласие на обработку указанных мной выше персональных данных*
            //'punkt[11]': 'true', //Я хочу получать информацию от Renault
            //'submit-val': '1',
            'RenaultDealerDomain': location.hostname,
            'CampaignUniqueId': getQueryVariable('utm_medium') ? getQueryVariable('utm_medium') : 'WIFIBAR',
            'Media': getQueryVariable('utm_source') ? getQueryVariable('utm_source') : 'WIFIBAR'
        };

    }
});

