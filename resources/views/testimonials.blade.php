@extends('layouts.app')

@section('title', 'Testimoni - One Spirit')

@section('content')
<div class="section" style="background-color: var(--background);">
    <h2 class="section-title">Testimoni Pelanggan</h2>
    <div class="testimonials">
        @forelse ($reviews as $review)
            <div class="testimonial-card">
                <p>"{{ $review->komentar }}"</p>
                <div class="author">
                    - {{ $review->user->name }}
                    <span>Menyewa {{ $review->mobilElf->nama_mobil }}</span>
                </div>
                <div class="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star{{ $i <= $review->rating ? '' : '-empty' }}">★</span>
                    @endfor
                </div>
            </div>
        @empty
            <p style="text-align: center;">Belum ada testimoni untuk ditampilkan.</p>
        @endforelse
    </div>
</div>
@endsection
