<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads
    |--------------------------------------------------------------------------
    |
    | Raise the temporary upload limit (default is 12MB) so high-resolution
    | photos uploaded through the Filament admin panel do not fail silently.
    */
    'temporary_file_upload' => [
        'disk' => null,        // null = default filesystem disk
        'rules' => ['required', 'file', 'max:51200'], // 50 MB (KB)
        'directory' => null,
        'middleware' => null,
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
        ],
        'max_upload_time' => 5,
        'cleanup' => true,
    ],
];
