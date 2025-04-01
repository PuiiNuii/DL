


// const mongoose = require('mongoose');

// const saleSchema = new mongoose.Schema({
//   customerName: { type: String, required: true },
  
//   // Original Ice fields (4 inputs)
//   iceTypeOriginal: { type: Number, default: 0 },
//   unitPriceOriginal: { type: Number, default: 0 },
//   iceTypeOriginal1: { type: Number, default: 0 },
//   unitPriceOriginal1: { type: Number, default: 0 },
//   iceTypeOriginal2: { type: Number, default: 0 },
//   unitPriceOriginal2: { type: Number, default: 0 },
//   iceTypeOriginal3: { type: Number, default: 0 },
//   unitPriceOriginal3: { type: Number, default: 0 },
  
//   // Large Ice fields (4 inputs)
//   iceTypeLarge: { type: Number, default: 0 },
//   unitPriceLarge: { type: Number, default: 0 },
//   iceTypeLarge1: { type: Number, default: 0 },
//   unitPriceLarge1: { type: Number, default: 0 },
//   iceTypeLarge2: { type: Number, default: 0 },
//   unitPriceLarge2: { type: Number, default: 0 },
//   iceTypeLarge3: { type: Number, default: 0 },
//   unitPriceLarge3: { type: Number, default: 0 },
  
//   // Small Ice fields (4 inputs)
//   iceTypeSmall: { type: Number, default: 0 },
//   unitPriceSmall: { type: Number, default: 0 },
//   iceTypeSmall1: { type: Number, default: 0 },
//   unitPriceSmall1: { type: Number, default: 0 },
//   iceTypeSmall2: { type: Number, default: 0 },
//   unitPriceSmall2: { type: Number, default: 0 },
//   iceTypeSmall3: { type: Number, default: 0 },
//   unitPriceSmall3: { type: Number, default: 0 },
  
//   // Financial fields
//   oldDebt: { type: Number, default: 0 },
//   newDebt: { type: Number, default: 0 },
//   payment: { type: Number, default: 0 },
//   expenses: { type: Number, default: 0 }
// }, {
//   toJSON: { virtuals: true },
//   toObject: { virtuals: true },
//   timestamps: true
// });

// // Virtual properties for calculated fields
// saleSchema.virtual('totalOriginalQuantity').get(function() {
//   return this.iceTypeOriginal + this.iceTypeOriginal1 + this.iceTypeOriginal2 + this.iceTypeOriginal3;
// });

// saleSchema.virtual('totalLargeQuantity').get(function() {
//   return this.iceTypeLarge + this.iceTypeLarge1 + this.iceTypeLarge2 + this.iceTypeLarge3;
// });

// saleSchema.virtual('totalSmallQuantity').get(function() {
//   return this.iceTypeSmall + this.iceTypeSmall1 + this.iceTypeSmall2 + this.iceTypeSmall3;
// });

// saleSchema.virtual('revenueOriginal').get(function() {
//   return (this.iceTypeOriginal * this.unitPriceOriginal) +
//          (this.iceTypeOriginal1 * this.unitPriceOriginal1) +
//          (this.iceTypeOriginal2 * this.unitPriceOriginal2) +
//          (this.iceTypeOriginal3 * this.unitPriceOriginal3);
// });

// saleSchema.virtual('revenueLarge').get(function() {
//   return (this.iceTypeLarge * this.unitPriceLarge) +
//          (this.iceTypeLarge1 * this.unitPriceLarge1) +
//          (this.iceTypeLarge2 * this.unitPriceLarge2) +
//          (this.iceTypeLarge3 * this.unitPriceLarge3);
// });

// saleSchema.virtual('revenueSmall').get(function() {
//   return (this.iceTypeSmall * this.unitPriceSmall) +
//          (this.iceTypeSmall1 * this.unitPriceSmall1) +
//          (this.iceTypeSmall2 * this.unitPriceSmall2) +
//          (this.iceTypeSmall3 * this.unitPriceSmall3);
// });

// saleSchema.virtual('totalRevenue').get(function() {
//   return this.revenueOriginal + this.revenueLarge + this.revenueSmall;
// });

// saleSchema.virtual('totalDebt').get(function() {
//   return this.oldDebt + this.newDebt - this.payment;
// });

// saleSchema.virtual('netIncome').get(function() {
//   return this.totalRevenue - this.expenses;
// });

// module.exports = mongoose.model('Sale', saleSchema);


const mongoose = require('mongoose');

