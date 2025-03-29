
// const API_URL = 'http://localhost:5000/api/sales';
// let salesData = [];
// let filteredData = [];
// let currentSaleId = null;

// // Function to update the table with sales data
// function updateTable(data = salesData) {
//   const tableBody = document.getElementById('tableBody');
//   tableBody.innerHTML = '';

//   if (data.length === 0) {
//     const row = document.createElement('tr');
//     row.innerHTML = `<td colspan="13" class="no-results">No records found</td>`;
//     tableBody.appendChild(row);
//     return;
//   }

//   let totalRevenue = 0;
//   let totalDebt = 0;
//   let totalExpenses = 0;
//   let totalNetIncome = 0;

//   data.forEach((sale, index) => {
//     const revenueOriginal = sale.iceTypeOriginal * sale.unitPriceOriginal;
//     const revenueLarge = sale.iceTypeLarge * sale.unitPriceLarge;
//     const revenueSmall = sale.iceTypeSmall * sale.unitPriceSmall;
//     const totalRevenuePerSale = revenueOriginal + revenueLarge + revenueSmall;
//     const totalDebtPerSale = sale.oldDebt + sale.newDebt - sale.payment;
//     const netIncome = totalRevenuePerSale - sale.expenses;

//     totalRevenue += totalRevenuePerSale;
//     totalDebt += totalDebtPerSale;
//     totalExpenses += sale.expenses;
//     totalNetIncome += netIncome;

//     const row = document.createElement('tr');
//     row.innerHTML = `
//       <td>${index + 1}</td>
//       <td>${sale.customerName}</td>
//       <td>
//         <div class="ice-type-display">
//           ${sale.iceTypeOriginal > 0 ? `<div><span class="original">ទឹកកកដើម</span></div>` : ''}
//           ${sale.iceTypeLarge > 0 ? `<div><span class="large">អនាម័យធំ</span></div>` : ''}
//           ${sale.iceTypeSmall > 0 ? `<div><span class="small">អនាម័យតូច</span></div>` : ''}
//         </div>
//       </td>
//       <td>
//         <div class="quantity-display">
//           ${sale.iceTypeOriginal > 0 ? `<div>${sale.iceTypeOriginal}</div>` : ''}
//           ${sale.iceTypeLarge > 0 ? `<div>${sale.iceTypeLarge}</div>` : ''}
//           ${sale.iceTypeSmall > 0 ? `<div>${sale.iceTypeSmall}</div>` : ''}
//         </div>
//       </td>
//       <td>
//         <div class="price-display">
//           ${sale.iceTypeOriginal > 0 ? `<div>${sale.unitPriceOriginal.toLocaleString()}</div>` : ''}
//           ${sale.iceTypeLarge > 0 ? `<div>${sale.unitPriceLarge.toLocaleString()}</div>` : ''}
//           ${sale.iceTypeSmall > 0 ? `<div>${sale.unitPriceSmall.toLocaleString()}</div>` : ''}
//         </div>
//       </td>
//       <td>
//         <div class="total-display">
//           ${revenueOriginal > 0 ? `<div>${revenueOriginal.toLocaleString()}</div>` : ''}
//           ${revenueLarge > 0 ? `<div>${revenueLarge.toLocaleString()}</div>` : ''}
//           ${revenueSmall > 0 ? `<div>${revenueSmall.toLocaleString()}</div>` : ''}
//         </div>
//       </td>
//       <td>${sale.oldDebt.toLocaleString()}</td>
//       <td>${sale.newDebt.toLocaleString()}</td>
//       <td>${sale.payment.toLocaleString()}</td>
//       <td>${totalDebtPerSale.toLocaleString()}</td>
//       <td>${sale.expenses.toLocaleString()}</td>
//       <td>${totalRevenuePerSale.toLocaleString()}</td>
//       <td>
//         <div class="action-buttons">
//           <button class="btn btn-info btn-sm edit-btn" data-id="${sale._id}">Edit</button>
//           <button class="btn btn-danger btn-sm delete-btn" data-id="${sale._id}">Delete</button>
//         </div>
//       </td>
//     `;
//     tableBody.appendChild(row);
//   });

//   // Add grand totals row
//   const totalsRow = document.createElement('tr');
//   totalsRow.className = 'total-row';
//   totalsRow.innerHTML = `
//     <td colspan="3">Grand Totals (${data.length} records)</td>
//     <td></td>
//     <td></td>
//     <td>${totalRevenue.toLocaleString()}</td>
//     <td></td>
//     <td></td>
//     <td></td>
//     <td>${totalDebt.toLocaleString()}</td>
//     <td>${totalExpenses.toLocaleString()}</td>
//     <td>${totalNetIncome.toLocaleString()}</td>
//     <td></td>
//   `;
//   tableBody.appendChild(totalsRow);

//   // Add event listeners to edit and delete buttons
//   document.querySelectorAll('.edit-btn').forEach(btn => {
//     btn.addEventListener('click', () => editSale(btn.dataset.id));
//   });

//   document.querySelectorAll('.delete-btn').forEach(btn => {
//     btn.addEventListener('click', () => showDeleteConfirmation(btn.dataset.id));
//   });
// }

