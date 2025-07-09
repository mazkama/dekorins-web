<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Dekorin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f3e7e9 0%, #e3eeff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .register-container {
            width: 100%;
            max-width: 450px;
            margin: 1rem;
            padding: 2rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.5s ease-in-out;
        }

        .form-input {
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            padding: 0.75rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-input:focus {
            border-color: #4b5563;
            box-shadow: 0 0 0 3px rgba(75, 85, 99, 0.2);
            outline: none;
        }

        .btn-primary {
            background: #4b5563;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem;
            color: white;
            transition: background 0.3s ease;
            width: 100%;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #1f2937;
        }

        .logo {
            max-width: 140px;
            margin-bottom: 1.5rem;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .session-status {
            background: #d1fae5;
            color: #065f46;
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        a {
            color: #4b5563;
            text-decoration: none;
            font-size: 0.875rem;
        }

        a:hover {
            color: #1f2937;
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .register-container {
                margin: 0.5rem;
                padding: 1.5rem;
            }

            .logo {
                max-width: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="text-center">
            <img src="https://via.placeholder.com/140x40?text=Dekorin" alt="Dekorin Logo" class="logo mx-auto">
            <h2 class="text-2xl font-semibold text-gray-800">Register to Dekorin</h2>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <!-- Name -->
            <div class="mt-4">
                <label for="name" class="block text-gray-700 font-medium">Name</label>
                <input id="name" class="block mt-1 w-full form-input" type="text" name="name"
                    value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter your name" />
                @if ($errors->has('name'))
                    <div class="error-message">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input id="email" class="block mt-1 w-full form-input" type="email" name="email"
                    value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email" />
                @if ($errors->has('email'))
                    <div class="error-message">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <label for="no_hp" class="block text-gray-700 font-medium">Phone Number</label>
                <input id="no_hp" class="block mt-1 w-full form-input" type="text" name="no_hp"
                    value="{{ old('no_hp') }}" placeholder="Enter your phone number" />
                @if ($errors->has('no_hp'))
                    <div class="error-message">{{ $errors->first('no_hp') }}</div>
                @endif
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input id="password" class="block mt-1 w-full form-input" type="password" name="password" required
                    autocomplete="new-password" placeholder="Enter your password" />
                @if ($errors->has('password'))
                    <div class="error-message">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- Confirm Password -->
            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm Password</label>
                <input id="password_confirmation" class="block mt-1 w-full form-input" type="password"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirm your password" />
                @if ($errors->has('password_confirmation'))
                    <div class="error-message">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>

            <!-- Register Button -->
            <div class="mt-4">
                <button type="submit" class="w-full btn-primary">
                    Register
                </button>
            </div>

            <!-- Already Registered Link (right-aligned under button) -->
            <div class="mt-2 text-right">
                <a href="/login" class="text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </a>
            </div>

        </form>
    </div>
</body>

</html>
