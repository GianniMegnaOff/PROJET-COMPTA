<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

// --- Events --- \\
Route::apiResource('v1/events/personal-events', 'Events\PersonalEventsController')->except(['index']);
Route::apiResource('v1/events/meetings', 'Events\MeetingsController')->except(['index']);
Route::apiResource('v1/events/productions', 'Events\ProductionsController')->except(['index']);

Route::apiResource('v1/events/productions/{idProduction}/deals', 'Events\DealsController');
// --- End events --- \\

// --- Users --- \\
Route::get('v1/users/{idUser}/personal-events', 'Events\PersonalEventsController@index');
Route::get('v1/users/{idUser}/meetings', 'Events\MeetingsController@index');
Route::get('v1/users/{idUser}/productions', 'Events\ProductionsController@index');
// --- End events --- \\



// ------ Venues ------ \\
Route::apiResource('v1/database/venues', 'VenuesController');
// --- End Venues --- \\


// --- Artists --- \\
Route::get('v1/artists', 'ArtistController@getAllArtists');
Route::get('v1/artist/{idArtist}', 'AppController@getArtist');
Route::put('v1/artist/create', 'AppController@createArtist');
Route::put('v1/artist/update', 'AppController@updateArtist');
Route::put('v1/artist/remove', 'AppController@removeArtist');

Route::post('v1/app/database/artist/upload/cover', 'AppController@artistUploadCover');
Route::post('v1/app/database/artist/upload/picture', 'AppController@artistUploadPicture');
// --- End Artists --- \\


// --- Application --- \\
// ------ Festival ------ \\
Route::apiResource('v1/midnightApplication/database/festivals', 'MidnightApp\FestivalsController');

Route::post('v1/app/database/festivals/upload/cover', 'AppController@festivalUploadCover');
Route::post('v1/app/database/festivals/upload/picture', 'AppController@festivalUploadPicture');
// ------ End Festival ------ \\

// ------ Events ------ \\
Route::apiResource('v1/midnightApplication/database/events', 'MidnightApp\EventsController');

Route::post('v1/app/database/events/upload/cover', 'AppController@eventUploadCover');
Route::post('v1/app/database/events/upload/picture', 'AppController@eventUploadPicture');
// ------ End Events ------ \\

// ------ Clubs ------ \\
Route::apiResource('v1/midnightApplication/database/clubs', 'MidnightApp\ClubsController');

Route::post('v1/app/database/clubs/upload/cover', 'AppController@clubUploadCover');
Route::post('v1/app/database/clubs/upload/picture', 'AppController@clubUploadPicture');
// ------ Clubs ------ \\

// ------ Artists ------ \\
Route::get('v1/app/database/artists', 'AppController@getAllArtists');
Route::get('v1/app/database/artist/{idArtist}', 'AppController@getArtist');
Route::put('v1/app/database/artist/create', 'AppController@createArtist');
Route::put('v1/app/database/artist/update', 'AppController@updateArtist');
Route::put('v1/app/database/artist/remove', 'AppController@removeArtist');

Route::post('v1/app/database/artist/upload/cover', 'AppController@artistUploadCover');
Route::post('v1/app/database/artist/upload/picture', 'AppController@artistUploadPicture');
// ------ Artists ------ \\
// --- Application --- \\

// --- Warmup --- \\
Route::get('v1/warmup/all', 'WarmupController@getAllParticipations');
Route::get('v1/warmup/{idWarmup}', 'WarmupController@getParticipation');
Route::put('v1/warmup/shortlist', 'WarmupController@shortlist');
// --- End Warmup --- \\



// --- Megna Project ---
Route::post('v1/megna/upload/file', 'DashboardEventsController@uploadMegna');
Route::post('v1/megna/list/file', 'DashboardEventsController@listMegna');
Route::post('v1/megna/list/file/delete', 'DashboardEventsController@deleteImageMegna');
