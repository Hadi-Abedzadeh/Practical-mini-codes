<!--
   _____            _       _            _____          _      
  / ____|          | |     | |          / ____|        | |     
 | |     __ _ _ __ | |_ ___| |__   __ _| |     ___   __| | ___ 
 | |    / _` | '_ \| __/ __| '_ \ / _` | |    / _ \ / _` |/ _ \
 | |___| (_| | |_) | || (__| | | | (_| | |___| (_) | (_| |  __/
  \_____\__,_| .__/ \__\___|_| |_|\__,_|\_____\___/ \__,_|\___|
             | |     Hadi Abedzadeh                            
             |_|                                               
-->
<!doctype html>
<html>
<head>

  <style>
    #true {
      text-align: center;
      font-family: tahoma;
      background: #090;
      width: 200px;
      height: 30px;
    }
    #false {
      text-align: center;
      font-family: tahoma;
      background: #FFA8B0;
      width: 200px;
      height: 30px;
    }
  </style>

  <meta charset="utf-8">
  <title>CAPTCHA</title>
</head>
<body>
<?php
session_start();
if (isset($_POST["btn"])) {
  if (!empty($_POST["text"])) {
    if ($_POST["text"] == $_SESSION["captcha"]) {
      echo '<div id="true"> <font color="#00FF00" >True</font></div>';
    } else {
      echo '<div id="false"><font color="#FF0000">False</font></div>';
    }}
  }
?>
<br>
<img src="captcha.php">

  <form method="post">
    <input type="text" name="text" id="text">
    <input type="submit" name="btn" id="btn" value="Check">
  </form>
</body>
</html>