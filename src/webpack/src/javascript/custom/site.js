import $ from 'jquery'

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};

$(document).ready(function() {

    loadReservationForSelect($('#reservation-city-select').val());
    loadSiteForSelect($('#reservation-city-select').val());

    $('.ajax-reservations, .ajax-dates, .ajax-places').click(function () {
        $('.ajax-button').removeClass('active');
    });

    $('.ajax-dates').click(function() {
        $(this).addClass('active');
        loadDates();
    });

    $('.ajax-places').click(function() {
        $(this).addClass('active');
        loadPlaces();
    });

    $('.ajax-reservations').click(function() {
        $(this).addClass('active');
        loadReservations();
    });

    $('#reservation-city-select').change(function() {
        console.log('test');
        loadReservationForSelect($('#reservation-city-select').val());
    });

    $('#reservation-city-select').change(function() {
        console.log('test');
        loadSiteForSelect($('#reservation-city-select').val());
    });

    function loadReservationForSelect(cityId) {
        $('#reservation-date-select').empty();
        $.getJSON('index.php?module=reservation&controller=reservation&action=date&data[cityId]=' + cityId).done(function(data) {
            $.each( data, function( id, data ) {
                $("#reservation-date-select").append(new Option(data.date, id));
            });
        });
    }

    function loadSiteForSelect(cityId) {
        $('#reservation-site-select').empty();
        $.getJSON('index.php?module=reservation&controller=reservation&action=site&data[cityId]=' + cityId).done(function(data) {
            $.each( data, function( id, data ) {
                $("#reservation-site-select").append(new Option(data.site, id));
            });
        });
    }

    function loadDates() {
        $.getJSON('index.php?module=site&controller=site&action=date&data[cityId]=' + siteConfig.cityId).done(function(data) {
            console.log(data);
            var newbuttonlink = "index.php?module=site&controller=site&action=newDate&data[cityId]=" + siteConfig.cityId;
            var newbutton = "<a href=" + newbuttonlink + ">Neuer Termin</a>";
            
            var tablehtml = "<table class='table table-striped table-dark'>";
            
            tablehtml += "<thead class='thead-dark'>";
            tablehtml += "<tr>";
            tablehtml += "<th scope='col'>#</th>";
            tablehtml += "<th scope='col'>Datum</th>";
            tablehtml += "</thead>";

            tablehtml += "<tbody>";
            $.each( data, function( id, dates ) {

                console.log(dates);

                tablehtml += '<tr">';
                tablehtml += '<td>' + id + '</td>';
                tablehtml += '<td>' + dates + '</td>';
                tablehtml += '</tr>';
            });
            tablehtml += "</tbody></table>";

            $('.ajax-content').html(newbutton + tablehtml);
        });
    }

    function loadPlaces() { 
        //console.log(siteConfig.cityId);  
        $.getJSON('index.php?module=site&controller=site&action=place&data[cityId]=' + siteConfig.cityId, function(data) {
            var newbuttonlink = "index.php?module=site&controller=site&action=newPlace&data[cityId]=" + siteConfig.cityId;
            var newbutton = "<a href=" + newbuttonlink + ">Neuer Markstand</a>";
            var tablehtml = "<table class='table table-striped table-dark'>";
            
            tablehtml += "<thead class='thead-dark'>";
            tablehtml += "<tr>";
            tablehtml += "<th scope='col'>#</th>";
            tablehtml += "<th scope='col'>Länge</th>";
            tablehtml += "<th scope='col'>Breite</th>";
            tablehtml += "</thead>";

            tablehtml += "<tbody>";
            $.each( data, function( id, places ) {
                tablehtml += '<tr">';
                tablehtml += '<td>' + id + '</td>';
                tablehtml += '<td>' + places.length + '</td>';
                tablehtml += '<td>' + places.width + '</td>';
                tablehtml += '</tr>';
            });
            tablehtml += "</tbody></table>";

            $('.ajax-content').html(newbutton + tablehtml);
        });
    }

    function loadReservations() {
        $.getJSON('index.php?module=site&controller=site&action=reservation', function(data) {

            var filterhtml = "<button data-filter='filter-all' type='button' class='btn btn-outline-dark btn-filter active'>Alle</button> ";
            var tablehtml = "<table class='table table-striped table-dark'>";
            
            tablehtml += "<thead class='thead-dark'>";
            tablehtml += "<tr>";
            tablehtml += "<th scope='col'>#</th>";
            tablehtml += "<th scope='col'>Datum</th>";
            tablehtml += "<th scope='col'>Name</th>";
            tablehtml += "<th scope='col'>Strasse</th>";
            tablehtml += "<th scope='col'>PLZ</th>";
            tablehtml += "<th scope='col'>Stadt</th>";
            tablehtml += "</tr>";
            tablehtml += "</thead>";

            tablehtml += "<tbody>";
            $.each( data, function( date, companys ) {

                var filterClass = "filter_" + date.replaceAll(".", "_")
                filterhtml += "<button data-filter='" + filterClass +"' type='button' class='btn btn-outline-dark btn-filter'>" + date + "</button> ";

                $.each( companys, function( i, company ) {

                    tablehtml += '<tr class="' + filterClass + ' filter-all">';
                    tablehtml += '<td>' + i + '</td>';
                    tablehtml += '<td>' + date + '</td>';
                    tablehtml += '<td>' + company.company.name + '</td>';
                    tablehtml += '<td>' + company.company.street + '</td>';
                    tablehtml += '<td>' + company.company.zip + '</td>';
                    tablehtml += '<td>' + company.company.city + '</td>';
                    tablehtml += '</tr>';

                });
            });

            tablehtml += "</tbody></table>";
            
            $('.ajax-content').html(filterhtml + tablehtml);

            $('.btn-filter').click(function() {
                $('.btn-filter').removeClass('active');
                $( this ).addClass('active');

                var filter = $(this).data('filter');
                
                if (filter == "filter-all") {
                    $(".filter-all").show();
                }
                else {
                    $(".filter-all").hide();
                    $("." + filter).show();
                }  
            });
        }); 
    }
});