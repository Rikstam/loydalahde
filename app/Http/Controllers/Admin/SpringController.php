<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Spring;
use App\Http\Requests\SpringRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SpringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $springs = Spring::orderBy('title','asc')->get();

        return view('admin.springs.index', compact('springs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.springs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SpringRequest  $request
     * @return Response
     */
    public function store(SpringRequest $request)
    {
        $spring = new Spring();

        $spring->title = $request->get('title');
        $spring->alias = $request->get('alias');
        $spring->status = $request->get('status');
        $spring->tested_at = $request->get('tested_at') ? $request->get('tested_at') : null ;
        $spring->description = $request->get('description');
        $spring->short_description = $request->get('short_description');
        $lat = $request->get('latitude');
        $lng = $request->get('longitude');
        $spring->latitude = $lat;
        $spring->longitude = $lng;
        $spring->visibility = $request->get('visibility');

        $spring->save();

        //$imageName = $spring->id . '.' .
          //  $request->file('image')->getClientOriginalExtension();


        //$request->file('image')->move(
          //  base_path() . '/public/img/springs/', $imageName
        //);

        return redirect('admin/springs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $spring = Spring::findOrFail($id);

        //dd($spring);

        return view('admin.springs.edit', compact('spring'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(SpringRequest $request, $id)
    {
        $spring = Spring::findOrFail($id);

        $spring->title = $request->get('title');
        $spring->alias = $request->get('alias');
        $spring->slug = $request->get('slug');
        $spring->status = $request->get('status');
        $spring->tested_at = $request->get('tested_at') ? $request->get('tested_at') : null ;
        $spring->description = $request->get('description');
        $spring->short_description = $request->get('short_description');

        if ($request->get('latitude') &&  $request->get('longitude')) {
            $lat = $request->get('latitude');
            $lng = $request->get('longitude');
            $spring->latitude = $lat;
            $spring->longitude = $lng;
        }

        $spring->visibility = $request->get('visibility');

        $spring->save();

        if ( $request->hasFile('image') ) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('public')->put($spring->slug . '.' . $extension, File::get($file));

            $spring->image = $spring->slug . '.' . $extension;

            $spring->save();
        }


        return redirect('admin/springs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
