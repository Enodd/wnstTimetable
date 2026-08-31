<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Description;
use App\Models\Group;
use App\Models\Mainpage;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Throwable;

class LandingPageController extends Controller
{
    /**
     * @throws Throwable
     */
    public function index(Request $request)
    {
        $pageContent = Mainpage::all(['sHtml'])->first();
        $description = Description::all(['name', 'year', 'semes'])->first();
        $favoriteTimetables = $this->resolveFavoriteTimetables($request);

        $replacements = [
            '{title}' => "<div class='my-2'>
                $description->name <br/> $description->year <br/> $description->semes</div>
            ",
            '{search}' => view('partials.landingPage.search', [
                'favoriteTimetables' => $favoriteTimetables,
            ])->render(),
            '<br />' => '',
            '<br>' => ''
        ];

        $content = strtr($pageContent->sHtml, $replacements);

        return view('landingPage', [
            'content' => $content
        ]);
    }

    private function resolveFavoriteTimetables(Request $request): Collection
    {
        $favorites = $this->parseFavoriteUrls($request)
            ->map(function (string $url) {
                $path = parse_url($url, PHP_URL_PATH);

                if (
                    !is_string($path) ||
                    !preg_match('#^/timetable/(groups|conductors|rooms)/([^/]+)/?$#', $path, $matches)
                ) {
                    return null;
                }

                parse_str((string) parse_url($url, PHP_URL_QUERY), $query);

                return [
                    'url' => $url,
                    'type' => $matches[1],
                    'identifier' => rawurldecode($matches[2]),
                    'all' => filter_var($query['all'] ?? false, FILTER_VALIDATE_BOOL),
                ];
            })
            ->filter()
            ->values();

        $conductors = Conductor::query()
            ->whereIn('id', $favorites->where('type', 'conductors')->pluck('identifier')->map(fn ($id) => (int) $id))
            ->get()
            ->keyBy(fn (Conductor $conductor) => (string) $conductor->id);

        $singleGroups = Group::query()
            ->whereIn('id', $favorites->where('type', 'groups')->where('all', false)->pluck('identifier')->map(fn ($id) => (int) $id))
            ->get()
            ->keyBy(fn (Group $group) => (string) $group->id);

        $groupTrees = Group::query()
            ->whereIn('id_group_tree', $favorites->where('type', 'groups')->where('all', true)->pluck('identifier')->map(fn ($id) => (int) $id))
            ->orderBy('id')
            ->get()
            ->groupBy(fn (Group $group) => (string) $group->id_group_tree);

        $rooms = Room::query()
            ->whereIn('nr_room', $favorites->where('type', 'rooms')->pluck('identifier'))
            ->get()
            ->keyBy('nr_room');

        return $favorites
            ->map(function (array $favorite) use ($conductors, $singleGroups, $groupTrees, $rooms) {
                $label = match ($favorite['type']) {
                    'conductors' => $conductors->get($favorite['identifier'])?->getFullTitle(),
                    'groups' => $favorite['all']
                        ? $groupTrees->get($favorite['identifier'])?->pluck('shortcut')->implode(', ')
                        : $singleGroups->get($favorite['identifier'])?->getDescription(),
                    'rooms' => $rooms->get($favorite['identifier'])?->getDescription(),
                };

                return $label ? ['url' => $favorite['url'], 'label' => trim($label)] : null;
            })
            ->filter()
            ->values();
    }

    private function parseFavoriteUrls(Request $request): Collection
    {
        $cookie = $request->cookie('favorite_timetables');

        if (!is_string($cookie)) {
            return collect();
        }

        $urls = json_decode($cookie, true);

        if (!is_array($urls)) {
            $urls = json_decode(rawurldecode($cookie), true);
        }

        return collect(is_array($urls) ? $urls : [])
            ->filter(fn ($url) => is_string($url) && str_starts_with($url, '/timetable/'))
            ->unique()
            ->take(10)
            ->values();
    }
}
