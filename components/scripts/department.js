
var i=1;

var tableCopy;

document.getElementById("homelink").classList.remove("active");
document.getElementById("departmentlink").classList.add("active");


function textBoxCreate() {   
    
    var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
    x.setAttribute("Placeholder", "Designation " + Number(i+1));
    x.setAttribute("Name", "Designation_" + i);
    x.setAttribute("class","form-control col-sm m-2");

    var y = document.createElement("INPUT");
    y.setAttribute("type", "number");
    y.setAttribute("Placeholder", "Salary " + Number(i+1));
    y.setAttribute("Name", "Salary_" + i);
    y.setAttribute("class","form-control col-sm m-2");  
    y.onkeydown = () => {
        textBoxCreate();
        y.onkeydown=null;
    };

    var div = document.createElement("div");
    div.id = "row"+i;
    div.className = "row";
    document.getElementById("designationForm").appendChild(div);
    document.getElementById("row"+i).appendChild(x);
    document.getElementById("row"+i).appendChild(y);

    i++;
}

function showNextPage(){
    document.getElementById("page1").style.display="none";
    document.getElementById("page2").style.display="unset";
    document.getElementById("dPrint").innerHTML+=document.getElementById("dName").value;
}


function filterCols()
{
    document.getElementById('deptTable').innerHTML = tableCopy;
    var rows = document.getElementById("deptTable").rows;
    var selectedCols = document.getElementById("filter");
    
    
    for(var i=0;i<rows.length;i++)
    {
        var cols = rows[i].cells;

        for(var j=0;j<selectedCols.length;j++)
        {
            if(selectedCols[j].selected){
                cols[j+2].style.display="none";     //j+2 is a fix for first two col merge issue
            }
            else
            {
                cols[j+2].style.display="";
            }
        }
    
    }
    mergeCells();
}

function search()
{
    document.getElementById('deptTable').innerHTML = tableCopy;
    var input = document.getElementById("search").value.toUpperCase();
    var rows = document.getElementById("deptTable").getElementsByTagName("tr");
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
    mergeCells();
}

function setTable()
{
    tableCopy = document.getElementById('deptTable').innerHTML;
}

function mergeCells()
{
    const table = document.getElementById('deptTable');
    let headerCell1 = null;
    let headerCell2 = null;

    for (let row of table.rows) {
    const firstCell = row.cells[0];
    const secondCell = row.cells[1];
    

    if (headerCell1 === null || firstCell.innerText !== headerCell1.innerText) {
        headerCell1 = firstCell;
        firstCell.style.display="";
    } else {
        headerCell1.rowSpan++;
        firstCell.style.display="none";
    }
    if (headerCell2 === null || secondCell.innerText !== headerCell2.innerText) {
        headerCell2 = secondCell;
        secondCell.style.display="";
    } else {
        headerCell2.rowSpan++;
        secondCell.style.display="none";
    }
    
    }
}