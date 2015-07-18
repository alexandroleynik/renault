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
        
        mapInitialize();
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

        /*$.each(window.dealers, function (k, v) {
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
                $('#test-drive-form-select-this-dealer-button').click(function () {
                    $('.select-dealer-header').html(marker1.dealer.dealers_name);
                    $('.select-dealer-content').slideUp();
                    $('.form .select-date-time-content').slideDown();
                });

            });
        })*/


    }
})();

