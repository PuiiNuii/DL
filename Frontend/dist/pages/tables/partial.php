<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ice Sales Records</title>
  <style>
    :root {
      --primary-color: #3498db;
      --secondary-color: #2980b9;
      --light-gray: #f8f9fa;
      --medium-gray: #e9ecef;
      --dark-gray: #495057;
      --success-color: #28a745;
      --danger-color: #dc3545;
      --warning-color: #ffc107;
      --info-color: #17a2b8;
      --border-radius: 8px;
      --box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
      --spacing: 28px;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fa;
      color: #333;
      margin: 0;
      padding: 0;
      line-height: 1.6;
    }

    .ice-sales-container {
      max-width: 1600px;
      margin: 0 auto;
      padding: var(--spacing);
    }

    .card {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      padding: var(--spacing);
      margin-bottom: var(--spacing);
    }

    .section-title {
      color: #2c3e50;
      margin-top: 0;
      margin-bottom: 25px;
      font-size: 1.8rem;
      font-weight: 600;
      border-bottom: 2px solid var(--medium-gray);
      padding-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .section-title span {
      display: inline-block;
      font-size: 1.4rem;
      font-weight: 400;
      color: var(--dark-gray);
    }

    .form-row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 20px;
    }

    .form-group {
      flex: 1;
      min-width: 240px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--dark-gray);
      font-size: 0.95rem;
    }

    .form-control {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid var(--medium-gray);
      border-radius: var(--border-radius);
      font-size: 15px;
      transition: all 0.3s;
      background-color: var(--light-gray);
    }

    .form-control:focus {
      border-color: var(--primary-color);
      outline: none;
      background-color: white;
      box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .ice-type-section {
      margin: 30px 0;
      padding: 25px;
      background: var(--light-gray);
      border-radius: var(--border-radius);
    }

    .ice-type-section h4 {
      margin-top: 0;
      margin-bottom: 20px;
      color: #34495e;
      font-size: 1.2rem;
      font-weight: 600;
    }

    .ice-type-group {
      background: white;
      padding: 20px;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
    }

    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: var(--border-radius);
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s;
      font-size: 1rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 0.9rem;
    }

    .btn-primary {
      background-color: var(--primary-color);
      color: white;
    }

    .btn-primary:hover {
      background-color: var(--secondary-color);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
      background-color: var(--medium-gray);
      color: var(--dark-gray);
    }

    .btn-secondary:hover {
      background-color: #d6d8db;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-danger {
      background-color: var(--danger-color);
      color: white;
    }

    .btn-danger:hover {
      background-color: #c82333;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-success {
      background-color: var(--success-color);
      color: white;
    }

    .btn-success:hover {
      background-color: #218838;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-info {
      background-color: var(--info-color);
      color: white;
    }

    .btn-info:hover {
      background-color: #138496;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-warning {
      background-color: var(--warning-color);
      color: #212529;
    }

    .btn-warning:hover {
      background-color: #e0a800;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .ice-sales-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 25px;
      font-size: 0.95rem;
    }

    .ice-sales-table th,
    .ice-sales-table td {
      padding: 15px 18px;
      text-align: center;
      border: 1px solid var(--medium-gray);
    }

    .ice-sales-table th {
      background-color: var(--primary-color);
      color: white;
      font-weight: 600;
      position: sticky;
      top: 0;
      font-size: 1rem;
    }

    .ice-sales-table tr:nth-child(even) {
      background-color: var(--light-gray);
    }

    .ice-sales-table tr:hover {
      background-color: #e9f7fe;
    }

    .total-row {
      background-color: #e3f2fd;
      font-weight: bold;
    }

    .date-header-row {
      background-color: #2c3e50;
      color: white;
      font-weight: bold;
    }

    .month-header-row {
      background-color: #34495e;
      color: white;
      font-weight: bold;
    }

    /* Updated ice type display styles - cleaner and centered */
    .ice-type-display {
      display: flex;
      flex-direction: column;
      gap: 6px;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .ice-type-display div {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .ice-type-display .original {
      color: var(--primary-color);
      font-weight: 500;
    }

    .ice-type-display .large {
      color: var(--danger-color);
      font-weight: 500;
    }

    .ice-type-display .small {
      color: var(--success-color);
      font-weight: 500;
    }

    /* Updated centered number display styles */
    .quantity-display, 
    .price-display, 
    .total-display {
      display: flex;
      flex-direction: column;
      gap: 6px;
      padding: 6px 0;
      text-align: center;
    }

    .quantity-display div, 
    .price-display div, 
    .total-display div {
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 3px 0;
    }

    /* Column width adjustments */
    .ice-sales-table td:nth-child(1) { width: 5%; } /* No. */
    .ice-sales-table td:nth-child(2) { width: 15%; } /* Name */
    .ice-sales-table td:nth-child(3) { width: 15%; min-width: 130px; } /* Ice type */
    .ice-sales-table td:nth-child(4),
    .ice-sales-table td:nth-child(5),
    .ice-sales-table td:nth-child(6) { width: 12%; min-width: 110px; } /* Qty, Price, Total */
    .ice-sales-table td:nth-child(7),
    .ice-sales-table td:nth-child(8),
    .ice-sales-table td:nth-child(9),
    .ice-sales-table td:nth-child(10) { width: 8%; } /* Debt columns */
    .ice-sales-table td:nth-child(11) { width: 8%; } /* Expenses */
    .ice-sales-table td:nth-child(12) { width: 10%; } /* Total */
    .ice-sales-table td:nth-child(13) { width: 10%; } /* Actions */

    /* New clean table styling */
    .table-responsive {
      border-radius: var(--border-radius);
      overflow: hidden;
      border: 1px solid var(--medium-gray);
    }

    /* Search Section */
    .search-section {
      margin-top: 35px;
      background-color: #f0f8ff;
      border-left: 4px solid var(--primary-color);
      padding: 25px;
    }

    .search-actions {
      display: flex;
      gap: 15px;
    }

    .search-actions .form-group {
      flex: 3;
      margin-bottom: 0;
    }

    .search-actions .btn-group {
      flex: 2;
      display: flex;
      gap: 15px;
    }

    .search-actions .btn {
      flex: 1;
    }

    /* Action buttons container */
    .action-buttons {
      display: flex;
      gap: 8px;
      justify-content: center;
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: white;
      padding: 30px;
      border-radius: var(--border-radius);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
      width: 90%;
      max-width: 650px;
      max-height: 90vh;
      overflow-y: auto;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 1px solid var(--medium-gray);
    }

    .modal-title {
      margin: 0;
      font-size: 1.4rem;
      color: var(--primary-color);
      font-weight: 600;
    }

    .close-modal {
      background: none;
      border: none;
      font-size: 1.8rem;
      cursor: pointer;
      color: var(--dark-gray);
      transition: transform 0.2s;
    }

    .close-modal:hover {
      transform: scale(1.1);
    }

    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 15px;
      margin-top: 25px;
      padding-top: 20px;
      border-top: 1px solid var(--medium-gray);
    }

    /* Confirmation dialog */
    .confirmation-dialog {
      text-align: center;
    }

    .confirmation-dialog p {
      margin-bottom: 25px;
      font-size: 1.2rem;
      line-height: 1.6;
    }

    /* Report controls */
    .report-controls {
      display: flex;
      gap: 15px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .report-controls .form-group {
      min-width: 200px;
    }

    /* Responsive adjustments */
    @media (max-width: 1200px) {
      .ice-sales-container {
        padding: 20px;
      }
      
      .card {
        padding: 25px;
      }
    }

    @media (max-width: 992px) {
      .form-group {
        min-width: 200px;
      }
      
      .action-buttons {
        flex-direction: column;
        gap: 6px;
      }
    }

    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
        gap: 15px;
      }
      
      .form-group {
        min-width: 100%;
      }
      
      .ice-sales-table {
        display: block;
        overflow-x: auto;
      }
      
      .ice-type-section {
        padding: 20px;
      }

      .search-actions {
        flex-direction: column;
      }

      .search-actions .btn-group {
        width: 100%;
      }

      .search-actions .btn {
        width: 100%;
      }
      
      .modal-content {
        width: 95%;
        padding: 20px;
      }

      .section-title {
        font-size: 1.5rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
      }

      .section-title span {
        font-size: 1.2rem;
      }

      .report-controls {
        flex-direction: column;
      }
    }

    /* Animation for better UX */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .card {
      animation: fadeIn 0.3s ease-out;
    }
    
    tr {
      transition: background-color 0.2s;
    }

    .no-results {
      text-align: center;
      padding: 25px;
      color: var(--danger-color);
      font-weight: bold;
      font-size: 1.1rem;
    }

    /* Title layout improvements */
    .title-line {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .title-line span {
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class="ice-sales-container">
    <!-- Input Form Section -->
    <div class="card form-section">
      <h3 class="section-title">
        <span class="title-line">Add New Ice Sale Entry</span>
      </h3>
      <form id="iceSaleForm" class="ice-form">
        <input type="hidden" id="saleId" value="">
        <div class="form-row">
          <div class="form-group">
            <label for="customerName">គោត្តនាម (Customer Name)</label>
            <input type="text" class="form-control" id="customerName" required>
          </div>
          <div class="form-group">
            <label for="saleDate">កាលបរិច្ឆេទ (Date)</label>
            <input type="date" class="form-control" id="saleDate" required>
          </div>
        </div>

        <div class="ice-type-section">
          <h4>Ice Types</h4>
          <div class="form-row">
            <div class="form-group ice-type-group">
              <label for="iceTypeOriginal">ទឹកកកដើម (Original Ice)</label>
              <input type="number" step="0.1" class="form-control" id="iceTypeOriginal" value="" placeholder="ចំណួន">
              <label for="unitPriceOriginal">តម្លៃរាយ (Unit Price)</label>
              <input type="number" class="form-control" id="unitPriceOriginal" placeholder="តម្លៃ" required>
            </div>
            <div class="form-group ice-type-group">
              <label for="iceTypeLarge">ទឹកកកអនាម័យធំ (Large)</label>
              <input type="number" step="0.1" class="form-control" id="iceTypeLarge" value="" placeholder="ចំណួន">
              <label for="unitPriceLarge">តម្លៃរាយ (Unit Price)</label>
              <input type="number" class="form-control" id="unitPriceLarge" placeholder="តម្លៃ" required>
            </div>
            <div class="form-group ice-type-group">
              <label for="iceTypeSmall">ទឹកកកអនាម័យតូច (Small)</label>
              <input type="number" step="0.1" class="form-control" id="iceTypeSmall" value="" placeholder="ចំណួន">
              <label for="unitPriceSmall">តម្លៃរាយ (Unit Price)</label>
              <input type="number" class="form-control" id="unitPriceSmall" placeholder="តម្លៃ" required>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="oldDebt">ប្រាក់ជំពាក់ចាស់ (Old Debt)</label>
            <input type="number" class="form-control" id="oldDebt" value="">
          </div>
          <div class="form-group">
            <label for="newDebt">ប្រាក់ជំពាក់ថ្មី (New Debt)</label>
            <input type="number" class="form-control" id="newDebt" value="">
          </div>
          <div class="form-group">
            <label for="payment">ប្រាក់សង (Payment)</label>
            <input type="number" class="form-control" id="payment" value="">
          </div>
          <div class="form-group">
            <label for="expenses">ថ្លៃសាំង បាយ (Expenses)</label>
            <input type="number" class="form-control" id="expenses" value="">
          </div>
        </div>

        <div class="form-row">
          <button type="submit" id="submitBtn" class="btn btn-primary">Add Entry</button>
          <button type="button" id="cancelEditBtn" class="btn btn-secondary" style="display: none;">Cancel Edit</button>
        </div>
      </form>
    </div>

    <!-- Search Section -->
    <div class="card search-section">
      <h3 class="section-title">
        <span class="title-line">Search Customer Records</span>
      </h3>
      <div class="form-row search-actions">
        <div class="form-group">
          <input type="text" class="form-control" id="searchName" placeholder="Enter customer name">
        </div>
        <div class="btn-group">
          <button id="searchBtn" class="btn btn-secondary">Search</button>
          <button id="clearSearchBtn" class="btn btn-danger">Clear</button>
        </div>
      </div>
    </div>

    <!-- Report Controls -->
    <div class="card report-controls-section">
      <h3 class="section-title">
        <span class="title-line">Report Controls</span>
      </h3>
      <div class="report-controls">
        <div class="form-group">
          <label for="reportType">Report Type</label>
          <select class="form-control" id="reportType">
            <option value="daily">Daily Report</option>
            <option value="monthly">Monthly Report</option>
            <option value="all">All Records</option>
          </select>
        </div>
        <div class="form-group" id="dailyDateGroup">
          <label for="dailyDate">Select Date</label>
          <input type="date" class="form-control" id="dailyDate">
        </div>
        <div class="form-group" id="monthlyDateGroup" style="display: none;">
          <label for="monthlyDate">Select Month</label>
          <input type="month" class="form-control" id="monthlyDate">
        </div>
        <div class="form-group" style="align-self: flex-end;">
          <button id="generateReportBtn" class="btn btn-primary">Generate Report</button>
        </div>
        <div class="form-group" style="align-self: flex-end;">
          <button id="printReportBtn" class="btn btn-success">Print Report</button>
        </div>
      </div>
    </div>

    <!-- Table Display -->
    <div class="card table-section">
      <h3 class="section-title">
        <span class="title-line">Ice Sales Records</span>
      </h3>
      <div class="table-responsive">
        <table class="ice-sales-table" id="iceSalesTable">
          <thead>
            <tr>
              <th rowspan="2">ល.រ</th>
              <th rowspan="2">គោត្តនាម</th>
              <th rowspan="2">ប្រភេទទឹកកក</th>
              <th colspan="3">ចំណូល</th>
              <th colspan="4">ប្រាក់ជំពាក់</th>
              <th rowspan="2">ថ្លៃសាំង បាយ</th>
              <th rowspan="2">សរុបចំណូល</th>
              <th rowspan="2">សកម្មភាព</th>
            </tr>
            <tr>
              <th>បរិមាណ</th>
              <th>តម្លៃរាយ</th>
              <th>សរុប</th>
              <th>ប្រាក់ជំពាក់ចាស់</th>
              <th>ប្រាក់ជំពាក់ថ្មី</th>
              <th>ប្រាក់សង</th>
              <th>សរុបប្រាក់ជំពាក់</th>
            </tr>
          </thead>
          <tbody id="tableBody"></tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Edit Sale Record</h3>
        <button class="close-modal">&times;</button>
      </div>
      <div id="editModalContent">
        <!-- Content will be loaded here -->
      </div>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Confirm Deletion</h3>
        <button class="close-modal">&times;</button>
      </div>
      <div class="confirmation-dialog">
        <p>Are you sure you want to delete this sale record?</p>
        <div class="modal-footer">
          <button id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
          <button id="cancelDeleteBtn" class="btn btn-secondary">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    const API_URL = 'http://localhost:5000/api/sales';
    let salesData = [];
    let filteredData = [];
    let currentSaleId = null;

    // Set default date to today
    document.getElementById('saleDate').valueAsDate = new Date();
    document.getElementById('dailyDate').valueAsDate = new Date();
    
    // Set default month to current month
    const today = new Date();
    const month = today.getMonth() + 1;
    const year = today.getFullYear();
    document.getElementById('monthlyDate').value = `${year}-${month.toString().padStart(2, '0')}`;

    // Toggle date/month inputs based on report type
    document.getElementById('reportType').addEventListener('change', function() {
      const reportType = this.value;
      document.getElementById('dailyDateGroup').style.display = reportType === 'daily' ? 'block' : 'none';
      document.getElementById('monthlyDateGroup').style.display = reportType === 'monthly' ? 'block' : 'none';
    });

    // Function to format date
    function formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
    }

    // Function to group sales by date
    function groupSalesByDate(sales) {
      const grouped = {};
      
      sales.forEach(sale => {
        const saleDate = new Date(sale.saleDate);
        const dateKey = saleDate.toLocaleDateString();
        
        if (!grouped[dateKey]) {
          grouped[dateKey] = [];
        }
        
        grouped[dateKey].push(sale);
      });
      
      return grouped;
    }

    // Function to group sales by month
    function groupSalesByMonth(sales) {
      const grouped = {};
      
      sales.forEach(sale => {
        const saleDate = new Date(sale.saleDate);
        const monthKey = saleDate.toLocaleDateString('default', { month: 'long', year: 'numeric' });
        
        if (!grouped[monthKey]) {
          grouped[monthKey] = [];
        }
        
        grouped[monthKey].push(sale);
      });
      
      return grouped;
    }

    // Function to update the table with sales data
    function updateTable(data = salesData, reportType = 'all') {
      const tableBody = document.getElementById('tableBody');
      tableBody.innerHTML = '';

      if (data.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = `<td colspan="13" class="no-results">No records found</td>`;
        tableBody.appendChild(row);
        return;
      }

      let totalRevenue = 0;
      let totalDebt = 0;
      let totalExpenses = 0;
      let totalNetIncome = 0;
      let rowCount = 0;

      if (reportType === 'daily') {
        const groupedByDate = groupSalesByDate(data);
        
        Object.keys(groupedByDate).forEach(date => {
          // Add date header row
          const dateHeaderRow = document.createElement('tr');
          dateHeaderRow.className = 'date-header-row';
          dateHeaderRow.innerHTML = `<td colspan="13">${date}</td>`;
          tableBody.appendChild(dateHeaderRow);
          
          // Add sales for this date
          let dateRevenue = 0;
          let dateDebt = 0;
          let dateExpenses = 0;
          let dateNetIncome = 0;
          
          groupedByDate[date].forEach((sale, index) => {
            const revenueOriginal = sale.iceTypeOriginal * sale.unitPriceOriginal;
            const revenueLarge = sale.iceTypeLarge * sale.unitPriceLarge;
            const revenueSmall = sale.iceTypeSmall * sale.unitPriceSmall;
            const totalRevenuePerSale = revenueOriginal + revenueLarge + revenueSmall;
            const totalDebtPerSale = sale.oldDebt + sale.newDebt - sale.payment;
            const netIncome = totalRevenuePerSale - sale.expenses;

            // Add to date totals
            dateRevenue += totalRevenuePerSale;
            dateDebt += totalDebtPerSale;
            dateExpenses += sale.expenses;
            dateNetIncome += netIncome;

            // Add to overall totals
            totalRevenue += totalRevenuePerSale;
            totalDebt += totalDebtPerSale;
            totalExpenses += sale.expenses;
            totalNetIncome += netIncome;

            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${index + 1}</td>
              <td>${sale.customerName}</td>
              <td>
                <div class="ice-type-display">
                  ${sale.iceTypeOriginal > 0 ? `<div><span class="original">ទឹកកកដើម</span></div>` : ''}
                  ${sale.iceTypeLarge > 0 ? `<div><span class="large">អនាម័យធំ</span></div>` : ''}
                  ${sale.iceTypeSmall > 0 ? `<div><span class="small">អនាម័យតូច</span></div>` : ''}
                </div>
              </td>
              <td>
                <div class="quantity-display">
                  ${sale.iceTypeOriginal > 0 ? `<div>${sale.iceTypeOriginal}</div>` : ''}
                  ${sale.iceTypeLarge > 0 ? `<div>${sale.iceTypeLarge}</div>` : ''}
                  ${sale.iceTypeSmall > 0 ? `<div>${sale.iceTypeSmall}</div>` : ''}
                </div>
              </td>
              <td>
                <div class="price-display">
                  ${sale.iceTypeOriginal > 0 ? `<div>${sale.unitPriceOriginal.toLocaleString()}</div>` : ''}
                  ${sale.iceTypeLarge > 0 ? `<div>${sale.unitPriceLarge.toLocaleString()}</div>` : ''}
                  ${sale.iceTypeSmall > 0 ? `<div>${sale.unitPriceSmall.toLocaleString()}</div>` : ''}
                </div>
              </td>
              <td>
                <div class="total-display">
                  ${revenueOriginal > 0 ? `<div>${revenueOriginal.toLocaleString()}</div>` : ''}
                  ${revenueLarge > 0 ? `<div>${revenueLarge.toLocaleString()}</div>` : ''}
                  ${revenueSmall > 0 ? `<div>${revenueSmall.toLocaleString()}</div>` : ''}
                </div>
              </td>
              <td>${sale.oldDebt.toLocaleString()}</td>
              <td>${sale.newDebt.toLocaleString()}</td>
              <td>${sale.payment.toLocaleString()}</td>
              <td>${totalDebtPerSale.toLocaleString()}</td>
              <td>${sale.expenses.toLocaleString()}</td>
              <td>${totalRevenuePerSale.toLocaleString()}</td>
              <td>
                <div class="action-buttons">
                  <button class="btn btn-info btn-sm edit-btn" data-id="${sale._id}">Edit</button>
                  <button class="btn btn-danger btn-sm delete-btn" data-id="${sale._id}">Delete</button>
                </div>
              </td>
            `;
            tableBody.appendChild(row);
            rowCount++;
          });
          
          // Add date totals row
          const dateTotalsRow = document.createElement('tr');
          dateTotalsRow.className = 'total-row';
          dateTotalsRow.innerHTML = `
            <td colspan="3">Date Totals</td>
            <td></td>
            <td></td>
            <td>${dateRevenue.toLocaleString()}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>${dateDebt.toLocaleString()}</td>
            <td>${dateExpenses.toLocaleString()}</td>
            <td>${dateNetIncome.toLocaleString()}</td>
            <td></td>
          `;
          tableBody.appendChild(dateTotalsRow);
        });
      } else if (reportType === 'monthly') {
        const groupedByMonth = groupSalesByMonth(data);
        
        Object.keys(groupedByMonth).forEach(month => {
          // Add month header row
          const monthHeaderRow = document.createElement('tr');
          monthHeaderRow.className = 'month-header-row';
          monthHeaderRow.innerHTML = `<td colspan="13">${month}</td>`;
          tableBody.appendChild(monthHeaderRow);
          
          // Add sales for this month
          let monthRevenue = 0;
          let monthDebt = 0;
          let monthExpenses = 0;
          let monthNetIncome = 0;
          let monthRowCount = 0;
          
          groupedByMonth[month].forEach((sale, index) => {
            const revenueOriginal = sale.iceTypeOriginal * sale.unitPriceOriginal;
            const revenueLarge = sale.iceTypeLarge * sale.unitPriceLarge;
            const revenueSmall = sale.iceTypeSmall * sale.unitPriceSmall;
            const totalRevenuePerSale = revenueOriginal + revenueLarge + revenueSmall;
            const totalDebtPerSale = sale.oldDebt + sale.newDebt - sale.payment;
            const netIncome = totalRevenuePerSale - sale.expenses;

            // Add to month totals
            monthRevenue += totalRevenuePerSale;
            monthDebt += totalDebtPerSale;
            monthExpenses += sale.expenses;
            monthNetIncome += netIncome;

            // Add to overall totals
            totalRevenue += totalRevenuePerSale;
            totalDebt += totalDebtPerSale;
            totalExpenses += sale.expenses;
            totalNetIncome += netIncome;

            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${index + 1}</td>
              <td>${sale.customerName}</td>
              <td>
                <div class="ice-type-display">
                  ${sale.iceTypeOriginal > 0 ? `<div><span class="original">ទឹកកកដើម</span></div>` : ''}
                  ${sale.iceTypeLarge > 0 ? `<div><span class="large">អនាម័យធំ</span></div>` : ''}
                  ${sale.iceTypeSmall > 0 ? `<div><span class="small">អនាម័យតូច</span></div>` : ''}
                </div>
              </td>
              <td>
                <div class="quantity-display">
                  ${sale.iceTypeOriginal > 0 ? `<div>${sale.iceTypeOriginal}</div>` : ''}
                  ${sale.iceTypeLarge > 0 ? `<div>${sale.iceTypeLarge}</div>` : ''}
                  ${sale.iceTypeSmall > 0 ? `<div>${sale.iceTypeSmall}</div>` : ''}
                </div>
              </td>
              <td>
                <div class="price-display">
                  ${sale.iceTypeOriginal > 0 ? `<div>${sale.unitPriceOriginal.toLocaleString()}</div>` : ''}
                  ${sale.iceTypeLarge > 0 ? `<div>${sale.unitPriceLarge.toLocaleString()}</div>` : ''}
                  ${sale.iceTypeSmall > 0 ? `<div>${sale.unitPriceSmall.toLocaleString()}</div>` : ''}
                </div>
              </td>
              <td>
                <div class="total-display">
                  ${revenueOriginal > 0 ? `<div>${revenueOriginal.toLocaleString()}</div>` : ''}
                  ${revenueLarge > 0 ? `<div>${revenueLarge.toLocaleString()}</div>` : ''}
                  ${revenueSmall > 0 ? `<div>${revenueSmall.toLocaleString()}</div>` : ''}
                </div>
              </td>
              <td>${sale.oldDebt.toLocaleString()}</td>
              <td>${sale.newDebt.toLocaleString()}</td>
              <td>${sale.payment.toLocaleString()}</td>
              <td>${totalDebtPerSale.toLocaleString()}</td>
              <td>${sale.expenses.toLocaleString()}</td>
              <td>${totalRevenuePerSale.toLocaleString()}</td>
              <td>
                <div class="action-buttons">
                  <button class="btn btn-info btn-sm edit-btn" data-id="${sale._id}">Edit</button>
                  <button class="btn btn-danger btn-sm delete-btn" data-id="${sale._id}">Delete</button>
                </div>
              </td>
            `;
            tableBody.appendChild(row);
            rowCount++;
            monthRowCount++;
          });
          
          // Add month totals row
          const monthTotalsRow = document.createElement('tr');
          monthTotalsRow.className = 'total-row';
          monthTotalsRow.innerHTML = `
            <td colspan="3">Month Totals (${monthRowCount} records)</td>
            <td></td>
            <td></td>
            <td>${monthRevenue.toLocaleString()}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>${monthDebt.toLocaleString()}</td>
            <td>${monthExpenses.toLocaleString()}</td>
            <td>${monthNetIncome.toLocaleString()}</td>
            <td></td>
          `;
          tableBody.appendChild(monthTotalsRow);
        });
      } else {
        // Regular all records display
        data.forEach((sale, index) => {
          const revenueOriginal = sale.iceTypeOriginal * sale.unitPriceOriginal;
          const revenueLarge = sale.iceTypeLarge * sale.unitPriceLarge;
          const revenueSmall = sale.iceTypeSmall * sale.unitPriceSmall;
          const totalRevenuePerSale = revenueOriginal + revenueLarge + revenueSmall;
          const totalDebtPerSale = sale.oldDebt + sale.newDebt - sale.payment;
          const netIncome = totalRevenuePerSale - sale.expenses;

          // Add to totals
          totalRevenue += totalRevenuePerSale;
          totalDebt += totalDebtPerSale;
          totalExpenses += sale.expenses;
          totalNetIncome += netIncome;

          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${index + 1}</td>
            <td>${sale.customerName}</td>
            <td>
              <div class="ice-type-display">
                ${sale.iceTypeOriginal > 0 ? `<div><span class="original">ទឹកកកដើម</span></div>` : ''}
                ${sale.iceTypeLarge > 0 ? `<div><span class="large">អនាម័យធំ</span></div>` : ''}
                ${sale.iceTypeSmall > 0 ? `<div><span class="small">អនាម័យតូច</span></div>` : ''}
              </div>
            </td>
            <td>
              <div class="quantity-display">
                ${sale.iceTypeOriginal > 0 ? `<div>${sale.iceTypeOriginal}</div>` : ''}
                ${sale.iceTypeLarge > 0 ? `<div>${sale.iceTypeLarge}</div>` : ''}
                ${sale.iceTypeSmall > 0 ? `<div>${sale.iceTypeSmall}</div>` : ''}
              </div>
            </td>
            <td>
              <div class="price-display">
                ${sale.iceTypeOriginal > 0 ? `<div>${sale.unitPriceOriginal.toLocaleString()}</div>` : ''}
                ${sale.iceTypeLarge > 0 ? `<div>${sale.unitPriceLarge.toLocaleString()}</div>` : ''}
                ${sale.iceTypeSmall > 0 ? `<div>${sale.unitPriceSmall.toLocaleString()}</div>` : ''}
              </div>
            </td>
            <td>
              <div class="total-display">
                ${revenueOriginal > 0 ? `<div>${revenueOriginal.toLocaleString()}</div>` : ''}
                ${revenueLarge > 0 ? `<div>${revenueLarge.toLocaleString()}</div>` : ''}
                ${revenueSmall > 0 ? `<div>${revenueSmall.toLocaleString()}</div>` : ''}
              </div>
            </td>
            <td>${sale.oldDebt.toLocaleString()}</td>
            <td>${sale.newDebt.toLocaleString()}</td>
            <td>${sale.payment.toLocaleString()}</td>
            <td>${totalDebtPerSale.toLocaleString()}</td>
            <td>${sale.expenses.toLocaleString()}</td>
            <td>${totalRevenuePerSale.toLocaleString()}</td>
            <td>
              <div class="action-buttons">
                <button class="btn btn-info btn-sm edit-btn" data-id="${sale._id}">Edit</button>
                <button class="btn btn-danger btn-sm delete-btn" data-id="${sale._id}">Delete</button>
              </div>
            </td>
          `;
          tableBody.appendChild(row);
          rowCount++;
        });
      }

      // Add grand totals row if we have records
      if (rowCount > 0) {
        const totalsRow = document.createElement('tr');
        totalsRow.className = 'total-row';
        totalsRow.innerHTML = `
          <td colspan="3">Grand Totals (${rowCount} records)</td>
          <td></td>
          <td></td>
          <td>${totalRevenue.toLocaleString()}</td>
          <td></td>
          <td></td>
          <td></td>
          <td>${totalDebt.toLocaleString()}</td>
          <td>${totalExpenses.toLocaleString()}</td>
          <td>${totalNetIncome.toLocaleString()}</td>
          <td></td>
        `;
        tableBody.appendChild(totalsRow);
      }

      // Add event listeners to edit and delete buttons
      document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => editSale(btn.dataset.id));
      });

      document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', () => showDeleteConfirmation(btn.dataset.id));
      });
    }

    // Form submission handler
    document.getElementById('iceSaleForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      // Get form values
      const formData = {
        customerName: document.getElementById('customerName').value,
        saleDate: document.getElementById('saleDate').value,
        iceTypeOriginal: parseFloat(document.getElementById('iceTypeOriginal').value) || 0,
        unitPriceOriginal: parseFloat(document.getElementById('unitPriceOriginal').value) || 0,
        iceTypeLarge: parseFloat(document.getElementById('iceTypeLarge').value) || 0,
        unitPriceLarge: parseFloat(document.getElementById('unitPriceLarge').value) || 0,
        iceTypeSmall: parseFloat(document.getElementById('iceTypeSmall').value) || 0,
        unitPriceSmall: parseFloat(document.getElementById('unitPriceSmall').value) || 0,
        oldDebt: parseFloat(document.getElementById('oldDebt').value) || 0,
        newDebt: parseFloat(document.getElementById('newDebt').value) || 0,
        payment: parseFloat(document.getElementById('payment').value) || 0,
        expenses: parseFloat(document.getElementById('expenses').value) || 0
      };

      try {
        let response;
        const saleId = document.getElementById('saleId').value;
        
        if (saleId) {
          // Update existing sale
          response = await fetch(`${API_URL}/${saleId}`, {
            method: 'PUT',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
          });
        } else {
          // Create new sale
          response = await fetch(API_URL, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
          });
        }

        if (!response.ok) {
          throw new Error(saleId ? 'Failed to update sale' : 'Failed to save sale');
        }

        const updatedSale = await response.json();
        
        if (saleId) {
          // Replace the updated sale in the array
          const index = salesData.findIndex(s => s._id === saleId);
          if (index !== -1) {
            salesData[index] = updatedSale;
          }
        } else {
          // Add new sale to the array
          salesData.push(updatedSale);
        }
        
        // Get current report type and update table accordingly
        const reportType = document.getElementById('reportType').value;
        updateTable(salesData, reportType);
        resetForm();
      } catch (error) {
        console.error('Error:', error);
        alert('Error: ' + error.message);
      }
    });

    // Generate report button handler
    document.getElementById('generateReportBtn').addEventListener('click', function() {
      const reportType = document.getElementById('reportType').value;
      let filteredData = salesData;
      
      if (reportType === 'daily') {
        const selectedDate = document.getElementById('dailyDate').value;
        if (selectedDate) {
          filteredData = salesData.filter(sale => {
            const saleDate = new Date(sale.saleDate).toISOString().split('T')[0];
            return saleDate === selectedDate;
          });
        }
      } else if (reportType === 'monthly') {
        const selectedMonth = document.getElementById('monthlyDate').value;
        if (selectedMonth) {
          filteredData = salesData.filter(sale => {
            const saleDate = new Date(sale.saleDate);
            const saleMonth = saleDate.getFullYear() + '-' + (saleDate.getMonth() + 1).toString().padStart(2, '0');
            return saleMonth === selectedMonth;
          });
        }
      }
      
      updateTable(filteredData, reportType);
    });

    // Print report button handler
    document.getElementById('printReportBtn').addEventListener('click', function() {
      const reportType = document.getElementById('reportType').value;
      let title = 'Ice Sales Records';
      
      if (reportType === 'daily') {
        const selectedDate = document.getElementById('dailyDate').value;
        title += ` - ${new Date(selectedDate).toLocaleDateString()}`;
      } else if (reportType === 'monthly') {
        const selectedMonth = document.getElementById('monthlyDate').value;
        const [year, month] = selectedMonth.split('-');
        title += ` - ${new Date(year, month - 1).toLocaleDateString('default', { month: 'long', year: 'numeric' })}`;
      }
      
      // Create a print-friendly version
      const printWindow = window.open('', '_blank');
      printWindow.document.write(`
        <html>
          <head>
            <title>${title}</title>
            <style>
              body { font-family: Arial, sans-serif; margin: 20px; }
              h1 { text-align: center; margin-bottom: 20px; }
              table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
              th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
              th { background-color: #3498db; color: white; }
              tr:nth-child(even) { background-color: #f2f2f2; }
              .total-row { background-color: #e3f2fd; font-weight: bold; }
              .date-header-row { background-color: #2c3e50; color: white; font-weight: bold; }
              .month-header-row { background-color: #34495e; color: white; font-weight: bold; }
              @page { size: auto; margin: 10mm; }
              @media print {
                body { margin: 0; padding: 0; }
                .no-print { display: none; }
              }
            </style>
          </head>
          <body>
            <h1>${title}</h1>
            ${document.getElementById('iceSalesTable').outerHTML}
            <div class="no-print" style="margin-top: 20px; text-align: center;">
              <button onclick="window.print()">Print Report</button>
              <button onclick="window.close()">Close</button>
            </div>
          </body>
        </html>
      `);
      printWindow.document.close();
    });

    // Edit sale function
    async function editSale(id) {
      try {
        const response = await fetch(`${API_URL}/${id}`);
        if (!response.ok) {
          throw new Error('Failed to fetch sale data');
        }
        
        const sale = await response.json();
        
        // Populate form with sale data
        document.getElementById('saleId').value = sale._id;
        document.getElementById('customerName').value = sale.customerName;
        document.getElementById('saleDate').value = sale.saleDate.split('T')[0];
        document.getElementById('iceTypeOriginal').value = sale.iceTypeOriginal;
        document.getElementById('unitPriceOriginal').value = sale.unitPriceOriginal;
        document.getElementById('iceTypeLarge').value = sale.iceTypeLarge;
        document.getElementById('unitPriceLarge').value = sale.unitPriceLarge;
        document.getElementById('iceTypeSmall').value = sale.iceTypeSmall;
        document.getElementById('unitPriceSmall').value = sale.unitPriceSmall;
        document.getElementById('oldDebt').value = sale.oldDebt;
        document.getElementById('newDebt').value = sale.newDebt;
        document.getElementById('payment').value = sale.payment;
        document.getElementById('expenses').value = sale.expenses;
        
        // Change form to edit mode
        document.getElementById('submitBtn').textContent = 'Update Entry';
        document.getElementById('cancelEditBtn').style.display = 'inline-block';
        
        // Scroll to form
        document.querySelector('.form-section').scrollIntoView({ behavior: 'smooth' });
      } catch (error) {
        console.error('Error:', error);
        alert('Error loading sale data: ' + error.message);
      }
    }

    // Cancel edit function
    document.getElementById('cancelEditBtn').addEventListener('click', resetForm);

    function resetForm() {
      document.getElementById('iceSaleForm').reset();
      document.getElementById('saleId').value = '';
      document.getElementById('saleDate').valueAsDate = new Date();
      document.getElementById('submitBtn').textContent = 'Add Entry';
      document.getElementById('cancelEditBtn').style.display = 'none';
    }

    // Delete sale function
    async function deleteSale(id) {
      try {
        const response = await fetch(`${API_URL}/${id}`, {
          method: 'DELETE'
        });
        
        if (!response.ok) {
          throw new Error('Failed to delete sale');
        }
        
        // Remove from salesData array
        salesData = salesData.filter(sale => sale._id !== id);
        
        // Get current report type and update table accordingly
        const reportType = document.getElementById('reportType').value;
        updateTable(salesData, reportType);
        
        hideModal('deleteModal');
      } catch (error) {
        console.error('Error:', error);
        alert('Error deleting sale: ' + error.message);
      }
    }

    // Show delete confirmation
    function showDeleteConfirmation(id) {
      currentSaleId = id;
      showModal('deleteModal');
    }

    // Confirm delete button
    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
      if (currentSaleId) {
        deleteSale(currentSaleId);
      }
    });

    // Cancel delete button
    document.getElementById('cancelDeleteBtn').addEventListener('click', () => {
      hideModal('deleteModal');
      currentSaleId = null;
    });

    // Modal functions
    function showModal(modalId) {
      document.getElementById(modalId).style.display = 'flex';
    }

    function hideModal(modalId) {
      document.getElementById(modalId).style.display = 'none';
    }

    // Close modals when clicking X or outside
    document.querySelectorAll('.modal').forEach(modal => {
      modal.addEventListener('click', (e) => {
        if (e.target === modal || e.target.classList.contains('close-modal')) {
          hideModal(modal.id);
          currentSaleId = null;
        }
      });
    });

    // Search button handler
    document.getElementById('searchBtn').addEventListener('click', function() {
      const searchTerm = document.getElementById('searchName').value.trim().toLowerCase();
      
      if (!searchTerm) {
        alert('Please enter a customer name to search');
        return;
      }

      filteredData = salesData.filter(sale => 
        sale.customerName.toLowerCase().includes(searchTerm)
      );

      updateTable(filteredData);
    });

    // Clear search button handler
    document.getElementById('clearSearchBtn').addEventListener('click', function() {
      document.getElementById('searchName').value = '';
      filteredData = [];
      
      // Get current report type and update table accordingly
      const reportType = document.getElementById('reportType').value;
      updateTable(salesData, reportType);
    });

    // Function to load sales data from backend
    async function loadSalesData() {
      try {
        const response = await fetch(API_URL);
        if (!response.ok) {
          throw new Error('Failed to load sales data');
        }
        salesData = await response.json();
        
        // Sort by date (newest first)
        salesData.sort((a, b) => new Date(b.saleDate) - new Date(a.saleDate));
        
        updateTable(salesData);
      } catch (error) {
        console.error('Error:', error);
        alert('Error loading sales data: ' + error.message);
      }
    }

    // Initialize by loading data
    loadSalesData();
  </script>
</body>
</html>