// // Form submission handler
// document.getElementById('iceSaleForm').addEventListener('submit', async function(e) {
//   e.preventDefault();

//   const formData = {
//     customerName: document.getElementById('customerName').value,
//     iceTypeOriginal: parseFloat(document.getElementById('iceTypeOriginal').value) || 0,
//     unitPriceOriginal: parseFloat(document.getElementById('unitPriceOriginal').value) || 0,
//     iceTypeLarge: parseFloat(document.getElementById('iceTypeLarge').value) || 0,
//     unitPriceLarge: parseFloat(document.getElementById('unitPriceLarge').value) || 0,
//     iceTypeSmall: parseFloat(document.getElementById('iceTypeSmall').value) || 0,
//     unitPriceSmall: parseFloat(document.getElementById('unitPriceSmall').value) || 0,
//     oldDebt: parseFloat(document.getElementById('oldDebt').value) || 0,
//     newDebt: parseFloat(document.getElementById('newDebt').value) || 0,
//     payment: parseFloat(document.getElementById('payment').value) || 0,
//     expenses: parseFloat(document.getElementById('expenses').value) || 0
//   };

//   try {
//     let response;
//     const saleId = document.getElementById('saleId').value;
    
//     if (saleId) {
//       response = await fetch(`${API_URL}/${saleId}`, {
//         method: 'PUT',
//         headers: {
//           'Content-Type': 'application/json',
//         },
//         body: JSON.stringify(formData)
//       });
//     } else {
//       response = await fetch(API_URL, {
//         method: 'POST',
//         headers: {
//           'Content-Type': 'application/json',
//         },
//         body: JSON.stringify(formData)
//       });
//     }

//     if (!response.ok) {
//       throw new Error(saleId ? 'Failed to update sale' : 'Failed to save sale');
//     }

//     const updatedSale = await response.json();
    
//     if (saleId) {
//       const index = salesData.findIndex(s => s._id === saleId);
//       if (index !== -1) {
//         salesData[index] = updatedSale;
//       }
//     } else {
//       salesData.push(updatedSale);
//     }
    
//     updateTable(salesData);
//     resetForm();
//   } catch (error) {
//     console.error('Error:', error);
//     alert('Error: ' + error.message);
//   }
// });

// // Edit sale function
// async function editSale(id) {
//   try {
//     const response = await fetch(`${API_URL}/${id}`);
//     if (!response.ok) {
//       throw new Error('Failed to fetch sale data');
//     }
    
//     const sale = await response.json();
    
//     document.getElementById('saleId').value = sale._id;
//     document.getElementById('customerName').value = sale.customerName;
//     document.getElementById('iceTypeOriginal').value = sale.iceTypeOriginal;
//     document.getElementById('unitPriceOriginal').value = sale.unitPriceOriginal;
//     document.getElementById('iceTypeLarge').value = sale.iceTypeLarge;
//     document.getElementById('unitPriceLarge').value = sale.unitPriceLarge;
//     document.getElementById('iceTypeSmall').value = sale.iceTypeSmall;
//     document.getElementById('unitPriceSmall').value = sale.unitPriceSmall;
//     document.getElementById('oldDebt').value = sale.oldDebt;
//     document.getElementById('newDebt').value = sale.newDebt;
//     document.getElementById('payment').value = sale.payment;
//     document.getElementById('expenses').value = sale.expenses;
    
//     document.getElementById('submitBtn').textContent = 'Update Entry';
//     document.getElementById('cancelEditBtn').style.display = 'inline-block';
    
//     document.querySelector('.form-section').scrollIntoView({ behavior: 'smooth' });
//   } catch (error) {
//     console.error('Error:', error);
//     alert('Error loading sale data: ' + error.message);
//   }
// }

// // Cancel edit function
// document.getElementById('cancelEditBtn').addEventListener('click', resetForm);

// function resetForm() {
//   document.getElementById('iceSaleForm').reset();
//   document.getElementById('saleId').value = '';
//   document.getElementById('submitBtn').textContent = 'Add Entry';
//   document.getElementById('cancelEditBtn').style.display = 'none';
// }

// // Delete sale function
// async function deleteSale(id) {
//   try {
//     const response = await fetch(`${API_URL}/${id}`, {
//       method: 'DELETE'
//     });
    
//     if (!response.ok) {
//       throw new Error('Failed to delete sale');
//     }
    
//     salesData = salesData.filter(sale => sale._id !== id);
//     updateTable(salesData);
//     hideModal('deleteModal');
//   } catch (error) {
//     console.error('Error:', error);
//     alert('Error deleting sale: ' + error.message);
//   }
// }

// // Show delete confirmation
// function showDeleteConfirmation(id) {
//   currentSaleId = id;
//   showModal('deleteModal');
// }

// // Confirm delete button
// document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
//   if (currentSaleId) {
//     deleteSale(currentSaleId);
//   }
// });

// // Cancel delete button
// document.getElementById('cancelDeleteBtn').addEventListener('click', () => {
//   hideModal('deleteModal');
//   currentSaleId = null;
// });

