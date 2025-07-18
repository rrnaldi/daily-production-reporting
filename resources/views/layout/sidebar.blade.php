<div class="sidebar bg-primary text-white vh-100 p-3" style="width: 260px; box-shadow: 2px 0 10px rgba(0,0,0,0.1);">
    <div class="sidebar-header mb-4 d-flex align-items-center">
        <h4 class="m-0">
            <i class="fas fa-bars me-2"></i> Menu
        </h4>
    </div>

    @php $role = auth()->user()->role; @endphp

    {{-- ADMIN --}}
    @if($role === 'admin')
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex align-items-center py-2 rounded" href="/admin/dashboard">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex align-items-center py-2 rounded" href="{{ route('users.index') }}">
                    <i class="fas fa-users-cog me-3"></i>
                    <span>Kelola User</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex align-items-center py-2 rounded" href="{{ route('items.index') }}">
                    <i class="fas fa-boxes me-3"></i>
                    <span>Kelola Item</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex align-items-center py-2 rounded" href="{{ route('uoms.index') }}">
                    <i class="fas fa-ruler-combined me-3"></i>
                    <span>Kelola UOM</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex align-items-center py-2 rounded" href="{{ route('work-centers.index') }}">
                    <i class="fas fa-cogs me-3"></i>
                    <span>Kelola Work Center</span>
                </a>
            </li>
        </ul>
    @endif

    {{-- OPERATOR --}}
    @if($role === 'operator')
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex align-items-center py-2 rounded" href="/operator/dashboard">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex align-items-center py-2 rounded" href="{{ route('operator.produksi.create') }}">
                    <i class="fas fa-edit me-3"></i>
                    <span>Input Produksi</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex align-items-center py-2 rounded" href="{{ route('operator.produksi.riwayat') }}">
                    <i class="fas fa-history me-3"></i>
                    <span>Riwayat Produksi</span>
                </a>
            </li>
        </ul>
    @endif

    {{-- SUPERVISOR --}}
    @if($role === 'supervisor')
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex align-items-center py-2 rounded" href="/supervisor/dashboard">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('supervisor.lots.index') }}">
                    <i class="fas fa-boxes me-2"></i> Kelola Lot Bahan
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex align-items-center py-2 rounded" href="{{ route('supervisor.laporan.index') }}">
                    <i class="fas fa-file-alt me-3"></i>
                    <span>Laporan Produksi</span>
                </a>
            </li>
        </ul>
    @endif

    <div class="sidebar-footer mt-auto pt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-light w-100 d-flex align-items-center justify-content-center">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </div>
</div>

<style>
    .sidebar {
        transition: all 0.3s;
    }
    
    .sidebar .nav-link {
        transition: all 0.2s;
    }
    
    .sidebar .nav-link:hover {
        background-color: rgba(255,255,255,0.15);
        transform: translateX(5px);
    }
    
    .sidebar .nav-link i {
        width: 20px;
        text-align: center;
    }
    
    .sidebar .sidebar-footer {
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    
    .sidebar .btn-light {
        transition: all 0.2s;
    }
    
    .sidebar .btn-light:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
    }
</style>