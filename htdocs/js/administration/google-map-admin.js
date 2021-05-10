function load() 
{
    const maps = document.getElementsByClassName("google-map");

    for(var i = 0; i < maps.length; i++)
    {
        var panel = maps[i].getElementsByClassName("map-panel")[0];
        var zoom = parseInt(maps[i].getElementsByClassName("map-info-zoom")[0].textContent);
        var lat = parseFloat(maps[i].getElementsByClassName("map-info-lat")[0].textContent);
        var lng = parseFloat(maps[i].getElementsByClassName("map-info-lng")[0].textContent);

        var map = new google.maps.Map(panel, 
        {
            zoom: zoom,
            center: new google.maps.LatLng(lat, lng)
        });

        const markers = maps[i].getElementsByClassName("map-position");
        for(var j = 0; j < markers.length; j++)
        {
            const lat = markers[j].getElementsByClassName("map-lat")[0].textContent;
            const lng = markers[j].getElementsByClassName("map-lng")[0].textContent;
            const pos = new google.maps.LatLng(lat, lng);
            new google.maps.Marker({position: pos, map: map,});
        } 
    }
}