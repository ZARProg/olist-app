<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | OLIST Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.5);
            --glass-border: rgba(255, 255, 255, 0.4);
            --primary: #0071e3;
            --text-dark: #1d1d1f;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e0eafc 0%, #f5f5f7 100%);
            margin: 0;
            overflow: hidden;
        }

        /* Abstract Background Orbs */
        .orb {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
            opacity: 0.5;
            animation: move 20s infinite alternate;
        }
        .orb-1 { background: #0071e3; top: -200px; left: -200px; }
        .orb-2 { background: #5e5ce6; bottom: -200px; right: -100px; }
        @keyframes move { from { transform: translate(0,0); } to { transform: translate(100px, 50px); } }

        .main-card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border-radius: 40px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 40px 100px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 1000px;
            overflow: hidden;
            display: flex;
        }

        /* Visual Section (Left) */
        .visual-section {
            background: rgba(0, 0, 0, 0.03);
            width: 45%;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            border-right: 1px solid var(--glass-border);
        }

        .visual-content h2 {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -3px;
            margin-top: 40px;
            background: linear-gradient(to bottom right, #1d1d1f, #86868b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .aesthetic-shape {
            width: 80px;
            height: 80px;
            background: var(--primary);
            border-radius: 20px;
            rotate: 15deg;
            box-shadow: 0 20px 40px rgba(0, 113, 227, 0.3);
        }

        /* Form Section (Right) */
        .form-section {
            width: 55%;
            padding: 60px;
        }

        .brand-logo { 
            font-weight: 800; 
            letter-spacing: -2px; 
            font-size: 1.8rem;
            color: var(--text-dark);
            text-decoration: none;
        }

        .form-control { 
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 16px; 
            padding: 14px 20px; 
            transition: all 0.3s ease;
        }

        .form-control:focus { 
            background: #fff;
            box-shadow: 0 0 0 5px rgba(0, 113, 227, 0.1);
            border-color: var(--primary);
            outline: none;
        }

        .btn-login { 
            background: var(--text-dark); 
            color: white;
            border: none; 
            border-radius: 16px; 
            padding: 16px; 
            font-weight: 700; 
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-login:hover { 
            background: #000;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            color: white;
        }

        .label-style {
            font-size: 0.7rem;
            font-weight: 800;
            color: #86868b;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 8px;
            display: block;
        }

        @media (max-width: 992px) {
            .visual-section { display: none; }
            .form-section { width: 100%; padding: 40px; }
            .main-card { max-width: 450px; }
        }
    </style>
</head>
<body>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="container d-flex justify-content-center px-4">
        <div class="main-card">
            <div class="visual-section">
                <div class="aesthetic-shape"></div>
                <div class="visual-content">
                    <div class="text-muted small fw-bold">EST. 2026</div>
                    <h2>The<br>New<br>Standard.</h2>
                    <p class="text-muted mt-3">Experience commerce in its most refined form.</p>
                </div>
                <div class="small text-muted opacity-50">© OLIST MARKETPLACE</div>
            </div>

            <div class="form-section">
                <div class="mb-5">
                    <a href="{{ url('/') }}" class="brand-logo">olist.</a>
                    <h4 class="fw-bold mt-4 mb-1">Welcome back</h4>
                    <p class="text-muted small">Enter your credentials to continue.</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger border-0 rounded-4 small py-3 mb-4 shadow-sm">
                        <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{{ url('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="label-style">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="name@company.com" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label class="label-style">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    
                    <button type="submit" class="btn btn-login w-100 mb-4 mt-2">Sign In</button>
                    
                    <div class="text-center">
                        <p class="text-muted small">Don't have an account? <a href="{{ url('register') }}" class="text-primary fw-bold text-decoration-none">Register</a></p>
                        <a href="{{ url('/') }}" class="text-muted small text-decoration-none opacity-40"><i class="fa-solid fa-arrow-left me-1"></i> Home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>