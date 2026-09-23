<?php

// Pastikan folder cache dan view Laravel di /tmp tersedia
$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($dirs as $dir) {
    if (! is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Forward request Vercel Serverless ke Laravel public/index.php
require __DIR__.'/../public/index.php';
