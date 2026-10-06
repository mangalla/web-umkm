@extends('layouts.admin')
@section('title', 'Keamanan')

@section('content')
  @if ($defaultPassword)
    <div class="alert alert-warn"><svg aria-hidden="true"><use href="#i-alert"/></svg><p>Password saat ini masih bawaan (<code>admin123</code>).</p></div>
  @endif

  <section class="panel" style="max-width:520px">
    <header class="panel-head">
      <div><h2>Ganti password</h2><p>Masuk sebagai <b>{{ auth()->user()->email }}</b>. Minimal 8 karakter.</p></div>
    </header>
    <form class="panel-body" method="POST" action="{{ route('admin.account.password') }}" style="display:grid;gap:14px">
      @csrf
      @method('PUT')
      <label @class(['field', 'has-error' => $errors->has('current_password')])>
        <span>Password saat ini</span>
        <input type="password" name="current_password" autocomplete="current-password" required />
        @error('current_password')<small class="field-error">{{ $message }}</small>@enderror
      </label>
      <label @class(['field', 'has-error' => $errors->has('password')])>
        <span>Password baru</span>
        <input type="password" name="password" autocomplete="new-password" minlength="8" required />
        @error('password')<small class="field-error">{{ $message }}</small>@enderror
      </label>
      <label class="field">
        <span>Ulangi password baru</span>
        <input type="password" name="password_confirmation" autocomplete="new-password" minlength="8" required />
      </label>
      <button class="btn btn-primary" type="submit">Simpan password</button>
    </form>
  </section>
@endsection
