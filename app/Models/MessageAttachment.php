<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    /**
     * Get the message
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    /**
     * Get full URL for the file
     */
    public function getFullUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Check if file is an image
     */
    public function getIsImageAttribute()
    {
        return $this->file_type && str_starts_with($this->file_type, 'image/');
    }

    /**
     * Get formatted file size
     */
    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get file icon based on type
     */
    public function getFileIconAttribute()
    {
        if (!$this->file_type) {
            return 'fas fa-file';
        }

        if ($this->is_image) {
            return 'fas fa-image';
        }

        $mimeTypes = [
            'application/pdf' => 'fas fa-file-pdf',
            'application/msword' => 'fas fa-file-word',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fas fa-file-word',
            'application/vnd.ms-excel' => 'fas fa-file-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fas fa-file-excel',
            'text/plain' => 'fas fa-file-alt',
            'text/csv' => 'fas fa-file-csv',
        ];

        return $mimeTypes[$this->file_type] ?? 'fas fa-file';
    }
}
