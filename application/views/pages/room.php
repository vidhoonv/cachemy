<html>
<head>
<title>ROOM</title>
</head>
<body>
in room page
<?php
session_start();
  require_once("fb-php-sdk/facebook.php");
	$config = array();
	$config['appId'] = '117535755037825';
	$config['secret'] = '7a71c2c31cbc6a81ffc8fa17717dd603';
	$config['my_url'] = 'http://localhost/fql-cig-test/index.php/room/'; 	    
	$code = $_REQUEST['code'];

   if($_REQUEST['state'] == $_SESSION['state']) {
	echo "here";
     $token_url = "https://graph.facebook.com/oauth/access_token?". "client_id=" . $config['appId'] . "&redirect_uri=" . urlencode($config['my_url']) . "&client_secret=" . $config['secret'] . "&code=" . $code;

     $response = @file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);

     $graph_url = "https://graph.facebook.com/me?access_token=" . $params['access_token'];

     $user = json_decode(file_get_contents($graph_url));
     echo("Hello " . $user->id . "Your token expires in " .$params['expires'] . " seconds" );
   }
   else {
     echo("The state does not match. You may be a victim of CSRF.");
   }

   
	


?>
<p>hello world!</p>
<p>

<?php
  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();


try {
	$user_id = $facebook->getUser();
        $fql = 'SELECT post_id, viewer_id, app_id, actor_id, target_id, app_data, source_id, attachment,attribution,description, description_tags, message,message_tags, type FROM stream WHERE filter_key = "nf" and attribution="" LIMIT 50';// . $user_id;
//	$fql = 'SELECT filter_key, name  FROM stream_filter WHERE uid=me()';
        $ret_obj = $facebook->api(array( 
                                   'method' => 'fql.query',
                                   'query' => $fql,
                                 ));
/*	foreach($ret_obj as $fil)
	{
		echo '<pre>filter name: ' . $fil['name'] . '</pre>';
		echo '<pre>filter key: ' . $fil['filter_key'] . '</pre>';
	}
*/
	foreach($ret_obj as $news_item)
	{
		 echo '<pre>test: ' . $news_item['attachment']['media'][0]['href'] . '</pre>';
		foreach($news_item as $index => $element)
		{
			if(gettype($element) == "array")
			{	
				if(empty($element))
				{
					echo $index . 'is empty<br/>';
				}
				else
				{
					echo $index . 'is not empty<br/>';
				}
				echo $index . ' =>' . $element . "<br/>";
				foreach($element as $key => $values)
				{
			
			
					if(gettype($values) == "array")
					{
						echo $key . ' =>' . $values . "<br/>";
						foreach($values as $k1 => $v1)
						{
							echo $key. '=>' .$k1 . ' =>=>' . $v1 . "<br/>";
							if(gettype($v1) == "array")
							{
								foreach($v1 as $k2 => $v2)
								{
									echo $key . '=>' .$k1 .' =>=> '. $k2 . ' =>=>=>' . $v2 . "<br/>";
									if(gettype($v2) == "array")
									{
										foreach($v2 as $k3 => $v3)
										{
											echo $key . '=>' .$k1 .' => '. $k2 .' =>=> '.$k3 . ' =>=>=>' . $v3 . "<br/>";
										}
									}
								}
							}
						}
					}
					else
					{
						echo $key . ' =>' . $values . "<br/>";
					}
				}	
			}
			else
			{
				echo '<pre>'.$index.': '. $element .' </pre>';
			}
		}
		/*
        	echo '<pre>post id: ' . $news_item['post_id'] . '</pre>';
		echo '<pre>message: ' . $news_item['message'] . '</pre>';
		echo '<pre>posted via: ' . $news_item['attribution'] . '</pre>';
		echo '<pre>desc: ' . $news_item['description'] . '</pre>';
		
		$attach=$news_item['attachment'];
		
		if($attach == NULL)
			echo '<pre>attachment:  nil </pre>';
		else
		{
		echo '<pre>attachment:  exists   </pre>';
		foreach($attach as $key => $values)
		{
			
			
			if(gettype($values) == "array")
			{
				//echo $values;
			foreach($values as $k1 => $v1)
			{
				echo $k1 . ' =>' . $v1 . "<br/>";
				if(gettype($v1) == "array")
				{
				foreach($v1 as $k2 => $v2)
				{
					echo $v1 .' => '. $k2 . ' =>=>' . $v2 . "<br/>";
					if(gettype($v2) == "array")
					{
						foreach($v2 as $k3 => $v3)
						{
							echo $v1 .' => '. $v2 .' =>=> '.$k3 . ' =>=>=>' . $v3 . "<br/>";
						}
					}
				}
				}
			}
			}
			else
			{
				echo $key . ' =>' . $values . "<br/>";
			}
		}

		//echo '<pre>type: ' . $news_item['type'] . '</pre>';
		*/
			echo '+================================end of post +=============================+';
		
	
	}
      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }
 
?>
</p>
</body>
</html>
