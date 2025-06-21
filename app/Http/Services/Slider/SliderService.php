<?php


namespace App\Http\Services\Slider;



use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Request;

class SliderService
{


    public function insert($request)
    {
        try {
            $request->except('_token');
            Slider::create($request->all());
            Session::flash('success', 'Slider added successfully.');
        } catch (\Exception $err) {
            Session::flash('error', 'Add Slider Error.');
            \Log::info($err->getMessage());
            return false;
        }

        return true;

    }

    public function get()
    {
        return Slider::orderByDesc('id')->paginate(15);
    }

    public function update($request, $slider)
    {
        try {
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success', 'Slider updated successfully.');
        } catch (\Exception $err) {
            Session::flash('error', 'Update Slider Error.');
            \Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    public function delete($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();
        if ($slider) {
            $slider->delete();
            return true;
        }

        return false;
    }

}
