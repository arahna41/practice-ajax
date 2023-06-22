'use strict';

// Initialize and add the map
let map;
let markersArray = [];

async function initMap() {
  const markers = document.querySelectorAll('.markers span');
  markers.forEach((marker, i) => {
    markersArray.push({
      title: marker.textContent,
      position: {
        lat: +marker.getAttribute('data-lat'),
        lng: +marker.getAttribute('data-lng'),
      },
    });
  });

  let center = {
    lat: 0,
    lng: 0,
  };

  markersArray.forEach((marker) => {
    center.lat += marker.position.lat;
    center.lng += marker.position.lng;
  });
  center.lat = center.lat / 3;
  center.lng = center.lng / 3;

  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary('maps');
  const { AdvancedMarkerElement } = await google.maps.importLibrary('marker');

  // The map
  map = new Map(document.getElementById('map'), {
    zoom: 12,
    center: center,
    mapId: 'DEMO_MAP_ID',
  });

  // Markers
  markersArray.forEach((marker) => {
    new AdvancedMarkerElement({
      map: map,
      position: marker.position,
      title: marker.title,
    });
  });
}

initMap();
