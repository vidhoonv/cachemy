<?php
session_start();
require_once("fb-php-sdk/facebook.php");
?>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<title>
CacheMy - Login
</title>
</head>
<body>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '117535755037825', // App ID
      channelUrl : 'http://localhost/fql-cig-test/index.php/channel/', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true,  // parse XFBML
      oauth		  : true
    });

    // Additional initialization code here
  
 
    	FB.Event.subscribe('auth.statusChange', function () {
          window.location = "http://localhost/cachemy/index.php/home";
      });
  };


  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>
<div align="center">
<img style="vertical-align:middle" src="<?php echo base_url("/images/cachemy_logo.png"); ?>" >
<img style="vertical-align:middle" src="<?php echo base_url("/images/cachemy_title.gif"); ?>" >
<p>  A new way to organize social content</p>

<p>

<fb:login-button size="large" show-faces="true" width="200" max-rows="5" scope="read_stream">Login with Facebook</fb:login-button>


</p>
</div>
</body>
</html>
