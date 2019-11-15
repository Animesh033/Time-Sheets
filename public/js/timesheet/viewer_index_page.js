var UiController = function(){

}();


var controller = function(){

  var getTimeSheet = function(yearMonth){
    $.ajax
    ({
          type: "Get",
          url: "/viewer/timesheet",
          data: "date="+yearMonth,
          success: function(timesheet)
          {
            // console.log(timesheet.viewer_index_page)
            $('#timesheet').html(timesheet.viewer_index_page)
              // timesheets.forEach(function(timesheet){
              //   console.log(timesheet)
              // })
          },
          error: function(jqXHR, textStatus, errorThrown){
              // console.log(jqXHR)
              // console.log(textStatus)
              // console.log(errorThrown)
              $('#timesheet').html(errorThrown)
          }
     });
  };

  var setupEventListeners = function() {    
    // document.querySelector('#datepicker-month').addEventListener('load', setUpDatepicker); 
  };

  var showCurrentMonthTimeSheet = function(){
    var dString = new Date()
    var currentDate = new Date(dString.getTime() - (dString.getTimezoneOffset() * 60000 )).toISOString().split("T")[0]
    spDate = currentDate.split('-')
    $("#datepicker-month").val(spDate[1]+'-'+spDate[0])
    getTimeSheet(spDate[0]+'-'+spDate[1])

  };

  var setUpDatepicker = function() {
    $("#datepicker-month").datepicker({
        format: 'mm-yyyy',
        todayHighlight:'TRUE',
        autoclose: true,
        clearBtn: true,
        viewMode: "months", 
        minViewMode: "months",
        endDate: "0d",
    }).on('changeMonth', function(e) {
        // `e` here contains the extra attributes
        // console.log(e)
        var dateString, date, splitedDate, yearMonth

        dateString = new Date(e.date)

        date = new Date(dateString.getTime() - (dateString.getTimezoneOffset() * 60000 )).toISOString().split("T")[0]

        splitedDate = date.split('-')

        yearMonth = splitedDate[0] +'-'+ splitedDate[1]

        console.log(yearMonth)

        getTimeSheet(yearMonth);  
    });
  };

  return {
      init: function() {
          console.log('Application has started.');
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          setUpDatepicker();
          showCurrentMonthTimeSheet();
          setupEventListeners();
      }
  };

}(UiController);

controller.init();