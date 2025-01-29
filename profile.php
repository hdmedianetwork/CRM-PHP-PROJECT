<?php include "includes/header.php"; ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Profile</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-30">
                    <div class="pd-20 card-box">
                        <form action="submit_franchise.php" method="POST" enctype="multipart/form-data">
                            <!-- First Row: Profile photo and owner details -->
                            <div class="row">
                                <!-- Left: Profile Photo -->
                                <div class="col-md-4 text-center">
                                    <div class="profile-photo">
                                        <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <img src="vendors/images/photo1.jpg" alt="" class="avatar-photo">
                                    </div>
                                </div>

                                <!-- Right: Owner Name and Agency Name -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="owner_name">Franchise Owner Name</label>
                                        <input type="text" class="form-control" id="owner_name" name="owner_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="agency_name">Franchise Agency Name</label>
                                        <input type="text" class="form-control" id="agency_name" name="agency_name" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Second Row: Remaining Details -->
                            <div class="row">
                                <div class="col-md-6">
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

                            <!-- Submit Button -->
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
