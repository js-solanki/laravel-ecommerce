<!DOCTYPE html>
<html lang="en">

<x-adminheader />
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
     .chat-container { display: flex; height: 90vh; margin-top: 10px; }
        .sidebar { width: 25%; background: #fff; border-right: 1px solid #ddd; overflow-y: auto; }
        .chat-area { flex: 1; display: flex; flex-direction: column; background: #ece5dd; }
        .chat-messages { flex: 1; padding: 15px; overflow-y: auto; }
        .message { max-width: 60%; padding: 10px; margin-bottom: 10px; border-radius: 10px; }
        .message.you { background: #dcf8c6; margin-left: auto; }
        .message.other { background: #fff; }
        .message small { display: block; font-size: 0.75rem; color: gray; margin-top: 5px; }
        .input-area { background: #f0f0f0; padding: 10px; border-top: 1px solid #ccc; }
   /* .chat-box { height: 400px; overflow-y: scroll; background: #f8f9fa; padding: 15px; border-radius: 8px; }

        .message { margin-bottom: 10px; }
        .message .user { font-weight: bold; }
        .message.you { text-align: right; }
        .online-user { font-size: 0.9rem; color: green; } */
</style>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->

        <x-nav />
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <x-adminheadersetting />
            <x-adminrightment />
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <x-adminsidebar />
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-10 col-xl-6 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Chat</h3>
                                    <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> -->
                                </div>
                                <div class="col-2">
                                    <!-- <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                        onclick="window.location='{{ route('admin-product-list') }}'">back</button> -->
                                </div>
                            </div>
                        </div>
                    </div>   
                      <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="row card pt-25">
                                <div class="container-fluid chat-container">
                                    <!-- Sidebar (Rooms / Users) -->
                                    <div class="sidebar p-2">
                                        <h5>Chats</h5>
                                        @foreach($rooms as $room)
                                            <a href="/admin/chat/{{ $room->id }}" class="d-block py-2 px-2 text-decoration-none {{ $room->id == $currentRoom->id ? 'bg-light' : '' }}">
                                                {{ $room->name }}
                                            </a>
                                        @endforeach
                                        </hr>
                                         <div class="online-users">
                                            <!-- <h2>🟢 Online Users:</h2> -->
                                            <ul id="online-users"></ul>
                                        </div>
                                    </div>

                                    <!-- Chat Area -->
                                    <div class="chat-area">
                                        <div class="chat-messages" id="chat-box">
                                            @foreach($messages as $msg)
                                                <div class="message {{ $msg->user_id == auth()->id() ? 'you' : 'other' }}">
                                                    <strong>{{ $msg->user->name }}</strong>: {{ $msg->message }}
                                                    <small>{{ getFormattedTime($msg->created_at) }}</small>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Input Form -->
                                        <div class="input-area">
                                            <form id="chat-form">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="text" id="message" class="form-control" placeholder="Type a message..." required>
                                                    <button type="submit" class="btn btn-success">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
              
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <x-adminfooter />
</body>
    @vite('resources/js/app.js')
    <script>
         window.roomId = {{ $currentRoom->id }};
        window.csrfToken = "{{ csrf_token() }}";
        window.userId = {{ auth()->id() }};

    </script>
</html>