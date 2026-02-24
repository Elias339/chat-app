@extends('dashboard.app')
@section('content')
<div class="col-12 col-md-8 col-lg-9 chat-area">
    <!-- Empty State -->
    <div id="emptyState" class="h-100 d-flex justify-content-center align-items-center text-muted">
        <h5>Select a user to start chatting</h5>
    </div>
    <!-- Active Chat -->
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

    </div>

</div>
@endsection
