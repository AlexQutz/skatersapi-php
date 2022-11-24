<?php

namespace App\Http\Controllers;

use App\Models\Skater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('skater.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'country' => 'required',
            'sponsors' => 'required',
            'boardWidth' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else
        {
            $skater = new Skater;
            $skater->firstName = $request->input('firstname');
            $skater->lastName = $request->input('lastname');
            $skater->country = $request->input('country');
            $skater->sponsors = $request->input('sponsors');
            $skater->boardWidth = $request->input('boardwidth');
            skater->save();

            return response()->json([
                'status'=>200,
                'message'=>'Added Skater Successfully!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Skater::find($id);
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
        $skater = Skater::find($id);
        $skater->update($request->all());
        return $skater;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Skater::destroy($id);
    }

    /**
     * Search for firstName
     */

    public function searchFirstName($firstName)
    {
        return Skater::where('firstName', 'like' , '%'.$firstName.'%')->get();
    }


    /**
     * Search for lastName
     */

    public function searchLastName($lastName)
    {
        return Skater::where('lastName', 'like' , '%'.$lastName.'%')->get();
    }


}
