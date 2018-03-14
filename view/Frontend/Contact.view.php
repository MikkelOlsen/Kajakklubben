<div class="contact">
    <div class="contact-form">
        <h2>Kontakt</h2>
        <p>Skriv til os, hvis du har spørgsmål eller andet på hjerte :)</p>
        <form method="post">
            <input name="name" type="text" placeholder="Navn">
            <input name="email" type="email" placeholder="Email">
            <input name="phone" type="tel" placeholder="Telefonnummer (valgfrit)">
            <textarea name="message" rows="10" placeholder="Besked"></textarea>
            <input type="submit" name="submit" value="Send besked">
        </form>
    </div>
</div>

        <div class="google-map" id="map">
        </div>

        <script>
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhASwLPHfQ1X1N7o2OY5tB_SiDRNs1Ve0&callback=initMap">
    </script>




