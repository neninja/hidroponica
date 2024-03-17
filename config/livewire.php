<?php

return [
    'temporary_file_upload' => [
        'disk' => (env('APP_ENV') === 'local' || env('APP_ENV') === 'e2e') ? 'public' : config('filesystems.default'),
    ],
];
