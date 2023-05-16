var validate = document.getElementById('validate-hash');

validate.addEventListener('click', function (ev) {
    var text = $("#btn-validate-text").text();
    $.ajax({
        url: parseUrl(`showcase/validate`),
        type: "POST",
        data:{
            id: $('#lot-id').val(),
        },
        afterSend: function() {
            $('#validate-container').html('');
        },
        beforeSend: function() {
            $("#btn-validate-text").html(yiiShowcaseOptions.spinner);
        },
        success:function(r){
            $("#btn-validate-text").text(text);
            $('#validate-container').html(r);
        },
        error:function(r){
            $("#btn-validate-text").text(text);
            $(".validate-error").show().html(r);
        }
    });


});

function parseUrl(action){
    return `../../index.php?r=` + action;
}
