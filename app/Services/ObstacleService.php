<?php

namespace App\Services;

use App\Models\Obstacle;

class ObstacleService
{
    /**
     * Handle incoming obstacle creation requests.
     *
     * @param  array  $obstacleData  The validated registration payload.
     * @return Obstacle
     */
    public function createObstacle(array $obstacleData): Obstacle
    {
        $obstacle = Obstacle::create($obstacleData);
        return $obstacle;
    }

    /**
     * Handle incoming specific obstacle retrieval requests.
     *
     * @param  int  $id
     * @return ?Obstacle
     */
    public function findObstacleWithCategoryAndUser(int $id): ?Obstacle
    {
        $obstacle = Obstacle::with(['category:id,title,icon', 'user:id,first_name,last_name'])->find($id);
        
        return $obstacle;
    }
}