<?php

use function Pest\Laravel\get;

it('generates a video placeholder', function () {
    $response = get('/video?w=160&h=120&duration=1&fps=1');

    $response->assertOk()
        ->assertHeader('Content-Type', 'video/mp4');
})->skip(!shell_exec('which ffmpeg'), 'FFmpeg not available');

it('uses default parameters', function () {
    $response = get('/video?duration=1&fps=1&w=64&h=64');

    $response->assertOk();
})->skip(!shell_exec('which ffmpeg'), 'FFmpeg not available');

it('renders the video docs page', function () {
    get('/video-generator')->assertOk();
});
