function search(){
    var input = document.getElementById("search").value.toUpperCase();
    var rows = document.getElementById("usersTable").getElementsByTagName("tr");
    var category = document.getElementById("category").value;


    for(var i=1;i<rows.length;i++)
    {
        var cells = rows[i].getElementsByTagName("td");
        var found = false;

        if(category==-1)
        {
            for(var j=1;j<cells.length;j++)
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
    var rows = document.getElementById("usersTable").rows;
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

function filterRows()
{
    var category = document.getElementById("catByTime").value;
    var rows = document.getElementById("usersTable").getElementsByTagName("tr");

    for(var i=1;i<rows.length;i++)
    {
        var cells = rows[i].getElementsByTagName("td");
        var type = cells[8].innerHTML.toUpperCase();
        console.log(type);
        
        if(category == -1)
        {
            rows[i].style.display="";
        }
        else if(category == 0)
        {
            if(type === 'NEW')
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