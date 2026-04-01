<?php

class User extends Model
{
    public static function findByUsername(string $username): ?array
    {
        $stmt = self::db()->prepare("
            SELECT * FROM users WHERE username = ?
        ");
        $stmt->execute([$username]);
        return $stmt->fetch() ?: null;
    }

    public static function findById(int $id): ?array
    {
        $stmt = self::db()->prepare("
            SELECT * FROM users WHERE id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
    
    public static function create(
        string $username,
        string $email,
        string $firstName,
        string $lastName,
        string $passwordHash
    ): int {
        $stmt = self::db()->prepare("
            INSERT INTO users (username, email, firstName, lastName, password_hash)
            VALUES (?, ?, ?, ?, ?)
            RETURNING id
        ");
        $stmt->execute([$username, $email, $firstName, $lastName, $passwordHash]);
        return (int) $stmt->fetchColumn();
    }
}