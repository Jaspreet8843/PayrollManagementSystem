document.getElementById("homelink").classList.remove("active");
document.getElementById("employeeslink").classList.add("active");

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