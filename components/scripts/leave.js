function fillDropDown()
{
    var emp = document.getElementById('employees');   
    for(var i=0;i<idArray.length;i++)
    {
        emp.innerHTML += '<option value="'+ idArray[i] + '">' + nameArray[i] + '</option>';
    }
}

function validate()
{
    var sdate = document.getElementById("startDate");
    var edate = document.getElementById("endDate");

    edate.setAttribute('min',sdate.value);
    sdate.setAttribute('max',edate.value);
}

function search()
{
    var input = document.getElementById("search").value.toUpperCase();
    var rows = document.getElementById("leavesTable").getElementsByTagName("tr");
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
    var rows = document.getElementById("leavesTable").rows;
    var selectedCols = document.getElementById("filter");
    
    
    for(var i=0;i<rows.length;i++)
    {
        var cols = rows[i].cells;

        for(var j=0;j<selectedCols.length;j++)
        {
            if(selectedCols[j].selected){
                cols[j].style.display="none";
            }
            else
            {
                cols[j].style.display="";
            }
        }
    
    }

}

function filterByTime()
{
    var category = document.getElementById("catByTime").value;
    var rows = document.getElementById("leavesTable").getElementsByTagName("tr");

    for(var i=1;i<rows.length;i++)
    {
        var cells = rows[i].getElementsByTagName("td");
        var dateFrom = Date.parse(cells[4].innerHTML);
        var dateTill = Date.parse(cells[5].innerHTML);
        
        if(category == -1)
        {
            rows[i].style.display="";
        }
        else if(category == 0)
        {
            if(dateFrom<Date.parse(Date()) && dateTill>Date.parse(Date()))
            {
                rows[i].style.display="";
            }
            else
            {
                rows[i].style.display="none";
            }
        }
        else if(category == 1)
        {
            if(dateTill<Date.parse(Date()))
            {
                rows[i].style.display="";
            }
            else
            {
                rows[i].style.display="none";
            }
        }
        else if(category == 2)
        {
            if(dateFrom>Date.parse(Date()))
            {
                rows[i].style.display="";
            }
            else
            {
                rows[i].style.display="none";
            }
        }
        

    }
}