<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Jenny's Music Gallery</title>
  <link rel="stylesheet" href="style.css" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,100italic,300italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
</head>
<body>

 <?php 
  include("bands.php");
  include("functions.php");
 ?>

<script type = "text/javascript">
  function showDiv() {
    var e = document.getElementById("hide-show");
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
  }
</script>

<div class="header">
  <h1>Ready to discover new music?</h1>
  <span>I'm finding new songs to love all the time.<br>
  Preview albums from my favorite bands and artists here.</span>
</div>


  
<div class="container main">
    <?php 
      sort($bands);

      $random = array_rand($bands);
    ?>

    <a class="button btn paper paper-raise-flatten" href="profile.php?band=<?php echo $bands[$random]; ?>">surprise me!</a>
    <br class="clear">
    <!-- <a class="button" onclick="showDiv()">click for full list</a> -->
    <div id="hide-show"  style="display:block;" class="all-bands">
      <?php 
        foreach($bands as $band) {
          $link = $band;
          if (strpos($link, "&") !== FALSE){
            $link = str_replace("&", "%26", $link);
          }
          ?>
          <span><a href="profile.php?band=<?php echo $link; ?>" class="band"><?php echo $band; ?></a></span><br>
      <?php } ?>
    </div>
</div>

<br class="clear"><br><br>
<?php include("footer.php"); ?>

</body>
</html>
