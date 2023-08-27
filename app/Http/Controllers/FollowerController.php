<?php

namespace App\Http\Controllers;

use App\Http\Resources\FollowerResource;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class FollowerController extends Controller
{
    /**
     * Display Followers of user
     */
    public function followers(): Response
    {
        $user = Auth::user();
        return Inertia::render('Followers/Index', [
            'followers' => FollowerResource::collection($user->followers()->get())
        ]);
    }
}
