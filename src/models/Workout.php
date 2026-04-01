<?php

class Workout extends Model
{
    public static function findForUser(int $id, int $userId): ?array 
    {
        $stmt = self::db()->prepare("
            SELECT * FROM workouts
            WHERE id = ? AND user_id = ?
        ");
        $stmt->execute([$id, $userId]);
        return $stmt->fetch() ?: null;
    }

    public static function allForUser(int $userId): array
    {
        $stmt = self::db()->prepare("
            SELECT * FROM workouts
            WHERE user_id = ?
            ORDER BY workout_date DESC        
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll() ?: [];
    }

    public static function create(int $userId, string $title, string $date): int
    {
        $stmt = self::db()->prepare("
            INSERT INTO workouts (user_id, title, workout_date)
            VALUES (?, ?, ?)
            RETURNING id
        ");
        $stmt->execute([$userId, $title, $date]);
        return (int) $stmt->fetchColumn();
    }
}