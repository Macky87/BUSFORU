<?php
	session_start();   

	$page = htmlentities($_GET['page']);    // 
	$pages = scandir('pages');
	if(!empty($page)&& in_array($_GET['page'], $pages)){
		$content = 'pages/'.$_GET['page'];
	} else{
		header("Location:index.php?page=portal.html");  // redirect location to portal page by using header
	}

?>


<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/form-elements.css"/>
		<link rel="stylesheet" type="text/css" href="css/main-style.css"/>           <!--link is to use css files-->
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
	
		<script  src="js/jquery.min.js" type="text/javascript"></script>
		<script  src="js/jquery-ui.min.js" type="text/javascript"></script>          
		<script  src="js/jquery.validate.min.js" type="text/javascript"></script>    <!--script is to use javascript files-->
		<script  src="js/functions.js" type="text/javascript"></script>
		
		 
	
		
	</head>
		<body>
			<div id="content">
				<?php include ($content)?>   <!-- any page that loads runs in this section-->
			</div>
		</body>
</html>	
