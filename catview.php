<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "questania");
if (!$con) {
    die('Connection Failed' . mysqli_connect_error());
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Category View</title>
</head>

<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Category View Details
                            <a href="cat.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {
                            $cat_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT c.cat_id, c.cat, COUNT(u.q_id) AS num_questions FROM questions_cat c LEFT JOIN user_questions u ON c.cat_id = u.cat_id WHERE c.cat_id = $cat_id";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $category = mysqli_fetch_array($query_run);
                                ?>

                                <div class="mb-3">
                                    <label>Category ID</label>
                                    <p class="form-control">
                                        <?= $category['cat_id']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Category Name</label>
                                    <p class="form-control">
                                        <?= $category['cat']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Number of Questions</label>
                                    <p class="form-control">
                                        <?= $category['num_questions']; ?>
                                    </p>
                                </div>

                            <?php
                            } else {
                                echo "<h4>No Such Category Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
