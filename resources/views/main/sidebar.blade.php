<div class="navbar w-auto ps ps--active-y" id="sidenav-collapse-main">
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Dashboard</span>
          </a>
      </li>
      @auth
      @if(auth()->user()->isAnggota() || auth()->user()->isPetugas() || auth()->user()->isDepartemen())
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">User</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('pengaduan.store') ? 'active' : '' }}" href="{{ route('pengaduan.store') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Pengaduan Masuk</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('pengaduan.tindakan.show') ? 'active' : '' }}" href="{{ route('pengaduan.tindakan.show') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-app text-info text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Tindakan</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->is('pengaduan.selesai') ? 'active' : '' }}" href="{{ route('pengaduan.selesai') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-app text-danger text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Tindakan Selesai</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link #" href="#">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-collection text-success text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Riwayat Pengaduan</span>
                  </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->is('pengaduan.selesai') ? 'active' : '' }}" href="#" id="masterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Master</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="masterDropdown">
                    <li><a class="dropdown-item" href="#">Data Jenis Pengaduan</a></li>
                    <li><a class="dropdown-item" href="#">Data Jenis Infrastruktur</a></li>
                </ul>
            </li>
            
          @endif
      @endauth

      @auth
          @if(auth()->user()->isMasyarakat())
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('pengaduan.create') ? 'active' : '' }}" href="{{ route('pengaduan.create') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-collection text-info text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Ajukan Pengaduan</span>
                  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pengaduan.index') ? 'active' : '' }}" href="{{ route('pengaduan.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Status Pengaduan</span>
                </a>
            </li>
          @endif
      @endauth

      <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Profile</span>
          </a>
      </li>
  </ul>
</div>
