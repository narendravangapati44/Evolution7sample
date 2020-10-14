
<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://developers.zomato.com/api/v2.1/search?entity_id=259&count=20&lat=-37.815018&lon=144.946014"); //url with required parameters. entity_id is Melbourne's id
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


$headers = array(
  "Accept: application/json",
  "User-Key: 2cdb347fd991c83d30df2dcd23ebd41f" //user API key
  );
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$zomdata = json_decode($result);
$zomrestaurants = $zomdata->restaurants;
    if (count($zomrestaurants) == 0) {
      echo "<b>No results found for your search query</b>"; 
      exit();
    }
foreach ($zomrestaurants as $restaurant) { //FOREACH loop to echo results. 
  echo "<h3>".@$restaurant->restaurant->name."</h3>";
    if ($restaurant->restaurant->thumb != "") {
      echo "<img width='330' src='".@$restaurant->restaurant->thumb."' /><br/>";
    }
  

  echo @$restaurant->restaurant->location->address.", ".@$restaurant->restaurant->location->city;
  echo "<br/><hr>";
}
?>