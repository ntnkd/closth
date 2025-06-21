<?php
namespace App\Http\Services\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class CategoryService
{
    public function getParent()
    {
        return Category::where('parent_id', 0)->get();
    }

    public function getAll()
    {
        return Category::orderByDesc('id')->paginate(20);
    }

    public function create($request)
    {
        try {
            Category::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (int) $request->input('active'),
            ]);
            Session::flash('success', 'Create category successfully!');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;

    }

    public function update($category, $request)
    {
        // $category->fill($request->all());
        if ($request->input('parent_id')!= $category->id) {
            $category->parent_id =(int) $request->input('parent_id');
        }
        $category->name =(string) $request->input('name');
        $category->description =(string) $request->input('description');
        $category->content =(string) $request->input('content');
        $category->active =(int) $request->input('active');
        $category->save();

        Session::flash('success', 'Update category successfully!');
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $category = Category::where('id', $id)->first();
        if ($category) {
            return category::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }
}
