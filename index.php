<?php include "includes/header.php"; ?>

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
                <p>0</p>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom: 20px;">
            <div class="dashboard-card healthfit">
                <h5>BookMyLabs Share</h5>
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
        <style>
        .dashboard-card {
            position: relative;
            padding: 20px;
            border-radius: 10px;
            color: #000;
            font-weight: bold;
            overflow: hidden;
            min-height: 120px;
        }
        .dashboard-card h5 {
            font-size: 16px;
        }
        .dashboard-card p {
            font-size: 24px;
            font-weight: bold;
        }
        .dashboard-card::after {
            content: "";
            position: absolute;
            right: 10px;
            bottom: 10px;
            width: 80px;
            height: 80px;
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.2;
        }
        .revenue { background: #e0ffe0; }
        .revenue::after { background-image: url('https://img.icons8.com/ios/100/rupee.png'); }

        .booking { background: #e0f0ff; }
        .booking::after { background-image: url('https://img.icons8.com/ios/100/calendar.png'); }

        .healthfit { background: #e6e9ff; }
        .healthfit::after { background-image: url('https://img.icons8.com/ios/100/clock.png'); }

        .net-partner { background: #e0ffe0; }
        .net-partner::after { background-image: url('https://img.icons8.com/ios/100/wallet.png'); }

        .rejected { background: #ffe0e0; }
        .rejected::after { background-image: url('https://img.icons8.com/ios/100/cancel.png'); }

        .completed { background: #e0fffa; }
        .completed::after { background-image: url('https://img.icons8.com/ios/100/checkmark.png'); }

        .processing { background: #fff5e0; }
        .processing::after { background-image: url('https://img.icons8.com/ios/100/hourglass.png'); }

        .pending { background: #fff8d6; }
        .pending::after { background-image: url('https://img.icons8.com/ios/100/clock.png'); }

        .resample { background: #f0e6ff; }
        .resample::after { background-image: url('https://img.icons8.com/ios/100/clock.png'); }
    </style>



		


   
</div> 
   



		

	<?php include "includes/footer.php" ?>