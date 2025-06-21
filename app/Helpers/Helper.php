<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function categories($categories, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>'. $category->id .'</td>
                        <td>'. $char . $category->name .'</td>
                        <td>'. self::active($category->active) .'</td>
                        <td>'. $category->updated_at .'</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/category/edit/'. $category->id .'">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('. $category->id .', \'/admin/category/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($categories[$key]);
                $html .= self::categories($categories, $category->id, $char . '--');

            }
        }

        return $html;
    }

    public static function active($acative = 0)
    {
        return $acative == 0 ? '<span class="btn btn-danger btn-xs"> Deactive</span>' :
        '<span class="btn btn-success btn-xs">Active</span>';
    }

    public static function menus($menus, $parent_id=0)
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li class="nav-item">
                        <a class="nav-link" href="/category/'. $menu->id .'-'. \Str::slug($menu->name,'-').'.html">

                            '. $menu->name .'
                        </a>';
                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="nav nav-treeview">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                } else {
                    $html .= '<ul class="nav nav-treeview"></ul>';
                }

                $html .= '</li>
                ';


            }
        }
        return $html;
    }

    public static function isChild($menus, $id)
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }
        return false;
    }

}
