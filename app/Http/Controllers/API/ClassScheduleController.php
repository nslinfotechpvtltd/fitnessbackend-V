<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use App\ClassSchedule as MyModel;

class ClassScheduleController extends ApiController {

    public function getItems(Request $request) {
        $rules = ['search' => '', 'limit' => ''];
        if ($request->date != '')
            $rules += ['date' => 'required|date_format:Y-m-d'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
//         dd();
        try {
            $genderType = ['both'];
            if (User::whereId(\Auth::id())->first()->gender != null)
                $gen = [User::whereId(\Auth::id())->first()->gender];
            $gender = array_merge($genderType, $gen);
            $model = MyModel::where('status', '1');
            $model = $model->select('id', 'class_type', 'start_date', 'end_date', 'repeat_on', 'start_time', 'duration', 'class_id', 'trainer_id', 'cp_spots', 'capacity', 'location_id', 'gender_type');
            $model = $model->whereIn('gender_type', $gender);
            $model = $model->where('class_type', 'one-time');

            if ($request->date == '')
                $model = $model->whereDate('start_date', '=', today()->format('Y-m-d'));
            else
                $model = $model->whereDate('start_date', '=', $request->date);

            $model = $model->with(['locationDetail', 'trainer', 'classDetail']);
            $perPage = isset($request->limit) ? $request->limit : 20;
            if (isset($request->search)) {
                $model = $model->where(function($query) use ($request) {
                    $query->where('name', 'LIKE', "%$request->search%")
                            ->orWhere('description', 'LIKE', "%$request->search%");
                });
            }
            return parent::success($model->paginate($perPage));
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }

    public function getItem(Request $request) {
        $rules = ['id' => 'required|exists:class_schedules,id'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), true);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        // dd($category_id);
        try {
            $model = new Mymodel;
            $model = $model->where('id', $request->id)->with(['locationDetail', 'trainer', 'classDetail']);
            $model = $model->select('id', 'class_type', 'start_date', 'end_date', 'repeat_on', 'start_time', 'duration', 'class_id', 'trainer_id', 'cp_spots', 'capacity', 'location_id');
            return parent::success($model->first());
        } catch (\Exception $ex) {

            return parent::error($ex->getMessage());
        }
    }

}
