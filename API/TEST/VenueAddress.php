<?php namespace App\Data\Venue;

use Illuminate\Database\Eloquent\Model;

class VenueAddress extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'data_venues_address';

    protected $fillable = ['address', 'zip_code', 'city', 'country', 'latitude', 'longitude'];

    public function venue () {
        return $this->hasOne('App\Data\Venue\Venue');
    }

}
