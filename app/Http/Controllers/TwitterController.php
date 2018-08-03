<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Thujohn\Twitter\Facades\Twitter;

class TwitterController extends Controller
{
    private $count = 10;
    private $format = 'array';

    public function twitterUserTimeLine()
    {
        $data = Twitter::getUserTimeLine(['count' => $this->count, 'format' => $this->format]);
        return view('twitter')->with('data', $data);
    }

    public function tweet(Request $request)
    {
        $this->validate($request, [
            'tweet' => 'required',
        ]);

        $newTweet = ['status' => $request->tweet];

        if (!empty($request->images)) {
            foreach ($request->images as $key => $value) {
                $uploadMedia = Twitter::uploadMedia(['media' => File::get($value->getRealPath())]);
                if (!empty($uploadMedia)) {
                    $newTweet['media_ids'][$uploadMedia->media_id_string] = $uploadMedia->media_id_string;
                }

            }
        }

        $twitter = Twitter::postTweet($newTweet);
        return back();
    }
}
