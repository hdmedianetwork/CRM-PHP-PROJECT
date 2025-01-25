<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Franchise Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            font-weight: bold;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <form action="/submit_form" method="POST" enctype="multipart/form-data">
        <h2>Franchise Registration Form</h2>

        <label for="ownerName">Franchise Owner Name</label>
        <input type="text" id="ownerName" name="ownerName" required>

        <label for="agencyName">Franchise Agency Name</label>
        <input type="text" id="agencyName" name="agencyName" required>

        <label for="email">Email ID</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>

        <label for="address">Address</label>
        <textarea id="address" name="address" rows="4" required></textarea>

        <label for="pinCode">Pin Code</label>
        <input type="text" id="pinCode" name="pinCode" pattern="[0-9]{6}" required>

        <label for="aadhaarNo">Aadhaar Number</label>
        <input type="text" id="aadhaarNo" name="aadhaarNo" pattern="[0-9]{12}" required>

        <label for="aadhaarUpload">Upload Aadhaar</label>
        <input type="file" id="aadhaarUpload" name="aadhaarUpload" accept=".pdf,.jpg,.jpeg,.png" required>

        <label for="panNo">PAN Number</label>
        <input type="text" id="panNo" name="panNo" pattern="[A-Z]{5}[0-9]{4}[A-Z]" required>

        <label for="panUpload">Upload PAN</label>
        <input type="file" id="panUpload" name="panUpload" accept=".pdf,.jpg,.jpeg,.png" required>

        <label for="ownerPhoto">Owner Photo</label>
        <input type="file" id="ownerPhoto" name="ownerPhoto" accept=".jpg,.jpeg,.png" required>

        <label for="ownerSignature">Owner Signature</label>
        <input type="file" id="ownerSignature" name="ownerSignature" accept=".jpg,.jpeg,.png" required>

        <button type="submit">Submit</button>
    </form>

</body>
</html>