import $ from 'jquery'

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};

$(document).ready(function() {
    $('.ajax-reservations, .ajax-dates, .ajax-places').click(function () {
        $('.ajax-button').removeClass('active');
    });

    $('.ajax-dates').click(function() {
        $(this).addClass('active');
        alert('dates');
    });

    $('.ajax-places').click(function() {
        $(this).addClass('active');
        loadPlaces();
    });

    $('.ajax-reservations').click(function() {
        $(this).addClass('active');
        loadReservations();
    });

    function loadDates() {
        jQuery.ajax('').done(function() {

        });
    }

    function loadPlaces() {   
        $.getJSON('index.php?module=site&controller=site&action=place', function(data) {
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

            $('.ajax-content').html(tablehtml);
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