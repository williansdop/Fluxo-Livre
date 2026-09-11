<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateObstacleRequest;
use App\Models\Obstacle;
use App\Services\ObstacleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ObstacleController extends Controller
{
    public function createObstacle(CreateObstacleRequest $request, ObstacleService $obstacleService): JsonResponse
    {
        try{
            Log::info("Obstacle creation: Beginning execution.");

            $userId = $request->user()->id;
            $obstacleData = $request->validated();
            $obstacleData['user_id'] = $userId;
            $obstacle = $obstacleService->createObstacle($obstacleData);

            $returnData = [
                'id' => $obstacle->id,
                'title' => $obstacle->title
            ];
            $message = "Obstáculo criado com sucesso com id {$obstacle->id}";

            return $this->jsonResponse(true, $returnData, $message, 201);
        } catch (Throwable $e) {
            Log::error('Registration failed: ' . $e->getMessage(), ['exception' => $e]);

            return $this->jsonResponse(
                false,
                null,
                'Ocorreu um erro inesperado durante a criação do obstáculo.',
                500
            );
        }
    }
}