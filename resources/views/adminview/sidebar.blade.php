<div class="col-md-3 col-lg-2 p-0 sidebar">
    <div class="d-flex flex-column p-3">
        <a href="{{ route('admin.dashboard') }}"
           class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
           <span class="fs-4">Admin Panel</span>
        </a>
        <hr>
        <div class="dropdown">
            <a href="#"
               class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
               <img src="https://placehold.co/40x40" alt="Admin profile picture"
                    class="rounded-circle me-2">
               <strong>Admin</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('vehicle.index') }}" class="nav-link {{ request()->routeIs('vehicle.*') ? 'active' : '' }}">
                    <i class="bi bi-car-front"></i> Vehicle Management
                </a>
            </li>
        </ul>
    </div>
</div>
