<?php namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Traits\OktaTools;

use App\Event\Production\Production;
use App\Event\Production\Lineup;
use App\Event\Production\Deal;

class DealsController extends Controller {

    use OktaTools;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $idProduction)
    {
        //Check if the user has rights to get thise deal
        $user = $request->user();
        $productions = $this->userProductions($user[1]);

        if (!in_array($idProduction, $productions)) {
            return response("Keep your eyes on your events only ...", 401);
        }

        $production = Production::find($idProduction);
        $deals = Deal::where('lineup_reference', $production->lineup_reference)->with(['artist'])->get();

        return $deals;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idProduction)
    {
        //Check if the user has rights to get thise deal
        $user = $request->user();
        $productions = $this->userProductions($user[1]);

        if (!in_array($idProduction, $productions)) {
            return response("Keep your eyes on your events only ...", 401);
        }

        $deal = Deal::create($request->input());

        $deal->load('artist');

        return $deal->refresh();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $idProduction, $id)
    {
        //Check if the user has rights to get thise deal
        $user = $request->user();
        $productions = $this->userProductions($user[1]);

        if (!in_array($idProduction, $productions)) {
            return response("Keep your eyes on your events only ...", 401);
        }

        return Deal::find($id);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idProduction, $id)
    {
        //Check if the user has rights to get thise deal
        $user = $request->user();
        $productions = $this->userProductions($user[1]);

        if (!in_array($idProduction, $productions)) {
            return response("Keep your eyes on your events only ...", 401);
        }

        $deal = Deal::updateOrCreate(['id' => $id], $request->input());

        return $deal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $idProduction, $id)
    {
        //Check if the user has rights to get thise deal
        $user = $request->user();
        $productions = $this->userProductions($user[1]);

        if (!in_array($idProduction, $productions)) {
            return response("Keep your eyes on your events only ...", 401);
        }

        $deleted = Deal::destroy($id);

        return response()->json();
    }

}
