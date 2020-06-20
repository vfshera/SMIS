<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RevisionMaterialResource;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    public function uploads(){
        $uploads = Material::orderBy('created_at', 'DESC')->paginate(12);

        return RevisionMaterialResource::collection($uploads);
    }

    public function store(Request $request){
        $request->validate([
            'mydoc' => 'required|file|mimes:zip,rar,doc,docx,pdf,pptx|max:20480',
            'fileType' => 'required|string',
            'title' => 'required|string'
        ]);

        $newFile = $request->file('mydoc');
        $type = $request->fileType;
        $title = $request->title;

        $namewithextension = $newFile->getClientOriginalName();

        //Get the file size in bytes.
        $fileSizeBytes = filesize($newFile);
        //Convert the bytes into MB.
        $fileSizeMB = ($fileSizeBytes / 1024 / 1024);
        //Format it so that only 2 decimal points are displayed.
        $fileSizeMB = number_format($fileSizeMB, 2);

        $name = explode('.', $namewithextension)[0];
        $extension = $newFile->guessExtension(); //Extension 'doc'
        $uploadname = $name . time() . '.' . $extension;

        $mat = new Material();
        $mat->title = $title;
        $mat->owner = auth()->user()->id;
        $mat->filename = $uploadname;
        $mat->size = $fileSizeMB;
        $mat->file_type = $extension;
        $mat->doc_type = $type;

        if( $newFile->storeAs('documents', $uploadname )){

            $mat->save();

            return json_encode(auth()->user()->name ." Your file was uploaded successfully");
        }else{
            return json_encode(auth()->user()->name . " An Error occured while Uploading! Please try again");
        }

    }

    public function getFile($id){
        $file = Material::findOrFail($id);

        if( $file->filetype == 'doc')
        {
            $headers = array(
                'Content-type: application/msword'
            );

        } elseif($file->filetype == 'docx')
        {
            $headers = array(
                'Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            );

        }elseif($file->filetype == 'zip')
        {
            $headers = array(
                'Content-type: application/zip'
            );

        }elseif($file->filetype == 'pptx'){
            $headers = array(
                'Content-type: application/application/vnd.openxmlformats-officedocument.presentationml.presentation'
            );
        }elseif($file->filetype == 'pdf'){
            $headers = array(
                'Content-type: application/pdf'
            );
        }else{
            $headers = [
                'Content-Type' => Storage::disk('documents')->mimeType($file->filename),
            ];
        }

       return Storage::disk('documents')->download($file->filename,$file->title,$headers);

    }

    public function destroy($id){
        $file = Material::findOrFail($id);
        if(auth()->user()->access == 0 || auth()->user()->id == $file->owner){
            if(Storage::disk('documents')->delete($file->filename)){
                $file->delete();
                return json_encode("File Deleted!");
            }else{
                return json_encode("Unable To Delete File");
            }

        }else{
            return json_encode("You Are Not Authorised to  Perform This Action!");
        }
    }
}
