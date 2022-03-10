$(function () {
    'use strict';

    $('#products-component1_id').change(function() {
        var idComponent = this.value;
        console.log('id',idComponent);
        $.ajax({
            url: yiiOptions.getImage,
            dataType: "json",
            type: "POST",
            data: {
                id: idComponent
            },
            beforeSend: function() {
                //$("#"+yiiOptions+"-id_store").html(yiiOptions.spinner);
            },
            success: function(result) {
                console.log(result);
                $('#component_1').attr('src',result.link);
            }
        });
    });

    $('#products-component2_id').change(function() {
        var idComponent = this.value;
        console.log('id',idComponent);
        $.ajax({
            url: yiiOptions.getImage,
            dataType: "json",
            type: "POST",
            data: {
                id: idComponent
            },
            beforeSend: function() {
                //$("#"+yiiOptions+"-id_store").html(yiiOptions.spinner);
            },
            success: function(result) {
                console.log(result);
                $('#component_2').attr('src',result.link);
            }
        });
    });

    $('#products-component3_id').change(function() {
        var idComponent = this.value;
        console.log('id',idComponent);
        $.ajax({
            url: yiiOptions.getImage,
            dataType: "json",
            type: "POST",
            data: {
                id: idComponent
            },
            beforeSend: function() {
                //$("#"+yiiOptions+"-id_store").html(yiiOptions.spinner);
            },
            success: function(result) {
                console.log(result);
                $('#component_3').attr('src',result.link);
            }
        });
    });
});
