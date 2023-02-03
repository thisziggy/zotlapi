<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Booking::all();
        $bookings = Booking::all();
        $booking_team = array();
        $count = 0;
        foreach ($bookings as $key => $value) {
            
            $team = DB::table('teams')->where('booking_id', $value['id'])
                    ->join('users', 'teams.user_id', '=', 'users.id')
                    ->get(array('teams.*', 'users.name'));
                array_push($booking_team, $value);
                $booking_team[$count]['team'] = $team;
                $count++;
        };

        return $booking_team;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required | unique:bookings,name',
        //     'type' => 'required',
        //     'location' => 'required',
        //     'status' => 'required',
        //     'date' => 'required'
        // ]);

        return Booking::create($request->all());
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'service' => 'required',
            'location' => 'required',
            'status' => 'required',
            'date' => 'required'
        ]);

        return Booking::create($request->all());
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
        //
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
