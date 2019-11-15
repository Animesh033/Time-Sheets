@extends('layouts.timesheet')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Timesheet</h1>
            <form method="post" action="{{ route('viewer.store') }}" id="timesheet-form">
              @csrf
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="" id="message" style="display: none;">
                      </div>
                      <div class="float-right"><a href="{{ route('viewer.index') }}"><b>Back</b></a></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                          <label for="date">Date</label>
                          {{-- <select class="form-control" id="month">
                            <option>Sep</option>
                            <option>Oct</option>
                            <option selected="selected">Nov</option>
                          </select> --}}
                            <input class="form-control" name="sheet_date" id="datepicker" placeholder="DD-MM-YYYY" data-date-end-date="0d" readonly>
                            <span class="" role="alert">
                                <strong id="sheet_date"></strong>
                            </span>
                        </div>
                    </div>
                    {{-- <div class="col-md-2">
                      <label for="day">Day</label>
                        <select class="form-control" id="day">
                          <option>1</option>
                          <option>2</option>
                          <option selected="selected">3</option>
                        </select>
                    </div> --}}
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                          <label for="leave">Leave</label>
                          <select class="form-control" id="leave_status" name="leave_status">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="container">
                    <fieldset>
                    <div class="row">
                      <div class="col-sm-6 col-md-3">
                        <label for="client">Client</label>
                          <div class="form-group">
                            <select class="form-control" id="client" name="client_id">
                              @if(isset($clients) && !empty($clients))
                                @foreach($clients as $client)
                                  <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                                @endforeach
                              @endif
                            </select>
                          </div>
                      </div> 
                      <div class="col-sm-6 col-md-3">
                        <div class="row">
                          <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                              <label for="hrs">Hrs.</label>
                              <input type="number" name="working_hrs" class="form-control" id="wHrs">
                              <span class="" role="alert">
                                  <strong id="working_hrs"></strong>
                              </span>
                            </div>                
                          </div>
                          <span class="">:</span>
                          <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                              <label for="mins">Mins.</label>
                              <input type="number" name="working_mins" class="form-control" id="wMins">
                              <span class="" role="alert">
                                  <strong id="working_mins"></strong>
                              </span>  
                            </div>                
                          </div>
                          <div class="col-sm-1 col-md-1">
                              <div class="add_more"><span><i class="fas fa-plus-circle"></i></span></div>
                          </div> 
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                          <div id="add_more" class="form-group"></div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6 col-md-3">
                        <label for="break">Break Time: </label>           
                      </div>
                      <div class="col-sm-2 col-md-1">
                        <div class="form-group">
                          <input type="number" name="break_hrs" class="form-control" id="bHrs">
                          <span class="" role="alert">
                              <strong id="break_hrs"></strong>
                          </span> 
                        </div>
                                       
                      </div>
                      <span class="">:</span>
                      <div class="col-sm-2 col-md-1">
                        <div class="form-group">
                          <input type="number" name="break_mins" class="form-control" id="bMins">
                          <span class="" role="alert">
                              <strong id="break_mins"></strong>
                          </span>
                        </div>
                                        
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col-sm-6 col-md-3">
                        <label for="idle">Idle Time: </label>           
                      </div>
                      <div class="col-sm-2 col-md-1">
                        <div class="form-group">
                          <input type="number" name="idle_hrs" class="form-control" id="iHrs">
                          <span class="" role="alert">
                              <strong id="idle_hrs"></strong>
                          </span>   
                        </div>
                                       
                      </div>
                      <span class="">:</span>
                      <div class="col-sm-2 col-md-1">
                        <div class="form-group">
                          <input type="number" name="idle_mins" class="form-control" id="iMins">
                          <span class="" role="alert">
                              <strong id="idle_mins"></strong>
                          </span>  
                        </div>
                                        
                      </div> 
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-6 col-md-3">
                        <label for="total">Total Time: </label>           
                      </div>
                      <div class="col-sm-2 col-md-1">
                        <div class="form-group">
                          <input type="number" name="total_hrs" class="form-control" id="tHrs"> 
                          <span class="" role="alert">
                              <strong id="total_hrs"></strong>
                          </span>  
                        </div>
                                       
                      </div>
                      <span class="">:</span>
                      <div class="col-sm-2 col-md-1">
                        <div class="form-group">
                          <input type="number" name="total_mins" class="form-control" id="tMins">
                          <span class="" role="alert">
                              <strong id="total_mins"></strong>
                          </span>  
                        </div>
                                        
                      </div>
                      
                    </div>
                  </fieldset>  
                  <div class="row">
                    <div class="col-sm-4 col-md-4 offset-md-5">
                      <button class="btn btn-md btn-success" id="timesheet-submit">Submit</button>                
                    </div> 
                  </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('timesheet_scripts')
    <!-- font-awesome -->
    {{-- <script src="https://kit.fontawesome.com/edb441b776.js" crossorigin="anonymous"></script> --}}
    <!-- Bootstrap 4 datepicker -->
    {{-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript" defer></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" defer></script> --}}
    <script src="{{ asset('js/timesheet/timesheet.js') }}" defer></script>
@endpush
