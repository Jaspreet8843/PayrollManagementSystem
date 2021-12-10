var i=1;
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