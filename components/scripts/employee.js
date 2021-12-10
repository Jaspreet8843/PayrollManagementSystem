var department = document.getElementById("department");

uniqueList = Array();


dropDownList.forEach(element => {
    if(!uniqueList.includes(element['dNo']))
    {
        department.innerHTML += '<option value="'+ element['dNo'] + '">' + element['dName'] + '</option>';
        uniqueList.push(element['dNo']);
    }
});

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