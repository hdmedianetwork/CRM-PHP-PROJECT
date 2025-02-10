<?php include "includes/header.php"; ?>

<!-- Custom css file -->
<link rel="stylesheet" type="text/css" href="src/styles/index.css">

<div class="mobile-menu-overlay"></div>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            Welcome back, <div class="weight-600 font-30 text-blue"><?php echo $_SESSION['agency_name']; ?></div>
                        </h4>
                    </div>
                    <div class="row gy-4">
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="dashboard-card revenue">
                                <h5>Total Revenue</h5>
                                <p>0</p>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="dashboard-card booking">
                                <h5>Total Booking</h5>
                                <p><?php totalFranchiseBooking(); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="dashboard-card healthfit">
                                <h5>Example</h5>
                                <p>0</p>
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="dashboard-card net-partner">
                                <h5>Net Partner</h5>
                                <p>0</p>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="dashboard-card rejected">
                                <h5>Total Rejected</h5>
                                <p>0</p>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="dashboard-card completed">
                                <h5>Total Completed</h5>
                                <p>0</p>
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="dashboard-card processing">
                                <h5>Total Processing</h5>
                                <p>0</p>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="dashboard-card pending">
                                <h5>Total Pending</h5>
                                <p>0</p>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="dashboard-card resample">
                                <h5>Total Resample</h5>
                                <p>0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php" ?>