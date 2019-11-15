// UI CONTROLLER
var UIController = (function() {
    
    var DOMstrings = {
        addBtn: '.add_more',
        addInsideDiv: '#add_more',
        hasMinus: '.has_minus',
        submitBtn: '#timesheet-submit',
        sheetDate: '#datepicker',
        leaveStatus: '#leave_status',
        client: '#client',
        wHrs: '#wHrs',
        wMins: '#wMins',
        bHrs: '#bHrs',
        bMins: '#bMins',
        iHrs: '#iHrs',
        iMins: '#iMins',
        tHrs: '#tHrs',
        tMins: '#tMins',
        formGroup: '.form-group',
        selectClient: '.select-client',
        succErrMsg: '#message',
        fieldSet: 'fieldset',
        strong: 'strong',
        workingHrs: '#working_hrs',
        workingMins: '#working_mins',
        _sheetDate: '#sheet_date',
        breakHrs: '#break_hrs',
        breakMins: '#break_mins',
        idleHrs: '#idle_hrs',
        idleMins: '#idle_mins',
        totalHrs: '#total_hrs',
        totalMins: '#total_mins',
    };
    var appData = {
        allItems: {
            clients: [],
            input: [],
        },
    };

    var getClientsData = function(clients, i){
      console.log('i = ' + i)
      var html, clients, options;
      options = '';
      clients.forEach(function(client){
        options += '<option value="'+client.id+'">'+client.company_name+'</option>';
      })
      html = document.createElement('div')
      html.setAttribute('class', 'has_minus')
      html.innerHTML = '<div class="row"><div class="col-sm-6 col-md-3"><div class="form-group"><select name="client_id" class="form-control select-client" id="select-'+i+'">'+options+'</select></div></div><div class="col-sm-6 col-md-3"><div class="row"><div class="col-sm-4 col-md-4"><div class="form-group"><input name="working_hrs" type="number" class="form-control" id="wHrs-'+i+'"><span class="" role="alert"><strong id="working_hrs_'+i+'"></strong></span></div></div><span>:</span><div class="col-sm-4 col-md-4"><div class="form-group"><input name="working_mins" type="number" class="form-control" id="wMins-'+i+'"><span class="" role="alert"><strong id="working_mins_'+i+'"></strong></span></div></div><div class="col-sm-1 col-md-1"><span style="cursor:pointer;" class="remove_district"><i class="fa fa-minus-circle"></i></span></div></div></div></div>'
      var li = html.childNodes
      for (let index = 0; index < li.length; index++) {
          const minus = li[index].children[1].childNodes
          minus[0].childNodes[3].childNodes[0].onclick = () => {//arrow function
              html.remove(); 
          }    
      }
      return document.querySelector(DOMstrings.addInsideDiv).appendChild(html);
    };

    return {

        getDOMstrings: function() {
            return DOMstrings;
        },

        addItem:function(appData){
            var client = getClientsData(appData['clients'], appData.countClicks);
            return client;
        },

        getInput: function(){
          var leaveStatus, selectTagId, wHrsId, wMinsId, inputData, data, sheetDate;
          inputData = [];
          sheetDate = document.querySelector(DOMstrings.sheetDate).value.split("-").reverse().join("-")
          leaveStatus = document.querySelector(DOMstrings.leaveStatus).value

          var clientId = document.querySelector(DOMstrings.client).value
          var workingHrs = document.querySelector(DOMstrings.wHrs).value
          var workingMins = document.querySelector(DOMstrings.wMins).value
          if (leaveStatus === '0') {
            data = {
              sheet_date: sheetDate,
              leave_status: leaveStatus,

              break_hrs: document.querySelector(DOMstrings.bHrs).value,
              break_mins: document.querySelector(DOMstrings.bMins).value,

              idle_hrs: document.querySelector(DOMstrings.iHrs).value,
              idle_mins: document.querySelector(DOMstrings.iMins).value,

              total_hrs: document.querySelector(DOMstrings.tHrs).value,
              total_mins: document.querySelector(DOMstrings.tMins).value,

              client_id: clientId,
              working_hrs: workingHrs,
              working_mins: workingMins,
            }
            inputData.push(data)
            data = {
              client_id: clientId,
              working_hrs: workingHrs,
              working_mins: workingMins,
            };
            // if (clientId && workingHrs && workingMins) {
              inputData.push(data)
            // }

            var hasMinus = document.querySelectorAll(DOMstrings.hasMinus);
            if (hasMinus.length > 0) {
                hasMinus.forEach(function(addedItem) {
                  selectTagId = addedItem.childNodes[0].childNodes[0].childNodes[0].childNodes[0].id;

                  var cmnNode = addedItem.childNodes[0].childNodes[1].childNodes[0].childNodes;

                  wHrId = cmnNode[0].childNodes[0].childNodes[0].id;

                  wMinId = cmnNode[2].childNodes[0].childNodes[0].id;
                  var clientId = document.querySelector('#'+selectTagId).value
                  var workingHrs = document.querySelector('#'+wHrId).value
                  var workingMins = document.querySelector('#'+wMinId).value
                  data = {
                    client_id: clientId,
                    working_hrs: workingHrs,
                    working_mins: workingMins,
                  }

                  if (clientId && workingHrs && workingMins) {
                    inputData.push(data)
                  }
                });
            }
          }else{
            data = {
              sheet_date: sheetDate, 
              leave_status: leaveStatus
            };
            inputData.push(data)
          }
          return inputData;
        },
        clearDOM: function(){
            console.log("DOM cleared");
        }
    };
    
})();

