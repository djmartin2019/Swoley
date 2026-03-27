<?php

function get_db() {
    static $pdo;

    if ($pdo === null) {
        $host = 'db';   // Docker service name
        $port = '5432';
        $dbname = 'swoley_db';
        $user = 'postgres';
        $password = 'password';

        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";

        try {
            $pdo = new PDO($dsn, $user, $password);

            // Error handling
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch as associative arrays
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("DB connection failed: " . $e->getMessage());
        }
    }

    return $pdo;
}
