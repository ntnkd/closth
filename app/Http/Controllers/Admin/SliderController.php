<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\SliderRequest;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ValidatesRequests;

    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        return view('admin.slider.list',[
            'title' => 'List Slider',
            'sliderList' => $this->slider->get(),
        ]);
    }
    public function create()
    {
        return view('admin.slider.add', [
            'title' => 'Add Slider',
            'sliders' => $this->slider->get(),
        ]);
    }
    public function store(SliderRequest $request)
    {
        $this->slider->insert($request);

        return redirect()->back();
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.edit', [
            'title' => 'Edit Slider',
            'slider' => $slider,
        ]);
    }

    public function update(SliderRequest $request, Slider $slider)
    {
        $result = $this->slider->update($request, $slider);
        if ($result) {
            return redirect('/admin/slider/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->slider->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Delete slider successfully!'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }

}
