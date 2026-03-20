<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('sitemap:generate')->daily()->at('03:00')
    ->description('Regenerate sitemap.xml from routes');

Schedule::command('openapi:generate')->daily()->at('03:05')
    ->description('Regenerate OpenAPI spec from routes');
