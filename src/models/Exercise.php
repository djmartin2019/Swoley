<?php

class Exercise extends Model
{
    public static function findByWorkout(int $workoutId): array
    {
        $stmt = self::db()->prepare("
            SELECT * FROM exercises
            WHERE workout_id = ?
            ORDER BY id ASC
        ");
        $stmt->execute([$workoutId]);
        return $stmt->fetchAll() ?: [];
    }

    public static function create(int $workoutId, string $name): int
    {
        $stmt = self::db()->prepare("
            INSERT INTO exercises (workout_id, name)
            VALUES (?, ?)
            RETURNING id
        ");
        $stmt->execute([$workoutId, $name]);
        return (int) $stmt->fetchColumn();
    }

    public static function findForUser(int $exerciseId, int $userId): ?array
    {
        $stmt = self::db()->prepare("
            SELECT e.*, w.user_id
            FROM exercises e
            JOIN workouts w ON e.workout_id = w.id
            WHERE e.id = ? AND w.user_id = ?
        ");
        $stmt->execute([$exerciseId, $userId]);
        return $stmt->fetch() ?: null;
    }
}