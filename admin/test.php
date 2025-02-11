<?php include "includes/header_admin.php"; ?>

<div class="main-container">
  <div class="pricing">
    <table id="pricing-table">
      <thead>
        <tr>
          <th>Test Name</th>
          <th>B2B</th>
          <th>B2C</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="pricing-tbody">
        <td><?php readAllTestPrice(); ?></td>
      </tbody>
    </table>
    <div class="controls">
      <button id="add-button">Add</button>
    </div>
    <div id="input-form" class="hidden">
      <form id="pricingForm" method="POST" action="test" class="form">
        <?php addTestPrice(); ?>

        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <label>Enter Test Name</label>
        <input type="text" id="name" name="test_name">
        <label>Enter B2B Price</label>
        <input type="text" id="B2B" name="B2B">
        <label>Enter B2C Price</label>
        <input type="text" id="B2B" name="B2C">
        <div class="button-group">
          <button id="save-button" type="submit" name="addTestPrice" style="width: 100px;">Save</button>
          <button id="cancel-button" style="width: 100px;" onclick="cancelTestAdd()">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="../src/scripts/pricing.js"></script>

<script>
  function confirmDelete(TestId) {
    if (confirm("Are you sure you want to delete this test? This action cannot be undone.")) {
      window.location.href = "test_delete.php?delete=" + TestId;
    }
  }

  function cancelTestAdd() {
    window.location.href = "test";
  }
</script>
<?php include "includes/footer_admin.php"; ?>