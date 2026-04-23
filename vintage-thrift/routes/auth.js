const express = require('express');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const { getDb, save } = require('../database');
const { SECRET, authenticateToken } = require('../middleware/auth');
const router = express.Router();

router.post('/register', (req, res) => {
  const { email, password, name } = req.body;
  if (!email || !password || !name) return res.status(400).json({ error: 'All fields required' });

  const db = getDb();
  if (db.users.find(u => u.email === email)) return res.status(409).json({ error: 'Email already registered' });

  const id = (db.users.length ? Math.max(...db.users.map(u => u.id)) : 0) + 1;
  const user = { id, email, password: bcrypt.hashSync(password, 10), name, role: 'customer', created_at: new Date().toISOString() };
  db.users.push(user);
  save();

  const token = jwt.sign({ id, email, name, role: 'customer' }, SECRET, { expiresIn: '7d' });
  res.json({ token, user: { id, email, name, role: 'customer' } });
});

router.post('/login', (req, res) => {
  const { email, password } = req.body;
  if (!email || !password) return res.status(400).json({ error: 'Email and password required' });

  const db = getDb();
  const user = db.users.find(u => u.email === email);
  if (!user || !bcrypt.compareSync(password, user.password)) return res.status(401).json({ error: 'Invalid credentials' });

  const token = jwt.sign({ id: user.id, email: user.email, name: user.name, role: user.role }, SECRET, { expiresIn: '7d' });
  res.json({ token, user: { id: user.id, email: user.email, name: user.name, role: user.role } });
});

router.get('/me', authenticateToken, (req, res) => {
  const user = getDb().users.find(u => u.id === req.user.id);
  if (!user) return res.status(404).json({ error: 'User not found' });
  res.json({ id: user.id, email: user.email, name: user.name, role: user.role });
});

module.exports = router;
