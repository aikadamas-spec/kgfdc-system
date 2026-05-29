
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/' . ($siteSettings['favicon'] ?? 'settings/favicon.png')) }}?v={{ time() }}">
    <link rel="shortcut icon" href="{{ asset('storage/' . ($siteSettings['favicon'] ?? 'settings/favicon.png')) }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <style>    
        .invalid-feedback {
            font-size: 14px;
        }
        body.login-body {
            background: linear-gradient(135deg, #f0f4ff 0%, #e8edf8 100%);
            min-height: 100vh;
        }
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .loginbox {
            padding: 40px 0;
        }
    </style>
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox" style="
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                    background: none;
                    box-shadow: none;
                ">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- imessage -->
    <script src="{{ asset('assets/js/imessage.js') }}"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let messages = {
            success: "{{ session('success') }}",
            error: "{{ session('error') }}",
            warning: "{{ session('warning') }}",
            info: "{{ session('info') }}"
        };

        Object.keys(messages).forEach(type => {
            if (messages[type]) {
                new Message('imessage').show(messages[type], type === "error" ? "fail" : type, "top-center");
            }
        });
    });
    </script>
    @yield('script')
</body>

</html>