// // Modal functions
// function showModal(modalId) {
//   document.getElementById(modalId).style.display = 'flex';
// }

// function hideModal(modalId) {
//   document.getElementById(modalId).style.display = 'none';
// }

// // Close modals when clicking X or outside
// document.querySelectorAll('.modal').forEach(modal => {
//   modal.addEventListener('click', (e) => {
//     if (e.target === modal || e.target.classList.contains('close-modal')) {
//       hideModal(modal.id);
//       currentSaleId = null;
//     }
//   });
// });

// // Search button handler
// document.getElementById('searchBtn').addEventListener('click', function() {
//   const searchTerm = document.getElementById('searchName').value.trim().toLowerCase();
  
//   if (!searchTerm) {
//     alert('Please enter a customer name to search');
//     return;
//   }

//   filteredData = salesData.filter(sale => 
//     sale.customerName.toLowerCase().includes(searchTerm)
//   );

//   updateTable(filteredData);
// });

// // Clear search button handler
// document.getElementById('clearSearchBtn').addEventListener('click', function() {
//   document.getElementById('searchName').value = '';
//   filteredData = [];
//   updateTable(salesData);
// });

// // Save report function (Styled Excel format)
// function saveReport() {
//   const today = new Date();
//   const dateString = `${today.getDate().toString().padStart(2, '0')}/${(today.getMonth() + 1).toString().padStart(2, '0')}/${today.getFullYear()}`;
  
//   // Prepare data for Excel
//   const data = filteredData.length > 0 ? filteredData : salesData; // Use filtered data if available
//   const reportData = [];

//   // Headers
//   reportData.push([
//     "ល.រ", "គោត្តនាម", "ប្រភេទទឹកកក", "បរិមាណ", "តម្លៃរាយ", "សរុប", 
//     "ប្រាក់ជំពាក់ចាស់", "ប្រាក់ជំពាក់ថ្មី", "ប្រាក់សង", "សរុបប្រាក់ជំពាក់", 
//     "ថ្លៃសាំង បាយ", "សរុបចំណូល"
//   ]);

//   // Data rows
//   data.forEach((sale, index) => {
//     const revenueOriginal = sale.iceTypeOriginal * sale.unitPriceOriginal;
//     const revenueLarge = sale.iceTypeLarge * sale.unitPriceLarge;
//     const revenueSmall = sale.iceTypeSmall * sale.unitPriceSmall;
//     const totalRevenuePerSale = revenueOriginal + revenueLarge + revenueSmall;
//     const totalDebtPerSale = sale.oldDebt + sale.newDebt - sale.payment;

//     const iceTypes = [];
//     const quantities = [];
//     const unitPrices = [];
//     const totals = [];

//     if (sale.iceTypeOriginal > 0) {
//       iceTypes.push("ទឹកកកដើម");
//       quantities.push(sale.iceTypeOriginal);
//       unitPrices.push(sale.unitPriceOriginal);
//       totals.push(revenueOriginal);
//     }
//     if (sale.iceTypeLarge > 0) {
//       iceTypes.push("អនាម័យធំ");
//       quantities.push(sale.iceTypeLarge);
//       unitPrices.push(sale.unitPriceLarge);
//       totals.push(revenueLarge);
//     }
//     if (sale.iceTypeSmall > 0) {
//       iceTypes.push("អនាម័យតូច");
//       quantities.push(sale.iceTypeSmall);
//       unitPrices.push(sale.unitPriceSmall);
//       totals.push(revenueSmall);
//     }

//     reportData.push([
//       index + 1,
//       sale.customerName,
//       iceTypes.join("\n"),
//       quantities.join("\n"),
//       unitPrices.join("\n"),
//       totals.join("\n"),
//       sale.oldDebt,
//       sale.newDebt,
//       sale.payment,
//       totalDebtPerSale,
//       sale.expenses,
//       totalRevenuePerSale
//     ]);
//   });

//   // Totals row
//   const totalRevenue = data.reduce((sum, sale) => sum + (sale.iceTypeOriginal * sale.unitPriceOriginal + sale.iceTypeLarge * sale.unitPriceLarge + sale.iceTypeSmall * sale.unitPriceSmall), 0);
//   const totalDebt = data.reduce((sum, sale) => sum + (sale.oldDebt + sale.newDebt - sale.payment), 0);
//   const totalExpenses = data.reduce((sum, sale) => sum + sale.expenses, 0);
//   const totalNetIncome = totalRevenue - totalExpenses;

//   reportData.push([
//     "Grand Totals (" + data.length + " records)", "", "", "", "", totalRevenue, 
//     "", "", "", totalDebt, totalExpenses, totalNetIncome
//   ]);

//   // Create worksheet and workbook
//   const ws = XLSX.utils.aoa_to_sheet(reportData);
//   const wb = XLSX.utils.book_new();

//   // Styling
//   const range = XLSX.utils.decode_range(ws['!ref']);
  
