<div class="col-md-4 col-lg-3 sidebar d-none d-md-flex flex-column p-0">
    <!-- USER PROFILE  -->
    <div class="profile-header p-3">
        <div class="d-flex align-items-center position-relative">
            <div class="position-relative">
                <img src="https://i.pravatar.cc/100?u={{ auth()->id() }}" class="rounded-circle profile-img" width="55" height="55">
                <span class="online-dot"></span>
            </div>
            <div class="ms-3 flex-grow-1">
                <h6 class="mb-0 fw-bold text-white"> {{ auth()->user()->name }} </h6>
                <small class="text-light opacity-75"> {{ auth()->user()->email }} </small>
            </div>

            <div class="dropdown ms-auto">
                <i class="bi bi-three-dots-vertical text-white fs-5 dropdown-toggle-icon"
                   id="sidebarMenu"
                   data-bs-toggle="dropdown"
                   aria-expanded="false"
                   style="cursor:pointer;"></i>

                <ul class="dropdown-menu dropdown-menu-end custom-dropdown shadow" aria-labelledby="sidebarMenu">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"> <i class="bi bi-person me-2"></i> Profile </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"> <i class="bi bi-gear me-2"></i> Settings </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"> <i class="bi bi-moon me-2"></i> Dark Mode </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger d-flex align-items-center"> <i class="bi bi-box-arrow-right me-2"></i> Logout </button>
                        </form>
                    </li>

                </ul>
            </div>

        </div>
    </div>

    <!-- SEARCH -->
    <div class="p-3 border-bottom bg-light">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search or start new chat">
        </div>
    </div>

    <!-- CONTACT LIST -->
    <div class="flex-grow-1 overflow-auto contact-list">
        @foreach($users as $user)
            <div class="contact-item user-item d-flex align-items-center" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                <img src="https://i.pravatar.cc/100?u={{ $user->id }}" class="rounded-circle me-3" width="45" height="45">
                <div class="flex-grow-1">
                    <div class="fw-semibold">{{ $user->name }}</div>
                    <small class="text-muted">Tap to start chatting</small>
                </div>
            </div>
        @endforeach
    </div>

    <div class="p-3 border-top bg-white">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn logout-btn w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>

</div>
