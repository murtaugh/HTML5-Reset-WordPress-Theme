<?php

  class googleMapsGeocodeAPI
  {
    /**
     * The Google Maps Geocode API V3 Helper
     */

    /**
     * Reads an URL to a string
     * @param string $url The URL to read from
     * @return string The URL content
     */
    private function getURL($url){
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      // curl_setopt($ch, CURLOPT_HEADER, 0);
      // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      $html = curl_exec($ch);
      curl_close($ch);

      return ($html != false) ? $html : false;
    }

    /**
     * Get Latitude/Longitude/Altitude based on an address
     * @param string $address The address for converting into coordinates
     * @return array An array containing Latitude/Longitude/Altitude data
     */
    public function getCoordinates($address){
      $url  = 'http://maps.googleapis.com/maps/api/geocode/xml?address='.str_replace(' ', '+', $address).'&sensor=false';
      $data = $this->getURL($url);

      if ($data){
        $xml = new SimpleXMLElement($data);

        if ($xml->status == 'OK') {
          $lat = (string) $xml->result->geometry->location->lat;
          $lng = (string) $xml->result->geometry->location->lng;
          return array('lat' => $lat, 'lng' => $lng);
        }
      }

      // default data
      return array('lat' => 0, 'lng' => 0);
    }

  };

?>