// GLOBAL APP CONTROLLER
var controller = (function(UICtrl) {

  var DOM = UICtrl.getDOMstrings();

  var appData = {
      clients: [],
      countClicks: 0,
      leaveStatus: document.querySelector(DOM.leaveStatus).value,
  };

  var setUpDatepicker = function() {
    $('#datepicker').datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight:'TRUE',
      autoclose: true,
      clearBtn: true,
      endDate: '0d',
    });
  };

  var getClients = function(){
      $.ajax({
          type: 'POST',
          url: '/viewer/clients',
          data: {},
          dataType: 'json',
          success: function(result){
            result.forEach(function(data, key){
               var client = {};
               var element;
               client.id = data.id;
               client.company_name = data.company_name;
               element = 'client_'+key;
               appData['clients'].push(client)
            })
          }
      });
  };

  var ctrlAddItem = function() {
    if(appData.leaveStatus === '0'){
      var addedItem, selectTagId;
      // var DOM = UICtrl.getDOMstrings();
      appData.countClicks++;
      addedItem = UICtrl.addItem(appData);
      // console.log(addedItem.childNodes[0].childNodes[0].childNodes[0].childNodes[0].id)
      selectTagId = addedItem.childNodes[0].childNodes[0].childNodes[0].childNodes[0].id;
      const selectElement = document.querySelector('#'+selectTagId);

      selectElement.addEventListener('change', (event) => {
        // console.log(event.target.value)
        // const result = document.querySelector('.result');
        // result.textContent = `You like ${event.target.value}`;
      });
    }
  };


  var disableSelectedOption = function(c){
    console.log(c)
  };

  var storeItem = function(e){
      e.preventDefault()
      var input;
      input = UICtrl.getInput();
      if (input) {
          store(input);
      }
      console.log('Submit btn is clicked')
  };

  var showFlashMessage = function(msg){
      document.querySelector(DOM.succErrMsg).style.display = 'block'
      document.querySelector(DOM.succErrMsg).innerHTML = msg;
      // document.querySelector(DOM.succErrMsg).insertAdjacentHTML('beforeend', msg);
      // setTimeout(function() {
      //         $(DOM.succErrMsg).css('display', 'none')
      //     }, 5000);
      document.getElementById("timesheet-form").reset()

      $(DOM.succErrMsg).delay(3000).fadeOut('slow')
      $(DOM.strong).html('')
      $(DOM.addInsideDiv).html('')
  };

  var showErrorMessages = function(error){
    $(DOM.strong).html('')
    $(DOM.succErrMsg).html('')
    if (appData.leaveStatus === '0') {

      if (error.working_hrs) {
        if (!$(DOM.wHrs).val()) {
          $(DOM.workingHrs).css({'color': 'red'})
          $(DOM.workingHrs).html(error.working_hrs[0])
        }

        $('input[name="working_hrs"]').each(function(i){
          if (!$(this).val() && i > 0) {
            console.log(i)
            $(DOM.workingHrs+'_'+i).css({'color': 'red'})
            $(DOM.workingHrs+'_'+i).html(error.working_hrs[0])
          }
        })
      }

      if (error.working_mins) {
        if (!$(DOM.wMins).val()) {
          $(DOM.workingMins).css({'color': 'red'})
          $(DOM.workingMins).html(error.working_mins[0])
        }

        $('input[name="working_mins"]').each(function(i){
          if (!$(this).val() && i > 0) {
            console.log(i)
            $(DOM.workingMins+'_'+i).css({'color': 'red'})
            $(DOM.workingMins+'_'+i).html(error.working_mins[0])
          }
        })
      }

      if (error.sheet_date) {
        if (!$(DOM._sheetDate).val()) {
          $(DOM._sheetDate).css({'color': 'red'})
          $(DOM._sheetDate).html(error.sheet_date[0])
        }
      }

      if (error.break_hrs) {
        if (!$(DOM.breakHrs).val()) {
          $(DOM.breakHrs).css({'color': 'red'})
          $(DOM.breakHrs).html(error.break_hrs[0])
        }
      }

      if (error.break_mins) {
        if (!$(DOM.breakMins).val()) {
          $(DOM.breakMins).css({'color': 'red'})
          $(DOM.breakMins).html(error.break_mins[0])
        }
      }

      if (error.idle_hrs) {
        if (!$(DOM.idleHrs).val()) {
          $(DOM.idleHrs).css({'color': 'red'})
          $(DOM.idleHrs).html(error.idle_hrs[0])
        }
      }

      if (error.idle_mins) {
        if (!$(DOM.idleMins).val()) {
          $(DOM.idleMins).css({'color': 'red'})
          $(DOM.idleMins).html(error.idle_mins[0])
        }
      }

      if (error.total_hrs) {
        if (!$(DOM.totalHrs).val()) {
          $(DOM.totalHrs).css({'color': 'red'})
          $(DOM.totalHrs).html(error.total_hrs[0])
        }
      }

      if (error.total_mins) {
        if (!$(DOM.totalMins).val()) {
          $(DOM.totalMins).css({'color': 'red'})
          $(DOM.totalMins).html(error.total_mins[0])
        }
      }
    }else{
      if (error.sheet_date) {
        if (!$(DOM._sheetDate).val()) {
          $(DOM._sheetDate).css({'color': 'red'})
          $(DOM._sheetDate).html(error.sheet_date[0])
        }
      }
    }
  };

  var store = function(input){
    var input = input;
      $.ajax({
          type: 'POST',
          url: '/viewer',
          data: {sheet_details: input},
          dataType: 'json',
          success: function(result){
            console.log(result)
            var errorObj = result.errors;
            if (errorObj) {
              console.log(errorObj)
              var isEmpty = Object.entries(errorObj).length === 0 && errorObj.constructor === Object
              if (!isEmpty) {
                showErrorMessages(errorObj)
              }
            }
            
            if (result.status === 1) {
              var successHtml = '<div class=""><p style="width:100%;" class="btn btn-info"><b>Timesheet data saved successfully.</b></p></div>'
              showFlashMessage(successHtml)
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
              var errorHtml = '<div class=""><p style="width:100%;" class="btn btn-danger"><b>'+errorThrown+'</b></p></div>'
              showFlashMessage(errorHtml)
          }
      });
  };

  var leaveStatus = function(){
    var ls = ($(this).val());
    appData.leaveStatus = ls; //Set the leave status to app data
    if(ls === '1'){
        $(DOM.fieldSet).prop("disabled", true);
        $(DOM.addBtn).css({"cursor": "not-allowed"});
        $(DOM.strong).html('');
    }else{
        $(DOM.fieldSet).removeAttr("disabled");
        $(DOM.addBtn).css({"pointer-events": "auto", "cursor": "pointer"});
        $(DOM.strong).html('');
    } 
  };

  var setupEventListeners = function() {
      document.querySelector(DOM.addBtn).addEventListener('click', ctrlAddItem);

      document.addEventListener('keypress', function(event) {
          if (event.keyCode === 13 || event.which === 13) {
              ctrlAddItem();
          }
      });

      document.querySelector(DOM.submitBtn).addEventListener('click', storeItem);     
      document.querySelector(DOM.leaveStatus).addEventListener('change', leaveStatus);     
  };

  return {
      init: function() {
          console.log('Application has started.');
          setUpDatepicker();
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          getClients();
          setupEventListeners();
      }
  };
    
})(UIController);


controller.init();