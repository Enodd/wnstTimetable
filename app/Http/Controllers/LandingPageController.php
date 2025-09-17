<?php

namespace App\Http\Controllers;

use App\Models\Description;
use App\Models\Mainpage;
use Throwable;

class LandingPageController extends Controller
{
    /**
     * @throws Throwable
     */
    public function index()
    {
        $pageContent = Mainpage::all(['sHtml'])->first();
        $description = Description::all(['name', 'year', 'semes'])->first();

        $replacements = [
            '{title}' => "<div class='my-2'>$description->name <br/> $description->year <br/> $description->semes</div>",
            '{search}' => view('partials.landingPage.search')->render(),
        ];

        $content = strtr($pageContent->sHtml, $replacements);

        return view('landingPage', [
            'content' => $content
        ]);
    }

}
