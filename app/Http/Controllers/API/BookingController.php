<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twilio\Rest\Client;
use Validator;
use App\Booking as Mymodel;

class BookingController extends ApiController {

    public function store(Request $request) {
//        dd(implode(',',\App\Currency::get()->pluck('id')->toArray()));
        $rules = ['model_type' => 'required|in:events,class_schedules,trainer_users'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        $rules = ['model_id' => 'required|exists:' . $request->model_type . ',id'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            if (Mymodel::where('model_id', $request->model_id)->where('model_type', $request->model_type)->where('created_by', \Auth::id())->get()->isEmpty() !== true)
                return parent::error('Booking already in place');
            $input = $request->all();
            $model = Mymodel::create($input);
            return parent::successCreated(['message' => 'Created Successfully', 'booking' => $model]);
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }

    public function getitems(Request $request) {
        $rules = ['limit' => ''];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            $model = new Mymodel;
            $model = $model->select('id', 'model_type', 'model_id', 'payment_status', 'created_by')->where('created_by', \Auth::id())->orderBy('id', 'desc');
            $perPage = isset($request->limit) ? $request->limit : 20;
            return parent::success($model->paginate($perPage));
        } catch (\Exception $ex) {

            return parent::error($ex->getMessage());
        }
    }

}
