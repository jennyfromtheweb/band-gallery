<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Jenny's Favorite Bands</title>
  <link rel="stylesheet" href="style.css" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,100italic,300italic' rel='stylesheet' type='text/css'>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
</head>
<body>

   <?php 

    $bands = array(
        "Handsome Ghost",
        "Explosions in the Sky",
        "Hammock",
        "Coldplay",
        "OneRepublic",
        "The Fray",
        "The 1975",
        "Small Black",
        );


    function findAlbums($band) {
      $id = getArtistId($band);

      $albums_info = file_get_contents("https://api.spotify.com/v1/artists/" . $id . "/albums?market=US&album_type=album");
      $result = json_decode($albums_info, true);
      $albums = $result["items"];

      $all_albums = array();
      foreach($albums as $album) {
        $full_info_url = $album["href"];
        $full_info = json_decode(file_get_contents($full_info_url), true);
        $name = $full_info["name"];
        $all_albums[$name] = $full_info;
      }

      return $all_albums;
    }

    function getArtistId($band) {
      $url = "https://api.spotify.com/v1/search?type=artist&q=" . str_replace(' ', '+', $band);
      $json = file_get_contents($url);
      $results = json_decode($json, true);
      $top = $results["artists"]["items"][0];
      return $top["id"];
    }

    function getRandomTrackPreview($info) {
      $tracks = $info["tracks"]["items"];
      $num_songs = count($tracks);
      $random_track = $tracks[rand(0, $num_songs - 1)];
      return $random_track["preview_url"];
    }

    function getAlbumCover($info) {
      return $info["images"][0]["url"];
    }
      
      
   ?>

<div class="header">
  <h1>Jenny's Favorite Bands</h1>
  <p>A list of my favorite bands in no particular order.</p>
</div>

<script type = "text/javascript">
  window.onload = function(){
    $('.expand').nextUntil('tr.expand').hide();
    // var elements = document.getElementsByClassName("hide");
    // for(var i=0; i<elements.length; i++) {
    //     elements[i].style.display = "block";
    // }

    $('.expand').click(function(){
      $(this).nextUntil('tr.expand').slideToggle("slow", "swing"); // or just use "toggle()"
    });
      
  }
</script>
  
<table class="container">
    <?php 
      shuffle($bands);
      foreach($bands as $band) { ?>
        <tr class="expand"><th class="name"><p><?php echo $band; ?></p></th></tr>
        <td class="hide">
          <div class="description">
            <?php $albums = findAlbums($band); ?>
              <?php foreach($albums as $name => $info) { ?>                
                <div class="album-cover" style="background: url(<?php echo getAlbumCover($info); ?>)">
                <span><h3><?php echo $name; ?></h3></span>
                <audio controls id="album_audio">
                  <source src="<?php echo getRandomTrackPreview($info); ?>" type="audio/mpeg">
                  This audio is too hip for your browser.
                </audio>
                </div>
              <?php } ?>
            </div>
        </td>
    <?php } ?>
  </table>

</body>
</html>
