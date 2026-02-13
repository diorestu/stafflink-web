<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiAgentController extends Controller
{
    public function chat(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:4000'],
            'max_tokens' => ['nullable', 'integer', 'min:1', 'max:4096'],
            'temperature' => ['nullable', 'numeric', 'min:0', 'max:2'],
        ]);

        $apiKey = (string) config('services.ai_agent.api_key');
        $baseUrl = rtrim((string) config('services.ai_agent.base_url'), '/');
        $model = (string) config('services.ai_agent.model', 'gpt-4o-mini');

        if ($apiKey === '' || $baseUrl === '') {
            return response()->json([
                'message' => 'AI agent credentials are not configured.',
            ], 500);
        }

        try {
            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->timeout(30)
                ->post("{$baseUrl}/chat/completions", [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $validated['message'],
                        ],
                    ],
                    'max_tokens' => $validated['max_tokens'] ?? 150,
                    'temperature' => $validated['temperature'] ?? 0.7,
                ])
                ->throw();

            $payload = $response->json();
            $reply = data_get($payload, 'choices.0.message.content');

            return response()->json([
                'reply' => is_string($reply) ? $reply : null,
                'raw' => $payload,
            ]);
        } catch (\Throwable $e) {
            Log::warning('AI agent chat request failed', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Failed to connect to AI agent.',
            ], 502);
        }
    }
}

