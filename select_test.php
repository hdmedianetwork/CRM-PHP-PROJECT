<?php
include "includes/header.php";
global $db_conn;

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
                                    <h4 class="ctop">
                                        <span class="test-name" title="<?php echo $row['test_name']; ?>"><?php echo $row['test_name']; ?></span>
                                    </h4>
                                    <p class="clinova">
                                        <img src="vendors/images/assets/medicalhand.png" alt="">
                                        Clinova
                                    </p>
                                    <p class="price">
                                        <!-- <span class="linethrough">1500</span> -->
                                        <span class="reducedprice">&#8377; <?php echo $row['B2C']; ?></span>
                                    </p>
                                    <label class="checkbox">
                                        <div>
                                            <input type="checkbox" name="selected_tests[]" value="<?php echo $row['test_name']; ?>" class="box">
                                        </div>
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
