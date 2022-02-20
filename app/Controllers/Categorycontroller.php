<?php
namespace App\Controllers;

use Http\Response;
use App\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    private Category $category_model;

    public function __construct(Category $category)
    {
        $this->category_model = $category;
    }

    /**
     * Get all the bugs according to a category
     *
     * @param string $category_label
     * @return void
     */
    public function bugs(string $category_label)
    {
        $bugs = $this->category_model->findBy('label', $category_label)->bugs();

        return Response::json($bugs);
    }
}