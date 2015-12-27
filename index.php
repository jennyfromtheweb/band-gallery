<!DOCTYPE html>
<html>
<?php 
  // $base_url = "http://jennysmusicgallery.herokuapp.com/";
$base_url = "";
?>
<head>
  <meta charset="UTF-8">
  <title>Jenny's Music Gallery</title>
  <link rel="stylesheet" href="<?php echo $base_url; ?>style.css" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,100italic,300italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
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

    <a class="button btn hvr-underline-from-center" href="<?php echo $random; ?>" >surprise me!</a>
    <br class="clear">
    <div id="hide-show"  style="display:block;" class="all-bands">
      <?php 
        foreach($bands as $id => $band) { ?>
          <span><a href="<?php echo $id; ?>" class="band"><?php echo $band; ?></a></span><br>
      <?php } ?>
    </div>
</div>

<br class="clear"><br><br>
<?php include("footer.php"); ?>

</body>
</html>
