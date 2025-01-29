<?php include "includes/header.php"; ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Test Request Form</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">TRF</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard" id="testRequestForm" method="POST" enctype="multipart/form-data">
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <!-- Step 1: Test Selection -->
                        <h5>Select Tests</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="testSelection">Available Tests (Select Multiple):</label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Select</th>
                                                        <th>Test Name</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Simulate 20 random tests
                                                    $tests = [
                                                        ["CBC", 500],
                                                        ["Liver Function Test", 1200],
                                                        ["Lipid Profile", 900],
                                                        ["Vitamin D", 1500],
                                                        ["Blood Sugar", 300],
                                                        ["Creatinine", 400],
                                                        ["Thyroid Profile", 800],
                                                        ["Urine Routine", 200],
                                                        ["CRP", 700],
                                                        ["Serum Calcium", 450],
                                                        ["ESR", 350],
                                                        ["Rheumatoid Factor", 1000],
                                                        ["Ferritin", 600],
                                                        ["Vitamin B12", 1300],
                                                        ["Iron Studies", 1100],
                                                        ["HBA1c", 800],
                                                        ["D-Dimer", 1200],
                                                        ["PT/INR", 950],
                                                        ["Troponin T", 1800],
                                                        ["CEA", 1400]
                                                    ];
                                                    foreach ($tests as $test) {
                                                        echo "<tr>
                                                                <td><input type='checkbox' name='selectedTests[]' value='{$test[0]}'></td>
                                                                <td>{$test[0]}</td>
                                                                <td>{$test[1]} INR</td>
                                                            </tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Step 2: Patient Information -->
                        <h5>Patient Information</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Age:</label>
                                        <input type="number" name="age" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender:</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile Number:</label>
                                        <input type="text" name="mobile" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>City:</label>
                                        <input type="text" name="city" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="selected_tests">Selected Tests:</label>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sample Dispatch Option:</label>
                                        <select name="dispatchOption" class="form-control">
                                            <option value="Pickup">Sample Drawn</option>
                                            <option value="Courier">Home Collection</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sample Drawn Date:</label>
                                        <input type="date" name="drawnDate" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Sample Drawn Time (6 AM - 6 PM):</label>
                                        <input type="time" name="drawnTime" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Fasting Status:</label>
                                        <select name="fastingStatus" class="form-control">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Reference Doctor (Optional):</label>
                                        <input type="text" name="referenceDoctor" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Attachments (Optional):</label>
                                        <input type="file" name="attachments" class="form-control" multiple>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Step 3: Invoice -->
                        <!-- <h5>Invoice</h5>
                        <section>
                            <div id="invoice">
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
                                                <h5 class="mb-15">Client Name</h5>
                                                <p class="font-14 mb-5">Date Issued: <strong class="weight-600">10 Jan 2018</strong></p>
                                                <p class="font-14 mb-5">Invoice No: <strong class="weight-600">4556</strong></p>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-right">
                                                    <p class="font-14 mb-5">Your Name </strong></p>
                                                    <p class="font-14 mb-5">Your Address</p>
                                                    <p class="font-14 mb-5">City</p>
                                                    <p class="font-14 mb-5">Postcode</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invoice-desc pb-30">
                                            <div class="invoice-desc-head clearfix">
                                                <div class="invoice-sub">Description</div>
                                                <div class="invoice-rate">Rate</div>
                                                <div class="invoice-hours">Hours</div>
                                                <div class="invoice-subtotal">Subtotal</div>
                                            </div>
                                            <div class="invoice-desc-body">
                                                <ul>
                                                    <li class="clearfix">
                                                        <div class="invoice-sub">Website Design</div>
                                                        <div class="invoice-rate">$20</div>
                                                        <div class="invoice-hours">100</div>
                                                        <div class="invoice-subtotal"><span class="weight-600">$2000</span></div>
                                                    </li>
                                                    <li class="clearfix">
                                                        <div class="invoice-sub">Logo Design</div>
                                                        <div class="invoice-rate">$20</div>
                                                        <div class="invoice-hours">100</div>
                                                        <div class="invoice-subtotal"><span class="weight-600">$2000</span></div>
                                                    </li>
                                                    <li class="clearfix">
                                                        <div class="invoice-sub">Website Design</div>
                                                        <div class="invoice-rate">$20</div>
                                                        <div class="invoice-hours">100</div>
                                                        <div class="invoice-subtotal"><span class="weight-600">$2000</span></div>
                                                    </li>
                                                    <li class="clearfix">
                                                        <div class="invoice-sub">Logo Design</div>
                                                        <div class="invoice-rate">$20</div>
                                                        <div class="invoice-hours">100</div>
                                                        <div class="invoice-subtotal"><span class="weight-600">$2000</span></div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="invoice-desc-footer">
                                                <div class="invoice-desc-head clearfix">
                                                    <div class="invoice-sub">Bank Info</div>
                                                    <div class="invoice-rate">Due By</div>
                                                    <div class="invoice-subtotal">Total Due</div>
                                                </div>
                                                <div class="invoice-desc-body">
                                                    <ul>
                                                        <li class="clearfix">
                                                            <div class="invoice-sub">
                                                                <p class="font-14 mb-5">Account No: <strong class="weight-600">123 456 789</strong></p>
                                                                <p class="font-14 mb-5">Code: <strong class="weight-600">4556</strong></p>
                                                            </div>
                                                            <div class="invoice-rate font-20 weight-600">10 Jan 2018</div>
                                                            <div class="invoice-subtotal"><span class="weight-600 font-24 text-danger">$8000</span></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="text-center pb-20">Thank You!!</h4>
                                    </div>
                                </div>




                            </div>
                        </section> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    $(document).ready(function() {
        $(".tab-wizard").steps({
            headerTag: "h5",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Submit"
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
                $('.steps .current').prevAll().addClass('disabled');
            },
            onFinished: function(event, currentIndex) {
                let formData = new FormData($("#testRequestForm")[0]); // Fetch form data

                $.ajax({
                    url: "includes/test_request_form.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        let result = JSON.parse(response);
                        if (result.status === "success") {
                            $('#success-modal').modal('show');
                        } else {
                            alert(result.message);
                        }
                    },
                    error: function() {
                        alert("Something went wrong! Please try again.");
                    }
                });
            }
        });
    });
</script>

<script src="src/scripts/submit_test.js"></script>
<?php include "includes/footer.php"; ?>