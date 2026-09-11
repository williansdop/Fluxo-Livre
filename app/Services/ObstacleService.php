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
}