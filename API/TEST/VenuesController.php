<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Firebase\JWT\JWT;
use App\DashboardEvent;
use App\Data\Venue\Venue;
use App\Data\Venue\VenueAddress;
use App\Data\Venue\VenueHours;
use App\Data\Venue\VenueType;
use App\Data\Venue\VenueAppVisibility;

class VenuesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $venues = Venue::all();

        return $venues;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $venue = Venue::find($idVenue)->with(['address', 'hours', 'type', 'appVisibility'])->get();

        return $venue;
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

        // Only Admin can update venues
        if ($user[0] != 'Admin') {
            return response('Unauthorized.', 401);
        }


        $venue = Venue::updateOrCreate(['id' => $id], $request->input());

        $venueAddress = VenueAddress::updateOrCreate(['id' => $id], $request->input('address'));
        $venueHours = VenueHours::updateOrCreate(['id' => $id], $request->input('hours'));
        $venueType = VenueType::updateOrCreate(['id' => $id], $request->input('type'));
        $venueAppVisibility = VenueAppVisibility::updateOrCreate(['id' => $id], $request->input('appVisibility'));

        return Venue::find($id)->with(['address', 'hours', 'type', 'appVisibility'])->get();
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

        // Only DA & Admin can create venues
        if (!($user[0] == 'Admin' || $user[0] == 'Artistic Director')) {
            return response('Unauthorized.', 401);
        }

        $venue = Venue::create($request->input());

        $venueAddress = VenueAddress::create($request->input('address'));
        $venueHours = VenueHours::create($request->input('hours'));
        $venueType = VenueType::create($request->input('type'));
        $venueAppVisibility = VenueAppVisibility::create($request->input('appVisibility'));

        $venue->address_id = $venueAddress->id;
        $venue->hours_id = $venueHours->id;
        $venue->type_id = $venueType->id;
        $venue->visibility_id = $venueAppVisibility->id;
        $venue->save();

        return Venue::find($venue->id)->with(['address', 'hours', 'type', 'appVisibility'])->get();
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

        // Only Admin can destroy venues
        if ($user[0] != 'Admin') {
            return response('You are not authorized to perform this action', 401);
        }

        Venue::destroy($id);
        VenueAddress::destroy($id);
        VenueHours::destroy($id);
        VenueType::destroy($id);
        VenueAppVisibility::destroy($id);

        return response("Venue successfully deleted", 201);
    }
}
