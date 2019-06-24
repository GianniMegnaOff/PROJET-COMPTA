<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;

use App\Http\Traits\OktaTools;

use Illuminate\Http\Request;

use App\Event\Production\Production;
use App\Event\Production\Lineup;
use App\Event\Production\Deal;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ProductionsController extends Controller
{
    use OktaTools;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idUser, Request $request)
    {
        // Loading user infos
        $user = $request->user();

        // Only Admin can see other user meetings
        if ($idUser != 'me' && $user[0] != 'Admin') {
            return response('Unauthorized.', 401);
        }

        // Be sure having the user name
        if ($idUser == 'me') { $idUser = $user[1]; }

        $productions = $this->userProductions($idUser); //Get them from Okta

        $events = array(); // They're comming ...

        // Load the events in array
        foreach ($productions as $production) {
            $tmp = Production::find($production);
            $tmp['type'] = $tmp->type;
            $tmp['venue'] = $tmp->venue;
            array_push($events, $tmp);
        }

        // Return them to client
        return $events;
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

        // Ask okta for current events and userId
        $productions = $this->userProductions($user[1]);
        $idUser = $this->userId($user[1]);

        //We create an unique reference to link event-lineup-deals
        $characterToChoose = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "Y", "X", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        $uniqueRef = "";
        for ($i=0; $i < 7; $i++) {
            if ($i == 4) {
                $uniqueRef .= "-";
                continue;
            }
            $uniqueRef .= $characterToChoose[rand(0, 34)];
        }
        $newProduction->lineup_reference = $uniqueRef;


        // Add the new event
        $newProduction = Production::create($request->input());

        // Add the new Lineup
        $lineup = new Lineup;
        $lineup->reference = $uniqueRef;
        $lineup->production_id = $newProduction->id;
        $lineup->save();


        // Let save the deals too !
        foreach ($request->input('lineup') as $deal) {
            Deal::create($deal);
        }


        // And link it to Okta profile
        array_push($productions, $newProduction->id);

        $client = new Client(['headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'SSWS 00d0Ew77Vt0UOO-AaOt1PH2Y8YITPjVo728FdkRbdA'
            ]
        ]); //GuzzleHttp\Client

        $response = $client->post('https://dev-936811-admin.oktapreview.com/api/v1/users/' . $idUser, [
            'body' => '{
                "profile": {
                  "productions": ' . json_encode($productions) . '
                }
              }'
        ]);
        $response = json_decode($response->getBody(), true);

        return response('New production created', 201);
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
        $productions = $this->userProductions($user[1]);

        // Check if it's user event
        if (!in_array($id, $productions)) {
            return response("Keep your eyes on your events only ...", 401);
        }

        $event = Production::find($id);
        $event['type'] = $event->type;
        $event['venue'] = $event->venue;
        $event['lineup'] = $event->lineup;

        return $event;
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

        $productions = $this->userProductions($user[1]);

        // Check if it's user event
        if (!in_array($id, $productions)) {
            return response("Keep your eyes on your events only ...", 401);
        }

        // If yes, update it
        $event = Production::find($id);
        $event->title = $request->input('title');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->venue_id = $request->input('venue');
        $event->facebook = $request->input('facebook');
        $event->tickets = $request->input('tickets');
        $event->comment = $request->input('comment');
        // And store it
        $event->save();

        return response("Production updated", 201);
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

        // Be sure having the user name
        if ($idUser == 'me') {
            $idUser = $user[1];
        }

        $productions = $this->userProductions($idUser);

        // Check if it's user event
        if (in_array($id, $productions)) {
            Production::destroy($id);
        } else {
            return response("Keep your eyes on your events only ...", 401);
        }

        return response("Destroied", 201);
    }
}
