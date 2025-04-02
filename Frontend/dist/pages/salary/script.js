const API_URL = 'http://localhost:5000/api/sales';
let salesData = [];
let filteredData = [];
let currentSaleId = null;

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
    
    const large30Quantities = [
      sale.iceTypeLarge30 || 0,
      sale.iceTypeLarge301 || 0,
      sale.iceTypeLarge302 || 0,
      sale.iceTypeLarge303 || 0
    ].filter(qty => qty > 0);
    
    const smallQuantities = [
      sale.iceTypeSmall || 0,
      sale.iceTypeSmall1 || 0,
      sale.iceTypeSmall2 || 0,
      sale.iceTypeSmall3 || 0
    ].filter(qty => qty > 0);
    
    const small30Quantities = [
      sale.iceTypeSmall30 || 0,
      sale.iceTypeSmall301 || 0,
      sale.iceTypeSmall302 || 0,
      sale.iceTypeSmall303 || 0
    ].filter(qty => qty > 0);

    // Calculate total quantities for each type
    const totalOriginal = originalQuantities.reduce((sum, qty) => sum + qty, 0);
    const totalLarge = largeQuantities.reduce((sum, qty) => sum + qty, 0);
    const totalLarge30 = large30Quantities.reduce((sum, qty) => sum + qty, 0);
    const totalSmall = smallQuantities.reduce((sum, qty) => sum + qty, 0);
    const totalSmall30 = small30Quantities.reduce((sum, qty) => sum + qty, 0);

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
    
    const large30Prices = [
      sale.unitPriceLarge30 || 0,
      sale.unitPriceLarge301 || 0,
      sale.unitPriceLarge302 || 0,
      sale.unitPriceLarge303 || 0
    ].filter(price => price > 0);
    
    const smallPrices = [
      sale.unitPriceSmall || 0,
      sale.unitPriceSmall1 || 0,
      sale.unitPriceSmall2 || 0,
      sale.unitPriceSmall3 || 0
    ].filter(price => price > 0);
    
    const small30Prices = [
      sale.unitPriceSmall30 || 0,
      sale.unitPriceSmall301 || 0,
      sale.unitPriceSmall302 || 0,
      sale.unitPriceSmall303 || 0
    ].filter(price => price > 0);

    const revenueOriginal = originalQuantities.reduce((sum, qty, i) => sum + (qty * (originalPrices[i] || 0)), 0);
    const revenueLarge = largeQuantities.reduce((sum, qty, i) => sum + (qty * (largePrices[i] || 0)), 0);
    const revenueLarge30 = large30Quantities.reduce((sum, qty, i) => sum + (qty * (large30Prices[i] || 0)), 0);
    const revenueSmall = smallQuantities.reduce((sum, qty, i) => sum + (qty * (smallPrices[i] || 0)), 0);
    const revenueSmall30 = small30Quantities.reduce((sum, qty, i) => sum + (qty * (small30Prices[i] || 0)), 0);
    
    const totalRevenuePerSale = revenueOriginal + revenueLarge + revenueLarge30 + revenueSmall + revenueSmall30;
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
      ${originalQuantities.length > 0 ? `<div><span class="original">ទឹកកកដើម (${totalOriginal})</span></div>` : ''}
      ${largeQuantities.length > 0 ? `<div><span class="large">អនាម័យធំ 20kg (${totalLarge})</span></div>` : ''}
      ${large30Quantities.length > 0 ? `<div><span class="large">អនាម័យធំ 30kg (${totalLarge30})</span></div>` : ''}
      ${smallQuantities.length > 0 ? `<div><span class="small">អនាម័យតូច 20kg (${totalSmall})</span></div>` : ''}
      ${small30Quantities.length > 0 ? `<div><span class="small">អនាម័យតូច 30kg (${totalSmall30})</span></div>` : ''}
    </div>
  </td>
  <td>
    <div class="quantity-display">
      ${originalQuantities.length > 0 ? `<div>${originalQuantities.join('<br>')}</div>` : ''}
      ${largeQuantities.length > 0 ? `<div>${largeQuantities.join('<br>')}</div>` : ''}
      ${large30Quantities.length > 0 ? `<div>${large30Quantities.join('<br>')}</div>` : ''}
      ${smallQuantities.length > 0 ? `<div>${smallQuantities.join('<br>')}</div>` : ''}
      ${small30Quantities.length > 0 ? `<div>${small30Quantities.join('<br>')}</div>` : ''}
    </div>
  </td>
  <td>
    <div class="price-display">
      ${originalPrices.length > 0 ? `<div>${originalPrices.map(p => `${p.toLocaleString()} KHR`).join('<br>')}</div>` : ''}
      ${largePrices.length > 0 ? `<div>${largePrices.map(p => `${p.toLocaleString()} KHR`).join('<br>')}</div>` : ''}
      ${large30Prices.length > 0 ? `<div>${large30Prices.map(p => `${p.toLocaleString()} KHR`).join('<br>')}</div>` : ''}
      ${smallPrices.length > 0 ? `<div>${smallPrices.map(p => `${p.toLocaleString()} KHR`).join('<br>')}</div>` : ''}
      ${small30Prices.length > 0 ? `<div>${small30Prices.map(p => `${p.toLocaleString()} KHR`).join('<br>')}</div>` : ''}
    </div>
  </td>
  <td>
      <div class="total-display">
        ${revenueOriginal > 0 ? `<div>${revenueOriginal.toLocaleString()} KHR</div>` : ''}
        ${revenueLarge > 0 ? `<div>${revenueLarge.toLocaleString()} KHR</div>` : ''}
        ${revenueLarge30 > 0 ? `<div>${revenueLarge30.toLocaleString()} KHR</div>` : ''}
        ${revenueSmall > 0 ? `<div>${revenueSmall.toLocaleString()} KHR</div>` : ''}
        ${revenueSmall30 > 0 ? `<div>${revenueSmall30.toLocaleString()} KHR</div>` : ''}
      </div>
  </td>
  <td>${sale.oldDebt.toLocaleString()} KHR</td> 
  <td>${sale.newDebt.toLocaleString()} KHR</td>
  <td>${sale.payment.toLocaleString()} KHR</td>
  <td>${totalDebtPerSale.toLocaleString()} KHR</td>
  <td>${sale.expenses.toLocaleString()} KHR</td>
  <td>${totalRevenuePerSale.toLocaleString()} KHR</td>
  <td>  
    <div class="action-buttons">
      <button class="btn btn-info btn-sm edit-btn" data-id="${sale._id}">កែ</button>
      <button class="btn btn-danger btn-sm delete-btn" data-id="${sale._id}">លុប</button>
    </div>
  </td>
