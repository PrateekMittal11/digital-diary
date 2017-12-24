<html>
  <head>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel = "stylesheet", href = "diary_main.css">
  </head>
  <body>
    <div id = "body">
      <?php
      $servername = "localhost";
      $username = "prateek";
      $password = "qazwsxedc";
      $database = "diary";
      // Create connection
      $conn = new mysqli($servername, $username, $password, $database);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT id, title, note, tarikh, samay FROM diary_entries ORDER BY id DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          $i = 0;
          $out = array();
          $det = array();
          $not = array();
          while($row = $result->fetch_assoc()) {
              $out[$i] = $row["id"].". ".$row["title"];
              $not[$i] = mysqli_real_escape_string($conn, $row["note"]);
              $det[$i] = $row["tarikh"]." ".$row["samay"];
              $i = $i+1;
          }
      } else {
          echo "0 results";
      }
      $conn->close();
      $count = count($out);
      ?>
      <script>
        var disp = <?php echo '["' . implode('", "', $out) . '"]' ?>;
        var det = <?php echo '["' . implode('", "', $det) . '"]' ?>;
        var note = <?php echo '["' . implode('", "', $not) . '"]' ?>;
        var i, box = [], text = [], dbox = [], dtext = [], nbox = [], ntext = [];
        for(i = 0; i < disp.length; i++){
          box[i] = document.createElement("div");
          text[i] = document.createTextNode(disp[i]);
          dbox[i] = document.createElement("div");
          dtext[i] = document.createTextNode(det[i]);
          box[i].appendChild(text[i]);
          dbox[i].appendChild(dtext[i]);
          box[i].appendChild(dbox[i]);

          nbox[i] = document.createElement("div");
          ntext[i] = document.createTextNode(note[i]);
          nbox[i].appendChild(ntext[i]);

          var b = document.getElementById("body");
          b.appendChild(box[i]);
          b.appendChild(nbox[i]);

          dbox[i].style.float = "right";
          box[i].style.fontFamily = "Maiandra GD";
          box[i].style.fontSize = "2vw";
          box[i].style.backgroundColor = "gray";
          box[i].style.width = "65vw";
          box[i].style.height = "2.5vw";
          box[i].style.padding = "0.2vw";
          box[i].style.borderRadius = "0.7vw 0.7vw 0vw 0vw";
          nbox[i].style.fontFamily = "Maiandra GD";
          nbox[i].style.fontSize = "1.6vw";
          nbox[i].style.width = "65vw";
        }
        var close = document.getElementsByClassName("close");
        var j;
        for (j = 0; j < close.length; j++) {
          close[j].onclick = function() {
            var div = this.parentElement;
            div.style.display = "none";
          }
        }
      </script>
    </div>
    <div id = "forms">
      <p style = "font-family: Maiandra GD; font-size: 2vw; text-align: center">INSERT A NOTE</p>
      <form method = "post", action = "wayin.php", id = "ins_form">
        <input type = "text", placeholder = "Title" name = "name", id = "name"><br/>
        <textarea name = "note", id = "note"></textarea><br/>
        <input type = "submit",  value = "Save", class = "btn">
      </form>
      <p style = "font-family: Maiandra GD; font-size: 2vw; text-align: center">DELETE A NOTE</p>
      <form action = "wayout.php" method = "POST" id = "del_form">
        <input type = "text" name = "id" placeholder = "enter serial no." id = "dele"><br>
        <input type = "submit" value = "delete", class = "btn">
      </form>
    </div>
    <?php
      $dom = new DOMDocument;
      $some = $dom->getElementById('dele');

      echo $some;
    ?>
  </body>
</html>
