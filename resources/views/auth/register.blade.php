<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join OLIST | Modern Experience</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.45);
            --glass-border: rgba(255, 255, 255, 0.3);
            --primary: #0071e3;
            --text-dark: #1d1d1f;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Latar belakang dengan mesh gradient yang bergerak */
            background: linear-gradient(45deg, #f5f5f7 0%, #e0eafc 50%, #f5f5f7 100%);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            margin: 0;
            overflow-x: hidden;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Lingkaran abstrak di background untuk efek kedalaman */
        .orb {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.5;
        }
        .orb-1 { background: #0071e3; top: -100px; right: -100px; }
        .orb-2 { background: #5e5ce6; bottom: -100px; left: -100px; }

        .glass-card { 
            background: var(--glass-bg);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border-radius: 40px; 
            border: 1px solid var(--glass-border);
            box-shadow: 0 25px 50px rgba(0,0,0,0.05);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .brand-logo { 
            font-weight: 800; 
            letter-spacing: -2.5px; 
            font-size: 2.8rem;
            margin-bottom: 5px;
            background: linear-gradient(to bottom, #1d1d1f, #434345);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-control { 
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 18px; 
            padding: 14px 20px; 
            font-size: 1rem;
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }

        .form-control:focus { 
            background: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 5px rgba(0, 113, 227, 0.12);
            transform: translateY(-2px);
        }

        .btn-register { 
            background: var(--text-dark); 
            color: white;
            border: none; 
            border-radius: 18px; 
            padding: 16px; 
            font-weight: 700; 
            font-size: 1.1rem;
            margin-top: 20px;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-register:hover { 
            background: #000;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            color: white;
        }

        .btn-register:active { transform: scale(0.97); }

        .label-style {
            font-size: 0.75rem;
            font-weight: 700;
            color: rgba(0,0,0,0.5);
            margin-left: 8px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .error-glass {
            background: rgba(255, 59, 48, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 15px;
            border: 1px solid rgba(255, 59, 48, 0.2);
            color: #d70015;
            margin-bottom: 25px;
        }

        .login-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            transition: opacity 0.2s;
        }
        .login-link:hover { opacity: 0.7; }
    </style>
</head>
<body>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="container d-flex justify-content-center py-5">
        <div class="glass-card">
            <div class="text-center mb-5">
                <div class="brand-logo">olist.</div>
                <p class="text-muted fw-500">Create your digital identity.</p>
            </div>

            @if ($errors->any())
                <div class="error-glass">
                    <ul class="mb-0 list-unstyled small fw-bold">
                        @foreach ($errors->all() as $error)
                            <li><i class="fa-solid fa-circle-exclamation me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ url('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="label-style">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="John Doe" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="label-style">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="john@olist.com" value="{{ old('email') }}" required>
                </div>

                <div class="mb-4">
                    <label class="label-style">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Min. 6 characters" required>
                </div>

                <button type="submit" class="btn btn-register w-100 mb-4">
                    Start Your Journey
                </button>

                <div class="text-center">
                    <p class="small text-muted mb-4">Already a member? <a href="{{ url('login') }}" class="login-link">Sign In</a></p>
                    <a href="{{ url('/') }}" class="text-muted small text-decoration-none opacity-50">
                        <i class="fa-solid fa-chevron-left me-1"></i> Back to gallery
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>