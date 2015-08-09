<?php 
  $base_url = "http://jennysmusicgallery.herokuapp.com/";
  include("bands.php");
  include("functions.php");
  $id = $_GET['id'];
  if ($id > count($bands)) {
    header("Location: http://" . echo $base_url . ".com/notfound");
    die();
  }
  $band = $bands[$id];
  $artist_id = getArtistId($band);
  $json_file = decodeJSON($artist_id); 
  $favicon = getArtistFavicon($json_file);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $band . " // Jenny's Music Gallery"; ?></title>
  <link rel="stylesheet" href="<?php echo $base_url; ?>style.css" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,100italic,300italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,700' rel='stylesheet' type='text/css'>
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
            <h2><?php echo $name; ?></h2>
            <h4>(<?php echo getYearRecorded($info); ?>)</h4>
            <p>
              <?php displayTrackList($info); ?>
            </p>
          </div>
        </div>
        <?php 
          $track = getRandomTrack($info);
          $preview = getTrackPreview($track);
        ?>
        <div class="audio">
          <audio src="<?php echo $preview; ?>" preload="none" />
        </div>
        <div class="spotify-url"><a href="<?php echo getTrackURL($track); ?>" target="_blank"></a></div>
      </div>
  <?php } ?>
  <br class="clear"><br><br><br>
</div>

<?php include("footer.php"); ?>

</body>
</html>