<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class EventController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('event/list', ['events' => Event::orderBy('start_time')->get()]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('event/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$time = explode(" - ", $request->input('time'));

		$event = new Event;
		$event->name = $request->input('name');
		$event->title = $request->input('title');
		$event->start_time = $time[0];
		$event->end_time = $time[1];
		$event->save();

		$request->session()->flash('success', 'The event was successfully saved!');
		return redirect('events/create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('event/view', ['event' => Event::findOrFail($id)]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('event/edit', ['event' => Event::findOrFail($id)]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$time = explode(" - ", $request->input('time'));

		$event = Event::findOrFail($id);
		$event->name = $request->input('name');
		$event->title = $request->input('tile');
		$event->start_time = $time[0];
		$event->end_time = $time[1];
		$event->save();

		return redirect('events');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$event = Event::find($id);
		$event->delete();

		return redirect('events');
	}

}
