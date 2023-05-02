let map;
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -16.637996289362487, lng: -68.04656417274363 },
        zoom: 18,
    });
}

window.initMap = initMap;
