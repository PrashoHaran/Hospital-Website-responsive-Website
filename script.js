


function adminSignIn(){

    var adminEmail = document.getElementById("adminEmail");
    var adminPassword = document.getElementById("adminPassword");


    var f = new FormData();
    f.append("e", adminEmail.value);
    f.append("p", adminPassword.value);
    

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "adminHome.php";
                alert(t);
            } else {
                document.getElementById("msg").innerHTML = t;
                alert(t);
            }

        }
    };

    r.open("POST", "adminSignInProcess.php", true);
    r.send(f);

}
