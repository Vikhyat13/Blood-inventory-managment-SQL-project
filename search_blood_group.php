<?php
$bg = $_POST['blood'];
$conn = mysqli_connect("localhost", "root", "", "BloodInventoryDB") or die("Connection error");

// Fetch donors with the selected blood group
$sql = "SELECT * FROM Donor WHERE DonorBloodGroup='{$bg}' ORDER BY RAND() LIMIT 5";
$result = mysqli_query($conn, $sql) or die("Query unsuccessful.");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
    <div class="row">
        <div class="col-lg-4 col-sm-6 portfolio-item"><br>
            <div class="card" style="width:300px">
                <img class="card-img-top" src="image/blood_drop_logo.jpg" alt="Card image" style="width:100%;height:300px">
                <div class="card-body">
                    <h3 class="card-title"><?php echo $row['DonorName']; ?></h3>
                    <p class="card-text">
                        <b>Blood Group : </b> <b><?php echo $row['DonorBloodGroup']; ?></b><br>
                        <b>Mobile No. : </b> <?php echo $row['DonorMobile']; ?><br>
                        <b>Gender : </b><?php echo $row['Gender']; ?><br>
                        <b>Age : </b> <?php echo $row['Age']; ?><br>
                        <b>Address : </b> <?php echo $row['DonorAddress']; ?><br>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php
    }
} else {
    echo '<div class="alert alert-danger">No Donor Found For Your Searched Blood Group</div>';
}
?>