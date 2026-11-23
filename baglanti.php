<?php
define('DB_PATH', __DIR__ . '/sanat_akimlari.db');

function get_db(): PDO
{
    static $pdo = null;

    return $pdo ??= new PDO('sqlite:' . DB_PATH, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}