<?php include "includes/header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>App</title>
  <link rel="stylesheet" href="pricing.css">
</head>
<body>
  
  <div class="container">
    <div class="pricing">
      <table id="pricing-table">
        <thead>
          <tr>
            <th>Test Name</th>
            <th>B2B</th>
            <th>B2C</th>
            <th>Actions</th> <!-- Added Actions column -->
          </tr>
        </thead>
        <tbody id="pricing-tbody">
          <!-- Rows will be added here dynamically -->
        </tbody>
      </table>
      <div class="controls">
        <button id="add-button">Add</button>
      </div>
      <div id="input-form" class="hidden">
        <label>Enter Test Name</label>
        <input type="text" id="val1">
        <label>Enter B2B Price</label>
        <input type="text" id="val2">
        <label>Enter B2C Price</label>
        <input type="text" id="val3">
        <button id="save-button">Save</button>
        <button id="cancel-button">Cancel</button>
      </div>
    </div>
    <div class="lar"  >
  <?php include "includes/footer.php"; ?>
  </div>
  </div>

  
  <script src="pricing.js"></script>
</body>
</html>
