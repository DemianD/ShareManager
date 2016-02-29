<?php namespace App\ShareManager;

use App\Guruwatch;
use App\ShareManager\GuruWatch\XMLParser;
use Carbon\Carbon;
use App\Share;

class GuruwatchApi {

    public function storeAdvices(Share $share)
    {
        $share->guruwatches()->delete();
        $data = XMLParser::getXMLDataInArray('http://www.guruwatch.nl/rss/adviezen.aspx?issueid='.$share->guruwatch);

        foreach($data->channel->item as $e)
        {
           $share->guruwatches()->save(
               $this->makeRecord($e)
           );
        }
    }

    private function makeRecord($e)
    {
        return new Guruwatch(
            ['title' => $e->title, 'description' => $e->description, 'link' => $e->link, 'pubDate' => new Carbon($e->pubDate)]
        );
    }
}