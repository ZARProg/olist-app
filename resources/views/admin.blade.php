<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olist | Seller Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <style>
        :root { 
            --accent: #0071e3;
            --bg-main: #f5f5f7;
            --card-radius: 24px;
            --text-dark: #1d1d1f;
            --text-muted: #86868b;
        }
        
        body { 
            background-color: var(--bg-main); 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--text-dark);
            letter-spacing: -0.01em;
        }

        /* Sidebar Modernization */
        .sidebar { 
            background: rgba(255, 255, 255, 0.8); 
            backdrop-filter: blur(20px);
            min-height: 100vh; 
            border-right: 1px solid rgba(0,0,0,0.05); 
            position: sticky; 
            top: 0; 
            padding: 2rem 1.5rem; 
        }
        .nav-link { 
            color: var(--text-muted); 
            font-weight: 600; 
            padding: 14px 18px; 
            border-radius: 16px; 
            margin-bottom: 6px; 
            border: none; 
            background: none; 
            width: 100%; 
            text-align: left; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            display: flex; 
            align-items: center; 
            font-size: 0.95rem;
        }
        .nav-link i { font-size: 1.1rem; width: 28px; }
        .nav-link:hover { background: rgba(0,0,0,0.03); color: var(--text-dark); }
        .nav-link.active { 
            background: var(--text-dark); 
            color: white; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Revenue Banner Upgrade */
        .revenue-banner { 
            background: #1d1d1f;
            border-radius: 32px; 
            padding: 48px; 
            color: white; 
            position: relative; 
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .revenue-banner::after {
            content: ""; position: absolute; top: -50%; right: -10%; width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(0,113,227,0.15) 0%, transparent 70%);
            z-index: 1;
        }

        /* Card & Table Styling */
        .stat-card { 
            border: none; 
            border-radius: var(--card-radius); 
            background: #ffffff; 
            padding: 28px; 
            transition: 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }
        .card-table { 
            border: none; 
            border-radius: var(--card-radius); 
            background: white; 
            overflow: hidden; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }
        .table thead th { 
            background: #ffffff; 
            text-transform: uppercase; 
            font-size: 0.7rem; 
            font-weight: 800; 
            letter-spacing: 0.08em; 
            color: var(--text-muted); 
            padding: 24px 20px; 
            border-bottom: 1px solid #f5f5f7; 
        }
        .table td { padding: 20px; border-bottom: 1px solid #f5f5f7; vertical-align: middle; }
        
        .status-select { 
            font-size: 0.75rem; 
            font-weight: 700; 
            padding: 8px 16px !important; 
            border-radius: 50px !important; 
            cursor: pointer;
            border: none !important;
            appearance: none;
            text-align: center;
        }
        .status-pending { background: #fff4e5 !important; color: #ff8800 !important; }
        .status-selesai { background: #eafff0 !important; color: #15bd66 !important; }
        .status-batal { background: #fff0f0 !important; color: #ff3b30 !important; }

        .product-img-mini { 
            width: 52px; height: 52px; 
            border-radius: 14px; 
            object-fit: cover; 
            background: var(--bg-main); 
            border: 1px solid rgba(0,0,0,0.05);
        }

        .btn-white { background: white; border: 1px solid #d2d2d7; color: var(--text-dark); transition: all 0.2s; }
        .btn-white:hover { background: #f5f5f7; border-color: #86868b; }
        
        .modal-content { border-radius: 32px; border: none; padding: 20px; }
        .form-control { 
            background: #f5f5f7; 
            border: 1px solid transparent; 
            border-radius: 14px; 
            padding: 14px 18px; 
            font-weight: 500;
        }
        .form-control:focus { background: white; border-color: var(--accent); box-shadow: 0 0 0 4px rgba(0,113,227,0.1); }

        .avatar-circle { 
            width: 36px; height: 36px; 
            background: #f5f5f7; 
            color: var(--text-dark); 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 0.8rem; 
            font-weight: 800; 
        }
    </style>
</head>
<body>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show custom-alert shadow-lg d-flex align-items-center p-4 m-3 position-fixed top-0 end-0" style="z-index:9999; border-radius:20px; border:none;" role="alert">
    <div class="bg-success text-white rounded-circle p-2 me-3"><i class="fa-solid fa-check"></i></div>
    <div><h6 class="mb-0 fw-bold">Success</h6><small>{{ session('success') }}</small></div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar d-none d-md-block">
            <div class="mb-5 mt-2 px-2">
                <h3 class="fw-800 text-dark mb-0" style="letter-spacing:-1.5px">olist<span class="text-primary">.</span></h3>
                <span class="fw-bold opacity-30 small">Seller Hub</span>
            </div>
            <nav class="nav flex-column">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-dashboard">
                    <i class="fa-solid fa-house-chimney me-2"></i> Dashboard
                </button>
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-products">
                    <i class="fa-solid fa-boxes-stacked me-2"></i> Inventory
                </button>
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-team">
                    <i class="fa-solid fa-user-shield me-2"></i> Team Management
                </button>
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-revenue">
                    <i class="fa-solid fa-chart-simple me-2"></i> Sales Report
                </button>
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-logs">
                    <i class="fa-solid fa-clock-rotate-left me-2"></i> Activity Logs
                </button>
                <div class="mt-5 pt-4 border-top opacity-50">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="fa-solid fa-arrow-left me-2"></i> Back to Store
                    </a>
                </div>
            </nav>
        </div>

        <div class="col-md-10 py-5 px-md-5">
            <div class="tab-content">
                
                <div class="tab-pane fade show active" id="tab-dashboard">
                    <div class="revenue-banner mb-5 shadow-sm">
                        <div class="row align-items-center">
                            <div class="col-md-8" style="position: relative; z-index: 2;">
                                <span class="text-uppercase fw-800 small opacity-50 mb-2 d-block" style="letter-spacing: 0.1em;">Total Gross Revenue</span>
                                <h1 class="display-4 fw-800 mt-1" style="letter-spacing: -2px;">Rp {{ number_format($totalGrossRevenue, 0, ',', '.') }}</h1>
                                <p class="mb-0 opacity-40 small mt-2"><i class="fa-solid fa-shield-halved me-1"></i> Data verified for completed transactions</p>
                            </div>
                            <div class="col-md-4 text-md-end mt-4 mt-md-0">
                                <button type="button" 
                                        class="btn btn-white rounded-pill px-4 py-2 fw-bold shadow-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalTambahAdmin"
                                        style="position: relative; z-index: 10;">
                                    <i class="fa-solid fa-user-plus me-2"></i>Invite Admin
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="text-muted small fw-800 mb-1" style="letter-spacing: 0.05em;">CATALOG SIZE</div>
                                <h2 class="fw-800 mb-0">{{ $totalProducts }} <span class="fs-6 opacity-30">Items</span></h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="text-muted small fw-800 mb-1" style="letter-spacing: 0.05em;">TEAM MEMBERS</div>
                                <h2 class="fw-800 mb-0">{{ count($admins) }} <span class="fs-6 opacity-30">Admins</span></h2>
                            </div>
                        </div>
                    </div>

                    <div class="card-table">
                        <div class="p-4 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="fw-800 mb-0">Incoming Orders</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th class="text-center">Status Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $t)
                                    <tr>
                                        <td class="ps-4"><span class="fw-800 text-dark">#{{ substr($t->order_id, -6) }}</span></td>
                                        <td><div class="fw-700">{{ $t->buyer_name }}</div></td>
                                        <td class="text-muted small">{{ \Carbon\Carbon::parse($t->created_at)->format('M d, Y') }}</td>
                                        <td class="text-center">
                                            <form action="{{ url('/admin/order/update-status/'.$t->id) }}" method="POST" class="d-inline-block">
                                                @csrf @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" 
                                                    class="form-select status-select {{ $t->status == 'pending' ? 'status-pending' : ($t->status == 'selesai' ? 'status-selesai' : 'status-batal') }}">
                                                    <option value="pending" {{ $t->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="selesai" {{ $t->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                    <option value="batal" {{ $t->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-products">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-800" style="letter-spacing: -1px;">Inventory Control</h3>
                        <button class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm" onclick="openCreateModal()">
                            <i class="fa-solid fa-plus me-2"></i>New Product
                        </button>
                    </div>
                    <div class="card-table">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Item Details</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $p)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $p->image_url }}" class="product-img-mini me-3">
                                            <span class="fw-800">{{ $p->product_id }}</span>
                                        </div>
                                    </td>
                                    <td class="text-capitalize text-muted small fw-600">{{ str_replace('_', ' ', $p->product_category_name) }}</td>
                                    <td class="fw-800">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $p->product_stock_qty < 5 ? 'bg-danger' : 'bg-light text-dark' }} rounded-pill px-3 py-2">
                                            {{ $p->product_stock_qty }} Units
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                            <button class="btn btn-white btn-sm px-3 border-0" onclick="editProduct('{{ $p->product_id }}', '{{ $p->product_category_name }}', '{{ $p->price }}', '{{ $p->product_stock_qty }}', '{{ $p->image_url }}')">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ url('/admin/product/delete/'.$p->product_id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-white btn-sm px-3 border-0 text-danger" onclick="return confirm('Confirm deletion?')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-team">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-800" style="letter-spacing: -1px;">Team Members</h3>
                        <button class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">
                            <i class="fa-solid fa-user-plus me-2"></i>Add Staff
                        </button>
                    </div>
                    <div class="card-table">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Admin Name</th>
                                    <th>Email</th>
                                    <th>Joined At</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-3">{{ strtoupper(substr($admin->name, 0, 1)) }}</div>
                                            <span class="fw-800">{{ $admin->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-muted fw-600">{{ $admin->email }}</td>
                                    <td class="text-muted small">{{ \Carbon\Carbon::parse($admin->created_at)->format('M d, Y') }}</td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                            <button class="btn btn-white btn-sm px-3" onclick="openEditAdmin('{{ $admin->id }}', '{{ $admin->name }}', '{{ $admin->email }}')">
                                                <i class="fa-solid fa-user-gear"></i>
                                            </button>
                                            <form action="{{ url('/admin/user/delete/'.$admin->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-white btn-sm px-3 text-danger" onclick="return confirm('Hapus akses admin ini?')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-revenue">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-800" style="letter-spacing: -1px;">Sales Analysis</h3>
                        <button class="btn btn-white rounded-pill px-4 fw-bold shadow-sm" onclick="exportCSV()">
                            <i class="fa-solid fa-file-export me-2"></i>Export CSV
                        </button>
                    </div>
                    <div class="card-table">
                        <table class="table align-middle mb-0" id="revenueTable">
                            <thead>
                                <tr>
                                    <th class="ps-4">SKU / Product ID</th>
                                    <th>Collection</th>
                                    <th>Units Sold</th>
                                    <th class="text-end pe-4">Total Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($revenueReport as $rd)
                                <tr>
                                    <td class="ps-4 fw-800">#{{ $rd->product_id }}</td>
                                    <td class="text-capitalize fw-600 text-muted">{{ str_replace('_', ' ', $rd->kategori) }}</td>
                                    <td class="fw-700">{{ $rd->total_terjual }} Items</td>
                                    <td class="fw-800 text-end pe-4 text-primary">Rp {{ number_format($rd->total_pendapatan, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-logs">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-800" style="letter-spacing: -1px;">Security Audit</h3>
                        <span class="badge bg-white text-dark border px-3 py-2 rounded-pill fw-bold">Live System Logs</span>
                    </div>
                    <div class="card-table">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Admin Profile</th>
                                        <th>Action Type</th>
                                        <th>Detail Description</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-3">
                                                    {{ strtoupper(substr($log->admin_name, 0, 1)) }}
                                                </div>
                                                <span class="fw-800">{{ $log->admin_name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $badgeClass = 'bg-dark';
                                                if(str_contains($log->action, 'Hapus')) $badgeClass = 'bg-danger';
                                                if(str_contains($log->action, 'Tambah')) $badgeClass = 'bg-success';
                                                if(str_contains($log->action, 'Update')) $badgeClass = 'bg-primary';
                                            @endphp
                                            <span class="badge {{ $badgeClass }} px-2 py-1" style="font-size: 10px; border-radius: 6px;">
                                                {{ strtoupper($log->action) }}
                                            </span>
                                        </td>
                                        <td class="text-muted small fw-500">{{ $log->details }}</td>
                                        <td class="text-muted small">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalProduk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between mb-4">
                    <h4 class="fw-800 mb-0" id="modalTitle" style="letter-spacing:-1px">Product Config</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="productForm" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <div class="mb-3">
                        <label class="small fw-800 text-muted mb-2">CATEGORY NAME</label>
                        <input type="text" name="product_category_name" id="in_cat" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="small fw-800 text-muted mb-2">PRICE (RP)</label>
                            <input type="number" name="price" id="in_price" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="small fw-800 text-muted mb-2">STOCK QTY</label>
                            <input type="number" name="product_stock_qty" id="in_stock" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-800 text-muted mb-2">IMAGE SOURCE URL</label>
                        <input type="url" name="image_url" id="in_img" class="form-control" placeholder="https://...">
                    </div>
                    <button type="submit" class="btn btn-dark w-100 rounded-pill fw-bold py-3">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between mb-4">
                    <h4 class="fw-800 mb-0" style="letter-spacing:-1px">New Team Member</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('/admin/add-user') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small fw-800 text-muted mb-2">FULL NAME</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-800 text-muted mb-2">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-800 text-muted mb-2">ACCESS PASSWORD</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-3">Register Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between mb-4">
                    <h4 class="fw-800 mb-0" style="letter-spacing:-1px">Edit Admin Info</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEditAdmin" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="small fw-800 text-muted mb-2">FULL NAME</label>
                        <input type="text" name="name" id="edit_admin_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-800 text-muted mb-2">EMAIL ADDRESS</label>
                        <input type="email" name="email" id="edit_admin_email" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-800 text-muted mb-2">NEW PASSWORD (KOSONGKAN JIKA TIDAK DIGANTI)</label>
                        <input type="password" name="password" class="form-control" minlength="6">
                    </div>
                    <button type="submit" class="btn btn-dark w-100 rounded-pill fw-bold py-3">Update Member</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Alert auto-hide
    window.setTimeout(function() {
        $(".custom-alert").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); });
    }, 4000);

    const productModal = new bootstrap.Modal(document.getElementById('modalProduk'));
    const editAdminModal = new bootstrap.Modal(document.getElementById('modalEditAdmin'));

    function openCreateModal() {
        document.getElementById('modalTitle').innerText = 'Create New Product';
        document.getElementById('productForm').action = "{{ url('/admin/product/store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('productForm').reset();
        productModal.show();
    }

    function editProduct(id, cat, price, stock, img) {
        document.getElementById('modalTitle').innerText = 'Edit Item ' + id;
        document.getElementById('productForm').action = "{{ url('/admin/product/update') }}/" + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('in_cat').value = cat;
        document.getElementById('in_price').value = price;
        document.getElementById('in_stock').value = stock;
        document.getElementById('in_img').value = img;
        productModal.show();
    }

    function openEditAdmin(id, name, email) {
        document.getElementById('formEditAdmin').action = "{{ url('/admin/user/update') }}/" + id;
        document.getElementById('edit_admin_name').value = name;
        document.getElementById('edit_admin_email').value = email;
        editAdminModal.show();
    }

    function exportCSV() {
        let csv = [];
        let rows = document.querySelectorAll("#revenueTable tr");
        for (let i = 0; i < rows.length; i++) {
            let row = [], cols = rows[i].querySelectorAll("td, th");
            for (let j = 0; j < cols.length; j++) row.push(cols[j].innerText);
            csv.push(row.join(","));
        }
        let csvFile = new Blob([csv.join("\n")], {type: "text/csv"});
        let downloadLink = document.createElement("a");
        downloadLink.download = "sales-report.csv";
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
    }
</script>
</body>
</html>