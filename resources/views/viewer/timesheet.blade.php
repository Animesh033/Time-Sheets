{{--   @if(isset($dateSheets) && count($dateSheets) > 0)

  @foreach($dateSheets as $dateSheet)
      <ul>
        <li>{{ $dateSheet->sheet_date }}</li>
      </ul>
  @endforeach

  @endif  --}} 

  <div class="table-responsive">
  <table class="table table-bordered" style="font-size: 12px;font-weight: bold;">
    <thead>
      <tr>
        {{-- <th scope="col">S.No.</th> --}}
        <th style="text-align: center; vertical-align: middle;" scope="col">Day</th>
        <th scope="col">Company</th>
        <th style="text-align: center; vertical-align: middle;" scope="col">Working Time (Hrs.)</th>
        <th scope="col" style="color: red; text-align: center; vertical-align: middle; ">Break Time (Hrs.)</th>
        <th scope="col" style="color: red; text-align: center; vertical-align: middle; ">Idle Time (Hrs.)</th>
        <th scope="col" style="color: red; text-align: center; vertical-align: middle; ">Total Time (Hrs.)</th>
        {{-- @if(isset($dateSheets) && count($dateSheets) > 0)

        @foreach($dateSheets as $dateSheet)
            <th scope="col">{{ date_format(date_create($dateSheet->sheet_date), 'j') }}</th>
        @endforeach

        @endif  --}}
        
      </tr>
    </thead>
    <tbody>
        @if(isset($dateSheets) && count($dateSheets) > 0)

        @foreach($dateSheets as $key => $dateSheet)
        @php
            $timesheets = $dateSheet->timesheets;
        @endphp
            @if(count($timesheets)>0)
                @foreach($timesheets as $key => $timesheet)
                <tr>
                    @php
                    $i = $key+1;
                    @endphp
                    @if($key==0 )
                    {{-- <td scope="col" rowspan="{{ count($timesheets) }}">{{ $i }}</td> --}}
                    <td style="text-align: center; vertical-align: middle;" scope="col" rowspan="{{ count($timesheets) }}">{{ date_format(date_create($dateSheet->sheet_date), 'j') }}</td>
                    @endif
                    <td scope="col">{{ $timesheet->client->company_name }}</td>
                    <td style="text-align: center; vertical-align: middle;" scope="col">{{ $timesheet->working_hrs }} : {{ $timesheet->working_mins }}</td>
                    @if($key==0 )
                    <td style="color: red; text-align: center; vertical-align: middle;" scope="col" rowspan="{{ count($timesheets) }}">{{ $dateSheet->break_hrs }} : {{ $dateSheet->break_mins }}</td>
                    <td style="color: red; text-align: center; vertical-align: middle;" scope="col" rowspan="{{ count($timesheets) }}">{{ $dateSheet->idle_hrs }} : {{ $dateSheet->idle_mins }}</td>
                    <td style="color: red; text-align: center; vertical-align: middle;" scope="col" rowspan="{{ count($timesheets) }}">{{ $dateSheet->total_hrs }} : {{ $dateSheet->total_mins }}</td>
                    @endif
                </tr>
                @endforeach
            @else
                <tr>
                    <td style="color:red; text-align: center; vertical-align: middle;" scope="col">{{ date_format(date_create($dateSheet->sheet_date), 'j') }}</td>
                    <td style="color:red; text-align: center; vertical-align: middle;"colspan="6" scope="col">On leave</td>
                </tr>
            @endif
        @endforeach
        @else
        <tr>
            <td style="color: red; text-align: center; vertical-align: middle;" colspan="6" scope="col">Time sheet is not available for <span>{{ date_format(date_create($date), 'M-Y') }}</span>.</td>
        </tr>
        @endif
    </tbody>
  </table>
</div>