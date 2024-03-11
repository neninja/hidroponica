<?php

return [
    'temporary_file_upload' => [
        'disk' => env('APP_ENV') === 'local' ? 'public' : config('filesystems.default'),
    ],
];
