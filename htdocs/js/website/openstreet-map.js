window.addEventListener("load", function() 
{
    var map = document.getElementById("openstreet-map");
    if(map != null)
    {
      var zoom = parseInt(document.getElementsByClassName("map-info-zoom")[0].textContent);
      var lat = parseFloat(document.getElementsByClassName("map-info-lat")[0].textContent);
      var lng = parseFloat(document.getElementsByClassName("map-info-lng")[0].textContent);
  
      var map = new ol.Map({
          target: "openstreet-map",
          layers: [
            new ol.layer.Tile({
              source: new ol.source.OSM()
            })
          ],
          view: new ol.View({
            center: ol.proj.fromLonLat([lng, lat]),
            zoom: zoom
          })
      });
  
      const markers = document.getElementsByClassName("map-position");
      var features = [];
      for(var j = 0; j < markers.length; j++)
      {
          const lat = markers[j].getElementsByClassName("map-lat")[0].textContent;
          const lng = markers[j].getElementsByClassName("map-lng")[0].textContent;
          var feature = new ol.Feature({ geometry: new ol.geom.Point(ol.proj.fromLonLat([lng, lat])), });
          feature.setStyle(
              new ol.style.Style({
                image: new ol.style.Icon({
                  crossOrigin: 'anonymous',
                  src: 'content/marker.png',
                  scale: 0.05,
                }),
              })
          );
          features.push(feature);
      }
  
      var vectorSource = new ol.source.Vector({ features: features});
      var vectorLayer = new ol.layer.Vector({ source: vectorSource });
      map.addLayer(vectorLayer);
    }
});