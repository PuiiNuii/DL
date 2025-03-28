// const express = require('express');
// const router = express.Router();
// const Sale = require('../models/Sale');

// // Create a new sale record
// router.post('/', async (req, res) => {
//   try {
//     const saleData = req.body;
    
//     // Validate required fields
//     if (!saleData.functionNo || !saleData.customerName) {
//       return res.status(400).json({ message: 'Function number and customer name are required' });
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
//     const { startDate, endDate } = req.query;
    
//     let query = {};
    
//     if (startDate && endDate) {
//       query.date = {
//         $gte: new Date(startDate),
//         $lte: new Date(endDate)
//       };
//     }
    
//     const sales = await Sale.find(query).sort({ date: -1 });
//     res.json(sales);
//   } catch (error) {
//     res.status(500).json({ message: error.message });
//   }
// });

// // Get summary statistics
// router.get('/summary', async (req, res) => {
//   try {
//     const { startDate, endDate } = req.query;
    
//     let matchQuery = {};
    
//     if (startDate && endDate) {
//       matchQuery.date = {
//         $gte: new Date(startDate),
//         $lte: new Date(endDate)
//       };
//     }
    
//     const summary = await Sale.aggregate([
//       { $match: matchQuery },
//       { 
//         $group: {
//           _id: null,
//           totalOriginal: { $sum: "$iceTypeOriginal" },
//           totalLarge: { $sum: "$iceTypeLarge" },
//           totalSmall: { $sum: "$iceTypeSmall" },
//           totalRevenue: { $sum: "$totalRevenue" },
//           totalExpenses: { $sum: "$expenses" },
//           totalNetIncome: { $sum: "$netIncome" },
//           count: { $sum: 1 }
//         }
//       }
//     ]);
    
//     res.json(summary[0] || {
//       totalOriginal: 0,
//       totalLarge: 0,
//       totalSmall: 0,
//       totalRevenue: 0,
//       totalExpenses: 0,
//       totalNetIncome: 0,
//       count: 0
//     });
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
    if (!saleData.customerName || !saleData.saleDate) {
      return res.status(400).json({ message: 'Customer name and sale date are required' });
    }

    const newSale = new Sale(saleData);
    await newSale.save();
    
    res.status(201).json(newSale);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

// Get all sales records
router.get('/', async (req, res) => {
  try {
    const { date, month } = req.query;
    
    let query = {};
    
    if (date) {
      // Filter by specific date
      const startDate = new Date(date);
      const endDate = new Date(date);
      endDate.setDate(endDate.getDate() + 1);
      
      query.saleDate = {
        $gte: startDate,
        $lt: endDate
      };
    } else if (month) {
      // Filter by month
      const [year, monthNum] = month.split('-');
      const startDate = new Date(year, monthNum - 1, 1);
      const endDate = new Date(year, monthNum, 1);
      
      query.saleDate = {
        $gte: startDate,
        $lt: endDate
      };
    }
    
    const sales = await Sale.find(query).sort({ saleDate: -1 });
    res.json(sales);
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
    res.json(sale);
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