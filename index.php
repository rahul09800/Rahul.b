<?php 
	include("veiw/header.php");
	
	//Redirect If Already Logged In
	if (isset($_SESSION['email'])) {
	    header("Location: browse.php");
		die();
	}
	
	if(isset($_GET['sign-up'])){
		//check if form is submitted
		if (isset($_POST['signup'])) {
			$name = mysqli_real_escape_string($con, $_POST['name']);
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			
			$q="INSERT INTO users(Name,email,pass) VALUES('$name', '$email', '$password')";
			if(mysqli_query($con,$q)) {
			 	$successmsg="Registration Successful. You can Login <a href='index.php'>Here</a>";
			} else {
			 	$errormsg="Email Already Registered";
			}
		}
	} else {
		// If Login Button Clicked
		if (isset($_POST['login'])) {
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$password=$password;
			$result = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' and pass = '$password' ");
			if ($row=mysqli_fetch_array($result)){     
				$_SESSION['email'] = $row['email'];
				// Check if the user is an admin
				if ($row['role'] == 'admin') {
					header("Location: admin_page.php"); // Redirect to admin page
				} else {
					header("Location: browse.php"); // Redirect to browse page for non-admin users
				}
				exit(); // Stop further execution
			} else {
				$errormsg = "Incorrect Email or Password!!!";
			}
		}	 
	}
?>

<!-- Sign-Up and Login Box -->
<div class="container">
	<?php if(isset($_GET['sign-up'])){?>
	<div class="row">
        <div class="col-md-4 col-md-offset-4 well" style="margin-top:50px;">
            <form role="form" action="index.php?sign-up" method="post" name="signupform">
                <fieldset>
                    <legend>Sign Up</legend>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"  name="name" placeholder="Enter Full Name" required class="form-control" />
					</div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="email" placeholder="Email" required class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Password" required class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        Already Registered? <a href="index.php">Login Here</a>
        </div>
    </div>
	<?php } else{ ?>
	
	<!-- Login Interface -->
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well" style="margin-top:100px;">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                <fieldset>
                    <legend>Login</legend>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="email" placeholder="Your Email" required class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Your Password" required class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        New User? <a href="index.php?sign-up">Sign Up Here</a>
        </div>
	</div>
	<?php } ?>
</div>
