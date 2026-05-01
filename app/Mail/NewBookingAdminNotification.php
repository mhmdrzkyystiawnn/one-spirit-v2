<?php

namespace App\Mail;

use App\Models\Booking; // Panggil model Booking
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBookingAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    // Kita siapin "kantong" buat nyimpen data booking
    public $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking)
    {
        // Pas surat ini dibuat, kita masukin data booking-nya ke dalem "kantong"
        $this->booking = $booking;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notifikasi Pesanan Baru Telah Masuk!', // Ini judul emailnya nanti
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Di sini kita bilang, "isi suratnya ambil dari file view ini ya"
        return new Content(
            view: 'emails.admin.new-booking',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}