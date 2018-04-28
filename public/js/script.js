;
'use strict'
$(function() {
    var App = function () {
        this.productID;
    };

    App.prototype.init = function () {
        var that = this;

        $('.price').on('click', function (el) {
            var element = el.currentTarget;
            that.productID = $(element).parent().siblings('.product_id').find('span').text();

            that.changeProductPrice(element);
        })

        $('.save-price').on('click', function () {
            that.submitNewPrice(that.productID);
        })
    }

    App.prototype.changeProductPrice = function (element) {
        var el = $(element),
            modal = $("#change-price-modal");

        modal.find('.new-price').val(el.text());
        modal.modal('show');
    }

    App.prototype.submitNewPrice =function (ID) {
        var newPrice = $('.new-price').val();

        $.ajax({
            url: 'products/change_price',
            method: 'GET',
            data: {
                newPrice: newPrice,
                productID: ID
            },
            dataType: 'json'
        }).done(function(data, textStatus, jqXHR){
            window.location.reload();
        }).fail(function() {
            alert('Ошибка при обновлении цены');
        });
    }




    window.app = new App();
});

$(document).ready(function () {

    window.app.init();

});