document.addEventListener('DOMContentLoaded', function () {

    let currentUserId = document.querySelector('meta[name="user-id"]').content;
    let receiverInput = document.getElementById('receiver_id');
    let chatMessages = document.getElementById('chatMessages');
    let sendBtn = document.getElementById('sendBtn');
    let messageInput = document.getElementById('messageInput');
    let chatUserName = document.getElementById('chatUserName');
    let emptyState = document.getElementById('emptyState');
    let activeChat = document.getElementById('activeChat');

    // Select user
    document.addEventListener('click', function(e) {
        let userItem = e.target.closest('.user-item');
        if (!userItem) return;

        let receiverId = userItem.dataset.id;

        receiverInput.value = receiverId;
        chatUserName.innerText = userItem.dataset.name;
        chatMessages.innerHTML = '';

        // 🔥 Hide empty state
        emptyState.classList.add('d-none');

        // 🔥 Show chat
        activeChat.classList.remove('d-none');
        activeChat.classList.add('d-flex');

        fetch(`/messages/${receiverId}`)
            .then(res => res.json())
            .then(messages => {
                messages.forEach(msg => {
                    let messageClass = msg.sender_id == currentUserId
                        ? 'sent'
                        : 'received';

                    chatMessages.innerHTML += `
                    <div class="message ${messageClass}">
                        ${msg.message}
                    </div>
                `;
                });

                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
    });

    // Listen messages
    if (window.Echo) {
        window.Echo.private('chat.' + currentUserId)
            .listen('SendMessage', (e) => {
                let messageHtml = `<div class="message received">${e.message}</div>`;
                chatMessages.innerHTML += messageHtml;
            });
    }

    // Send message
    sendBtn.addEventListener('click', () => {
        if (!messageInput.value.trim() || !receiverInput.value) return;
        fetch('/send-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                message: messageInput.value,
                receiver_id: receiverInput.value
            })
        })
            .then(res => res.json())
            .then(data => {
                chatMessages.innerHTML += `<div class="message sent">${data.message}</div>`;
                messageInput.value = '';
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
    });
    messageInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendBtn.click();
        }
    });

});
