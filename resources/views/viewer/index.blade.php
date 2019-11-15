@extends('layouts.timesheet')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Viewer</h1>
            @if(isset($dateSheets) && count($dateSheets) > 0)

            @foreach($dateSheets as $dateSheet)
                <ul>
                  <li>{{ $dateSheet->sheet_date }}</li>
                </ul>
            @endforeach

            @endif
        </div>
    </div>
</div> --}}
<div class="container-fluid">
  <form>
    <div class="form-group">
      <div class="row">
        <div class="col-md-2">
      <label for="month">Month-Year:</label>
      <input class="form-control" name="sheet_month" id="datepicker-month" placeholder="MM-YYYY" readonly>
      {{-- <select class="form-control" id="month">
        <option>Sep</option>
        <option>Oct</option>
        <option>Nov</option>
      </select> --}}
        </div>
      </div>
    </div>
  </form>
  <div id="timesheet"></div>
  {{-- <div class="table-responsive">
  <table class="table table-bordered" style="font-size: 12px;font-weight: bold;">
    <thead>
      <tr>
        <th scope="col">S.No.</th>
        <th scope="col">Company</th>
        <th scope="col">1</th>
        <th scope="col">2</th>
        <th scope="col">3</th>
        <th scope="col">4</th>
        <th scope="col">5</th>
        <th scope="col">6</th>
        <th scope="col">7</th>
        <th scope="col">8</th>
        <th scope="col">9</th>
        <th scope="col">10</th>
        <th scope="col">11</th>
        <th scope="col">12</th>
        <th scope="col">13</th>
        <th scope="col">14</th>
        <th scope="col">15</th>
        <th scope="col">16</th>
        <th scope="col">17</th>
        <th scope="col">18</th>
        <th scope="col">19</th>
        <th scope="col">20</th>
        <th scope="col">21</th>
        <th scope="col">22</th>
        <th scope="col">23</th>
        <th scope="col">24</th>
        <th scope="col">25</th>
        <th scope="col">26</th>
        <th scope="col">27</th>
        <th scope="col">28</th>
        <th scope="col">29</th>
        <th scope="col">30</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>1</th>
        <td>ABC Company</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
      </tr>
      <tr>
        <th>2</th>
        <td>XYZ Company</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
        <td>1:50</td>
      </tr>
      <tr style="color: red">
        <th>#</th>
        <td>Break Time</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
      </tr>
      <tr style="color: red">
        <th>#</th>
        <td>Idle Time</td>
        <td>0</td>
        <td>1</td>
        <td>0</td>
        <td>0</td>
        <td>0.25</td>
        <td>1</td>
        <td>0.05</td>
        <td>0.10</td>
        <td>1</td>
        <td>1</td>
        <td>0</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>0</td>
        <td>1</td>
        <td>0.20</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>0.15</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>0</td>
        <td>1</td>
        <td>0</td>
        <td>1</td>
        <td>0</td>
        <td>1</td>
      </tr>
      <tr style="color: red">
        <th>#</th>
        <td>Total Time</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
        <td>9</td>
      </tr>
    </tbody>
  </table>
</div> --}}
</div> 
@endsection
@push('timesheet_scripts')
    <script src="{{ asset('js/timesheet/viewer_index_page.js') }}" defer></script>
@endpush