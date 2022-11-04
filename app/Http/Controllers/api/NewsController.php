<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = array(
            'Content-Type' => 'application/json; charset=utf-8'
        );
        $new=News::all();
        return response()->json($new, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $headers = array(
            'Content-Type' => 'application/json; charset=utf-8'
        );
        $storagePath = News::put('/public', $request['image']);
        $fileName = basename($storagePath);
        $request['image'] = $fileName;
        $new=News::create($request);
        return response()->json($new, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headers = array(
            'Content-Type' => 'application/json; charset=utf-8'
        );
        return response()->json(News::find($id), 200, $headers, JSON_UNESCAPED_UNICODE);
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
        $headers = array(
            'Content-Type' => 'application/json; charset=utf-8'
        );
        $new = News::find($id);
        $new->update($request->all());
        return response()->json($new, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return News::destroy($id);
    }
}