`;
    tableBody.appendChild(row);
  });

  const totalsRow = document.createElement('tr');
  totalsRow.className = 'total-row';
  totalsRow.innerHTML = `
    <td colspan="3">សរុប (${data.length} កំណត់ត្រា)</td>
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

  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => editSale(btn.dataset.id));
  });

  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => showDeleteConfirmation(btn.dataset.id));
  });
}

// ... rest of your existing code remains the same ...

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
    
    iceTypeLarge30: parseFloat(document.getElementById('iceTypeLarge30').value) || 0,
    unitPriceLarge30: parseFloat(document.getElementById('unitPriceLarge30').value) || 0,
    iceTypeLarge301: parseFloat(document.getElementById('iceTypeLarge301').value) || 0,
    unitPriceLarge301: parseFloat(document.getElementById('unitPriceLarge301').value) || 0,
    iceTypeLarge302: parseFloat(document.getElementById('iceTypeLarge302').value) || 0,
    unitPriceLarge302: parseFloat(document.getElementById('unitPriceLarge302').value) || 0,
    iceTypeLarge303: parseFloat(document.getElementById('iceTypeLarge303').value) || 0,
    unitPriceLarge303: parseFloat(document.getElementById('unitPriceLarge303').value) || 0,
    
    iceTypeSmall: parseFloat(document.getElementById('iceTypeSmall').value) || 0,
    unitPriceSmall: parseFloat(document.getElementById('unitPriceSmall').value) || 0,
    iceTypeSmall1: parseFloat(document.getElementById('iceTypeSmall1').value) || 0,
    unitPriceSmall1: parseFloat(document.getElementById('unitPriceSmall1').value) || 0,
    iceTypeSmall2: parseFloat(document.getElementById('iceTypeSmall2').value) || 0,
    unitPriceSmall2: parseFloat(document.getElementById('unitPriceSmall2').value) || 0,
    iceTypeSmall3: parseFloat(document.getElementById('iceTypeSmall3').value) || 0,
    unitPriceSmall3: parseFloat(document.getElementById('unitPriceSmall3').value) || 0,
    
    iceTypeSmall30: parseFloat(document.getElementById('iceTypeSmall30').value) || 0,
    unitPriceSmall30: parseFloat(document.getElementById('unitPriceSmall30').value) || 0,
    iceTypeSmall301: parseFloat(document.getElementById('iceTypeSmall301').value) || 0,
    unitPriceSmall301: parseFloat(document.getElementById('unitPriceSmall301').value) || 0,
    iceTypeSmall302: parseFloat(document.getElementById('iceTypeSmall302').value) || 0,
    unitPriceSmall302: parseFloat(document.getElementById('unitPriceSmall302').value) || 0,
    iceTypeSmall303: parseFloat(document.getElementById('iceTypeSmall303').value) || 0,
    unitPriceSmall303: parseFloat(document.getElementById('unitPriceSmall303').value) || 0,
    
    oldDebt: parseFloat(document.getElementById('oldDebt').value) || 0,
    newDebt: parseFloat(document.getElementById('newDebt').value) || 0,
    payment: parseFloat(document.getElementById('payment').value) || 0,
    expenses: parseFloat(document.getElementById('expenses').value) || 0
  };

  try {
    let response;
    const saleId = document.getElementById('saleId').value;
    
    if (saleId) {
      const existingSale = salesData.find(s => s._id === saleId);
      if (!existingSale) throw new Error('Sale not found in local data');
      formData.oldDebt = existingSale.oldDebt;
      
      response = await fetch(`${API_URL}/${saleId}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });
    } else {
      response = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });
    }

    if (!response.ok) {
      const errorText = await response.text();
      throw new Error(saleId ? `Failed to update sale: ${errorText}` : `Failed to save sale: ${errorText}`);
    }

    const updatedSale = await response.json();
    
    if (saleId) {
      const index = salesData.findIndex(s => s._id === saleId);
      if (index !== -1) salesData[index] = updatedSale;
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

async function editSale(id) {
  try {
    const response = await fetch(`${API_URL}/${id}`);
    if (!response.ok) throw new Error('Failed to fetch sale data');
    
    const sale = await response.json();
    
    document.getElementById('saleId').value = sale._id;
    document.getElementById('customerName').value = sale.customerName;
    
    document.getElementById('iceTypeOriginal').value = sale.iceTypeOriginal || 0;
    document.getElementById('unitPriceOriginal').value = sale.unitPriceOriginal || 0;
    document.getElementById('iceTypeOriginal1').value = sale.iceTypeOriginal1 || 0;
    document.getElementById('unitPriceOriginal1').value = sale.unitPriceOriginal1 || 0;
    document.getElementById('iceTypeOriginal2').value = sale.iceTypeOriginal2 || 0;
    document.getElementById('unitPriceOriginal2').value = sale.unitPriceOriginal2 || 0;
    document.getElementById('iceTypeOriginal3').value = sale.iceTypeOriginal3 || 0;
    document.getElementById('unitPriceOriginal3').value = sale.unitPriceOriginal3 || 0;
    
    document.getElementById('iceTypeLarge').value = sale.iceTypeLarge || 0;
    document.getElementById('unitPriceLarge').value = sale.unitPriceLarge || 0;
    document.getElementById('iceTypeLarge1').value = sale.iceTypeLarge1 || 0;
    document.getElementById('unitPriceLarge1').value = sale.unitPriceLarge1 || 0;
    document.getElementById('iceTypeLarge2').value = sale.iceTypeLarge2 || 0;
    document.getElementById('unitPriceLarge2').value = sale.unitPriceLarge2 || 0;
    document.getElementById('iceTypeLarge3').value = sale.iceTypeLarge3 || 0;
    document.getElementById('unitPriceLarge3').value = sale.unitPriceLarge3 || 0;
    
    document.getElementById('iceTypeLarge30').value = sale.iceTypeLarge30 || 0;
    document.getElementById('unitPriceLarge30').value = sale.unitPriceLarge30 || 0;
    document.getElementById('iceTypeLarge301').value = sale.iceTypeLarge301 || 0;
    document.getElementById('unitPriceLarge301').value = sale.unitPriceLarge301 || 0;
    document.getElementById('iceTypeLarge302').value = sale.iceTypeLarge302 || 0;
    document.getElementById('unitPriceLarge302').value = sale.unitPriceLarge302 || 0;
    document.getElementById('iceTypeLarge303').value = sale.iceTypeLarge303 || 0;
    document.getElementById('unitPriceLarge303').value = sale.unitPriceLarge303 || 0;
    
    document.getElementById('iceTypeSmall').value = sale.iceTypeSmall || 0;
    document.getElementById('unitPriceSmall').value = sale.unitPriceSmall || 0;
    document.getElementById('iceTypeSmall1').value = sale.iceTypeSmall1 || 0;
    document.getElementById('unitPriceSmall1').value = sale.unitPriceSmall1 || 0;
    document.getElementById('iceTypeSmall2').value = sale.iceTypeSmall2 || 0;
    document.getElementById('unitPriceSmall2').value = sale.unitPriceSmall2 || 0;
    document.getElementById('iceTypeSmall3').value = sale.iceTypeSmall3 || 0;
    document.getElementById('unitPriceSmall3').value = sale.unitPriceSmall3 || 0;
    
    document.getElementById('iceTypeSmall30').value = sale.iceTypeSmall30 || 0;
    document.getElementById('unitPriceSmall30').value = sale.unitPriceSmall30 || 0;
    document.getElementById('iceTypeSmall301').value = sale.iceTypeSmall301 || 0;
    document.getElementById('unitPriceSmall301').value = sale.unitPriceSmall301 || 0;
    document.getElementById('iceTypeSmall302').value = sale.iceTypeSmall302 || 0;
    document.getElementById('unitPriceSmall302').value = sale.unitPriceSmall302 || 0;
    document.getElementById('iceTypeSmall303').value = sale.iceTypeSmall303 || 0;
    document.getElementById('unitPriceSmall303').value = sale.unitPriceSmall303 || 0;
    
    const oldDebtInput = document.getElementById('oldDebt');
    const newDebtInput = document.getElementById('newDebt');
    const paymentInput = document.getElementById('payment');
    const totalDebtDisplay = document.createElement('span');
    
    oldDebtInput.value = sale.oldDebt || 0;
    oldDebtInput.disabled = true;
    newDebtInput.value = sale.newDebt || 0;
    newDebtInput.disabled = true; // Disable direct input
    paymentInput.value = sale.payment || 0;
    paymentInput.disabled = true; // Disable direct input
    document.getElementById('expenses').value = sale.expenses || 0;

    totalDebtDisplay.id = 'totalDebtDisplay';
    totalDebtDisplay.style.marginLeft = '10px';
    oldDebtInput.parentNode.appendChild(totalDebtDisplay);

    function updateDebtDisplay() {
      const oldDebt = parseFloat(oldDebtInput.value) || 0;
      const newDebt = parseFloat(newDebtInput.value) || 0;
      const payment = parseFloat(paymentInput.value) || 0;
      const totalDebt = oldDebt + newDebt - payment;
      totalDebtDisplay.textContent = `សរុបប្រាក់ជំពាក់: ${totalDebt.toLocaleString()}`;
    }

    updateDebtDisplay();
    paymentInput.addEventListener('input', updateDebtDisplay);
    newDebtInput.addEventListener('input', updateDebtDisplay);

    document.getElementById('submitBtn').textContent = 'Update';
    document.getElementById('cancelEditBtn').style.display = 'inline-block';
    document.querySelector('.debt-payment-buttons').style.display = 'block';
    
    document.querySelector('.form-section').scrollIntoView({ behavior: 'smooth' });
  } catch (error) {
    console.error('Error:', error);
    alert('Error loading sale data: ' + error.message);
  }
}



function resetForm() {
  document.getElementById('iceSaleForm').reset();
  document.getElementById('saleId').value = '';
  document.getElementById('submitBtn').textContent = 'Add';
  document.getElementById('cancelEditBtn').style.display = 'none';
  
  // Re-enable all fields for new entries
  document.getElementById('oldDebt').disabled = false;
  document.getElementById('newDebt').disabled = false;
  document.getElementById('payment').disabled = false;
  
  document.querySelector('.debt-payment-buttons').style.display = 'none';
  
  const totalDebtDisplay = document.getElementById('totalDebtDisplay');
  if (totalDebtDisplay) totalDebtDisplay.remove();
}

document.getElementById('cancelEditBtn').addEventListener('click', resetForm);

async function deleteSale(id) {
  try {
    const response = await fetch(`${API_URL}/${id}`, {
      method: 'DELETE'
    });
    
    if (!response.ok) throw new Error('Failed to delete sale');
    
    salesData = salesData.filter(sale => sale._id !== id);
    updateTable(salesData);
    hideModal('deleteModal');
  } catch (error) {
    console.error('Error:', error);
    alert('Error deleting sale: ' + error.message);
  }
}

function showDeleteConfirmation(id) {
  currentSaleId = id;
  showModal('deleteModal');
}

document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
  if (currentSaleId) deleteSale(currentSaleId);
});

document.getElementById('cancelDeleteBtn').addEventListener('click', () => {
  hideModal('deleteModal');
  currentSaleId = null;
});

function showModal(modalId) {
  document.getElementById(modalId).style.display = 'flex';
}

function hideModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

document.querySelectorAll('.modal').forEach(modal => {
  modal.addEventListener('click', (e) => {
    if (e.target === modal || e.target.classList.contains('close-modal')) {
      hideModal(modal.id);
      currentSaleId = null;
    }
  });
});

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

document.getElementById('clearSearchBtn').addEventListener('click', function() {
  document.getElementById('searchName').value = '';
  filteredData = [];
  updateTable(salesData);
});

document.getElementById('addNewDebtBtn').addEventListener('click', () => {
  if (!document.getElementById('saleId').value) {
    alert('សូមជ្រើសរើសកំណត់ត្រាដើម្បីកែសម្រួលជាមុន!');
    return;
  }
  showModal('newDebtModal');
  document.getElementById('newDebtAmount').value = '';
});

document.getElementById('addPaymentBtn').addEventListener('click', () => {
  if (!document.getElementById('saleId').value) {
    alert('សូមជ្រើសរើសកំណត់ត្រាដើម្បីកែសម្រួលជាមុន!');
    return;
  }
  showModal('paymentModal');
  document.getElementById('paymentAmount').value = '';
});

document.getElementById('confirmNewDebtBtn').addEventListener('click', async () => {
  const newDebtAmount = parseFloat(document.getElementById('newDebtAmount').value) || 0;
  if (newDebtAmount <= 0) {
    alert('សូមបញ្ចូលចំនួនទឹកប្រាក់ធំជាង 0!');
    return;
  }

  const saleId = document.getElementById('saleId').value;
  const currentNewDebt = parseFloat(document.getElementById('newDebt').value) || 0;
  const updatedNewDebt = currentNewDebt + newDebtAmount;

  try {
    const response = await fetch(`${API_URL}/${saleId}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ newDebt: updatedNewDebt })
    });

    if (!response.ok) throw new Error('Failed to update new debt');
    
    const updatedSale = await response.json();
    const index = salesData.findIndex(s => s._id === saleId);
    if (index !== -1) salesData[index] = updatedSale;
    
    document.getElementById('newDebt').value = updatedNewDebt;
    updateTable(salesData);
    hideModal('newDebtModal');
    document.getElementById('newDebt').dispatchEvent(new Event('input'));
  } catch (error) {
    console.error('Error:', error);
    alert('Error updating new debt: ' + error.message);
  }
});

