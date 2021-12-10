var emp = document.getElementById('employees');
var month = document.getElementById('month');
var sdate = document.getElementById('startDate');
var edate = document.getElementById('endDate');
var monthNames = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct", "Nov","Dec"];
var today = new Date();

for(var i=0;i<idArray.length;i++)
{
    emp.innerHTML += '<option value="'+ idArray[i] + '">' + nameArray[i] + '</option>';
}

for(var i=4;i>-3;i--)
{
    date = new Date(today.getFullYear(), today.getMonth() - i, 1);
    m = monthNames[date.getMonth()];
    y = date.getFullYear();
    var lastDayOfMonth = new Date(y, date.getMonth()+1, 0).getDate();
    
    if(today.getMonth() === date.getMonth())
    {
        month.innerHTML += '<option selected value="' + m + y + '">' + m + " " + y + '</option>';
        sdate.value = dateToYMD(date);
        var lastDate = new Date(today.getFullYear(), today.getMonth(), lastDayOfMonth);
        edate.value = dateToYMD(lastDate);

    }
    else
    {
        month.innerHTML += '<option value="' + m + y + '">' + m + " " + y + '</option>';
    }
}



function dateToYMD(date) {
    var d = date.getDate();
    var m = date.getMonth() + 1; //Month from 0 to 11
    var y = date.getFullYear();
    return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
}

function setDates() {
    var m = month.value.substr(0,3);
    var y = month.value.substr(3);
    for(var i=0;i<12;i++)
    {
        if(monthNames[i]===m)
        {
            m = i;
        }
    }
    var lastDay = new Date(y, m+1, 0).getDate();
    var start = new Date(y,m,1);
    var end= new Date(y,m,lastDay);
    sdate.value = dateToYMD(start);
    edate.value = dateToYMD(end);
}