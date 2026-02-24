<div class="col-md-4 col-lg-3 sidebar d-none d-md-flex flex-column p-0">
    <!-- USER PROFILE  -->
    <div class="profile-header">
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
                <i class="bi bi-three-dots-vertical text-white fs-5 dropdown-toggle-icon" id="sidebarMenu" data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer;"></i>

                <ul class="dropdown-menu dropdown-menu-end custom-dropdown shadow mt-4" aria-labelledby="sidebarMenu">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"> <i class="bi bi-person me-2"></i> Profile </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"> <i class="bi bi-gear me-2"></i> Settings </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" id="darkModeToggle">
                            <i class="bi bi-moon me-2"></i> Dark Mode
                        </a>
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
    <div class="p-2 search">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search or start new chat">
        </div>
    </div>

    <!-- CONTACT LIST -->
    <div class="flex-grow-1 overflow-auto contact-list mb-5">
        @foreach($users as $user)
            <div class="contact-item user-item d-flex align-items-center" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                <img src="https://i.pravatar.cc/100?u={{ $user->id }}" class="rounded-circle me-3" width="45" height="45">
                <div class="flex-grow-1">
                    <div class="user-name fw-semibold">{{ $user->name }}</div>

                    @php
                        $lastMessage = $user->lastMessage;
                    @endphp

                    @if($lastMessage)

                        <small class="last-message d-block text-truncate" style="max-width:180px;">
                            @if($lastMessage->sender_id == auth()->id())
                                <span class="text-primary">You:</span>
                            @endif
                            {{ $lastMessage->message }}
                        </small>

                    @else
                        <small class="last-message">No messages yet</small>
                    @endif

                </div>
            </div>
        @endforeach
    </div>


</div>


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.getElementById("darkModeToggle");

            if (localStorage.getItem("darkMode") === "enabled") {
                document.body.classList.add("dark-mode");
                updateIcon(true);
            }

            toggleBtn.addEventListener("click", function (e) {
                e.preventDefault();
                document.body.classList.toggle("dark-mode");
                let isDark = document.body.classList.contains("dark-mode");

                if (isDark) {
                    localStorage.setItem("darkMode", "enabled");
                } else {
                    localStorage.setItem("darkMode", "disabled");
                }
                updateIcon(isDark);
            });
            function updateIcon(isDark) {
                toggleBtn.innerHTML = isDark
                    ? '<i class="bi bi-sun me-2"></i> Light Mode'
                    : '<i class="bi bi-moon me-2"></i> Dark Mode';
            }
        });

    </script>
@endpush