//   // Column widths
//   ws['!cols'] = [
//     { wch: 5 },  // ល.រ
//     { wch: 20 }, // គោត្តនាម
//     { wch: 15 }, // ប្រភេទទឹកកក
//     { wch: 10 }, // បរិមាណ
//     { wch: 10 }, // តម្លៃរាយ
//     { wch: 12 }, // សរុប
//     { wch: 15 }, // ប្រាក់ជំពាក់ចាស់
//     { wch: 15 }, // ប្រាក់ជំពាក់ថ្មី
//     { wch: 12 }, // ប្រាក់សង
//     { wch: 15 }, // សរុបប្រាក់ជំពាក់
//     { wch: 15 }, // ថ្លៃសាំង បាយ
//     { wch: 15 }  // សរុបចំណូល
//   ];

//   // Style headers (row 0)
//   for (let col = range.s.c; col <= range.e.c; col++) {
//     const cell = ws[XLSX.utils.encode_cell({ r: 0, c: col })];
//     if (cell) {
//       cell.s = {
//         font: { bold: true },
//         fill: { fgColor: { rgb: "3498DB" } }, // Blue background
//         alignment: { horizontal: "center", vertical: "center" },
//         border: {
//           top: { style: "thin" },
//           bottom: { style: "thin" },
//           left: { style: "thin" },
//           right: { style: "thin" }
//         }
//       };
//     }
//   }

//   // Style data rows
//   for (let row = 1; row < reportData.length - 1; row++) {
//     for (let col = range.s.c; col <= range.e.c; col++) {
//       const cell = ws[XLSX.utils.encode_cell({ r: row, c: col })];
//       if (cell) {
//         cell.s = {
//           alignment: { horizontal: "center", vertical: "center", wrapText: true },
//           border: {
//             top: { style: "thin" },
//             bottom: { style: "thin" },
//             left: { style: "thin" },
//             right: { style: "thin" }
//           }
//         };
//       }
//     }
//   }

//   // Style totals row (last row)
//   const lastRow = reportData.length - 1;
//   for (let col = range.s.c; col <= range.e.c; col++) {
//     const cell = ws[XLSX.utils.encode_cell({ r: lastRow, c: col })];
//     if (cell) {
//       cell.s = {
//         font: { bold: true },
//         fill: { fgColor: { rgb: "E3F2FD" } }, // Light blue background
//         alignment: { horizontal: "center", vertical: "center" },
//         border: {
//           top: { style: "thin" },
//           bottom: { style: "thin" },
//           left: { style: "thin" },
//           right: { style: "thin" }
//         }
//       };
//     }
//   }

//   // Add title above table
//   XLSX.utils.sheet_add_aoa(ws, [[`Ice Sales Report - ${dateString}`]], { origin: "A1" });
//   ws["A1"].s = { font: { sz: 16, bold: true }, alignment: { horizontal: "center" } };
//   XLSX.utils.sheet_add_aoa(ws, [reportData[0]], { origin: "A2" }); // Move headers to row 2
//   XLSX.utils.sheet_add_aoa(ws, reportData.slice(1), { origin: "A3" }); // Data starts at row 3
//   ws['!ref'] = XLSX.utils.encode_range({ s: { r: 0, c: 0 }, e: { r: lastRow + 1, c: range.e.c } });

//   // Merge title cell across columns
//   ws["!merges"] = [{ s: { r: 0, c: 0 }, e: { r: 0, c: range.e.c } }];

//   XLSX.utils.book_append_sheet(wb, ws, "Ice Sales Report");

//   // Generate and download Excel file
//   XLSX.writeFile(wb, `Ice_Sales_Report_${dateString}.xlsx`);
// }

// // Attach save report button handler
// document.getElementById('saveReportBtn').addEventListener('click', saveReport);

// // Load sales data from backend
// async function loadSalesData() {
//   try {
//     const response = await fetch(API_URL);
//     if (!response.ok) {
//       throw new Error('Failed to load sales data');
//     }
//     salesData = await response.json();
    
//     // Sort by createdAt (newest first) since saleDate is removed
//     salesData.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));
    
//     updateTable(salesData);
//   } catch (error) {
//     console.error('Error:', error);
//     alert('Error loading sales data: ' + error.message);
//   }
// }

// // Initialize by loading data
// loadSalesData();

const API_URL = 'http://localhost:5000/api/sales';
let salesData = [];
let filteredData = [];
let currentSaleId = null;

