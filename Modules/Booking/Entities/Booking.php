<?php

namespace Modules\BookingModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = ['name', 'gender', 'mobile', 'email', 'departure_date', 'arrival_date', 'adult_number', 'kids_number', 'note', 
	];

    protected $hidden = [
        'trip_id',
    ];
    protected $dates = ['departure_date', 'arrival_date'];
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'booking';

    public function getDepartureDateAttribute() {
        return Carbon::parse($this->attributes['departure_date'])->format('d/m/Y');
    }

    public function setDepartureDateAttribute($date) {
        $this->attributes['departure_date'] = Carbon::parse($date)->toDateTimeString();;
    }

    public function getArrivalDateAttribute() {
        return Carbon::parse($this->attributes['arrival_date'])->format('d/m/Y');
    }

    public function setArrivalDateAttribute($date) {
        $this->attributes['arrival_date'] = Carbon::parse($date)->toDateTimeString();;
    }

    # Relations.
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

}
