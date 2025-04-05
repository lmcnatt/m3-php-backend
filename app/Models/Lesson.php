<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student1_id',
        'student2_id',
        'coach_id',
        'title',
        'notes',
        'dance_style',
        'dance',
        'lesson_date',
        'video',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'lesson_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the primary student for the lesson.
     */
    public function student1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student1_id');
    }

    /**
     * Get the secondary student for the lesson (if it's a partner lesson).
     */
    public function student2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student2_id');
    }

    /**
     * Get the coach for the lesson.
     */
    public function coach(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    /**
     * Get the dance style for the lesson.
     */
    public function danceStyle(): BelongsTo
    {
        return $this->belongsTo(DanceStyle::class, 'dance_style_id');
    }

    /**
     * Get the dance for the lesson.
     */
    public function dance(): BelongsTo
    {
        return $this->belongsTo(Dance::class, 'dance_id');
    }
}
