<?php

class Database {
    private static ?PDO $pdo = null;

    public static function connect(): PDO 
    {
        if (self::$pdo === null) {
            $dsn = 'pgsql:host=db;port=5432;dbname=swoley_db';
            self::$pdo = new PDO($dsn, 'postgres', 'password');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return self::$pdo;
    }
}