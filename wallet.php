<?php include "includes/header.php"; ?>


<style>
  /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
}

/* Wallet Title */
.title h4 {
    display: flex;
    align-items: center;
    font-size: 24px;
    color: #333;
    font-weight: bold;
}

.wallet-icon {
    width: 30px;
    height: 30px;
    margin-right: 10px;
}

/* Wallet Balance Section */
.balance {
    display: flex;
    justify-content: space-between;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.balance .left h3,
.balance .left h1 {
    margin: 5px 0;
}

#add-money-btn {
    background:rgb(0, 4, 255);
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

#add-money-btn:hover {
    background: #e68900;
}

/* QR Code Section */
.balance .right {
    text-align: center;
}

.qr-code {
    width: 120px;
    height: 120px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

/* Modal Styles */



/* Modal Styles - Centered & Better Layout */
.modal {
    display: none;
    position: fixed;
    top: 52%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 450px; /* Increased width */
    max-width: 90%;
    max-height: 72vh; /* Prevents modal from becoming too tall */
    overflow-y: auto;
}

/* Modal Content Styling */
.modal-content {
    text-align: center;
}

/* Close Button */
.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 22px;
    cursor: pointer;
}

.close-btn:hover {
    color: red;
}

/* Form Styling */
.form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px; /* More spacing between inputs */
}

/* Input Fields */
.form input,
.form button {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
}

/* Submit Button */
.form button {
    background: #28a745;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
    padding: 12px;
}

.form button:hover {
    background: #218838;
}

  </style>



<div class="main-container" style="padding-top: 5px;">
  <div class="container" style="height: 100px; width: 100%; margin-top: 80px;">
    <div class="col-md-12 col-sm-12">
      <div class="title">
        <h4>
          <img src="src/images/wallet.jpg" class="wallet-icon" alt="Wallet Icon">
          Wallet
        </h4>
      </div>
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Wallet</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="balance" style="width: 50%;">
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
      <form id="add-money-form" action="wallet" method="POST" class="form" enctype="multipart/form-data">
        <?php rechargeRequests();
        displayMessage();
        ?>
        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <label for="upi_reference">UPI Reference Number</label>
        <input type="text" id="upi_reference" name="upi_reference" required>
        <label for="amount">Amount</label>
        <input type="text" id="amount" name="amount" required>
        <label for="image">Proof of Payment (Image)</label>
        <input type="file" id="file" name="file" accept="image/*">
        <button type="submit" name="wallet_request">Submit</button>
      </form>
    </div>
  </div>
</div>

<script src="src/scripts/wallet.js"></script>
<?php include "includes/footer.php"; ?>