<?php

return [
    'auth' = [
        'key' = getenv('ROOMZ_DROPBOX_KEY'),
        'secret' = getenv('ROOMZ_DROPBOX_SECRET'),
        'name' = getenv('ROOMZ_DROPBOX_NAME'),
        'callback_url' = getenv('ROOMZ_DROPBOX_CALLBACK'),
    ],
];
