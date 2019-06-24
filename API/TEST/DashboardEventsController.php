<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Config;
use Firebase\JWT\JWT;
use App\DashboardEvent;
use App\Deal;
use App\Artist;
use App\Data\Venue;
use App\Lineup;
use App\File;

use App\Http\Traits\AppDatabaseImagesTrait;

class DashboardEventsController extends Controller {

    use AppDatabaseImagesTrait;

    /**
     * Specific function to get a list of all events formatted for fullcalendar.
     */
    public function getAllEventsFullCalendar()
    {
        $events = DB::table('events_personals')->select('id',
                                                        'title',
                                                        'start',
                                                        'end',
                                                        'comment as desc',
                                                        'id as bullet')->get();

        return $events;
    }

    /**
     * Upload specific for megna.
     */
    public function uploadMegna(Request $request)
    {
        return $this->uploadImage($request, 'megna', 'image');
    }
    /**
     * List specific for megna.
     */
    public function listMegna(Request $request)
    {
        return $this->listImageMegna();
    }

    public function deleteImageMegna(Request $request)
    {
        $file = File::where('id', '=', $request->input('id'));
        //Storage::delete('app/database/megnas/'. $file->name . '.' . $file->type);
        //$file->delete;
        return $file;
    }
}
