<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Danger Bomber</title>
<style>
  body {
    background-color: black;
    color: white;
    font-family: Arial, sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
  }
  .container {
    background: #333;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    text-align: center;
    max-width: 300px; /* এটি দ্বারা কন্টেইনারের প্রস্থ সীমিত করা হয়েছে */
  }
  .logo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
  }
  input, button, #processingForm {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
    border: none;
  }
  #processingForm {
    display: none; /* Initially hide the processing message */
    width: auto; /* Smaller width for the processing form */
  }
  button {
    display: block; /* Ensure button is always visible */
    background-color: #ffdd00;
    color: black;
    font-size: 16px;
    cursor: pointer;
  }
  button:hover {
    background-color: #ccaa00;
  }
  #statusMessage {
    color: #ffdd00;
    margin-top: 10px;
  }
</style>
</head>
<body>
<div class="container">
  <img class="logo" src="https://i.postimg.cc/KvsmN1zK/IMG-20240913-095642-353.jpg" alt="Team Logo">
  <h2>Welcome!</h2>
  <p>Enter Phone Number:</p>
  <form id="bombingForm" method="POST">
    <input type="text" id="phoneNumber" name="phoneNumber" placeholder="01xxx" required>
    <button type="button" onclick="startBombing()">START BOMBING</button>
    <div id="processingForm">Processing...</div>
    <p id="statusMessage"></p>
  </form>
</div>

<script>
  function startBombing() {
    var phoneNumber = document.getElementById('phoneNumber').value;
    var formData = new FormData();
    formData.append('phoneNumber', phoneNumber);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'bombing.php', true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        document.getElementById('statusMessage').textContent = "Bombing Successful!";
        document.getElementById('processingForm').style.display = 'none'; // Hide processing message
      } else {
        document.getElementById('statusMessage').textContent = "Error: Bombing stopped.";
        document.getElementById('processingForm').style.display = 'none'; // Hide processing message on error
      }
    };
    xhr.send(formData);

    document.getElementById('processingForm').style.display = 'block'; // Show processing message
  }
</script>

</body>
</html>
