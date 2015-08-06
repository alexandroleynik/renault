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
        data.t = app.view.getTranslationsFromData(data);

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

        bindEvents();
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
                /*var image = {
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
                 position: place.geometry.location,                    
                 });
                 
                 markers.push(marker);*/

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
				
				$('html, body').animate({scrollTop: $('#find-a-dealer-selected-dealer-block').offset().top+$('#find-a-dealer-selected-dealer-block').outerHeight()-$(window).height()});
				
				for(var i=0; i<allMarkers.length; i++){
					allMarkers[i].setIcon('/img/ico-marker3.png');
				}
				
				marker1.setIcon('/img/ico-marker2.png');
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

                    data.dealers = getPreparedDealers(app.view.dealers);

                    loadTemplate(data);

                });
    }

    function changeDealerInfo(dealer) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        var value;
        var block = $('#find-a-dealer-selected-dealer-block');

        block.show();
        $('#find-a-dealer-selected-dealer-block-message').hide();

        //name
        value = dealer['dealers_name_' + locale];
        block.find('.fdealer_item__head').html(value);

        //gps_coords
        value = 'https://www.google.com.ua/maps/place/@' + dealer.gps_coords.replace(/\ /g, '') + ',17z/data=!4m2!3m1!1s0x40d4cefec397bd8f:0xd344af779861fc77';
        block.find('.go-to-map').attr('href', value);

        //town
        value = dealer['city_name_' + locale];
        block.find('.town').html(value);

        //street 
        //service_adres_ru salon_adres
        if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
            value = dealer['service_adres_' + locale];
        }
        if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
            value = dealer['salon_adres_' + locale];
        }
        block.find('.street').html(value);

        //salon-title   service-title icons
        block.find('.salon-title').hide();
        block.find('.salon-phone').hide();
        block.find('.service-title').hide();
        block.find('.service-phone').hide();
        block.find('.services-icon-salon').hide();
        block.find('.services-icon-service').hide();
        block.find('.services-icon-pro').hide();

        //salon_phone                
        if (!$.isEmptyObject(dealer['salon_phone'])) {
            value = dealer['salon_phone'];

            block.find('.salon-title').show();
            block.find('.salon-phone').show();
            block.find('.salon-phone').html(value);
        }

        //service_phone
        if (!$.isEmptyObject(dealer['service_phone'])) {
            value = dealer['service_phone'];

            block.find('.service-title').show();
            block.find('.service-phone').show();
            block.find('.service-phone').html(value);
        }

        //salon ?
        if (!$.isEmptyObject(dealer['salon_id'])) {
            block.find('.services-icon-salon').show();
            block.find('.salon-service-url-link').attr('href', dealer['salon_url']);
            //salon-service-promo-link
        }

        //service ?
        if (!$.isEmptyObject(dealer['service_id'])) {
            block.find('.services-icon-service').show();
            block.find('.salon-service-url-link').attr('href', dealer['service_url']);
            //salon-service-promo-link

        }

        //dealers_pro
        if (!$.isEmptyObject(dealer['dealers_pro'])) {
            block.find('.services-icon-pro').show()
        }
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

    function bindEvents() {
        $('#find-a-dealer-filter-salon').click(function () {
            mapInitialize({filter: 'salon'});
            var html = $('#find-a-dealer-filter-salon-title').html();
            $('#find-a-dealer-filter-selected').html(html.replace('<br>', ' '));
            $('#find-a-dealer-filter-selected-del').show();
            $('.fd_box__selected h4').show();
            $('.fd_box__selected-items').show();
        });

        $('#find-a-dealer-filter-service').click(function () {
            mapInitialize({filter: 'service'});
            var html = $('#find-a-dealer-filter-service-title').html();
            $('#find-a-dealer-filter-selected').html(html.replace('<br>', ' '));
            $('#find-a-dealer-filter-selected-del').show();
            $('.fd_box__selected h4').show();
            $('.fd_box__selected-items').show();
        });

        $('#find-a-dealer-filter-pro').click(function () {
            mapInitialize({filter: 'pro'});
            var html = $('#find-a-dealer-filter-pro-title').html();
            $('#find-a-dealer-filter-selected').html(html.replace('<br>', ' '));
            $('#find-a-dealer-filter-selected-del').show();
            $('.fd_box__selected h4').show();
            $('.fd_box__selected-items').show();
        });

        $('#find-a-dealer-filter-selected-del').click(function () {
            mapInitialize();

            if (!$.isEmptyObject(app.view.$grid)) {
                if (!$.isEmptyObject(app.view.mapFilterValue)) {
                    var filterValue = app.view.mapFilterValue;
                    app.view.$grid.isotope({filter: filterValue});
                }
            }

            $('.fd_box__list .fd_box__item--active').removeClass('fd_box__item--active');
            $('#find-a-dealer-filter-selected').html('*');
            $('#find-a-dealer-filter-selected-del').hide();
            $('.fd_box__selected h4').hide();
            $('.fd_box__selected-items').hide();
            //$('.fd_box').addClass('hidden')           
        });

        $('#find-a-dealer-filter-selected-refresh').click(function () {
            mapInitialize();

            if (!$.isEmptyObject(app.view.$grid)) {
                if (!$.isEmptyObject(app.view.mapFilterValue)) {
                    var filterValue = app.view.mapFilterValue;
                    app.view.$grid.isotope({filter: filterValue});
                }
            }

            $('.fd_box__list .fd_box__item--active').removeClass('fd_box__item--active');
            $('#find-a-dealer-filter-selected').html('*');
            $('#find-a-dealer-filter-selected-del').hide();
            $('.fd_box__selected h4').hide();
            $('.fd_box__selected-items').hide();
        });

        $('.go-to-local-gps_coords').click(function () {
            var center = $(this).attr('map-center').replace(/\ /g, '');
            $('#map-tab-a').click();
            setTimeout(function () {
                mapInitialize({"center": center, "zoom": 12});
            }, 200);

        });

        $('#map-tab-a').on('click', function () {
            setTimeout(function () {
                $('.fd_box__list .fd_box__item--active').click();
            }, 200);

        })

    }
})();

