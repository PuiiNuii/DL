<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <!-- <title>Ice Sales Records</title> -->
   
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="css/part.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
  <style>

    
.quantity-display, 
.price-display, 
.total-display {
  display: flex;
  flex-direction: column;
  gap: 65px;
  padding: 25px 0;
  text-align: center;
}

.ice-type-display {
  display: flex;
  flex-direction: column;
  gap: 65px;
  align-items: center;
  justify-content: center;
  text-align: center;
}


.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    width: 300px;
    text-align: center;
}

.modal-buttons {
    margin-top: 20px;
}

.modal-buttons button {
    margin: 0 10px;
}

.table-container {
  max-height: 400px; /* Adjust this height as needed */
  overflow-y: auto; /* Enable vertical scrolling */
  position: relative; /* For positioning the thead */
}

.ice-sales-table {
  width: 100%;
  border-collapse: collapse;
}

.ice-sales-table thead {
  position: sticky; /* Make the header sticky */
  top: 0; /* Stick to the top of the container */
  background-color: #f8f9fa; /* Background color for visibility */
  z-index: 1; /* Ensure it stays above the tbody */
}

.ice-sales-table th, 
.ice-sales-table td {
  padding: 8px;
  text-align: center;
  border: 1px solid #ddd;
}

/* Ensure column widths remain consistent */
.ice-sales-table th {
  white-space: nowrap; /* Prevent text wrapping */
}

