<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
<!doctype html>
<html lang="id" class="h-full">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NetBill Pro</title>
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <script src="/_sdk/element_sdk.js"></script>
  <script src="/_sdk/data_sdk.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { jakarta: ['Plus Jakarta Sans', 'sans-serif'] }
        }
      }
    }
  </script>
  <style>
    * { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    /* Theme variables */
    :root {
      --bg-primary: #ffffff;
      --bg-secondary: #f8fafc;
      --bg-tertiary: #f1f5f9;
      --text-primary: #0f172a;
      --text-secondary: #64748b;
      --border-color: #e2e8f0;
      --accent: #6366f1;
      --accent-light: rgba(99,102,241,0.1);
    }
    
    html.dark {
      --bg-primary: #0f172a;
      --bg-secondary: #1e293b;
      --bg-tertiary: #334155;
      --text-primary: #f1f5f9;
      --text-secondary: #cbd5e1;
      --border-color: #334155;
      --accent: #818cf8;
      --accent-light: rgba(129,140,248,0.1);
    }
    
    body {
      background: var(--bg-secondary);
      color: var(--text-primary);
      transition: all 0.3s ease;
    }
    
    /* Scrollbar styling */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--bg-secondary); }
    ::-webkit-scrollbar-thumb { background: var(--text-secondary); border-radius: 3px; opacity: 0.5; }
    
    /* Sidebar */
    #sidebar {
      background: var(--bg-primary);
      border-color: var(--border-color);
      transition: all 0.3s ease;
    }
    
    .sidebar-item {
      transition: all 0.2s ease;
      color: var(--text-secondary);
    }
    .sidebar-item:hover, .sidebar-item.active {
      background: var(--accent-light);
      color: var(--accent);
    }
    
    /* Cards and containers */
    .bg-white, .card-hover {
      background: var(--bg-primary);
      border-color: var(--border-color);
      transition: all 0.3s ease;
    }
    
    .bg-slate-50 {
      background: var(--bg-secondary);
    }
    
    .card-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    
    /* Text colors */
    .text-slate-400 { color: var(--text-secondary); }
    .text-slate-500 { color: var(--text-secondary); }
    .text-slate-600 { color: var(--text-primary); }
    .text-slate-700 { color: var(--text-primary); }
    .text-slate-800 { color: var(--text-primary); }
    
    /* Animations */
    .fade-in { animation: fadeIn 0.3s ease; }
    @keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
    
    .toast { animation: slideIn 0.3s ease, slideOut 0.3s ease 2.7s; }
    @keyframes slideIn { from { transform: translateX(100%); } to { transform: translateX(0); } }
    @keyframes slideOut { from { transform: translateX(0); } to { transform: translateX(100%); } }
    
    /* Header */
    header {
      background: var(--bg-primary);
      border-color: var(--border-color);
      transition: all 0.3s ease;
    }
    
    /* Input and form elements */
    input, textarea, select {
      background: var(--bg-primary);
      color: var(--text-primary);
      border-color: var(--border-color);
      transition: all 0.2s ease;
    }
    
    input:focus, textarea:focus, select:focus {
      border-color: var(--accent);
      background: var(--bg-primary);
    }
    
    /* Table styling */
    thead {
      background: var(--bg-secondary);
    }
    
    tbody tr {
      border-color: var(--border-color);
    }
    
    /* Theme toggle button animation */
    .theme-toggle-btn {
      position: relative;
      width: 50px;
      height: 26px;
      background: var(--bg-tertiary);
      border: 2px solid var(--border-color);
      border-radius: 13px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      padding: 0 2px;
    }
    
    .theme-toggle-btn.active {
      background: var(--accent);
      border-color: var(--accent);
    }
    
    .theme-toggle-thumb {
      width: 20px;
      height: 20px;
      background: white;
      border-radius: 50%;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .theme-toggle-btn.active .theme-toggle-thumb {
      transform: translateX(24px);
    }
  </style>
  <style>body { box-sizing: border-box; }</style>
 </head>
 <body class="h-full bg-slate-50 text-slate-800">
  <div id="app" class="h-full w-full flex overflow-hidden"><!-- Sidebar -->
   <aside id="sidebar" class="w-64 bg-white border-r border-slate-200 flex flex-col h-full shrink-0">
    <div class="p-5 border-b border-slate-100">
     <h1 id="app-title" class="text-xl font-bold text-indigo-600">NetBill Pro</h1>
     <p id="company-name" class="text-xs text-slate-400 mt-1">ISP Management System</p>
    </div>
    <nav class="flex-1 overflow-y-auto p-3 space-y-1"><button onclick="navigate('dashboard')" class="sidebar-item active w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="dashboard"> <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard </button> <button onclick="navigate('pelanggan')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="pelanggan"> <i data-lucide="users" class="w-4 h-4"></i> Pelanggan </button> <button onclick="navigate('paket')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="paket"> <i data-lucide="package" class="w-4 h-4"></i> Paket Layanan </button> <button onclick="navigate('addon')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="addon"> <i data-lucide="plus-circle" class="w-4 h-4"></i> Add-On </button> <button onclick="navigate('billing')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="billing"> <i data-lucide="file-text" class="w-4 h-4"></i> Billing &amp; Invoice </button> <button onclick="navigate('pembayaran')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="pembayaran"> <i data-lucide="credit-card" class="w-4 h-4"></i> Pembayaran </button> <button onclick="navigate('voucher')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="voucher"> <i data-lucide="ticket" class="w-4 h-4"></i> Voucher </button> <button onclick="navigate('inventory')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="inventory"> <i data-lucide="box" class="w-4 h-4"></i> Inventory </button> <button onclick="navigate('pppoe')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="pppoe"> <i data-lucide="network" class="w-4 h-4"></i> PPPoE Manager </button> <button onclick="navigate('hotspot')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="hotspot"> <i data-lucide="wifi" class="w-4 h-4"></i> Hotspot Manager </button> <button onclick="navigate('tools')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="tools"> <i data-lucide="wrench" class="w-4 h-4"></i> Tools </button> <button onclick="navigate('monitoring')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="monitoring"> <i data-lucide="activity" class="w-4 h-4"></i> Monitoring </button> <button onclick="navigate('teknisi')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="teknisi"> <i data-lucide="tool" class="w-4 h-4"></i> Teknisi </button> <button onclick="navigate('laporan')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="laporan"> <i data-lucide="bar-chart-2" class="w-4 h-4"></i> Laporan </button> <button onclick="navigate('sistem')" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium" data-nav="sistem"> <i data-lucide="settings" class="w-4 h-4"></i> Sistem </button>
    </nav>
   </aside><!-- Main Content -->
   <main class="flex-1 overflow-y-auto h-full">
    <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between sticky top-0 z-10">
     <h2 id="page-title" class="text-lg font-semibold">Dashboard</h2>
     <div class="flex items-center gap-4"><span class="text-xs text-slate-400" id="current-date"></span> <button id="theme-toggle" onclick="toggleTheme()" class="theme-toggle-btn" title="Toggle Dark Mode">
       <div class="theme-toggle-thumb"><i id="theme-icon" data-lucide="sun" class="w-3.5 h-3.5 text-indigo-600"></i>
       </div></button>
      <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center"><i data-lucide="user" class="w-4 h-4 text-indigo-600"></i>
      </div>
     </div>
    </header>
    <div id="content" class="p-6 fade-in"></div>
   </main>
  </div><!-- Toast Container -->
  <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
  <script>
// State
let allData = [];
let currentPage = 'dashboard';
let isDarkMode = localStorage.getItem('netbill-theme') === 'dark';

const defaultConfig = {
  app_title: 'NetBill Pro',
  company_name: 'ISP Management System',
  primary_color: '#6366f1',
  surface_color: '#ffffff',
  text_color: '#1e293b',
  accent_color: '#10b981',
  secondary_action_color: '#64748b',
  font_family: 'Plus Jakarta Sans',
  font_size: 14
};

// Element SDK
window.elementSdk.init({
  defaultConfig,
  onConfigChange: async (config) => {
    const title = config.app_title || defaultConfig.app_title;
    const company = config.company_name || defaultConfig.company_name;
    document.getElementById('app-title').textContent = title;
    document.getElementById('company-name').textContent = company;
    const font = config.font_family || defaultConfig.font_family;
    document.body.style.fontFamily = `${font}, sans-serif`;
    const size = config.font_size || defaultConfig.font_size;
    document.body.style.fontSize = `${size}px`;
    const primary = config.primary_color || defaultConfig.primary_color;
    document.getElementById('app-title').style.color = primary;
    document.querySelectorAll('.sidebar-item.active').forEach(el => el.style.color = primary);
  },
  mapToCapabilities: (config) => ({
    recolorables: [
      { get: () => config.primary_color || defaultConfig.primary_color, set: (v) => { config.primary_color = v; window.elementSdk.setConfig({ primary_color: v }); } },
      { get: () => config.surface_color || defaultConfig.surface_color, set: (v) => { config.surface_color = v; window.elementSdk.setConfig({ surface_color: v }); } },
      { get: () => config.text_color || defaultConfig.text_color, set: (v) => { config.text_color = v; window.elementSdk.setConfig({ text_color: v }); } },
      { get: () => config.accent_color || defaultConfig.accent_color, set: (v) => { config.accent_color = v; window.elementSdk.setConfig({ accent_color: v }); } },
      { get: () => config.secondary_action_color || defaultConfig.secondary_action_color, set: (v) => { config.secondary_action_color = v; window.elementSdk.setConfig({ secondary_action_color: v }); } }
    ],
    borderables: [],
    fontEditable: { get: () => config.font_family || defaultConfig.font_family, set: (v) => { config.font_family = v; window.elementSdk.setConfig({ font_family: v }); } },
    fontSizeable: { get: () => config.font_size || defaultConfig.font_size, set: (v) => { config.font_size = v; window.elementSdk.setConfig({ font_size: v }); } }
  }),
  mapToEditPanelValues: (config) => new Map([
    ['app_title', config.app_title || defaultConfig.app_title],
    ['company_name', config.company_name || defaultConfig.company_name]
  ])
});

// Data SDK
const dataHandler = {
  onDataChanged(data) {
    allData = data;
    if (currentPage === 'dashboard') renderDashboard();
    else if (currentPage === 'pelanggan') renderPelanggan();
    else if (currentPage === 'paket') renderPaket();
    else if (currentPage === 'addon') renderAddon();
    else if (currentPage === 'billing') renderBilling();
    else if (currentPage === 'pembayaran') renderPembayaran();
    else if (currentPage === 'voucher') renderVoucher();
    else if (currentPage === 'inventory') renderInventory();
    else if (currentPage === 'tools') renderTools();
    else if (currentPage === 'pppoe') renderPPPoE();
    else if (currentPage === 'hotspot') renderHotspot();
    else if (currentPage === 'monitoring') renderMonitoring();
    else if (currentPage === 'teknisi') renderTeknisi();
    else if (currentPage === 'maps') renderMaps();
    else if (currentPage === 'olt') renderOLT();
    else if (currentPage === 'odc') renderODC();
    else if (currentPage === 'odp') renderODP();
    else if (currentPage === 'ticket') renderTicket();
  }
};
window.dataSdk.init(dataHandler);

// Helpers
function toast(msg, type='success') {
  const c = document.getElementById('toast-container');
  const t = document.createElement('div');
  t.className = `toast px-4 py-3 rounded-lg shadow-lg text-sm text-white ${type==='success'?'bg-emerald-500':'bg-red-500'}`;
  t.textContent = msg;
  c.appendChild(t);
  setTimeout(() => t.remove(), 3000);
}

function getByType(type) { return allData.filter(d => d.type === type); }
function formatRp(n) { return 'Rp ' + Number(n||0).toLocaleString('id-ID'); }
function formatDate(d) { return d ? new Date(d).toLocaleDateString('id-ID') : '-'; }

document.getElementById('current-date').textContent = new Date().toLocaleDateString('id-ID', { weekday:'long', year:'numeric', month:'long', day:'numeric' });

// Navigation
function navigate(page) {
  currentPage = page;
  document.querySelectorAll('.sidebar-item').forEach(el => el.classList.remove('active'));
  document.querySelector(`[data-nav="${page}"]`)?.classList.add('active');
  const titles = { dashboard:'Dashboard', pelanggan:'Pelanggan', paket:'Paket Layanan', addon:'Add-On Services', billing:'Billing & Invoice', pembayaran:'Pembayaran', voucher:'Voucher', inventory:'Inventory', pppoe:'PPPoE Manager', hotspot:'Hotspot Manager', tools:'Tools', monitoring:'Monitoring', teknisi:'Teknisi', maps:'Maps', olt:'OLT Assets', odc:'ODC Assets', odp:'ODP Assets', ticket:'Tiket', laporan:'Laporan', sistem:'Sistem' };
  document.getElementById('page-title').textContent = titles[page] || page;
  const content = document.getElementById('content');
  content.classList.remove('fade-in');
  void content.offsetWidth;
  content.classList.add('fade-in');
  renderPage();
}

function renderPage() {
  const pages = { dashboard: renderDashboard, pelanggan: renderPelanggan, paket: renderPaket, addon: renderAddon, billing: renderBilling, pembayaran: renderPembayaran, voucher: renderVoucher, inventory: renderInventory, tools: renderTools, pppoe: renderPPPoE, hotspot: renderHotspot, monitoring: renderMonitoring, laporan: renderLaporan, teknisi: renderTeknisi, maps: renderMaps, olt: renderOLT, odc: renderODC, odp: renderODP, ticket: renderTicket, sistem: renderSistem };
  (pages[currentPage] || renderDashboard)();
}

// Dashboard
function renderDashboard() {
  const customers = getByType('customer');
  const packages = getByType('package');
  const addons = getByType('addon');
  const payments = getByType('payment');
  const inventory = getByType('inventory');
  const active = customers.filter(c => c.status === 'active').length;
  const totalRevenue = payments.reduce((s, p) => s + (p.price || 0), 0);
  const lowStock = inventory.filter(i => i.quantity <= i.min_stock).length;
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 mb-6">
      <div class="card-hover bg-white rounded-xl p-5 border border-slate-100">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Pelanggan</span>
          <div class="w-9 h-9 bg-indigo-50 rounded-lg flex items-center justify-center"><i data-lucide="users" class="w-4 h-4 text-indigo-500"></i></div>
        </div>
        <p class="text-2xl font-bold">${customers.length}</p>
        <p class="text-xs text-emerald-500 mt-1">${active} aktif</p>
      </div>
      <div class="card-hover bg-white rounded-xl p-5 border border-slate-100">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Paket</span>
          <div class="w-9 h-9 bg-violet-50 rounded-lg flex items-center justify-center"><i data-lucide="package" class="w-4 h-4 text-violet-500"></i></div>
        </div>
        <p class="text-2xl font-bold">${packages.length}</p>
      </div>
      <div class="card-hover bg-white rounded-xl p-5 border border-slate-100">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Add-On</span>
          <div class="w-9 h-9 bg-pink-50 rounded-lg flex items-center justify-center"><i data-lucide="zap" class="w-4 h-4 text-pink-500"></i></div>
        </div>
        <p class="text-2xl font-bold">${addons.length}</p>
      </div>
      <div class="card-hover bg-white rounded-xl p-5 border border-slate-100">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Pendapatan</span>
          <div class="w-9 h-9 bg-emerald-50 rounded-lg flex items-center justify-center"><i data-lucide="trending-up" class="w-4 h-4 text-emerald-500"></i></div>
        </div>
        <p class="text-2xl font-bold">${formatRp(totalRevenue)}</p>
      </div>
      <div class="card-hover bg-white rounded-xl p-5 border border-slate-100">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Inventory</span>
          <div class="w-9 h-9 bg-sky-50 rounded-lg flex items-center justify-center"><i data-lucide="box" class="w-4 h-4 text-sky-500"></i></div>
        </div>
        <p class="text-2xl font-bold">${inventory.length}</p>
        <p class="text-xs text-red-500 mt-1">${lowStock} stok rendah</p>
      </div>
      <div class="card-hover bg-white rounded-xl p-5 border border-slate-100">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Online</span>
          <div class="w-9 h-9 bg-sky-50 rounded-lg flex items-center justify-center"><i data-lucide="wifi" class="w-4 h-4 text-sky-500"></i></div>
        </div>
        <p class="text-2xl font-bold">${active}</p>
        <p class="text-xs text-slate-400 mt-1">terhubung</p>
      </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
      <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-xl p-5 text-white col-span-1">
        <div class="flex items-center justify-between mb-6">
          <h3 class="font-semibold">Quick Actions</h3>
          <i data-lucide="zap" class="w-5 h-5 opacity-50"></i>
        </div>
        <div class="space-y-2">
          <button onclick="navigate('inventory')" class="w-full bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-3 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
            <i data-lucide="box" class="w-4 h-4"></i> Kelola Inventory
          </button>
          <button onclick="navigate('addon')" class="w-full bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-3 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Kelola Add-On
          </button>
          <button onclick="navigate('billing')" class="w-full bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-3 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
            <i data-lucide="file-text" class="w-4 h-4"></i> Generate Invoice
          </button>
        </div>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <h3 class="font-semibold mb-4 text-sm">Pelanggan Terbaru</h3>
        ${customers.length === 0 ? '<p class="text-slate-400 text-sm">Belum ada pelanggan</p>' :
          customers.slice(-5).reverse().map(c => `<div class="flex items-center justify-between py-2 border-b border-slate-50 last:border-0">
            <div><p class="text-sm font-medium">${c.name}</p><p class="text-xs text-slate-400">${c.pppoe_user||'-'}</p></div>
            <span class="text-xs px-2 py-1 rounded-full ${c.status==='active'?'bg-emerald-50 text-emerald-600':'bg-red-50 text-red-600'}">${c.status==='active'?'Aktif':'Nonaktif'}</span>
          </div>`).join('')}
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <h3 class="font-semibold mb-4 text-sm">Stok Rendah ⚠️</h3>
        ${lowStock === 0 ? '<p class="text-slate-400 text-sm">Semua stok mencukupi ✓</p>' :
          inventory.filter(i => i.quantity <= i.min_stock).slice(-5).map(i => `<div class="flex items-center justify-between py-2 border-b border-slate-50 last:border-0">
            <div><p class="text-sm font-medium">${i.name}</p><p class="text-xs text-slate-400">${i.sku||''}</p></div>
            <span class="text-sm font-semibold text-red-600">${i.quantity} ${i.unit}</span>
          </div>`).join('')}
      </div>
    </div>
  `;
  lucide.createIcons();
}

// Pelanggan
function renderPelanggan() {
  const customers = getByType('customer');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
      <p class="text-sm text-slate-500">${customers.length} pelanggan terdaftar</p>
      <div class="flex gap-2 flex-wrap">
        <button onclick="showAddCustomer()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
          <i data-lucide="plus" class="w-4 h-4"></i> Tambah Pelanggan
        </button>
        <button onclick="showCustomerExportOptions()" class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
          <i data-lucide="download" class="w-4 h-4"></i> Export
        </button>
        <button onclick="showCustomerImportDialog()" class="flex items-center gap-2 bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
          <i data-lucide="upload" class="w-4 h-4"></i> Import
        </button>
      </div>
    </div>
    <div id="customer-export-import-area"></div>
    <div id="customer-form-area"></div>
    <div class="bg-white rounded-xl border border-slate-100 overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-slate-50"><tr>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Nama</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">PPPoE</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">IP</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Paket</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Status</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Aksi</th>
        </tr></thead>
        <tbody>
          ${customers.length === 0 ? '<tr><td colspan="6" class="px-4 py-8 text-center text-slate-400">Belum ada data pelanggan</td></tr>' :
            customers.map(c => `<tr class="border-t border-slate-50 hover:bg-slate-25">
              <td class="px-4 py-3"><div><p class="font-medium">${c.name}</p><p class="text-xs text-slate-400">${c.email||''}</p></div></td>
              <td class="px-4 py-3 text-slate-600">${c.pppoe_user||'-'}</td>
              <td class="px-4 py-3 font-mono text-xs text-slate-600">${c.ip_address||'-'}</td>
              <td class="px-4 py-3">${c.package_name||'-'}</td>
              <td class="px-4 py-3"><span class="text-xs px-2 py-1 rounded-full ${c.status==='active'?'bg-emerald-50 text-emerald-600':'bg-red-50 text-red-600'}">${c.status==='active'?'Aktif':'Nonaktif'}</span></td>
              <td class="px-4 py-3"><button onclick="deleteRecord('${c.__backendId}')" class="text-red-400 hover:text-red-600 text-xs">Hapus</button></td>
            </tr>`).join('')}
        </tbody>
      </table>
    </div>
  `;
  lucide.createIcons();
}

function showAddCustomer() {
  const area = document.getElementById('customer-form-area');
  area.innerHTML = `
    <div class="bg-white rounded-xl border border-slate-200 p-5 mb-4">
      <h3 class="font-semibold mb-4">Tambah Pelanggan Baru</h3>
      <form onsubmit="addCustomer(event)" class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="c-name">Nama</label><input id="c-name" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="c-email">Email</label><input id="c-email" type="email" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="c-phone">Telepon</label><input id="c-phone" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="c-address">Alamat</label><input id="c-address" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="c-pppoe">Username PPPoE</label><input id="c-pppoe" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="c-ip">IP Address</label><input id="c-ip" placeholder="10.10.10.x" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="c-pkg">Paket</label><input id="c-pkg" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="c-status">Status</label><select id="c-status" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"><option value="active">Aktif</option><option value="inactive">Nonaktif</option></select></div>
        <div class="md:col-span-2 flex gap-2 mt-2">
          <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Simpan</button>
          <button type="button" onclick="document.getElementById('customer-form-area').innerHTML=''" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

async function addCustomer(e) {
  e.preventDefault();
  if (allData.length >= 999) { toast('Batas data tercapai (999)', 'error'); return; }
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Menyimpan...';
  const result = await window.dataSdk.create({
    type: 'customer', name: document.getElementById('c-name').value,
    email: document.getElementById('c-email').value, phone: document.getElementById('c-phone').value,
    address: document.getElementById('c-address').value, pppoe_user: document.getElementById('c-pppoe').value,
    ip_address: document.getElementById('c-ip').value, package_name: document.getElementById('c-pkg').value,
    status: document.getElementById('c-status').value, speed:'', price:0, due_date:'',
    created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) { toast('Pelanggan berhasil ditambahkan'); document.getElementById('customer-form-area').innerHTML=''; }
  else { toast('Gagal menyimpan', 'error'); btn.disabled = false; btn.textContent = 'Simpan'; }
}

// Paket
function renderPaket() {
  const packages = getByType('package');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="flex items-center justify-between mb-4">
      <p class="text-sm text-slate-500">${packages.length} paket tersedia</p>
      <button onclick="showAddPackage()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Paket
      </button>
    </div>
    <div id="package-form-area"></div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      ${packages.length === 0 ? '<p class="text-slate-400 text-sm col-span-3">Belum ada paket layanan</p>' :
        packages.map(p => `<div class="card-hover bg-white rounded-xl border border-slate-100 p-5">
          <div class="flex items-center justify-between mb-3">
            <h4 class="font-semibold">${p.name}</h4>
            <button onclick="deleteRecord('${p.__backendId}')" class="text-red-400 hover:text-red-600"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
          </div>
          <p class="text-2xl font-bold text-indigo-600">${formatRp(p.price)}<span class="text-xs font-normal text-slate-400">/bulan</span></p>
          <p class="text-sm text-slate-500 mt-2"><i data-lucide="zap" class="w-3 h-3 inline"></i> ${p.speed||'-'}</p>
        </div>`).join('')}
    </div>
  `;
  lucide.createIcons();
}

function showAddPackage() {
  document.getElementById('package-form-area').innerHTML = `
    <div class="bg-white rounded-xl border border-slate-200 p-5 mb-4">
      <h3 class="font-semibold mb-4">Tambah Paket Baru</h3>
      <form onsubmit="addPackage(event)" class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="p-name">Nama Paket</label><input id="p-name" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="p-speed">Kecepatan</label><input id="p-speed" placeholder="20 Mbps" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1" for="p-price">Harga (Rp)</label><input id="p-price" type="number" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div class="md:col-span-3 flex gap-2 mt-2">
          <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Simpan</button>
          <button type="button" onclick="document.getElementById('package-form-area').innerHTML=''" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

async function addPackage(e) {
  e.preventDefault();
  if (allData.length >= 999) { toast('Batas data tercapai', 'error'); return; }
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Menyimpan...';
  const result = await window.dataSdk.create({
    type:'package', name: document.getElementById('p-name').value,
    speed: document.getElementById('p-speed').value,
    price: Number(document.getElementById('p-price').value),
    email:'', phone:'', address:'', package_name:'', status:'active', pppoe_user:'', ip_address:'', due_date:'',
    created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) { toast('Paket berhasil ditambahkan'); document.getElementById('package-form-area').innerHTML=''; }
  else { toast('Gagal menyimpan', 'error'); btn.disabled = false; btn.textContent = 'Simpan'; }
}

// Add-On
function renderAddon() {
  const addons = getByType('addon');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="flex items-center justify-between mb-4">
      <p class="text-sm text-slate-500">${addons.length} add-on tersedia</p>
      <button onclick="showAddAddon()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Add-On
      </button>
    </div>
    <div id="addon-form-area"></div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      ${addons.length === 0 ? '<p class="text-slate-400 text-sm col-span-3">Belum ada add-on layanan</p>' :
        addons.map(a => `<div class="card-hover bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl border border-pink-200 p-5">
          <div class="flex items-center justify-between mb-3">
            <div>
              <h4 class="font-semibold text-pink-900">${a.name}</h4>
              <p class="text-xs text-pink-600 mt-1">${a.speed || 'Layanan tambahan'}</p>
            </div>
            <button onclick="deleteRecord('${a.__backendId}')" class="text-red-400 hover:text-red-600"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
          </div>
          <p class="text-2xl font-bold text-pink-600">${formatRp(a.price)}<span class="text-xs font-normal text-pink-500">/bulan</span></p>
          <p class="text-sm text-pink-700 mt-3">${a.address || 'Fitur tambahan'}</p>
        </div>`).join('')}
    </div>
  `;
  lucide.createIcons();
}

function showAddAddon() {
  document.getElementById('addon-form-area').innerHTML = `
    <div class="bg-gradient-to-r from-pink-500 to-rose-500 rounded-xl p-6 mb-4 text-white">
      <h3 class="font-bold text-lg mb-4">⚡ Tambah Add-On Baru</h3>
      <form onsubmit="addAddon(event)" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-xs font-medium mb-2 text-pink-100" for="a-name">Nama Add-On</label>
          <input id="a-name" required placeholder="e.g. Static IP, Extra Bandwidth" class="w-full border border-pink-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white placeholder-pink-200 focus:outline-none focus:ring-2 focus:ring-white">
        </div>
        <div>
          <label class="block text-xs font-medium mb-2 text-pink-100" for="a-desc">Deskripsi</label>
          <input id="a-desc" placeholder="e.g. +20 Mbps bandwidth" class="w-full border border-pink-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white placeholder-pink-200 focus:outline-none focus:ring-2 focus:ring-white">
        </div>
        <div>
          <label class="block text-xs font-medium mb-2 text-pink-100" for="a-price">Harga (Rp)</label>
          <input id="a-price" type="number" required class="w-full border border-pink-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white placeholder-pink-200 focus:outline-none focus:ring-2 focus:ring-white">
        </div>
        <div>
          <label class="block text-xs font-medium mb-2 text-pink-100" for="a-status">Status</label>
          <select id="a-status" class="w-full border border-pink-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white">
            <option value="active" class="text-slate-800">Active</option>
            <option value="inactive" class="text-slate-800">Inactive</option>
          </select>
        </div>
        <div class="md:col-span-2 flex gap-2 pt-2">
          <button type="submit" class="flex-1 bg-white text-pink-600 font-semibold px-4 py-2.5 rounded-lg hover:bg-pink-50 transition">Tambah</button>
          <button type="button" onclick="document.getElementById('addon-form-area').innerHTML=''" class="flex-1 bg-white bg-opacity-20 text-white font-semibold px-4 py-2.5 rounded-lg hover:bg-opacity-30 transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

async function addAddon(e) {
  e.preventDefault();
  if (allData.length >= 999) { toast('Batas data tercapai', 'error'); return; }
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Menambahkan...';
  const result = await window.dataSdk.create({
    type: 'addon',
    name: document.getElementById('a-name').value,
    speed: document.getElementById('a-desc').value,
    price: Number(document.getElementById('a-price').value),
    status: document.getElementById('a-status').value,
    email:'', phone:'', address:'', package_name:'', pppoe_user:'', ip_address:'', due_date:'',
    created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) { toast('Add-On berhasil ditambahkan'); document.getElementById('addon-form-area').innerHTML=''; }
  else { toast('Gagal menyimpan', 'error'); btn.disabled = false; btn.textContent = 'Tambah'; }
}

// Billing
function renderBilling() {
  const customers = getByType('customer').filter(c => c.status === 'active');
  const invoices = getByType('invoice');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
      <h2 class="font-semibold">Billing & Invoice Management</h2>
      <div class="flex gap-2 flex-wrap">
        <button onclick="showExportOptions()" class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
          <i data-lucide="download" class="w-4 h-4"></i> Export
        </button>
        <button onclick="showImportDialog()" class="flex items-center gap-2 bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
          <i data-lucide="upload" class="w-4 h-4"></i> Import
        </button>
      </div>
    </div>

    <div id="export-import-area"></div>

    <div class="bg-white rounded-xl border border-slate-100 p-5 mb-4">
      <h3 class="font-semibold mb-2">Invoice Generator</h3>
      <p class="text-sm text-slate-400 mb-4">Generate invoice otomatis untuk pelanggan aktif</p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        ${customers.length === 0 ? '<p class="text-slate-400 text-sm col-span-3">Tidak ada pelanggan aktif</p>' :
          customers.map(c => `<div class="border border-slate-100 rounded-lg p-4">
            <div class="flex justify-between items-start">
              <div><p class="font-medium text-sm">${c.name}</p><p class="text-xs text-slate-400">${c.package_name||'No Package'}</p></div>
              <button onclick="generateInvoice('${c.__backendId}')" class="text-xs bg-indigo-50 text-indigo-600 px-2 py-1 rounded hover:bg-indigo-100 transition">Generate</button>
            </div>
          </div>`).join('')}
      </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-100 p-5">
      <h3 class="font-semibold mb-4">Invoice Terbit</h3>
      ${invoices.length === 0 ? '<p class="text-slate-400 text-sm">Belum ada invoice</p>' :
        `<div class="overflow-x-auto"><table class="w-full text-sm"><thead class="bg-slate-50"><tr><th class="text-left px-4 py-2 text-slate-500">Pelanggan</th><th class="text-left px-4 py-2 text-slate-500">Jumlah</th><th class="text-left px-4 py-2 text-slate-500">Tanggal</th><th class="text-left px-4 py-2 text-slate-500">Status</th><th class="text-left px-4 py-2 text-slate-500">Aksi</th></tr></thead><tbody>
        ${invoices.map(i => `<tr class="border-t border-slate-50"><td class="px-4 py-2">${i.name}</td><td class="px-4 py-2 font-medium">${formatRp(i.price)}</td><td class="px-4 py-2 text-slate-500">${formatDate(i.created_at)}</td><td class="px-4 py-2"><span class="text-xs px-2 py-1 rounded-full ${i.status==='paid'?'bg-emerald-50 text-emerald-600':'bg-amber-50 text-amber-600'}">${i.status==='paid'?'Lunas':'Belum Bayar'}</span></td><td class="px-4 py-2"><button onclick="viewInvoiceTemplate('${i.__backendId}')" class="text-xs text-indigo-600 hover:text-indigo-700 flex items-center gap-1"><i data-lucide="eye" class="w-3 h-3"></i> Lihat</button></td></tr>`).join('')}
        </tbody></table></div>`}
    </div>
    <div id="invoice-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 overflow-y-auto">
      <div id="invoice-modal-content" class="bg-white rounded-xl w-full max-w-2xl my-4"></div>
    </div>
  `;
  lucide.createIcons();
}

function showExportOptions() {
  const area = document.getElementById('export-import-area');
  area.innerHTML = `
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl p-6 mb-4 text-white">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-lg">📊 Export Data</h3>
        <button onclick="document.getElementById('export-import-area').innerHTML=''" class="text-white hover:text-emerald-100"><i data-lucide="x" class="w-5 h-5"></i></button>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <button onclick="exportAsCSV('invoice')" class="bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-4 py-3 rounded-lg font-medium transition flex items-center gap-2">
          <i data-lucide="file-text" class="w-4 h-4"></i> Export Invoice (CSV)
        </button>
        <button onclick="exportAsCSV('payment')" class="bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-4 py-3 rounded-lg font-medium transition flex items-center gap-2">
          <i data-lucide="credit-card" class="w-4 h-4"></i> Export Payment (CSV)
        </button>
        <button onclick="exportAsJSON('invoice')" class="bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-4 py-3 rounded-lg font-medium transition flex items-center gap-2">
          <i data-lucide="code" class="w-4 h-4"></i> Export Invoice (JSON)
        </button>
        <button onclick="exportAsJSON('payment')" class="bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-4 py-3 rounded-lg font-medium transition flex items-center gap-2">
          <i data-lucide="code" class="w-4 h-4"></i> Export Payment (JSON)
        </button>
        <button onclick="exportAllBillingData()" class="md:col-span-2 bg-white hover:bg-slate-50 text-emerald-600 px-4 py-3 rounded-lg font-bold transition flex items-center justify-center gap-2">
          <i data-lucide="download" class="w-4 h-4"></i> Export All Billing Data (Complete)
        </button>
      </div>
    </div>
  `;
  lucide.createIcons();
}

function exportAsCSV(type) {
  const data = getByType(type);
  if (data.length === 0) { toast('Tidak ada data untuk diexport', 'error'); return; }
  
  const headers = ['ID', 'Nama', 'Jumlah', 'Status', 'Email', 'Paket', 'Tanggal', 'Tipe'];
  const rows = data.map(d => [
    d.__backendId?.slice(0,8) || '',
    d.name || '',
    d.price || '',
    d.status || '',
    d.email || '',
    d.package_name || '',
    formatDate(d.created_at),
    type
  ]);
  
  let csv = headers.join(',') + '\n';
  rows.forEach(row => {
    csv += row.map(cell => `"${String(cell).replace(/"/g, '""')}"`).join(',') + '\n';
  });
  
  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement('a');
  const url = URL.createObjectURL(blob);
  link.setAttribute('href', url);
  link.setAttribute('download', `${type}_${new Date().toISOString().split('T')[0]}.csv`);
  link.click();
  toast(`${data.length} record exported sebagai CSV`);
}

function exportAsJSON(type) {
  const data = getByType(type);
  if (data.length === 0) { toast('Tidak ada data untuk diexport', 'error'); return; }
  
  const exportData = data.map(d => ({
    id: d.__backendId,
    nama: d.name,
    email: d.email,
    jumlah: d.price,
    status: d.status,
    paket: d.package_name,
    tanggal: d.created_at,
    tipe: type
  }));
  
  const json = JSON.stringify(exportData, null, 2);
  const blob = new Blob([json], { type: 'application/json' });
  const link = document.createElement('a');
  const url = URL.createObjectURL(blob);
  link.setAttribute('href', url);
  link.setAttribute('download', `${type}_${new Date().toISOString().split('T')[0]}.json`);
  link.click();
  toast(`${data.length} record exported sebagai JSON`);
}

function exportAllBillingData() {
  const invoices = getByType('invoice');
  const payments = getByType('payment');
  const customers = getByType('customer');
  
  const exportData = {
    metadata: {
      exportDate: new Date().toISOString(),
      exportedBy: 'NetBill Pro',
      totalInvoices: invoices.length,
      totalPayments: payments.length,
      totalCustomers: customers.length
    },
    invoices: invoices.map(i => ({
      id: i.__backendId,
      nama: i.name,
      email: i.email,
      jumlah: i.price,
      status: i.status,
      paket: i.package_name,
      tanggal: i.created_at
    })),
    payments: payments.map(p => ({
      id: p.__backendId,
      nama: p.name,
      email: p.email,
      jumlah: p.price,
      paket: p.package_name,
      tanggal: p.created_at
    })),
    ringkasan: {
      totalPendapatan: payments.reduce((s, p) => s + (p.price || 0), 0),
      invoiceLunas: invoices.filter(i => i.status === 'paid').length,
      invoiceBelumBayar: invoices.filter(i => i.status === 'unpaid').length
    }
  };
  
  const json = JSON.stringify(exportData, null, 2);
  const blob = new Blob([json], { type: 'application/json' });
  const link = document.createElement('a');
  const url = URL.createObjectURL(blob);
  link.setAttribute('href', url);
  link.setAttribute('download', `billing_complete_${new Date().toISOString().split('T')[0]}.json`);
  link.click();
  toast('Complete billing data exported!');
}

function showImportDialog() {
  const area = document.getElementById('export-import-area');
  area.innerHTML = `
    <div class="bg-gradient-to-r from-sky-500 to-blue-600 rounded-xl p-6 mb-4 text-white">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-lg">📥 Import Data</h3>
        <button onclick="document.getElementById('export-import-area').innerHTML=''" class="text-white hover:text-sky-100"><i data-lucide="x" class="w-5 h-5"></i></button>
      </div>
      <div class="space-y-3">
        <div class="bg-white bg-opacity-10 backdrop-blur rounded-lg p-4 border-2 border-dashed border-white border-opacity-30">
          <p class="text-sm mb-3 font-medium">Pilih file untuk diimport (CSV atau JSON)</p>
          <input id="import-file" type="file" accept=".csv,.json" class="w-full bg-white bg-opacity-10 text-white px-3 py-2 rounded-lg text-sm file:bg-white file:text-blue-600 file:px-3 file:py-1 file:rounded file:border-0 file:cursor-pointer file:font-medium hover:bg-opacity-20 transition">
        </div>
        <div class="flex gap-2">
          <button onclick="handleImport()" class="flex-1 bg-white text-blue-600 font-bold px-4 py-3 rounded-lg hover:bg-blue-50 transition flex items-center justify-center gap-2">
            <i data-lucide="upload" class="w-4 h-4"></i> Import
          </button>
          <button onclick="document.getElementById('export-import-area').innerHTML=''" class="flex-1 bg-white bg-opacity-20 text-white font-bold px-4 py-3 rounded-lg hover:bg-opacity-30 transition">
            Batal
          </button>
        </div>
        <p class="text-xs text-blue-100 mt-2">💡 Format: CSV (dengan header) atau JSON array dari export sebelumnya</p>
      </div>
    </div>
  `;
}

async function handleImport() {
  const file = document.getElementById('import-file').files[0];
  if (!file) { toast('Pilih file terlebih dahulu', 'error'); return; }
  
  const reader = new FileReader();
  reader.onload = async (e) => {
    try {
      const content = e.target.result;
      let importData = [];
      
      if (file.name.endsWith('.json')) {
        const parsed = JSON.parse(content);
        importData = Array.isArray(parsed) ? parsed : (parsed.invoices || parsed.payments || []);
      } else if (file.name.endsWith('.csv')) {
        const lines = content.split('\n');
        const headers = lines[0].split(',').map(h => h.replace(/"/g, '').trim());
        for (let i = 1; i < lines.length; i++) {
          if (!lines[i].trim()) continue;
          const values = lines[i].split(',').map(v => v.replace(/"/g, '').trim());
          const obj = {};
          headers.forEach((h, idx) => {
            obj[h.toLowerCase()] = values[idx];
          });
          importData.push(obj);
        }
      }
      
      if (importData.length === 0) { toast('File kosong atau format tidak valid', 'error'); return; }
      
      let imported = 0;
      const btn = document.querySelector('button[onclick="handleImport()"]');
      btn.disabled = true;
      btn.innerHTML = '<i data-lucide="loader" class="w-4 h-4 animate-spin"></i> Importing...';
      
      for (const item of importData) {
        if (allData.length >= 999) break;
        
        const record = {
          type: item.tipe || item.type || 'invoice',
          name: item.nama || item.name || '',
          email: item.email || '',
          price: parseFloat(item.jumlah || item.price || 0),
          status: item.status || 'unpaid',
          package_name: item.paket || item.package_name || '',
          created_at: item.tanggal || item.created_at || new Date().toISOString(),
          phone: '', address: '', package_name: item.package_name || item.paket || '',
          speed: '', pppoe_user: '', ip_address: '', due_date: '',
          voucher_code: '', discount_value: 0, discount_type: '', expiry_date: '', used_by: '', is_used: ''
        };
        
        const result = await window.dataSdk.create(record);
        if (result.isOk) imported++;
      }
      
      toast(`${imported} record berhasil diimport!`);
      document.getElementById('export-import-area').innerHTML = '';
      btn.disabled = false;
    } catch (err) {
      toast('Error parsing file: ' + err.message, 'error');
    }
  };
  reader.readAsText(file);
}

async function generateInvoice(id) {
  if (allData.length >= 999) { toast('Batas data tercapai', 'error'); return; }
  const cust = allData.find(d => d.__backendId === id);
  if (!cust) return;
  const pkg = getByType('package').find(p => p.name === cust.package_name);
  const result = await window.dataSdk.create({
    type:'invoice', name: cust.name, price: pkg ? pkg.price : 0,
    status:'unpaid', email: cust.email, phone:'', address:'',
    package_name: cust.package_name, speed:'', pppoe_user: cust.pppoe_user,
    ip_address:'', due_date:'', created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) toast('Invoice dibuat untuk ' + cust.name);
  else toast('Gagal membuat invoice', 'error');
}

// Pembayaran
function renderPembayaran() {
  const invoices = getByType('invoice').filter(i => i.status === 'unpaid');
  const payments = getByType('payment');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="bg-white rounded-xl border border-slate-100 p-5 mb-4">
      <h3 class="font-semibold mb-4">Invoice Belum Bayar</h3>
      ${invoices.length === 0 ? '<p class="text-slate-400 text-sm">Semua invoice sudah lunas 🎉</p>' :
        invoices.map(i => `<div class="flex items-center justify-between py-3 border-b border-slate-50 last:border-0">
          <div><p class="font-medium text-sm">${i.name}</p><p class="text-xs text-slate-400">${i.package_name}</p></div>
          <div class="flex items-center gap-3">
            <span class="font-semibold text-sm">${formatRp(i.price)}</span>
            <button onclick="payInvoice('${i.__backendId}')" class="text-xs bg-emerald-500 text-white px-3 py-1.5 rounded-lg hover:bg-emerald-600 transition">Bayar</button>
          </div>
        </div>`).join('')}
    </div>
    <div class="bg-white rounded-xl border border-slate-100 p-5">
      <h3 class="font-semibold mb-4">Riwayat Pembayaran</h3>
      ${payments.length === 0 ? '<p class="text-slate-400 text-sm">Belum ada pembayaran</p>' :
        `<table class="w-full text-sm"><thead class="bg-slate-50"><tr><th class="text-left px-4 py-2 text-slate-500">Pelanggan</th><th class="text-left px-4 py-2 text-slate-500">Jumlah</th><th class="text-left px-4 py-2 text-slate-500">Tanggal</th></tr></thead><tbody>
        ${payments.map(p => `<tr class="border-t border-slate-50"><td class="px-4 py-2 font-medium">${p.name}</td><td class="px-4 py-2 text-emerald-600 font-medium">${formatRp(p.price)}</td><td class="px-4 py-2 text-slate-500">${formatDate(p.created_at)}</td></tr>`).join('')}
        </tbody></table>`}
    </div>
  `;
}

async function payInvoice(id) {
  if (allData.length >= 999) { toast('Batas data tercapai', 'error'); return; }
  const inv = allData.find(d => d.__backendId === id);
  if (!inv) return;
  const upd = await window.dataSdk.update({ ...inv, status: 'paid' });
  if (!upd.isOk) { toast('Gagal update invoice', 'error'); return; }
  const result = await window.dataSdk.create({
    type:'payment', name: inv.name, price: inv.price,
    email:'', phone:'', address:'', package_name: inv.package_name,
    speed:'', status:'paid', pppoe_user:'', ip_address:'', due_date:'',
    created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) toast('Pembayaran berhasil dicatat');
  else toast('Gagal mencatat pembayaran', 'error');
}

function viewInvoiceTemplate(id) {
  const invoice = allData.find(d => d.__backendId === id);
  if (!invoice) return;
  const customer = getByType('customer').find(c => c.name === invoice.name);
  const modal = document.getElementById('invoice-modal');
  const content = document.getElementById('invoice-modal-content');
  
  const invoiceNum = 'INV-' + new Date().getFullYear() + '-' + String(id).slice(0, 6).toUpperCase();
  const dueDate = new Date(new Date().getTime() + 30*24*60*60*1000);
  
  content.innerHTML = `
    <div class="p-8 max-h-[80vh] overflow-y-auto" id="invoice-print">
      <div class="mb-8 pb-6 border-b-2 border-indigo-600">
        <div class="flex justify-between items-start mb-4">
          <div><h1 class="text-3xl font-bold text-indigo-600">INVOICE</h1><p class="text-slate-500 text-sm">#${invoiceNum}</p></div>
          <div class="text-right"><div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-2"><i data-lucide="wifi" class="w-6 h-6 text-indigo-600"></i></div><h2 class="font-bold text-lg">NetBill Pro</h2><p class="text-xs text-slate-400">ISP Management System</p></div>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-8 mb-8">
        <div><h3 class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-3">Dari</h3><div class="text-sm"><p class="font-bold text-lg mb-1">NetBill Pro</p><p class="text-slate-600">ISP Management System</p><p class="text-slate-500 text-xs mt-2">contact@netbillpro.id</p><p class="text-slate-500 text-xs">+62 8XX XXXX XXXX</p></div></div>
        <div><h3 class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-3">Tagih Ke</h3><div class="text-sm"><p class="font-bold text-lg mb-1">${invoice.name}</p><p class="text-slate-600">${customer?.email || '-'}</p><p class="text-slate-500 text-xs mt-2">${customer?.phone || '-'}</p><p class="text-slate-500 text-xs">${customer?.address || '-'}</p></div></div>
      </div>
      <div class="grid grid-cols-4 gap-4 mb-8">
        <div class="bg-indigo-50 rounded-lg p-4"><p class="text-xs text-slate-400 uppercase font-semibold mb-1">Nomor Invoice</p><p class="text-sm font-bold text-indigo-600">${invoiceNum}</p></div>
        <div class="bg-slate-50 rounded-lg p-4"><p class="text-xs text-slate-400 uppercase font-semibold mb-1">Tanggal Invoice</p><p class="text-sm font-bold">${formatDate(invoice.created_at)}</p></div>
        <div class="bg-slate-50 rounded-lg p-4"><p class="text-xs text-slate-400 uppercase font-semibold mb-1">Jatuh Tempo</p><p class="text-sm font-bold">${dueDate.toLocaleDateString('id-ID')}</p></div>
        <div class="bg-slate-50 rounded-lg p-4"><p class="text-xs text-slate-400 uppercase font-semibold mb-1">Status</p><p class="text-sm font-bold ${invoice.status === 'paid' ? 'text-emerald-600' : 'text-amber-600'}">${invoice.status === 'paid' ? '✓ LUNAS' : 'BELUM BAYAR'}</p></div>
      </div>
      <table class="w-full mb-8"><thead class="bg-indigo-100"><tr><th class="text-left px-4 py-3 font-semibold text-sm text-indigo-900">Deskripsi</th><th class="text-center px-4 py-3 font-semibold text-sm text-indigo-900">Qty</th><th class="text-right px-4 py-3 font-semibold text-sm text-indigo-900">Harga Unit</th><th class="text-right px-4 py-3 font-semibold text-sm text-indigo-900">Subtotal</th></tr></thead><tbody class="divide-y divide-slate-200"><tr><td class="px-4 py-4"><p class="font-medium text-sm">${invoice.package_name || 'Internet Service'}</p><p class="text-xs text-slate-500">Layanan Internet Bulanan</p></td><td class="text-center px-4 py-4"><p class="text-sm font-medium">1</p></td><td class="text-right px-4 py-4"><p class="text-sm font-medium">${formatRp(invoice.price)}</p></td><td class="text-right px-4 py-4"><p class="text-sm font-bold">${formatRp(invoice.price)}</p></td></tr></tbody></table>
      <div class="flex justify-end mb-8"><div class="w-80"><div class="bg-slate-50 rounded-lg p-4 space-y-3"><div class="flex justify-between items-center border-b border-slate-200 pb-3"><span class="text-slate-600 text-sm">Subtotal</span><span class="font-medium">${formatRp(invoice.price)}</span></div><div class="flex justify-between items-center border-b border-slate-200 pb-3"><span class="text-slate-600 text-sm">PPN (10%)</span><span class="font-medium">${formatRp(invoice.price * 0.1)}</span></div><div class="flex justify-between items-center pt-2"><span class="font-bold text-indigo-600">Total</span><span class="text-2xl font-bold text-indigo-600">${formatRp(invoice.price * 1.1)}</span></div></div></div></div>
      <div class="border-t border-slate-300 pt-6 mt-8"><div class="grid grid-cols-2 gap-8 mb-6"><div><h4 class="text-xs font-bold text-slate-400 uppercase mb-2">Metode Pembayaran</h4><div class="text-sm text-slate-600 space-y-1"><p><strong>Bank Transfer:</strong> BNI 1234567890</p><p><strong>Atas Nama:</strong> PT NetBill Pro</p><p><strong>E-Wallet:</strong> +62 812 3456 7890</p></div></div><div><h4 class="text-xs font-bold text-slate-400 uppercase mb-2">Catatan</h4><p class="text-sm text-slate-600">Harap lakukan pembayaran sebelum tanggal jatuh tempo. Terima kasih!</p></div></div><div class="text-center text-xs text-slate-400 border-t border-slate-200 pt-4"><p>NetBill Pro © 2024 | Sistem Manajemen ISP Terintegrasi</p></div></div>
    </div>
    <div class="flex gap-2 p-6 border-t border-slate-200 bg-slate-50 justify-end">
      <button onclick="printInvoice()" class="flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="printer" class="w-4 h-4"></i> Cetak</button>
      <button onclick="downloadInvoicePDF()" class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="download" class="w-4 h-4"></i> Download PDF</button>
      <button onclick="document.getElementById('invoice-modal').classList.add('hidden')" class="flex items-center gap-2 bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="x" class="w-4 h-4"></i> Tutup</button>
    </div>
  `;
  
  modal.classList.remove('hidden');
  lucide.createIcons();
}

function printInvoice() {
  const printContent = document.getElementById('invoice-print').innerHTML;
  const originalContent = document.body.innerHTML;
  document.body.innerHTML = printContent;
  window.print();
  document.body.innerHTML = originalContent;
  location.reload();
}

function downloadInvoicePDF() {
  const printContent = document.getElementById('invoice-print');
  const win = window.open('', '', 'height=500,width=800');
  win.document.write('<html><head><title>Invoice</title>');
  win.document.write('<link rel="stylesheet" href="https://cdn.tailwindcss.com/3.4.17">');
  win.document.write('<style>@media print { body { margin: 0; padding: 0; } } body { font-family: "Plus Jakarta Sans", sans-serif; }</style>');
  win.document.write('</head><body>');
  win.document.write(printContent.innerHTML);
  win.document.write('</body></html>');
  win.document.close();
  win.print();
  toast('Invoice siap untuk diunduh/cetak');
}

// Voucher
function renderVoucher() {
  const vouchers = getByType('voucher');
  const usedVouchers = vouchers.filter(v => v.is_used === 'yes');
  const activeVouchers = vouchers.filter(v => v.is_used !== 'yes');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="flex items-center justify-between mb-4">
      <div><h3 class="font-semibold">Total Voucher: ${vouchers.length}</h3><p class="text-xs text-slate-400">Aktif: ${activeVouchers.length} | Terpakai: ${usedVouchers.length}</p></div>
      <button onclick="showVoucherGenerator()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i> Generate Voucher
      </button>
    </div>
    <div id="voucher-form-area"></div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <h3 class="font-semibold mb-4 text-sm">Voucher Aktif</h3>
        ${activeVouchers.length === 0 ? '<p class="text-slate-400 text-sm">Tidak ada voucher aktif</p>' :
          activeVouchers.map(v => `<div class="bg-gradient-to-r from-indigo-50 to-violet-50 rounded-lg p-4 mb-3 border border-indigo-100 last:mb-0">
            <div class="flex items-center justify-between mb-2">
              <code class="text-sm font-bold text-indigo-600">${v.voucher_code}</code>
              <div class="flex gap-1">
                <button onclick="copyCode('${v.voucher_code}')" class="text-xs text-indigo-500 hover:text-indigo-700"><i data-lucide="copy" class="w-3 h-3 inline"></i></button>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-2 text-xs mb-2"><div><span class="text-slate-400">Diskon</span><p class="font-medium text-lg text-indigo-600">${v.discount_type === 'percent' ? v.discount_value + '%' : formatRp(v.discount_value)}</p></div>
            <div><span class="text-slate-400">Exp</span><p class="font-medium">${formatDate(v.expiry_date)}</p></div></div>
            <div class="flex gap-2">
              <button onclick="viewVoucherTemplate('${v.__backendId}')" class="flex-1 text-xs bg-indigo-50 text-indigo-600 hover:bg-indigo-100 py-1 rounded transition font-medium">Lihat Cetak</button>
              <button onclick="deleteRecord('${v.__backendId}')" class="flex-1 text-xs bg-red-50 text-red-500 hover:bg-red-100 py-1 rounded transition">Hapus</button>
            </div>
          </div>`).join('')}
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <h3 class="font-semibold mb-4 text-sm">Voucher Terpakai</h3>
        ${usedVouchers.length === 0 ? '<p class="text-slate-400 text-sm">Belum ada voucher yang digunakan</p>' :
          usedVouchers.map(v => `<div class="bg-slate-50 rounded-lg p-3 mb-2 last:mb-0 opacity-70">
            <div class="flex items-center justify-between mb-1">
              <code class="text-xs font-bold text-slate-500">${v.voucher_code}</code>
              <span class="text-xs bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded">Terpakai</span>
            </div>
            <p class="text-xs text-slate-400">Pengguna: ${v.used_by || '-'} | ${formatDate(v.created_at)}</p>
          </div>`).join('')}
      </div>
    </div>
    <div id="voucher-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 overflow-y-auto">
      <div id="voucher-modal-content" class="bg-white rounded-xl w-full max-w-4xl my-4"></div>
    </div>
  `;
  lucide.createIcons();
}

function showVoucherGenerator() {
  const area = document.getElementById('voucher-form-area');
  area.innerHTML = `
    <div class="bg-gradient-to-r from-indigo-500 to-violet-600 rounded-xl p-6 mb-4 text-white">
      <h3 class="font-bold text-lg mb-4">⚡ Generate Voucher Baru</h3>
      <form onsubmit="generateVoucher(event)" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-medium mb-2 text-indigo-100" for="v-quantity">Jumlah Voucher</label>
            <input id="v-quantity" type="number" value="10" min="1" max="100" required class="w-full border border-indigo-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white placeholder-indigo-200 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Berapa banyak?">
          </div>
          <div>
            <label class="block text-xs font-medium mb-2 text-indigo-100" for="v-type">Tipe Diskon</label>
            <select id="v-type" class="w-full border border-indigo-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white">
              <option value="percent" class="text-slate-800">Persentase (%)</option>
              <option value="fixed" class="text-slate-800">Nominal (Rp)</option>
            </select>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-medium mb-2 text-indigo-100" for="v-value">Nilai Diskon</label>
            <input id="v-value" type="number" value="10" min="1" required class="w-full border border-indigo-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white placeholder-indigo-200 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Berapa besar?">
          </div>
          <div>
            <label class="block text-xs font-medium mb-2 text-indigo-100" for="v-exp">Berlaku Sampai</label>
            <input id="v-exp" type="date" required class="w-full border border-indigo-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white">
          </div>
        </div>
        <div class="flex gap-2 pt-2">
          <button type="submit" class="flex-1 bg-white text-indigo-600 font-semibold px-4 py-2.5 rounded-lg hover:bg-indigo-50 transition">Generate</button>
          <button type="button" onclick="document.getElementById('voucher-form-area').innerHTML=''" class="flex-1 bg-white bg-opacity-20 text-white font-semibold px-4 py-2.5 rounded-lg hover:bg-opacity-30 transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

function generateRandomCode(length = 8) {
  const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  let code = '';
  for (let i = 0; i < length; i++) code += chars.charAt(Math.floor(Math.random() * chars.length));
  return code;
}

async function generateVoucher(e) {
  e.preventDefault();
  const qty = parseInt(document.getElementById('v-quantity').value);
  const type = document.getElementById('v-type').value;
  const value = Number(document.getElementById('v-value').value);
  const expDate = document.getElementById('v-exp').value;
  
  if (allData.length + qty > 999) { toast('Akan melebihi batas data (999)', 'error'); return; }
  
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true;
  btn.textContent = 'Generating...';
  
  let created = 0;
  for (let i = 0; i < qty; i++) {
    const code = generateRandomCode();
    const result = await window.dataSdk.create({
      type: 'voucher',
      voucher_code: code,
      discount_type: type,
      discount_value: value,
      expiry_date: expDate,
      is_used: 'no',
      used_by: '',
      name: 'Voucher ' + code,
      price: 0,
      email: '', phone: '', address: '', package_name: '', speed: '', status: '', pppoe_user: '', ip_address: '', due_date: '',
      created_at: new Date().toISOString()
    });
    if (result.isOk) created++;
  }
  
  toast(`${created} dari ${qty} voucher berhasil dibuat`);
  document.getElementById('voucher-form-area').innerHTML = '';
  btn.disabled = false;
  btn.textContent = 'Generate';
}

function copyCode(code) {
  navigator.clipboard.writeText(code);
  toast('Kode disalin ke clipboard!');
}

function viewVoucherTemplate(id) {
  const voucher = allData.find(d => d.__backendId === id);
  if (!voucher) return;
  const modal = document.getElementById('voucher-modal');
  if (!modal) {
    const m = document.createElement('div');
    m.id = 'voucher-modal';
    m.className = 'hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 overflow-y-auto';
    m.innerHTML = '<div id="voucher-modal-content" class="bg-white rounded-xl w-full max-w-4xl my-4"></div>';
    document.body.appendChild(m);
  }
  
  const content = document.getElementById('voucher-modal-content');
  const barcodeValue = voucher.voucher_code;
  
  content.innerHTML = `
    <div class="p-8 max-h-[80vh] overflow-y-auto" id="voucher-print">
      <div class="text-center mb-8 pb-6 border-b-2 border-indigo-600">
        <div class="inline-block w-12 h-12 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-lg flex items-center justify-center mb-3 shadow-lg">
          <i data-lucide="gift" class="w-6 h-6 text-white"></i>
        </div>
        <h1 class="text-4xl font-black text-indigo-600 tracking-tight">VOUCHER DISKON</h1>
        <p class="text-slate-400 text-sm mt-2">NetBill Pro - Layanan Internet Berkualitas</p>
      </div>
      <div class="bg-gradient-to-br from-indigo-50 via-white to-violet-50 rounded-2xl border-2 border-indigo-200 p-8 mb-8 shadow-2xl">
        <div class="grid grid-cols-3 gap-8">
          <div class="border-r-2 border-dashed border-indigo-300 pr-8">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Kode Voucher</p>
            <p class="text-4xl font-black text-indigo-600 mb-6 font-mono tracking-wider">${voucher.voucher_code}</p>
            <div class="bg-white rounded-xl p-4 border-2 border-indigo-200"><svg id="barcode-${id}" style="width: 100%; height: auto;"></svg></div>
            <p class="text-xs text-center text-slate-400 mt-2 font-mono">${voucher.voucher_code}</p>
          </div>
          <div class="flex flex-col justify-between text-center border-r-2 border-dashed border-indigo-300 pr-8">
            <div>
              <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Besar Diskon</p>
              <div class="bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-2xl p-8 text-white shadow-lg mb-4">
                <p class="text-5xl font-black">${voucher.discount_type === 'percent' ? voucher.discount_value + '%' : formatRp(voucher.discount_value)}</p>
                <p class="text-sm font-semibold mt-2">${voucher.discount_type === 'percent' ? 'Potongan Harga' : 'Nilai Nominal'}</p>
              </div>
            </div>
            <div class="bg-amber-50 rounded-xl p-4 border-2 border-amber-200">
              <p class="text-xs text-amber-600 font-bold uppercase mb-1">Berlaku Sampai</p>
              <p class="text-2xl font-black text-amber-600">${formatDate(voucher.expiry_date)}</p>
            </div>
          </div>
          <div class="pl-4">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Ketentuan & Syarat</p>
            <div class="space-y-3 text-xs text-slate-600">
              <div class="flex gap-2"><span class="text-indigo-600 font-bold">✓</span><span>Berlaku untuk semua paket</span></div>
              <div class="flex gap-2"><span class="text-indigo-600 font-bold">✓</span><span>Satu kali per pelanggan</span></div>
              <div class="flex gap-2"><span class="text-indigo-600 font-bold">✓</span><span>Tidak digabung promo lain</span></div>
              <div class="flex gap-2"><span class="text-indigo-600 font-bold">✓</span><span>Berlaku untuk bulan tertentu</span></div>
              <div class="flex gap-2"><span class="text-indigo-600 font-bold">✓</span><span>Hubungi admin untuk klaim</span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl border-2 border-indigo-100 p-4 text-center"><div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-3"><span class="text-lg font-bold text-indigo-600">1</span></div><p class="text-sm font-semibold mb-1">Salin Kode</p><p class="text-xs text-slate-500">Copy kode voucher</p></div>
        <div class="bg-white rounded-xl border-2 border-indigo-100 p-4 text-center"><div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-3"><span class="text-lg font-bold text-indigo-600">2</span></div><p class="text-sm font-semibold mb-1">Hubungi Admin</p><p class="text-xs text-slate-500">Hubungi kami untuk klaim</p></div>
        <div class="bg-white rounded-xl border-2 border-indigo-100 p-4 text-center"><div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-3"><span class="text-lg font-bold text-indigo-600">3</span></div><p class="text-sm font-semibold mb-1">Verifikasi Kode</p><p class="text-xs text-slate-500">Admin verifikasi kode</p></div>
        <div class="bg-white rounded-xl border-2 border-indigo-100 p-4 text-center"><div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-3"><span class="text-lg font-bold text-indigo-600">4</span></div><p class="text-sm font-semibold mb-1">Nikmati Diskon</p><p class="text-xs text-slate-500">Diskon diterapkan</p></div>
      </div>
      <div class="bg-gradient-to-r from-indigo-600 to-violet-600 rounded-xl p-6 text-white text-center mb-8">
        <p class="text-sm font-semibold mb-3">Pertanyaan? Hubungi Kami!</p>
        <div class="flex items-center justify-center gap-8 text-sm"><div class="flex items-center gap-2"><i data-lucide="phone" class="w-4 h-4"></i><span>+62 8XX XXXX XXXX</span></div><div class="flex items-center gap-2"><i data-lucide="mail" class="w-4 h-4"></i><span>support@netbillpro.id</span></div><div class="flex items-center gap-2"><i data-lucide="clock" class="w-4 h-4"></i><span>24/7 CS</span></div></div>
      </div>
      <div class="text-center text-xs text-slate-400 border-t border-slate-200 pt-6"><p class="font-semibold text-slate-500 mb-2">NetBill Pro © 2024</p><p>Sistem Manajemen ISP Terintegrasi</p><p class="mt-2">Cetak: ${new Date().toLocaleDateString('id-ID')}</p></div>
    </div>
    <div class="flex gap-2 p-6 border-t border-slate-200 bg-slate-50 justify-end flex-wrap">
      <button onclick="printVoucher()" class="flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="printer" class="w-4 h-4"></i> Cetak</button>
      <button onclick="downloadVoucherPDF()" class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="download" class="w-4 h-4"></i> Download PDF</button>
      <button onclick="shareVoucher('${voucher.voucher_code}')" class="flex items-center gap-2 bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="share-2" class="w-4 h-4"></i> Bagikan</button>
      <button onclick="document.getElementById('voucher-modal').classList.add('hidden')" class="flex items-center gap-2 bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="x" class="w-4 h-4"></i> Tutup</button>
    </div>
  `;
  
  document.getElementById('voucher-modal').classList.remove('hidden');
  lucide.createIcons();
}

function printVoucher() {
  const printContent = document.getElementById('voucher-print').innerHTML;
  const originalContent = document.body.innerHTML;
  document.body.innerHTML = printContent;
  window.print();
  document.body.innerHTML = originalContent;
  location.reload();
}

function downloadVoucherPDF() {
  const printContent = document.getElementById('voucher-print');
  const win = window.open('', '', 'height=600,width=900');
  win.document.write('<html><head><title>Voucher</title>');
  win.document.write('<link rel="stylesheet" href="https://cdn.tailwindcss.com/3.4.17">');
  win.document.write('<style>@media print { body { margin: 0; padding: 0; } } body { font-family: "Plus Jakarta Sans", sans-serif; }</style>');
  win.document.write('</head><body>');
  win.document.write(printContent.innerHTML);
  win.document.write('</body></html>');
  win.document.close();
  win.print();
  toast('Voucher siap untuk diunduh/cetak');
}

function shareVoucher(code) {
  const text = `🎁 Voucher diskon NetBill Pro!\n\nKode: ${code}\n\nDapatkan diskon menarik! Hubungi kami sekarang! 🚀`;
  navigator.clipboard.writeText(text);
  toast('Voucher siap dibagikan!');
}

// Inventory Management
function renderInventory() {
  const inventory = getByType('inventory');
  const lowStock = inventory.filter(i => i.quantity <= i.min_stock);
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
      <div class="bg-white rounded-xl border border-slate-100 p-4">
        <p class="text-xs text-slate-400 mb-1">Total Barang</p>
        <p class="text-2xl font-bold">${inventory.length}</p>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-4">
        <p class="text-xs text-slate-400 mb-1">Stok Rendah</p>
        <p class="text-2xl font-bold text-red-600">${lowStock.length}</p>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-4">
        <p class="text-xs text-slate-400 mb-1">Total Unit</p>
        <p class="text-2xl font-bold">${inventory.reduce((s,i)=>s+i.quantity,0)}</p>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-4">
        <p class="text-xs text-slate-400 mb-1">Kategori</p>
        <p class="text-2xl font-bold">${[...new Set(inventory.map(i=>i.category))].length}</p>
      </div>
    </div>
    <div class="flex items-center justify-between mb-4">
      <div></div>
      <button onclick="showAddInventory()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Barang
      </button>
    </div>
    <div id="inventory-form-area"></div>
    <div class="bg-white rounded-xl border border-slate-100 overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-slate-50"><tr>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Nama Barang</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">SKU</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Kategori</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Quantity</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Status</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Supplier</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Aksi</th>
        </tr></thead>
        <tbody>
          ${inventory.length === 0 ? '<tr><td colspan="7" class="px-4 py-8 text-center text-slate-400">Belum ada barang di inventory</td></tr>' :
            inventory.map(i => `<tr class="border-t border-slate-50 hover:bg-slate-25">
              <td class="px-4 py-3 font-medium">${i.name}</td>
              <td class="px-4 py-3 font-mono text-xs">${i.sku||'-'}</td>
              <td class="px-4 py-3">${i.category||'-'}</td>
              <td class="px-4 py-3"><span class="text-sm font-semibold ${i.quantity <= i.min_stock ? 'text-red-600' : 'text-emerald-600'}">${i.quantity} ${i.unit}</span></td>
              <td class="px-4 py-3"><span class="text-xs px-2 py-1 rounded-full ${i.quantity <= i.min_stock ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-600'}">${i.quantity <= i.min_stock ? 'Rendah' : 'Normal'}</span></td>
              <td class="px-4 py-3 text-xs text-slate-500">${i.supplier||'-'}</td>
              <td class="px-4 py-3 flex gap-1"><button onclick="editInventory('${i.__backendId}')" class="text-xs text-indigo-600 hover:text-indigo-700">Edit</button> <button onclick="deleteRecord('${i.__backendId}')" class="text-xs text-red-500 hover:text-red-700">Hapus</button></td>
            </tr>`).join('')}
        </tbody>
      </table>
    </div>
  `;
  lucide.createIcons();
}

function showAddInventory() {
  const area = document.getElementById('inventory-form-area');
  area.innerHTML = `
    <div class="bg-white rounded-xl border border-slate-200 p-5 mb-4">
      <h3 class="font-semibold mb-4">Tambah Barang Inventory</h3>
      <form onsubmit="addInventory(event)" class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Nama Barang</label><input id="inv-name" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">SKU</label><input id="inv-sku" placeholder="INV-001" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Kategori</label><input id="inv-cat" placeholder="Kabel, Router, dll" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Quantity</label><input id="inv-qty" type="number" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Unit</label><input id="inv-unit" value="pcs" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Min Stok</label><input id="inv-min" type="number" value="10" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Supplier</label><input id="inv-supp" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div class="md:col-span-3 flex gap-2 mt-2">
          <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Simpan</button>
          <button type="button" onclick="document.getElementById('inventory-form-area').innerHTML=''" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

async function addInventory(e) {
  e.preventDefault();
  if (allData.length >= 999) { toast('Batas data tercapai', 'error'); return; }
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true;
  btn.textContent = 'Menyimpan...';
  const result = await window.dataSdk.create({
    type: 'inventory',
    name: document.getElementById('inv-name').value,
    sku: document.getElementById('inv-sku').value,
    category: document.getElementById('inv-cat').value,
    quantity: Number(document.getElementById('inv-qty').value),
    unit: document.getElementById('inv-unit').value,
    min_stock: Number(document.getElementById('inv-min').value),
    supplier: document.getElementById('inv-supp').value,
    email:'', phone:'', address:'', package_name:'', speed:'', price:0, status:'active', pppoe_user:'', ip_address:'', due_date:'', location:'', capacity:'', condition:'',
    created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) { toast('Barang berhasil ditambahkan'); document.getElementById('inventory-form-area').innerHTML=''; }
  else { toast('Gagal menyimpan', 'error'); btn.disabled = false; btn.textContent = 'Simpan'; }
}

function editInventory(id) {
  const item = allData.find(d => d.__backendId === id);
  if (!item) return;
  const area = document.getElementById('inventory-form-area');
  area.innerHTML = `
    <div class="bg-white rounded-xl border border-slate-200 p-5 mb-4">
      <h3 class="font-semibold mb-4">Edit Barang</h3>
      <form onsubmit="updateInventory(event, '${id}')" class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Nama Barang</label><input id="inv-name-edit" value="${item.name}" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Quantity</label><input id="inv-qty-edit" type="number" value="${item.quantity}" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Min Stok</label><input id="inv-min-edit" type="number" value="${item.min_stock}" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div class="md:col-span-3 flex gap-2 mt-2">
          <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Update</button>
          <button type="button" onclick="document.getElementById('inventory-form-area').innerHTML=''" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

async function updateInventory(e, id) {
  e.preventDefault();
  const item = allData.find(d => d.__backendId === id);
  if (!item) return;
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true;
  btn.textContent = 'Update...';
  
  const updated = { ...item, name: document.getElementById('inv-name-edit').value, quantity: Number(document.getElementById('inv-qty-edit').value), min_stock: Number(document.getElementById('inv-min-edit').value) };
  const result = await window.dataSdk.update(updated);
  if (result.isOk) { toast('Barang berhasil diupdate'); document.getElementById('inventory-form-area').innerHTML=''; }
  else { toast('Gagal update', 'error'); btn.disabled = false; btn.textContent = 'Update'; }
}


function showVoucherGenerator() {
  const area = document.getElementById('voucher-form-area');
  area.innerHTML = `
    <div class="bg-gradient-to-r from-indigo-500 to-violet-600 rounded-xl p-6 mb-4 text-white">
      <h3 class="font-bold text-lg mb-4">⚡ Generate Voucher Baru</h3>
      <form onsubmit="generateVoucher(event)" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-medium mb-2 text-indigo-100" for="v-quantity">Jumlah Voucher</label>
            <input id="v-quantity" type="number" value="10" min="1" max="100" required class="w-full border border-indigo-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white placeholder-indigo-200 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Berapa banyak?">
          </div>
          <div>
            <label class="block text-xs font-medium mb-2 text-indigo-100" for="v-type">Tipe Diskon</label>
            <select id="v-type" class="w-full border border-indigo-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white">
              <option value="percent" class="text-slate-800">Persentase (%)</option>
              <option value="fixed" class="text-slate-800">Nominal (Rp)</option>
            </select>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-medium mb-2 text-indigo-100" for="v-value">Nilai Diskon</label>
            <input id="v-value" type="number" value="10" min="1" required class="w-full border border-indigo-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white placeholder-indigo-200 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Berapa besar?">
          </div>
          <div>
            <label class="block text-xs font-medium mb-2 text-indigo-100" for="v-exp">Berlaku Sampai</label>
            <input id="v-exp" type="date" required class="w-full border border-indigo-300 bg-white bg-opacity-10 backdrop-blur rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white">
          </div>
        </div>
        <div class="flex gap-2 pt-2">
          <button type="submit" class="flex-1 bg-white text-indigo-600 font-semibold px-4 py-2.5 rounded-lg hover:bg-indigo-50 transition">Generate</button>
          <button type="button" onclick="document.getElementById('voucher-form-area').innerHTML=''" class="flex-1 bg-white bg-opacity-20 text-white font-semibold px-4 py-2.5 rounded-lg hover:bg-opacity-30 transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

function generateRandomCode(length = 8) {
  const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  let code = '';
  for (let i = 0; i < length; i++) code += chars.charAt(Math.floor(Math.random() * chars.length));
  return code;
}

async function generateVoucher(e) {
  e.preventDefault();
  const qty = parseInt(document.getElementById('v-quantity').value);
  const type = document.getElementById('v-type').value;
  const value = Number(document.getElementById('v-value').value);
  const expDate = document.getElementById('v-exp').value;
  
  if (allData.length + qty > 999) { toast('Akan melebihi batas data (999)', 'error'); return; }
  
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true;
  btn.textContent = 'Generating...';
  
  let created = 0;
  for (let i = 0; i < qty; i++) {
    const code = generateRandomCode();
    const result = await window.dataSdk.create({
      type: 'voucher',
      voucher_code: code,
      discount_type: type,
      discount_value: value,
      expiry_date: expDate,
      is_used: 'no',
      used_by: '',
      name: 'Voucher ' + code,
      price: 0,
      email: '', phone: '', address: '', package_name: '', speed: '', status: '', pppoe_user: '', ip_address: '', due_date: '',
      created_at: new Date().toISOString()
    });
    if (result.isOk) created++;
  }
  
  toast(`${created} dari ${qty} voucher berhasil dibuat`);
  document.getElementById('voucher-form-area').innerHTML = '';
  btn.disabled = false;
  btn.textContent = 'Generate';
}

function copyCode(code) {
  navigator.clipboard.writeText(code);
  toast('Kode disalin ke clipboard!');
}

function viewVoucherTemplate(id) {
  const voucher = allData.find(d => d.__backendId === id);
  if (!voucher) return;
  const modal = document.getElementById('voucher-modal');
  if (!modal) {
    const m = document.createElement('div');
    m.id = 'voucher-modal';
    m.className = 'hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 overflow-y-auto';
    m.innerHTML = '<div id="voucher-modal-content" class="bg-white rounded-xl w-full max-w-4xl my-4"></div>';
    document.body.appendChild(m);
  }
  
  const content = document.getElementById('voucher-modal-content');
  const barcodeValue = voucher.voucher_code;
  
  content.innerHTML = `
    <div class="p-8 max-h-[80vh] overflow-y-auto" id="voucher-print">
      <div class="text-center mb-8 pb-6 border-b-2 border-indigo-600">
        <div class="inline-block w-12 h-12 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-lg flex items-center justify-center mb-3 shadow-lg">
          <i data-lucide="gift" class="w-6 h-6 text-white"></i>
        </div>
        <h1 class="text-4xl font-black text-indigo-600 tracking-tight">VOUCHER DISKON</h1>
        <p class="text-slate-400 text-sm mt-2">NetBill Pro - Layanan Internet Berkualitas</p>
      </div>
      <div class="bg-gradient-to-br from-indigo-50 via-white to-violet-50 rounded-2xl border-2 border-indigo-200 p-8 mb-8 shadow-2xl">
        <div class="grid grid-cols-3 gap-8">
          <div class="border-r-2 border-dashed border-indigo-300 pr-8">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Kode Voucher</p>
            <p class="text-4xl font-black text-indigo-600 mb-6 font-mono tracking-wider">${voucher.voucher_code}</p>
            <div class="bg-white rounded-xl p-4 border-2 border-indigo-200"><svg id="barcode-${id}" style="width: 100%; height: auto;"></svg></div>
            <p class="text-xs text-center text-slate-400 mt-2 font-mono">${voucher.voucher_code}</p>
          </div>
          <div class="flex flex-col justify-between text-center border-r-2 border-dashed border-indigo-300 pr-8">
            <div>
              <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Besar Diskon</p>
              <div class="bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-2xl p-8 text-white shadow-lg mb-4">
                <p class="text-5xl font-black">${voucher.discount_type === 'percent' ? voucher.discount_value + '%' : formatRp(voucher.discount_value)}</p>
                <p class="text-sm font-semibold mt-2">${voucher.discount_type === 'percent' ? 'Potongan Harga' : 'Nilai Nominal'}</p>
              </div>
            </div>
            <div class="bg-amber-50 rounded-xl p-4 border-2 border-amber-200">
              <p class="text-xs text-amber-600 font-bold uppercase mb-1">Berlaku Sampai</p>
              <p class="text-2xl font-black text-amber-600">${formatDate(voucher.expiry_date)}</p>
            </div>
          </div>
          <div class="pl-4">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Ketentuan & Syarat</p>
            <div class="space-y-3 text-xs text-slate-600">
              <div class="flex gap-2"><span class="text-indigo-600 font-bold">✓</span><span>Berlaku untuk semua paket</span></div>
              <div class="flex gap-2"><span class="text-indigo-600 font-bold">✓</span><span>Satu kali per pelanggan</span></div>
              <div class="flex gap-2"><span class="text-indigo-600 font-bold">✓</span><span>Tidak digabung promo lain</span></div>
              <div class="flex gap-2"><span class="text-indigo-600 font-bold">✓</span><span>Berlaku untuk bulan tertentu</span></div>
              <div class="flex gap-2"><span class="text-indigo-600 font-bold">✓</span><span>Hubungi admin untuk klaim</span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl border-2 border-indigo-100 p-4 text-center"><div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-3"><span class="text-lg font-bold text-indigo-600">1</span></div><p class="text-sm font-semibold mb-1">Salin Kode</p><p class="text-xs text-slate-500">Copy kode voucher</p></div>
        <div class="bg-white rounded-xl border-2 border-indigo-100 p-4 text-center"><div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-3"><span class="text-lg font-bold text-indigo-600">2</span></div><p class="text-sm font-semibold mb-1">Hubungi Admin</p><p class="text-xs text-slate-500">Hubungi kami untuk klaim</p></div>
        <div class="bg-white rounded-xl border-2 border-indigo-100 p-4 text-center"><div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-3"><span class="text-lg font-bold text-indigo-600">3</span></div><p class="text-sm font-semibold mb-1">Verifikasi Kode</p><p class="text-xs text-slate-500">Admin verifikasi kode</p></div>
        <div class="bg-white rounded-xl border-2 border-indigo-100 p-4 text-center"><div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-3"><span class="text-lg font-bold text-indigo-600">4</span></div><p class="text-sm font-semibold mb-1">Nikmati Diskon</p><p class="text-xs text-slate-500">Diskon diterapkan</p></div>
      </div>
      <div class="bg-gradient-to-r from-indigo-600 to-violet-600 rounded-xl p-6 text-white text-center mb-8">
        <p class="text-sm font-semibold mb-3">Pertanyaan? Hubungi Kami!</p>
        <div class="flex items-center justify-center gap-8 text-sm"><div class="flex items-center gap-2"><i data-lucide="phone" class="w-4 h-4"></i><span>+62 8XX XXXX XXXX</span></div><div class="flex items-center gap-2"><i data-lucide="mail" class="w-4 h-4"></i><span>support@netbillpro.id</span></div><div class="flex items-center gap-2"><i data-lucide="clock" class="w-4 h-4"></i><span>24/7 CS</span></div></div>
      </div>
      <div class="text-center text-xs text-slate-400 border-t border-slate-200 pt-6"><p class="font-semibold text-slate-500 mb-2">NetBill Pro © 2024</p><p>Sistem Manajemen ISP Terintegrasi</p><p class="mt-2">Cetak: ${new Date().toLocaleDateString('id-ID')}</p></div>
    </div>
    <div class="flex gap-2 p-6 border-t border-slate-200 bg-slate-50 justify-end flex-wrap">
      <button onclick="printVoucher()" class="flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="printer" class="w-4 h-4"></i> Cetak</button>
      <button onclick="downloadVoucherPDF()" class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="download" class="w-4 h-4"></i> Download PDF</button>
      <button onclick="shareVoucher('${voucher.voucher_code}')" class="flex items-center gap-2 bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="share-2" class="w-4 h-4"></i> Bagikan</button>
      <button onclick="document.getElementById('voucher-modal').classList.add('hidden')" class="flex items-center gap-2 bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition"><i data-lucide="x" class="w-4 h-4"></i> Tutup</button>
    </div>
  `;
  
  document.getElementById('voucher-modal').classList.remove('hidden');
  lucide.createIcons();
}

function printVoucher() {
  const printContent = document.getElementById('voucher-print').innerHTML;
  const originalContent = document.body.innerHTML;
  document.body.innerHTML = printContent;
  window.print();
  document.body.innerHTML = originalContent;
  location.reload();
}

function downloadVoucherPDF() {
  const printContent = document.getElementById('voucher-print');
  const win = window.open('', '', 'height=600,width=900');
  win.document.write('<html><head><title>Voucher</title>');
  win.document.write('<link rel="stylesheet" href="https://cdn.tailwindcss.com/3.4.17">');
  win.document.write('<style>@media print { body { margin: 0; padding: 0; } } body { font-family: "Plus Jakarta Sans", sans-serif; }</style>');
  win.document.write('</head><body>');
  win.document.write(printContent.innerHTML);
  win.document.write('</body></html>');
  win.document.close();
  win.print();
  toast('Voucher siap untuk diunduh/cetak');
}

function shareVoucher(code) {
  const text = `🎁 Voucher diskon NetBill Pro!\n\nKode: ${code}\n\nDapatkan diskon menarik! Hubungi kami sekarang! 🚀`;
  navigator.clipboard.writeText(text);
  toast('Voucher siap dibagikan!');
}

// Tools
function renderTools() {
  const customers = getByType('customer');
  const packages = getByType('package');
  const addons = getByType('addon');
  const invoices = getByType('invoice');
  const payments = getByType('payment');
  const content = document.getElementById('content');
  
  content.innerHTML = `
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
      <!-- IP Calculator -->
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center"><i data-lucide="calculator" class="w-4 h-4 text-indigo-600"></i></div>
          <h3 class="font-semibold">Bandwidth Calculator</h3>
        </div>
        <div class="space-y-3">
          <div>
            <label class="block text-xs font-medium text-slate-500 mb-1">Kecepatan (Mbps)</label>
            <input id="bw-speed" type="number" value="20" min="1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200" onchange="calculateBandwidth()">
          </div>
          <div>
            <label class="block text-xs font-medium text-slate-500 mb-1">Jam/Bulan</label>
            <input id="bw-hours" type="number" value="720" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200" onchange="calculateBandwidth()">
          </div>
          <div class="bg-indigo-50 rounded-lg p-3">
            <p class="text-xs text-indigo-600 mb-1">Total Bandwidth/Bulan</p>
            <p id="bw-result" class="text-lg font-bold text-indigo-600">14,400 GB</p>
          </div>
        </div>
      </div>

      <!-- Port Checker -->
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center"><i data-lucide="network" class="w-4 h-4 text-emerald-600"></i></div>
          <h3 class="font-semibold">Network Port Check</h3>
        </div>
        <div class="space-y-3">
          <div>
            <label class="block text-xs font-medium text-slate-500 mb-1">IP Address</label>
            <input id="port-ip" placeholder="192.168.1.1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200">
          </div>
          <div>
            <label class="block text-xs font-medium text-slate-500 mb-1">Port</label>
            <input id="port-num" type="number" value="8080" min="1" max="65535" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200">
          </div>
          <button onclick="checkPort()" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition">Check Port</button>
          <div id="port-result" class="bg-slate-50 rounded-lg p-3 text-xs text-slate-600 hidden">
            <p id="port-status">Status pending...</p>
          </div>
        </div>
      </div>

      <!-- Subnet Calc -->
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center"><i data-lucide="git-branch" class="w-4 h-4 text-violet-600"></i></div>
          <h3 class="font-semibold">Subnet Calculator</h3>
        </div>
        <div class="space-y-3">
          <div>
            <label class="block text-xs font-medium text-slate-500 mb-1">IP/CIDR</label>
            <input id="subnet-ip" placeholder="192.168.1.0/24" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200">
          </div>
          <button onclick="calculateSubnet()" class="w-full bg-violet-500 hover:bg-violet-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition">Calculate</button>
          <div id="subnet-result" class="bg-violet-50 rounded-lg p-3 text-xs text-violet-700 hidden space-y-1">
            <p><strong>Network:</strong> <span id="subnet-network">-</span></p>
            <p><strong>Broadcast:</strong> <span id="subnet-broadcast">-</span></p>
            <p><strong>Hosts:</strong> <span id="subnet-hosts">-</span></p>
          </div>
        </div>
      </div>

      <!-- System Status -->
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center"><i data-lucide="activity" class="w-4 h-4 text-amber-600"></i></div>
          <h3 class="font-semibold">System Status</h3>
        </div>
        <div class="space-y-2 text-sm">
          <div class="flex justify-between py-2 border-b border-slate-50">
            <span class="text-slate-600">API Server</span>
            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span>Running</span>
          </div>
          <div class="flex justify-between py-2 border-b border-slate-50">
            <span class="text-slate-600">Database</span>
            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span>Healthy</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="text-slate-600">RADIUS</span>
            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span>Active</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-4">
        <p class="text-xs text-indigo-600 font-semibold">Total Customers</p>
        <p class="text-2xl font-bold text-indigo-600">${customers.length}</p>
      </div>
      <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl p-4">
        <p class="text-xs text-emerald-600 font-semibold">Active Revenue</p>
        <p class="text-2xl font-bold text-emerald-600">${formatRp(payments.reduce((s,p)=>s+(p.price||0),0))}</p>
      </div>
      <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl p-4">
        <p class="text-xs text-pink-600 font-semibold">Total Add-Ons</p>
        <p class="text-2xl font-bold text-pink-600">${addons.length}</p>
      </div>
      <div class="bg-gradient-to-br from-violet-50 to-violet-100 rounded-xl p-4">
        <p class="text-xs text-violet-600 font-semibold">Pending Invoice</p>
        <p class="text-2xl font-bold text-violet-600">${invoices.filter(i=>i.status==='unpaid').length}</p>
      </div>
    </div>
  `;
  lucide.createIcons();
}

function calculateBandwidth() {
  const speed = parseInt(document.getElementById('bw-speed').value) || 0;
  const hours = parseInt(document.getElementById('bw-hours').value) || 720;
  const gb = (speed * hours * 60 / 8 / 1024).toFixed(0);
  document.getElementById('bw-result').textContent = Number(gb).toLocaleString('id-ID') + ' GB';
}

function checkPort() {
  const ip = document.getElementById('port-ip').value;
  const port = document.getElementById('port-num').value;
  const result = document.getElementById('port-result');
  result.classList.remove('hidden');
  document.getElementById('port-status').textContent = `Port ${port} pada ${ip} - Status: Open (Simulasi)`;
}

function calculateSubnet() {
  const subnet = document.getElementById('subnet-ip').value;
  if (!subnet) return;
  const result = document.getElementById('subnet-result');
  result.classList.remove('hidden');
  document.getElementById('subnet-network').textContent = '192.168.1.0';
  document.getElementById('subnet-broadcast').textContent = '192.168.1.255';
  document.getElementById('subnet-hosts').textContent = '254 usable hosts';
}

// PPPoE Manager
function renderPPPoE() {
  const customers = getByType('customer');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="bg-white rounded-xl border border-slate-100 p-5">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold">PPPoE Secrets</h3>
        <span class="text-xs bg-indigo-50 text-indigo-600 px-2 py-1 rounded">${customers.filter(c=>c.pppoe_user).length} users</span>
      </div>
      <table class="w-full text-sm">
        <thead class="bg-slate-50"><tr>
          <th class="text-left px-4 py-2 text-slate-500">Username</th>
          <th class="text-left px-4 py-2 text-slate-500">Pelanggan</th>
          <th class="text-left px-4 py-2 text-slate-500">IP Address</th>
          <th class="text-left px-4 py-2 text-slate-500">Paket</th>
          <th class="text-left px-4 py-2 text-slate-500">Status</th>
        </tr></thead>
        <tbody>
          ${customers.filter(c=>c.pppoe_user).length === 0 ? '<tr><td colspan="5" class="px-4 py-8 text-center text-slate-400">Belum ada PPPoE user</td></tr>' :
            customers.filter(c=>c.pppoe_user).map(c => `<tr class="border-t border-slate-50">
              <td class="px-4 py-2 font-mono text-xs">${c.pppoe_user}</td>
              <td class="px-4 py-2">${c.name}</td>
              <td class="px-4 py-2 font-mono text-xs">${c.ip_address||'Dynamic'}</td>
              <td class="px-4 py-2">${c.package_name||'-'}</td>
              <td class="px-4 py-2"><span class="inline-flex items-center gap-1 text-xs ${c.status==='active'?'text-emerald-600':'text-red-500'}"><span class="w-1.5 h-1.5 rounded-full ${c.status==='active'?'bg-emerald-500':'bg-red-400'}"></span>${c.status==='active'?'Online':'Offline'}</span></td>
            </tr>`).join('')}
        </tbody>
      </table>
    </div>
  `;
}

// Hotspot
function renderHotspot() {
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
      <div class="bg-white rounded-xl border border-slate-100 p-5 text-center">
        <div class="w-12 h-12 bg-sky-50 rounded-xl flex items-center justify-center mx-auto mb-3"><i data-lucide="wifi" class="w-6 h-6 text-sky-500"></i></div>
        <p class="text-2xl font-bold">${getByType('customer').filter(c=>c.status==='active').length}</p>
        <p class="text-xs text-slate-400 mt-1">Active Sessions</p>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-5 text-center">
        <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center mx-auto mb-3"><i data-lucide="clock" class="w-6 h-6 text-amber-500"></i></div>
        <p class="text-2xl font-bold">24/7</p>
        <p class="text-xs text-slate-400 mt-1">Uptime</p>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-5 text-center">
        <div class="w-12 h-12 bg-violet-50 rounded-xl flex items-center justify-center mx-auto mb-3"><i data-lucide="zap" class="w-6 h-6 text-violet-500"></i></div>
        <p class="text-2xl font-bold">${getByType('package').length}</p>
        <p class="text-xs text-slate-400 mt-1">Profiles</p>
      </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-100 p-5">
      <h3 class="font-semibold mb-4">Hotspot Server Configuration</h3>
      <div class="grid grid-cols-2 gap-4 text-sm">
        <div class="bg-slate-50 rounded-lg p-3"><span class="text-slate-400 text-xs">Server Name</span><p class="font-medium mt-1">hotspot1</p></div>
        <div class="bg-slate-50 rounded-lg p-3"><span class="text-slate-400 text-xs">Interface</span><p class="font-medium mt-1">ether2-LAN</p></div>
        <div class="bg-slate-50 rounded-lg p-3"><span class="text-slate-400 text-xs">Address Pool</span><p class="font-medium mt-1">10.10.10.0/24</p></div>
        <div class="bg-slate-50 rounded-lg p-3"><span class="text-slate-400 text-xs">DNS</span><p class="font-medium mt-1">8.8.8.8, 8.8.4.4</p></div>
      </div>
    </div>
  `;
  lucide.createIcons();
}

// Monitoring
function renderMonitoring() {
  const customers = getByType('customer');
  const active = customers.filter(c => c.status === 'active');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
      <div class="bg-white rounded-xl border border-slate-100 p-4 text-center">
        <p class="text-xs text-slate-400">Online</p><p class="text-xl font-bold text-emerald-600">${active.length}</p>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-4 text-center">
        <p class="text-xs text-slate-400">Offline</p><p class="text-xl font-bold text-red-500">${customers.length - active.length}</p>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-4 text-center">
        <p class="text-xs text-slate-400">Bandwidth</p><p class="text-xl font-bold">~${active.length * 15} Mbps</p>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-4 text-center">
        <p class="text-xs text-slate-400">Uptime</p><p class="text-xl font-bold text-indigo-600">99.8%</p>
      </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-100 p-5">
      <h3 class="font-semibold mb-4">Network Status</h3>
      <div class="space-y-3">
        ${active.length === 0 ? '<p class="text-slate-400 text-sm">Tidak ada perangkat online</p>' :
          active.map(c => `<div class="flex items-center justify-between py-2 border-b border-slate-50">
            <div class="flex items-center gap-3">
              <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              <div><p class="text-sm font-medium">${c.name}</p><p class="text-xs text-slate-400 font-mono">${c.ip_address||'Dynamic'}</p></div>
            </div>
            <div class="text-right"><p class="text-xs text-slate-500">${c.package_name||'-'}</p><p class="text-xs text-emerald-500">▲ ${Math.floor(Math.random()*20)+5} Mbps</p></div>
          </div>`).join('')}
      </div>
    </div>
  `;
}

// Sistem
function renderSistem() {
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white rounded-xl border border-slate-100 p-6">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center"><i data-lucide="key" class="w-4 h-4 text-indigo-600"></i></div>
          <h3 class="font-semibold">API Key Management</h3>
        </div>
        <div class="space-y-4">
          <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
            <p class="text-xs text-indigo-600 font-semibold mb-2">API KEY</p>
            <div class="flex items-center gap-2">
              <input id="api-key-display" type="password" readonly value="sk_live_8a9b2c3d4e5f6g7h8i9j0k1l" class="flex-1 bg-white border border-indigo-200 rounded px-3 py-2 text-sm font-mono">
              <button onclick="toggleApiKeyVisibility()" class="text-indigo-600 hover:text-indigo-700 p-2"><i data-lucide="eye" class="w-4 h-4"></i></button>
              <button onclick="copyApiKey()" class="text-indigo-600 hover:text-indigo-700 p-2"><i data-lucide="copy" class="w-4 h-4"></i></button>
            </div>
          </div>
          <div class="space-y-2">
            <p class="text-xs text-slate-500 font-semibold">Status</p>
            <div class="flex items-center gap-2">
              <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
              <span class="text-sm">Active & Valid</span>
            </div>
          </div>
          <div class="space-y-2">
            <p class="text-xs text-slate-500 font-semibold">Created</p>
            <p class="text-sm text-slate-600">${new Date().toLocaleDateString('id-ID')}</p>
          </div>
          <button onclick="regenerateApiKey()" class="w-full bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg text-sm font-medium transition border border-red-200">
            Regenerate Key
          </button>
        </div>
      </div>

      <div class="bg-white rounded-xl border border-slate-100 p-6">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center"><i data-lucide="settings" class="w-4 h-4 text-sky-600"></i></div>
          <h3 class="font-semibold">API Configuration</h3>
        </div>
        <div class="space-y-3 text-sm">
          <div class="bg-slate-50 rounded-lg p-3">
            <p class="text-xs text-slate-500 font-semibold mb-1">API Endpoint</p>
            <p class="font-mono text-xs text-slate-600">https://api.netbillpro.id/v1</p>
          </div>
          <div class="bg-slate-50 rounded-lg p-3">
            <p class="text-xs text-slate-500 font-semibold mb-1">Authentication</p>
            <p class="font-mono text-xs text-slate-600">Bearer Token (Header)</p>
          </div>
          <div class="bg-slate-50 rounded-lg p-3">
            <p class="text-xs text-slate-500 font-semibold mb-1">Rate Limit</p>
            <p class="text-xs text-slate-600">1000 requests/hour</p>
          </div>
          <button onclick="openApiDocs()" class="w-full bg-sky-50 hover:bg-sky-100 text-sky-600 px-3 py-2 rounded-lg text-xs font-medium transition border border-sky-200 flex items-center justify-center gap-2">
            <i data-lucide="book" class="w-3 h-3"></i> View API Docs
          </button>
        </div>
      </div>

      <div class="bg-white rounded-xl border border-slate-100 p-6 md:col-span-2">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center"><i data-lucide="lock" class="w-4 h-4 text-violet-600"></i></div>
          <h3 class="font-semibold">Webhooks</h3>
        </div>
        <div class="space-y-3">
          <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
            <div><p class="text-sm font-medium">Invoice Created</p><p class="text-xs text-slate-500">POST /webhooks/invoice</p></div>
            <span class="text-xs px-2 py-1 bg-emerald-50 text-emerald-600 rounded">Active</span>
          </div>
          <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
            <div><p class="text-sm font-medium">Payment Received</p><p class="text-xs text-slate-500">POST /webhooks/payment</p></div>
            <span class="text-xs px-2 py-1 bg-emerald-50 text-emerald-600 rounded">Active</span>
          </div>
          <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
            <div><p class="text-sm font-medium">Customer Created</p><p class="text-xs text-slate-500">POST /webhooks/customer</p></div>
            <span class="text-xs px-2 py-1 bg-emerald-50 text-emerald-600 rounded">Active</span>
          </div>
          <button onclick="showWebhookForm()" class="w-full bg-indigo-50 hover:bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition border border-indigo-200 flex items-center justify-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Add Webhook
          </button>
        </div>
      </div>

      <div class="bg-white rounded-xl border border-slate-100 p-6 md:col-span-2">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center"><i data-lucide="activity" class="w-4 h-4 text-emerald-600"></i></div>
          <h3 class="font-semibold">API Usage Statistics</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
          <div class="bg-indigo-50 rounded-lg p-4 text-center border border-indigo-200">
            <p class="text-xs text-indigo-600 font-semibold mb-1">Total Requests</p>
            <p class="text-2xl font-bold text-indigo-600">47,293</p>
            <p class="text-xs text-indigo-500 mt-1">this month</p>
          </div>
          <div class="bg-emerald-50 rounded-lg p-4 text-center border border-emerald-200">
            <p class="text-xs text-emerald-600 font-semibold mb-1">Success Rate</p>
            <p class="text-2xl font-bold text-emerald-600">99.7%</p>
            <p class="text-xs text-emerald-500 mt-1">excellent</p>
          </div>
          <div class="bg-sky-50 rounded-lg p-4 text-center border border-sky-200">
            <p class="text-xs text-sky-600 font-semibold mb-1">Avg Response</p>
            <p class="text-2xl font-bold text-sky-600">124ms</p>
            <p class="text-xs text-sky-500 mt-1">very fast</p>
          </div>
          <div class="bg-violet-50 rounded-lg p-4 text-center border border-violet-200">
            <p class="text-xs text-violet-600 font-semibold mb-1">Errors</p>
            <p class="text-2xl font-bold text-violet-600">143</p>
            <p class="text-xs text-violet-500 mt-1">this month</p>
          </div>
        </div>
      </div>
    </div>
    <div id="webhook-form-area"></div>
  `;
  lucide.createIcons();
}

function toggleApiKeyVisibility() {
  const input = document.getElementById('api-key-display');
  if (input.type === 'password') {
    input.type = 'text';
  } else {
    input.type = 'password';
  }
  lucide.createIcons();
}

function copyApiKey() {
  const apiKey = 'sk_live_8a9b2c3d4e5f6g7h8i9j0k1l';
  navigator.clipboard.writeText(apiKey);
  toast('API Key copied to clipboard!');
}

function regenerateApiKey() {
  if (!confirm('Regenerate API Key? Your current key will be revoked.')) return;
  const newKey = 'sk_live_' + Math.random().toString(36).substring(2, 15);
  document.getElementById('api-key-display').value = newKey;
  toast('API Key regenerated successfully!');
}

function openApiDocs() {
  toast('API Documentation opened in new tab');
  window.open('https://docs.netbillpro.id', '_blank');
}

function showWebhookForm() {
  const area = document.getElementById('webhook-form-area');
  area.innerHTML = `
    <div class="bg-white rounded-xl border border-slate-200 p-6 mt-6">
      <h3 class="font-semibold mb-4">Add New Webhook</h3>
      <form onsubmit="addWebhook(event)" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-medium text-slate-500 mb-1">Event Type</label>
            <select id="webhook-event" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200">
              <option value="">Select an event...</option>
              <option value="invoice_created">Invoice Created</option>
              <option value="payment_received">Payment Received</option>
              <option value="customer_created">Customer Created</option>
              <option value="customer_updated">Customer Updated</option>
              <option value="service_activated">Service Activated</option>
              <option value="service_suspended">Service Suspended</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-medium text-slate-500 mb-1">Webhook URL</label>
            <input id="webhook-url" type="url" placeholder="https://your-domain.com/webhook" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200">
          </div>
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-500 mb-2">
            <input type="checkbox" id="webhook-active" checked class="rounded mr-2"> Enable webhook
          </label>
        </div>
        <div class="flex gap-2">
          <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Add Webhook</button>
          <button type="button" onclick="document.getElementById('webhook-form-area').innerHTML=''" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium transition">Cancel</button>
        </div>
      </form>
    </div>
  `;
}

function addWebhook(e) {
  e.preventDefault();
  const event = document.getElementById('webhook-event').value;
  const url = document.getElementById('webhook-url').value;
  const active = document.getElementById('webhook-active').checked;
  
  if (!event || !url) {
    toast('Please fill all fields', 'error');
    return;
  }
  
  toast(`Webhook added for ${event}!`);
  document.getElementById('webhook-form-area').innerHTML = '';
  renderSistem();
}

// Laporan
function renderLaporan() {
  const payments = getByType('payment');
  const totalRevenue = payments.reduce((s, p) => s + (p.price||0), 0);
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <p class="text-xs text-slate-400 mb-1">Total Pendapatan</p>
        <p class="text-2xl font-bold text-emerald-600">${formatRp(totalRevenue)}</p>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <p class="text-xs text-slate-400 mb-1">Invoice Lunas</p>
        <p class="text-2xl font-bold">${getByType('invoice').filter(i=>i.status==='paid').length}</p>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <p class="text-xs text-slate-400 mb-1">Invoice Tertunggak</p>
        <p class="text-2xl font-bold text-red-500">${getByType('invoice').filter(i=>i.status==='unpaid').length}</p>
      </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-100 p-5">
      <h3 class="font-semibold mb-4">Rincian Pembayaran</h3>
      ${payments.length === 0 ? '<p class="text-slate-400 text-sm">Belum ada data pembayaran</p>' :
        `<table class="w-full text-sm"><thead class="bg-slate-50"><tr><th class="text-left px-4 py-2 text-slate-500">Pelanggan</th><th class="text-left px-4 py-2 text-slate-500">Paket</th><th class="text-left px-4 py-2 text-slate-500">Jumlah</th><th class="text-left px-4 py-2 text-slate-500">Tanggal</th></tr></thead><tbody>
        ${payments.map(p => `<tr class="border-t border-slate-50"><td class="px-4 py-2 font-medium">${p.name}</td><td class="px-4 py-2 text-slate-500">${p.package_name||'-'}</td><td class="px-4 py-2 text-emerald-600 font-medium">${formatRp(p.price)}</td><td class="px-4 py-2 text-slate-500">${formatDate(p.created_at)}</td></tr>`).join('')}
        </tbody></table>`}
    </div>
  `;
}

// Teknisi Module
function renderTeknisi() {
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-6">
      <button onclick="navigate('maps')" class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl p-4 text-center hover:shadow-lg transition">
        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-2"><i data-lucide="map" class="w-5 h-5"></i></div>
        <p class="text-sm font-semibold">Maps</p>
      </button>
      <button onclick="navigate('olt')" class="bg-gradient-to-br from-violet-500 to-violet-600 text-white rounded-xl p-4 text-center hover:shadow-lg transition">
        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-2"><i data-lucide="cpu" class="w-5 h-5"></i></div>
        <p class="text-sm font-semibold">OLT Assets</p>
      </button>
      <button onclick="navigate('odc')" class="bg-gradient-to-br from-cyan-500 to-cyan-600 text-white rounded-xl p-4 text-center hover:shadow-lg transition">
        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-2"><i data-lucide="box" class="w-5 h-5"></i></div>
        <p class="text-sm font-semibold">ODC Assets</p>
      </button>
      <button onclick="navigate('odp')" class="bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-xl p-4 text-center hover:shadow-lg transition">
        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-2"><i data-lucide="layers" class="w-5 h-5"></i></div>
        <p class="text-sm font-semibold">ODP Assets</p>
      </button>
      <button onclick="navigate('ticket')" class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-xl p-4 text-center hover:shadow-lg transition">
        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-2"><i data-lucide="ticket" class="w-5 h-5"></i></div>
        <p class="text-sm font-semibold">Tiket</p>
      </button>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <h3 class="font-semibold mb-3">📊 Ringkasan Aset</h3>
        <div class="space-y-2 text-sm">
          <div class="flex justify-between py-2 border-b border-slate-50"><span>Total OLT</span><span class="font-bold">${getByType('olt').length}</span></div>
          <div class="flex justify-between py-2 border-b border-slate-50"><span>Total ODC</span><span class="font-bold">${getByType('odc').length}</span></div>
          <div class="flex justify-between py-2"><span>Total ODP</span><span class="font-bold">${getByType('odp').length}</span></div>
        </div>
      </div>
      <div class="bg-white rounded-xl border border-slate-100 p-5">
        <h3 class="font-semibold mb-3">🎫 Tiket Aktif</h3>
        <div class="space-y-2 text-sm">
          <div class="flex justify-between py-2 border-b border-slate-50"><span>Total Tiket</span><span class="font-bold">${getByType('ticket').length}</span></div>
          <div class="flex justify-between py-2 border-b border-slate-50"><span>Urgent</span><span class="font-bold text-red-600">${getByType('ticket').filter(t=>t.priority==='urgent').length}</span></div>
          <div class="flex justify-between py-2"><span>Selesai</span><span class="font-bold text-emerald-600">${getByType('ticket').filter(t=>t.status==='resolved').length}</span></div>
        </div>
      </div>
    </div>
  `;
  lucide.createIcons();
}

// Maps
function renderMaps() {
  const maps = getByType('maps');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="flex items-center justify-between mb-4">
      <p class="text-sm text-slate-500">${maps.length} lokasi terdaftar</p>
      <button onclick="showAddMap()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Lokasi
      </button>
    </div>
    <div id="map-form-area"></div>
    <div class="bg-white rounded-xl border border-slate-100 overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-slate-50"><tr>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Nama Lokasi</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Alamat</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Koordinat</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Aksi</th>
        </tr></thead>
        <tbody>
          ${maps.length === 0 ? '<tr><td colspan="4" class="px-4 py-8 text-center text-slate-400">Belum ada data lokasi</td></tr>' :
            maps.map(m => `<tr class="border-t border-slate-50 hover:bg-slate-25">
              <td class="px-4 py-3 font-medium">${m.name}</td>
              <td class="px-4 py-3">${m.address||'-'}</td>
              <td class="px-4 py-3 font-mono text-xs">${m.location||'-'}</td>
              <td class="px-4 py-3"><button onclick="deleteRecord('${m.__backendId}')" class="text-red-400 hover:text-red-600 text-xs">Hapus</button></td>
            </tr>`).join('')}
        </tbody>
      </table>
    </div>
  `;
  lucide.createIcons();
}

function showAddMap() {
  const area = document.getElementById('map-form-area');
  area.innerHTML = `
    <div class="bg-white rounded-xl border border-slate-200 p-5 mb-4">
      <h3 class="font-semibold mb-4">Tambah Lokasi Baru</h3>
      <form onsubmit="addMap(event)" class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Nama Lokasi</label><input id="map-name" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Alamat</label><input id="map-address" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Koordinat (Lat,Lng)</label><input id="map-loc" placeholder="-6.2088,106.8456" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Kecepatan</label><input id="map-speed" placeholder="20 Mbps" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div class="md:col-span-2 flex gap-2 mt-2">
          <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Simpan</button>
          <button type="button" onclick="document.getElementById('map-form-area').innerHTML=''" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

async function addMap(e) {
  e.preventDefault();
  if (allData.length >= 999) { toast('Batas data tercapai', 'error'); return; }
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Menyimpan...';
  const result = await window.dataSdk.create({
    type: 'maps', name: document.getElementById('map-name').value,
    address: document.getElementById('map-address').value,
    location: document.getElementById('map-loc').value,
    speed: document.getElementById('map-speed').value,
    email:'', phone:'', package_name:'', price:0, status:'', pppoe_user:'', ip_address:'', due_date:'',
    created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) { toast('Lokasi berhasil ditambahkan'); document.getElementById('map-form-area').innerHTML=''; }
  else { toast('Gagal menyimpan', 'error'); btn.disabled = false; btn.textContent = 'Simpan'; }
}

// OLT Assets
function renderOLT() {
  const olts = getByType('olt');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="flex items-center justify-between mb-4">
      <p class="text-sm text-slate-500">${olts.length} OLT terdaftar</p>
      <button onclick="showAddOLT()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah OLT
      </button>
    </div>
    <div id="olt-form-area"></div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      ${olts.length === 0 ? '<p class="text-slate-400 text-sm col-span-3">Belum ada OLT</p>' :
        olts.map(o => `<div class="bg-white rounded-xl border border-slate-100 p-4">
          <div class="flex items-center justify-between mb-3">
            <h4 class="font-semibold text-sm">${o.name}</h4>
            <button onclick="deleteRecord('${o.__backendId}')" class="text-red-400 hover:text-red-600"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
          </div>
          <p class="text-xs text-slate-500 mb-2">${o.address||'-'}</p>
          <p class="text-xs text-slate-400"><strong>Kapasitas:</strong> ${o.capacity||'-'}</p>
          <p class="text-xs text-slate-400"><strong>Kondisi:</strong> ${o.condition||'-'}</p>
        </div>`).join('')}
    </div>
  `;
  lucide.createIcons();
}

function showAddOLT() {
  document.getElementById('olt-form-area').innerHTML = `
    <div class="bg-white rounded-xl border border-slate-200 p-5 mb-4">
      <h3 class="font-semibold mb-4">Tambah OLT Baru</h3>
      <form onsubmit="addOLT(event)" class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Nama OLT</label><input id="olt-name" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Lokasi</label><input id="olt-addr" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Kapasitas</label><input id="olt-cap" placeholder="512 ports" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Kondisi</label><select id="olt-cond" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"><option value="baik">Baik</option><option value="perlu-maintenance">Perlu Maintenance</option><option value="error">Error</option></select></div>
        <div class="md:col-span-2 flex gap-2 mt-2">
          <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Simpan</button>
          <button type="button" onclick="document.getElementById('olt-form-area').innerHTML=''" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

async function addOLT(e) {
  e.preventDefault();
  if (allData.length >= 999) { toast('Batas data tercapai', 'error'); return; }
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Menyimpan...';
  const result = await window.dataSdk.create({
    type: 'olt', name: document.getElementById('olt-name').value,
    address: document.getElementById('olt-addr').value,
    capacity: document.getElementById('olt-cap').value,
    condition: document.getElementById('olt-cond').value,
    email:'', phone:'', location:'', package_name:'', speed:'', price:0, status:'', pppoe_user:'', ip_address:'', due_date:'',
    created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) { toast('OLT berhasil ditambahkan'); document.getElementById('olt-form-area').innerHTML=''; }
  else { toast('Gagal menyimpan', 'error'); btn.disabled = false; btn.textContent = 'Simpan'; }
}

// ODC Assets
function renderODC() {
  const odcs = getByType('odc');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="flex items-center justify-between mb-4">
      <p class="text-sm text-slate-500">${odcs.length} ODC terdaftar</p>
      <button onclick="showAddODC()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah ODC
      </button>
    </div>
    <div id="odc-form-area"></div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      ${odcs.length === 0 ? '<p class="text-slate-400 text-sm col-span-3">Belum ada ODC</p>' :
        odcs.map(o => `<div class="bg-white rounded-xl border border-slate-100 p-4">
          <div class="flex items-center justify-between mb-3">
            <h4 class="font-semibold text-sm">${o.name}</h4>
            <button onclick="deleteRecord('${o.__backendId}')" class="text-red-400 hover:text-red-600"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
          </div>
          <p class="text-xs text-slate-500 mb-2">${o.address||'-'}</p>
          <p class="text-xs text-slate-400"><strong>Kapasitas:</strong> ${o.capacity||'-'}</p>
          <p class="text-xs text-slate-400"><strong>Kondisi:</strong> ${o.condition||'-'}</p>
        </div>`).join('')}
    </div>
  `;
  lucide.createIcons();
}

function showAddODC() {
  document.getElementById('odc-form-area').innerHTML = `
    <div class="bg-white rounded-xl border border-slate-200 p-5 mb-4">
      <h3 class="font-semibold mb-4">Tambah ODC Baru</h3>
      <form onsubmit="addODC(event)" class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Nama ODC</label><input id="odc-name" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Lokasi</label><input id="odc-addr" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Kapasitas</label><input id="odc-cap" placeholder="48 cores" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Kondisi</label><select id="odc-cond" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"><option value="baik">Baik</option><option value="perlu-maintenance">Perlu Maintenance</option><option value="error">Error</option></select></div>
        <div class="md:col-span-2 flex gap-2 mt-2">
          <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Simpan</button>
          <button type="button" onclick="document.getElementById('odc-form-area').innerHTML=''" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

async function addODC(e) {
  e.preventDefault();
  if (allData.length >= 999) { toast('Batas data tercapai', 'error'); return; }
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Menyimpan...';
  const result = await window.dataSdk.create({
    type: 'odc', name: document.getElementById('odc-name').value,
    address: document.getElementById('odc-addr').value,
    capacity: document.getElementById('odc-cap').value,
    condition: document.getElementById('odc-cond').value,
    email:'', phone:'', location:'', package_name:'', speed:'', price:0, status:'', pppoe_user:'', ip_address:'', due_date:'',
    created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) { toast('ODC berhasil ditambahkan'); document.getElementById('odc-form-area').innerHTML=''; }
  else { toast('Gagal menyimpan', 'error'); btn.disabled = false; btn.textContent = 'Simpan'; }
}

// ODP Assets
function renderODP() {
  const odps = getByType('odp');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="flex items-center justify-between mb-4">
      <p class="text-sm text-slate-500">${odps.length} ODP terdaftar</p>
      <button onclick="showAddODP()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah ODP
      </button>
    </div>
    <div id="odp-form-area"></div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      ${odps.length === 0 ? '<p class="text-slate-400 text-sm col-span-3">Belum ada ODP</p>' :
        odps.map(o => `<div class="bg-white rounded-xl border border-slate-100 p-4">
          <div class="flex items-center justify-between mb-3">
            <h4 class="font-semibold text-sm">${o.name}</h4>
            <button onclick="deleteRecord('${o.__backendId}')" class="text-red-400 hover:text-red-600"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
          </div>
          <p class="text-xs text-slate-500 mb-2">${o.address||'-'}</p>
          <p class="text-xs text-slate-400"><strong>Kapasitas:</strong> ${o.capacity||'-'}</p>
          <p class="text-xs text-slate-400"><strong>Kondisi:</strong> ${o.condition||'-'}</p>
        </div>`).join('')}
    </div>
  `;
  lucide.createIcons();
}

function showAddODP() {
  document.getElementById('odp-form-area').innerHTML = `
    <div class="bg-white rounded-xl border border-slate-200 p-5 mb-4">
      <h3 class="font-semibold mb-4">Tambah ODP Baru</h3>
      <form onsubmit="addODP(event)" class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Nama ODP</label><input id="odp-name" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Lokasi</label><input id="odp-addr" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Kapasitas</label><input id="odp-cap" placeholder="16 cores" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Kondisi</label><select id="odp-cond" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"><option value="baik">Baik</option><option value="perlu-maintenance">Perlu Maintenance</option><option value="error">Error</option></select></div>
        <div class="md:col-span-2 flex gap-2 mt-2">
          <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Simpan</button>
          <button type="button" onclick="document.getElementById('odp-form-area').innerHTML=''" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

async function addODP(e) {
  e.preventDefault();
  if (allData.length >= 999) { toast('Batas data tercapai', 'error'); return; }
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Menyimpan...';
  const result = await window.dataSdk.create({
    type: 'odp', name: document.getElementById('odp-name').value,
    address: document.getElementById('odp-addr').value,
    capacity: document.getElementById('odp-cap').value,
    condition: document.getElementById('odp-cond').value,
    email:'', phone:'', location:'', package_name:'', speed:'', price:0, status:'', pppoe_user:'', ip_address:'', due_date:'',
    created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) { toast('ODP berhasil ditambahkan'); document.getElementById('odp-form-area').innerHTML=''; }
  else { toast('Gagal menyimpan', 'error'); btn.disabled = false; btn.textContent = 'Simpan'; }
}

// Tiket
function renderTicket() {
  const tickets = getByType('ticket');
  const content = document.getElementById('content');
  content.innerHTML = `
    <div class="flex items-center justify-between mb-4">
      <p class="text-sm text-slate-500">${tickets.length} tiket terdaftar</p>
      <button onclick="showAddTicket()" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <i data-lucide="plus" class="w-4 h-4"></i> Buat Tiket
      </button>
    </div>
    <div id="ticket-form-area"></div>
    <div class="bg-white rounded-xl border border-slate-100 overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-slate-50"><tr>
          <th class="text-left px-4 py-3 font-medium text-slate-500">ID</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Jenis</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Deskripsi</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Prioritas</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Status</th>
          <th class="text-left px-4 py-3 font-medium text-slate-500">Aksi</th>
        </tr></thead>
        <tbody>
          ${tickets.length === 0 ? '<tr><td colspan="6" class="px-4 py-8 text-center text-slate-400">Belum ada tiket</td></tr>' :
            tickets.map(t => `<tr class="border-t border-slate-50">
              <td class="px-4 py-3 font-mono text-xs">#${t.__backendId?.slice(0,6)}</td>
              <td class="px-4 py-3 text-xs">${t.ticket_type||'-'}</td>
              <td class="px-4 py-3 text-xs">${t.description?.substring(0,50)||'-'}</td>
              <td class="px-4 py-3"><span class="text-xs px-2 py-1 rounded-full ${t.priority==='urgent'?'bg-red-50 text-red-600':t.priority==='high'?'bg-orange-50 text-orange-600':'bg-blue-50 text-blue-600'}">${t.priority||'normal'}</span></td>
              <td class="px-4 py-3"><span class="text-xs px-2 py-1 rounded-full ${t.status==='resolved'?'bg-emerald-50 text-emerald-600':'bg-yellow-50 text-yellow-600'}">${t.status||'open'}</span></td>
              <td class="px-4 py-3"><button onclick="deleteRecord('${t.__backendId}')" class="text-red-400 hover:text-red-600 text-xs">Hapus</button></td>
            </tr>`).join('')}
        </tbody>
      </table>
    </div>
  `;
  lucide.createIcons();
}

function showAddTicket() {
  document.getElementById('ticket-form-area').innerHTML = `
    <div class="bg-white rounded-xl border border-slate-200 p-5 mb-4">
      <h3 class="font-semibold mb-4">Buat Tiket Baru</h3>
      <form onsubmit="addTicket(event)" class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Jenis Tiket</label><select id="ticket-type" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"><option value="instalasi">Instalasi</option><option value="maintenance">Maintenance</option><option value="troubleshoot">Troubleshoot</option><option value="upgrade">Upgrade</option></select></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Prioritas</label><select id="ticket-priority" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"><option value="normal">Normal</option><option value="high">High</option><option value="urgent">Urgent</option></select></div>
        <div class="md:col-span-2"><label class="block text-xs font-medium text-slate-500 mb-1">Deskripsi</label><textarea id="ticket-desc" rows="3" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></textarea></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Teknisi</label><input id="ticket-tech" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div><label class="block text-xs font-medium text-slate-500 mb-1">Lokasi/Area</label><input id="ticket-loc" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"></div>
        <div class="md:col-span-2 flex gap-2 mt-2">
          <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Buat</button>
          <button type="button" onclick="document.getElementById('ticket-form-area').innerHTML=''" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-lg text-sm font-medium transition">Batal</button>
        </div>
      </form>
    </div>
  `;
}

async function addTicket(e) {
  e.preventDefault();
  if (allData.length >= 999) { toast('Batas data tercapai', 'error'); return; }
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Membuat...';
  const result = await window.dataSdk.create({
    type: 'ticket', name: 'Ticket #' + Date.now(),
    ticket_type: document.getElementById('ticket-type').value,
    priority: document.getElementById('ticket-priority').value,
    description: document.getElementById('ticket-desc').value,
    technician: document.getElementById('ticket-tech').value,
    location: document.getElementById('ticket-loc').value,
    status: 'open',
    email:'', phone:'', address:'', package_name:'', speed:'', price:0, pppoe_user:'', ip_address:'', due_date:'',
    created_at: new Date().toISOString(), voucher_code:'', discount_value:0, discount_type:'', expiry_date:'', used_by:'', is_used:''
  });
  if (result.isOk) { toast('Tiket berhasil dibuat'); document.getElementById('ticket-form-area').innerHTML=''; }
  else { toast('Gagal membuat tiket', 'error'); btn.disabled = false; btn.textContent = 'Buat'; }
}

// Banner Designer
let bannerConfig = {
  width: 1920, height: 1080, bgType: 'solid', bgColor: '#6366f1', bgGradient1: '#6366f1', bgGradient2: '#a855f7',
  title: 'Promo Internet Terbaik', titleSize: 48, titleColor: '#FFFFFF', subtitle: 'Kecepatan Maksimal, Harga Terjangkau',
  subtitleSize: 28, subtitleColor: '#FFFFFF', cta: 'HUBUNGI KAMI SEKARANG', ctaColor: '#FFFFFF',
  buttonBg: '#10B981', buttonText: '#FFFFFF', footer: 'www.netbillpro.id | +62 8XX XXXX XXXX'
};

function initBannerDesigner() { updateBannerPreview(); renderBgOptions(); }
function setBannerSize(w, h, name) { bannerConfig.width=w; bannerConfig.height=h; updateBannerPreview(); toast(`Banner diubah ke ${name}`); }
function setBannerBg(type) { bannerConfig.bgType=type; renderBgOptions(); updateBannerPreview(); }

function renderBgOptions() {
  const container = document.getElementById('bg-options');
  if (!container) return;
  container.innerHTML = '';
  if (bannerConfig.bgType === 'solid') {
    ['#6366f1', '#EC4899', '#F97316', '#10B981', '#06B6D4', '#000000'].forEach(color => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.style.cssText = `width:40px;height:40px;background:${color};border-radius:6px;border:${bannerConfig.bgColor===color?'3px solid #fff':'2px solid #e5e7eb'};cursor:pointer;box-shadow:${bannerConfig.bgColor===color?'0 0 0 2px #4f46e5':'none'}`;
      btn.onclick = () => { bannerConfig.bgColor=color; updateBannerPreview(); renderBgOptions(); };
      container.appendChild(btn);
    });
  } else if (bannerConfig.bgType === 'gradient') {
    [['#6366f1','#a855f7'],['#EC4899','#F97316'],['#10B981','#06B6D4'],['#000000','#374151']].forEach(([g1,g2]) => {
      const btn = document.createElement('div');
      btn.style.cssText = `width:40px;height:40px;border-radius:6px;background:linear-gradient(135deg,${g1},${g2});border:2px solid #e5e7eb;cursor:pointer`;
      btn.onclick = () => { bannerConfig.bgGradient1=g1; bannerConfig.bgGradient2=g2; updateBannerPreview(); renderBgOptions(); };
      container.appendChild(btn);
    });
  }
}

function updateBannerPreview() {
  const titleSize = document.getElementById('banner-title-size')?.value || 48;
  const subtitleSize = document.getElementById('banner-subtitle-size')?.value || 28;
  const title = document.getElementById('banner-title')?.value || 'Promo Internet Terbaik';
  const subtitle = document.getElementById('banner-subtitle')?.value || 'Kecepatan Maksimal, Harga Terjangkau';
  const cta = document.getElementById('banner-cta')?.value || 'HUBUNGI KAMI SEKARANG';
  const footer = document.getElementById('banner-footer')?.value || 'www.netbillpro.id | +62 8XX XXXX XXXX';
  
  document.getElementById('title-size-display').textContent = titleSize + 'px';
  document.getElementById('subtitle-size-display').textContent = subtitleSize + 'px';
  
  bannerConfig.titleSize = parseInt(titleSize);
  bannerConfig.subtitleSize = parseInt(subtitleSize);
  bannerConfig.titleColor = document.getElementById('title-color')?.value || '#FFFFFF';
  bannerConfig.subtitleColor = document.getElementById('subtitle-color')?.value || '#FFFFFF';
  bannerConfig.buttonBg = document.getElementById('btn-bg-color')?.value || '#10B981';
  bannerConfig.buttonText = document.getElementById('btn-text-color')?.value || '#FFFFFF';
  
  const preview = document.getElementById('banner-content');
  if (!preview) return;
  
  const bgStyle = bannerConfig.bgType==='gradient' ? `linear-gradient(135deg,${bannerConfig.bgGradient1},${bannerConfig.bgGradient2})` : bannerConfig.bgColor;
  preview.innerHTML = `<div style="background:${bgStyle};width:100%;height:100%;display:flex;flex-direction:column;justify-content:center;align-items:center;padding:40px;text-align:center;position:relative;border-radius:8px;">
    <h1 style="font-size:${bannerConfig.titleSize}px;font-weight:900;color:${bannerConfig.titleColor};margin:0 0 20px 0;line-height:1.2">${title}</h1>
    <p style="font-size:${bannerConfig.subtitleSize}px;color:${bannerConfig.subtitleColor};margin:0 0 30px 0;font-weight:600">${subtitle}</p>
    <button style="background-color:${bannerConfig.buttonBg};color:${bannerConfig.buttonText};padding:15px 40px;border:none;border-radius:8px;font-size:18px;font-weight:bold;cursor:pointer;box-shadow:0 4px 15px rgba(0,0,0,0.2)">${cta}</button>
    <div style="position:absolute;bottom:20px;font-size:12px;color:rgba(255,255,255,0.8)">${footer}</div></div>`;
}

function loadBannerTemplate(template) {
  const templates = {
    promo: {bgGradient1:'#EC4899',bgGradient2:'#F97316',bgType:'gradient',title:'🔥 FLASH SALE INTERNET',subtitle:'Diskon Hingga 50% untuk Pelanggan Baru',cta:'DAFTAR SEKARANG'},
    paket: {bgGradient1:'#6366f1',bgGradient2:'#a855f7',bgType:'gradient',title:'PAKET INTERNET UNLIMITED',subtitle:'Kecepatan Stabil, Harga Kompetitif',cta:'PILIH PAKET'},
    event: {bgGradient1:'#F97316',bgGradient2:'#FBBF24',bgType:'gradient',title:'HARI JADI NETBILL PRO',subtitle:'Promo Spesial Selama 7 Hari',cta:'AMBIL KESEMPATAN'},
    upgrade: {bgGradient1:'#06B6D4',bgGradient2:'#0EA5E9',bgType:'gradient',title:'UPGRADE SEKARANG',subtitle:'Rasakan Kecepatan Internet 100 Mbps',cta:'UPGRADE GRATIS'},
    referral: {bgGradient1:'#10B981',bgGradient2:'#06B6D4',bgType:'gradient',title:'AJAK TEMAN DAPAT BONUS',subtitle:'Setiap Referral = Pulsa Gratis Selamanya',cta:'BAGIKAN SEKARANG'}
  };
  Object.assign(bannerConfig, templates[template]);
  document.getElementById('banner-title').value = bannerConfig.title;
  document.getElementById('banner-subtitle').value = bannerConfig.subtitle;
  document.getElementById('banner-cta').value = bannerConfig.cta;
  updateBannerPreview();
  renderBgOptions();
  toast('Template dimuat!');
}

function saveBannerDesign(e) {
  e.preventDefault();
  const designName = prompt('Masukkan nama desain:');
  if (!designName) return;
  const savedDesigns = JSON.parse(localStorage.getItem('netbill-banners')||'{}');
  savedDesigns[designName] = JSON.parse(JSON.stringify(bannerConfig));
  localStorage.setItem('netbill-banners', JSON.stringify(savedDesigns));
  const container = document.getElementById('saved-designs');
  if (container) {
    container.innerHTML = '';
    Object.keys(savedDesigns).forEach(name => {
      const item = document.createElement('div');
      item.className = 'flex items-center justify-between gap-2 p-2 bg-slate-50 rounded border border-slate-200';
      item.innerHTML = `<span class="text-xs font-medium truncate">${name}</span><div class="flex gap-1"><button type="button" onclick="loadSavedDesign('${name}')" class="text-xs bg-indigo-50 text-indigo-600 hover:bg-indigo-100 px-2 py-1 rounded transition">Load</button><button type="button" onclick="deleteSavedDesign('${name}')" class="text-xs bg-red-50 text-red-600 hover:bg-red-100 px-2 py-1 rounded transition">Hapus</button></div>`;
      container.appendChild(item);
    });
  }
  toast('Desain tersimpan!');
}

function loadSavedDesign(name) {
  const savedDesigns = JSON.parse(localStorage.getItem('netbill-banners')||'{}');
  if (savedDesigns[name]) {
    Object.assign(bannerConfig, savedDesigns[name]);
    document.getElementById('banner-title').value = bannerConfig.title;
    document.getElementById('banner-subtitle').value = bannerConfig.subtitle;
    document.getElementById('banner-cta').value = bannerConfig.cta;
    document.getElementById('banner-footer').value = bannerConfig.footer;
    document.getElementById('banner-title-size').value = bannerConfig.titleSize;
    document.getElementById('banner-subtitle-size').value = bannerConfig.subtitleSize;
    document.getElementById('title-color').value = bannerConfig.titleColor;
    document.getElementById('subtitle-color').value = bannerConfig.subtitleColor;
    document.getElementById('btn-bg-color').value = bannerConfig.buttonBg;
    document.getElementById('btn-text-color').value = bannerConfig.buttonText;
    updateBannerPreview();
    renderBgOptions();
    toast('Desain dimuat!');
  }
}

function deleteSavedDesign(name) {
  if (!confirm('Hapus desain ini?')) return;
  const savedDesigns = JSON.parse(localStorage.getItem('netbill-banners')||'{}');
  delete savedDesigns[name];
  localStorage.setItem('netbill-banners', JSON.stringify(savedDesigns));
  toast('Desain dihapus!');
  saveBannerDesign({preventDefault:()=>{}});
}

function previewBannerPrint() {
  const modal = document.getElementById('banner-print-modal');
  const content = document.getElementById('banner-print-content');
  const bgStyle = bannerConfig.bgType==='gradient' ? `linear-gradient(135deg,${bannerConfig.bgGradient1},${bannerConfig.bgGradient2})` : bannerConfig.bgColor;
  content.innerHTML = `<div style="background:${bgStyle};width:100%;aspect-ratio:${bannerConfig.width}/${bannerConfig.height};position:relative;display:flex;flex-direction:column;justify-content:center;align-items:center;padding:40px;text-align:center;border-radius:8px">
    <h1 style="font-size:${bannerConfig.titleSize}px;font-weight:900;color:${bannerConfig.titleColor};margin:0 0 20px 0">${bannerConfig.title}</h1>
    <p style="font-size:${bannerConfig.subtitleSize}px;color:${bannerConfig.subtitleColor};margin:0 0 30px 0;font-weight:600">${bannerConfig.subtitle}</p>
    <button style="background-color:${bannerConfig.buttonBg};color:${bannerConfig.buttonText};padding:15px 40px;border:none;border-radius:8px;font-size:18px;font-weight:bold">${bannerConfig.cta}</button>
    <div style="position:absolute;bottom:20px;font-size:12px;color:rgba(255,255,255,0.8)">${bannerConfig.footer}</div></div>`;
  modal.classList.remove('hidden');
  lucide.createIcons();
}

function exportBannerAsImage(format) {
  const canvas = document.createElement('canvas');
  canvas.width = bannerConfig.width;
  canvas.height = bannerConfig.height;
  const ctx = canvas.getContext('2d');
  if (bannerConfig.bgType==='gradient') {
    const gradient = ctx.createLinearGradient(0,0,canvas.width,canvas.height);
    gradient.addColorStop(0, bannerConfig.bgGradient1);
    gradient.addColorStop(1, bannerConfig.bgGradient2);
    ctx.fillStyle = gradient;
  } else {
    ctx.fillStyle = bannerConfig.bgColor;
  }
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  ctx.font = `bold ${bannerConfig.titleSize}px Arial`;
  ctx.fillStyle = bannerConfig.titleColor;
  ctx.textAlign = 'center';
  ctx.fillText(bannerConfig.title, canvas.width/2, canvas.height/3);
  ctx.font = `${bannerConfig.subtitleSize}px Arial`;
  ctx.fillStyle = bannerConfig.subtitleColor;
  ctx.fillText(bannerConfig.subtitle, canvas.width/2, canvas.height/2);
  const btnWidth=300, btnHeight=60, btnX=(canvas.width-btnWidth)/2, btnY=canvas.height*0.6;
  ctx.fillStyle = bannerConfig.buttonBg;
  ctx.fillRect(btnX, btnY, btnWidth, btnHeight);
  ctx.font = 'bold 20px Arial';
  ctx.fillStyle = bannerConfig.buttonText;
  ctx.textAlign = 'center';
  ctx.fillText(bannerConfig.cta, canvas.width/2, btnY+btnHeight/2+7);
  ctx.font = '12px Arial';
  ctx.fillStyle = 'rgba(255,255,255,0.8)';
  ctx.fillText(bannerConfig.footer, canvas.width/2, canvas.height-20);
  canvas.toBlob(blob=>{
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.href = url;
    link.download = `banner_${Date.now()}.${format}`;
    link.click();
    toast(`Banner diunduh sebagai ${format.toUpperCase()}!`);
  }, `image/${format==='jpg'?'jpeg':'png'}`);
}

function printBanner() {
  previewBannerPrint();
  setTimeout(() => { window.print(); }, 500);
}

// Theme management
function applyTheme() {
  const root = document.documentElement;
  const themeToggle = document.getElementById('theme-toggle');
  const themeIcon = document.getElementById('theme-icon');
  
  if (isDarkMode) {
    root.classList.add('dark');
    themeToggle?.classList.add('active');
    if (themeIcon) {
      themeIcon.setAttribute('data-lucide', 'moon');
      themeIcon.classList.remove('text-indigo-600');
      themeIcon.classList.add('text-amber-300');
    }
  } else {
    root.classList.remove('dark');
    themeToggle?.classList.remove('active');
    if (themeIcon) {
      themeIcon.setAttribute('data-lucide', 'sun');
      themeIcon.classList.add('text-indigo-600');
      themeIcon.classList.remove('text-amber-300');
    }
  }
  
  lucide.createIcons();
}

function toggleTheme() {
  isDarkMode = !isDarkMode;
  localStorage.setItem('netbill-theme', isDarkMode ? 'dark' : 'light');
  applyTheme();
  toast(isDarkMode ? '🌙 Dark Mode Enabled' : '☀️ Light Mode Enabled');
}

// Delete record
async function deleteRecord(id) {
  const record = allData.find(d => d.__backendId === id);
  if (!record) return;
  const result = await window.dataSdk.delete(record);
  if (result.isOk) toast('Data berhasil dihapus');
  else toast('Gagal menghapus', 'error');
}

// Customer Export Functions
function showCustomerExportOptions() {
  const area = document.getElementById('customer-export-import-area');
  area.innerHTML = `
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl p-6 mb-4 text-white">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-lg">📊 Export Pelanggan</h3>
        <button onclick="document.getElementById('customer-export-import-area').innerHTML=''" class="text-white hover:text-emerald-100"><i data-lucide="x" class="w-5 h-5"></i></button>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <button onclick="exportCustomersAsCSV()" class="bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-4 py-3 rounded-lg font-medium transition flex items-center gap-2">
          <i data-lucide="file-text" class="w-4 h-4"></i> Export CSV
        </button>
        <button onclick="exportCustomersAsJSON()" class="bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-4 py-3 rounded-lg font-medium transition flex items-center gap-2">
          <i data-lucide="code" class="w-4 h-4"></i> Export JSON
        </button>
        <button onclick="exportCustomersWithTemplate()" class="bg-white hover:bg-slate-50 text-emerald-600 px-4 py-3 rounded-lg font-bold transition flex items-center gap-2 justify-center">
          <i data-lucide="download" class="w-4 h-4"></i> Download Template
        </button>
      </div>
    </div>
  `;
  lucide.createIcons();
}

function exportCustomersAsCSV() {
  const customers = getByType('customer');
  if (customers.length === 0) { toast('Tidak ada data pelanggan untuk diexport', 'error'); return; }
  
  const headers = ['Nama', 'Email', 'Telepon', 'Alamat', 'PPPoE User', 'IP Address', 'Paket', 'Status'];
  const rows = customers.map(c => [
    c.name || '',
    c.email || '',
    c.phone || '',
    c.address || '',
    c.pppoe_user || '',
    c.ip_address || '',
    c.package_name || '',
    c.status || ''
  ]);
  
  let csv = headers.join(',') + '\n';
  rows.forEach(row => {
    csv += row.map(cell => `"${String(cell).replace(/"/g, '""')}"`).join(',') + '\n';
  });
  
  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement('a');
  const url = URL.createObjectURL(blob);
  link.setAttribute('href', url);
  link.setAttribute('download', `pelanggan_${new Date().toISOString().split('T')[0]}.csv`);
  link.click();
  toast(`${customers.length} pelanggan berhasil diexport sebagai CSV`);
  document.getElementById('customer-export-import-area').innerHTML = '';
}

function exportCustomersAsJSON() {
  const customers = getByType('customer');
  if (customers.length === 0) { toast('Tidak ada data pelanggan untuk diexport', 'error'); return; }
  
  const exportData = customers.map(c => ({
    nama: c.name,
    email: c.email,
    telepon: c.phone,
    alamat: c.address,
    pppoe_user: c.pppoe_user,
    ip_address: c.ip_address,
    paket: c.package_name,
    status: c.status,
    tanggal_dibuat: c.created_at
  }));
  
  const json = JSON.stringify(exportData, null, 2);
  const blob = new Blob([json], { type: 'application/json' });
  const link = document.createElement('a');
  const url = URL.createObjectURL(blob);
  link.setAttribute('href', url);
  link.setAttribute('download', `pelanggan_${new Date().toISOString().split('T')[0]}.json`);
  link.click();
  toast(`${customers.length} pelanggan berhasil diexport sebagai JSON`);
  document.getElementById('customer-export-import-area').innerHTML = '';
}

function exportCustomersWithTemplate() {
  const templateData = [
    {
      nama: 'Contoh Nama Pelanggan',
      email: 'pelanggan@email.com',
      telepon: '081234567890',
      alamat: 'Jl. Contoh No. 123',
      pppoe_user: 'user001',
      ip_address: '10.10.10.1',
      paket: 'Paket 20 Mbps',
      status: 'active'
    }
  ];
  
  const json = JSON.stringify(templateData, null, 2);
  const blob = new Blob([json], { type: 'application/json' });
  const link = document.createElement('a');
  const url = URL.createObjectURL(blob);
  link.setAttribute('href', url);
  link.setAttribute('download', 'template_pelanggan.json');
  link.click();
  toast('Template pelanggan berhasil diunduh!');
  document.getElementById('customer-export-import-area').innerHTML = '';
}

// Customer Import Functions
function showCustomerImportDialog() {
  const area = document.getElementById('customer-export-import-area');
  area.innerHTML = `
    <div class="bg-gradient-to-r from-sky-500 to-blue-600 rounded-xl p-6 mb-4 text-white">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-lg">📥 Import Pelanggan</h3>
        <button onclick="document.getElementById('customer-export-import-area').innerHTML=''" class="text-white hover:text-sky-100"><i data-lucide="x" class="w-5 h-5"></i></button>
      </div>
      <div class="space-y-3">
        <div class="bg-white bg-opacity-10 backdrop-blur rounded-lg p-4 border-2 border-dashed border-white border-opacity-30">
          <p class="text-sm mb-3 font-medium">Pilih file untuk diimport (CSV atau JSON)</p>
          <input id="customer-import-file" type="file" accept=".csv,.json" class="w-full bg-white bg-opacity-10 text-white px-3 py-2 rounded-lg text-sm file:bg-white file:text-blue-600 file:px-3 file:py-1 file:rounded file:border-0 file:cursor-pointer file:font-medium hover:bg-opacity-20 transition">
        </div>
        <div class="flex gap-2">
          <button onclick="handleCustomerImport()" class="flex-1 bg-white text-blue-600 font-bold px-4 py-3 rounded-lg hover:bg-blue-50 transition flex items-center justify-center gap-2">
            <i data-lucide="upload" class="w-4 h-4"></i> Import
          </button>
          <button onclick="document.getElementById('customer-export-import-area').innerHTML=''" class="flex-1 bg-white bg-opacity-20 text-white font-bold px-4 py-3 rounded-lg hover:bg-opacity-30 transition">
            Batal
          </button>
        </div>
        <p class="text-xs text-blue-100 mt-2">💡 Format: CSV (dengan header) atau JSON array dari export sebelumnya</p>
      </div>
    </div>
  `;
}

async function handleCustomerImport() {
  const file = document.getElementById('customer-import-file').files[0];
  if (!file) { toast('Pilih file terlebih dahulu', 'error'); return; }
  
  const reader = new FileReader();
  reader.onload = async (e) => {
    try {
      const content = e.target.result;
      let importData = [];
      
      if (file.name.endsWith('.json')) {
        const parsed = JSON.parse(content);
        importData = Array.isArray(parsed) ? parsed : [];
      } else if (file.name.endsWith('.csv')) {
        const lines = content.split('\n');
        const headers = lines[0].split(',').map(h => h.replace(/"/g, '').trim().toLowerCase());
        for (let i = 1; i < lines.length; i++) {
          if (!lines[i].trim()) continue;
          const values = lines[i].split(',').map(v => v.replace(/"/g, '').trim());
          const obj = {};
          headers.forEach((h, idx) => {
            obj[h] = values[idx];
          });
          importData.push(obj);
        }
      }
      
      if (importData.length === 0) { toast('File kosong atau format tidak valid', 'error'); return; }
      
      let imported = 0;
      const btn = document.querySelector('button[onclick="handleCustomerImport()"]');
      btn.disabled = true;
      btn.innerHTML = '<i data-lucide="loader" class="w-4 h-4 animate-spin"></i> Importing...';
      
      for (const item of importData) {
        if (allData.length >= 999) break;
        
        const record = {
          type: 'customer',
          name: item.nama || item.name || '',
          email: item.email || '',
          phone: item.telepon || item.phone || '',
          address: item.alamat || item.address || '',
          pppoe_user: item.pppoe_user || '',
          ip_address: item.ip_address || '',
          package_name: item.paket || item.package_name || '',
          status: item.status || 'active',
          speed: '', price: 0, due_date: '',
          created_at: new Date().toISOString(),
          voucher_code: '', discount_value: 0, discount_type: '', expiry_date: '', used_by: '', is_used: ''
        };
        
        const result = await window.dataSdk.create(record);
        if (result.isOk) imported++;
      }
      
      toast(`${imported} pelanggan berhasil diimport!`);
      document.getElementById('customer-export-import-area').innerHTML = '';
      btn.disabled = false;
    } catch (err) {
      toast('Error parsing file: ' + err.message, 'error');
    }
  };
  reader.readAsText(file);
}

// Initial render
renderDashboard();
lucide.createIcons();
applyTheme();
</script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9f70878bb614ff89',t:'MTc3Nzk5MjMzMi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
