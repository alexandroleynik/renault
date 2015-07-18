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

        loadSalons(data);
    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        var params = '';
        if (true == app.config.frontend_app_debug) {
            params = '?_' + Date.now();
        }
        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + '/js/app/widgets/' + widget.widgetName + '/templates/handlebars.html' + params, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html) {
        app.logger.func('renderWidget(html)');
        app.container.append(html);
        app.view.afterWidget(widget);

        mapInitialize();

        $('#find-a-dealer-filter-salon').click(function () {
            mapInitialize({filter: 'salon'});
            var html = $('#find-a-dealer-filter-salon-title').html();
            $('#find-a-dealer-filter-selected').html(html.replace('<br>', ' '));
        });

        $('#find-a-dealer-filter-service').click(function () {
            mapInitialize({filter: 'service'});
            var html = $('#find-a-dealer-filter-service-title').html();
            $('#find-a-dealer-filter-selected').html(html.replace('<br>', ' '));
        });

        $('#find-a-dealer-filter-pro').click(function () {
            mapInitialize({filter: 'pro'});
            var html = $('#find-a-dealer-filter-pro-title').html();
            $('#find-a-dealer-filter-selected').html(html.replace('<br>', ' '));
        });

        $('#find-a-dealer-filter-selected-del').click(function () {
            mapInitialize();
            $('.fd_box__list .fd_box__item--active').removeClass('fd_box__item--active');
            $('#find-a-dealer-filter-selected').html('*');
        });

        $('#find-a-dealer-filter-selected-refresh').click(function () {
            mapInitialize();
            $('.fd_box__list .fd_box__item--active').removeClass('fd_box__item--active');
            $('#find-a-dealer-filter-selected').html('*');
        });



    }

    function mapInitialize(conf) {
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
        var input = /** @type {HTMLInputElement} */(document.getElementById('find-a-dealer-map-input-search'));
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
        });

        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map1, 'bounds_changed', function () {
            var bounds = map1.getBounds();
            searchBox.setBounds(bounds);
        });

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

            var myLatlng1 = new google.maps.LatLng(v.gps_x, v.gps_y);
            // Add markers
            var marker1 = new google.maps.Marker({
                position: myLatlng1,
                map: map1,
                icon: '/img/ico-marker.png',
                dealer: v,
                scale: 4
            });

            google.maps.event.addListener(marker1, 'click', function () {
                app.logger.var(marker1.dealer);

                changeDealerInfo(marker1.dealer);
            });
        })

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


                    loadTemplate(data);
                });
    }

    function changeDealerInfo(dealer) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        var value;

        //name
        value = dealer['dealers_name_' + locale];
        $('#find-a-dealer-selected-dealer-block .fdealer_item__head').html(value);

        //gps_coords
        value = 'https://www.google.com.ua/maps/place/@' + dealer.gps_coords.replace(/\ /g, '') + ',17z/data=!4m2!3m1!1s0x40d4cefec397bd8f:0xd344af779861fc77';
        $('#find-a-dealer-selected-dealer-block .go-to-map').attr('href', value);

        //town
        value = dealer['city_name_' + locale];
        $('#find-a-dealer-selected-dealer-block .town').html(value);

        //street 
        //service_adres_ru salon_adres
        if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
            value = dealer['service_adres_' + locale];
        }
        if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
            value = dealer['salon_adres_' + locale];
        }
        $('#find-a-dealer-selected-dealer-block .street').html(value);

        //salon-title   service-title icons
        $('#find-a-dealer-selected-dealer-block .salon-title').hide();
        $('#find-a-dealer-selected-dealer-block .salon-phone').hide();
        $('#find-a-dealer-selected-dealer-block .service-title').hide();
        $('#find-a-dealer-selected-dealer-block .service-phone').hide();
        $('#find-a-dealer-selected-dealer-block .services-icon-salon').hide();
        $('#find-a-dealer-selected-dealer-block .services-icon-service').hide();
        $('#find-a-dealer-selected-dealer-block .services-icon-pro').hide();

        //salon_phone                
        if (!$.isEmptyObject(dealer['salon_phone'])) {
            value = dealer['salon_phone'];

            $('#find-a-dealer-selected-dealer-block .salon-title').show();
            $('#find-a-dealer-selected-dealer-block .salon-phone').show();
            $('#find-a-dealer-selected-dealer-block .salon-phone').html(value);
        }

        //service_phone
        if (!$.isEmptyObject(dealer['service_phone'])) {
            value = dealer['service_phone'];

            $('#find-a-dealer-selected-dealer-block .service-title').show();
            $('#find-a-dealer-selected-dealer-block .service-phone').show();
            $('#find-a-dealer-selected-dealer-block .service-phone').html(value);
        }

        //salon ?
        if (!$.isEmptyObject(dealer['salon_id'])) {
            $('#find-a-dealer-selected-dealer-block .services-icon-salon').show();
            $('#find-a-dealer-selected-dealer-block .salon-service-url-link').attr('href', dealer['salon_url']);
            //salon-service-promo-link
        }

        //service ?
        if (!$.isEmptyObject(dealer['service_id'])) {
            $('#find-a-dealer-selected-dealer-block .services-icon-service').show();
            $('#find-a-dealer-selected-dealer-block .salon-service-url-link').attr('href', dealer['service_url']);
            //salon-service-promo-link

        }

        //dealers_pro
        if (!$.isEmptyObject(dealer['dealers_pro'])) {
            $('#find-a-dealer-selected-dealer-block .services-icon-pro').show()
        }
    }
})();

