@php
use Carbon\Carbon;
@endphp
@extends('nurse.layouts.layout')
@section('content')
<style>
/* Full height fix */
html,
body {
    height: 100%;
}

/* .chat-container {
    height: calc(100vh - 150px);
} */

/* Sidebar */
.sidebar {
    height: 100%;
    width: 100%;
    border-right: 1px solid #ddd;
    /* overflow-y: auto; */
}

.chat-container {
    border: 1px solid #a0abb8;
    height: calc(100vh - 147px);
    margin-top: 10px;
}

.chat-btn {
    background: #000;
    color: #fff;
    display: inline-flex;
    transition: all ease-in-out .3s;
    font-size: 13px;
    padding: 10px 12px;
    height: fit-content;
}

.chat-btn:hover {
    background: #fff;
    border: 1px solid #000;
    color: #000;
}

/* User item */
.user-item {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #eee;
    text-align: left;
    background: #fff;
}

.user-item img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin-right: 10px;
}

/* Active user */
.user-item.active {
    background: #000 !important;
    color: #000;
    border-radius: 0;
}

/* Chat box layout */
.chat-box {
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* Header */
.chat-header {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Body scroll */
.chat-body {
    flex: 1;
    overflow-y: auto;
    padding: 15px;
    height: 100vh;
    position: relative;
}

/* Footer */
.chat-footer {
    display: flex;
    padding: 10px;
    border-top: 1px solid #ddd;
    /* position: fixed;
    bottom: 85px; */
    /* width: stretch; */
    position: absolute;
    bottom: 45px;
    width: 100%;
    left: 0;
    right: 0;
    align-items: center;
}

.chat-footer input {
    flex: 1;
    margin-right: 10px;
    font-size:13px;
}

/* Message */
.message {
    display: flex;
    margin-bottom: 10px;
}

.message-content {
    background: #eee;
    padding: 8px;
    border-radius: 5px;
}

/* footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 999;
} */
.chat-input input {
    margin: 0 !important;
}
</style>

<main class="main">
    <section>
        <div class="container">
            <div class="row chat-container">

                <!-- LEFT: Users -->
                <div class="col-md-3 p-0 ">
                    <div class="sidebar">
                        <div class="p-2 chat-input">
                            <input type="text" class="form-control m-2" placeholder="Search Messenger">
                        </div>

                        <div class="nav flex-column nav-pills" id="chatTabs" role="tablist">

                            <button class="user-item nav-link active" data-toggle="pill" data-target="#chat1">
                                <img src="https://i.pravatar.cc/40">
                                Test 1
                            </button>

                            <button class="user-item nav-link" data-toggle="pill" data-target="#chat2">
                                <img src="https://i.pravatar.cc/41">
                                Test 2
                            </button>

                            <button class="user-item nav-link" data-toggle="pill" data-target="#chat3">
                                <img src="https://i.pravatar.cc/42">
                                Test 3
                            </button>

                        </div>
                    </div>
                </div>

                <!-- RIGHT: Chat -->
                <div class="col-md-9 p-0">
                    <div class="chat-header">
                        <strong>Jan Test 1</strong>
                        <!-- <button class="btn chat-btn btn-sm">View Site</button> -->
                    </div>
                    <div class="tab-content h-100">

                        <!-- Chat 1 -->
                        <div class="tab-pane fade show active h-100" id="chat1">
                            <div class="chat-box">
                                <div class="chat-body">
                                    <div class="message">
                                        <img src="https://i.pravatar.cc/40">
                                        <div class="message-content">Hello from Chat 1</div>
                                    </div>
                                    <div class="chat-footer">
                                        <input class="form-control" placeholder="Type message">
                                        <button class="btn chat-btn btn-sm">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chat 2 -->
                        <div class="tab-pane fade h-100" id="chat2">
                            <div class="chat-box">
                                <div class="chat-body">
                                    <div class="message">
                                        <img src="https://i.pravatar.cc/40">
                                        <div class="message-content">Hello from Chat 2</div>
                                    </div>
                                    <div class="chat-footer">
                                        <input class="form-control" placeholder="Type message">
                                        <button class="btn btn-chat">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chat 3 -->
                        <div class="tab-pane fade h-100" id="chat3">
                            <div class="chat-box">
                                <div class="chat-body">
                                    <div class="message">
                                        <img src="https://i.pravatar.cc/40">
                                        <div class="message-content">Hello from Chat 3</div>
                                    </div>
                                    <div class="chat-footer">
                                        <input class="form-control" placeholder="Type message">
                                        <button class="btn btn-success">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>
        </div>

    </section>

</main>
@endsection
@section('js')
@endsection