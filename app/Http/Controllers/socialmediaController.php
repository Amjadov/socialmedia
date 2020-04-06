<?php

namespace App\Http\Controllers;

use App\socialmedia;
use App\uploadedfile;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\Datatables\Datatables;
use App;
use App\Http\Controllers\GraphController;

class socialmediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // open index view
		$page_title = 'Social Media Form';
        return view('socialmedia/index',compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // redirect to create view
		$page_title = 'New Entry';
        return view('socialmedia/create',compact('page_title'));
    }

	public function uploadfile ( $uploadedfile)
    {
	  //get file details
   	  $filename = $uploadedfile->getClientOriginalName();
	  $fileextension = $uploadedfile->extension();
      $filerealpath = $uploadedfile->getRealPath();
      $filesize = $uploadedfile->getSize();
      $filememetype = $uploadedfile->getMimeType();
	  
      //Move Uploaded File
      $destinationPath = 'uploads';
	  $savename = time().$filename;
      $uploadedfile->move($destinationPath,$savename);
	  
	  //save record of uploaded file in db
		$newfile = new uploadedfile([
          'filetype' => 'image',
          'originalname' => $filename,
          'extension' => $fileextension,
          'realpath' => $filerealpath,
          'size' => $filesize,
		  'memetype' => $filememetype,
		  'savedestination' => $destinationPath,
		  'savedname' => $savename,
        ]);

        $newfile->save();
		return $savename;
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
    {
		//validate entries server side as well as client side
        $request->validate([
                    'heading' => 'required|max:255',
                    'web_link' => 'required|max:255',
                    'videofile' => 'mimes:mp4,avi,mov|max:10048',
					'imagefile' => 'mimes:png,jpg,jpeg,bmp|max:2048'
                ]);
   
		$videosavename = '';
		$imagesavename = '';
		//save files to uploads folder
   		if(isset($request->videofile))
		{
			$videosavename = $this->uploadfile($request->videofile);
		}
		if(isset($request->imagefile))
		{
			$imagesavename = $this->uploadfile($request->imagefile);
		}
		
		// facebook posting
		$responseID = 0;
		$result = 'failed';
		$result_data = '';
		
		try{
		$facebook_class = new GraphController($fb);
		$newrequest = new \Illuminate\Http\Request();
		$newrequest->replace(['message' => $request->get('heading')]);
		$newrequest->replace(['source' => public_path().'/uploads/'.$imagesavename]);
        $responseID = $facebook_class->publishToProfile($newrequest);
		} catch (\Exception $e) {
			$result_data = $e->getMessage();
		}
		
		if($responseID > 0)
		{
			$result = 'success';
			$result_data = $responseID;
		}
		//Save data to database
        $dbentry = new socialmedia([
          'heading' => $request->get('heading'),
          'web_link' => $request->get('web_link'),
          'video_link' => $videosavename,
          'image_link' => $imagesavename,
		  'service' => $request->get('service'),
		  'result' => $result,
		  'result_data' => $result_data,
		  'owner' => Auth::id(),
        ]);

        $dbentry->save();
		
		
		//Redirect to index view	
        return redirect()->route( 'socialmedia/index' );
    }


	public function get_data(Request $request)
    {
		//get record list from db
        return Datatables::of(socialmedia::select('id','service','heading','web_link','video_link','image_link'))->make(true);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\links_form  $links_form
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get record from db and open edit view
		$data = socialmedia::find($id);
        $page_title = 'Edit Post';
        return view('socialmedia/edit', compact('data','id','page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\links_form  $links_form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, links_form $links_form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\links_form  $links_form
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
