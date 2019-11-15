<?php

namespace App\Http\Controllers\Viewer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use App\Client;
use App\Datesheet;

class ViewerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** 1. Using Query*/ 
        // $clients = DB::connection('mysql2')->select('select * from companies order by company_name');

        /** 2. Using Eloquent*/ 
        // $clients = Client::orderBy('company_name')->get();

        /** 3. At runtime via the setConnection */ 
        // $client = new Client;

        // $client->setConnection('mysql2');

        // $clients = $client->orderBy('company_name')->get();

        $dateSheets = Datesheet::all();

        return view('viewer.index', compact('dateSheets'));
    }

    public function timesheet(Request $request)
    {
        $dateSheets = Datesheet::where([
            ['sheet_date', 'LIKE', '%'.$request->date.'%'],
            ['user_id', Auth::user()->id]
        ])->orderBy('sheet_date')->get();
        // return response()->json($dateSheets);
        $date = $request->date.'-01';

        $view = view('viewer.timesheet', compact('dateSheets', 'date'))->render();
        return response()->json(['viewer_index_page' => $view]);

        return response()
                    ->view('viewer.timesheet', $dateSheets, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $client = new Client;

        $client->setConnection('mysql2');

        $clients = $client->orderBy('company_name')->get();

        return view('viewer.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->sheet_details[0]['leave_status'] === '0') {
            $validator = Validator::make($request->sheet_details[0], [
                'working_hrs' => 'required',
                'working_mins' => 'required',
                'break_hrs' => 'required',
                'break_mins' => 'required',
                'idle_hrs' => 'required',
                'idle_mins' => 'required',
                'leave_status' => 'required',
                'sheet_date' => 'required|unique:datesheets',
                'total_hrs' => 'required',
                'total_mins' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->sheet_details[0], [
                'leave_status' => 'required',
                'sheet_date' => 'required|unique:datesheets',
            ]);
        }
        
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        $inputs = $request->sheet_details;
        foreach ($inputs as $key => $input) {
            $input['user_id'] = Auth::user()->id;
            if ($key === 0) {
                $collection = collect($input);
                $filtered = $collection->except(['client_id','working_hrs', 'working_mins']);
                $filtered->all();
                $dateSheet = Datesheet::create($filtered->toArray());
            }else{
                $dateSheet->timesheets()->create($input);
            }  
        }
        return response()->json(['status'=>1]);
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
        //
    }

    public function clients(){
        $client = new Client;

        $client->setConnection('mysql2');

        $clients = $client->select('id','company_name')->orderBy('company_name')->get();

        return response()->json($clients);
    }
}
