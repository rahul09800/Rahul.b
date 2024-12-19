<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_page</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

</head>
<body>

<input type="checkbox" id="check">
<!--header area start-->
<header>
    <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
        <h3>MRCET <span></span></h3>
    </div>
    <div class="right_area">
        <a href="logout.php" class="logout_btn">Logout</a>
    </div>
</header>
<!--header area end-->
<!--mobile navigation bar start-->
<div class="mobile_nav">
    <div class="nav_bar">
        <img src="1.png" class="mobile_profile_image" alt="">
        <i class="fa fa-bars nav_btn"></i>
    </div>
    <div class="mobile_nav_items">
        <a href="#"><i class="fas fa-desktop"></i><span>DashBoard</span></a>
        <a href="#"><i class="fas fa-cogs"></i><span>User</span></a>
        <a href="#"><i class="fas fa-table"></i><span>Categories</span></a>
        <a href="#"><i class="fas fa-th"></i><span>Collections</span></a>
        <a href="#"><i class="fas fa-info-circle"></i><span>Ask Question</span></a>
        <a href="#"><i class="fas fa-info-circle"></i><span>About</span></a>
    </div>
</div>
<!--mobile navigation bar end-->
<!--sidebar start-->
<div class="sidebar">
    <div class="profile_info">
        
        <h4>Hello Admin!!</h4>
    </div>
    <a href="admin_page.php"><i class="fas fa-desktop"></i><span>DashBoard</span></a>
    <a href="studentdetails.php"><i class="fas fa-users"></i><span>Users</span></a>
    <a href="cat.php"><i class="fas fa-tag"></i><span>Category</span></a>
    
</div>
<!--sidebar end-->
<?php 
   session_start();
   $con = mysqli_connect("localhost","root","","questania");
   if(!$con){
       die('Connection Failed'. mysqli_connect_error());
   }

$query_users = "SELECT COUNT(*) AS num_users FROM users";
$result_users = mysqli_query($con, $query_users);
$row_users = mysqli_fetch_assoc($result_users);
$num_users = $row_users['num_users'];

// Fetch number of categories
$query_categories = "SELECT COUNT(*) AS num_categories FROM questions_cat";
$result_categories = mysqli_query($con, $query_categories);
$row_categories = mysqli_fetch_assoc($result_categories);
$num_categories = $row_categories['num_categories'];
?>
<div class="content">
    <h1 class="heading">Admin DashBoard</h1>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                <p class="card-text">Number of users:<?php echo $num_users; ?></p>
                <a href="studentdetails.php" class="btn btn-primary">View Details</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Categories</h5>
                <p class="card-text">Number of categories:<?php echo $num_categories; ?></p>
                <a href="cat.php" class="btn btn-primary">View Details</a>
            </div>
        </div>
    </div>
    
</div>





<script type="text/javascript">
    $(document).ready(function () {
        $('.nav_btn').click(function () {
            $('.mobile_nav_items').toggleClass('active');
        });
    });
</script>

</body>
</html>
