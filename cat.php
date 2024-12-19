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

    <title>Student CRUD</title>
</head>

<body>

    <div class="container mt-4">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>categories
                            <a href="catadd.php" class="btn btn-primary float-end">Add category</a>
                            <a href="admin_page.php" class="btn btn-primary float-end">Back</a>

                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Questions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT c.cat_id, c.cat, COUNT(u.q_id) AS num_questions FROM questions_cat c LEFT JOIN user_questions u ON c.cat_id = u.cat_id GROUP BY c.cat_id";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $category) {
                                        ?>
                                        <tr>
                                            <td><?= $category['cat_id']; ?></td>
                                            <td><?= $category['cat']; ?></td>
                                            <td><?= $category['num_questions']; ?></td>
                                            <td>
                                                <a href="catview.php?id=<?= $category['cat_id']; ?>" class="btn btn-info btn-sm">View</a>
                                                
                                                
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h5> No Record Found </h5>";
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
