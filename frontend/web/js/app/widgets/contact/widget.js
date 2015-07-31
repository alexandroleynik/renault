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
        
        loadTemplate(data);
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
				
				for(var i=0; i<allMarkers.length; i++){
					allMarkers[i].setIcon('/img/ico-marker3.png');
				}
				
				marker1.setIcon('/img/ico-marker2.png');
            });
        })

    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        var params = '';
        if ( true == app.config.frontend_app_debug) {
            params = '?_'+ Date.now();
        }
        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + '/js/app/widgets/' + widget.widgetName + '/templates/handlebars.html' + params, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html) {
        app.logger.func('renderWidget(html)');
        app.container.append(html);

        app.view.afterWidget(widget);

        mapInitialize(data);
    }
})();

