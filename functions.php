<?php
    $band = $_GET["band"];

    function findAlbums($band) {
      $id = getArtistId($band);

      $albums_info = file_get_contents("https://api.spotify.com/v1/artists/" . $id . "/albums?market=US&album_type=album,single");
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

      if (strpos($url, "ó") !== FALSE){
        $url = str_replace("ó", "o", $url);
      }

      $json = file_get_contents($url);
      $results = json_decode($json, true);
      $top = $results["artists"]["items"][0];
      return $top["id"];
    }

    function getArtistURL($id) {
      $url = file_get_contents("https://api.spotify.com/v1/artists/" . $id);
      $result = json_decode($url, true);
      return $result["external_urls"]["spotify"];
    }

    function getArtistFullName($id) {
      $url = file_get_contents("https://api.spotify.com/v1/artists/" . $id);
      $result = json_decode($url, true);
      $name = $result["name"];
      return $name; 
    }

    function getArtistImage($id) {
      $url = file_get_contents("https://api.spotify.com/v1/artists/" . $id);
      $result = json_decode($url, true);
      $img = $result["images"][0]["url"];
      return $img; 
    }

    function getRandomTrackPreview($info) {
      $tracks = $info["tracks"]["items"];
      $num_songs = count($tracks);
      $random_track = $tracks[rand(0, $num_songs - 1)];
      return $random_track["preview_url"];
    }

    function getAlbumCover($info) {
      return $info["images"][1]["url"];
    }

    function getYearRecorded($info) {
      $date = $info["release_date"];
      $fragments = explode("-", $date);
      return $fragments[0];
    }

    function displayTrackList($info) {
      $track_list = array();
      $track_num = 1;
      $tracks = $info["tracks"]["items"];
      foreach ($tracks as $song) {
        echo $track_num . ". " . $song["name"];
        if ($track_num < count($tracks)) {
          echo "  //  ";
        }
        $track_num += 1;
      }

      /* USING COLUMNS */
      // echo '<div class="columns">';
      // if (count($tracks) < 7) {
      //   echo '<ol>';
      //   foreach ($tracks as $song) {        
      //     echo "<li>" . $song["name"] . "<br>" . "</li>";
      //     $track_num += 1;
      //   }
      //   echo '</ol>';
      // } else {
      //   echo '<ol>';
      //   echo '<div id="column1">';
      //   foreach ($tracks as $song) {        
      //     if ($track_num == 7) {
      //       echo '</div>';
      //       echo '<div id="column2">';
      //     }
      //     echo "<li>" . $song["name"] . "<br>" . "</li>";
      //     $track_num += 1;
      //   }
      //   echo '</div></ol>';
      // }
      // echo '</div>';
    }

?>