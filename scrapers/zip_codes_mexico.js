let states = [];
let cities = [];
let zip_codes = [];
let settlements = [];

$(document).ready(function() {
    $('#tbody_results tr').each(function() {
        var data = $(this).find('td:eq(2) > a');
        state = {
            'link': data.attr('href'),
            'name': data.html()
        }
        
        states.push(state);
    });

    $.each(states, function(index, value) {
        link = value.link;

        $.ajax({
            url: link,
            async: false, 
            success: function(response) {
                var data = $.parseHTML(response)[44];
                data = $(data).find('#search_source li a');
                
                $.each(data, function(i, v) {
                    city = {
                        'link': $(v).attr('href'),
                        'state_name': value.name,
                        'name': $(v).html()
                    }
                    
                    cities.push(city);
                });
            }
        });
    });

    $.each(cities, function(index, value) {
        link = value.link;
        $.ajax({
            url: link,
            async: false, 
            success: function(response) {
                var data_cities = $.parseHTML(response)[58];
                data_cities = $(data_cities).find('table tbody tr');
                
                $.each(data_cities, function(i2, v2) {
                    var code = $(v2).find('td:eq(0) > a').html();

                    if (!zip_codes.find(x => x.code === code)) {
                        zip_code = {
                            'city_name': value.name,
                            'code': code
                        }
                        
                        zip_codes.push(zip_code);
                    }

                    settlement = {
                        'zip_code': code,
                        'name': $(v2).find('td:eq(1) > a').html(),
                        'zone': $(v2).find('td:eq(4)').html(),
                    }

                    settlements.push(settlement);
                });
            }
        });
    });
});