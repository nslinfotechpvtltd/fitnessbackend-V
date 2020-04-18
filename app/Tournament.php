<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Tournament extends Model {

    use LogsActivity;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tournaments';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'image', 'price', 'description', 'location', 'start_date', 'end_date', 'rules', 'privacy_policy', 'state', 'prize_name', 'prize_image'];

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName) {
        return __CLASS__ . " model has been {$eventName}";
    }

    protected $appends = array('IsEnrolled');

    public function getIsEnrolledAttribute() {
        $model = EnrollTournaments::where('tournament_id', $this->id)->where('customer_id', \Auth::id())->get();
        if ($model->isEmpty() !== true):
            return 'true';
        else:
            return 'false';
        endif;
    }

}
