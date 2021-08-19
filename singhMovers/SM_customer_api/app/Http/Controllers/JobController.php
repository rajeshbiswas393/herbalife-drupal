<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;

use App\Services\Jobs\SearchJobs;
use Symfony\Component\HttpFoundation\Response;
// resources
use App\Http\Resources\JobResource;
use App\Exceptions\NotUserPost;

class JobController extends Controller
{
  /*  public function __construct()
    {
      
      //  return $this->middleware('auth:api')->except('index', 'show' , 'search');
  
    }
*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ['message' => 'Job index'];
        return response($response, 200);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search( Request $request ){
        $searchJobs = new SearchJobs( $request->all() );
        $Jobs = $searchJobs->search();

        return response()->json( $Jobs );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = new Job([
            'job_slot' => $request->get('job_slot'),
            'job_type' => $request->get('job_type'),
            'customer_id' => $request->get('customer_id'),

        ]);
        
        $job->user_id = $request->user()->id;
        
        $job->save();
        
        return response([
           'data' => new JobResource($job)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return response([
            'data' => new JobResource($job)
        ], Response::HTTP_CREATED);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $job->update($request->all());
        return response([
            'data' => new JobResource($job)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
