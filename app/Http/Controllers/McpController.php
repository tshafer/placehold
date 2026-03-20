<?php

namespace App\Http\Controllers;

use App\Services\McpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class McpController extends Controller
{
    public function __invoke(Request $request, McpService $mcp): Response
    {
        if (! in_array($request->method(), ['GET', 'POST'], true)) {
            return response()->json(['error' => 'Method not allowed'], 405);
        }

        $body = $request->getContent();

        // GET with no body: respond with a simple status so the endpoint "works" when hit in a browser
        if ($request->isMethod('GET') && $body === '') {
            return response()->json([
                'mcp' => 'placehold-mcp-server',
                'version' => '1.0.0',
                'message' => 'POST JSON-RPC requests here (initialize, tools/list, tools/call).',
            ], 200);
        }

        if ($body === '') {
            return response()->json(['jsonrpc' => '2.0', 'error' => ['code' => -32700, 'message' => 'Parse error']], 400);
        }

        // Handle NDJSON: first line is often the request
        $firstLine = str_contains($body, "\n") ? strstr($body, "\n", true) : $body;
        $payload = json_decode($firstLine, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['jsonrpc' => '2.0', 'error' => ['code' => -32700, 'message' => 'Parse error']], 400);
        }

        $id = $payload['id'] ?? null;
        $method = $payload['method'] ?? '';
        $params = $payload['params'] ?? [];

        // Notifications (no id) get no response
        if ($id === null && $method !== '') {
            return response('', 204);
        }

        $result = match ($method) {
            'initialize' => $this->initialize($params),
            'tools/list' => $this->toolsList($mcp),
            'tools/call' => $this->toolsCall($mcp, $params),
            default => null,
        };

        if ($result === null) {
            return response()->json([
                'jsonrpc' => '2.0',
                'id' => $id,
                'error' => ['code' => -32601, 'message' => "Method not found: {$method}"],
            ], 200);
        }

        return response()->json([
            'jsonrpc' => '2.0',
            'id' => $id,
            'result' => $result,
        ], 200, ['Content-Type' => 'application/json']);
    }

    private function initialize(array $params): array
    {
        return [
            'protocolVersion' => '2024-11-05',
            'capabilities' => [
                'tools' => (object) [],
            ],
            'serverInfo' => [
                'name' => 'placehold-mcp-server',
                'version' => '1.0.0',
            ],
        ];
    }

    private function toolsList(McpService $mcp): array
    {
        return [
            'tools' => $mcp->tools(),
        ];
    }

    private function toolsCall(McpService $mcp, array $params): array
    {
        $name = $params['name'] ?? '';
        $arguments = $params['arguments'] ?? [];

        if ($name === '') {
            return ['content' => [['type' => 'text', 'text' => 'Missing tool name']], 'isError' => true];
        }

        try {
            return $mcp->call($name, is_array($arguments) ? $arguments : []);
        } catch (\Throwable $e) {
            Log::warning('MCP tools/call error', ['tool' => $name, 'error' => $e->getMessage()]);

            return [
                'content' => [['type' => 'text', 'text' => $e->getMessage()]],
                'isError' => true,
            ];
        }
    }
}
