var start = 0;
var step = 10;

function noOfRows()
{
    var rows = document.getElementById("logstable").rows;
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

function hideCols()
{
    var rows = document.getElementById("logstable").rows;
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


function search()
{
    var input = document.getElementById("search").value.toUpperCase();
    var rows = document.getElementById("logstable").getElementsByTagName("tr");
    var category = document.getElementById("category").value;


    for(var i=1;i<rows.length;i++)
    {
        var cells = rows[i].getElementsByTagName("td");
        var found = false;

        var searching = false;

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
    var rows = document.getElementById("logstable").rows;
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