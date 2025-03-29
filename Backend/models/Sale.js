

const mongoose = require('mongoose');

const saleSchema = new mongoose.Schema({
  customerName: { type: String, required: true },
  saleDate: { type: Date, required: true, default: Date.now },
  iceTypeOriginal: { type: Number, default: 0 },
  unitPriceOriginal: { type: Number, default: 0 },
  iceTypeLarge: { type: Number, default: 0 },
  unitPriceLarge: { type: Number, default: 0 },
  iceTypeSmall: { type: Number, default: 0 },
  unitPriceSmall: { type: Number, default: 0 },
  oldDebt: { type: Number, default: 0 },
  newDebt: { type: Number, default: 0 },
  payment: { type: Number, default: 0 },
  expenses: { type: Number, default: 0 }
}, {
  toJSON: { virtuals: true },
  toObject: { virtuals: true }
});

// Virtual properties for calculated fields
saleSchema.virtual('revenueOriginal').get(function() {
  return this.iceTypeOriginal * this.unitPriceOriginal;
});

saleSchema.virtual('revenueLarge').get(function() {
  return this.iceTypeLarge * this.unitPriceLarge;
});

saleSchema.virtual('revenueSmall').get(function() {
  return this.iceTypeSmall * this.unitPriceSmall;
});

saleSchema.virtual('totalRevenue').get(function() {
  return this.revenueOriginal + this.revenueLarge + this.revenueSmall;
});

saleSchema.virtual('totalDebt').get(function() {
  return this.oldDebt + this.newDebt - this.payment;
});

saleSchema.virtual('netIncome').get(function() {
  return this.totalRevenue - this.expenses;
});

module.exports = mongoose.model('Sale', saleSchema);