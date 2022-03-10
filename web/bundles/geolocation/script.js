var gmap = document.getElementById('askGeoLocation');

if ('geolocation' in navigator) {
    gmap.addEventListener('click', function (ev) {
        ev.stopPropagation();
        ev.preventDefault();

        navigator.geolocation.getCurrentPosition(function (location) {
            console.log('[geolocation]', location);

            var data = [
                {
                    lat: location.coords.latitude,
                    lng: location.coords.longitude
                }
            ];

            $.ajax({
                url: parseUrl(`lots/googlemaps`),
                type: "POST",
                data:{
                    data: location
                },
                success:function(r){
                    $('#lots-coordinates').val(JSON.stringify(data));
                    $('#gmap-container').html(r);
                },
            });
            $.ajax({
                url: parseUrl(`lots/weather`),
                type: "POST",
                data:{
                    data: location
                },
                success:function(r){
                    $('#weather-container').html(r);
                },

            });
        });

    });


} else {
    gmap.innerText = 'Geolocation API not supported.';
    gmap.attr('disabled',true);
}

function parseUrl(action){
    return `../../index.php?r=` + action;
}
