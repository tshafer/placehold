<?php

use function Pest\Laravel\get;
use function Pest\Laravel\postJson;

it('responds to GET /mcp with status when no body', function () {
    $response = get('/mcp');

    $response->assertOk()
        ->assertJsonPath('mcp', 'placehold-mcp-server')
        ->assertJsonPath('version', '1.0.0');
});

it('responds to MCP initialize', function () {
    $response = postJson('/mcp', [
        'jsonrpc' => '2.0',
        'id' => 1,
        'method' => 'initialize',
        'params' => ['protocolVersion' => '2024-11-05', 'clientInfo' => ['name' => 'test', 'version' => '1.0']],
    ]);

    $response->assertOk()
        ->assertJsonPath('result.serverInfo.name', 'placehold-mcp-server')
        ->assertJsonPath('result.capabilities.tools', []);
});

it('responds to MCP tools/list', function () {
    $response = postJson('/mcp', [
        'jsonrpc' => '2.0',
        'id' => 2,
        'method' => 'tools/list',
    ]);

    $response->assertOk();
    $tools = $response->json('result.tools');
    expect($tools)->toBeArray();
    $names = array_column($tools, 'name');
    expect($names)->toContain('placehold_image', 'placehold_quote', 'placehold_joke', 'placehold_uuid', 'placehold_colors', 'placehold_weather', 'placehold_avatar', 'placehold_qr', 'placehold_json_users');
});

it('responds to MCP tools/call for placehold_quote', function () {
    $response = postJson('/mcp', [
        'jsonrpc' => '2.0',
        'id' => 3,
        'method' => 'tools/call',
        'params' => ['name' => 'placehold_quote', 'arguments' => new \stdClass],
    ]);

    $response->assertOk();
    expect($response->json('result.content'))->toBeArray();
    expect($response->json('result.content.0.type'))->toBe('text');
});
