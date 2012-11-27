<?php
	require_once("fb-php-sdk/facebook.php");
	session_start();	
  $config = array();
  $config['appId'] = '117535755037825';
  $config['secret'] = '7a71c2c31cbc6a81ffc8fa17717dd603';

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();


?>
<html>
<head>
<title><?php echo $title ?> - A Geek's facebook </title>
</head>
<body>

<?php
if(!$user_id)
{
   $login_url = $facebook->getLoginUrl();
      echo 'Please <a href="' . $login_url . '">login.</a>';
}
else
{?>
	<h1> Welcome User <?php echo $user_id ?>! </h1>
<?php }
?>
