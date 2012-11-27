<?php

session_start();
require_once("fb-php-sdk/facebook.php");
$config = array();
$config['appId'] = '117535755037825';
$config['secret'] = '7a71c2c31cbc6a81ffc8fa17717dd603';

$facebook = new Facebook($config);
$user = $facebook->getUser();

$fql = 'SELECT  name,pic_square,profile_url FROM user WHERE  uid=me()';

$ret_obj = $facebook->api(array( 'method' => 'fql.query','query' => $fql));	

if(!empty($ret_obj))
{
	$user_info = $ret_obj[0];
}
else
{
 echo("session lost");
}

?>
<html>
<head>
<title>
CacheMy ~ Home
</title>
<link rel="stylesheet" href="<?php echo base_url("/ccs/ui.css"); ?>" type="text/css" />
</head>

<body>
<div id="Navbar">
	<ul>
		<li><a href="<?php echo site_url("home"); ?>">Home</a>	
			
		</li>
		
		<li><a  href="">CacheBank</a>
			
		</li>
		<li><a  style="background-image: none;" href="">What's CacheMy</a>
			
			
		</li>
	</ul>	
</div>
<div id="page-wrapper">
<div id="user-pane">
		<h1 id="title"><?php echo($user_info['name']); ?></h1>
		<img src="<?php echo($user_info['pic_square']); ?>" title="Facebook profile link">
		<div id="intro">User stats are displayed here<br/>
			# of Caches<br/>
			# of Cached pages<br/>
			# of Trackers
		</div>
</div>

<div id="recents-pane">
		<h1 id="title">Recent activity</h1>
		<div id="intro">Recent actions are displayed here<br/>
			Recently Cached items<br/>
			Recently added to Cache page<br/>
			Recently tracked Cache pages <br/>
		</div>
</div>

<div id="main-pane">
		<h1 id="title">Cache Hits</h1>
		 <div id="feed">
		 

          <div id="feed_item">
            <img id="user_avatar" src="<?php echo($user_info['pic_square']); ?>">
            <div class="postmeta">
              <span id="time" title="5:06pm 06.06.2011">5 days</span>
            </div>
            <span id="name">Vera</span><span id="location">from Home</span>
            <p>
              Night time - sympathize - I've been working on white lies.
              So I'll tell the truth - I'll give it up to you.
              And when the day come, it will have all been fun. We'll talk about it soon.
            </p>
          </div>


          <div id="feed_item">
            <div class="avatar"></div>
            <div class="postmeta">
              <span id="time" title="5:06pm 06.06.2011">5 days</span>
            </div>
            <span id="name">Vera</span><span id="location">from Home</span>
            <p>
              Night time - sympathize - I've been working on white lies.
              So I'll tell the truth - I'll give it up to you.
              And when the day come, it will have all been fun. We'll talk about it soon.
            </p>
          </div>


		</div>
</div>
</div>
</body>
</html>