document.getElementById('confirmPaymentBtn').addEventListener('click', async () => {
  const paymentAmount = parseFloat(document.getElementById('paymentAmount').value) || 0;
  if (paymentAmount <= 0) {
    alert('សូមបញ្ចូលចំនួនទឹកប្រាក់ធំជាង 0!');
    return;
  }

  const saleId = document.getElementById('saleId').value;
  const currentPayment = parseFloat(document.getElementById('payment').value) || 0;
  const updatedPayment = currentPayment + paymentAmount;

  try {
    const response = await fetch(`${API_URL}/${saleId}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ payment: updatedPayment })
    });

    if (!response.ok) throw new Error('Failed to update payment');
    
    const updatedSale = await response.json();
    const index = salesData.findIndex(s => s._id === saleId);
    if (index !== -1) salesData[index] = updatedSale;
    
    document.getElementById('payment').value = updatedPayment;
    updateTable(salesData);
    hideModal('paymentModal');
    document.getElementById('payment').dispatchEvent(new Event('input'));
  } catch (error) {
    console.error('Error:', error);
    alert('Error updating payment: ' + error.message);
  }
});


function saveReport() {
  const today = new Date();
  const dateString = `${today.getDate().toString().padStart(2, '0')}/${(today.getMonth() + 1).toString().padStart(2, '0')}/${today.getFullYear()}`;
  
  // Select the table element to capture
  const tableElement = document.getElementById('tableBody').parentElement;
  
  // Create a temporary container for the report
  const reportContainer = document.createElement('div');
  reportContainer.style.position = 'absolute';
  reportContainer.style.left = '-9999px';
  reportContainer.style.width = '1500px';  // A4 width at 96 DPI
  reportContainer.style.backgroundColor = 'white';
  reportContainer.style.padding = '20px';
  reportContainer.style.boxSizing = 'border-box';
  reportContainer.style.fontSize = '12px';
  document.body.appendChild(reportContainer);
  
  // Add title and date
  const title = document.createElement('h2');
  title.textContent = `របាយការណ៍លក់ទឹកកក - ${dateString}`;
  title.style.textAlign = 'center';
  title.style.marginBottom = '20px';
  title.style.fontSize = '18px';
  reportContainer.appendChild(title);
  
  // Clone the table and adjust its styling
  const tableClone = tableElement.cloneNode(true);
  tableClone.style.width = '100%';
  tableClone.style.fontSize = '10px';
  tableClone.style.borderCollapse = 'collapse';
  
  // Style table elements
  const cells = tableClone.querySelectorAll('td, th');
  cells.forEach(cell => {
    cell.style.padding = '5px';
    cell.style.border = '1px solid black';
    cell.style.wordWrap = 'break-word';
  });
  
  reportContainer.appendChild(tableClone);
  
  // Generate PDF using jsPDF
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({
    orientation: 'portrait',
    unit: 'mm',
    format: 'a4'
  });
  
  html2canvas(reportContainer, {
    scale: 2,
    logging: false,
    useCORS: true,
    allowTaint: true
  }).then(canvas => {
    const imgData = canvas.toDataURL('image/png');
    const imgWidth = 210; // A4 width in mm
    const pageHeight = 297; // A4 height in mm
    const imgHeight = (canvas.height * imgWidth) / canvas.width;
    let heightLeft = imgHeight;
    let position = 0;

    // Add first page
    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
    heightLeft -= pageHeight;

    // Add additional pages if content exceeds one page
    while (heightLeft >= 0) {
      position = heightLeft - imgHeight;
      doc.addPage();
      doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
      heightLeft -= pageHeight;
    }

    // Save the PDF
    doc.save(`Ice_Sales_Report_${dateString.replace(/\//g, '-')}.pdf`);
    
    // Clean up
    document.body.removeChild(reportContainer);
  }).catch(error => {
    console.error('Error generating PDF report:', error);
    alert('Error generating PDF report: ' + error.message);
    document.body.removeChild(reportContainer);
  });
}

document.getElementById('saveReportBtn').addEventListener('click', saveReport);

async function loadSalesData() {
  try {
    const response = await fetch(API_URL);
    if (!response.ok) throw new Error('Failed to load sales data');
    salesData = await response.json();
    salesData.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));
    updateTable(salesData);
  } catch (error) {
    console.error('Error:', error);
    alert('Error loading sales data: ' + error.message);
  }
}

loadSalesData();