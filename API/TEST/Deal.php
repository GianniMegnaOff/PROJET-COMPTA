<?php namespace App\Event\Production;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'production_deals';

    protected $fillable = ['lineup_reference', 'artist_id', 'start', 'end', 'price', 'formule_id', 'comment'];

    public function lineup () {
        return $this->belongsTo('App\Event\Production\Lineup');
    }

    public function artist () {
        return $this->belongsTo('App\Data\Artist');
    }

}
