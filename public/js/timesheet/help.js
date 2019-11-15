var dString = new Date()
    var d = new Date(dString.getTime() - (dString.getTimezoneOffset() * 60000 )).toISOString().split("T")[0]
    spDate = d.split('-')
console.log(spDate)

    /* Trigger on load or any where */
    $('#datepicker-month').trigger('changeMonth');
    $("#datepicker-month").datepicker('setDate', new Date(spDate[1]+'-'+spDate[0]+'-01'));