<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'Project';
    
    public function client () {
        return $this->belongsTo('App\Customer','id_client');
    }
    public function statut () {
        return $this->belongsTo('App\Statut','statut');
    }
     public function deal () {
        return $this->hasMany('App\Deal','id_project');
    }
}
