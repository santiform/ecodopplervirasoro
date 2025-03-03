@include('layouts.includes.header')

<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="login-container">
    <div class="login-box">
        <h2>Iniciar sesión</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" class="input-field" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="remember-me">
                <label for="remember_me">
                    <input type="checkbox" id="remember_me" name="remember">
                    Recordarme
                </label>
            </div>

            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password-link">¿Olvidaste tu contraseña?</a>
                @endif

                <button type="submit" class="submit-btn">Iniciar sesión</button>
            </div>
        </form>
    </div>
</div>

@include('layouts.includes.footer')