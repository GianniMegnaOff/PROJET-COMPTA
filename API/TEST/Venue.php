<?php namespace App\Data\Venue;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'data_venues';

    protected $fillable = ['idFacebook', 'name', 'website', 'facebook_page', 'phone', 'email', 'description', 'comment'];

    public function address () {
        return $this->belongsTo('App\Data\Venue\VenueAddress');
    }
    public function hours () {
        return $this->belongsTo('App\Data\Venue\VenueHours');
    }
    public function type () {
        return $this->belongsTo('App\Data\Venue\VenueType');
    }
    public function appVisibility () {
        return $this->belongsTo('App\Data\Venue\VenueAppVisibility', 'visibility_id');
    }

}
