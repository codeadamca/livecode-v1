<?php

include('connect.php');

function articles($type, $twitter = true, $instagram = true)
{
  
  global $connect;
  
  $query = 'SELECT *
    FROM articles 
    WHERE '.($type == 'Home' ? 'home = "Yes"' : 'type = "'.$type.'"').'
    ORDER BY date DESC';
  $result = mysqli_query($connect, $query);
  
  while($record = mysqli_fetch_assoc($result))
  {
    
    echo '<h2 class="center"><a name="article'.$record['id'].'">'.$record['title'].'</a></h2>';
    
    if($record['photo'])
    {
      if($record['url']) echo '<a href="'.$record['url'].'">';
      echo '<img src="'.$record['photo'].'" alt="">';
      if($record['url']) echo '</a>';
    }

    if($instagram) articles_instagram($record['instagramId']);
    if($twitter) articles_twitter($record['twitterId']);
    
    echo $record['content'];

    echo '<p>
        <small>
          Resources: ';
    
    articles_resources($record['resources']);
    
    echo '<br>
          Date: '.date('M j, Y',strtotime($record['date'])).'
        </small>
      </p>';
                       
    echo '<hr>';
    
  }
  
}

function articles_resources($resources)
{
  
  $resources = explode(chr(13), $resources);
  
  foreach($resources as $key => $value)
  {
    $resource = explode(',', $value);
    echo '<a href="'.$resource[1].'">'.$resource[0].'</a>';
    if(count($resources) -1 > $key) echo ' | ';
  }
  
}

function articles_instagram($id)
{
  
  if($id)
  {

    echo '<blockquote 
      class="instagram-media" 
      data-instgrm-permalink="https://www.instagram.com/p/'.$id.'/" 
      data-instgrm-version="8" 
      style="background:#FFF; 
        border:0; 
        border-radius:3px; 
        box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); 
        margin: 1px; 
        max-width:658px; 
        padding:0; 
        width:99.375%; 
        width:-webkit-calc(100% - 2px); 
        width:calc(100% - 2px);"></blockquote>';
    
  }
    
}

function articles_twitter($id)
{
  
  if($id)
  {

    $handle = curl_init();
 
    $url = 'https://publish.twitter.com/oembed?url='.urlencode('https://twitter.com/codeadamca/status/'.$id).'&align=center'; 

    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  
    $output = curl_exec($handle);
 
    curl_close($handle);
 
    if($output)
    {
      $output = json_decode($output,true);  
      if(count($output) and isset($output['html']))
      {
        echo $output['html'];
      }
    }
    
  }
  
}

