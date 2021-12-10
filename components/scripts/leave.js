var emp = document.getElementById('employees');

for(var i=0;i<idArray.length;i++)
{
    emp.innerHTML += '<option value="'+ idArray[i] + '">' + nameArray[i] + '</option>';
}

function validate()
{
    var sdate = document.getElementById("startDate");
    var edate = document.getElementById("endDate");

    edate.setAttribute('min',sdate.value);
    sdate.setAttribute('max',edate.value);
}