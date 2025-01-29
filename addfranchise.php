<?php include "includes/header.php"; ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Franchise Owner Registration</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-30">
                    <div class="pd-20 card-box">
                        <form action="submit_franchise" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="owner_name">Franchise Owner Name</label>
                                        <input type="text" class="form-control" id="owner_name" name="owner_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="agency_name">Franchise Agency Name</label>
                                        <input type="text" class="form-control" id="agency_name" name="agency_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email ID</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone No</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" id="address" name="address" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pin_code">Pin Code</label>
                                        <input type="text" class="form-control" id="pin_code" name="pin_code" required>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="adhaar_no">Aadhaar No</label>
                                        <input type="text" class="form-control" id="adhaar_no" name="adhaar_no" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="adhaar_upload">Aadhaar Upload</label>
                                        <input type="file" class="form-control" id="adhaar_upload" name="adhaar_upload" accept="image/*,.pdf" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pan_no">PAN No</label>
                                        <input type="text" class="form-control" id="pan_no" name="pan_no" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pan_upload">PAN Upload</label>
                                        <input type="file" class="form-control" id="pan_upload" name="pan_upload" accept="image/*,.pdf" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="owner_photo">Owner Photo</label>
                                        <input type="file" class="form-control" id="owner_photo" name="owner_photo" accept="image/*" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="owner_signature">Owner Signature</label>
                                        <input type="file" class="form-control" id="owner_signature" name="owner_signature" accept="image/*" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-primary btn-sm w-25" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>