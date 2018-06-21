<?php 
	
	
	$username = '';
	$password = '';
	$output = '';
	
	if(isset($_POST['submit'])){
		//DATABASE CONNECTION
		require 'scripts/databaseconnectin.php';
		
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		
		$errors = array();
		
		// If no errors were found, proceed with storing the user input
		if (count($errors) == 0) {
			//Check user credentials
			$loginquery ="SELECT * FROM user WHERE username='$username' AND password='".SHA1($_POST['password'])."'";
			$loginresult = mysqli_query($con, $loginquery);
						
			//Check whether the query was successful or not
			if($loginresult) {
				if(mysqli_num_rows($loginresult) == 1) {
					//Login Successful
					session_regenerate_id();
					$user = mysqli_fetch_array($loginresult, MYSQLI_ASSOC);
					$_SESSION['SESS_UID'] = $user['uid'];
					$_SESSION['SESS_USERNAME'] = $user['username'];
					$_SESSION['SESS_FIRSTNAME'] = $user['firstname'];
					$_SESSION['SESS_LASTNAME'] = $user['lastname'];

					header("Location: index.php?page=init.php");

				} else {
					array_push($errors, "Username and Password combination  is incorrect. Please try again!");
					}
				}
				 
				else {
					die("Connection failed". mysqli_error($con));
				}
				
				//Prepare errors for output
				foreach($errors as $val) {
				 	$output = "<p>" . $val . "</p>";
				 }
		}
	mysqli_close($con);
	}

?>


<div class="login-form-wrapper">
			<div class="form-size">
				<div class="form-border">
					<div class="form-padding">
						<div class="form-center">
						
							 <div class="img-center">
								<img src="images/logo.jpg" alt="BUS FOR U"/>
							  </div>
							
							
							<img src="/images/login.png" alt=""/>

							<?php
							  if(@$_GET['registered'] == 'true' ) {
							  	echo '<h1> Registration Successful... <span class="ext"> Please Sign In </span></h1>';
							  } else{
							  	echo '<h1> Please <span class="ext"> Sign In! </span></h1>';
							  }
							?>
							
							<?php 
							  if(@$_GET['authorise'] == 'no' ) {
							  	echo '<div class="error"><p>You are not authorised to view the requested page</p> </div>';
							  }
							?>
							
							<?php 
							  if(@$_GET['login'] == 'no' ) {
							  	echo '<div class="error"><p>You need to be logged in to view the requested page</p> </div>';
							  }
							?>
							
							<div class="error"><?php echo $output; ?> </div>
						</div>
					 		
					 		<form action="" method="post" id="loginForm" novalidate="novalidate">
								<div class="form-input">

									<label>Username: </label>
									<input name="username" id="username" type="text" class="text" placeholder="Username" value=""/>
										
									<br>
									<label>Password: </label>
									<input name="password" id="password" type="password" class="text" placeholder="Password"/>

										
									<br><br><br>
								</div>
								<div class="form-center">
									<span><input type="submit" name="submit" value="Sign In"></span>
									<div style="margin-top:30px;">Not a Member ? <a href="index.php?page=register.php"> Register</a></div>
								</div>
								<div class="clear"></div>
				
							</form>
					 		
					
					
					</div>
				</div>
			</div>
		</div>


 <script>
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#loginForm").validate({
    
        // Specify the validation rules
        rules: {
            username: "required",
            password: "required"
        },
        
        // Specify the validation error messages
        messages: {
        	username: "Please enter your username",
        	password: "Please enter your password"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>
	
