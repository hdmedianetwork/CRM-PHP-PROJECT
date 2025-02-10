<?php include "includes/header.php";

if (isset($_GET['sr_no']) && isset($_GET['patient_name'])) {
	$sr_no = $_GET['sr_no'];
	$patient_name = $_GET['patient_name'];
} else {
	$sr_no = " ";
	$patient_name = " ";
}

// get invoice data =======================================================================================
global $db_conn;
$franchise_id = $_SESSION['id'];
$franchise_id = mysqli_real_escape_string($db_conn, $franchise_id);

$invoiceDataQuery = "SELECT * FROM test_requests WHERE id = '$sr_no' AND franchise_id = '$franchise_id' ";
$invoiceDataQuery .= "AND patient_name = '$patient_name' ";
$query = query($invoiceDataQuery);
confirm($query);

while ($row = mysqli_fetch_array($query)) {

	$patient_age = $row['age'];
	$patient_gender = $row['gender'];
	$patient_mobile = $row['mobile'];

	$franchise_name = $row['franchise_name'];
	$lab_name = $row['lab_name'];
	// $lab_code = $row['lab_code'];

	$test_names = $row['selected_test'];
	$test_names = explode(",", $test_names);

	// date formatting
	$created_at = $row['created_at'];
	$originalDate = $created_at;
	$date = new DateTime($originalDate);
	$formattedDate = $date->format('jS F Y, h:i A');
}
// ========================================================================================================


foreach ($test_names as $printed_test) {
	echo "<p>" . trim($printed_test) . "</p>";

	$fetchTestDetails = "SELECT * FROM test_details WHERE test_name = '$printed_test'";
	$query = query($fetchTestDetails);
	confirm($query);

	while ($row = mysqli_fetch_array($query)) {

		$code = $row['code'];
		$test_name = $row['test_name'];
		$test_price = $row['B2C'];
	}
}

?>

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Invoice</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Invoice</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
			<div class="invoice-wrap">
				<div class="invoice-box">
					<div class="invoice-header">
						<div class="logo text-center">
							<img src="vendors/images/deskapp-logo.png" alt="">
						</div>
					</div>
					<h4 class="text-center mb-30 weight-600">INVOICE</h4>
					<div class="row pb-30">
						<div class="col-md-6">
							<p class="font-14 mb-5">Date: <strong class="weight-600"><?php echo $formattedDate; ?></strong></p>
							<p class="font-14 mb-5">Franchise Name: <strong class="weight-600"><?php echo $franchise_name; ?></strong></p>
							<p class="font-14 mb-5">Lab Code: <strong class="weight-600"><?php //echo $lab_code; 
																							?></strong></p>
							<p class="font-14 mb-5">Lab Name: <strong class="weight-600"><?php echo $lab_name; ?></strong></p>
						</div>
						<div class="col-md-6">
							<div class="text-right">
								<p class="font-14 mb-5">Patient ID: <strong class="weight-600">patient_id</strong></p>
								<p class="font-14 mb-5">Name & Age: <strong class="weight-600"><?php echo $patient_name; ?>, 45</strong></p>
								<p class="font-14 mb-5">Gender: <strong class="weight-600"><?php echo $patient_gender; ?></strong></p>
								<p class="font-14 mb-5">Contact No.: <strong class="weight-600"><?php echo $patient_mobile; ?></strong></p>
							</div>
						</div>
					</div>
					<div class="invoice-desc pb-30">
						<div class="invoice-desc-head clearfix">
							<div class="invoice-rate">Test Code</div>
							<div class="invoice-sub">Test Description</div>
							<!-- <div class="invoice-rate">Rate</div>
							<div class="invoice-hours">Hours</div> -->
							<div class="invoice-subtotal">Subtotal</div>
						</div>
						<div class="invoice-desc-body">
							<ul>
								<li class="clearfix">
									<div class="invoice-rate"><?php foreach ($code as $test_code) {
																?>
											<div class="invoice-rate"><?php
																		// $printed_test = $test;
																		// $test_data = fetchTestCode($printed_test);
																		echo $test_code;
																		?></div>
										<?php }
										?>
									</div>
									<div class="invoice-sub">
										<?php
										foreach ($test_names as $test) {
											echo "<p>" . trim($test) . "</p>";
										}
										?>
									</div>
									<!-- <div class="invoice-rate">$20</div>
									<div class="invoice-hours">100</div> -->
									<div class="invoice-subtotal"><span class="weight-600">$2000</span></div>
								</li>
								<li class="clearfix">
									<div class="invoice-sub"><strong>Total</strong></div>
									<div class="invoice-subtotal"><span class="weight-600 font-24 text-danger">$2000</span></div>
								</li>
							</ul>
						</div>
					</div>
					<h4 class="text-center pb-20">Thank You!!</h4>
				</div>
			</div>
		</div>

		<?php include "includes/footer.php" ?>