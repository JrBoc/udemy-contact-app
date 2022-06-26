<?php

if (! function_exists('user')) {
    function user(): \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null
    {
        return auth()->user();
    }
}
