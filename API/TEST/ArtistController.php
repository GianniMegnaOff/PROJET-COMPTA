<?php namespace App\Http\Controllers;

use App\Http\Traits\ArtistsImagesTrait;

use Illuminate\Http\Request;
use Config;
use Firebase\JWT\JWT;
use App\Artist;

class ArtistController extends Controller {

    use ArtistsImagesTrait;

    /**
     * Get all artists.
     */
    public function getAllArtists(Request $request)
    {
        $artists = Artist::all();

        foreach ($artists as $artist){
            if ($artist->isPictureFacebook) {
                $artist->picture = $this->getFacebookArtistPicture($artist->idFacebook);
            } else {
                $artist->picture = $this->getArtistPicture($artist->id);
            }
            $artist->cover = $this->getArtistCover($artist->id);
        }

        return $artists;
    }

}
