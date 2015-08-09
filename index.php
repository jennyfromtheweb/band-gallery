<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Jenny's Music Gallery</title>
  <link rel="stylesheet" href="style.css" type="text/css">
  <link rel="icon" 
      type="image/jpg" 
      href="img/favicon.png">
</head>
<body>

 <?php 
  include("bands.php");
  include("functions.php");
 ?>

<div class="header">
  <h1>Jenny's Music Gallery</h1>
  <span>Ready to discover new music?<br>
  Preview albums from bands and artists I love.</span>
</div>

  
<div class="container main">
    <?php $random = array_rand($bands); ?>

    <a class="button btn paper paper-raise-flatten" href="profile.php?id=<?php echo $random; ?>" >surprise me!</a>
    <br class="clear">
    <div id="hide-show"  style="display:block;" class="all-bands">
      <?php 
        foreach($bands as $id => $band) { ?>
          <span><a href="profile.php?id=<?php echo $id; ?>" class="band"><?php echo $band; ?></a></span><br>
      <?php } ?>
    </div>
</div>

<br class="clear"><br><br>
<?php include("footer.php"); ?>

</body>
</html>
