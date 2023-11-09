let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");

  //This is the map default location
  const map = new Map(document.getElementById("map"), {
    center: { lat: 14.544, lng: 121.1266 },
    zoom: 15,
  });

  //This is the marker A
  new google.maps.Marker({
    position: { lat: 14.5443, lng: 121.1266 },
    map: map,
    draggable: true,
    animation: google.maps.Animation.DROP,
  });
}

initMap();

// 14.544390200469703, 121.1266377822274;
