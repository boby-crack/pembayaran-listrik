<div class="sidebar p-3">
    <h4>Menu</h4>
    <ul class="nav flex-column">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>

        <!-- Levels (Hanya untuk Admin) -->
        @if (Auth::check() && Auth::user()->level && Auth::user()->level->nama_level === 'Admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('levels.index') }}">
                    <i class="fas fa-layer-group"></i> Levels
                </a>
            </li>
        @endif

        <!-- Users (Hanya untuk Admin) -->
        @if (Auth::check() && Auth::user()->level && Auth::user()->level->nama_level === 'Admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
        @endif

        <!-- Tarifs -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tarifs.index') }}">
                <i class="fas fa-bolt"></i> Tarifs
            </a>
        </li>

        <!-- Pelanggans -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pelanggans.index') }}">
                <i class="fas fa-user-friends"></i> Pelanggans
            </a>
        </li>

        <!-- Penggunaans -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('penggunaans.index') }}">
                <i class="fas fa-chart-line"></i> Penggunaans
            </a>
        </li>

        <!-- Tagihans -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tagihans.index') }}">
                <i class="fas fa-file-invoice"></i> Tagihans
            </a>
        </li>

        <!-- Pembayarans -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pembayarans.index') }}">
                <i class="fas fa-money-bill"></i> Pembayarans
            </a>
        </li>
    </ul>
</div>
