var map;
var info;
var name;
var loc;
var dragmark;
var position;
var m;
var pushmark;
var lat;
var lng;
function createMap(){
    var option = {
        center: {lat: -0, lng: 0},
        zoom: 18
    };
    map = new google.maps.Map(document.getElementById('map'), option); 
    //default location
    infoWindow = new google.maps.InfoWindow;
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(p) { 
            position = {
                lat: p.coords.latitude,
                lng: p.coords.longitude
            };
            infoWindow.setPosition(position);
            infoWindow.setContent('Your Location');
            infoWindow.open(map);
        }, function (){
            handlelocationerror('geolocation services error', map.center);     
        })   
    } else {
        handlelocationerror('no geolocation available', map.center);
    }
    function handlelocationerror (content, position) {
        infoWindow.setPosition(position);
        infoWindow.setContent(content);
        infoWindow.open(map);
    }
    var input = document.getElementById('address');
    var searchBox = new google.maps.places.SearchBox(input); 
    map.addListener('bounds_changed', function(){
        searchBox.setBounds(map.getBounds());
    });
    var markers = [];
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length === 0)
        return ;
        markers = [];
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (p){
            if(!p.geometry)
                return;  
                pushmark = new google.maps.Marker ({
                    map: map,
                    title: p.name,
                    draggable:true,
                    position: p.geometry.location,
                    animation: google.maps.Animation.DROP,
                });
            var infowindow = new google.maps.InfoWindow();
            markers.push(pushmark);
            pushmark.addListener('click', function() {
                if (pushmark.getAnimation() !== null) {
                    pushmark.setAnimation(null);
                }
                else {
                    pushmark.setAnimation(google.maps.Animation.BOUNCE);
                    infowindow.setContent(p.name);
                     infowindow.open(map, pushmark);
                  }
              });
            if(p.geometry.viewport){
                name = document.getElementById('address').value;
                lat = p.geometry.location.lat();
                lng = p.geometry.location.lng();
                bounds.union(p.geometry.viewport);         
                info = "<b>Latitude  : </b>" + lat + "<br/>";
                info += "<b>Longitude  : </b>" + lng + "<br/>";
                document.getElementById('out').innerHTML = info;  
            }
            else{
                bounds.extend(p.geometry.location);
            }        
        });
        map.fitBounds(bounds);
    });
}