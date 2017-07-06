<?php

namespace App\Http\Controllers\Api;

use App\Models\Discussion;
use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function query(Request $request)
    {
        $query = $request->query('q');
        if (! is_null($query))
        {
            $discussions = Discussion::with('user')
                ->select('id', 'title', 'body', 'slug', 'user_id')
                ->where('title', 'like', "%{$query}%")
                ->orWhere('slug', 'like', "%{$query}%")
                ->limit(25)
                ->get();

            $links = Link::select('title', 'url')
                ->where('title', 'like', "%{$query}%")
                ->limit(12)
                ->get();

            return compact('discussions', 'links');
        }

        return [
            'message' => 'No results...',
        ];
    }
}
