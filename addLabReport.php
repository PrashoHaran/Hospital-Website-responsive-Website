<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lab Report</title>
</head>

<body>

    <div class=" container-fluid">
        <div class=" row">

            <?php include "header.php"; ?>
            <hr class=" my-0">

            <div class="col-12 mt-2 my-2">

                <div class="col-2">

                    <button class="btn btn-dark p-2" onclick="window.location.href='adminHome.php';">
                        <i class="bi bi-arrow-left-square-fill col-1 mx-1"></i>Back
                    </button>
                </div>

            </div>


<div class=" col-12 d-flex justify-content-center">

<div class=" col-lg-4 col-8 my-5 border-2" style=" background-image: linear-gradient(to right top, #f3f3f3, #f0f1f5, #ecf0f7, #e5eff9, #ddeffa); border-radius: 10px; box-shadow: 0 0 15px rgba(45, 0, 65, 0.2);" >

<div class=" col-12 d-flex justify-content-center my-2" >
<img src="https://www.primecareltd.com/uploads/company/logo.png" alt="Hospital Logo" class=" col-lg-2 col-4">
</div>

<div class=" col-12 d-flex justify-content-center"><p style=" font-family: 'Leiko-Regular';">Add Lab Report</p></div>

<div class="col-12 d-flex justify-content-center">

<div class="col-6"><input type="text" name="refSearch" id="refSearch" class=" form-control" placeholder="Enter the Reference Number"></div>
<div class="col-2"><button class="form-control" name="submit"><i class="bi bi-search"></i></button></div>
</div>

<div class=" col-12 p-1"><input type="text" name="refNo" id="refNo" class=" form-control" placeholder="Please Enter the Reference Number"> </div>

<div class=" col-12 p-1"><input type="text" name="nic" id="nic" class=" form-control" placeholder="Please Enter the Patient NIC "> </div>

<div class="col-12 p-1 >
<label for="upload file" class=" form-control col-8">Choose the file</label>
<input type="file" name="report" id="report" class=" col-5 form-control">
</div>

<div class="col-12 d-flex justify-content-center my-2"><button class="col-4 btn btn-outline-dark">Submit The Report</button></div>

<div class="col-12 d-flex justify-content-center my-2">
<button class="col-5 btn btn-outline-dark">Update The Report</button>
<button class="col-5 btn btn-outline-dark">Delete The Report</button>
</div>

</div>

</div>
        


            <?php include "footer.php"; ?>
        </div>
    </div>


</body>

</html>