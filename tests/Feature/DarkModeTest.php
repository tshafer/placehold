<?php

it('toggles dark mode and sets a cookie', function () {
    $response = $this->post('/toggle-dark-mode');

    $response->assertRedirect();
    $response->assertCookie('darkMode');
});

it('redirects back when toggling dark mode', function () {
    $response = $this->from('/about-us')->post('/toggle-dark-mode');

    $response->assertRedirect('/about-us');
});
