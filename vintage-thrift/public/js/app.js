const API = '';

function getToken() { return localStorage.getItem('vintage_token'); }
function setToken(t) { localStorage.setItem('vintage_token', t); }
function removeToken() { localStorage.removeItem('vintage_token'); }
function getUser() { const u = localStorage.getItem('vintage_user'); return u ? JSON.parse(u) : null; }
function setUser(u) { localStorage.setItem('vintage_user', JSON.stringify(u)); }
function removeUser() { localStorage.removeItem('vintage_user'); }
function isLoggedIn() { return !!getToken(); }
function isAdmin() { const u = getUser(); return u && u.role === 'admin'; }

async function apiFetch(url, options = {}) {
  const token = getToken();
  const headers = { 'Content-Type': 'application/json', ...options.headers };
  if (token) headers['Authorization'] = `Bearer ${token}`;
  const res = await fetch(API + url, { ...options, headers });
  if (res.status === 401) { removeToken(); removeUser(); window.location.href = '/login.html'; return; }
  const data = await res.json();
  if (!res.ok) throw new Error(data.error || 'Request failed');
  return data;
}

function showToast(msg, type = 'success') {
  let container = document.querySelector('.toast-container');
  if (!container) { container = document.createElement('div'); container.className = 'toast-container'; document.body.appendChild(container); }
  const toast = document.createElement('div');
  toast.className = `toast toast-${type}`;
  toast.textContent = msg;
  container.appendChild(toast);
  setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 300); }, 3000);
}

function formatPrice(price) {
  return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(price);
}

function formatDate(dateStr) {
  return new Date(dateStr).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
}

function getProductImage(product) {
  return `https://placehold.co/400x500/2D1B4E/FFFFFF?text=${encodeURIComponent(product.name?.substring(0, 15) || 'Product')}`;
}

async function updateCartBadge() {
  const badge = document.getElementById('cart-badge');
  if (!badge) return;
  if (!isLoggedIn()) { badge.style.display = 'none'; return; }
  try {
    const data = await apiFetch('/api/cart');
    badge.textContent = data.count;
    badge.style.display = data.count > 0 ? 'flex' : 'none';
  } catch { badge.style.display = 'none'; }
}

function renderNavbar() {
  const user = getUser();
  const nav = document.getElementById('navbar');
  if (!nav) return;
  nav.innerHTML = `
    <a href="/index.html" class="navbar-logo">VINTAGE</a>
    <div class="navbar-actions">
      ${user ? `
        <a href="/orders.html" title="Order History">⏱</a>
        ${user.role === 'admin' ? '<a href="/admin.html" title="Admin Panel">⚙</a>' : ''}
        <a href="/cart.html" title="Cart" style="position:relative">🛒<span id="cart-badge" class="cart-badge" style="display:none">0</span></a>
        <span class="nav-user-name">${user.name}</span>
        <button onclick="logout()" title="Logout" style="font-size:14px">Logout</button>
      ` : `
        <a href="/login.html" class="btn btn-outline btn-sm">Login</a>
        <a href="/register.html" class="btn btn-primary btn-sm">Register</a>
      `}
    </div>
  `;
  updateCartBadge();
}

function logout() {
  removeToken();
  removeUser();
  window.location.href = '/login.html';
}

document.addEventListener('DOMContentLoaded', renderNavbar);
