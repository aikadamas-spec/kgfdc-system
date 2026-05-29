<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'gender',
        'date_of_birth',
        'course_applied',
        'course_type',
        'payment_reference',
        'amount',
        'beem_transaction_id',
        'beem_reference',
        'application_status',
        'form_unlocked',
        'notes',
    ];

    protected $casts = [
        'form_unlocked' => 'boolean',
        'amount'        => 'decimal:2',
        'date_of_birth' => 'date',
    ];

    // ── Scopes ──────────────────────────────────────────────────────────────

    public function scopePendingPayment($query)
    {
        return $query->where('application_status', 'pending_payment');
    }

    public function scopePaid($query)
    {
        return $query->where('application_status', 'paid');
    }

    // ── Helpers ─────────────────────────────────────────────────────────────

    public function isPaid(): bool
    {
        return $this->application_status !== 'pending_payment';
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->application_status) {
            'pending_payment' => 'Inasubiri Malipo',
            'paid'            => 'Amelipa',
            'form_submitted'  => 'Fomu Imewasilishwa',
            'approved'        => 'Amekubaliwa',
            'rejected'        => 'Amekataliwa',
            default           => ucfirst($this->application_status),
        };
    }
}
