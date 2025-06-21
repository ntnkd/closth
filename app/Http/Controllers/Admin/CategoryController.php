<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateFormRequest;
use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Http\Services\Category\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create()
    {
        return view('admin.category.add', [
            'title'=>'Add Category',
            'categories' => $this->categoryService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request)
    {

        $this->categoryService->create($request);
        return redirect()->back();
    }

    public function index()
    {
        return view('admin.category.list', [
            'title'=>'List Category',
            'categories' => $this->categoryService->getAll()
        ]);
    }

    public function show(Category $category)
    {

        return view('admin.category.edit', [
            'title'=>'Edit Category'. $category->name,
            'category' => $category,
            'categories' => $this->categoryService->getAll()
        ]);
    }

    public function update( Category $category , CreateFormRequest $request)
    {
        $this->categoryService->update($category, $request);

        return redirect('/admin/category/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->categoryService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Delete category successfully!'
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