// Function to update the table with sales data
function updateTable(data = salesData) {
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

  data.forEach((sale, index) => {
    // Calculate totals for each ice type
    const originalQuantities = [
      sale.iceTypeOriginal || 0,
      sale.iceTypeOriginal1 || 0,
      sale.iceTypeOriginal2 || 0,
      sale.iceTypeOriginal3 || 0
    ].filter(qty => qty > 0);
    
    const largeQuantities = [
      sale.iceTypeLarge || 0,
      sale.iceTypeLarge1 || 0,
      sale.iceTypeLarge2 || 0,
      sale.iceTypeLarge3 || 0
    ].filter(qty => qty > 0);
    
    const smallQuantities = [
      sale.iceTypeSmall || 0,
      sale.iceTypeSmall1 || 0,
      sale.iceTypeSmall2 || 0,
      sale.iceTypeSmall3 || 0
    ].filter(qty => qty > 0);

    const originalPrices = [
      sale.unitPriceOriginal || 0,
      sale.unitPriceOriginal1 || 0,
      sale.unitPriceOriginal2 || 0,
      sale.unitPriceOriginal3 || 0
    ].filter(price => price > 0);
    
    const largePrices = [
      sale.unitPriceLarge || 0,
      sale.unitPriceLarge1 || 0,
      sale.unitPriceLarge2 || 0,
      sale.unitPriceLarge3 || 0
    ].filter(price => price > 0);
    
    const smallPrices = [
      sale.unitPriceSmall || 0,
      sale.unitPriceSmall1 || 0,
      sale.unitPriceSmall2 || 0,
      sale.unitPriceSmall3 || 0
    ].filter(price => price > 0);

    // Calculate revenues
    const revenueOriginal = originalQuantities.reduce((sum, qty, i) => sum + (qty * (originalPrices[i] || 0)), 0);
    const revenueLarge = largeQuantities.reduce((sum, qty, i) => sum + (qty * (largePrices[i] || 0)), 0);
    const revenueSmall = smallQuantities.reduce((sum, qty, i) => sum + (qty * (smallPrices[i] || 0)), 0);
    
    const totalRevenuePerSale = revenueOriginal + revenueLarge + revenueSmall;
    const totalDebtPerSale = sale.oldDebt + sale.newDebt - sale.payment;
    const netIncome = totalRevenuePerSale - sale.expenses;

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
          ${originalQuantities.length > 0 ? `<div><span class="original">ទឹកកកដើម</span></div>` : ''}
          ${largeQuantities.length > 0 ? `<div><span class="large">អនាម័យធំ</span></div>` : ''}
          ${smallQuantities.length > 0 ? `<div><span class="small">អនាម័យតូច</span></div>` : ''}
        </div>
      </td>
      <td>
        <div class="quantity-display">
          ${originalQuantities.length > 0 ? `<div>${originalQuantities.join('<br>')}</div>` : ''}
          ${largeQuantities.length > 0 ? `<div>${largeQuantities.join('<br>')}</div>` : ''}
          ${smallQuantities.length > 0 ? `<div>${smallQuantities.join('<br>')}</div>` : ''}
        </div>
      </td>
      <td>
        <div class="price-display">
          ${originalPrices.length > 0 ? `<div>${originalPrices.map(p => p.toLocaleString()).join('<br>')}</div>` : ''}
          ${largePrices.length > 0 ? `<div>${largePrices.map(p => p.toLocaleString()).join('<br>')}</div>` : ''}
          ${smallPrices.length > 0 ? `<div>${smallPrices.map(p => p.toLocaleString()).join('<br>')}</div>` : ''}
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
  });

  // Add grand totals row
  const totalsRow = document.createElement('tr');
  totalsRow.className = 'total-row';
  totalsRow.innerHTML = `
    <td colspan="3">Grand Totals (${data.length} records)</td>
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

  const formData = {
    customerName: document.getElementById('customerName').value,
    iceTypeOriginal: parseFloat(document.getElementById('iceTypeOriginal').value) || 0,
    unitPriceOriginal: parseFloat(document.getElementById('unitPriceOriginal').value) || 0,
    iceTypeOriginal1: parseFloat(document.getElementById('iceTypeOriginal1').value) || 0,
    unitPriceOriginal1: parseFloat(document.getElementById('unitPriceOriginal1').value) || 0,
    iceTypeOriginal2: parseFloat(document.getElementById('iceTypeOriginal2').value) || 0,
    unitPriceOriginal2: parseFloat(document.getElementById('unitPriceOriginal2').value) || 0,
    iceTypeOriginal3: parseFloat(document.getElementById('iceTypeOriginal3').value) || 0,
    unitPriceOriginal3: parseFloat(document.getElementById('unitPriceOriginal3').value) || 0,
    iceTypeLarge: parseFloat(document.getElementById('iceTypeLarge').value) || 0,
    unitPriceLarge: parseFloat(document.getElementById('unitPriceLarge').value) || 0,
    iceTypeLarge1: parseFloat(document.getElementById('iceTypeLarge1').value) || 0,
    unitPriceLarge1: parseFloat(document.getElementById('unitPriceLarge1').value) || 0,
    iceTypeLarge2: parseFloat(document.getElementById('iceTypeLarge2').value) || 0,
    unitPriceLarge2: parseFloat(document.getElementById('unitPriceLarge2').value) || 0,
    iceTypeLarge3: parseFloat(document.getElementById('iceTypeLarge3').value) || 0,
    unitPriceLarge3: parseFloat(document.getElementById('unitPriceLarge3').value) || 0,
    iceTypeSmall: parseFloat(document.getElementById('iceTypeSmall').value) || 0,
    unitPriceSmall: parseFloat(document.getElementById('unitPriceSmall').value) || 0,
    iceTypeSmall1: parseFloat(document.getElementById('iceTypeSmall1').value) || 0,
    unitPriceSmall1: parseFloat(document.getElementById('unitPriceSmall1').value) || 0,
    iceTypeSmall2: parseFloat(document.getElementById('iceTypeSmall2').value) || 0,
    unitPriceSmall2: parseFloat(document.getElementById('unitPriceSmall2').value) || 0,
    iceTypeSmall3: parseFloat(document.getElementById('iceTypeSmall3').value) || 0,
    unitPriceSmall3: parseFloat(document.getElementById('unitPriceSmall3').value) || 0,
    oldDebt: parseFloat(document.getElementById('oldDebt').value) || 0,
    newDebt: parseFloat(document.getElementById('newDebt').value) || 0,
    payment: parseFloat(document.getElementById('payment').value) || 0,
    expenses: parseFloat(document.getElementById('expenses').value) || 0
  };

  try {
    let response;
    const saleId = document.getElementById('saleId').value;
    
    if (saleId) {
      response = await fetch(`${API_URL}/${saleId}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
      });
    } else {
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
      const index = salesData.findIndex(s => s._id === saleId);
      if (index !== -1) {
        salesData[index] = updatedSale;
      }
    } else {
      salesData.push(updatedSale);
    }
    
    updateTable(salesData);
    resetForm();
  } catch (error) {
    console.error('Error:', error);
    alert('Error: ' + error.message);
  }
});

