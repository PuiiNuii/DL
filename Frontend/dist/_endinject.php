
 
  <style>
    body {
      font-family: 'Khmer OS', 'Arial', sans-serif;
      background-color: #f8f9fa;
    }
    .card {
      border-radius: 20px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      border: none;
    }
    .card-title {
      font-weight: 600;
      color: #2c3e50;
    }
    .total-row {
      background-color: #f8f9fa;
      font-weight: bold;
    }
    .no-results {
      text-align: center;
      padding: 20px;
      color: #6c757d;
    }
    .dotted-chart-height {
      height: 300px;
    }
    .doughnut-chart-height {
      height: 265px;
    }
    .aligner-wrapper {
      position: relative;
    }
    .absolute-center {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    .summary-card {
      text-align: center;
      padding: 15px;
      border-radius: 8px;
      color: white;
    }
    .revenue-card { background-color: #3498db; }
    .debt-card { background-color: #e74c3c; }
    .expense-card { background-color: #f39c12; }
    .profit-card { background-color: #2ecc71; }
    .summary-value {
      font-size: 24px;
      font-weight: bold;
      margin: 10px 0;
    }
  </style>
</head>
<body>
  <div class="container-fluid py-4">
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="card summary-card revenue-card">
          <h5>សរុបចំណូល</h5>
          <div class="summary-value" id="totalRevenue">0 KHR</div>
          <small>ប្រចាំថ្ងៃនេះ</small>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card summary-card debt-card">
          <h5>សរុបប្រាក់ជំពាក់</h5>
          <div class="summary-value" id="totalDebt">0 KHR</div>
          <small>ប្រចាំថ្ងៃនេះ</small>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card summary-card expense-card">
          <h5>សរុបចំណាយ</h5>
          <div class="summary-value" id="totalExpenses">0 KHR</div>
          <small>ប្រចាំថ្ងៃនេះ</small>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card summary-card profit-card">
          <h5>សរុបចំណេញ</h5>
          <div class="summary-value" id="totalProfit">0 KHR</div>
          <small>ប្រចាំថ្ងៃនេះ</small>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <div class="d-sm-flex">
              <h4 class="card-title flex-shrink-1">តារាងលក់ប្រចាំថ្ងៃ</h4>
              <div class="ms-auto">
                <select class="form-select form-select-sm" id="monthSelect">
                  <option value="0">មករា</option>
                  <option value="1">កុម្ភៈ</option>
                  <option value="2">មីនា</option>
                  <option value="3">មេសា</option>
                  <option value="4">ឧសភា</option>
                  <option value="5">មិថុនា</option>
                  <option value="6">កក្កដា</option>
                  <option value="7">សីហា</option>
                  <option value="8">កញ្ញា</option>
                  <option value="9">តុលា</option>
                  <option value="10">វិច្ឆិកា</option>
                  <option value="11">ធ្នូ</option>
                </select>
              </div>
            </div>
            <div class="dotted-chart-height">
              <canvas id="monthlySalesChart"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">តារាងលក់ប្រចាំថ្ងៃ</h4>
            <div class="aligner-wrapper py-3">
              <div class="doughnut-chart-height">
                <canvas id="dailySalesChart" height="210"></canvas>
              </div>
              <div class="wrapper d-flex flex-column justify-content-center absolute absolute-center">
                <h2 class="text-center mb-0 font-weight-bold" id="todaySalesCount">0</h2>
                <small class="d-block text-center text-muted font-weight-semibold mb-0">ការលក់ថ្ងៃនេះ</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const API_URL = 'http://localhost:5000/api/sales';
    let salesData = [];
    let monthlyChart, dailyChart;

    // Format date as DD/MM/YYYY
    function formatDate(dateString) {
      const date = new Date(dateString);
      const day = date.getDate().toString().padStart(2, '0');
      const month = (date.getMonth() + 1).toString().padStart(2, '0');
      const year = date.getFullYear();
      return `${day}/${month}/${year}`;
    }

    // Load sales data and initialize charts
    async function loadSalesData() {
      try {
        const response = await fetch(API_URL);
        if (!response.ok) throw new Error('Failed to load sales data');
        salesData = await response.json();
        
        salesData = salesData.map(sale => {
          const currentDate = new Date().toISOString();
          return {
            ...sale,
            currentDate: currentDate,
            originalDate: sale.createdAt
          };
        });
        
        salesData.sort((a, b) => new Date(b.originalDate) - new Date(a.originalDate));
        
        updateDashboard();
        initializeCharts();
      } catch (error) {
        console.error('Error:', error);
        alert('Error loading sales data: ' + error.message);
      }
    }

    // Update dashboard summary
    function updateDashboard() {
      const now = new Date();
      const currentMonth = now.getMonth();
      const currentYear = now.getFullYear();
      const today = now.getDate();
      
      const monthlyData = salesData.filter(sale => {
        const saleDate = new Date(sale.currentDate);
        return saleDate.getMonth() === currentMonth && saleDate.getFullYear() === currentYear;
      });
      
      const dailyData = salesData.filter(sale => {
        const saleDate = new Date(sale.currentDate);
        return saleDate.getDate() === today && 
               saleDate.getMonth() === currentMonth && 
               saleDate.getFullYear() === currentYear;
      });
      
      let totalRevenue = 0;
      let totalDebt = 0;
      let totalExpenses = 0;
      let totalProfit = 0;
      
      monthlyData.forEach(sale => {
        const saleRevenue = calculateSaleRevenue(sale);
        const saleDebt = sale.oldDebt + sale.newDebt - sale.payment;
        
        totalRevenue += saleRevenue;
        totalDebt += saleDebt;
        totalExpenses += sale.expenses;
        totalProfit += (saleRevenue - sale.expenses);
      });
      
      document.getElementById('totalRevenue').textContent = totalRevenue.toLocaleString() + ' KHR';
      document.getElementById('totalDebt').textContent = totalDebt.toLocaleString() + ' KHR';
      document.getElementById('totalExpenses').textContent = totalExpenses.toLocaleString() + ' KHR';
      document.getElementById('totalProfit').textContent = totalProfit.toLocaleString() + ' KHR';
      
      document.getElementById('todaySalesCount').textContent = dailyData.length;
    }

    // Calculate revenue for a single sale
    function calculateSaleRevenue(sale) {
      const originalQuantities = [
        sale.iceTypeOriginal || 0,
        sale.iceTypeOriginal1 || 0,
        sale.iceTypeOriginal2 || 0,
        sale.iceTypeOriginal3 || 0
      ];
      const originalPrices = [
        sale.unitPriceOriginal || 0,
        sale.unitPriceOriginal1 || 0,
        sale.unitPriceOriginal2 || 0,
        sale.unitPriceOriginal3 || 0
      ];
      
      const largeQuantities = [
        sale.iceTypeLarge || 0,
        sale.iceTypeLarge1 || 0,
        sale.iceTypeLarge2 || 0,
        sale.iceTypeLarge3 || 0
      ];
      const largePrices = [
        sale.unitPriceLarge || 0,
        sale.unitPriceLarge1 || 0,
        sale.unitPriceLarge2 || 0,
        sale.unitPriceLarge3 || 0
      ];
      
      const large30Quantities = [
        sale.iceTypeLarge30 || 0,
        sale.iceTypeLarge301 || 0,
        sale.iceTypeLarge302 || 0,
        sale.iceTypeLarge303 || 0
      ];
      const large30Prices = [
        sale.unitPriceLarge30 || 0,
        sale.unitPriceLarge301 || 0,
        sale.unitPriceLarge302 || 0,
        sale.unitPriceLarge303 || 0
      ];
      
      const smallQuantities = [
        sale.iceTypeSmall || 0,
        sale.iceTypeSmall1 || 0,
        sale.iceTypeSmall2 || 0,
        sale.iceTypeSmall3 || 0
      ];
      const smallPrices = [
        sale.unitPriceSmall || 0,
        sale.unitPriceSmall1 || 0,
        sale.unitPriceSmall2 || 0,
        sale.unitPriceSmall3 || 0
      ];
      
      const small30Quantities = [
        sale.iceTypeSmall30 || 0,
        sale.iceTypeSmall301 || 0,
        sale.iceTypeSmall302 || 0,
        sale.iceTypeSmall303 || 0
      ];
      const small30Prices = [
        sale.unitPriceSmall30 || 0,
        sale.unitPriceSmall301 || 0,
        sale.unitPriceSmall302 || 0,
        sale.unitPriceSmall303 || 0
      ];
      
      const revenueOriginal = originalQuantities.reduce((sum, qty, i) => sum + (qty * (originalPrices[i] || 0)), 0);
      const revenueLarge = largeQuantities.reduce((sum, qty, i) => sum + (qty * (largePrices[i] || 0)), 0);
      const revenueLarge30 = large30Quantities.reduce((sum, qty, i) => sum + (qty * (large30Prices[i] || 0)), 0);
      const revenueSmall = smallQuantities.reduce((sum, qty, i) => sum + (qty * (smallPrices[i] || 0)), 0);
      const revenueSmall30 = small30Quantities.reduce((sum, qty, i) => sum + (qty * (small30Prices[i] || 0)), 0);
      
      return revenueOriginal + revenueLarge + revenueLarge30 + revenueSmall + revenueSmall30;
    }

    // Initialize charts
    function initializeCharts() {
      const monthlyCtx = document.getElementById('monthlySalesChart');
      
      const now = new Date();
      const daysInMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();
      const dailySales = Array(daysInMonth).fill(0);
      
      salesData.forEach(sale => {
        const saleDate = new Date(sale.currentDate);
        if (saleDate.getMonth() === now.getMonth() && saleDate.getFullYear() === now.getFullYear()) {
          const day = saleDate.getDate() - 1;
          dailySales[day] += calculateSaleRevenue(sale);
        }
      });
      
      monthlyChart = new Chart(monthlyCtx, {
        type: 'bar',
        data: {
          labels: Array.from({length: daysInMonth}, (_, i) => i + 1),
          datasets: [{
            label: 'ចំណូលប្រចាំថ្ងៃ',
            data: dailySales,
            backgroundColor: '#3498db',
            borderRadius: 5,
            barPercentage: 0.8,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              title: {
                display: true,
                text: 'ថ្ងៃ'
              }
            },
            y: {
              title: {
                display: true,
                text: 'ចំនួនទឹកប្រាក់ (KHR)'
              },
              beginAtZero: true
            }
          },
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return context.parsed.y.toLocaleString() + ' KHR';
                }
              }
            }
          }
        }
      });
      
      const dailyCtx = document.getElementById('dailySalesChart');
      
      const today = new Date();
      const todaySales = salesData.filter(sale => {
        const saleDate = new Date(sale.currentDate);
        return saleDate.getDate() === today.getDate() && 
               saleDate.getMonth() === today.getMonth() && 
               saleDate.getFullYear() === today.getFullYear();
      });
      
      let originalTotal = 0;
      let largeTotal = 0;
      let large30Total = 0;
      let smallTotal = 0;
      let small30Total = 0;
      
      todaySales.forEach(sale => {
        originalTotal += (sale.iceTypeOriginal || 0) + (sale.iceTypeOriginal1 || 0) + 
                         (sale.iceTypeOriginal2 || 0) + (sale.iceTypeOriginal3 || 0);
        largeTotal += (sale.iceTypeLarge || 0) + (sale.iceTypeLarge1 || 0) + 
                      (sale.iceTypeLarge2 || 0) + (sale.iceTypeLarge3 || 0);
        large30Total += (sale.iceTypeLarge30 || 0) + (sale.iceTypeLarge301 || 0) + 
                        (sale.iceTypeLarge302 || 0) + (sale.iceTypeLarge303 || 0);
        smallTotal += (sale.iceTypeSmall || 0) + (sale.iceTypeSmall1 || 0) + 
                      (sale.iceTypeSmall2 || 0) + (sale.iceTypeSmall3 || 0);
        small30Total += (sale.iceTypeSmall30 || 0) + (sale.iceTypeSmall301 || 0) + 
                        (sale.iceTypeSmall302 || 0) + (sale.iceTypeSmall303 || 0);
      });
      
      dailyChart = new Chart(dailyCtx, {
        type: 'doughnut',
        data: {
          labels: ['ទឹកកកដើម', 'អនាម័យធំ 20kg', 'អនាម័យធំ 30kg', 'អនាម័យតូច 20kg', 'អនាម័យតូច 30kg'],
          datasets: [{
            data: [originalTotal, largeTotal, large30Total, smallTotal, small30Total],
            backgroundColor: ['#3498db', '#e74c3c', '#f39c12', '#2ecc71', '#9b59b6'],
            borderWidth: 0
          }]
        },
        options: {
          cutout: '70%',
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                boxWidth: 12,
                padding: 20
              }
            }
          }
        }
      });
      
      document.getElementById('monthSelect').addEventListener('change', function() {
        const selectedMonth = parseInt(this.value);
        const now = new Date();
        const year = now.getFullYear();
        
        if (selectedMonth > now.getMonth() && year === now.getFullYear()) {
          alert('ខែនេះមិនទាន់មានទិន្នន័យនៅឡើយទេ!');
          this.value = now.getMonth();
          return;
        }
        
        const monthlyData = salesData.filter(sale => {
          const saleDate = new Date(sale.currentDate);
          return saleDate.getMonth() === selectedMonth && saleDate.getFullYear() === year;
        });
        
        const daysInMonth = new Date(year, selectedMonth + 1, 0).getDate();
        const dailySales = Array(daysInMonth).fill(0);
        
        monthlyData.forEach(sale => {
          const saleDate = new Date(sale.currentDate);
          const day = saleDate.getDate() - 1;
          dailySales[day] += calculateSaleRevenue(sale);
        });
        
        monthlyChart.data.labels = Array.from({length: daysInMonth}, (_, i) => i + 1);
        monthlyChart.data.datasets[0].data = dailySales;
        monthlyChart.update();
        
        let totalRevenue = 0;
        let totalDebt = 0;
        let totalExpenses = 0;
        let totalProfit = 0;
        
        monthlyData.forEach(sale => {
          const saleRevenue = calculateSaleRevenue(sale);
          const saleDebt = sale.oldDebt + sale.newDebt - sale.payment;
          
          totalRevenue += saleRevenue;
          totalDebt += saleDebt;
          totalExpenses += sale.expenses;
          totalProfit += (saleRevenue - sale.expenses);
        });
        
        document.getElementById('totalRevenue').textContent = totalRevenue.toLocaleString() + ' KHR';
        document.getElementById('totalDebt').textContent = totalDebt.toLocaleString() + ' KHR';
        document.getElementById('totalExpenses').textContent = totalExpenses.toLocaleString() + ' KHR';
        document.getElementById('totalProfit').textContent = totalProfit.toLocaleString() + ' KHR';
      });
    }

    document.addEventListener('DOMContentLoaded', function() {
      const now = new Date();
      document.getElementById('monthSelect').value = now.getMonth();
      loadSalesData();
    });
  </script>
</body>
</html>