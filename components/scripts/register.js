
function validate()
{
    var pass = document.getElementById("password").value;
    var cpass = document.getElementById("cpassword").value;

    if(pass !== cpass)
    {
        console.log("err");
        document.getElementById("errormsg").style.display="";
        document.getElementById("submit").disabled=true;
    }
    else
    {
        document.getElementById("errormsg").style.display="none";
        document.getElementById("submit").disabled=false;
    }
}