<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function top_categories()
    {
        $categories = Category::where('top', 1)
                    ->with('courses')
                    ->withCount('courses')
                    ->get();

        return response()->json($categories);
    }
    //ENDS
}
