<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function store(Request $request, Url $url)
    {
        $code = $url->short_url($request->long_url);

        return response()->json([
            'short_url' => url('/') . '/' . $code
        ]);
    }

    public function show(Request $request, $code)
    {
        $url = Url::where('code', $code)->first();

        if ($url) {
            return redirect()->away($url->url);
        } else {
            abort(404);
        }

    }
}
