document.getElementById("homelink").classList.remove("active");
document.getElementById("salarylink").classList.add("active");

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

function search()
{
    var input = document.getElementById("search").value.toUpperCase();
    var rows = document.getElementById("salaryTable").getElementsByTagName("tr");
    var category = document.getElementById("category").value;


    for(var i=1;i<rows.length;i++)
    {
        var cells = rows[i].getElementsByTagName("td");
        var found = false;

        if(category==-1)
        {
            for(var j=0;j<cells.length;j++)
            {
                if(cells[j].innerHTML.toUpperCase().includes(input))
                {
                    found = true;
                }
            }
        }
        else
        {
            
            if(cells.length>0 && cells[category].innerHTML.toUpperCase().includes(input))
            {
                found = true;
            }
        }

        if(found)
        {

            rows[i].style.display="";
        }
        else
        {
            rows[i].style.display="none";
        }
    }
}


function filterCols()
{
    var rows = document.getElementById("salaryTable").rows;
    var selectedCols = document.getElementById("filter");
    
    
    for(var i=0;i<rows.length;i++)
    {
        var cols = rows[i].cells;

        for(var j=0;j<selectedCols.length;j++)
        {
            if(selectedCols[j].selected){
                cols[j+1].style.display="none";
            }
            else
            {
                cols[j+1].style.display="";
            }
        }
    
    }

}


function printDiv(divName) {

    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();
    document.body.innerHTML = originalContents;
}
