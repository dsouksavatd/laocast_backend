<?php

return [
    'temporary_file_upload' => [
        'rules' => 'file|mimes:png,jpg,pdf,mp3,mp4|max:52400', // (100MB max, and only pngs, jpegs, and pdfs.)
    ],
];