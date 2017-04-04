<?php

namespace App\Http\Controllers;

use App\Track;
use App\Label;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;
class TrackController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *  
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('tracks.index');
	}

	public function getTracks(){
		$n=Carbon::now();
		$drawings = DB::table('labels')
		           ->join('tracks', 'labels.id', '=', 'tracks.label_id')
		           ->select(['labels.id AS label_id', 'labels.name','tracks.id AS track_id', 'tracks.title']);
		return Datatables::of($drawings)
		    ->make(true);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$labels=[];
		foreach (Label::all() as $label) {
            $labels[$label->id]=$label->name;
        }
		return view('tracks.create',['labels'=>$labels]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$track=new Track();
		$track->title=$request->title;
		$track->release_date=$request->release_date;
		$track->label_id=$request->label_id;
		$track->save();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Track  $track
	 * @return \Illuminate\Http\Response
	 */
	public function show(Track $track)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Track  $track
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Track $track)
	{
		$release_date=Carbon::parse($track->release_date);
		$labels=[];
		foreach (Label::all() as $label) {
            $labels[$label->id]=$label->name;
        }
		return view('tracks.edit',compact('track','release_date','labels'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Track  $track
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Track $track)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Track  $track
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Track $track)
	{
		//
	}
}
