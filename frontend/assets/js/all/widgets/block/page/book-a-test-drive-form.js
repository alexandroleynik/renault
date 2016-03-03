app.view.wfn['book-a-test-drive-form'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/book-a-test-drive-form.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.t = app.view.getTranslationsFromData(data);
        //data.datapicker = getDataPickerFromData(data);

        //loadTranslation(data);

        //http://dealers.renault.ua/platformAjaxRequest.php

        /*$.getScript(
         app.config.frontend_app_web_url + "/js/lib/validator/localization/messages_" + app.router.locale + ".js"
         );*/
        window.contact_info = data.contact_info;
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
            scrollwheel: true,
            center: myLatlng1,
            zoom: zoom,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        // Init map
        var map1 = new google.maps.Map(document.getElementById('mapresult'), mapOptions1);


        // Create the search box and link it to the UI element.

        markers = [];
        var input = /** @type {HTMLInputElement} */(document.getElementById('test-drive-form-map-input-search'));
        //map1.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        //var SearchBox = new google.maps.places.SearchBox((input));
        var autocomplete = new google.maps.places.Autocomplete(input,
                {
                    types: ['(cities)'],
                    componentRestrictions: {'country': 'ua'}
                }
        );

        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            //filter dealers list
            if (!$.isEmptyObject(autocomplete.getPlace()) && !$.isEmptyObject(autocomplete.getPlace()) && !$.isEmptyObject(autocomplete.getPlace().name)) {
                var town = autocomplete.getPlace().name;
                app.logger.var(autocomplete.getPlace());
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

            bounds.extend(place.geometry.location);


            map1.fitBounds(bounds);
            map1.setZoom(11);


        });

        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map1, 'bounds_changed', function () {
            var bounds = map1.getBounds();
            autocomplete.setBounds(bounds);
        });

        app.view.allMarkers = [];

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

            app.view.allMarkers.push(marker1);

            google.maps.event.addListener(marker1, 'click', function () {
                markerClick.call(this, marker1, app.view.allMarkers);
            });
        })

        var markerCluster = new MarkerClusterer(map1, app.view.allMarkers, {
          maxZoom: 7,
          gridSize: 50,
          styles: [{
            height: 60,
            width: 40,
            anchor: [20,0],
            textColor: '#fff',
            textSize: 18,
            url: '/img/claster2.png'
          }]
        });

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

        var v = app.config.frontend_app_files_midified[template];

        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html, data) {
        app.logger.func('renderWidget(html)');
        $('#widget-wrapper-' + widget.uniqueKey).append(html);
        app.view.afterWidget(widget);

        //mapInitialize(data);
        app.view.tmpMapData = data;

        loadGoogleMaps();

        setTimeout(function () {
            $('.select-dealer-content').slideUp();
            $('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');

            setDefaultValues();
            setPredefinedValues(data);
        }, 3000);
    }

    GoogleMapsLoaded = function () {
        app.view.gMapsLoaded = true;

        mapInitialize(app.view.tmpMapData);
    }

    function loadGoogleMaps() {
        if (true != app.view.gMapsLoaded) {
            app.logger.func('loadGoogleMaps');
            $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=uk&async=2&callback=GoogleMapsLoaded", function () {
            });
        }
        else {
            GoogleMapsLoaded();
        }
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
            'punkt[8]': curr_date + '.' + curr_month + '.' + curr_year, //Желаемая дата тест-драйва
            'punkt[9]': '9:00-10:00', //Желаемое время тест-драйва
            'punkt[10]': 'yes', //Даю своё согласие на обработку указанных мной выше персональных данных*
            'punkt[11]': 'true', //Я хочу получать информацию от Renault
            'submit-val': '1',
            'RenaultDealerDomain': location.hostname,
            'CampaignUniqueId': getQueryVariable('utm_medium') ? getQueryVariable('utm_medium') : 'WIFIBAR',
            'Media': getQueryVariable('utm_source') ? getQueryVariable('utm_source') : 'WIFIBAR'
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
                + '<h5>'+window.contact_info+'</h5>'
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
            selectThisDealerButtonClick(dealer);
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

    function setPredefinedValues(data) {
        var model, salon_id, service_id, city_id, dealer_id;

        model = $.urlParams('get', 'model'); //'Dokker VAN'
        salon_id = $.urlParams('get', 'salon_id'); //4
        service_id = $.urlParams('get', 'service_id'); //35
        city_id = $.urlParams('get', 'city_id'); //9

        if (app.config.frontend_app_dealer_id) {
            dealer_id = app.config.frontend_app_dealer_id;
        }

        if (model) {
            $('.vehicle-categories').find('.vehicle-in-category-name-inner').each(function (k, v) {
                if (model.toLowerCase() == $(this).html().toLowerCase()) {
                    modelClick.call($(this).parent().parent());
                }
            });
        }

        if (city_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (city_id == v.dealer.city_id) {
                    app.logger.text('predefined city: ' + v.dealer.city_name_ua);

                    $('#test-drive-form-map-input-search').val(v.dealer.city_name_ua);
                    data.center = v.dealer.gps_x + ',' + v.dealer.gps_y;
                    data.zoom = 11;
                    mapInitialize(data);

                    return;
                }
            });
        }

        if (salon_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (salon_id == v.dealer.salon_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                    return;
                }
            });
        }

        if (service_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (service_id == v.dealer.service_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                    return;
                }
            });
        }

        if (dealer_id && dealer_id > 0) {
            $('#test-drive-form-map-input-search').parent().hide();

            $.each(app.view.allMarkers, function (k, v) {
                if (dealer_id == v.dealer.dealers_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                }
                else {
                    v.visible = false;
                }
            });
        }
    }

    function markerClick(marker1, allMarkers) {
        app.logger.var(marker1.dealer);

        changeDealerInfo(marker1.dealer);

        for (var i = 0; i < allMarkers.length; i++) {
            allMarkers[i].setIcon('/img/ico-marker3.png');
        }

        marker1.setIcon('/img/ico-marker2.png');

        //app.logger.var(allMarkers);
    }
});
