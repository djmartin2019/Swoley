<?php

class Set extends Model
{
    public static function findByExercises(array $exerciseIds): array
    {
        if (empty($exerciseIds)) return [];

        $placeholders = implode(',', array_fill(0, count($exerciseIds), '?'));
        $stmt = self::db()->prepare("
            SELECT * FROM sets
            WHERE exercise_id IN ($placeholders)
            ORDER BY id ASC
        ");
        $stmt->execute($exerciseIds);
        
        $grouped = [];
        foreach ($stmt->fetchAll() as $set) {
            $grouped[$set['exercise_id']][] = $set;
        }
        return $grouped;
    }

    public static function create(int $exerciseId, int $reps, int $weight): void
    {
        $stmt = self::db()->prepare("
            INSERT INTO sets (exercise_id, reps, weight)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$exerciseId, $reps, $weight]);
    }
}