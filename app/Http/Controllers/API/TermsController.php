<?php

namespace App\Http\Controllers\API;

use App\Term;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TermResource;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::orderBy('created_at' ,'DESC')->get();

        return TermResource::collection($terms);
    }


    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'beginning_on' =>'required|date',
            'ending_on' =>'required|date',
            'status' => 'required|boolean'
        ]);

        if($request->has('id')){
            $trm =  Term::findOrFail($request->input('id'));

            $trm->update($data);

            return json_encode("Term Updated Successfully");

        } else {

            Term::create($data);

             return json_encode("Term Created Successfully");
        }

    }


    public function destroy($id)
    {
        $term = Term::findOrFail($id);

        $term->delete();
    }
}
