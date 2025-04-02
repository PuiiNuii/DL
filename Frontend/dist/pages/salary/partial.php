
  <title>បញ្ចីប្រាក់ខែ</title>
  <link rel="stylesheet" href="style.css">
  
</head>
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

.salary-container {
  max-width: 2500px;
  margin: 0 auto;
  padding: var(--spacing);
}

.card {
  background: white;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  padding: var(--spacing);
  margin-bottom: var(--spacing);
  animation: fadeIn 0.3s ease-out;
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
  min-width: 200px;
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

.btn-success {
  background-color: var(--success-color);
  color: white;
}

.btn-success:hover {
  background-color: #218838;
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

.btn-warning {
  background-color: var(--warning-color);
  color: #212529;
}

.btn-warning:hover {
  background-color: #e0a800;
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

.salary-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 25px;
  font-size: 0.95rem;
}

.salary-table th,
.salary-table td {
  padding: 15px 18px;
  text-align: center;
  border: 1px solid var(--medium-gray);
}

.salary-table th {
  background-color: var(--primary-color);
  color: white;
  font-weight: 600;
  position: sticky;
  top: 0;
  font-size: 1rem;
}

.salary-table tr:nth-child(even) {
  background-color: var(--light-gray);
}

.salary-table tr:hover {
  background-color: #e9f7fe;
}

.total-row {
  background-color: #e3f2fd;
  font-weight: bold;
}

/* Column width adjustments */
.salary-table td:nth-child(1) { width: 5%; }
.salary-table td:nth-child(2) { width: 20%; }
.salary-table td:nth-child(3),
.salary-table td:nth-child(4) { width: 12%; }
.salary-table td:nth-child(5),
.salary-table td:nth-child(6),
.salary-table td:nth-child(7) { width: 12%; }
.salary-table td:nth-child(8) { width: 15%; }
.salary-table td:nth-child(9) { width: 12%; }

/* New clean table styling */
.table-responsive {
  border-radius: var(--border-radius);
  overflow: hidden;
  border: 1px solid var(--medium-gray);
  max-height: 600px;
  overflow-y: auto;
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
  max-width: 500px;
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

/* Responsive adjustments */
@media (max-width: 1200px) {
  .salary-container {
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
  
  .salary-table {
    display: block;
    overflow-x: auto;
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
}

/* Animation for better UX */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
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

/* Readonly input style */
input[readonly] {
  background-color: #f0f0f0;
  cursor: not-allowed;
}

/* Input number styles */
input[type="number"] {
  -moz-appearance: textfield;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Khmer Font Support */
@font-face {
  font-family: 'Khmer OS';
  src: url('path/to/khmer-os.ttf') format('truetype');
  font-weight: normal;
  font-style: normal;
}

/* Apply Khmer font to specific elements */
body {
  font-family: 'Khmer OS', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>

<body>
  <div class="salary-container">
    <!-- Input Form Section -->
    <div class="card form-section">
      <h3 class="section-title">
        <span class="title-line">បន្ថែមបុគ្គលិកថ្មី</span>
      </h3>
      <form id="salaryForm" class="salary-form">
        <input type="hidden" id="salaryId" value="">
        <div class="form-row">
          <div class="form-group">
            <label for="employeeName">គោត្តនាម (Employee Name)</label>
            <input type="text" class="form-control" id="employeeName" required>
          </div>
          <button type="button" id="clearBtn" class="btn btn-warning">Clear</button>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="basicSalary">ប្រាក់ខែគោល (Basic Salary)</label>
            <input type="number" class="form-control" id="basicSalary" value="0" required>
          </div>
          <div class="form-group">
            <label for="extraSalary">ប្រាក់ខែបន្ថែម (Extra Salary)</label>
            <input type="number" class="form-control" id="extraSalary" value="0">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="oldDebt">ប្រាក់ជំពាក់ខែចាស់ (Old Debt)</label>
            <input type="number" class="form-control" id="oldDebt" value="0">
          </div>
          <div class="form-group">
            <label for="newDebt">ប្រាក់ខ្ចីខែថ្មី (New Debt)</label>
            <input type="number" class="form-control" id="newDebt" value="0">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="payment">ប្រាក់សង (Payment)</label>
            <input type="number" class="form-control" id="payment" value="0">
          </div>
          <div class="form-group">
            <label for="remainingSalary">សរុបប្រាក់ខែនៅសល់ (Remaining Salary)</label>
            <input type="number" class="form-control" id="remainingSalary" value="0" readonly>
          </div>
        </div>

        <div class="debt-payment-buttons" style="display: none;">
          <button type="button" id="addNewDebtBtn" class="btn btn-primary btn-sm">បន្ថែមប្រាក់ខ្ចីថ្មី</button>
          <button type="button" id="addPaymentBtn" class="btn btn-success btn-sm">បន្ថែមប្រាក់សង</button>
        </div>

        <div class="form-row">
          <button type="submit" id="submitBtn" class="btn btn-primary">Add</button>
          <button type="button" id="cancelEditBtn" class="btn btn-secondary" style="display: none;">Cancel Edit</button>
        </div>
      </form>
    </div>

    <!-- Search Section -->
    <div class="card search-section">
      <h3 class="section-title">
        <span class="title-line">ស្វែងរកកំណត់ត្រាបុគ្គលិក</span>
      </h3>
      <div class="form-row search-actions">
        <div class="form-group">
          <input type="text" class="form-control" id="searchName" placeholder="ឈ្មោះបុគ្គលិក">
        </div>
        <div class="btn-group">
          <button id="searchBtn" class="btn btn-secondary">ស្វែងរក</button>
          <button id="clearSearchBtn" class="btn btn-danger">បោះបង់</button>
        </div>
      </div>
    </div>

    <!-- Table Display -->
    <div class="card table-section">
      <h3 class="section-title">
        <span class="title-line">កំណត់ត្រាប្រាក់ខែ</span>
      </h3>
      <div class="form-row">
        <button id="saveReportBtn" class="btn btn-success">រក្សាទុករបាយការណ៍ជា PDF</button>
      </div>
      <div class="table-responsive">
        <table class="salary-table" id="salaryTable">
          <thead>
            <tr>
              <th>ល.រ</th>
              <th>គោត្តនាម នាម</th>
              <th>ប្រាក់ខែ</th>
              <th>ប្រាក់ខែបន្ថែម</th>
              <th>ប្រាក់ជំពាក់ខែចាស់</th>
              <th>ប្រាក់ខ្ចីខែថ្មី</th>
              <th>ប្រាក់សង</th>
              <th>សរុបប្រាក់ខែនៅសល់</th>
              <th>សកម្មភាព</th>
            </tr>
          </thead>
          <tbody id="tableBody"></tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- New Debt Modal -->
  <div id="newDebtModal" class="modal">
    <div class="modal-content">
      <h3>បន្ថែមប្រាក់ខ្ចីថ្មី</h3>
      <div class="form-group">
        <label for="newDebtAmount">ចំនួនទឹកប្រាក់:</label>
        <input type="number" id="newDebtAmount" class="form-control" min="0">
      </div>
      <button id="confirmNewDebtBtn" class="btn btn-primary">បញ្ជាក់</button>
      <button class="btn btn-secondary close-modal">បោះបង់</button>
    </div>
  </div>

  <!-- Payment Modal -->
  <div id="paymentModal" class="modal">
    <div class="modal-content">
      <h3>បន្ថែមប្រាក់សង</h3>
      <div class="form-group">
        <label for="paymentAmount">ចំនួនទឹកប្រាក់:</label>
        <input type="number" id="paymentAmount" class="form-control" min="0">
      </div>
      <button id="confirmPaymentBtn" class="btn btn-primary">បញ្ជាក់</button>
      <button class="btn btn-secondary close-modal">បោះបង់</button>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">បញ្ជាក់ការលុប</h3>
        <button class="close-modal">×</button>
      </div>
      <div class="confirmation-dialog">
        <p>តើអ្នកប្រាកដថាចង់លុបកំណត់ត្រានេះទេ?</p>
        <div class="modal-footer">
          <button id="confirmDeleteBtn" class="btn btn-danger">លុប</button>
          <button id="cancelDeleteBtn" class="btn btn-secondary">បោះបង់</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Initialize data array
    let salaryData = [];
    let currentEditId = null;

    // DOM elements
    const salaryForm = document.getElementById('salaryForm');
    const employeeNameInput = document.getElementById('employeeName');
    const basicSalaryInput = document.getElementById('basicSalary');
    const extraSalaryInput = document.getElementById('extraSalary');
    const oldDebtInput = document.getElementById('oldDebt');
    const newDebtInput = document.getElementById('newDebt');
    const paymentInput = document.getElementById('payment');
    const remainingSalaryInput = document.getElementById('remainingSalary');
    const tableBody = document.getElementById('tableBody');
    const searchNameInput = document.getElementById('searchName');
    const searchBtn = document.getElementById('searchBtn');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    const submitBtn = document.getElementById('submitBtn');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const clearBtn = document.getElementById('clearBtn');
    const saveReportBtn = document.getElementById('saveReportBtn');

    // Modal elements
    const newDebtModal = document.getElementById('newDebtModal');
    const paymentModal = document.getElementById('paymentModal');
    const deleteModal = document.getElementById('deleteModal');
    const newDebtAmountInput = document.getElementById('newDebtAmount');
    const paymentAmountInput = document.getElementById('paymentAmount');

    // Form submit handler
    salaryForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const employeeName = employeeNameInput.value.trim();
      const basicSalary = parseFloat(basicSalaryInput.value) || 0;
      const extraSalary = parseFloat(extraSalaryInput.value) || 0;
      const oldDebt = parseFloat(oldDebtInput.value) || 0;
      const newDebt = parseFloat(newDebtInput.value) || 0;
      const payment = parseFloat(paymentInput.value) || 0;
      
      // Calculate remaining salary
      const totalSalary = basicSalary + extraSalary;
      const totalDebt = oldDebt + newDebt - payment;
      const remainingSalary = totalSalary - totalDebt;
      
      if (currentEditId !== null) {
        // Update existing record
        const index = salaryData.findIndex(item => item.id === currentEditId);
        if (index !== -1) {
          salaryData[index] = {
            id: currentEditId,
            employeeName,
            basicSalary,
            extraSalary,
            oldDebt,
            newDebt,
            payment,
            remainingSalary,
            date: new Date().toLocaleDateString()
          };
        }
        currentEditId = null;
        submitBtn.textContent = 'Add';
        cancelEditBtn.style.display = 'none';
      } else {
        // Add new record
        const newRecord = {
          id: Date.now(),
          employeeName,
          basicSalary,
          extraSalary,
          oldDebt,
          newDebt,
          payment,
          remainingSalary,
          date: new Date().toLocaleDateString()
        };
        salaryData.push(newRecord);
      }
      
      // Update remaining salary display
      remainingSalaryInput.value = remainingSalary.toFixed(2);
      
      // Refresh table and clear form
      renderTable();
      clearForm();
    });

    // Cancel edit handler
    cancelEditBtn.addEventListener('click', function() {
      currentEditId = null;
      submitBtn.textContent = 'Add';
      cancelEditBtn.style.display = 'none';
      clearForm();
    });

    // Clear form handler
    clearBtn.addEventListener('click', clearForm);

    // Search handler
    searchBtn.addEventListener('click', function() {
      const searchTerm = searchNameInput.value.trim().toLowerCase();
      if (searchTerm) {
        const filteredData = salaryData.filter(item => 
          item.employeeName.toLowerCase().includes(searchTerm)
        );
        renderTable(filteredData);
      } else {
        renderTable();
      }
    });

    // Clear search handler
    clearSearchBtn.addEventListener('click', function() {
      searchNameInput.value = '';
      renderTable();
    });

    // Save report handler
    saveReportBtn.addEventListener('click', function() {
      // Implement PDF saving functionality here
      alert('PDF saving functionality will be implemented here');
    });

    // Edit record handler (delegated to table)
    tableBody.addEventListener('click', function(e) {
      if (e.target.classList.contains('edit-btn')) {
        const id = parseInt(e.target.getAttribute('data-id'));
        const record = salaryData.find(item => item.id === id);
        if (record) {
          currentEditId = id;
          employeeNameInput.value = record.employeeName;
          basicSalaryInput.value = record.basicSalary;
          extraSalaryInput.value = record.extraSalary;
          oldDebtInput.value = record.oldDebt;
          newDebtInput.value = record.newDebt;
          paymentInput.value = record.payment;
          remainingSalaryInput.value = record.remainingSalary;
          submitBtn.textContent = 'Update';
          cancelEditBtn.style.display = 'inline-block';
        }
      }
      
      // Delete record handler
      if (e.target.classList.contains('delete-btn')) {
        const id = parseInt(e.target.getAttribute('data-id'));
        showModal('deleteModal');
        
        document.getElementById('confirmDeleteBtn').onclick = function() {
          salaryData = salaryData.filter(item => item.id !== id);
          renderTable();
          hideModal('deleteModal');
        };
        
        document.getElementById('cancelDeleteBtn').onclick = function() {
          hideModal('deleteModal');
        };
      }
    });

    // Modal close handlers
    document.querySelectorAll('.close-modal').forEach(btn => {
      btn.addEventListener('click', function() {
        hideModal(this.closest('.modal').id);
      });
    });

    // Helper functions
    function renderTable(data = salaryData) {
      tableBody.innerHTML = '';
      data.forEach((record, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${index + 1}</td>
          <td>${record.employeeName}</td>
          <td>${record.basicSalary.toFixed(2)}</td>
          <td>${record.extraSalary.toFixed(2)}</td>
          <td>${record.oldDebt.toFixed(2)}</td>
          <td>${record.newDebt.toFixed(2)}</td>
          <td>${record.payment.toFixed(2)}</td>
          <td>${record.remainingSalary.toFixed(2)}</td>
          <td>
            <button class="btn btn-primary btn-sm edit-btn" data-id="${record.id}">កែសម្រួល</button>
            <button class="btn btn-danger btn-sm delete-btn" data-id="${record.id}">លុប</button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    }

    function clearForm() {
      salaryForm.reset();
      remainingSalaryInput.value = '0';
    }

    function showModal(modalId) {
      document.getElementById(modalId).style.display = 'flex';
    }

    function hideModal(modalId) {
      document.getElementById(modalId).style.display = 'none';
    }

    // Initialize the table
    renderTable();
  </script>
</body>
</html>