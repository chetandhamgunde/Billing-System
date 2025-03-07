<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Include Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.12/dist/sweetalert2.min.css" rel="stylesheet">

    <title>Admin-Billing</title>
</head>

<body class="show-sidebar bg-light">

    <!-- Sidebar -->
    <?php $this->load->view('IncludeAdmin/CommonSidebar'); ?>
    <!-- SIDEBAR END -->

    <main>
        <!-- Navbar -->
        <?php $this->load->view('IncludeAdmin/CommonNavbar'); ?>
        <!-- Navbar End -->


        <!-- Main Content Container -->
      
<div class="container mt-4 p-4 border rounded" style="border: 2px solid orange;">
  <h4 class="text-center fw-bold">INVOICE FORM</h4>

  <!-- FASSI, GST, HSN/SAC Section -->
  <div class="row bg-light p-3 rounded">
    <div class="col-md-6 mb-2">
      <label class="fw-bold">FASSI NO:</label>
      <input type="text" class="form-control" value="11515027001581" readonly>
    </div>
    <div class="col-md-6 mb-2">
      <label class="fw-bold">GST NO:</label>
      <input type="text" class="form-control" value="27ABJPL9876F1Z1" readonly>
    </div>
    <div class="col-md-6 mb-2">
      <label class="fw-bold">HSN/SAC Code:</label>
      <input type="text" class="form-control" value="996331" readonly>
    </div>
  </div>

  <!-- Invoice Details -->
  <h5 class="mt-3">Invoice Details</h5>
  <div class="row bg-light p-3 rounded">
    <div class="col-md-6 mb-2">
      <label>Bill no:</label>
      <input type="text" id="billNo" class="form-control" readonly>
    </div>
    <div class="col-md-6 mb-2">
      <label>Table no:</label>
      <input type="text" class="form-control clear-field" placeholder="Enter table no">
    </div>
    <div class="col-md-6 mb-2">
      <label>Date & Time:</label>
      <input type="datetime-local" class="form-control clear-field">
    </div>
    <div class="col-md-6 mb-2">
      <label>Waiter:</label>
      <input type="text" class="form-control clear-field" placeholder="Enter waiter name">
    </div>
    <div class="col-md-6 mb-2">
      <label>Total Amount:</label>
      <input type="text" id="totalAmount" class="form-control clear-field" placeholder="Enter total Amount">
    </div>
    <div class="col-md-6 mb-2">
      <label>Discount %:</label>
      <input type="number" id="discount" class="form-control clear-field" oninput="calculateFinalTotal()">
    </div>
  </div>

  <!-- Items and Tax Details -->
  <div class="row mt-3">
    <div class="col-md-6 bg-light p-3 rounded">
      <h6>Items</h6>
      <table class="table">
        <thead>
          <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="itemList">
        </tbody>
      </table>
      <button class="btn btn-warning no-print" onclick="addItem()">Add Item</button>
    </div>
    <div class="col-md-6 bg-light p-3 rounded">
      <h6>Tax Details</h6>
      <div class="row">
        <div class="col-md-6">
          <label>CGST %:</label>
          <input type="number" id="cgst" class="form-control clear-field" oninput="calculateFinalTotal()">
        </div>
        <div class="col-md-6">
          <label>SGST %:</label>
          <input type="number" id="sgst" class="form-control clear-field" oninput="calculateFinalTotal()">
        </div>
        <div class="col-md-12 mt-2">
          <label>Final Amount:</label>
          <input type="text" id="finalAmount" class="form-control" readonly>
        </div>
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="text-center mt-3 no-print">
    <button class="btn btn-warning" onclick="window.print()">Print Invoice</button>
    <button class="btn btn-light border" onclick="clearFields()">Clear</button>
  </div>
</div>

<script>
  // Auto-generate Bill Number
  document.getElementById("billNo").value = "BILL-" + new Date().toISOString().slice(0,10).replace(/-/g, "") + "-" + Math.floor(Math.random() * 1000);

  // Clear all input fields
  function clearFields() {
    document.querySelectorAll('.clear-field').forEach(field => field.value = '');
  }

  // Add Items Dynamically
  function addItem() {
    let table = document.getElementById("itemList");
    let row = table.insertRow();
    row.innerHTML = `
      <td><input type="text" class="form-control" placeholder="Item Name"></td>
      <td><input type="number" class="form-control price" oninput="calculateTotal()"></td>
      <td><input type="number" class="form-control qty" oninput="calculateTotal()"></td>
      <td class="total">0</td>
      <td><button class="btn btn-danger" onclick="removeItem(this)">Remove</button></td>
    `;
  }

  function calculateTotal() {
    let rows = document.querySelectorAll("#itemList tr");
    let totalAmount = 0;
    rows.forEach(row => {
      let price = row.querySelector(".price").value || 0;
      let qty = row.querySelector(".qty").value || 0;
      let total = price * qty;
      row.querySelector(".total").innerText = total;
      totalAmount += total;
    });
    document.getElementById("totalAmount").value = totalAmount;
    calculateFinalTotal();
  }

  function removeItem(button) {
    button.closest("tr").remove();
    calculateTotal();
  }

  function calculateFinalTotal() {
    let total = parseFloat(document.getElementById("totalAmount").value) || 0;
    let discount = parseFloat(document.getElementById("discount").value) || 0;
    let cgst = parseFloat(document.getElementById("cgst").value) || 0;
    let sgst = parseFloat(document.getElementById("sgst").value) || 0;

    let discountedTotal = total - (total * (discount / 100));
    let taxAmount = discountedTotal * ((cgst + sgst) / 100);
    document.getElementById("finalAmount").value = (discountedTotal + taxAmount).toFixed(2);
  }
</script>

<style>
@media print {
  .container {
    width: 100%;
    max-width: 100%;
    padding: 10px;
    font-size: 12px;
    border: none;
  }
  .no-print, button {
    display: none !important;
  }
  input {
    border: none;
    background: transparent;
  }
  .row {
    display: flex;
    flex-wrap: wrap;
  }
  .col-md-6 {
    width: 48%;
    display: inline-block;
  }
}
</style>


    </main>

    <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sidebar Toggler Script -->
    <script src="<?php echo base_url() . 'assets/js/main.js' ?>"></script>
</body>

</html>