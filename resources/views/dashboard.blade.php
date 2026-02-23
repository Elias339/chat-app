<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WhatsApp Style Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    @vite(['resources/js/app.js'])
</head>
<body>

<div class="container-fluid chat-container">
    <div class="row h-100">

        <!-- Sidebar -->
        <div class="col-md-4 col-lg-3 sidebar d-none d-md-flex flex-column">
            <!-- Search -->
            <div class="p-3 border-bottom">
                <input type="text" class="form-control" placeholder="Search or start new chat">
            </div>

            <!-- Contact List -->
            <div class="flex-grow-1 overflow-auto">
                @foreach($users as $user)
                    <div class="contact-item border-bottom user-item"
                         data-id="{{ $user->id }}"
                         data-name="{{ $user->name }}">
                        <strong>{{ $user->name }}</strong><br>
                        <small class="text-muted">Start chatting...</small>
                    </div>
                @endforeach
            </div>

            <!-- Logout Button -->
            <div class="p-3 border-top mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 fw-semibold logout-btn">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="col-12 col-md-8 col-lg-9 chat-area">
            <!-- Empty State -->
            <div id="emptyState" class="h-100 d-flex justify-content-center align-items-center text-muted">
                <h5>Select a user to start chatting</h5>
            </div>
            <!-- Active Chat (Initially Hidden) -->
            <div id="activeChat" class="d-none h-100 flex-column">
                <!--Chat Header -->
                <div class="chat-header d-flex align-items-center">
                    <img src="https://i.pravatar.cc/40" class="rounded-circle me-2">
                    <strong id="chatUserName"></strong>
                </div>
                <!-- Messages -->
                <div class="chat-messages" id="chatMessages"></div>
                <!-- Input -->

                <div class="chat-input">
                    <div class="chat-input-wrapper">
                        <input type="hidden" id="receiver_id">
                        <input type="text" id="messageInput" class="chat-text-input" placeholder="Type a message">
                        <button class="send-btn" id="sendBtn"> <i class="bi bi-send-fill"></i> </button>
                    </div>
                </div>

{{--                <div class="chat-input">--}}
{{--                    <div class="chat-input-wrapper">--}}
{{--                        <button class="icon-btn">--}}
{{--                            <i class="bi bi-plus-lg"></i>--}}
{{--                        </button>--}}

{{--                        <button class="icon-btn">--}}
{{--                            <i class="bi bi-emoji-smile"></i>--}}
{{--                        </button>--}}

{{--                        <input type="hidden" id="receiver_id">--}}

{{--                        <input type="text"--}}
{{--                               id="messageInput"--}}
{{--                               class="chat-text-input"--}}
{{--                               placeholder="Type a message">--}}

{{--                        <button class="send-btn" id="sendBtn">--}}
{{--                            <i class="bi bi-send-fill"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>

        </div>

    </div>
</div>

</body>
</html>
