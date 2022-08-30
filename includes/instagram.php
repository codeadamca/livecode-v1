<?php

/*
$url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=1695718850.628b812.0263a51d24934015b7bde61e46bacd17';

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$data = curl_exec($ch); 
curl_close($ch); 

$data = json_decode( $data, true );

echo '<ul class="instagram">';

for($i = 0; $i < 9; $i ++) {
  
  echo '<li>';
  echo '<a href="'.$data['data'][$i]['link'].'">';
  echo '<img src="'.$data['data'][$i]['images']['low_resolution']['url'].'" alt="">';
  echo '</a>';
  echo '</li>';
  
}

echo '</ul>';

*/

/*
echo '<pre>';
print_r( $data );
echo '</pre>';
*/

?>

<!--
<div class="center">
  <a href="https://www.instagram.com/codeadamca/"><img src="/images/social/logo-instagram.jpg" alt=""></a>
</div>
-->