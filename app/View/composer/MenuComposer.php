<?php


namespace App\Http\View\Composers;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\View\View;

class MenuComposer
{
    protected $users;

    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $menus = Category::select('id', 'name', 'parent_id')->where('active', 1)->orderByDesc('id')->get();

        $view->with('menus', $menus);
    }
}
