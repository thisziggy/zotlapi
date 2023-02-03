<?php

namespace App\Http\Controllers;
use App\Models\Team;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = DB::table('teams')->where('user_id', $request->user()->id)
                    ->join('bookings', 'bookings.id', '=', 'booking_id')
                    ->select(array('teams.*', 'teams.status AS crew_status', 'bookings.name', 'bookings.location', 'bookings.date'));

                    $bookings = $query->get();

        return $bookings;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Team::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $affected = DB::table('teams')
              ->where('id', $id)
              ->update(['status' => 2]);
    }

    public function accept(Request $request)
    {
        $affected = DB::table('teams')
              ->where('id', $request->booking_id)
              ->update(['status' => 2]);

        return $affected;
    }

    public function reject(Request $request)
    {
        $affected = DB::table('teams')
              ->where('id', $request->booking_id)
              ->update(['status' => 3]);

        return $affected;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
