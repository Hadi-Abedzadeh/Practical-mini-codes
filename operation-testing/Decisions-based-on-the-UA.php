<?php
  $ua         = $_SERVER["HTTP_USER_AGENT"];
  $android    = strpos($ua, 'Android') ? true : false;
  $blackberry = strpos($ua, 'BlackBerry') ? true : false;
  $iphone     = strpos($ua, 'iPhone') ? true : false;
  $palm       = strpos($ua, 'Palm') ? true : false;
      if ($android || $blackberry || $iphone || $palm) {
        header("Location: http://mobile.com/");
      }
      if (strpos($ua, "Windows")) {
        header("Location: http://microsoft.com");
      }

?>