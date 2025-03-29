<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ice Sales Records</title>
  <link rel="stylesheet" href="styles.css">
  <!-- Add SheetJS library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
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

    <!-- Table Display -->
    <div class="card table-section">
      <h3 class="section-title">
        <span class="title-line">Ice Sales Records</span>
      </h3>
      <div class="form-row">
        <button id="saveReportBtn" class="btn btn-success">Save Report</button>
      </div>
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
        <button class="close-modal">×</button>
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
        <button class="close-modal">×</button>
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

  <script src="script.js"></script>
</body>
</html>