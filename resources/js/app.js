console.log("✅ app.js loaded");

import './bootstrap';


// let roomId = document.getElementById('chat-app').dataset.roomId;
// window.Echo.channel(`chat-room.${roomId}`)
//     .listen('.message.sent', (e) => {
//         // console.log("here in message send id",e);
//         // const chatBox = document.getElementById('chat-box');
//         // const newMsg = document.createElement('div');
//         // newMsg.innerHTML = `<strong>${e.user.name}:</strong> ${e.message}`;
//         // chatBox.appendChild(newMsg);
//         // chatBox.scrollTop = chatBox.scrollHeight;
//           const chatBox = document.getElementById('chat-box');
//         const msg = document.createElement('div');
//         msg.className = 'message ' + (e.user.id == {{ auth()->id() }} ? 'you' : 'other');
//         msg.innerHTML = `<strong>${e.user.name}</strong>: ${e.message}<small>${e.time}</small>`;
//         chatBox.appendChild(msg);
//         chatBox.scrollTop = chatBox.scrollHeight;
//     });

// // Laravel Echo - Presence Channel for Online Users
// window.Echo.join(`chat-room.${roomId}`)
//     .here((users) => {
//         updateOnlineUsers(users);
//     })
//     .joining((user) => {
//         addUser(user);
//     })
//     .leaving((user) => {
//         removeUser(user);
//     });

// function updateOnlineUsers(users) {
//     const list = document.getElementById('online-users');
//     list.innerHTML = '';
//     users.forEach(user => {
//         const li = document.createElement('li');
//         li.id = `user-${user.id}`;
//         li.innerText = user.name;
//         list.appendChild(li);
//     });
// }

// function addUser(user) {
//     const list = document.getElementById('online-users');
//     const li = document.createElement('li');
//     li.id = `user-${user.id}`;
//     li.innerText = user.name;
//     list.appendChild(li);
// }

// function removeUser(user) {
//     const userElement = document.getElementById(`user-${user.id}`);
//     if (userElement) {
//         userElement.remove();
//     }
// }

document.addEventListener('DOMContentLoaded', () => {
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message');
    const chatBox = document.getElementById('chat-box');

    if (chatForm) {
        chatForm.addEventListener('submit', function (e) {
            e.preventDefault();

            fetch('/admin/chat-send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({
                    chat_room_id: window.roomId,
                    message: messageInput.value
                })
            }).then(response => response.json())
            .then(data => {
                messageInput.value = '';
            });
        });
    }

    // Echo: Listen for new messages
    window.Echo.channel(`chat-room.${window.roomId}`)
        .listen('.message.sent', (e) => {
            console.log('New message:', e);
            const msg = document.createElement('div');
            msg.className = 'message ' + (e.user.id == window.userId ? 'you' : 'other');
            msg.innerHTML = `<strong>${e.user.name}</strong>: ${e.message}<small>${e.time}</small>`;
            chatBox.appendChild(msg);
            chatBox.scrollTop = chatBox.scrollHeight;
        });

    // Echo: Presence channel for online users
    window.Echo.join(`chat-room.${window.roomId}`)
        .here(users => updateOnlineList(users))
        .joining(user => addUser(user))
        .leaving(user => removeUser(user));

    function updateOnlineList(users) {
        const list = document.getElementById('online-users');
        list.innerHTML = '';
        users.forEach(user => {
            const li = document.createElement('li');
            li.className = 'list-group-item online-user';
            li.id = `user-${user.id}`;
            li.textContent = user.name;
            list.appendChild(li);
        });
    }

    function addUser(user) {
        const li = document.createElement('li');
        li.className = 'list-group-item online-user';
        li.id = `user-${user.id}`;
        li.textContent = user.name;
        document.getElementById('online-users').appendChild(li);
    }

    function removeUser(user) {
        const el = document.getElementById(`user-${user.id}`);
        if (el) el.remove();
    }
});