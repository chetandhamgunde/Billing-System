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

	

	<!-- Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

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
		<div class="site-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="container">

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
    <label for="">Select Tables:</label>
	<select class="form-multi-select form-control" id="tableSelect" multiple data-coreui-search="global">
        <!-- Options will be added dynamically -->
    </select>
       
	<style>
    .selected-table {
        position: relative;
        background: #f8f9fa;
        border-radius: 5px;
        display: inline-block;
        font-size: 14px;
        border: 1px solid #ddd;
        max-width: 150px;
        text-align: center;
        margin: 2px;
    }

    .remove-table {
        position: absolute;
        top: -5px;
        right: -5px;
        background: red;
        color: white;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
        border-radius: 50%;
        cursor: pointer;
    }

    .remove-table:hover {
        background: darkred;
    }
	</style>
    <!-- <button class="btn btn-primary mt-2" onclick="addTable()">Add Tables</button> -->

    <h4 class="mt-3">Selected Tables:</h4>
    <div id="selectedTables" class="row"></div>
</div>


								<div class="col-md-6 mb-2">
									<label>Date & Time:</label>
									<input type="datetime-local" class="form-control clear-field" id="datetime">
								</div>
								<div class="col-md-6 mb-2">
									<label>Waiter:</label>
									<input type="text" id="waiterName" class="form-control clear-field" placeholder="Enter waiter name">
								</div>
								<div class="col-md-6 mb-2">
									<label>Total Amount:</label>
									<input type="text" id="totalAmount" class="form-control clear-field" placeholder="Enter total Amount">
								</div>
								<div class="col-md-6 mb-2">
									<label>Discount %:</label>
									<input type="number" placeholder="discount" min="0" max="100" id="discount" class="form-control clear-field" oninput="validateDiscount(this); calculateFinalTotal(); updateDiscountMessage();">
									<small id="discountMessage" class="text-muted"></small> <!-- Message area -->
								</div>
								<!-- SCRIPT TO VALIDTAE AND SHOW THE DISCOUNT IN RUPEES -->
								<script>
									function validateDiscount(input) {
										if (input.value < 0) {
											input.value = 0;
										} else if (input.value > 100) {
											input.value = 100;
										}
									}

									function updateDiscountMessage() {
										let discountPercent = parseFloat(document.getElementById("discount").value) || 0;
										let totalAmount = parseFloat(document.getElementById("totalAmount")?.value) || 0;
										let discountAmount = (discountPercent / 100) * totalAmount;
										let discountMessage = document.getElementById("discountMessage");

										if (totalAmount > 0) {
											discountMessage.innerText = `Discount in ₹: ${discountAmount.toFixed(2)}`;
											discountMessage.style.display = "block"; // Show message when totalAmount > 0
										} else {
											discountMessage.style.display = "none"; // Hide message when no items are added
										}
									}
								</script>
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
									<button class="btn btn-warning no-print" onclick="addItem(); ">Add Item</button>
								</div>
								<div class="col-md-6 bg-light p-3 rounded">
									<h6>Tax Details</h6>
									<div class="row">
										<div class="col-md-6">
											<label>CGST %:</label>
											<input type="number" placeholder="CGST" id="cgst" class="form-control clear-field" oninput="calculateFinalTotal()">
										</div>
										<div class="col-md-6">
											<label>SGST %:</label>
											<input type="number" placeholder="SGST" id="sgst" class="form-control clear-field" oninput="calculateFinalTotal()">
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
								<button class="btn btn-warning" onclick="printBill()">Print Invoice</button>
								<button class="btn btn-light border" onclick="clearFields()">Clear</button>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
	</main>



	<!-- Include SweetAlert2 CDN -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




	<script>
		function validateInvoice() {
			let billNo = document.getElementById("billNo").value.trim();
			let dateTime = document.getElementById("datetime").value.trim();
			let waiterName = document.querySelector("input[placeholder='Enter waiter name']").value.trim();
			let totalAmount = document.getElementById("totalAmount").value.trim();
			let discount = document.getElementById("discount").value.trim() || 0;
			let cgst = document.getElementById("cgst").value.trim() || 0;
			let sgst = document.getElementById("sgst").value.trim() || 0;
			let finalAmount = document.getElementById("finalAmount").value.trim();

			let tableIds = Array.from(document.querySelectorAll("#selectedTables span")).map(span => span.dataset.tableId);
			let items = getSelectedItems();

			if (!billNo) {
				Swal.fire("Warning", "Bill number is required!", "warning");
				return false;
			}
			if (!dateTime) {
				Swal.fire("Warning", "Date & Time is required!", "warning");
				return false;
			}
			if (!waiterName) {
				Swal.fire("Warning", "Waiter name is required!", "warning");
				return false;
			}
			if (!totalAmount || isNaN(totalAmount)) {
				Swal.fire("Warning", "Enter a valid total amount!", "warning");
				return false;
			}
			if (tableIds.length === 0) {
				Swal.fire("Warning", "Select at least one table!", "warning");
				return false;
			}
			if (items.length === 0) {
				Swal.fire("Warning", "Add at least one item to the invoice!", "warning");
				return false;
			}
			if (isNaN(discount) || isNaN(cgst) || isNaN(sgst)) {
				Swal.fire("Warning", "Invalid tax or discount values!", "warning");
				return false;
			}

			return {
				bill_no: billNo,
				date_time: dateTime,
				waiter_name: waiterName,
				total_amount: totalAmount,
				discount: discount,
				cgst: cgst,
				sgst: sgst,
				final_amount: finalAmount,
				table_ids: tableIds.join(","),
				items: JSON.stringify(items)
			};
		}



		function updateItemTotal(input) {
			let row = input.closest("tr");
			let price = parseFloat(row.querySelector(".price").innerText);
			let quantity = parseInt(input.value);
			row.querySelector(".total").innerText = price * quantity;
			calculateFinalTotal();
		}


		function clearFields() {
    Swal.fire({
        title: "Are you sure?",
        text: "This will clear all fields!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, clear it!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelectorAll(".clear-field").forEach(field => field.value = "");
            document.getElementById("selectedTables").innerHTML = "";
            document.getElementById("itemList").innerHTML = "";
            document.getElementById("finalAmount").value = "";
            selectedTables = [];
            Swal.fire("Cleared!", "All fields have been cleared.", "success");
        }
    });
}

	</script>

	<script>
		function calculateFinalTotal() {
			let total = parseFloat(document.getElementById("totalAmount").value) || 0;
			let cgstRate = parseFloat(document.getElementById("cgst").value) || 0;
			let sgstRate = parseFloat(document.getElementById("sgst").value) || 0;

			let cgstAmount = ((total * cgstRate) / 100).toFixed(2);
			let sgstAmount = ((total * sgstRate) / 100).toFixed(2);
			let finalAmount = (total + parseFloat(cgstAmount) + parseFloat(sgstAmount)).toFixed(2);

			document.getElementById("finalAmount").value = finalAmount;
		}

		function calculateTotal() {
			let rows = document.querySelectorAll("#itemList tr");
			let totalAmount = 0;

			rows.forEach(row => {
				let price = parseFloat(row.querySelector(".price").value) || 0;
				let qty = parseInt(row.querySelector(".qty").value) || 1;
				let total = price * qty;

				row.querySelector(".total").value = total.toFixed(2);
				totalAmount += total;
			});

			// Ensure the total amount is updated correctly
			document.getElementById("totalAmount").value = totalAmount.toFixed(2);

			// Call final calculation function to update finalAmount
			calculateFinalTotal();
			updateDiscountMessage();
		}

		function generateInvoiceNo() {
			const timestamp = Date.now(); // Get current timestamp
			const randomNum = Math.floor(1000 + Math.random() * 9000); // Generate a random 4-digit number
			return `INV-${timestamp}-${randomNum}`; // Format: INV-1707993384785-1234
		}
	</script>
	<!-- SCRIPT TO ADD ITEMS -->
	<script>
		// Auto-generate Bill Number on page load
		document.addEventListener("DOMContentLoaded", function() {

			document.getElementById("billNo").value = "BILL-" + new Date().toISOString().slice(0, 10).replace(/-/g, "") + "-" + Math.floor(Math.random() * 1000);
		});

		// Clear all input fields
		// function clearFields() {
		// 	document.querySelectorAll('.clear-field').forEach(field => field.value = '');
		// }

		// Load menu items from PHP (Ensure PHP echoes valid JSON)
		let menuItems = <?php echo json_encode($menus); ?>;

		console.log(menuItems)


		// Function to dynamically add items
		function addItem() {

			let table = document.getElementById("itemList");
			let row = table.insertRow();

			// Generate options from menuItems array
			let itemOptions = menuItems
				.map(item => `<option value="${item.id}" data-price="${item.price}">${item.name}</option>`)
				.join("");

			row.innerHTML = `
        <td>
            <select class="form-control item-select" onchange="updatePrice(this)">
                <option value="">Select Item</option>
                ${itemOptions}
            </select>
        </td>
        <td><input type="number" class="form-control price" readonly></td>
        <td><input type="number" class="form-control qty" min="1" value="1" oninput="calculateTotal()"></td>
        <td><input type="number" class="form-control total" readonly></td>
        <td><button class="btn btn-danger" onclick="removeItem(this)">Remove</button></td>
    `;
			updateDiscountMessage();
		}



		// Function to update price when item is selected
		function updatePrice(selectElement) {
			let selectedItemId = selectElement.value; // Get selected item ID
			let priceField = selectElement.closest("tr").querySelector(".price");
			let totalField = selectElement.closest("tr").querySelector(".total");
			let qtyField = selectElement.closest("tr").querySelector(".qty");

			// Find the selected item in the menuItems array
			let selectedItem = menuItems.find(item => item.id === selectedItemId);

			if (selectedItem) {
				let price = parseFloat(selectedItem.price); // Convert to number
				priceField.value = price.toFixed(2);
				totalField.value = (price * qtyField.value).toFixed(2);
			} else {
				priceField.value = "";
				totalField.value = "";
			}
			calculateTotal();
			updateDiscountMessage();
		}

		// Function to remove an item row
		function removeItem(button) {
			button.closest("tr").remove();
			calculateTotal();
			updateDiscountMessage();
		}

		// Function to calculate final total with discount and taxes
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

	<!-- SCRIPT TO ADD TABLE -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
	<script>
		  let tables = <?php echo json_encode($tables); ?>;
    let selectedTables = [];

    let tableDropdown = document.getElementById("tableSelect");
    let selectedTableList = document.getElementById("selectedTables");

    // Populate dropdown with table options
    tables.forEach(table => {
        let option = document.createElement("option");
        option.value = table.id;
        option.textContent = `${table.table_number} (Seats: ${table.seats})`;
        tableDropdown.appendChild(option);
    });

    // Detect selection change
    tableDropdown.addEventListener("change", function () {
        let selectedOptions = [...this.selectedOptions];
        let newTableIds = selectedOptions.map(option => option.value);

        newTableIds.forEach(tableId => {
            // Avoid adding duplicate tables
            let existingTables = Array.from(document.querySelectorAll("#selectedTables .card-title"))
                                      .map(el => el.dataset.id);
            if (!existingTables.includes(tableId)) {
                let table = tables.find(t => t.id == tableId);

                // Create table item
                let tableItem = document.createElement("div");
                tableItem.classList.add("selected-table");
                tableItem.dataset.id = tableId;
                tableItem.innerHTML = `
                    <span class="remove-table" onclick="removeTable('${tableId}')">&times;</span>
                    <h6 class="card-title" data-id="${tableId}">${table.table_number}</h6>
                    <p class="card-text">Seats: ${table.seats}</p>
                `;
                selectedTableList.appendChild(tableItem);
            }
        });
    });

    // Remove selected table
    function removeTable(tableId) {
        document.querySelector(`div[data-id='${tableId}']`).remove();

        // Unselect from dropdown
        [...tableDropdown.options].forEach(option => {
            if (option.value == tableId) option.selected = false;
        });
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

			.no-print,
			button {
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




	<script>
		function printBill() {
			console.log("Starting printBill...");
			const basePath = <?php echo json_encode(base_url()); ?>; // Ensure this is properly embedded

			// Mapping table_number to table_id
			const tableMapping = <?php echo json_encode($tables); ?>;

			// Capture the selected table numbers and map them to table IDs
			let tableNumbers = Array.from(document.querySelectorAll("#selectedTables .card-title"))
				.map(el => el.innerText); // Get the selected table numbers (e.g., M-1, G-2, etc.)

			// Map table numbers to table IDs
			let tableIds = tableNumbers.map(tableNumber => {
				let table = tableMapping.find(t => t.table_number === tableNumber);
				return table ? table.id : null;
			}).filter(id => id !== null); // Filter out any invalid table ids (in case of unmatched table numbers)

			if (tableIds.length === 0) {
				Swal.fire("Error", "Please select at least one table", "error");
				return;
			}

			// Capture the item IDs only and map them to menu IDs
			let items = [];
			document.querySelectorAll("#itemList tr").forEach(row => {
				let selectElement = row.querySelector(".item-select"); // Get the select dropdown
				let priceInput = row.querySelector(".price"); // Price input field
				let qtyInput = row.querySelector(".qty"); // Quantity input field
				let totalInput = row.querySelector(".total"); // Total price input field

				if (!selectElement || !priceInput || !qtyInput || !totalInput) {
					return; // Skip iteration if any element is missing
				}

				let itemId = selectElement.value;
				let itemPrice = parseFloat(priceInput.value) || 0;
				let quantity = parseInt(qtyInput.value) || 1;
				let totalPrice = itemPrice * quantity; // Calculate total price per item

				if (itemId) {
					items.push({
						menu_id: itemId,
						quantity: quantity,
						item_price: itemPrice,
						total_price: totalPrice
					});
				}
			});

			if (items.length === 0) {
				Swal.fire("Error", "Please select at least one item", "error");
				return;
			}

			console.log("Selected Items:", items);

			// Calculate total amounts AFTER collecting all items
			let totalAmount = items.reduce((sum, item) => sum + item.total_price, 0);
			let discountRate = parseFloat(document.getElementById("discount").value) || 0;
			let discount = (discountRate / 100) * totalAmount; // Convert percentage to rupees

			let cgstRate = parseFloat(document.getElementById("cgst").value) || 0;
			let sgstRate = parseFloat(document.getElementById("sgst").value) || 0;

			let cgstAmount = parseFloat(((cgstRate / 100) * totalAmount).toFixed(2));
			let sgstAmount = parseFloat(((sgstRate / 100) * totalAmount).toFixed(2));
			let finalAmount = parseFloat((totalAmount - discount + cgstAmount + sgstAmount).toFixed(2));



			const waiter_name = document.getElementById('waiterName').value;
			console.log("Waiter name:", waiter_name);

			// Prepare the invoice data object
			let invoiceData = {
				bill_no: generateInvoiceNo(),
				date_time: new Date().toLocaleString(),
				table_ids: tableIds,
				items: items,
				total_amount: totalAmount.toFixed(2),
				discount: discount.toFixed(2),
				cgst: cgstAmount.toFixed(2),
				sgst: sgstAmount.toFixed(2),
				final_amount: finalAmount.toFixed(2),
				waiter_name: waiter_name
			};

			console.log("Invoice Data:", invoiceData);

			console.log("Total:", totalAmount);
			console.log("Discount:", discount);
			console.log("CGST:", cgstAmount);
			console.log("SGST:", sgstAmount);
			console.log("Final Amount:", finalAmount);


			fetch(`${basePath}/user/createInvoice`, {
					method: "POST",
					headers: {
						"Content-Type": "application/json"
					},
					body: JSON.stringify(invoiceData)
				})
				.then(response => response.json())
				.then(data => {
					if (data.status === "success") {
						console.log("Invoice created successfully");
						printInvoiceBill();

					} else {
						Swal.fire("Error", "Error: " + data.message, "error");
					}
				})
				.catch(error => {
					console.error("Error:", error);
					Swal.fire("Error", "Failed to save invoice!", "error");
				});
		}


		function printInvoiceBill() {
			console.log("Invoice printing...");

			let tableElements = document.querySelectorAll("#selectedTables .card-title");
			let tableNumbers = Array.from(tableElements).map(el => el.innerText).join(", ") || "Not Selected";
			let totalAmount = parseFloat(document.getElementById("totalAmount")?.value) || 0;
			let cgstRate = parseFloat(document.getElementById("cgst")?.value) || 0;
			let sgstRate = parseFloat(document.getElementById("sgst")?.value) || 0;

			let discountRate = parseFloat(document.getElementById("discount")?.value) || 0;
			let discount = (discountRate / 100) * totalAmount; // Convert percentage to rupees

			let discountedTotal = totalAmount - discount; // Amount after applying discount

			// ✅ Now, calculate CGST and SGST on the discounted total
			let cgstAmount = ((cgstRate / 100) * discountedTotal).toFixed(2);
			let sgstAmount = ((sgstRate / 100) * discountedTotal).toFixed(2);

			let finalAmount = (discountedTotal + parseFloat(cgstAmount) + parseFloat(sgstAmount)).toFixed(2);


			let invoiceNo = generateInvoiceNo();
			let dateTime = new Date().toLocaleString();

			// Extracting items from the dynamically added table rows
			let itemTable = document.getElementById("itemList");
			let itemRows = "";

			if (itemTable) {
				let rows = itemTable.getElementsByTagName("tr");
				for (let i = 0; i < rows.length; i++) {
					let cells = rows[i].getElementsByTagName("td");
					if (cells.length >= 5) {
						let srNo = i + 1;
						let description = cells[0].querySelector("select option:checked")?.textContent || "N/A";
						let qty = cells[2].querySelector("input").value;
						let rate = cells[1].querySelector("input").value;
						let amount = cells[3].querySelector("input").value;

						itemRows += `
                    <tr>
                        <td>${srNo}</td>
                        <td>${description}</td>
                        <td>${qty}</td>
                        <td>${rate}</td>
                        <td>${amount}</td>
                    </tr>`;
					}
				}
			}

			// HTML content for the bill
			let billContent = `<html>
				<head>
					<title>Invoice Bill</title>
					<style>
						body { font-family: Arial, sans-serif; padding: 10px; text-align: center; }
						h4, h5, h6 { margin-bottom: 5px; }
						hr { border-top: 1px dashed black; margin: 10px 0; }
						table { width: 100%; border-collapse: collapse; margin-top: 10px; }
						th, td { border-bottom: 1px solid black; padding: 5px; text-align: center; }
						.text-right { text-align: right; }
						.fw-bold { font-weight: bold; }
						.fs-sm { font-size: 12px; }
					</style>
				</head>
				<body>
					<h4><strong>Bunty Luthra's</strong></h4>
					<h5>HARI-OM DHABA</h5>
					<p>A PURE VEG RESTAURANT</p>
					<p>872, Pethenagar, Mumbai Agra Road, Nashik-9.</p>
					<p>Phone: (0253)-2328007, 9860468258</p>
					<hr>
					<p><strong>Bill No:</strong> ${invoiceNo}</p>
					<p><strong>Date & Time:</strong> ${dateTime}</p>
					<p><strong>Table No(s):</strong> ${tableNumbers}</p>
					<hr>
					<table>
						<thead>
							<tr>
								<th>Sr.</th>
								<th>Description</th>
								<th>Qty</th>
								<th>Rate</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							${itemRows}
						</tbody>
					</table>
					
					<p class="text-right"><strong>Food Amount:</strong> ₹${totalAmount.toFixed(2)}</p>
					<p class="text-right"><strong>Discount:</strong> ₹${discount.toFixed(2)}</p>
					<p class="text-right"><strong>CGST (${cgstRate}%):</strong> ₹${cgstAmount}</p>
					<p class="text-right"><strong>SGST (${sgstRate}%):</strong> ₹${sgstAmount}</p>
					<hr>
					<p class="fw-bold">Total Amount: ₹${finalAmount}</p>
					<hr>
					<p class="fs-sm"><strong>FASSI NO:</strong> 123456789</p>
					<p class="fs-sm"><strong>GST NO:</strong> 27ABCDE1234F1Z5</p>
					<p class="fs-sm"><strong>HSN/SAC:</strong> 9986</p>
					<p class="fs-sm">THANK YOU, VISIT AGAIN!</p>
				</body>
			</html>`;

			// Open a new window and print the bill
			let billWindow = window.open("", "_blank", "width=400,height=600");
			billWindow.document.open();
			billWindow.document.write(billContent);

			billWindow.onload = function() {
				billWindow.print();
				setTimeout(() => {
					billWindow.close();
				}, 500);
			};
			billWindow.document.close();
			location.reload();
		}
	</script>



	</main>


	<!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Sidebar Toggler Script -->
	<script src="<?php echo base_url() . 'assets/js/main.js' ?>"></script>


</body>

</html>

<!-- <p>(Rs. ${document.getElementById("finalAmountWords").value || "ZERO"} Only)</p> -->