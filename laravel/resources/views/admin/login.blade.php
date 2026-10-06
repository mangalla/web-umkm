<!doctype html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="robots" content="noindex, nofollow" />
<title>Masuk · Panel Admin KoneksiKu</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" />
<link rel="stylesheet" href="{{ asset('admin-assets/admin.css') }}" />
</head>
<body>
<section class="login">
  <form class="login-card" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="brand brand-dark">
      <span class="brand-mark">P</span>
      <span>Panel Admin<small>KoneksiKu · Laravel</small></span>
    </div>
    <h1>Masuk ke panel</h1>
    <p class="muted">Kelola teks dan kartu promosi CentrinOnline &amp; M3 Internet.</p>

    @if (session('status'))
      <div class="flash" role="status">{{ session('status') }}</div>
    @endif

    <label @class(['field', 'has-error' => $errors->has('email')])>
      <span>Email</span>
      <input type="email" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus />
      @error('email')<small class="field-error">{{ $message }}</small>@enderror
    </label>
    <label @class(['field', 'has-error' => $errors->has('password')])>
      <span>Password</span>
      <input type="password" name="password" autocomplete="current-password" required />
      @error('password')<small class="field-error">{{ $message }}</small>@enderror
    </label>
    <label class="check"><input type="checkbox" name="remember" value="1" /> Ingat saya</label>
    <button class="btn btn-primary btn-block" type="submit">Masuk</button>
  </form>
</section>
</body>
</html>
