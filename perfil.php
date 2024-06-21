<?php
include("functions\setup.php");
session_start();

if(isset($_SESSION['usu']))
{
    switch($_SESSION['tipo']){
        case 1: $tipo=1;
            $_SESSION['id_usuario'];
            break;
        case 2: $tipo=2;
            $_SESSION['id_usuario'];
            break;
        case 3: $tipo=3;
            $_SESSION['id_usuario'];
            break;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css\style_profile.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js' rel='stylesheet'>
    <script>
      $(function() {
        $(document).ready(function() {
                $(document).on("contextmenu", function(e) {
                    e.preventDefault();
                });
            });
        $('#btnRegister').click(function () {
          
        })
        
        $('#antecedentes').on( "blur", function()
              {
                  if ($(this).val().length === 0) {
                      $(this).css("border-color","red"); ;
                  }else{
                      $(this).css("border-color","white");
                  }
              } );
              const allowedExtensions = ['pdf']; // Allowed file extensions
              $('#antecedentes').change(function() {
                  const file = this.files[0];
                  if (file) {
                      const fileName = file.name;
                      const fileExtension = fileName.split('.').pop().toLowerCase();
                      if (allowedExtensions.indexOf(fileExtension) === -1) {
                          $('#invalid').show();
                          $(this).css("border","3px solid red");
                          this.value = ''; // Clear the input value to prevent form submission
                      } else {
                          $('#invalid').hide();
                          $(this).css("border","3px solid green");
                      }
                  }
              });
      });
    </script>
</head>
<body>
    <br>
    <br>
<div class="container">
  
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="menu.php">Menu</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
              <li class="breadcrumb-item active" aria-current="page"><a href="propiedades.php">propiedades</a></li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
          
          <br>
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>John Doe</h4>
                      <p class="text-secondary mb-1">Full Stack Developer</p>
                      <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                      <button id="editPhoto" class="btn btn-primary">Edit Photo</button>
                      <button class="btn btn-outline-primary">Help</button>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            
            <div class="col-md-8">
              <div class="card mb-3">
                <form action="functions\edit_profilepic.php" action="functions/signup-process2.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        Kenneth Valdez
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        fip@jukmuh.al
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Phone</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        (239) 816-9029
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Mobile</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        (320) 380-4539
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        Bay Area, San Francisco, CA
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Edit Photo</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="file">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4"></div>
                      <div class="col-sm-4">
                        <a href="functions\edit_profilepic.php?id=<?php echo $_SESSION['id_usuario'];?>"">
                          <button>SAVE</button>
                        </a>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
    </div>
<?php
}else{
    header("Location:error.html");
}
?>