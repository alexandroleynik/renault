(function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    app.view.beforeWidget(widget);

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;

        //data.datapicker = getDataPickerFromData(data);
        //console.log('sdfsf');
        //console.dir(data.datapicker);
        //console.log('sdfsf');
        //loadTranslation(data);

        //http://dealers.renault.ua/platformAjaxRequest.php

        $.getScript(
                app.config.frontend_app_web_url + "/js/lib/validator/localization/messages_" + app.router.locale + ".js"
                );
        loadSalons(data);
        loadFormData(data);
    }

    function getDataPickerFromData(data) {
        if ($.isEmptyObject(data.datapicker)) {
            return {};
        }
        var datapicker = {};

        $.each(data.datapicker, function (k, v) {
            if (v.key && v.value) {
                datapicker[v.key] = v.value;
            }
        });

        return datapicker;
    }

    function mapInitialize(conf) {
        // default options
        var myLatlng1 = new google.maps.LatLng(49.3159955, 32.0068446);
        var zoom = 6;

        if (conf) {
            app.logger.var(conf);
        }
        //if custom center
        if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.center)) {
            myLatlng1 = new google.maps.LatLng(conf.center.split(',')[0], conf.center.split(',')[1]);
        }

        //if custom zoom
        if (!$.isEmptyObject(conf) && conf.zoom) {
            zoom = conf.zoom;
        }

        // Map options
        var mapOptions1 = {
            scrollwheel: false,
            center: myLatlng1,
            zoom: zoom,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        // Init map
        var map1 = new google.maps.Map(document.getElementById('mapresult'), mapOptions1);


        // Create the search box and link it to the UI element.

        markers = [];
        var input = /** @type {HTMLInputElement} */(document.getElementById('test-drive-form-map-input-search'));
        //map1.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var searchBox = new google.maps.places.SearchBox((input));

        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.
        google.maps.event.addListener(searchBox, 'places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            //filter dealers list
            if (!$.isEmptyObject(searchBox.getPlaces()) && !$.isEmptyObject(searchBox.getPlaces()[0]) && !$.isEmptyObject(searchBox.getPlaces()[0].name)) {
                var town = searchBox.getPlaces()[0].name;
                app.logger.var(searchBox.getPlaces()[0]);
                app.logger.text(town);

                var filterValue = '.' + toCodeValue(town);
                app.logger.text(filterValue);
                // use filterFn if matches value
                if (!$.isEmptyObject(app.view.$grid)) {
                    app.view.$grid.isotope({filter: filterValue});
                }

                app.view.mapFilterValue = filterValue;

            }

            // For each place, get the icon, place name, and location.
            markers = [];
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0, place; place = places[i]; i++) {


                bounds.extend(place.geometry.location);
            }

            map1.fitBounds(bounds);
            map1.setZoom(11);


        });

        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map1, 'bounds_changed', function () {
            var bounds = map1.getBounds();
            searchBox.setBounds(bounds);
        });

        var allMarkers = [];

        $.each(app.view.dealers, function (k, v) {
            if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.filter)) {
                if ('salon' == conf.filter && $.isEmptyObject(v.salon_id)) {
                    return;
                }

                if ('service' == conf.filter && $.isEmptyObject(v.service_id)) {
                    return;
                }

                if ('pro' == conf.filter && $.isEmptyObject(v.dealers_pro)) {
                    return;
                }
            }

            //hide services
            if (v.service_id && !v.salon_id) {
                return;
            }

            var myLatlng1 = new google.maps.LatLng(v.gps_x, v.gps_y);
            // Add markers
            var marker1 = new google.maps.Marker({
                position: myLatlng1,
                map: map1,
                icon: '/img/ico-marker3.png',
                dealer: v,
                scale: 4
            });

            allMarkers.push(marker1);

            google.maps.event.addListener(marker1, 'click', function () {
                app.logger.var(marker1.dealer);

                changeDealerInfo(marker1.dealer);

                for (var i = 0; i < allMarkers.length; i++) {
                    allMarkers[i].setIcon('/img/ico-marker3.png');
                }

                marker1.setIcon('/img/ico-marker2.png');
            });
        })

    }
    function loadFormData(data) {
        $.ajax({
            url: 'http://dealers.renault.ua/ru/site/test_drive',
            success: function (html) {
                //dealers
                var dealersScript = $(html).filter('#all').children().children().children().filter('div.inner-content').children().children()[4];
                //app.logger.var($(dealersScript).html());
                eval($(dealersScript).html());
                data.dealers = window.dealers;

                //vehicle models
                data.models = [];
                $(html).filter('#all').children().children().children().filter('div.inner-content').children().children().filter('div.form-item-renault').children().filter('form#form ').find('select.form.required.modelOfInterest.width462').children().each(function (k, v) {
                    //app.logger.var($(v).val())
                    data.models.push($.trim($(v).val()));
                });

                var item = null;
                var items = [];

                $.each(data.models, function (k, v) {
                    item = {'title': v, 'img_src': ""};
                    $.each(data.items, function (k2, v2) {
                        if (v == v2.title) {
                            item = v2;
                        }
                    });
                    items.push(item);
                });

                data.items = items;

                loadTemplate(data);

            }
        });

    }

    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        var params = '';
        if (true == app.config.frontend_app_debug) {
            params = '?_' + Date.now();
        }
        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + '/js/app/widgets/' + widget.widgetName + '/templates/handlebars.html' + params, function (template) {
            app.logger.var(data);
            renderWidget(template(data), data);
        });
    }

    function renderWidget(html, data) {
        app.logger.func('renderWidget(html)');
        app.container.append(html);
        app.view.afterWidget(widget);

        mapInitialize(data);
        $('.select-dealer-content').slideUp();
        $('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');

        setDefaultValues();
    }

    function setDefaultValues() {
        window.testDriveData = {
            'selected_id': '', //dealer
            'punkt[5]': '', //Модель*
            'field-firstname': '2',
            'field-secondname': '3',
            'field-lastname': '1',
            'punkt[1]': '', //firstname
            'punkt[2]': '', //secondname
            'punkt[3]': '', //lastname
            'massive': 'Array',
            'punkt[4]': '', //bd
            'field-email': '6',
            'punkt[6]': '', //email
            'field-phone': '7',
            'punkt[7]': '', //phone
            'punkt[8]': '', //Желаемая дата тест-драйва
            'punkt[9]': '9:00-10:00', //Желаемое время тест-драйва
            'punkt[10]': 'yes', //Даю своё согласие на обработку указанных мной выше персональных данных*
            'punkt[11]': 'true', //Я хочу получать информацию от Renault
            'submit-val': '1'
        };
    }

    function loadTranslation(data) {

        switch (app.router.locale) {
            case "uk":
                data.Select_this_dealer = "Вибрати цього диллера";
                data.select_date_and_time = "Оберіть дату та час";
                data.Select_date = "оберіть дату";
                data.select_time = "оберіть час";
                data.optional_confirmation = "Ми зв'яжемось з Вами щоб підтвердити, що обрані Вами дата та час вільні";
                data.change_this_datetime = "Обрати ці дату та час";

                data.accost = "Звертання";
                data.Mr = "Пан";
                data.Ms = "Пані";
                data.name = "Ім'я";
                data.surname = "Прізвище";
                data.patronymic = "По батькові";
                data.E_Mail = "E-Mail";
                data.post_code = "Індекс";
                data.settlement = "Населений пункт";
                data.house_number = "Номер будинку";
                data.VIN = "VIN <span>(номер кузова, зазначений у свідоцтві<br> про реєстрацію транспортного засобу)</span>";
                data.phone = "Мобільний телефон";
                data.region = "Область";
                data.street = "Вулиця";
                data.number_of_apartments = "Номер квартири";
                data.The_state_reg_number = "Державний реєстраційний номер";
                data.your_question = "Ваше питання";

                data.Subscribe_to_news = "Підписатися на новини Renault";
                data.consent = "Даю свою згоду на обробку зазначених мною вище персональних даних";


                break
            case "ru":
                data.Select_this_dealer = "Выбрать этого диллера";
                data.select_date_and_time = "Выберите дату и время";
                data.Select_date = "выберите дату";
                data.select_time = "выберите время";
                data.optional_confirmation = "Мы свяжемся с Вами, чтобы подтвердить, что выбранные Вами дата и время свободны";
                data.change_this_datetime = "Выбрать эти дату и время";

                data.accost = "Обращение";
                data.Mr = "Г-н";
                data.Ms = "Г-жа";
                data.name = "Имя";
                data.surname = "Фамилия";
                data.patronymic = "Отчество";
                data.E_Mail = "E-Mail";
                data.post_code = "Индекс";
                data.settlement = "Неселённый пункт";
                data.house_number = "Номер дома";
                data.VIN = "VIN <span>( Номер кузова, указанный в свидедельстве<br> о регистрации транспортного средства)</span>";
                data.phone = "Мобильный телефон";
                data.region = "Область";
                data.street = "Улица";
                data.number_of_apartments = "Номер квартиры";
                data.The_state_reg_number = "Государственный регистрационный номер";
                data.your_question = "Ваш вопрос";

                data.Subscribe_to_news = "Подписаться на новости RENAULT";
                data.consent = "Даю своё согласие на обработку указанных мною выше личных данных";

                break
            default:
                break
        }

    }

    function loadSalons(data) {
        var params = {
            "controller": 'salon',
            "action": 'index'
        };

        $.getJSON(
                'http://dealers.renault.ua/platformAjaxRequest.php',
                params,
                function (salonData) {
                    app.view.dealers = salonData;

                    loadServices(data);
                });
    }

    function loadServices(data) {
        var params = {
            "controller": 'service',
            "action": 'index'
        };

        $.getJSON(
                'http://dealers.renault.ua/platformAjaxRequest.php',
                params,
                function (serviceData) {

                    $.each(app.view.dealers, function (k, v) {
                        $.each(serviceData, function (k2, v2) {
                            if (v2.gps_coords == v.gps_coords && v2.dealers_id == v.dealers_id) {
                                $.extend(app.view.dealers[k], v2);
                                serviceData[k2] = false;
                            }
                        });
                    });

                    $.each(serviceData, function (k, v) {
                        if (!$.isEmptyObject(v)) {
                            app.view.dealers.push(v);
                        }
                    });

                    data.dealers = getPreparedDealers(app.view.dealers);

                    //loadTemplate(data);
                });
    }


    function changeDealerInfo(dealer) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        var html = '<h4>"' + dealer['dealers_name_' + locale] + '"</h4>'
                + '<h5>Контактна інформація</h5>'
                + '<p>' + dealer['city_name_' + locale]
                + '<br>' + dealer['salon_adres_' + locale] + '</p>'
                + '<h5>салон</h5>'
                + '<p>' + dealer['salon_phone'] + '</p>';
        //+ '<h5>СТО</h5>'
        //+ '<p>(044) 495-88-20</p>';

        $('.map-wrapper').addClass('mw-dealer-selected');

        $('.mapitembox').html(html);
        window.testDriveData['selected_id'] = dealer['dealers_id'];
        $('#test-drive-form-select-this-dealer-button').show();
        $('#test-drive-form-select-this-dealer-button').click(function () {
            $('.select-dealer-header').html(dealer['dealers_name_' + locale]);
            $('.select-dealer-content').slideUp();
            $('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');
            $('.form .select-date-time-content').slideDown();
            $('.form .select-date-time-content, .form .select-date-time-header').attr('data-state', 'open');

        });

    }

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

            var gps = dealer.gps_coords.replace(/\ /g, '').split(',');
            dealers[k].gps_x = gps[0];
            dealers[k].gps_y = gps[1];

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

    function getDealer(dealers_id) {

    }
})();

