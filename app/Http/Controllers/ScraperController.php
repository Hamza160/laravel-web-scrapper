<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Property;
use App\Models\Scraper;
use App\Models\User;
use Illuminate\Http\Request;
use Goutte\Client;

class ScraperController extends Controller
{

    public function index()
    {


        return view('scraper');
    }

    public function PropertyScraper(Request $request)
    {

        $client = new Client();

        $website = $client->request('GET', $request->url);

        $dataArray = (object)[];
        $website->filter('.card__img > img')->each(function ($node) use ($dataArray) {
            $dataArray->image[] = $node->attr('src');
        });

        $website->filter('.card__inner > a')->each(function ($node) use ($dataArray) {
            $dataArray->detail_page[] = 'https://tmcars.info/' . $node->attr('href');
        });

        $website->filter('.card__title')->each(function ($node) use ($dataArray) {
            $dataArray->title[] = $node->text();
        });

        $website->filter('.card__price-number')->each(function ($node) use ($dataArray) {
            $price = $node->text();
            $dataArray->price[] = str_replace(' TMT', '', $price);
        });


        foreach ($dataArray->title as $key => $title) {
            $checkSlug = Car::where('detail_page', $dataArray->detail_page[$key])->first();
            if (is_null($checkSlug)) {
                Car::Create([
                    'title' => $dataArray->title[$key],
                    'image' => $dataArray->image[$key],
                    'detail_page' => $dataArray->detail_page[$key],
                    'price' => $dataArray->price[$key]
                ]);
            }
        }


        return 'true';
    }

    public function PropertyDetailScrapper()
    {
        $slugs = Property::where('property_references', null)->select('slug')->get();
        return view('scraper-detail', compact('slugs'));
    }

    public function UpdatePropertyDetailScrapper(Request $request)
    {
        $client = new Client();

        $website = $client->request('GET', $request->url);

        $dataArray = (object)[];

        // $website->filter('.panel ')->each(function ($node) use ($dataArray) {
        //     $node->children()->each(function ($child) use ($dataArray) {
        //         if ($child->matches('.property-page__sub-title')) {
        //             $dataArray->sub_title[] = $child->text();
        //         }
        //     });
        // });

        // $website->filter('.property-facts')->each(function ($node) use ($dataArray) {

        //     $dataArray->complition_status[] = $node->html();
        // });

        // $website->filter('.property-agent__broker-image-area > a')->each(function ($node) use ($dataArray) {

        //     $dataArray->company_slug[] = 'https://www.propertyfinder.ae' . $node->attr('href');
        // });

        // $website->filter('.property-location__reviews')->each(function ($node) use ($dataArray) {
        //     $dataArray->property_review_link[] = 'https://www.propertyfinder.ae' . $node->attr('href');
        // });

        // $website->filter('.property-agent__detail-area > .property-agent__name')->each(function ($node) use ($dataArray) {
        //     $dataArray->agent_slug[] = 'https://www.propertyfinder.ae' . $node->attr('href');
        // });


        // $website->filter('.property-amenities')->each(function ($node) use ($dataArray) {
        //     $node->children()->each(function ($child) use ($dataArray) {
        //         if ($child->matches('.property-amenities__list')) {
        //             $dataArray->amenities[] = $child->text();
        //         }
        //     });
        // });

        // $website->filter('.property-page__description')->each(function ($node) use ($dataArray) {
        //     $dataArray->property_description[] = $node->html();
        // });

        // $website->filter('.property-page__verified-tag')->each(function ($node) use ($dataArray) {
        //     $dataArray->is_verified[] = $node->text();
        // });

        $website->filter('.property-page__legal-list-area')->each(function ($node) use ($dataArray) {
            $dataArray->property_references[] = $node->html();
        });


        Property::where('slug', $request->url)->update([
            // 'sub_title' => isset($dataArray->sub_title[0]) ? $dataArray->sub_title[0] : '',
            // 'complition_status' => isset($dataArray->complition_status[0]) ? $dataArray->complition_status[0] : '',
            // 'property_review_link' => isset($dataArray->property_review_link[0]) ? $dataArray->property_review_link[0] : '',
            // 'agent_slug' => isset($dataArray->agent_slug[0]) ? $dataArray->agent_slug[0] : '',
            // 'company_slug' => isset($dataArray->company_slug[0]) ? $dataArray->company_slug[0] : '',
            // 'amenities' => isset($dataArray->amenities) ? implode(",", $dataArray->amenities) : '',
            // 'property_description' => isset($dataArray->property_description[0]) ? $dataArray->property_description : '',
            // 'is_verified' => isset($dataArray->is_verified[0]) ? $dataArray->is_verified[0] : '',
            'property_references' => isset($dataArray->property_references[0]) ? $dataArray->property_references[0] : '',
        ]);


        return 'true';
        // return $dataArray;
    }
    public function GetLatestProperty()
    {
        $properties = Property::orderBy('id', 'Desc')->get();
        $html = '';
        foreach ($properties as $key => $prop) {
            $html .= '<tr>
            <td>' . ++$key . '</td>
            <td>' . $prop->slug . '</td>
            </tr>';
        }

        return $html;
    }



    public function ScrapAgents()
    {
        $agnets = Property::GroupBy('agent_slug')->where('agent_slug', '!=', null)->select('agent_slug')->count();
        return $agnets;
        return view('scrap-agents');
    }
}