/* Optional: Add a shadow to indicate scrolling */
.table-container {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

    .debt-payment-buttons {
      margin: 10px 0;
    }

    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
    }
    .ice-type-group {
      background-color:rgb(206, 226, 246);
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 15px;
    }

    .modal-content {
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      min-width: 300px;
    }

    .form-group {
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="ice-sales-container">
    <!-- Input Form Section -->
    <div class="card form-section">
      <h3 class="section-title">
        <span class="title-line">បន្ថែមអតិថិជនថ្មី</span>
      </h3>
      <form id="iceSaleForm" class="ice-form">
        <input type="hidden" id="saleId" value="">
        <div class="form-row">
          
          <div class="form-group">
            <label for="customerName">គោត្តនាម (Customer Name)</label>
            <input type="text" class="form-control" id="customerName" required>
          </div>
          <button  type="button" id="clearBtn" class="btn btn-warning">Clear </button>
        </div>

        <div class="ice-type-section">
          <h4>ប្រភេទទឹកកក</h4>
          <div class="form-row">
            <!-- Original Ice -->
            <div class="form-group ice-type-group">
              <label for="iceTypeOriginal">ទឹកកកដើម (Original Ice)</label>
              <div class="ice-input-row">
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeOriginal" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceOriginal" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeOriginal1" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceOriginal1" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeOriginal2" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceOriginal2" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeOriginal3" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceOriginal3" value="0" placeholder="0" required>
                </div>
              </div>
            </div>

            <!-- Large Ice 20kg-->
            <div class="form-group ice-type-group">
              <label for="iceTypeLarge">ទឹកកកអនាម័យធំ (Large) 20kg</label>
              <div class="ice-input-row">
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeLarge" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceLarge" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeLarge1" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceLarge1" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeLarge2" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceLarge2" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeLarge3" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceLarge3" value="0" placeholder="0" required>
                </div>
              </div>
            </div>
            
            <!-- Large Ice 30kg-->
            <div class="form-group ice-type-group">
              <label for="iceTypeLarge30">ទឹកកកអនាម័យធំ (Large) 30kg</label>
              <div class="ice-input-row">
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeLarge30" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceLarge30" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeLarge301" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceLarge301" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeLarge302" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceLarge302" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeLarge303" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceLarge303" value="0" placeholder="0" required>
                </div>
              </div>
            </div>

            <!-- Small Ice 20kg -->
            <div class="form-group ice-type-group">
              <label for="iceTypeSmall">ទឹកកកអនាម័យតូច (Small) 20kg</label>
              <div class="ice-input-row">
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeSmall" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceSmall" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeSmall1" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceSmall1" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeSmall2" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceSmall2" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeSmall3" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceSmall3" value="0" placeholder="0" required>
                </div>
              </div>
            </div>
            
            <!-- Small Ice 30kg -->
            <div class="form-group ice-type-group">
              <label for="iceTypeSmall30">ទឹកកកអនាម័យតូច (Small) 30kg</label>
              <div class="ice-input-row">
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeSmall30" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceSmall30" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeSmall301" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceSmall301" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeSmall302" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceSmall302" value="0" placeholder="0" required>
                </div>
                <div class="ice-input-pair">
                  <span class="input-label">ចំណួន</span>
                  <input type="number" step="0.1" class="form-control" id="iceTypeSmall303" value="0" placeholder="0">
                  <span class="input-label">តម្លៃ</span>
                  <input type="number" class="form-control" id="unitPriceSmall303" value="0" placeholder="0" required>
                </div>
              </div>
            </div>

        <div class="form-row">
          <div class="form-group">
            <label for="oldDebt">ប្រាក់ជំពាក់ចាស់ (Old Debt)</label>
            <input type="number" class="form-control" id="oldDebt" value="0">
          </div>
          <div class="form-group">
            
            <label for="newDebt">ប្រាក់ជំពាក់ថ្មី (New Debt)</label>
            
            <input type="number" class="form-control" id="newDebt" value="0">
          </div>
          <div class="form-group">
            <label for="payment">ប្រាក់សង (Payment)</label>
            <input type="number" class="form-control" id="payment" value="0">
          </div>
          <div class="form-group">
            <label for="expenses">ថ្លៃសាំង បាយ (Expenses)</label>
            <input type="number" class="form-control" id="expenses" value="0">
          </div>
        </div>

        <div class="debt-payment-buttons" style="display: none;">
          <button type="button" id="addNewDebtBtn" class="btn btn-primary btn-sm">បន្ថែមប្រាក់ជំពាក់ថ្មី</button>
          <button type="button" id="addPaymentBtn" class="btn btn-success btn-sm">បន្ថែមប្រាក់សង</button>
        </div>

        <div class="form-row">
          <button type="submit" id="submitBtn" class="btn btn-primary">Add</button>
          <button type="button" id="cancelEditBtn" class="btn btn-secondary" style="display: none;">Cancel Edit</button>
          <!-- <button type="button" id="clearBtn" class="btn btn-warning">Clear</button> -->
        </div>
      </form>
    </div>

    <!-- Search Section -->
    <div class="card search-section">
      <h3 class="section-title">
        <span class="title-line">ស្វែងរកកំណត់ត្រាអតិថិជន</span>
      </h3>
      <div class="form-row search-actions">
        <div class="form-group">
          <input type="text" class="form-control" id="searchName" placeholder="ឈ្មោះអតិថិជន">
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
        <span class="title-line">កំណត់ត្រាលក់ទឹកកក</span>
      </h3>
      <div class="form-row">
        <button id="saveReportBtn" class="btn btn-success">រក្សាទុករបាយការណ៍ជា PDF</button>
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

  <!-- New Debt Modal -->
  <div id="newDebtModal" class="modal">
    <div class="modal-content">
      <h3>បន្ថែមប្រាក់ជំពាក់ថ្មី</h3>
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
        <p>តើអ្នកប្រាកដថាចង់លុបកំណត់ត្រាលក់នេះទេ?</p>
        <div class="modal-footer">
          <button id="confirmDeleteBtn" class="btn btn-danger">លុប</button>
          <button id="cancelDeleteBtn" class="btn btn-secondary">បោះបង់</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Add these functions

// function showClearConfirmationModal() {
//     // Create modal if it doesn't exist
//     let modal = document.getElementById('clearConfirmationModal');
//     if (!modal) {
//         modal = document.createElement('div');
//         modal.id = 'clearConfirmationModal';
//         modal.className = 'modal';
//         modal.innerHTML = `
//             <div class="modal-content">
//                 <h4>បញ្ជាក់ការលុប</h4>
//                 <p>តើអ្នកពិតជាចង់លុបព័ត៌មាននេះមែនទេ?</p>
//                 <div class="modal-buttons">
//                     <button id="confirmClearBtn" class="btn btn-danger">បាទ/ចាស</button>
//                     <p> </p>
//                     <button id="cancelClearBtn" class="btn btn-secondary">ទេ (No)</button>
//                 </div>
//             </div>
//         `;
//         document.body.appendChild(modal);
        
//         // Add event listeners
//         document.getElementById('confirmClearBtn').addEventListener('click', function() {
//             document.getElementById('customerName').value = '';
//             hideModal('clearConfirmationModal');
//         });
        
//         document.getElementById('cancelClearBtn').addEventListener('click', function() {
//             hideModal('clearConfirmationModal');
//         });
        
//         modal.addEventListener('click', function(e) {
//             if (e.target === modal) {
//                 hideModal('clearConfirmationModal');
//             }
//         });
//     }
//     showModal('clearConfirmationModal');
// }

  // Function to clear specific ice type inputs (Large 20kg, Large 30kg, Small 20kg, Small 30kg)
function clearSpecificIceTypes() {
  // List of IDs for the inputs to clear
  const iceTypeIds = [
    // Original Ice
    'iceTypeOriginal', 'unitPriceOriginal',
    'iceTypeOriginal1', 'unitPriceOriginal1',
    'iceTypeOriginal2', 'unitPriceOriginal2',
    'iceTypeOriginal3', 'unitPriceOriginal3',
    // Large Ice 20kg
    'iceTypeLarge', 'unitPriceLarge',
    'iceTypeLarge1', 'unitPriceLarge1',
    'iceTypeLarge2', 'unitPriceLarge2',
    'iceTypeLarge3', 'unitPriceLarge3',
    // Large Ice 30kg
    'iceTypeLarge30', 'unitPriceLarge30',
    'iceTypeLarge301', 'unitPriceLarge301',
    'iceTypeLarge302', 'unitPriceLarge302',
    'iceTypeLarge303', 'unitPriceLarge303',
    // Small Ice 20kg
    'iceTypeSmall', 'unitPriceSmall',
    'iceTypeSmall1', 'unitPriceSmall1',
    'iceTypeSmall2', 'unitPriceSmall2',
    'iceTypeSmall3', 'unitPriceSmall3',
    // Small Ice 30kg
    'iceTypeSmall30', 'unitPriceSmall30',
    'iceTypeSmall301', 'unitPriceSmall301',
    'iceTypeSmall302', 'unitPriceSmall302',
    'iceTypeSmall303', 'unitPriceSmall303'
  ];

  // Loop through the IDs and set their values to 0
  iceTypeIds.forEach(id => {
    const input = document.getElementById(id);
    if (input) {
      input.value = '0';
    }
  });
}

// Initialize the Clear button
document.addEventListener('DOMContentLoaded', function() {
  const clearBtn = document.getElementById('clearBtn');
  clearBtn.addEventListener('click', clearSpecificIceTypes);
});

// Alternative with custom modal
document.getElementById('clearBtn').addEventListener('click', function() {
    showClearConfirmationModal();
});


// Make sure these modal helper functions are in your code
function showModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}

function hideModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script src="script.js"></script>
</body>
</html>