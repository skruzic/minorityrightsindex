<?php

namespace App\Http\Controllers\Api;

use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __invoke($slug): JsonResponse
    {
        $page = Page::findBySlugOrFail($slug);

        return response()->json($page);
    }
}
