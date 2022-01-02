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