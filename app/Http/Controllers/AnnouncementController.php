<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;

class AnnouncementController extends Controller
{
    public function index()
    {
        return Inertia::render('AnnouncementPage');
    }
}
