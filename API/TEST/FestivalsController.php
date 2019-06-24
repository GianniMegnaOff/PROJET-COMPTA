<?php namespace App\Http\Controllers\MidnightApp;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Traits\AppDatabaseImagesTrait;
use App\Http\Traits\OktaTools;

use App\Data\Festival\Festival;
use App\Data\Festival\FestivalAddress;
use App\Data\Festival\FestivalDates;
use App\Data\Festival\FestivalAppVisibility;

class FestivalsController extends Controller {

    use OktaTools;
    use AppDatabaseImagesTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Loading user infos
        $user = $request->user();

        // Only DA & Redactor can list all festivals
        if (!($user[0] == 'Admin' || $user[0] == 'Redactor')) {
            return response("You can't access this ressource", 401);
        }

        $festivals = Festival::whereHas('appVisibility', function ($query) {
            $query->where('available', '>', '0');
        })->with(['address', 'dates', 'appVisibility'])->get();

        foreach ($festivals as $festival) {
            if ($festival->appVisibility->picture_facebook == 1) {
                $festival->picture = $this->getFestivalFacebookPicture($festival->idFacebook);
            } else {
                $festival->picture = $this->getFestivalPicture($festival->id);
            }
        }

        return $festivals;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Loading user infos
        $user = $request->user();

        // Only DA & Redactor can list all festivals
        if (!($user[0] == 'Admin' || $user[0] == 'Redactor')) {
            return response("You can't store this ressource", 401);
        }

        $festival = Festival::create($request->input());

        $festivalAddress = FestivalAddress::create($request->input('address'));
        $festivalDate = FestivalDates::create($request->input('dates'));
        $appVisibility = array_merge($request->input('appVisibility'), ['available' => 1]);
        $festivalAppVisibility = FestivalAppVisibility::create($appVisibility);

        $festival->address_id = $festivalAddress->id;
        $festival->dates_id = $festivalDate->id;
        $festival->visibility_id = $festivalAppVisibility->id;
        $festival->save();

        $festival->load(['address', 'dates', 'appVisibility']);

        if ($festival->picture_facebook) {
            $festival->picture = $this->getFestivalFacebookPicture($festival->idFacebook);
        } else {
            $festival->picture = $this->getFestivalPicture($festival->id);
        }

        return $festival;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // Loading user infos
        $user = $request->user();

        // Only DA & Redactor can list all festivals
        if (!($user[0] == 'Admin' || $user[0] == 'Redactor')) {
            return response("You can't access this ressource", 401);
        }

        $festival = Festival::find($id);
        $festival['address'] = $festival->address;
        $festival['dates'] = $festival->dates;
        $festival['appVisibility'] = $festival->appVisibility;

        if ($festival->appVisibility->available == 0) {
            return response("This festival is not available here !", 401);
        }

        if ($festival['appVisibility']->picture_facebook) {
            $festival->picture = $this->getFestivalFacebookPicture($festival->idFacebook);
        } else {
            $festival->picture = $this->getFestivalPicture($festival->id);
        }
        $festival->cover = $this->getFestivalCover($festival->id);

        return $festival;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Loading user infos
        $user = $request->user();

        // Only DA & Redactor can list all festivals
        if (!($user[0] == 'Admin' || $user[0] == 'Redactor')) {
            return response("You can't access this ressource", 401);
        }

        $festival = Festival::updateOrCreate(['id' => $id], $request->input());
        $festivalAddress = FestivalAddress::updateOrCreate(['id' => $id], $request->input('address'));
        $festivalDate = FestivalDates::updateOrCreate(['id' => $id], $request->input('dates'));
        $festivalAppVisibility = FestivalAppVisibility::updateOrCreate(['id' => $id], $request->input('appVisibility'));

        if ($festivalAppVisibility->picture_facebook) {
            $festival->picture = $this->getFestivalFacebookPicture($festival->idFacebook);
        } else {
            $festival->picture = $this->getFestivalPicture($festival->id);
        }

        $festival['address'] = $festival->address;
        $festival['dates'] = $festival->dates;
        $festival['appVisibility'] = $festival->appVisibility;

        return $festival;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Loading user infos
        $user = $request->user();

        // Only DA & Redactor can list all festivals
        if (!($user[0] == 'Admin' || $user[0] == 'Redactor')) {
            return response("You can't access this ressource", 401);
        }

        $festivalAppVisibility = FestivalAppVisibility::find($id);

        $festivalAppVisibility->available = 0;
        $festivalAppVisibility->visible = 0;
        $festivalAppVisibility->midnight_team_visible = 0;
        $festivalAppVisibility->save();

        return ["status" => 200];
    }

}
