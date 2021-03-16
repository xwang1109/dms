<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;




class DocumentController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $documents = Document::where('user_id', $user_id)->get();
        return view('dashboard',compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([

            'file' => 'required|mimes:pdf,csv,docx,doc,txt,|max:2048'
        ]);
        
        
        
        $owner = auth()->user()->id;
        $document = new Document;
        $document->user_id = $owner;
        $document->file_name = $request->file('file')->getClientOriginalName();     
        
        $documentSameName = Document::where('user_id', $owner)->where('file_name', $document->file_name)->first();
        
        // the document already exist 
        if($documentSameName){
            return redirect()->route('upload-page')->withErrors('File Already Exist');
        } 
        
        $document->file_location = $request->file('file')->storeAs("files/".$owner, $document->file_name,'private');

        $document->save();
        
        return redirect()->route('upload-page')->with('success','File Uploaded');

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        // check the permission for deletion
        
        $owner = auth()->user()->id;
        $document = Document::where('id', $id)->first();
        
        if($owner != $document->user_id){
            return redirect()->route('dashboard');
        }

        
        $path = storage_path('app/files/').$document->file_location;
        if(unlink($path)){
            $document->delete();
        }

        return redirect()->route('dashboard');
    }


    /**
     * Download the file from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        // check the permission for downloading
        
        $owner = auth()->user()->id;
        $document = Document::where('id', $id)->first();
        
        if($owner != $document->user_id){
            return redirect()->route('dashboard');
        }

        $path = storage_path('app/files/').$document->file_location;
        return response()->download($path);
        

    }
}
