const fs = require('fs');
const path = require('path');
const bcrypt = require('bcryptjs');
const { v4: uuidv4 } = require('uuid');

const DB_PATH = path.join(__dirname, 'data.json');

let data = { users: [], products: [], cart_items: [], orders: [], order_items: [] };

function save() {
  fs.writeFileSync(DB_PATH, JSON.stringify(data, null, 2));
}

function load() {
  if (fs.existsSync(DB_PATH)) {
    data = JSON.parse(fs.readFileSync(DB_PATH, 'utf8'));
  }
}

function getDb() { return data; }

function initDatabase() {
  load();
  if (data.users.length === 0) seedData();
}

function seedData() {
  const adminPass = bcrypt.hashSync('admin123', 10);
  const userPass = bcrypt.hashSync('user123', 10);

  data.users = [
    { id: 1, email: 'admin@vintage.com', password: adminPass, name: 'Admin Vintage', role: 'admin', created_at: new Date().toISOString() },
    { id: 2, email: 'customer@vintage.com', password: userPass, name: 'Hazel Zahran', role: 'customer', created_at: new Date().toISOString() },
  ];

  const products = [
    { name: "Vintage '98 Leather Biker Jacket", desc: "An authentic slice of late 90s rebellion. This asymmetrical biker jacket features thick, buttery cowhide that has aged to perfection. Asymmetrical zip closure with three external zip pockets.", category: "Outerwear", condition: "Pre-Loved", size: "M", price: 450 },
    { name: "Distressed Leather Bomber", desc: "Classic bomber silhouette in weathered brown leather. Ribbed cuffs and hem with vintage brass hardware. Interior fully lined.", category: "Outerwear", condition: "Excellent", size: "M", price: 185 },
    { name: "90s Faded Denim Jacket", desc: "Perfectly worn-in denim jacket with natural fading. Oversized fit with button closure. Two chest pockets and two side pockets.", category: "Outerwear", condition: "Pre-Loved", size: "L", price: 120 },
    { name: "Original 1994 Tour Tee", desc: "Authentic concert merchandise from the 1994 world tour. Heavyweight cotton with original screen print intact. Minor cracking adds character.", category: "Tops", condition: "Pre-Loved", size: "L", price: 85 },
    { name: "Hand-knit Wool Cardigan", desc: "Artisan hand-knitted cardigan in cream wool. Cable knit pattern throughout. Pearl button closure. Warm and cozy for layering.", category: "Tops", condition: "Excellent", size: "M", price: 150 },
    { name: "Military Surplus Cargos", desc: "Genuine military surplus cargo pants. Multiple pocket design with drawstring ankle. Durable ripstop fabric in olive green.", category: "Bottoms", condition: "Excellent", size: "M", price: 65 },
    { name: "Classic Oxford Shirt", desc: "Timeless button-down oxford in crisp white. Medium weight cotton with chest pocket. Perfect for layering or wearing alone.", category: "Tops", condition: "Like New", size: "S", price: 60 },
    { name: "Horsebit Leather Loafers", desc: "Italian-made leather loafers with signature horsebit detail. Leather sole with light patina. Timeless style that works with everything.", category: "Footwear", condition: "Excellent", size: "M", price: 165 },
    { name: "Tortoiseshell Frames", desc: "Vintage acetate sunglasses in classic tortoiseshell pattern. UV protection lenses. Comes with original leather case.", category: "Accessories", condition: "Like New", size: "S", price: 90 },
    { name: "Aran Wool Sweater", desc: "Traditional Irish Aran sweater in natural cream wool. Intricate cable and diamond patterns. Medium weight, perfect for fall.", category: "Tops", condition: "Excellent", size: "M", price: 180 },
    { name: "Prada Nylon Mini Bag", desc: "Iconic Prada nylon mini bag in black. Silver-tone hardware with zip closure. Includes authenticity card and dust bag.", category: "Accessories", condition: "Excellent", size: "S", price: 450 },
    { name: "Nike Air Max 90 Vintage", desc: "Retro Nike Air Max 90 in grey and hot pink colorway. Visible Air unit. Minor sole wear, uppers in excellent condition.", category: "Footwear", condition: "Pre-Loved", size: "M", price: 250 },
    { name: "Adidas Vintage Tracktop", desc: "Classic Adidas track jacket in navy with three-stripe detail. Full zip with stand collar. Original label intact.", category: "Outerwear", condition: "Excellent", size: "L", price: 50 },
    { name: "Levi's 501 Selvedge Jeans", desc: "Premium selvedge denim Levi's 501. Natural indigo fading with whisker details. Button fly. Made in USA.", category: "Bottoms", condition: "Pre-Loved", size: "M", price: 140 },
    { name: "Cashmere Turtleneck", desc: "Luxurious 100% cashmere turtleneck in charcoal grey. Incredibly soft with fine gauge knit. Minimal pilling.", category: "Tops", condition: "Like New", size: "S", price: 195 },
    { name: "Canvas Tote Bag", desc: "Heavy-duty canvas tote with leather handles. Interior zip pocket. Perfect everyday carry with natural patina developing over time.", category: "Accessories", condition: "Like New", size: "S", price: 45 },
  ];

  data.products = products.map((p, i) => ({
    id: i + 1,
    name: p.name,
    description: p.desc,
    category: p.category,
    condition: p.condition,
    size: p.size,
    price: p.price,
    image_url: '',
    stock: 1,
    is_deleted: 0,
    created_at: new Date(Date.now() - (products.length - i) * 86400000).toISOString()
  }));

  const orderId = 'VNT-' + uuidv4().split('-')[0].toUpperCase();
  data.orders = [{
    id: 1, order_id: orderId, user_id: 2, total_price: 635,
    shipping_address: 'Jl. Veteran No. 10, Malang, Jawa Timur 65145',
    shipping_cost: 15000, payment_method: 'bank_transfer', status: 'completed',
    created_at: new Date(Date.now() - 5 * 86400000).toISOString(),
    updated_at: new Date(Date.now() - 3 * 86400000).toISOString()
  }];

  data.order_items = [
    { id: 1, order_id: orderId, product_id: 1, snapshot_name: "Vintage '98 Leather Biker Jacket", snapshot_price: 450, snapshot_condition: 'Pre-Loved', snapshot_size: 'M', snapshot_image: '', snapshot_category: 'Outerwear', quantity: 1 },
    { id: 2, order_id: orderId, product_id: 2, snapshot_name: 'Distressed Leather Bomber', snapshot_price: 185, snapshot_condition: 'Excellent', snapshot_size: 'M', snapshot_image: '', snapshot_category: 'Outerwear', quantity: 1 },
  ];

  data.cart_items = [];
  save();
}

module.exports = { getDb, save, initDatabase };
