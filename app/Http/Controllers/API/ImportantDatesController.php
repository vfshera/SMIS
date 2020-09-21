<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImportantDatesResource;
use App\ImportantDate;
use Illuminate\Http\Request;

class ImportantDatesController extends Controller
{
    public function index(){
        return ImportantDatesResource::collection(ImportantDate::orderBy('occur_date' , 'DESC')->paginate(6));
    }

    public function create()
    {
        $data = \request()->validate([
            'title' => 'required',
            'occur_date' => 'required',
            'occur_time' => 'required'
        ]);

       if( ImportantDate::create($data) ){
           return response('Important Date Created' , 201 );
       }else{
           return response('Failde To Add The Important Date' , 406 );
       }

    }

    public function update()
    {
          if(\request()->has('id')){
              $data = \request()->validate([
                  'title' => 'required',
                  'occur_date' => 'required',
                  'occur_time' => 'required'
              ]);
                $important = ImportantDate::findOrFail(\request()->id);

                  if( $important->update($data) ){
                      return response('Important Date Updated' , 200 );
                  }else{
                      return response('Failde To Update The Important Date' , 406 );
                  }
          }else{
              return response('ID NOT FOUND' , 403 );
          }
    }


    public function destroy($id)
    {
        ImportantDate::findOrFail($id)->delete();
    }
}
