


// const express = require('express');
// const router = express.Router();
// const Sale = require('../models/Sale');

// // Create a new sale record
// router.post('/', async (req, res) => {
//   try {
//     const saleData = req.body;

//     // Validate required fields
//     if (!saleData.customerName) {
//       return res.status(400).json({ message: 'Customer name is required' });
//     }

//     const newSale = new Sale(saleData);
//     await newSale.save();

//     res.status(201).json(newSale);
//   } catch (error) {
//     res.status(500).json({ message: error.message });
//   }
// });

// // Get all sales records
// router.get('/', async (req, res) => {
//   try {
//     const sales = await Sale.find().sort({ createdAt: -1 }); // Sort by createdAt descending
//     res.json(sales);
//   } catch (error) {
//     res.status(500).json({ message: error.message });
//   }
// });

// // Get a single sale record
// router.get('/:id', async (req, res) => {
//   try {
//     const sale = await Sale.findById(req.params.id);
//     if (!sale) {
//       return res.status(404).json({ message: 'Sale record not found' });
//     }
//     res.json(sale);
//   } catch (error) {
//     res.status(500).json({ message: error.message });
//   }
// });

// // Update a sale record
// router.put('/:id', async (req, res) => {
//   try {
//     const updatedSale = await Sale.findByIdAndUpdate(
//       req.params.id,
//       req.body,
//       { new: true, runValidators: true }
//     );

//     if (!updatedSale) {
//       return res.status(404).json({ message: 'Sale record not found' });
//     }

//     res.json(updatedSale);
//   } catch (error) {
//     res.status(500).json({ message: error.message });
//   }
// });

// // Delete a sale record
// router.delete('/:id', async (req, res) => {
//   try {
//     const deletedSale = await Sale.findByIdAndDelete(req.params.id);

//     if (!deletedSale) {
//       return res.status(404).json({ message: 'Sale record not found' });
//     }

//     res.json({ message: 'Sale record deleted successfully' });
//   } catch (error) {
//     res.status(500).json({ message: error.message });
//   }
// });

// module.exports = router;



const express = require('express');
const router = express.Router();
const Sale = require('../models/Sale');

// Create a new sale record
router.post('/', async (req, res) => {
  try {
    const saleData = req.body;

    // Validate required fields
    if (!saleData.customerName) {
      return res.status(400).json({ message: 'Customer name is required' });
    }

    // Set default values for all fields to handle missing data
    const defaultSale = {
      iceTypeOriginal: 0, unitPriceOriginal: 0,
      iceTypeOriginal1: 0, unitPriceOriginal1: 0,
      iceTypeOriginal2: 0, unitPriceOriginal2: 0,
      iceTypeOriginal3: 0, unitPriceOriginal3: 0,
      iceTypeLarge: 0, unitPriceLarge: 0,
      iceTypeLarge1: 0, unitPriceLarge1: 0,
      iceTypeLarge2: 0, unitPriceLarge2: 0,
      iceTypeLarge3: 0, unitPriceLarge3: 0,
      iceTypeSmall: 0, unitPriceSmall: 0,
      iceTypeSmall1: 0, unitPriceSmall1: 0,
      iceTypeSmall2: 0, unitPriceSmall2: 0,
      iceTypeSmall3: 0, unitPriceSmall3: 0,
      oldDebt: 0, newDebt: 0, payment: 0, expenses: 0
    };

    const newSale = new Sale({ ...defaultSale, ...saleData });
    await newSale.save();

    res.status(201).json(newSale);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

// Get all sales records with calculated virtual fields
router.get('/', async (req, res) => {
  try {
    const sales = await Sale.find().sort({ createdAt: -1 });
    
    // Map the sales to include virtual fields in the response
    const salesWithVirtuals = sales.map(sale => ({
      ...sale.toObject(),
      totalOriginalQuantity: sale.totalOriginalQuantity,
      totalLargeQuantity: sale.totalLargeQuantity,
      totalSmallQuantity: sale.totalSmallQuantity,
      revenueOriginal: sale.revenueOriginal,
      revenueLarge: sale.revenueLarge,
      revenueSmall: sale.revenueSmall,
      totalRevenue: sale.totalRevenue,
      totalDebt: sale.totalDebt,
      netIncome: sale.netIncome
    }));
    
    res.json(salesWithVirtuals);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

// Get a single sale record
router.get('/:id', async (req, res) => {
  try {
    const sale = await Sale.findById(req.params.id);
    if (!sale) {
      return res.status(404).json({ message: 'Sale record not found' });
    }
    
    // Include virtual fields in the response
    const saleWithVirtuals = {
      ...sale.toObject(),
      totalOriginalQuantity: sale.totalOriginalQuantity,
      totalLargeQuantity: sale.totalLargeQuantity,
      totalSmallQuantity: sale.totalSmallQuantity,
      revenueOriginal: sale.revenueOriginal,
      revenueLarge: sale.revenueLarge,
      revenueSmall: sale.revenueSmall,
      totalRevenue: sale.totalRevenue,
      totalDebt: sale.totalDebt,
      netIncome: sale.netIncome
    };
    
    res.json(saleWithVirtuals);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

// Update a sale record
router.put('/:id', async (req, res) => {
  try {
    const updatedSale = await Sale.findByIdAndUpdate(
      req.params.id,
      req.body,
      { new: true, runValidators: true }
    );

    if (!updatedSale) {
      return res.status(404).json({ message: 'Sale record not found' });
    }

    res.json(updatedSale);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

// Delete a sale record
router.delete('/:id', async (req, res) => {
  try {
    const deletedSale = await Sale.findByIdAndDelete(req.params.id);

    if (!deletedSale) {
      return res.status(404).json({ message: 'Sale record not found' });
    }

    res.json({ message: 'Sale record deleted successfully' });
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

module.exports = router;