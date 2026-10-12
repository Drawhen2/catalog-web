<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog | SewaVerse</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 500: '#534EE5', 600: '#4338CA' },
                        accent: { yellow: '#FDE047', pink: '#F9A8D4', green: '#86EFAC', cyan: '#67E8F9' },
                        app: { dark: '#0F172A', bg: '#FAFAF9' }
                    },
                    fontFamily: { sans: ['Nunito', 'sans-serif'] }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #FAFAF9; color: #0F172A; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .neo-shadow { box-shadow: 4px 4px 0px #0F172A; }
        .neo-shadow-sm { box-shadow: 2px 2px 0px #0F172A; }
    </style>
</head>
<body class="antialiased relative pb-24">

    <!-- Header -->
    <header class="sticky top-0 z-40 w-full bg-white border-b-2 border-app-dark neo-shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Branding & Alamat -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-brand-500 border-2 border-app-dark rounded-xl flex items-center justify-center text-white neo-shadow-sm shrink-0">
                        <i class="fa-solid fa-tent text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-black text-app-dark leading-tight tracking-tight">SewaVerse</h1>
                        <p class="text-[10px] sm:text-xs font-bold text-slate-500"><i class="fa-solid fa-location-dot text-accent-pink mr-1"></i>Jl. Pendaki No. 99, Jakarta</p>
                    </div>
                </div>

                <!-- Tombol Keranjang -->
                <button onclick="toggleCart()" class="relative bg-accent-yellow border-2 border-app-dark p-2.5 rounded-xl neo-shadow-sm hover:translate-y-0.5 hover:shadow-[2px_2px_0px_#0F172A] transition-all">
                    <i class="fa-solid fa-cart-shopping text-app-dark"></i>
                    <span id="cart-badge" class="absolute -top-2 -right-2 bg-brand-500 text-white text-[10px] font-bold w-5 h-5 rounded-full border-2 border-app-dark flex items-center justify-center hidden">0</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <!-- Filter Kategori -->
        <div class="mb-6">
            <div class="flex gap-2 overflow-x-auto hide-scrollbar py-2" id="filter-container">
                <button onclick="filterProducts('Semua')" class="filter-btn active px-4 py-2 bg-app-dark text-white border-2 border-app-dark rounded-full text-sm font-bold whitespace-nowrap">Semua</button>
                <button onclick="filterProducts('Sewa')" class="filter-btn px-4 py-2 bg-white text-app-dark border-2 border-app-dark rounded-full text-sm font-bold whitespace-nowrap hover:bg-slate-100">Item Sewa</button>
                <button onclick="filterProducts('Jual')" class="filter-btn px-4 py-2 bg-white text-app-dark border-2 border-app-dark rounded-full text-sm font-bold whitespace-nowrap hover:bg-slate-100">Item Jual</button>
                <button onclick="filterProducts('Tenda')" class="filter-btn px-4 py-2 bg-white text-app-dark border-2 border-app-dark rounded-full text-sm font-bold whitespace-nowrap hover:bg-slate-100">Tenda</button>
                <button onclick="filterProducts('Sepatu')" class="filter-btn px-4 py-2 bg-white text-app-dark border-2 border-app-dark rounded-full text-sm font-bold whitespace-nowrap hover:bg-slate-100">Sepatu</button>
                <button onclick="filterProducts('Carrier')" class="filter-btn px-4 py-2 bg-white text-app-dark border-2 border-app-dark rounded-full text-sm font-bold whitespace-nowrap hover:bg-slate-100">Carrier</button>
                <button onclick="filterProducts('Aksesoris')" class="filter-btn px-4 py-2 bg-white text-app-dark border-2 border-app-dark rounded-full text-sm font-bold whitespace-nowrap hover:bg-slate-100">Aksesoris</button>
            </div>
        </div>

        <!-- Product Grid (2 Kolom di Mobile, 3-4 di Desktop) -->
        <div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Produk di-generate via JavaScript -->
        </div>

    </main>

    <!-- Floating WhatsApp -->
    <a href="#" class="fixed bottom-6 right-6 z-30 w-14 h-14 bg-[#25D366] text-white border-2 border-app-dark rounded-full flex items-center justify-center text-3xl neo-shadow hover:-translate-y-1 transition-transform">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- MODAL DETAIL ITEM -->
    <div id="detail-modal" class="fixed inset-0 bg-app-dark/60 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm transition-opacity opacity-0">
        <div class="bg-white border-2 border-app-dark rounded-2xl w-full max-w-md overflow-hidden neo-shadow transform scale-95 transition-transform duration-200" id="detail-modal-content">
            <div class="relative w-full h-48 sm:h-56 bg-slate-200 border-b-2 border-app-dark">
                <img id="detail-img" src="" alt="Produk" class="w-full h-full object-cover">
                <button onclick="closeDetailModal()" class="absolute top-3 right-3 w-8 h-8 bg-white border-2 border-app-dark rounded-full flex items-center justify-center text-app-dark hover:bg-accent-pink">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <span id="detail-type" class="absolute top-3 left-3 bg-accent-cyan text-app-dark border-2 border-app-dark text-xs font-bold px-3 py-1 rounded-full uppercase"></span>
            </div>
            <div class="p-5">
                <p id="detail-category" class="text-[10px] text-slate-500 font-bold uppercase mb-1"></p>
                <h3 id="detail-title" class="text-xl font-black text-app-dark mb-2"></h3>
                <p id="detail-price" class="text-lg font-bold text-brand-500 mb-4"></p>
                
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 mb-5">
                    <p class="text-xs font-bold text-app-dark mb-1">Deskripsi:</p>
                    <p id="detail-desc" class="text-sm text-slate-600 font-medium leading-relaxed"></p>
                </div>

                <button id="detail-add-btn" class="w-full py-3 bg-brand-500 text-white border-2 border-app-dark rounded-xl font-bold neo-shadow-sm hover:bg-brand-600 active:translate-y-1 active:shadow-none transition-all">
                    <i class="fa-solid fa-cart-plus mr-2"></i> Tambah ke Keranjang
                </button>
            </div>
        </div>
    </div>

    <!-- DRAWER KERANJANG (CART) -->
    <div id="cart-drawer-bg" class="fixed inset-0 bg-app-dark/60 z-50 hidden opacity-0 transition-opacity" onclick="toggleCart()"></div>
    <div id="cart-drawer" class="fixed top-0 right-0 h-full w-full sm:w-96 bg-white border-l-2 border-app-dark z-50 transform translate-x-full transition-transform duration-300 flex flex-col neo-shadow">
        
        <!-- Cart Header -->
        <div class="p-4 border-b-2 border-app-dark flex justify-between items-center bg-accent-yellow">
            <h2 class="text-lg font-black text-app-dark"><i class="fa-solid fa-cart-shopping mr-2"></i>Keranjang Anda</h2>
            <button onclick="toggleCart()" class="w-8 h-8 bg-white border-2 border-app-dark rounded-full flex items-center justify-center hover:bg-accent-pink">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Cart Items List -->
        <div id="cart-items" class="flex-1 overflow-y-auto p-4 space-y-4 bg-app-bg">
            <!-- Item Cart di-generate via JS -->
            <div id="empty-cart-msg" class="h-full flex flex-col items-center justify-center text-slate-400">
                <i class="fa-solid fa-box-open text-4xl mb-2"></i>
                <p class="font-bold text-sm">Keranjang masih kosong</p>
            </div>
        </div>

        <!-- Cart Footer / Checkout -->
        <div class="p-4 border-t-2 border-app-dark bg-white">
            <!-- Info Metode Pembayaran -->
            <div class="mb-4">
                <p class="text-xs font-bold text-slate-500 mb-2 uppercase">Metode Pembayaran Tersedia:</p>
                <div class="flex gap-2">
                    <span class="px-2 py-1 bg-slate-100 border border-slate-300 rounded text-[10px] font-bold"><i class="fa-solid fa-money-bill-wave text-green-600 mr-1"></i>Cash</span>
                    <span class="px-2 py-1 bg-slate-100 border border-slate-300 rounded text-[10px] font-bold"><i class="fa-solid fa-building-columns text-blue-600 mr-1"></i>Transfer</span>
                    <span class="px-2 py-1 bg-slate-100 border border-slate-300 rounded text-[10px] font-bold"><i class="fa-solid fa-wallet text-purple-600 mr-1"></i>e-Wallet</span>
                </div>
            </div>

            <div class="flex justify-between items-end mb-4">
                <span class="text-sm font-bold text-slate-600">Total Pembayaran:</span>
                <span id="cart-total" class="text-xl font-black text-app-dark">Rp 0</span>
            </div>
            <button class="w-full py-3.5 bg-accent-green text-app-dark border-2 border-app-dark rounded-xl font-black neo-shadow-sm hover:bg-[#6ee7b7] active:translate-y-1 active:shadow-none transition-all flex justify-center items-center gap-2">
                Checkout via WA <i class="fa-brands fa-whatsapp text-lg"></i>
            </button>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // Data 9 Item Contoh
        const products = [
            { id: 1, name: "Tenda Dome 4P", price: 45000, type: "Sewa", category: "Tenda", img: "https://images.unsplash.com/photo-1504280387967-18a08ce2bc85?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80", desc: "Tenda kapasitas 4 orang, double layer, anti badai dan embun. Cocok untuk gunung tropis." },
            { id: 2, name: "Sepatu Trekking SNI", price: 30000, type: "Sewa", category: "Sepatu", img: "https://images.unsplash.com/photo-1520639888713-7851133b1ed0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80", desc: "Sepatu gunung anti slip dengan pelindung jari. Tersedia ukuran 39-44." },
            { id: 3, name: "Carrier 60L Consina", price: 35000, type: "Sewa", category: "Carrier", img: "https://images.unsplash.com/photo-1622260614153-03223fb72052?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80", desc: "Tas gunung kapasitas 60 liter dengan backsystem nyaman untuk pendakian jauh." },
            { id: 4, name: "Gas Kaleng Hi-Cook", price: 20000, type: "Jual", category: "Aksesoris", img: "https://images.unsplash.com/photo-1574684947930-b389812df934?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80", desc: "Gas kaleng original untuk kompor portable. Isi penuh." },
            { id: 5, name: "Kompor Portable Mawar", price: 15000, type: "Sewa", category: "Aksesoris", img: "https://images.unsplash.com/photo-1588628565576-928ccab368a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80", desc: "Kompor lipat anti badai, api biru dan panas merata." },
            { id: 6, name: "Sleeping Bag Polar", price: 15000, type: "Sewa", category: "Aksesoris", img: "https://images.unsplash.com/photo-1627918540842-8c9e5525dc10?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80", desc: "Sleeping bag bahan polar tebal, limit suhu hingga 5 derajat celcius." },
            { id: 7, name: "Trekking Pole", price: 10000, type: "Sewa", category: "Aksesoris", img: "https://images.unsplash.com/photo-1521557008740-42526c88880e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80", desc: "Tongkat daki bahan duralumin kuat dan ringan. Shock absorber aktif." },
            { id: 8, name: "Matras Foil", price: 35000, type: "Jual", category: "Aksesoris", img: "https://images.unsplash.com/photo-1525087740718-9e0f2c58c7ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80", desc: "Matras aluminium foil penahan dingin dari tanah, panjang 2 meter." },
            { id: 9, name: "Tenda Tunnel 6P", price: 80000, type: "Sewa", category: "Tenda", img: "https://images.unsplash.com/photo-1534880606858-29b0e8a24e8d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80", desc: "Tenda keluarga bentuk terowongan (tunnel), sangat luas dengan ruang tamu depan." }
        ];

        let cart = [];
        let currentFilter = 'Semua';

        // Format Rupiah
        const formatRp = (angka) => {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(angka);
        }

        // Render Produk ke Grid
        function renderProducts() {
            const grid = document.getElementById('product-grid');
            grid.innerHTML = '';
            
            const filtered = currentFilter === 'Semua' ? products : products.filter(p => p.type === currentFilter || p.category === currentFilter);

            filtered.forEach(product => {
                const typeColor = product.type === 'Sewa' ? 'bg-accent-yellow' : 'bg-accent-green';
                
                const card = `
                    <div class="bg-white border-2 border-app-dark rounded-xl sm:rounded-2xl flex flex-col overflow-hidden neo-shadow-sm hover:neo-shadow transition-shadow">
                        <!-- Image Area -->
                        <div class="relative h-32 sm:h-48 cursor-pointer border-b-2 border-app-dark" onclick="openDetail(${product.id})">
                            <img src="${product.img}" alt="${product.name}" class="w-full h-full object-cover">
                            <span class="absolute top-2 left-2 ${typeColor} text-app-dark text-[9px] sm:text-[10px] font-black px-2 py-1 rounded-full uppercase border-2 border-app-dark">
                                ${product.type}
                            </span>
                        </div>
                        
                        <!-- Content Area -->
                        <div class="p-3 sm:p-4 flex flex-col flex-1 justify-between">
                            <div>
                                <p class="text-[9px] sm:text-[10px] text-slate-500 font-bold uppercase mb-0.5">${product.category}</p>
                                <h3 class="text-sm sm:text-base font-black text-app-dark leading-tight mb-2 cursor-pointer hover:text-brand-500" onclick="openDetail(${product.id})">
                                    ${product.name}
                                </h3>
                            </div>
                            
                            <div>
                                <p class="text-brand-500 font-black text-sm sm:text-lg mb-3">${formatRp(product.price)} <span class="text-[10px] font-bold text-slate-500">${product.type === 'Sewa' ? '/hari' : ''}</span></p>
                                <button onclick="addToCart(${product.id})" class="w-full py-2 bg-white text-app-dark border-2 border-app-dark rounded-lg text-xs sm:text-sm font-bold shadow-[2px_2px_0px_#0F172A] hover:bg-slate-50 active:translate-y-0.5 active:shadow-[0px_0px_0px_#0F172A] transition-all">
                                    + Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                grid.innerHTML += card;
            });
        }

        // Filter Logic
        function filterProducts(category) {
            currentFilter = category;
            // Update Active Buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-app-dark', 'text-white');
                btn.classList.add('bg-white', 'text-app-dark');
                if(btn.innerText.includes(category) || (category === 'Semua' && btn.innerText === 'Semua')) {
                    btn.classList.add('bg-app-dark', 'text-white');
                    btn.classList.remove('bg-white', 'text-app-dark');
                }
            });
            renderProducts();
        }

        // Modal Detail Logic
        function openDetail(id) {
            const product = products.find(p => p.id === id);
            if(!product) return;

            document.getElementById('detail-img').src = product.img;
            document.getElementById('detail-type').innerText = product.type;
            document.getElementById('detail-type').className = `absolute top-3 left-3 text-app-dark border-2 border-app-dark text-xs font-bold px-3 py-1 rounded-full uppercase ${product.type === 'Sewa' ? 'bg-accent-yellow' : 'bg-accent-green'}`;
            document.getElementById('detail-category').innerText = product.category;
            document.getElementById('detail-title').innerText = product.name;
            document.getElementById('detail-price').innerHTML = `${formatRp(product.price)} <span class="text-xs text-slate-500">${product.type === 'Sewa' ? '/hari' : ''}</span>`;
            document.getElementById('detail-desc').innerText = product.desc;
            
            const btn = document.getElementById('detail-add-btn');
            btn.onclick = () => { addToCart(id); closeDetailModal(); };

            const modal = document.getElementById('detail-modal');
            const content = document.getElementById('detail-modal-content');
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeDetailModal() {
            const modal = document.getElementById('detail-modal');
            const content = document.getElementById('detail-modal-content');
            
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 200);
        }

        // Keranjang (Cart) Logic
        function toggleCart() {
            const drawer = document.getElementById('cart-drawer');
            const bg = document.getElementById('cart-drawer-bg');
            
            if (drawer.classList.contains('translate-x-full')) {
                // Open
                bg.classList.remove('hidden');
                setTimeout(() => bg.classList.remove('opacity-0'), 10);
                drawer.classList.remove('translate-x-full');
            } else {
                // Close
                bg.classList.add('opacity-0');
                drawer.classList.add('translate-x-full');
                setTimeout(() => bg.classList.add('hidden'), 300);
            }
        }

        function addToCart(id) {
            const product = products.find(p => p.id === id);
            const existing = cart.find(c => c.id === id);
            
            if (existing) {
                existing.qty += 1;
            } else {
                cart.push({ ...product, qty: 1 });
            }
            
            updateCartUI();
            
            // Animasi badge keranjang (opsional)
            const badge = document.getElementById('cart-badge');
            badge.classList.add('animate-ping');
            setTimeout(() => badge.classList.remove('animate-ping'), 300);
        }

        function updateQty(id, change) {
            const item = cart.find(c => c.id === id);
            if (item) {
                item.qty += change;
                if (item.qty <= 0) {
                    cart = cart.filter(c => c.id !== id);
                }
                updateCartUI();
            }
        }

        function removeItem(id) {
            cart = cart.filter(c => c.id !== id);
            updateCartUI();
        }

        function updateCartUI() {
            const container = document.getElementById('cart-items');
            const emptyMsg = document.getElementById('empty-cart-msg');
            const totalEl = document.getElementById('cart-total');
            const badge = document.getElementById('cart-badge');
            
            container.innerHTML = '';
            let total = 0;
            let count = 0;

            if (cart.length === 0) {
                container.appendChild(emptyMsg);
                emptyMsg.classList.remove('hidden');
                badge.classList.add('hidden');
            } else {
                emptyMsg.classList.add('hidden');
                badge.classList.remove('hidden');
                
                cart.forEach(item => {
                    const subtotal = item.price * item.qty;
                    total += subtotal;
                    count += item.qty;

                    const cartItem = `
                        <div class="bg-white border-2 border-app-dark rounded-xl p-3 flex gap-3 neo-shadow-sm">
                            <img src="${item.img}" class="w-16 h-16 object-cover border-2 border-app-dark rounded-lg">
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-sm font-black text-app-dark leading-tight">${item.name}</h4>
                                    <button onclick="removeItem(${item.id})" class="text-slate-400 hover:text-red-500 transition-colors"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                                <p class="text-brand-500 font-bold text-xs mb-2">${formatRp(item.price)}</p>
                                
                                <!-- Edit Qty -->
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center border-2 border-app-dark rounded-lg overflow-hidden">
                                        <button onclick="updateQty(${item.id}, -1)" class="w-7 h-7 bg-slate-100 font-black hover:bg-slate-200">-</button>
                                        <span class="w-8 h-7 flex items-center justify-center font-bold text-xs border-x-2 border-app-dark">${item.qty}</span>
                                        <button onclick="updateQty(${item.id}, 1)" class="w-7 h-7 bg-slate-100 font-black hover:bg-slate-200">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.innerHTML += cartItem;
                });
            }

            totalEl.innerText = formatRp(total);
            badge.innerText = count;
        }

        // Tutup modal jika klik di luar box
        document.getElementById('detail-modal').addEventListener('click', function(e) {
            if(e.target === this) closeDetailModal();
        });

        // Inisialisasi awal
        renderProducts();
        updateCartUI();
    </script>
</body>
</html>
