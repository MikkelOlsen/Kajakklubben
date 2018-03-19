<?php
  if(isset($POST['contactSubmit']))
  {
    $error = [];
    $DATA['contactName'] = Validate::stringBetween($POST['contactName'], 2, 45) ? $POST['contactName'] : $error['contactName'] = '<p style="">Navn skal udfyldes og være mellem 2 og 45 tegn.</p>';
    $DATA['contactEmail'] = Validate::email($POST['contactEmail']) ? $POST['contactEmail'] : $error['contactEmail'] = '<p>Emailen er ikke i gyldig format.</p>';
    $DATA['contactMsg'] = Validate::stringBetween($POST['contactMsg'], 10, 500) ? $POST['contactMsg'] : $error['contactMsg'] = '<p>Beskeden skal udfyldes og være mellem 10 og 500 tegn.</p>';
    if(!empty($POST['contactPhone']))
    {
      if(is_numeric($POST['contactPhone']))
      {
        $DATA['contactPhone'] = Validate::phone($POST['contactPhone']) ? $POST['contactPhone'] : $error['contactPhone'] = '<p>Telefon nummeret er ikke i gyldig format.</p>';
      }
      else 
      {
        $error['contactPhone'] = '<p>Telefon nummeret må kun indeholde tal.</p>';
      }
    } 
    else 
    {
      $DATA['contactPhone'] = null;
    }

    if(sizeof($error) == 0)
    {
      if(Contact::SubmitMessage($DATA) == true)
      {
        $status = '<p class="success">Tak for din henvendelse, vi vender tilbage hurtigst muligt. :)</p>';
      }
    }
  }
?>

<div class="contact">
    <div class="contact-form">
        <h2>Kontakt</h2>
        <?php
          if(isset($status))
          {
            echo $status;
          }
          else 
          {
            echo '<p>Skriv til os, hvis du har spørgsmål eller andet på hjerte :)</p>';
          }
        ?>
        <form method="post">
            <input name="contactName" type="text" placeholder="Navn" value="<?= @$POST['contactName'] ?>">
            <?= @$error['contactName'] ?>
            <input name="contactEmail" type="email" placeholder="Email" value="<?= @$POST['contactEmail'] ?>">
            <?= @$error['contactEmail'] ?>
            <input name="contactPhone" type="tel" placeholder="Telefonnummer (valgfrit)" value="<?= @$POST['contactPhone'] ?>">
            <?= @$error['contactPhone'] ?>
            <textarea name="contactMsg" rows="10" placeholder="Besked"><?= @$POST['contactmsg'] ?></textarea>
            <?= @$error['contactMsg'] ?>
            <input type="submit" name="contactSubmit" value="Send besked">
        </form>
    </div>
</div>

        <div class="google-map" id="map">
        </div>

        <script>
      function initMap() {
        var uluru = {lat: 56.166812, lng: 10.227136};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhASwLPHfQ1X1N7o2OY5tB_SiDRNs1Ve0&callback=initMap">
    </script>




