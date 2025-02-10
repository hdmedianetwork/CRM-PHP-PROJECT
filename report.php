<?php include "includes/header.php"; ?>

<div class="main-container">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="page-header">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="title">
              <h4>Download Reports</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Download Reports</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="container mt-4" style="width: 100%;">
        <h2 class="mb-4"></h2>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-light">
              <tr>
                <th>Patient Name</th>
                <th>Lab Name</th>
                <th>Test Name</th>
                <th>Test Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>patient_name</td>
                <td>lab_name</td>
                <td>test_name</td>
                <td>00/00/20XX</td>
                <td>
                  <a href="src/images/download.jpg" download class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-download"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <?php include "includes/footer.php"; ?>