<?php namespace App\Event\Production;

use Illuminate\Database\Eloquent\Model;

class Lineup extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'production_lineups';

    protected $fillable = ['reference', 'production_id'];

    public function production () {
        return $this->belongsTo('App\Event\Production\Production');
    }

    public function deals () {
        return $this->hasMany('App\Event\Production\Deal', 'lineup_reference');
    }

}
