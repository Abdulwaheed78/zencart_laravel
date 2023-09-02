<?php

use App\Models\Category;

use Illuminate\Support\Collection;

function getCategories()
{


    return Category::orderBy('name', 'DESC')
        ->with(['sub_category' => function ($query) {
            // Add conditions to the sub_category relationship query
            $query->where('status', 1)
                ->where('showHome', 'Yes');
        }])
        ->where('status', 1)
        ->orderBy('id','DESC')
        ->where('showHome', 'Yes')
        ->get();
}
