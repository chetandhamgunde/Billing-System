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
        <div class="site-section">
            <div class="container mt-4">
                <h2 class="text-center">Sales Report</h2>
                <h5 class="text-center">From <span id="reportStartDate"></span> to <span id="reportEndDate"></span></h5>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="startDate">Start Date:</label>
                        <input type="date" id="startDate" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="endDate">End Date:</label>
                        <input type="date" id="endDate" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <button class="btn btn-primary w-100" onclick="fetchInvoices()">Generate Report</button>
                    </div>
                </div>

                <table id="invoiceTable" class="table table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Month</th>
                            <th>Taxable Amount</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <th>Gross Amount</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <div class="d-flex justify-content-end gap-3">
                    <button class="btn btn-success" onclick="exportToPDF()">Export to PDF</button>
                    <button class="btn btn-warning" onclick="exportToExcel()">Export to Excel</button>
                </div>
            </div>

            <!-- SCRIPT DISPLYING DATA -->
            <script>
                function fetchInvoices() {
                    let startDate = document.getElementById("startDate").value;
                    let endDate = document.getElementById("endDate").value;
                    const baseUrl = "<?php echo base_url(); ?>";

                    fetch(`${baseUrl}/admin/getInvoicesByDateRange`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                from_date: startDate,
                                to_date: endDate
                            })
                        })
                        .then(response => response.json())
                        .then(response => {
                            let tableBody = document.querySelector("#invoiceTable tbody");
                            tableBody.innerHTML = ""; // Clear previous data

                            document.getElementById("reportStartDate").innerText = startDate;
                            document.getElementById("reportEndDate").innerText = endDate;

                            let totalTaxable = 0,
                                totalCGST = 0,
                                totalSGST = 0,
                                totalGross = 0;

                            if (response.status === "success" && response.data.length > 0) {
                                response.data.forEach(sale => {
                                    if (sale.month.toLowerCase() === "total") {
                                        return; // Skip any existing "Total" row from API response
                                    }

                                    let taxable = parseFloat(sale.taxable_amount) || 0;
                                    let cgst = parseFloat(sale.cgst_amount) || 0;
                                    let sgst = parseFloat(sale.sgst_amount) || 0;
                                    let gross = parseFloat(sale.gross_amount) || 0;

                                    totalTaxable += taxable;
                                    totalCGST += cgst;
                                    totalSGST += sgst;
                                    totalGross += gross;

                                    let row = `<tr>
                        <td>${sale.month}</td>
                        <td>₹${taxable.toFixed(2)}</td>
                        <td>₹${cgst.toFixed(2)}</td>
                        <td>₹${sgst.toFixed(2)}</td>
                        <td>₹${gross.toFixed(2)}</td>
                    </tr>`;
                                    tableBody.innerHTML += row;
                                });

                                // Remove any existing total row before adding a new one
                                let existingTotalRow = document.querySelector("#invoiceTable tbody tr:last-child");
                                if (existingTotalRow && existingTotalRow.innerText.includes("Total")) {
                                    existingTotalRow.remove();
                                }

                                // Add total row
                                tableBody.innerHTML += `
                    <tr><td colspan="5" style="border-top: 2px solid black;"></td></tr>
                    <tr style="font-weight: bold; background: #f8f9fa;">
                        <td>Total</td>
                        <td>₹${totalTaxable.toFixed(2)}</td>
                        <td>₹${totalCGST.toFixed(2)}</td>
                        <td>₹${totalSGST.toFixed(2)}</td>
                        <td>₹${totalGross.toFixed(2)}</td>
                    </tr>`;
                            } else {
                                tableBody.innerHTML = `<tr>
                    <td colspan="5" class="text-center text-danger">No data found</td>
                </tr>`;
                            }
                        })
                        .catch(error => {
                            console.error("Error fetching sales report:", error);
                        });
                }
            </script>

            

            <script>
                function exportToPDF() {
                    const {
                        jsPDF
                    } = window.jspdf;
                    let doc = new jsPDF();

                    doc.setFont("courier", "normal");

                    let pageWidth = doc.internal.pageSize.width; // Get page width
                    let margin = 10;
                    let contentWidth = pageWidth - 2 * margin; // Ensure full table width
                    let y = 10;

                    function centerText(text, y, isBold = false, fontSize = 12) {
                        doc.setFont("courier", isBold ? "bold" : "normal");
                        doc.setFontSize(fontSize);
                        let textWidth = doc.getTextWidth(text);
                        let x = margin + (contentWidth - textWidth) / 2; // Center the text
                        doc.text(text, x, y);
                    }

                    function drawText(text, x, y, isBold = false, fontSize = 10) {
                        doc.setFont("courier", isBold ? "bold" : "normal");
                        doc.setFontSize(fontSize);
                        doc.text(text, x, y);
                    }

                    // Title
                    centerText("HARI-OM DHABA", y, true, 14);
                    y += 8;
                    centerText(`Sales Report From ${document.getElementById("reportStartDate").innerText} to ${document.getElementById("reportEndDate").innerText}`, y, false, 10);
                    y += 6;

                    // Table Headers
                    let colWidths = [40, 35, 35, 35, 40]; // Column widths
                    let colX = [margin, margin + colWidths[0], margin + colWidths[0] + colWidths[1], margin + colWidths[0] + colWidths[1] + colWidths[2], margin + colWidths[0] + colWidths[1] + colWidths[2] + colWidths[3]];

                    // Full width separator
                    drawText("------------------------------------------------------------------------------", margin, y);
                    y += 6;
                    drawText("Month", colX[0], y, true);
                    drawText("Taxable Amt", colX[1], y, true);
                    drawText("CGST Amt", colX[2], y, true);
                    drawText("SGST Amt", colX[3], y, true);
                    drawText("Gross Amt", colX[4], y, true);
                    y += 5;
                    drawText("------------------------------------------------------------------------------", margin, y);
                    y += 6;

                    let rows = document.querySelectorAll("#invoiceTable tbody tr");
                    let totalRow = null;

                    rows.forEach(row => {
                        let cells = row.querySelectorAll("td");
                        if (cells.length < 5) return;

                        let rowData = Array.from(cells).map(cell => cell.innerText.trim().replace("₹", ""));

                        if (rowData[0] === "Total") {
                            totalRow = rowData;
                            return;
                        }

                        // Print each column at aligned positions
                        drawText(rowData[0], colX[0], y);
                        drawText(rowData[1], colX[1], y);
                        drawText(rowData[2], colX[2], y);
                        drawText(rowData[3], colX[3], y);
                        drawText(rowData[4], colX[4], y);

                        y += 6;
                    });

                    if (totalRow) {
                        drawText("------------------------------------------------------------------------------", margin, y);
                        y += 6;

                        // Print the total row in **bold**
                        drawText(totalRow[0], colX[0], y, true);
                        drawText(totalRow[1], colX[1], y, true);
                        drawText(totalRow[2], colX[2], y, true);
                        drawText(totalRow[3], colX[3], y, true);
                        drawText(totalRow[4], colX[4], y, true);
                    }

                    doc.save("sales_report.pdf");
                }

                function exportToExcel() {
                    let table = document.getElementById("invoiceTable");
                    let wb = XLSX.utils.table_to_book(table, {
                        sheet: "Sheet1"
                    });
                    XLSX.writeFile(wb, "sales_report.xlsx");
                }
            </script>





            <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <!-- Sidebar Toggler Script -->
            <script src="<?php echo base_url() . 'assets/js/main.js' ?>"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

</body>

</html>