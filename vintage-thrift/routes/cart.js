const express = require('express');
const { getDb, save } = require('../database');
const { authenticateToken } = require('../middleware/auth');
const router = express.Router();

router.use(authenticateToken);

router.get('/', (req, res) => {
  const db = getDb();
  const items = db.cart_items
    .filter(ci => ci.user_id === req.user.id)
    .map(ci => {
      const p = db.products.find(pr => pr.id === ci.product_id);
      if (!p || p.is_deleted) return null;
      return { ...ci, name: p.name, price: p.price, image_url: p.image_url, condition: p.condition, size: p.size, stock: p.stock, category: p.category };
    }).filter(Boolean);

  const total = items.reduce((sum, i) => sum + i.price * i.quantity, 0);
  res.json({ items, total, count: items.length });
});

router.post('/add', (req, res) => {
  const { product_id } = req.body;
  const db = getDb();
  const product = db.products.find(p => p.id === Number(product_id) && !p.is_deleted);
  if (!product) return res.status(404).json({ error: 'Product not found' });
  if (product.stock <= 0) return res.status(400).json({ error: 'Item tidak tersedia' });

  const existing = db.cart_items.find(ci => ci.user_id === req.user.id && ci.product_id === Number(product_id));
  if (existing) return res.status(400).json({ error: 'Item sudah ada di keranjang' });

  const id = (db.cart_items.length ? Math.max(...db.cart_items.map(c => c.id)) : 0) + 1;
  db.cart_items.push({ id, user_id: req.user.id, product_id: Number(product_id), quantity: 1, created_at: new Date().toISOString() });
  save();
  res.json({ message: 'Item ditambahkan ke keranjang' });
});

router.put('/update/:id', (req, res) => {
  const { quantity } = req.body;
  const db = getDb();
  const idx = db.cart_items.findIndex(ci => ci.id === Number(req.params.id) && ci.user_id === req.user.id);
  if (idx === -1) return res.status(404).json({ error: 'Cart item not found' });

  if (quantity <= 0) {
    db.cart_items.splice(idx, 1);
    save();
    return res.json({ message: 'Item dihapus dari keranjang' });
  }
  if (quantity > 1) return res.status(400).json({ error: 'Maksimal jumlah adalah 1 untuk item thrift' });

  db.cart_items[idx].quantity = quantity;
  save();
  res.json({ message: 'Keranjang diperbarui' });
});

router.delete('/remove/:id', (req, res) => {
  const db = getDb();
  db.cart_items = db.cart_items.filter(ci => !(ci.id === Number(req.params.id) && ci.user_id === req.user.id));
  save();
  res.json({ message: 'Item dihapus dari keranjang' });
});

router.delete('/clear', (req, res) => {
  const db = getDb();
  db.cart_items = db.cart_items.filter(ci => ci.user_id !== req.user.id);
  save();
  res.json({ message: 'Keranjang dikosongkan' });
});

module.exports = router;
