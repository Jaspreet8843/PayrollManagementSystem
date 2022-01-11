document.getElementById("homelink").classList.remove("active");
document.getElementById("employeeslink").classList.add("active");


var start = 0;
var step = 10;

function noOfRows()
{
    var rows = document.getElementById("employeeTable").rows;
    var end = rows.length;

    if(start<0)
    {
        start+=step;
    }
    else if(start>end)
    {
        start-=step
    }
    
    else
    {
        if(start==0)
        {
            document.getElementById("prevbtn").disabled = true;
        }
        else
        {
            document.getElementById("prevbtn").disabled = false;
        }
        if(start+step>end)
        {
            document.getElementById("nextbtn").disabled = true;
        }
        else
        {
            document.getElementById("nextbtn").disabled = false;
        }
        var from = start+1;
        var to = start+step;
        var total = end-1;
        var msg = "Showing "+from+" to "+ (to>total?total:to) +" of "+total+" entries.";
        document.getElementById("countmsg").innerHTML = msg;
        
        for(var i=1;i<rows.length;i++)
        {
            if(i>=from && i<=to)
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

function prevRows()
{
    start-=step;
    noOfRows();
}

function nextRows()
{
    start+=step;
    noOfRows();
}


function fillDropDown()
{
    var department = document.getElementById("department");
    
    uniqueList = Array();
    
    
    dropDownList.forEach(element => {
        if(!uniqueList.includes(element['dNo']))
        {
            department.innerHTML += '<option value="'+ element['dNo'] + '">' + element['dName'] + '</option>';
            uniqueList.push(element['dNo']);
        }
    });
}

function setDesignation(){
    var deptNo = document.getElementById("department").value;
    designation.innerHTML = '<option disabled selected>- select -</option>';
    dropDownList.forEach(element=> {
        if(deptNo===element['dNo'])
        {
            designation.innerHTML += '<option value="'+ element['desigNo'] + '">' + element['desigName'] + '</option>';
        }
    });
}

function setSalary(){
    var desigNo = document.getElementById("designation").value;
    dropDownList.forEach(element=>{
        if(desigNo===element['desigNo'])
        {
            document.getElementById('basicSalary').value = element['basicSalary'];
        }
    });
}

function edit(id){
    console.log(id);
}

function search(){
    var input = document.getElementById("search").value.toUpperCase();
    var rows = document.getElementById("employeeTable").getElementsByTagName("tr");
    var category = document.getElementById("category").value;

    console.clear();

    for(var i=1;i<rows.length;i++)
    {
        var cells = rows[i].getElementsByTagName("td");
        var found = false;
        var searching = false;

        if(category==-1)
        {
            for(var j=1;j<cells.length;j++)
            {
                if(cells[j].innerHTML.toUpperCase().includes(input))
                {
                    console.log(cells[2].innerHTML);
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
            console.log("hidden: "+rows[i].cells[2].innerHTML);
            rows[i].style.display="none";
            searching = true;
        }
    }
    if(!searching)
    {
        //noOfRows();
    }
}

function filterCols()
{
    var rows = document.getElementById("employeeTable").rows;
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



function hideCols()
{
    var rows = document.getElementById("employeeTable").rows;
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