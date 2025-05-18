const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');
const app = express();
const PORT = 5000;

// Middleware
app.use(cors());
app.use(express.json());

// MongoDB Connection
mongoose.connect('mongodb+srv://sokchanear0:lDSUqqnQNYBxWJll@cluster0.exfhtoc.mongodb.net/Dl_DAshboard?retryWrites=true&w=majority&appName=Cluster0', {
  useNewUrlParser: true,
  useUnifiedTopology: true,
})
.then(() => console.log('Connected to MongoDB'))
.catch(err => console.error('MongoDB connection error:', err));

// Sale Schema
const saleSchema = new mongoose.Schema({
  customerName: { type: String, required: true },
  iceTypeOriginal: { type: Number, default: 0 },
  unitPriceOriginal: { type: Number, default: 0 },
  iceTypeOriginal1: { type: Number, default: 0 },
  unitPriceOriginal1: { type: Number, default: 0 },
  iceTypeOriginal2: { type: Number, default: 0 },
  unitPriceOriginal2: { type: Number, default: 0 },
  iceTypeOriginal3: { type: Number, default: 0 },
  unitPriceOriginal3: { type: Number, default: 0 },
  iceTypeLarge: { type: Number, default: 0 },
  unitPriceLarge: { type: Number, default: 0 },
  iceTypeLarge1: { type: Number, default: 0 },
  unitPriceLarge1: { type: Number, default: 0 },
  iceTypeLarge2: { type: Number, default: 0 },
  unitPriceLarge2: { type: Number, default: 0 },
  iceTypeLarge3: { type: Number, default: 0 },
  unitPriceLarge3: { type: Number, default: 0 },
  iceTypeLarge30: { type: Number, default: 0 },
  unitPriceLarge30: { type: Number, default: 0 },
  iceTypeLarge301: { type: Number, default: 0 },
  unitPriceLarge301: { type: Number, default: 0 },
  iceTypeLarge302: { type: Number, default: 0 },
  unitPriceLarge302: { type: Number, default: 0 },
  iceTypeLarge303: { type: Number, default: 0 },
  unitPriceLarge303: { type: Number, default: 0 },
  iceTypeSmall: { type: Number, default: 0 },
  unitPriceSmall: { type: Number, default: 0 },
  iceTypeSmall1: { type: Number, default: 0 },
  unitPriceSmall1: { type: Number, default: 0 },
  iceTypeSmall2: { type: Number, default: 0 },
  unitPriceSmall2: { type: Number, default: 0 },
  iceTypeSmall3: { type: Number, default: 0 },
  unitPriceSmall3: { type: Number, default: 0 },
  iceTypeSmall30: { type: Number, default: 0 },
  unitPriceSmall30: { type: Number, default: 0 },
  iceTypeSmall301: { type: Number, default: 0 },
  unitPriceSmall301: { type: Number, default: 0 },
  iceTypeSmall302: { type: Number, default: 0 },
  unitPriceSmall302: { type: Number, default: 0 },
  iceTypeSmall303: { type: Number, default: 0 },
  unitPriceSmall303: { type: Number, default: 0 },
  oldDebt: { type: Number, default: 0 },
  newDebt: { type: Number, default: 0 },
  payment: { type: Number, default: 0 },
  expenses: { type: Number, default: 0 },
  createdAt: { type: Date, default: Date.now }
});

const Sale = mongoose.model('Sale', saleSchema);

// Routes
// Get all sales
app.get('/api/sales', async (req, res) => {
  try {
    const sales = await Sale.find();
    res.json(sales);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
});

// Get single sale
app.get('/api/sales/:id', async (req, res) => {
  try {
    const sale = await Sale.findById(req.params.id);
    if (!sale) return res.status(404).json({ message: 'Sale not found' });
    res.json(sale);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
});

// Create sale
app.post('/api/sales', async (req, res) => {
  const sale = new Sale(req.body);
  try {
    const newSale = await sale.save();
    res.status(201).json(newSale);
  } catch (err) {
    res.status(400).json({ message: err.message });
  }
});

// Update sale
app.put('/api/sales/:id', async (req, res) => {
  try {
    const sale = await Sale.findById(req.params.id);
    if (!sale) return res.status(404).json({ message: 'Sale not found' });

    // Update only provided fields
    Object.keys(req.body).forEach(key => {
      sale[key] = req.body[key];
    });

    const updatedSale = await sale.save();
    res.json(updatedSale);
  } catch (err) {
    res.status(400).json({ message: err.message });
  }
});

// Delete sale
app.delete('/api/sales/:id', async (req, res) => {
  try {
    const sale = await Sale.findById(req.params.id);
    if (!sale) return res.status(404).json({ message: 'Sale not found' });
    
    await sale.deleteOne();
    res.json({ message: 'Sale deleted' });
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
});

// Start server
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});