$logos = array(
    'apache' => array( 'name' => 'Apache', 'logo' => '/images/logos/logo-apache.png', 'url' => 'https://httpd.apache.org/' ),
    'arduino' => array( 'name' => 'Arduino', 'logo' => '/images/logos/logo-arduino.png', 'url' => 'https://www.arduino.cc/' ),
    'brackets' => array( 'name' => 'Brackets', 'logo' => '/images/logos/logo-brackets.png', 'url' => 'http://brackets.io/' ),
    'brevisrefero' => array( 'name' => 'BrevisRefero', 'logo' => '/images/logos/logo-brevisrefero.png', 'url' => 'https://www.brevisrefero.com/' ),
    'c' => array( 'name' => 'c#', 'logo' => '/images/logos/logo-c.png', 'url' => 'https://docs.microsoft.com/en-us/dotnet/csharp/' ),
    'codeanywhere' => array( 'name' => 'Codeanywhere', 'logo' => '/images/logos/logo-codeanywhere.png', 'url' => 'https://codeanywhere.com/' ),
    'composer' => array( 'name' => 'Composer', 'logo' => '/images/logos/logo-composer.png', 'url' => 'https://getcomposer.org/' ),
    'cpanel' => array( 'name' => 'cPanel', 'logo' => '/images/logos/logo-cpanel.png', 'url' => 'https://www.cpanel.net/' ),
    'css' => array( 'name' => 'CSS', 'logo' => '/images/logos/logo-css.png', 'url' => 'https://www.w3.org/Style/CSS/' ),
    'd3js' => array( 'name' => 'd3.js', 'logo' => '/images/logos/logo-d3.png', 'url' => 'https://d3js.org/' ),
    'filezilla' => array( 'name' => 'Filezilla', 'logo' => '/images/logos/logo-filezilla.png', 'url' => 'https://filezilla-project.org/' ),
    'firebase' => array( 'name' => 'Firebase', 'logo' => '/images/logos/logo-firebase.png', 'url' => 'https://firebase.google.com/' ),
    'gcp' => array( 'name' => 'Google Cloud Platform', 'logo' => '/images/logos/logo-gcp.png', 'url' => 'https://cloud.google.com/' ),
    'git' => array( 'name' => 'Git', 'logo' => '/images/logos/logo-git.png', 'url' => 'https://git-scm.com/' ),
    'github' => array( 'name' => 'GitHub', 'logo' => '/images/logos/logo-github.png', 'url' => 'https://github.com/' ),
    'godaddy' => array( 'name' => 'GoDaddy', 'logo' => '/images/logos/logo-godaddy.png', 'url' => 'https://ca.godaddy.com/' ),
    'cloud' => array( 'name' => 'Google Cloud', 'logo' => '/images/logos/logo-google-cloud.png', 'url' => 'https://cloud.google.com/' ),
    'heroku' => array( 'name' => 'Heroku', 'logo' => '/images/logos/logo-heroku.png', 'url' => 'https://www.heroku.com/' ),
    'hostpapa' => array( 'name' => 'HostPapa', 'logo' => '/images/logos/logo-hostpapa.png', 'url' => 'https://www.hostpapa.ca/' ),
    'html' => array( 'name' => 'HTML', 'logo' => '/images/logos/logo-html.png', 'url' => 'https://www.w3.org/html/' ),
    'humber' => array( 'name' => 'Humber College', 'logo' => '/images/logos/logo-humber.png', 'url' => 'https://humber.ca/' ),
    'javascript' => array( 'name' => 'JavaScript', 'logo' => '/images/logos/logo-javascript.png', 'url' => 'https://www.w3.org/standards/webdesign/script' ),
    'jquery' => array( 'name' => 'jQuery', 'logo' => '/images/logos/logo-jquery.png', 'url' => 'https://jquery.com/' ),
    'json' => array( 'name' => 'JSON', 'logo' => '/images/logos/logo-json.png', 'url' => 'https://www.json.org/' ),
    'less' => array( 'name' => 'Less CSS', 'logo' => '/images/logos/logo-less.png', 'url' => 'http://lesscss.org/' ),
    'mamp' => array( 'name' => 'MAMP', 'logo' => '/images/logos/logo-mamp.png', 'url' => 'https://www.mamp.info/' ),
    'mongo' => array( 'name' => 'MongoDB', 'logo' => '/images/logos/logo-mongo.png', 'url' => 'https://www.mongodb.com/' ),
    'mysql' => array( 'name' => 'MySQL', 'logo' => '/images/logos/logo-mysql.png', 'url' => 'https://www.mysql.com/' ),
    'nginx' => array( 'name' => 'Nginx', 'logo' => '/images/logos/logo-nginx.png', 'url' => 'https://www.nginx.com/' ),
    'nodejs' => array( 'name' => 'Node.js', 'logo' => '/images/logos/logo-nodejs.png', 'url' => 'https://nodejs.org/' ),
    'npm' => array( 'name' => 'NPM', 'logo' => '/images/logos/logo-npm.png', 'url' => 'https://www.npmjs.com/' ),
    'obs' => array( 'name' => 'OBS', 'logo' => '/images/logos/logo-obs.png', 'url' => 'https://obsproject.com/' ),  
    'php' => array( 'name' => 'PHP', 'logo' => '/images/logos/logo-php.png', 'url' => 'https://www.php.net/' ),
    'phpmyadmin' => array( 'name' => 'PHPMyAdmin', 'logo' => '/images/logos/logo-phpmyadmin.png', 'url' => 'https://www.phpmyadmin.net/' ),
    'pinterest' => array( 'name' => 'Pinterest', 'logo' => '/images/logos/logo-pinterest.png', 'url' => 'https://www.pinterest.ca/' ),
    'pm2' => array( 'name' => 'PM2', 'logo' => '/images/logos/logo-pm2.png', 'url' => 'https://pm2.keymetrics.io/' ),
    'pug' => array( 'name' => 'Pug', 'logo' => '/images/logos/logo-pug.png', 'url' => 'https://pugjs.org/' ),
    'python' => array( 'name' => 'Python', 'logo' => '/images/logos/logo-python.png', 'url' => 'https://www.python.org/' ),
    'raspberrypi' => array( 'name' => 'Raspberry Pi', 'logo' => '/images/logos/logo-raspberry-pi.png', 'url' => 'https://www.raspberrypi.org/' ),
    'react' => array( 'name' => 'React', 'logo' => '/images/logos/logo-react.png', 'url' => 'https://reactjs.org/' ),
    'rht' => array( 'name' => 'Robin Hood Technology Inc.', 'logo' => '/images/logos/logo-rht.png', 'url' => 'http://www.robinhoodtech.com/' ),
    'royalroads' => array( 'name' => 'Royal Roads University', 'logo' => '/images/logos/logo-royal-roads.png', 'url' => 'https://www.royalroads.ca/' ),
    'sass' => array( 'name' => 'Sass', 'logo' => '/images/logos/logo-sass.png', 'url' => 'https://sass-lang.com/' ),
    'socket' => array( 'name' => 'Socket.io', 'logo' => '/images/logos/logo-socket.png', 'url' => 'https://socket.io/' ),
    'scratch' => array( 'name' => 'Scratch', 'logo' => '/images/logos/logo-scratch.png', 'url' => 'https://scratch.mit.edu/' ),
    'threejs' => array( 'name' => 'three.js', 'logo' => '/images/logos/logo-three.png', 'url' => 'https://threejs.org/' ),
    'twitch' => array( 'name' => 'Twitch', 'logo' => '/images/logos/logo-twitch.png', 'url' => 'https://www.twitch.tv/' ),
    'ubuntu' => array( 'name' => 'Ubuntu', 'logo' => '/images/logos/logo-ubuntu.png', 'url' => 'https://ubuntu.com/' ),
    'visualstudiocode' => array( 'name' => 'Visual Studio Code', 'logo' => '/images/logos/logo-visual-studio-code.png', 'url' => 'https://code.visualstudio.com/' ),
    'vuejs' => array( 'name' => 'Vue.js', 'logo' => '/images/logos/logo-vue.png', 'url' => 'https://vuejs.org/' ),
    'wamp' => array( 'name' => 'WAMP', 'logo' => '/images/logos/logo-wamp.png', 'url' => 'http://wampserver.aviatechno.net/' ),
    'webmin' => array( 'name' => 'Webmin', 'logo' => '/images/logos/logo-webmin.png', 'url' => 'http://www.webmin.com/' ),
    'wordpress' => array( 'name' => 'WordPress', 'logo' => '/images/logos/logo-wordpress.png', 'url' => 'https://wordpress.com/' ),
    'xamp' => array( 'name' => 'XAMP', 'logo' => '/images/logos/logo-xamp.png', 'url' => 'https://www.apachefriends.org/index.html' ),
    'youtube' => array( 'name' => 'XAMP', 'logo' => '/images/logos/logo-youtube.png', 'url' => 'https://www.youtube.com/' )
  );