// Edit sale function
async function editSale(id) {
  try {
    const response = await fetch(`${API_URL}/${id}`);
    if (!response.ok) {
      throw new Error('Failed to fetch sale data');
    }
    
    const sale = await response.json();
    
    document.getElementById('saleId').value = sale._id;
    document.getElementById('customerName').value = sale.customerName;
    
    // Original ice
    document.getElementById('iceTypeOriginal').value = sale.iceTypeOriginal || 0;
    document.getElementById('unitPriceOriginal').value = sale.unitPriceOriginal || 0;
    document.getElementById('iceTypeOriginal1').value = sale.iceTypeOriginal1 || 0;
    document.getElementById('unitPriceOriginal1').value = sale.unitPriceOriginal1 || 0;
    document.getElementById('iceTypeOriginal2').value = sale.iceTypeOriginal2 || 0;
    document.getElementById('unitPriceOriginal2').value = sale.unitPriceOriginal2 || 0;
    document.getElementById('iceTypeOriginal3').value = sale.iceTypeOriginal3 || 0;
    document.getElementById('unitPriceOriginal3').value = sale.unitPriceOriginal3 || 0;
    
    // Large ice
    document.getElementById('iceTypeLarge').value = sale.iceTypeLarge || 0;
    document.getElementById('unitPriceLarge').value = sale.unitPriceLarge || 0;
    document.getElementById('iceTypeLarge1').value = sale.iceTypeLarge1 || 0;
    document.getElementById('unitPriceLarge1').value = sale.unitPriceLarge1 || 0;
    document.getElementById('iceTypeLarge2').value = sale.iceTypeLarge2 || 0;
    document.getElementById('unitPriceLarge2').value = sale.unitPriceLarge2 || 0;
    document.getElementById('iceTypeLarge3').value = sale.iceTypeLarge3 || 0;
    document.getElementById('unitPriceLarge3').value = sale.unitPriceLarge3 || 0;
    
    // Small ice
    document.getElementById('iceTypeSmall').value = sale.iceTypeSmall || 0;
    document.getElementById('unitPriceSmall').value = sale.unitPriceSmall || 0;
    document.getElementById('iceTypeSmall1').value = sale.iceTypeSmall1 || 0;
    document.getElementById('unitPriceSmall1').value = sale.unitPriceSmall1 || 0;
    document.getElementById('iceTypeSmall2').value = sale.iceTypeSmall2 || 0;
    document.getElementById('unitPriceSmall2').value = sale.unitPriceSmall2 || 0;
    document.getElementById('iceTypeSmall3').value = sale.iceTypeSmall3 || 0;
    document.getElementById('unitPriceSmall3').value = sale.unitPriceSmall3 || 0;
    
    // Debt and expenses
    document.getElementById('oldDebt').value = sale.oldDebt || 0;
    document.getElementById('newDebt').value = sale.newDebt || 0;
    document.getElementById('payment').value = sale.payment || 0;
    document.getElementById('expenses').value = sale.expenses || 0;
    
    document.getElementById('submitBtn').textContent = 'Update Entry';
    document.getElementById('cancelEditBtn').style.display = 'inline-block';
    
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
    
    salesData = salesData.filter(sale => sale._id !== id);
    updateTable(salesData);
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
  updateTable(salesData);
});

