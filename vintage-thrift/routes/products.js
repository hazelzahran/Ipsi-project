const express = require('express');
const { getDb } = require('../database');
const router = express.Router();

router.get('/', (req, res) => {
  const { category, size, condition, min_price, max_price, search, sort, page = 1, limit = 8 } = req.query;
  const db = getDb();

  let products = db.products.filter(p => !p.is_deleted && p.stock > 0);

  if (category && category !== 'All Clothing') products = products.filter(p => p.category === category);
  if (size) products = products.filter(p => p.size === size);
  if (condition) products = products.filter(p => p.condition === condition);
  if (min_price) products = products.filter(p => p.price >= Number(min_price));
  if (max_price) products = products.filter(p => p.price <= Number(max_price));
  if (search) products = products.filter(p => p.name.toLowerCase().includes(search.toLowerCase()));

  if (sort === 'price_asc') products.sort((a, b) => a.price - b.price);
  else if (sort === 'price_desc') products.sort((a, b) => b.price - a.price);
  else if (sort === 'name_asc') products.sort((a, b) => a.name.localeCompare(b.name));
  else products.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

  const total = products.length;
  const offset = (Number(page) - 1) * Number(limit);
  const paged = products.slice(offset, offset + Number(limit));

  res.json({
    products: paged,
    pagination: { page: Number(page), limit: Number(limit), total, totalPages: Math.ceil(total / Number(limit)) }
  });
});

router.get('/featured', (req, res) => {
  const db = getDb();
  const available = db.products.filter(p => !p.is_deleted && p.stock > 0);
  const sorted = [...available].sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
  const newArrivals = sorted.slice(0, 4);

  const shuffled = [...available].sort(() => Math.random() - 0.5);
  const curated = shuffled.slice(0, 4);

  res.json({ newArrivals, curated });
});

router.get('/categories', (req, res) => {
  const cats = [...new Set(getDb().products.filter(p => !p.is_deleted).map(p => p.category))];
  res.json(cats);
});

router.get('/:id', (req, res) => {
  const db = getDb();
  const product = db.products.find(p => p.id === Number(req.params.id) && !p.is_deleted);
  if (!product) return res.status(404).json({ error: 'Product not found' });

  const related = db.products.filter(p => p.category === product.category && p.id !== product.id && !p.is_deleted && p.stock > 0).slice(0, 4);
  res.json({ product, related });
});

module.exports = router;
