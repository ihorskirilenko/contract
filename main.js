'use strict'

$(document).ready(function () {

    $('#form').submit(function (e) {

        e.preventDefault();

//Checking correctness of filling search field here

        var request = document.getElementById('request'), error;
        request.value.match(/^[0-9]+$/) ? error = false : error = true;

        if (error) {
            alert('Numbers should be here!');
            return false;
        }

//Get request and parse of response going below

        var method = $(this).attr('method');
        var action = $(this).attr('action');
        var data = $(this).serialize();

        $.ajax({

            type: method,
            url: action,
            data: data,

            success: function (res) {

                res = JSON.parse(res);
                var result = $('#content');

                result.load('view/table.html', function () {

                    $('td:contains("name_customer")').html(res.name_customer);
                    $('td:contains("company")').html(res.company);
                    $('td:contains("number")').html(res.number);
                    $('td:contains("date_sign")').html(res.date_sign);
                    res.services_name ? $('td:contains("services_name")').html(res.services_name) : $('td:contains("services_name")').html('There is no services!');

                });
            }
        });
    });
});