// Save report function (Styled Excel format)
function saveReport() {
  const today = new Date();
  const dateString = `${today.getDate().toString().padStart(2, '0')}/${(today.getMonth() + 1).toString().padStart(2, '0')}/${today.getFullYear()}`;
  
  // Prepare data for Excel
  const data = filteredData.length > 0 ? filteredData : salesData;
  const reportData = [];

  // Headers
  reportData.push([
    "ល.រ", "គោត្តនាម", "ប្រភេទទឹកកក", "បរិមាណ", "តម្លៃរាយ", "សរុប", 
    "ប្រាក់ជំពាក់ចាស់", "ប្រាក់ជំពាក់ថ្មី", "ប្រាក់សង", "សរុបប្រាក់ជំពាក់", 
    "ថ្លៃសាំង បាយ", "សរុបចំណូល"
  ]);

  // Data rows
  data.forEach((sale, index) => {
    // Calculate totals for each ice type
    const originalQuantities = [
      sale.iceTypeOriginal || 0,
      sale.iceTypeOriginal1 || 0,
      sale.iceTypeOriginal2 || 0,
      sale.iceTypeOriginal3 || 0
    ].filter(qty => qty > 0);
    
    const largeQuantities = [
      sale.iceTypeLarge || 0,
      sale.iceTypeLarge1 || 0,
      sale.iceTypeLarge2 || 0,
      sale.iceTypeLarge3 || 0
    ].filter(qty => qty > 0);
    
    const smallQuantities = [
      sale.iceTypeSmall || 0,
      sale.iceTypeSmall1 || 0,
      sale.iceTypeSmall2 || 0,
      sale.iceTypeSmall3 || 0
    ].filter(qty => qty > 0);

    const originalPrices = [
      sale.unitPriceOriginal || 0,
      sale.unitPriceOriginal1 || 0,
      sale.unitPriceOriginal2 || 0,
      sale.unitPriceOriginal3 || 0
    ].filter(price => price > 0);
    
    const largePrices = [
      sale.unitPriceLarge || 0,
      sale.unitPriceLarge1 || 0,
      sale.unitPriceLarge2 || 0,
      sale.unitPriceLarge3 || 0
    ].filter(price => price > 0);
    
    const smallPrices = [
      sale.unitPriceSmall || 0,
      sale.unitPriceSmall1 || 0,
      sale.unitPriceSmall2 || 0,
      sale.unitPriceSmall3 || 0
    ].filter(price => price > 0);

    // Calculate revenues
    const revenueOriginal = originalQuantities.reduce((sum, qty, i) => sum + (qty * (originalPrices[i] || 0)), 0);
    const revenueLarge = largeQuantities.reduce((sum, qty, i) => sum + (qty * (largePrices[i] || 0)), 0);
    const revenueSmall = smallQuantities.reduce((sum, qty, i) => sum + (qty * (smallPrices[i] || 0)), 0);
    const totalRevenuePerSale = revenueOriginal + revenueLarge + revenueSmall;
    const totalDebtPerSale = sale.oldDebt + sale.newDebt - sale.payment;

    const iceTypes = [];
    const quantities = [];
    const unitPrices = [];
    const totals = [];

    if (originalQuantities.length > 0) {
      iceTypes.push("ទឹកកកដើម");
      quantities.push(originalQuantities.join("\n"));
      unitPrices.push(originalPrices.map(p => p.toLocaleString()).join("\n"));
      totals.push(revenueOriginal.toLocaleString());
    }
    if (largeQuantities.length > 0) {
      iceTypes.push("អនាម័យធំ");
      quantities.push(largeQuantities.join("\n"));
      unitPrices.push(largePrices.map(p => p.toLocaleString()).join("\n"));
      totals.push(revenueLarge.toLocaleString());
    }
    if (smallQuantities.length > 0) {
      iceTypes.push("អនាម័យតូច");
      quantities.push(smallQuantities.join("\n"));
      unitPrices.push(smallPrices.map(p => p.toLocaleString()).join("\n"));
      totals.push(revenueSmall.toLocaleString());
    }

    reportData.push([
      index + 1,
      sale.customerName,
      iceTypes.join("\n"),
      quantities.join("\n"),
      unitPrices.join("\n"),
      totals.join("\n"),
      sale.oldDebt,
      sale.newDebt,
      sale.payment,
      totalDebtPerSale,
      sale.expenses,
      totalRevenuePerSale
    ]);
  });

  // Totals row
  const totalRevenue = data.reduce((sum, sale) => {
    const original = [
      sale.iceTypeOriginal || 0,
      sale.iceTypeOriginal1 || 0,
      sale.iceTypeOriginal2 || 0,
      sale.iceTypeOriginal3 || 0
    ].reduce((s, qty, i) => s + (qty * ([
      sale.unitPriceOriginal || 0,
      sale.unitPriceOriginal1 || 0,
      sale.unitPriceOriginal2 || 0,
      sale.unitPriceOriginal3 || 0
    ][i] || 0)), 0);
    
    const large = [
      sale.iceTypeLarge || 0,
      sale.iceTypeLarge1 || 0,
      sale.iceTypeLarge2 || 0,
      sale.iceTypeLarge3 || 0
    ].reduce((s, qty, i) => s + (qty * ([
      sale.unitPriceLarge || 0,
      sale.unitPriceLarge1 || 0,
      sale.unitPriceLarge2 || 0,
      sale.unitPriceLarge3 || 0
    ][i] || 0)), 0);
    
    const small = [
      sale.iceTypeSmall || 0,
      sale.iceTypeSmall1 || 0,
      sale.iceTypeSmall2 || 0,
      sale.iceTypeSmall3 || 0
    ].reduce((s, qty, i) => s + (qty * ([
      sale.unitPriceSmall || 0,
      sale.unitPriceSmall1 || 0,
      sale.unitPriceSmall2 || 0,
      sale.unitPriceSmall3 || 0
    ][i] || 0)), 0);
    
    return sum + original + large + small;
  }, 0);
  
  const totalDebt = data.reduce((sum, sale) => sum + (sale.oldDebt + sale.newDebt - sale.payment), 0);
  const totalExpenses = data.reduce((sum, sale) => sum + sale.expenses, 0);
  const totalNetIncome = totalRevenue - totalExpenses;

  reportData.push([
    "Grand Totals (" + data.length + " records)", "", "", "", "", totalRevenue, 
    "", "", "", totalDebt, totalExpenses, totalNetIncome
  ]);

  // Create worksheet and workbook
  const ws = XLSX.utils.aoa_to_sheet(reportData);
  const wb = XLSX.utils.book_new();

  // Styling
  const range = XLSX.utils.decode_range(ws['!ref']);
  
  // Column widths
  ws['!cols'] = [
    { wch: 5 },  // ល.រ
    { wch: 20 }, // គោត្តនាម
    { wch: 15 }, // ប្រភេទទឹកកក
    { wch: 10 }, // បរិមាណ
    { wch: 10 }, // តម្លៃរាយ
    { wch: 12 }, // សរុប
    { wch: 15 }, // ប្រាក់ជំពាក់ចាស់
    { wch: 15 }, // ប្រាក់ជំពាក់ថ្មី
    { wch: 12 }, // ប្រាក់សង
    { wch: 15 }, // សរុបប្រាក់ជំពាក់
    { wch: 15 }, // ថ្លៃសាំង បាយ
    { wch: 15 }  // សរុបចំណូល
  ];

  // Style headers (row 0)
  for (let col = range.s.c; col <= range.e.c; col++) {
    const cell = ws[XLSX.utils.encode_cell({ r: 0, c: col })];
    if (cell) {
      cell.s = {
        font: { bold: true },
        fill: { fgColor: { rgb: "3498DB" } }, // Blue background
        alignment: { horizontal: "center", vertical: "center" },
        border: {
          top: { style: "thin" },
          bottom: { style: "thin" },
          left: { style: "thin" },
          right: { style: "thin" }
        }
      };
    }
  }

  // Style data rows
  for (let row = 1; row < reportData.length - 1; row++) {
    for (let col = range.s.c; col <= range.e.c; col++) {
      const cell = ws[XLSX.utils.encode_cell({ r: row, c: col })];
      if (cell) {
        cell.s = {
          alignment: { horizontal: "center", vertical: "center", wrapText: true },
          border: {
            top: { style: "thin" },
            bottom: { style: "thin" },
            left: { style: "thin" },
            right: { style: "thin" }
          }
        };
      }
    }
  }

  // Style totals row (last row)
  const lastRow = reportData.length - 1;
  for (let col = range.s.c; col <= range.e.c; col++) {
    const cell = ws[XLSX.utils.encode_cell({ r: lastRow, c: col })];
    if (cell) {
      cell.s = {
        font: { bold: true },
        fill: { fgColor: { rgb: "E3F2FD" } }, // Light blue background
        alignment: { horizontal: "center", vertical: "center" },
        border: {
          top: { style: "thin" },
          bottom: { style: "thin" },
          left: { style: "thin" },
          right: { style: "thin" }
        }
      };
    }
  }

  // Add title above table
  XLSX.utils.sheet_add_aoa(ws, [[`Ice Sales Report - ${dateString}`]], { origin: "A1" });
  ws["A1"].s = { font: { sz: 16, bold: true }, alignment: { horizontal: "center" } };
  XLSX.utils.sheet_add_aoa(ws, [reportData[0]], { origin: "A2" }); // Move headers to row 2
  XLSX.utils.sheet_add_aoa(ws, reportData.slice(1), { origin: "A3" }); // Data starts at row 3
  ws['!ref'] = XLSX.utils.encode_range({ s: { r: 0, c: 0 }, e: { r: lastRow + 1, c: range.e.c } });

  // Merge title cell across columns
  ws["!merges"] = [{ s: { r: 0, c: 0 }, e: { r: 0, c: range.e.c } }];

  XLSX.utils.book_append_sheet(wb, ws, "Ice Sales Report");

  // Generate and download Excel file
  XLSX.writeFile(wb, `Ice_Sales_Report_${dateString}.xlsx`);
}

// Attach save report button handler
document.getElementById('saveReportBtn').addEventListener('click', saveReport);

// Load sales data from backend
async function loadSalesData() {
  try {
    const response = await fetch(API_URL);
    if (!response.ok) {
      throw new Error('Failed to load sales data');
    }
    salesData = await response.json();
    
    // Sort by createdAt (newest first)
    salesData.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));
    
    updateTable(salesData);
  } catch (error) {
    console.error('Error:', error);
    alert('Error loading sales data: ' + error.message);
  }
}

// Initialize by loading data
loadSalesData();