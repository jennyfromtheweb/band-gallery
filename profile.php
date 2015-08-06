<!DOCTYPE html>
<html>
<?php 
  include("bands.php");
  include("functions.php");
  $id = $_GET['id'];
  $band = $bands[$id];
  $artist_id = getArtistId($band);
  $favicon = getArtistFavicon($artist_id);
?>

<head>
  <meta charset="UTF-8">
  <title><?php echo "// ". $band . " //"; ?></title>
  <link rel="stylesheet" href="style.css" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,100italic,300italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
  <script src="audiojs/audio.min.js" type="text/javascript"></script>
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
    <a href="index.php" title="'cause I'm gonna make this place your home"></a>
  </div>

  <div class="random">
    <?php $random = array_rand($bands); ?>
    <a href="profile.php?id=<?php echo $random; ?>" title="hit me baby one more time"></a>
  </div>

  <div class="follow">
    <a href="<?php echo getArtistURL($artist_id); ?>" class="follow"></a>
  </div>
</div>

<div class="header">
<br><br>
  <h1><?php
    $fullName = getArtistFullName($artist_id);
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
          <h2><?php echo $name; ?></h2>
          <h4>(<?php echo getYearRecorded($info); ?>)</h4>
          <p>
            <?php displayTrackList($info); ?>
          </p>
        </div>
        <div class="audio">
          <audio src="<?php echo getRandomTrackPreview($info); ?>" preload="auto" />
          <!-- <audio controls id="album-audio" preload="auto">
            <source src="<?php echo getRandomTrackPreview($info); ?>" type="audio/mpeg">
            Oops, your browser isn't compatible with the audio player.
          </audio> -->
        </div>
      </div>
  <?php } ?>
  <br class="clear"><br><br><br>
</div>

<?php include("footer.php"); ?>

</body>
</html>