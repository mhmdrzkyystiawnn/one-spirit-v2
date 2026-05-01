@extends('layouts.app')

@section('title', 'Beri Ulasan - One Spirit')

@section('content')
    <div class="container">
        <h1>Beri Ulasan untuk Pesanan #{{ $booking->id }}</h1>
        <p>Mobil: <strong>{{ $booking->mobilElf->nama_mobil }}</strong></p>
        <form action="{{ route('review.store') }}" method="POST">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            
            {{-- Kita pake class .form-group yang udah ada di app.css --}}
            <div class="form-group">
                <label for="rating">Rating Bintang</label>
                {{-- Kita pake class .form-input yang udah ada di app.css --}}
                <select name="rating" id="rating" class="form-input" required>
                    <option value="">-- Pilih Bintang --</option>
                    <option value="5">⭐⭐⭐⭐⭐ (Sangat Baik)</option>
                    <option value="4">⭐⭐⭐⭐ (Baik)</option>
                    <option value="3">⭐⭐⭐ (Cukup)</option>
                    <option value="2">⭐⭐ (Kurang)</option>
                    <option value="1">⭐ (Sangat Kurang)</option>
                    </select>
                </div>

            <div class="form-group">
                <label for="komentar">Ulasan Anda</label>
                {{-- Kita pake class .form-input yang udah ada di app.css --}}
                
                <textarea name="komentar" id="komentar" rows="5" class="form-input" required
                    placeholder="Ceritakan pengalaman Anda..."></textarea>
                
            </div>

            {{-- Kita pake class .btn yang udah ada di app.css --}}
            <button type="submit" class="btn">Kirim Ulasan</button>
            </form>
    </div>
@endsection
