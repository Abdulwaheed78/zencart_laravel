<?php

use App\Models\Category;

use Illuminate\Support\Collection;

function getCategories()
{


    return Category::orderBy('name', 'DESC')
        ->where('status', 1)
        ->orderBy('id', 'DESC')
        ->where('showHome', 'Yes')
        ->get();
}
