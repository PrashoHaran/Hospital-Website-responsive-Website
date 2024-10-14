


function adminSignIn() {

    var adminEmail = document.getElementById("adminEmail");
    var adminPassword = document.getElementById("adminPassword");

    var f = new FormData();
    f.append("e", adminEmail.value);
    f.append("p", adminPassword.value);


    var r = new XMLHttpRequest();



    r.open("POST", "adminSignInProcess.php", true);
    r.send(f);

}


pShow.onclick = function () {
    let pShow = document.getElementById("pShow");
    let password = document.getElementById("adminPassword");

    if (password.type == "password") {
        password.type = "text";
        pShow.src = "images/eye-fill.svg"

    } else {

        password.type = "password";
        pShow.src = "images/eye-slash-fill.svg"
    }

}

function changeView1() {


    var appointmentBox = document.getElementById("appointmentBox");


    if (!appointmentBox.classList.toggle("d-none")) {

        appointmentBox.classList.toggle("d-block");
        newsBox.classList.toggle("d-none");
    }
    else {
        appointmentBox.classList.toggle("d-none");

    }



}

function changeView2() {

    var newsBox = document.getElementById("newsBox");

    if (!newsBox.classList.toggle("d-none")) {

        appointmentBox.classList.toggle("d-none");
        newsBox.classList.toggle("d-block");

    }
    else {
        newsBox.classList.toggle("d-none")

    }



}

//Doctor Form validation Part

/*function doctorvalidate(){

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
    
}*/
function doctorvalidate() {
    const dname = document.getElementById('dname').value.trim();
    const nic = document.getElementById('nic').value.trim();
    const email = document.getElementById('email').value.trim();
    const speciality = document.getElementById('speciality').value;

    // Validate Doctor Name 
    if (dname === "") {
        alert("Please enter the Doctor's Name.");
        return false; // Prevent form submission
    }

    // Validate NIC
    const nicPattern = /^(\d{9}[Vv]|\d{12})$/;
    if (nic === "" || !nicPattern.test(nic)) {
        alert("Please enter a valid NIC. It should be either 9 digits followed by V/v/X/x or 12 digits.");
        return false; // Prevent form submission
    }

    // Validate Email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !emailPattern.test(email)) {
        alert("Please enter a valid Email address.");
        return false; // Prevent form submission
    }

    // Validate Speciality
    if (!speciality) {
        alert("Please select a Speciality.");
        return false; // Prevent form submission
    }

    // If all validations pass, return true
    return true;
}

//Validate Appointment details

function appointmentValidate() {



    var pName = document.getElementById("pName").value;
    var nic = document.getElementById("nic").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var gender = document.getElementById("gender").value;
    var speciality2 = document.getElementById("speciality2").value;
    var doctor2 = document.getElementById("doctor2").value;
    var date2 = document.getElementById("date2").value;

    /*
    alert(pName);
    
    alert(nic);
    
    alert(email);
    
    alert(phone);
    
    alert(gender);
    
    alert(speciality2);
    
    alert(doctor2);
    
    alert(date2);
    */



    if (pName === "") {
        alert("Please Enter the patient name!");
    }

    const nicPattern = /^(\d{9}[Vv]|\d{12})$/;
    if (nic === "" || !nicPattern.test(nic)) {
        alert("Please enter a valid NIC. It should be either 9 digits followed by V/v or 12 digits.");
    }
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !emailPattern.test(email)) {
        alert("Please enter a valid Email address.");

    }

    if (phone === "") {
        alert("Please Enter Your phone number!")
    }

    if (gender === "") {
        alert("Please Select Patient Gender");
    }

    if (speciality2 === "") {
        alert("Please Select Speciality");
    }

    if (doctor2 === "") {
        alert("Please Select Doctor");
    }

    if (date2 === "") {
        alert("Please Select Date");
    }


    if (pName !== "" && nic !== "" && email !== "" && phone !== "" && gender !== "" && speciality2 !== "" && doctor2 !== "" && date2 !== "") {

        var result = confirm("Are you sure you want to Confirm Appointment");

        if (result) {
            // User clicked 'Yes'

            var f = new FormData();
            f.append("pName", pName);
            f.append("nic", nic);
            f.append("email", email);
            f.append("phone", phone);
            f.append("gender", gender);
            f.append("doctor", doctor2);
            f.append("date", date2);

            var r = new XMLHttpRequest();

            r.onreadystatechange = function () {
                if (r.readyState == 4) {
                    var t = r.responseText;
                    if (t == "success") {
                     
                        alert(t);
                    } else {
                        
                        alert(t);
                    }
        
                }
            };
            
            r.open("POST", "process_payment.php", true);
            r.send(f);

            window.location = "payment.php";
        } else {
            // User clicked 'No'
            window.location.reload();

        }

    }

}
