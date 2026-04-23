const express = require('express');
const { getDb, save } = require('../database');
const { authenticateToken } = require('../middleware/auth');
const { v4: uuidv4 } = require('uuid');
const router = express.Router();

router.use(authenticateToken);

router.get('/', (req, res) => {
  const db = getDb();
  const orders = db.orders
    .filter(o => o.user_id === req.user.id)
    .map(o => ({
      ...o,
      item_count: db.order_items.filter(oi => oi.order_id === o.order_id).length
    }))
    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
  res.json(orders);
});

router.get('/:orderId', (req, res) => {
  const db = getDb();
  const order = db.orders.find(o => o.order_id === req.params.orderId && o.user_id === req.user.id);
  if (!order) return res.status(404).json({ error: 'Order not found' });

  const items = db.order_items.filter(oi => oi.order_id === order.order_id);
  res.json({ order, items });
});

router.post('/checkout', (req, res) => {
  const { shipping_address, payment_method } = req.body;
  if (!shipping_address || !payment_method) return res.status(400).json({ error: 'Address and payment method required' });

  const db = getDb();
  const cartItems = db.cart_items
    .filter(ci => ci.user_id === req.user.id)
    .map(ci => {
      const p = db.products.find(pr => pr.id === ci.product_id);
      if (!p || p.is_deleted) return null;
      return { ...ci, name: p.name, price: p.price, condition: p.condition, size: p.size, image_url: p.image_url, category: p.category, stock: p.stock };
    }).filter(Boolean);

  if (cartItems.length === 0) return res.status(400).json({ error: 'Keranjang kosong' });

  const unavailable = cartItems.filter(i => i.stock <= 0);
  if (unavailable.length > 0) return res.status(400).json({ error: 'Beberapa item tidak tersedia', items: unavailable.map(i => i.name) });

  const orderId = 'VNT-' + uuidv4().split('-')[0].toUpperCase();
  const totalPrice = cartItems.reduce((sum, i) => sum + i.price * i.quantity, 0);
  const shippingCost = 15000;

  const orderIdNum = (db.orders.length ? Math.max(...db.orders.map(o => o.id)) : 0) + 1;
  db.orders.push({
    id: orderIdNum, order_id: orderId, user_id: req.user.id, total_price: totalPrice,
    shipping_address, shipping_cost: shippingCost, payment_method, status: 'pending',
    created_at: new Date().toISOString(), updated_at: new Date().toISOString()
  });

  let oiId = db.order_items.length ? Math.max(...db.order_items.map(oi => oi.id)) : 0;
  cartItems.forEach(item => {
    oiId++;
    db.order_items.push({
      id: oiId, order_id: orderId, product_id: item.product_id,
      snapshot_name: item.name, snapshot_price: item.price, snapshot_condition: item.condition,
      snapshot_size: item.size, snapshot_image: item.image_url, snapshot_category: item.category, quantity: item.quantity
    });
    const prod = db.products.find(p => p.id === item.product_id);
    if (prod) prod.stock -= item.quantity;
  });

  db.cart_items = db.cart_items.filter(ci => ci.user_id !== req.user.id);
  save();
  res.json({ message: 'Order berhasil dibuat', order_id: orderId, total: totalPrice + shippingCost });
});

router.put('/:orderId/cancel', (req, res) => {
  const db = getDb();
  const order = db.orders.find(o => o.order_id === req.params.orderId && o.user_id === req.user.id);
  if (!order) return res.status(404).json({ error: 'Order not found' });
  if (order.status !== 'pending') return res.status(400).json({ error: 'Hanya order pending yang dapat dibatalkan' });

  order.status = 'cancelled';
  order.updated_at = new Date().toISOString();

  db.order_items.filter(oi => oi.order_id === order.order_id).forEach(item => {
    const prod = db.products.find(p => p.id === item.product_id);
    if (prod) prod.stock += item.quantity;
  });

  save();
  res.json({ message: 'Order dibatalkan' });
});

module.exports = router;
