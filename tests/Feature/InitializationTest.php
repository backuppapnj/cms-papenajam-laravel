<?php

test('homepage loads', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('assets are reachable', function () {
    // Check if the page contains the asset link or title
    $this->get('/')->assertSee('Laravel');
});
