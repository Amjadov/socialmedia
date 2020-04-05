        var map;
        var infowindow;
        var channel;
        var PUBNUB_SUBSCRIBE_KEY;
        var lookup = [];
        var markers = [];
        var pubnub = new PubNub({
          subscribeKey: PUBNUB_SUBSCRIBE_KEY,  //"{{ env('PUBNUB_SUBSCRIBE_KEY') }}",
          ssl: true 

        })
      function initMap() {
        
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 24.7805827, lng: 46.663123}
        });
        infowindow = new google.maps.InfoWindow();
        /*@foreach($markers as $marker)
            var loc = {lat: {{ $marker->lat }}, lng: {{ $marker->lng }}};
            var name = '{{ $marker->name }}';
            var mobile = '{{ $marker->mobile }}';
            var content = '<p>' + name + '</br> ' + mobile + '</p>';
            placeMarker(loc, '{{ $marker->name }}', content);
            //alert(loc['lat']);
            //placeMarker(loc, 'test','test');
            
            
        @endforeach*/
        
      }
      function placeMarker( loc,title,content ) {
            var latLng = new google.maps.LatLng( parseFloat(loc['lat']), parseFloat(loc['lng']));
            var marker = new google.maps.Marker({
              position : latLng,
              map      : map,
              title    : title,
            });
            marker.addListener('click', function() {
                infowindow.close(); // Close previously opened infowindow
                infowindow.setContent(content);
                infowindow.open(map, marker);
            });
            return marker;
            
          }
      function change_position(loc, marker){
            var latLng = new google.maps.LatLng( parseFloat(loc['lat']), parseFloat(loc['lng']));
            marker.setPosition(latLng);
            marker.setVisible(true);
          }
    
      pubnub.subscribe({
        channels: [channel] //['{{ Config::get("enums.current_environment")["environment"].Config::get("enums.channels")["UPDATE_DRIVER_CHANNEL"] }}']
      });
      pubnub.addListener({
        message: function(payload){
          //var msg = JSON.parse(message['message']);
          var driver_id = payload.message.driver_id;
          var loc_time = payload.message.now;
          var driver_mobile = payload.message.mobile;
          var driver_name = payload.message.name;
          var driver_comp_id = payload.message.company_id;
          var driver_loc = {lat: payload.message.location[0], lng: payload.message.location[1]}; ;
          var driver_online = payload.message.online;
          var content = '<p>Name: ' + driver_name + '</br>ID: ' + driver_id + '</br>Mobile: ' + driver_mobile + '</br>Online: ' + driver_online + '</br>Company: ' + driver_comp_id + ' </p>';
          var i = marker_exists(driver_id);
          //console.log("New Message I is  : " + i);
          if(i != -1){
            change_position(driver_loc,markers[i]);
          }else{
            marker = placeMarker(driver_loc,String(driver_name),content);
            markers.push(marker);
            lookup.push(driver_id);
          }
          //console.log("New Message from : " + driver_id);
          //console.log("New Message date : " + loc_time);
          //console.log("New Message loc : " + driver_loc);
          //console.log("New Message online : " + driver_online);

        }

      })

      function marker_exists(lookup_code){
        for(var i = 0,l = lookup.length; i < l; i++){
          if(lookup[i] === lookup_code){
            return i;
          }
        }
        return -1;
      }
