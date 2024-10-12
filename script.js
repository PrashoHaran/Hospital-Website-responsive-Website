
let pShow = document.getElementById("pShow");
let password = document.getElementById("adminPassword");

pShow.onclick = function() {

  if (password.type == "password") {
    password.type = "text";
    pShow.src = "images/eye-fill.svg"

  } else {

    password.type = "password";
    pShow.src = "images/eye-slash-fill.svg"
  }

}

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



function changeView1(){

   
    var appointmentBox= document.getElementById("appointmentBox");

    
if(!appointmentBox.classList.toggle("d-none")){

    appointmentBox.classList.toggle("d-block");
    newsBox.classList.toggle("d-none");
}
else{
    appointmentBox.classList.toggle("d-none");
    
}
 
  

}

function changeView2(){

    var newsBox = document.getElementById("newsBox");

    if(!newsBox.classList.toggle("d-none")){

        appointmentBox.classList.toggle("d-none");
        newsBox.classList.toggle("d-block");
        
    }
    else{
        newsBox.classList.toggle("d-none")

    }
    
     

}

//Doctor Form validation Part

function doctorvalidate(){

    const dname = document.getElementById('dname').value.trim();
    const nic = document.getElementById('nic').value.trim();
    const email = document.getElementById('email').value.trim();

    // Validate Doctor Name 
    if (dname === "") {
        alert("Please enter the Doctor's Name.");
        return false;
    }

    // Validate NIC
    const nicPattern = /^(\d{9}[VvXx]|\d{12})$/;
    if (nic === "" || !nicPattern.test(nic)) {
        alert("Please enter a valid NIC. It should be either 9 digits followed by V/v/X/x or 12 digits.");
        return false;
    }

    // Validate Email (
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !emailPattern.test(email)) {
        alert("Please enter a valid Email address.");
        return false;
    }

    // If all validations pass, return true
    return true;
    
}