const saleSchema = new mongoose.Schema({
  customerName: { type: String, required: true },
  
  // Original Ice fields (4 inputs)
  iceTypeOriginal: { type: Number, default: 0 },
  unitPriceOriginal: { type: Number, default: 0 },
  iceTypeOriginal1: { type: Number, default: 0 },
  unitPriceOriginal1: { type: Number, default: 0 },
  iceTypeOriginal2: { type: Number, default: 0 },
  unitPriceOriginal2: { type: Number, default: 0 },
  iceTypeOriginal3: { type: Number, default: 0 },
  unitPriceOriginal3: { type: Number, default: 0 },
  
  // Large Ice 20kg fields (4 inputs)
  iceTypeLarge: { type: Number, default: 0 },
  unitPriceLarge: { type: Number, default: 0 },
  iceTypeLarge1: { type: Number, default: 0 },
  unitPriceLarge1: { type: Number, default: 0 },
  iceTypeLarge2: { type: Number, default: 0 },
  unitPriceLarge2: { type: Number, default: 0 },
  iceTypeLarge3: { type: Number, default: 0 },
  unitPriceLarge3: { type: Number, default: 0 },
  
  // Large Ice 30kg fields (4 inputs)
  iceTypeLarge30: { type: Number, default: 0 },
  unitPriceLarge30: { type: Number, default: 0 },
  iceTypeLarge301: { type: Number, default: 0 },
  unitPriceLarge301: { type: Number, default: 0 },
  iceTypeLarge302: { type: Number, default: 0 },
  unitPriceLarge302: { type: Number, default: 0 },
  iceTypeLarge303: { type: Number, default: 0 },
  unitPriceLarge303: { type: Number, default: 0 },
  
  // Small Ice 20kg fields (4 inputs)
  iceTypeSmall: { type: Number, default: 0 },
  unitPriceSmall: { type: Number, default: 0 },
  iceTypeSmall1: { type: Number, default: 0 },
  unitPriceSmall1: { type: Number, default: 0 },
  iceTypeSmall2: { type: Number, default: 0 },
  unitPriceSmall2: { type: Number, default: 0 },
  iceTypeSmall3: { type: Number, default: 0 },
  unitPriceSmall3: { type: Number, default: 0 },
  
  // Small Ice 30kg fields (4 inputs)
  iceTypeSmall30: { type: Number, default: 0 },
  unitPriceSmall30: { type: Number, default: 0 },
  iceTypeSmall301: { type: Number, default: 0 },
  unitPriceSmall301: { type: Number, default: 0 },
  iceTypeSmall302: { type: Number, default: 0 },
  unitPriceSmall302: { type: Number, default: 0 },
  iceTypeSmall303: { type: Number, default: 0 },
  unitPriceSmall303: { type: Number, default: 0 },
  
  // Financial fields
  oldDebt: { type: Number, default: 0 },
  newDebt: { type: Number, default: 0 },
  payment: { type: Number, default: 0 },
  expenses: { type: Number, default: 0 }
}, {
  toJSON: { virtuals: true },
  toObject: { virtuals: true },
  timestamps: true
});

// Virtual properties for calculated fields
saleSchema.virtual('totalOriginalQuantity').get(function() {
  return this.iceTypeOriginal + this.iceTypeOriginal1 + this.iceTypeOriginal2 + this.iceTypeOriginal3;
});

saleSchema.virtual('totalLarge20Quantity').get(function() {
  return this.iceTypeLarge + this.iceTypeLarge1 + this.iceTypeLarge2 + this.iceTypeLarge3;
});

saleSchema.virtual('totalLarge30Quantity').get(function() {
  return this.iceTypeLarge30 + this.iceTypeLarge301 + this.iceTypeLarge302 + this.iceTypeLarge303;
});

saleSchema.virtual('totalSmall20Quantity').get(function() {
  return this.iceTypeSmall + this.iceTypeSmall1 + this.iceTypeSmall2 + this.iceTypeSmall3;
});

saleSchema.virtual('totalSmall30Quantity').get(function() {
  return this.iceTypeSmall30 + this.iceTypeSmall301 + this.iceTypeSmall302 + this.iceTypeSmall303;
});

saleSchema.virtual('revenueOriginal').get(function() {
  return (this.iceTypeOriginal * this.unitPriceOriginal) +
         (this.iceTypeOriginal1 * this.unitPriceOriginal1) +
         (this.iceTypeOriginal2 * this.unitPriceOriginal2) +
         (this.iceTypeOriginal3 * this.unitPriceOriginal3);
});

saleSchema.virtual('revenueLarge20').get(function() {
  return (this.iceTypeLarge * this.unitPriceLarge) +
         (this.iceTypeLarge1 * this.unitPriceLarge1) +
         (this.iceTypeLarge2 * this.unitPriceLarge2) +
         (this.iceTypeLarge3 * this.unitPriceLarge3);
});

saleSchema.virtual('revenueLarge30').get(function() {
  return (this.iceTypeLarge30 * this.unitPriceLarge30) +
         (this.iceTypeLarge301 * this.unitPriceLarge301) +
         (this.iceTypeLarge302 * this.unitPriceLarge302) +
         (this.iceTypeLarge303 * this.unitPriceLarge303);
});

saleSchema.virtual('revenueSmall20').get(function() {
  return (this.iceTypeSmall * this.unitPriceSmall) +
         (this.iceTypeSmall1 * this.unitPriceSmall1) +
         (this.iceTypeSmall2 * this.unitPriceSmall2) +
         (this.iceTypeSmall3 * this.unitPriceSmall3);
});

saleSchema.virtual('revenueSmall30').get(function() {
  return (this.iceTypeSmall30 * this.unitPriceSmall30) +
         (this.iceTypeSmall301 * this.unitPriceSmall301) +
         (this.iceTypeSmall302 * this.unitPriceSmall302) +
         (this.iceTypeSmall303 * this.unitPriceSmall303);
});

saleSchema.virtual('totalRevenue').get(function() {
  return this.revenueOriginal + 
         this.revenueLarge20 + this.revenueLarge30 + 
         this.revenueSmall20 + this.revenueSmall30;
});

saleSchema.virtual('totalDebt').get(function() {
  return this.oldDebt + this.newDebt - this.payment;
});

saleSchema.virtual('netIncome').get(function() {
  return this.totalRevenue - this.expenses;
});

module.exports = mongoose.model('Sale', saleSchema);