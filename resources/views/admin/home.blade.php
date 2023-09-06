@extends('Admin.layout.main')
@section('title')
Thống kê - Báo Cáo
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <button onclick="startFCM()" class="btn btn-danger btn-flat">Nhận thông báo
            </button>
        </div>
    </div>
</div>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyAvQAfqUTShDLh2Iq_PWHDHRucmkuWM6u4",
        authDomain: "chots24.firebaseapp.com",
        projectId: "chots24",
        storageBucket: "chots24.appspot.com",
        messagingSenderId: "527380421071",
        appId: "1:527380421071:web:da0ee92f716e6b9f139aba",
        measurementId: "G-SXPSY6RXQL"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function startFCM() {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(response) {

                $.ajax({
                    url: '{{ route("admin.store.token") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        token: response
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        alert('Token stored.');
                    },
                    error: function(error) {
                        alert(error);
                    },
                });
            }).catch(function(error) {
                alert(error);
            });
    }
    messaging.onMessage(function(payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });
</script>
@endsection