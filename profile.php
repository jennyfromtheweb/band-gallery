<?php
$id = $_GET['id'];
// $base_url = "http://jennysmusicgallery.herokuapp.com/";
$base_url = "";
include("bands.php");
if ($id >= count($bands)) {
  header('Location: ' . $base_url . 'notfound');
}
?>

<!DOCTYPE html>
<html>

<?php 
  include("functions.php");
  $band = $bands[$id];
  $artist_id = getArtistId($band);
  $json_file = decodeJSON($artist_id); 
  $favicon = getArtistFavicon($json_file);
?>

<head>
  <meta charset="UTF-8">
  <title><?php echo $band . " // Jenny's Music Gallery"; ?></title>
  <link rel="stylesheet" href="<?php echo $base_url; ?>style.css" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,100italic,300italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <script src="<?php echo $base_url; ?>audiojs/audio.min.js" type="text/javascript"></script>
  <link rel="icon" 
      type="image/jpg" 
      href="<?php echo $favicon; ?>">
</head>
<body>

<script type="text/javascript">
  audiojs.events.ready(function() {
    var as = audiojs.createAll();
  });
</script>

<div class="nav">
  <div class="home">
    <a href="/home" title="making my way downtown, walking fast, faces pass, and I'm home bound"></a>
  </div>

  <div class="random">
    <?php $random = array_rand($bands); ?>
    <a href="<?php echo $random; ?>" title="hit me baby one more time"></a>
  </div>
</div>

<div class="header">
<br>
  <h1 class="band"><?php
    $fullName = getArtistFullName($json_file);
    echo $fullName; ?>
  </h1>
</div>

<div class="container">
  <?php
    $albums = findAlbums($band);
    foreach($albums as $name => $info) { ?>                
      <div class="album">
        <img src="<?php echo getAlbumCover($info); ?>">
        <div class="description">
          <div class="overlay"></div>
          <div class="text">
            <p><?php echo $name; ?></p>
            <p>(<?php echo getYearRecorded($info); ?>)</p>
            <?php $track_list = getTrackList($info); 
              $track_num = 1;
              foreach ($track_list as $song) {
                echo "<p>" . $track_num . ". " . $song["name"] . "</p>";
                $track_num += 1;
              } ?>

          
        <?php 
          $track = getRandomTrack($info);
          $preview = getTrackPreview($track);
        ?>
        </div>
        </div>
        <div class="audio">
          <audio src="<?php echo $preview; ?>" preload="none" />
        </div>
        <div class="spotify-url"><a href="<?php echo getTrackURL($track); ?>" target="_blank"></a></div>
      </div>
  <?php } ?>
  <br class="clear">
  </div>

<?php include("footer.php"); ?>

</body>
</html>