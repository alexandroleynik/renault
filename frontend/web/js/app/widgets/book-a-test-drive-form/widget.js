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


        loadFormData(data);
    }

    function mapInitialize() {
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

        $.each(window.dealers, function (k, v) {
            var myLatlng1 = new google.maps.LatLng(v.gps_x, v.gps_y);
            // Add markers
            var marker1 = new google.maps.Marker({
                position: myLatlng1,
                map: map1,
                icon: '/img/ico-marker.png',
                dealer: v,
                scale:4
            });

            google.maps.event.addListener(marker1, 'click', function () {
                app.logger.var(marker1.dealer);
                var html = '<h4>"' + marker1.dealer.dealers_name + '"</h4>'
                        + '<h5>Контактна інформація</h5>'
                        + '<p>' + marker1.dealer.city_name
                        + '<br>' + marker1.dealer.salon_adres + '</p>'
                        + '<h5>Салон</h5>'
                        + '<p>' + marker1.dealer.salon_phone + '</p>';
                        //+ '<h5>СТО</h5>'
                        //+ '<p>(044) 495-88-20</p>';

                $('.mapitembox').html(html);
                window.testDriveData['selected_id'] = marker1.dealer.dealers_id;                
                $('#test-drive-form-select-this-dealer-button').show();
                $('#test-drive-form-select-this-dealer-button').click(function() {
                    $('.select-dealer-header').html(marker1.dealer.dealers_name);
                    $('.select-dealer-content').slideUp();
                    $('.form .select-date-time-content').slideDown();                    
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
            renderWidget(template(data));
        });
    }

    function renderWidget(html) {
        app.logger.func('renderWidget(html)');
        app.container.append(html);
        app.view.afterWidget(widget);

        mapInitialize();
        $('.select-dealer-content').slideUp();        

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
})();

