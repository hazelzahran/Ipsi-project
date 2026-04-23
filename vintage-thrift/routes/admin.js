const express = require('express');
const { getDb, save } = require('../database');
const { authenticateToken, requireAdmin } = require('../middleware/auth');
const router = express.Router();

router.use(authenticateToken, requireAdmin);

router.get('/products', (req, res) => {
  const products = [...getDb().products].sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
  res.json(products);
});

router.post('/products', (req, res) => {
  const { name, description, category, condition, size, price, image_url } = req.body;
  if (!name || !category || !condition || !size || !price) return res.status(400).json({ error: 'Missing required fields' });

  const validConditions = ['Like New', 'Excellent', 'Pre-Loved'];
  if (!validConditions.includes(condition)) return res.status(400).json({ error: 'Invalid condition value' });

  const db = getDb();
  const id = (db.products.length ? Math.max(...db.products.map(p => p.id)) : 0) + 1;
  const product = {
    id, name, description: description || '', category, condition, size,
    price: Number(price), image_url: image_url || '', stock: 1, is_deleted: 0,
    created_at: new Date().toISOString()
  };
  db.products.push(product);
  save();
  res.json({ message: 'Produk berhasil ditambahkan', product });
});

router.put('/products/:id', (req, res) => {
  const db = getDb();
  const product = db.products.find(p => p.id === Number(req.params.id));
  if (!product) return res.status(404).json({ error: 'Product not found' });

  const { name, description, category, condition, size, price, stock } = req.body;
  if (name) product.name = name;
  if (description !== undefined) product.description = description;
  if (category) product.category = category;
  if (condition) product.condition = condition;
  if (size) product.size = size;
  if (price) product.price = Number(price);
  if (stock !== undefined) product.stock = Number(stock);
  save();
  res.json({ message: 'Produk diperbarui' });
});

router.delete('/products/:id', (req, res) => {
  const db = getDb();
  const product = db.products.find(p => p.id === Number(req.params.id));
  if (!product) return res.status(404).json({ error: 'Product not found' });

  const activeOrders = db.order_items
    .filter(oi => oi.product_id === Number(req.params.id))
    .some(oi => {
      const order = db.orders.find(o => o.order_id === oi.order_id);
      return order && ['pending', 'processing', 'shipped'].includes(order.status);
    });

  if (activeOrders) return res.status(400).json({ error: 'Tidak dapat menghapus produk dengan pesanan aktif' });

  product.is_deleted = 1;
  save();
  res.json({ message: 'Produk dihapus (soft delete)' });
});

router.get('/orders', (req, res) => {
  const db = getDb();
  const orders = db.orders.map(o => {
    const user = db.users.find(u => u.id === o.user_id);
    return {
      ...o,
      customer_name: user ? user.name : 'Unknown',
      customer_email: user ? user.email : '',
      item_count: db.order_items.filter(oi => oi.order_id === o.order_id).length
    };
  }).sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
  res.json(orders);
});

router.put('/orders/:orderId/status', (req, res) => {
  const { status } = req.body;
  const validStatuses = ['pending', 'processing', 'shipped', 'completed', 'cancelled'];
  if (!validStatuses.includes(status)) return res.status(400).json({ error: 'Invalid status' });

  const db = getDb();
  const order = db.orders.find(o => o.order_id === req.params.orderId);
  if (!order) return res.status(404).json({ error: 'Order not found' });

  if (status === 'cancelled' && order.status !== 'cancelled') {
    db.order_items.filter(oi => oi.order_id === order.order_id).forEach(item => {
      const prod = db.products.find(p => p.id === item.product_id);
      if (prod) prod.stock += item.quantity;
    });
  }

  order.status = status;
  order.updated_at = new Date().toISOString();
  save();
  res.json({ message: 'Status order diperbarui' });
});

module.exports = router;
