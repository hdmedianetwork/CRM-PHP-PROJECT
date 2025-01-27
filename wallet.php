<?php include "includes/header.php"; ?>

<div class="main-container">
  <h1 class="wallet-header">
    <img src="src/images/wallet.jpg" class="wallet-icon" alt="Wallet Icon">
    Wallet
  </h1>
  <div class="balance">
    <div class="left">
      <h3>Wallet Balance:</h3>
      <h1>₹<?php fetchWalletBalance(); ?></h1>
      <h1>Remark:</h1>
      <button id="add-money-btn">Add Money</button>
    </div>
    <div class="right">
      <h2>Scan QR Code to Add Money:</h2>
      <img src="src/images/qr-code.jpg" class="qr-code" alt="QR Code">
    </div>
  </div>

  <!-- Popup Modal -->
  <div id="add-money-modal" class="modal hidden">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>Add Money</h2>
      <form id="add-money-form" action="wallet.php" method="POST" class="form" enctype="multipart/form-data">
        <?php rechargeRequests(); ?>

        <label for="upi_reference">UPI Reference Number</label>
        <input type="text" id="upi_reference" name="upi_reference" required>

        <label for="amount">Amount</label>
        <input type="text" id="amount" name="amount" required>

        <label for="image">Proof of Payment (Image)</label>
        <input type="file" id="image" name="file" accept="image/*">

        <button type="submit" name="wallet_request">Submit</button>
      </form>
    </div>
  </div>
</div>

<script src="src/scripts/wallet.js"></script>

<?php include "includes/footer.php"; ?>