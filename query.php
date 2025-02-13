<?php
include 'conn.php';
include 'session.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    ?>
    <body style="color:black">
    <div id="header">
        <?php include 'header.php'; ?>
    </div>
    <div id="sidebar">
        <?php $active="query"; include 'sidebar.php'; ?>
    </div>
    <div id="content" style="margin-left:210px">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-title">User Query</h1>
                    </div>
                </div>
                <hr>
                <script>
                    function clickme(query_id) {
                        if(confirm("Do you really want to read?")) {
                            document.getElementById("demo").innerHTML = "Read";
                            $.ajax({
                                url: 'update_query_status.php',
                                type: 'POST',
                                data: { query_id: query_id },
                                success: function(response) {
                                    alert('Status updated');
                                }
                            });
                        }
                    }
                </script>

                <?php
                $limit = 10;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;
                $count = $offset + 1;

                $sql = "SELECT * FROM contact_query LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $limit, $offset);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    ?>

                    <div class="table-responsive" style="margin-right: 20px;">
                        <table class="table table-bordered" style="text-align:center">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:5%">S.no</th>
                                    <th style="text-align:center; width:15%">Name</th>
                                    <th style="text-align:center; width:15%">Email Id</th>
                                    <th style="text-align:center; width:12%">Mobile Number</th>
                                    <th style="text-align:center; width:25%">Message</th>
                                    <th style="text-align:center; width:13%">Posting Date</th>
                                    <th style="text-align:center; width:8%">Status</th>
                                    <th style="text-align:center; width:7%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo htmlspecialchars($row['Name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['MobileNumber']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Message']); ?></td>
                                        <td><?php echo htmlspecialchars($row['QueryDate']); ?></td>
                                        <?php if ($row['query_status'] == 1) { ?>
                                            <td>Read</td>
                                        <?php } else { ?>
                                            <td><a href="query.php?id=<?php echo $row['QueryID']; ?>" onclick="clickme(<?php echo $row['QueryID']; ?>)"><b id="demo">Pending</b></a></td>
                                        <?php } ?>
                                        <td>
                                            <a class="btn btn-danger btn-sm" href='delete_query.php?id=<?php echo $row['QueryID']; ?>'>Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <?php
                } else {
                    echo '<div class="alert alert-info">No queries found.</div>';
                }

                // Pagination
                $sql1 = "SELECT COUNT(*) AS total_records FROM contact_query";
                $result1 = $conn->query($sql1);
                $total_records = $result1->fetch_assoc()['total_records'];
                $total_page = ceil($total_records / $limit);

                if ($total_page > 1) {
                    echo '<div class="table-responsive" style="text-align:center; margin-top:20px;">';
                    echo '<ul class="pagination admin-pagination">';
                    if ($page > 1) {
                        echo '<li><a href="query.php?page='.($page - 1).'">Prev</a></li>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        $active = $i == $page ? "active" : "";
                        echo '<li class="'.$active.'"><a href="query.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if ($total_page > $page) {
                        echo '<li><a href="query.php?page='.($page + 1).'">Next</a></li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                }
                ?>

            </div>
        </div>
    </div>

    <?php
} else {
    echo '<div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>';
    ?>
    <form method="post" name="" action="login.php" class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-4" style="float:left">
                <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
            </div>
        </div>
    </form>
    <?php
}
?>

</body>
</html>