/*
foreach($logos as $key => $value)
{
  
  $query = 'INSERT INTO learningTopic(
      tag,
      name,
      url,
      image
    ) VALUES (
      "'.$key.'",
      "'.$value['name'].'",
      "'.$value['url'].'",
      "'.str_replace('/images/logos/', '', $value['logo']).'"
    )';
  mysqli_query($connect, $query);
  
}
*/


function logos_with_links()
{
  
  global $logos;
 
  $list = func_get_args();
  
  echo '<div class="grid">';
  
  foreach( $list as $key => $value )
  {
    echo '<a href="'.$logos[$value]['url'].'"><img src="'.$logos[$value]['logo'].'"></a>';
  }
  
  echo '</div>';
  
}

function logos_with_anchors() 
{
  
  global $logos;
 
  $list = func_get_args();
  
  echo '<div class="grid">';
  
  foreach( $list as $key => $value )
  {
    echo '<a href="#'.$value.'"><img src="'.$logos[$value]['logo'].'"></a>';
  }
  
  echo '</div>';
  
}

function logos_as_anchors() 
{
  
  global $logos;
 
  $list = func_get_args();
  
  echo '<div class="grid">';
  
  foreach( $list as $key => $value )
  {
    echo '<a name="'.$value.'"><img src="'.$logos[$value]['logo'].'"></a>';
  }
  
  echo '</div>';
  
}

function logos_only()
{
  
  global $logos;
 
  $list = func_get_args();
  
  echo '<div class="grid">';
  
  foreach( $list as $key => $value )
  {
    echo '<img src="'.$logos[$value]['logo'].'">';
  }
  
  echo '</div>';
  
}

function link_plain( $item )
{
  
  global $logos;
 
  echo '<a href="'.$logos[$item]['url'].'">'.$logos[$item]['name'].'</a>';
  
}