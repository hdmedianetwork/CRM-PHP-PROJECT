<?php
include "includes/header.php";
global $db_conn;

// $franchise_id = $_SESSION['id'];
// $franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);
$fetchLabTestNamesQuery = "SELECT test_name, B2B, B2C FROM test_details";
$query = query($fetchLabTestNamesQuery);
confirm($query);

if (isset($_GET['lab_name'])) {
    $lab_name = $_GET['lab_name'];
} else {
    $lab_name = "";
}
?>

<!-- Custom css file -->
<link rel="stylesheet" type="text/css" href="src/styles/select_test.css">

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="search">
                <img src="vendors/images/assets/search.png" alt=""> <input type="text" placeholder="Search Labs">
            </div>
            <section>
                <form action="testform.php" method="GET">
                    <div class="row">
                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                            <div class="card">
                                <div class="insidecard">

                                    <!-- <div class="d-flex justify-content-center align-items-center mb-3"> -->
                                    <!-- <i class="fas fa-heartbeat fa-3x text-danger"></i> -->

                                    <!-- </div> -->
                                    <h4 class="ctop"> <span> <?php echo $row['test_name']; ?></h4></span>
                                    <p class="clinova">
                                        <i class=""></i>
                                        <img src="vendors/images/assets/medicalhand.png" alt="">
                                        Clinova
                                    </p>
                                    <p class="price">
                                        <span class="linethrough">1500</span>
                                        <span class="reducedprice">&#8377; <?php echo $row['B2C']; ?></span>
                                    </p>
                                    <label class="checkbox">
                                        <div>

                                            <input type="checkbox" name="selected_tests[]" value="<?php echo $row['test_name']; ?>" class="box">
                                        </div>
                                        <!-- <span>Select Test</span> -->
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="lab_name" value="<?php echo $lab_name; ?>">
                    <div class="text-center mt-4">
                        <input type="submit" class="btn btn-primary btn-lg" value="Submit" style="width: 150px;">
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</body>

</html>