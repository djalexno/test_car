<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CustomerCategory;
use App\Models\InUse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function cars(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_start' => 'required|string|max:255',
            'date_end' => 'required|string|max:255',
            'model' => 'string|max:255',
            'category' => 'string|max:255',
        ]);
        if (!$validator->validate()) {
            return $validator->errors();
        }
        if (Auth::guard('customers')) {
            if($categories = CustomerCategory::where('post_id', Auth::guard('customers')->user()->post_id)->get()) {

                $cars = Car::whereIn('category_id', $categories->category_id)->with('in_use');
                    $cars = $cars->whereRelation('in_use', 'date_start', '>', Carbon::createFromFormat('Y-m-d H:i:s', $request->date_start . ' 00:00:01')->toDateTimeString());
                    $cars = $cars->whereRelation('in_use', 'date_end', '<', Carbon::createFromFormat('Y-m-d H:i:s', $request->date_end . ' 23:59:59')->toDateTimeString());

                    if ($request->has('model')) {
                        $cars = $cars->where('model', $request->model);
                    }
                    if ($request->has('category')) {
                        $cars = $cars->whereRelation('category', 'category_id', $request->category);
                    }

                    if($cars = $cars->get()){
                        return response($cars);
                    }else{
                        return response('Автомобиль не найден!');
                    }
            }
        }
        else{return response('Пользователь не авторизован!');}
    }
}
