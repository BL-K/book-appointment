@extends('layouts.patient_app')

@section('content')
    <section class="section section-search">
        <div class="container-fluid">
            <div class="banner-wrapper">
                <div class="banner-header text-center">
                    <h1>Nhấp vào nút trò chuyện bên dưới để nhận hỗ trợ tự động từ Medical Register Chatbot</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header"></div>
                        <div id="body">
                            <div id="chat-circle" class="btn btn-raised">
                                <div id="chat-overlay"></div>
                                <i class="fa-solid fa-comment-dots"
                                    style="font-size: 35px; margin-top: -10px; margin-left: -10px;"></i>
                            </div>
                            <div class="chat-box">
                                <div class="chat-box-header">
                                    Chatbot Medical Register
                                    <span class="chat-box-toggle"> <i class="material-icons">close</i></span>
                                </div>
                                <div class="chat-box-body">
                                    <div class="chat-box-overlay">
                                    </div>
                                    <div class="chat-logs">
                                    </div>
                                </div>
                                <div class="chat-input">
                                    <form>
                                        <input type="text" id="chat-input" placeholder="Send a message..." />
                                        <button type="submit" class="chat-submit" id="chat-submit"><i
                                                class="material-icons">send</i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        #center-text {
            display: flex;
            flex: 1;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;

        }

        #chat-circle {
            position: fixed;
            bottom: 50px;
            right: 50px;
            background: #0de0fe;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            color: white;
            padding: 28px;
            cursor: pointer;
            box-shadow: 0px 3px 16px 0px rgba(0, 0, 0, 0.6), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        .btn#my-btn {
            background: white;
            padding-top: 13px;
            padding-bottom: 12px;
            border-radius: 45px;
            padding-right: 40px;
            padding-left: 40px;
            color: #0de0fe;
        }

        #chat-overlay {
            background: rgba(255, 255, 255, 0.1);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            display: none;
        }


        .chat-box {
            display: none;
            background: #efefef;
            position: fixed;
            right: 30px;
            bottom: 50px;
            width: 350px;
            max-width: 85vw;
            max-height: 100vh;
            border-radius: 5px;
            box-shadow: 0px 5px 35px 9px #ccc;
        }

        .chat-box-toggle {
            float: right;
            margin-right: 15px;
            cursor: pointer;
        }

        .chat-box-header {
            background: #0de0fe;
            width: 350px;
            height: 70px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            color: white;
            text-align: center;
            font-size: 20px;
            padding-top: 17px;
        }

        .chat-box-body {
            position: relative;
            width: 350px;
            height: auto;
            border: 1px solid #ccc;
            overflow: hidden;
        }

        .chat-box-body:after {
            content: "";
            opacity: 0.1;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            height: 100%;
            position: absolute;
            z-index: -1;
        }

        #chat-input {
            background: #f4f7f9;
            width: 100%;
            position: relative;
            height: 47px;
            padding-top: 10px;
            padding-right: 50px;
            padding-bottom: 10px;
            padding-left: 15px;
            border: none;
            resize: none;
            outline: none;
            border: 1px solid #ccc;
            color: #888;
            border-top: none;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
            overflow: hidden;
        }

        .chat-input>form {
            margin-bottom: 0;
        }

        #chat-input::-webkit-input-placeholder {
            color: #ccc;
        }

        #chat-input::-moz-placeholder {
            color: #ccc;
        }

        #chat-input:-ms-input-placeholder {
            color: #ccc;
        }

        #chat-input:-moz-placeholder {
            color: #ccc;
        }

        .chat-submit {
            position: absolute;
            bottom: 3px;
            right: 10px;
            background: transparent;
            box-shadow: none;
            border: none;
            border-radius: 50%;
            color: #0de0fe;
            width: 35px;
            height: 35px;
        }

        .chat-logs {
            padding: 15px;
            height: 370px;
            overflow-y: scroll;
        }

        .chat-logs::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        .chat-logs::-webkit-scrollbar {
            width: 5px;
            background-color: #F5F5F5;
        }

        .chat-logs::-webkit-scrollbar-thumb {
            background-color: #0de0fe;
        }

        @media only screen and (max-width: 500px) {
            .chat-logs {
                height: 40vh;
            }
        }

        .chat-msg.user>.msg-avatar img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            float: left;
            width: 15%;
        }

        .chat-msg.self>.msg-avatar img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            float: right;
            width: 15%;
        }

        .cm-msg-text {
            background: white;
            padding: 10px 15px 10px 15px;
            color: #666;
            max-width: 75%;
            float: left;
            margin-left: 10px;
            position: relative;
            margin-bottom: 20px;
            border-radius: 30px;
        }

        .chat-msg {
            clear: both;
        }

        .chat-msg.self>.cm-msg-text {
            float: right;
            margin-right: 10px;
            background: #0de0fe;
            color: white;
        }

        .cm-msg-button>ul>li {
            list-style: none;
            float: left;
            width: 50%;
        }

        .cm-msg-button {
            clear: both;
            margin-bottom: 70px;
        }
    </style>
@endsection
