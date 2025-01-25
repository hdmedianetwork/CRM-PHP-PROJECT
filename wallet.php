<?php include "includes/header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wallet</title>
  <link rel="stylesheet" href="wallet.css">
</head>
<body>
  <div class="container">
    <h1 class="wallet-header">
      <img src="src/images/assets/wallet.png" class="wallet-icon" alt="Wallet Icon">
      Wallet
    </h1>
    <div class="balance">
      <div class="left">
        <h3>Wallet Balance:</h3>
        <h1>₹0</h1>
        <h1>Remark:</h1>
        <button id="add-money-btn">Add Money</button>
      </div>
      <div class="right">
        <h2>Scan QR Code to Add Money:</h2>
        <img src="src/images/assets/QR.png" class="qr-code" alt="QR Code">
      </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>
<?php include "includes/footer.php"; ?>
