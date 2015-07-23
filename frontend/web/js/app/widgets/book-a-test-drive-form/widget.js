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

        loadTranslation(data);

        //http://dealers.renault.ua/platformAjaxRequest.php

        $.getScript(
            app.config.frontend_app_web_url + "/js/lib/validator/localization/messages_" + app.router.locale + ".js"
        );
        loadFormData(data);
    }

    function mapInitialize(data) {
        // Coordinates
        var myLatlng1 = new google.maps.LatLng(49.3159955, 32.0068446);
        // Map options
        var mapOptions1 = {
            scrollwheel: false,
            center: myLatlng1,
            zoom: 6,
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

            // For each place, get the icon, place name, and location.
            markers = [];
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0, place; place = places[i]; i++) {
                var image = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                var marker = new google.maps.Marker({
                    map: map1,
                    icon: image,
                    title: place.name,
                    position: place.geometry.location
                });

                markers.push(marker);

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

        $.each(window.dealers, function (k, v) {
            var myLatlng1 = new google.maps.LatLng(v.gps_x, v.gps_y);
            // Add markers
            var marker1 = new google.maps.Marker({
                position: myLatlng1,
                map: map1,
                icon: '/img/ico-marker2.png',
                dealer: v,
                scale: 4
            });
            
            

            google.maps.event.addListener(marker1, 'click', function () {
                app.logger.var(marker1.dealer);
                var html = '<h4>"' + marker1.dealer.dealers_name + '"</h4>'
                        + '<h5>' + data.t.contact_info + '</h5>'
                        + '<p>' + marker1.dealer.city_name
                        + '<br>' + marker1.dealer.salon_adres + '</p>'
                        + '<h5>'+ data.t.salon + '</h5>'
                        + '<p>' + marker1.dealer.salon_phone + '</p>';
                //+ '<h5>СТО</h5>'
                //+ '<p>(044) 495-88-20</p>';
				
				$('.map-wrapper').addClass('mw-dealer-selected');

                $('.mapitembox').html(html);
                window.testDriveData['selected_id'] = marker1.dealer.dealers_id;
                $('#test-drive-form-select-this-dealer-button').show();
                $('#test-drive-form-select-this-dealer-button').click(function () {
                    $('.select-dealer-header').html(marker1.dealer.dealers_name);
                    $('.select-dealer-content').slideUp();
					$('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');
                    $('.form .select-date-time-content').slideDown();
					$('.form .select-date-time-content, .form .select-date-time-header').attr('data-state', 'open');
                });

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
                data.Select_this_dealer     =   "Вибрати цього диллера";
                data.select_date_and_time   =   "Оберіть дату та час";
                data.Select_date            =   "оберіть дату";
                data.select_time            =   "оберіть час";
                data.optional_confirmation  =   "Ми зв'яжемось з Вами щоб підтвердити, що обрані Вами дата та час вільні";
                data.change_this_datetime   =   "Обрати ці дату та час";

                data.accost                 =   "Звертання";
                data.Mr                     =   "Пан";
                data.Ms                     =   "Пані";
                data.name                   =   "Ім'я";
                data.surname                =   "Прізвище";
                data.patronymic             =   "По батькові";
                data.E_Mail                 =   "E-Mail";
                data.post_code              =   "Індекс";
                data.settlement             =   "Населений пункт";
                data.house_number           =   "Номер будинку";
                data.VIN                    =   "VIN <span>(номер кузова, зазначений у свідоцтві<br> про реєстрацію транспортного засобу)</span>";
                data.phone                  =   "Мобільний телефон";
                data.region                 =   "Область";
                data.street                 =   "Вулиця";
                data.number_of_apartments   =   "Номер квартири";
                data.The_state_reg_number   =   "Державний реєстраційний номер";
                data.your_question          =   "Ваше питання";

                data.Subscribe_to_news      =   "Підписатися на новини Renault";
                data.consent                =   "Даю свою згоду на обробку зазначених мною вище персональних даних";


               break
            case "ru":
                data.Select_this_dealer     =   "Выбрать этого диллера";
                data.select_date_and_time   =   "Выберите дату и время";
                data.Select_date            =   "выберите дату";
                data.select_time            =   "выберите время";
                data.optional_confirmation  =   "Мы свяжемся с Вами, чтобы подтвердить, что выбранные Вами дата и время свободны";
                data.change_this_datetime   =   "Выбрать эти дату и время";

                data.accost                 =   "Обращение";
                data.Mr                     =   "Г-н";
                data.Ms                     =   "Г-жа";
                data.name                   =   "Имя";
                data.surname                =   "Фамилия";
                data.patronymic             =   "Отчество";
                data.E_Mail                 =   "E-Mail";
                data.post_code              =   "Индекс";
                data.settlement             =   "Неселённый пункт";
                data.house_number           =   "Номер дома";
                data.VIN                    =   "VIN <span>( Номер кузова, указанный в свидедельстве<br> о регистрации транспортного средства)</span>";
                data.phone                  =   "Мобильный телефон";
                data.region                 =   "Область";
                data.street                 =   "Улица";
                data.number_of_apartments   =   "Номер квартиры";
                data.The_state_reg_number   =   "Государственный регистрационный номер";
                data.your_question          =   "Ваш вопрос";

                data.Subscribe_to_news      =   "Подписаться на новости RENAULT";
                data.consent                =   "Даю своё согласие на обработку указанных мною выше личных данных";

               break
            default:
                break
        }

    }
})();

