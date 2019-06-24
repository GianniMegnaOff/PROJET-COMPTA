<?php namespace App\Data\Festival;

use Illuminate\Database\Eloquent\Model;

class Festival extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'data_festivals';

    protected $fillable = ['idFacebook', 'name', 'website', 'facebook_event', 'facebook_page', 'phone', 'email', 'description', 'tickets', 'lineup', 'comment'];

    public function address () {
        return $this->belongsTo('App\Data\Festival\FestivalAddress');
    }
    public function dates () {
        return $this->belongsTo('App\Data\Festival\FestivalDates');
    }
    public function appVisibility () {
        return $this->belongsTo('App\Data\Festival\FestivalAppVisibility', 'visibility_id');
    }

}
