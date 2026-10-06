@extends('layouts.admin')
@section('title', $faq->exists ? 'Edit pertanyaan' : 'Tambah pertanyaan')

@section('content')
  <form class="panel" method="POST" style="max-width:760px"
        action="{{ $faq->exists ? route('admin.faqs.update', $faq) : route('admin.faqs.store', $faq->site) }}">
    @csrf
    @if ($faq->exists) @method('PUT') @endif

    <div class="panel-body" style="display:grid;gap:16px">
      <label @class(['field', 'has-error' => $errors->has('question')])>
        <span>Pertanyaan *</span>
        <input type="text" name="question" value="{{ old('question', $faq->question) }}" required />
        @error('question')<small class="field-error">{{ $message }}</small>@enderror
      </label>
      <label @class(['field', 'has-error' => $errors->has('answer')])>
        <span>Jawaban *</span>
        <textarea name="answer" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
        @error('answer')<small class="field-error">{{ $message }}</small>@enderror
      </label>
      <label class="check"><input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', $faq->is_visible)) /> Tampilkan di halaman</label>
    </div>
    <div class="form-actions">
      <a class="btn btn-ghost" href="{{ route('admin.faqs.index', $faq->site) }}">Batal</a>
      <button class="btn btn-primary" type="submit">{{ $faq->exists ? 'Simpan perubahan' : 'Tambah pertanyaan' }}</button>
    </div>
  </form>
@endsection
