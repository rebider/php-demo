<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- refresh in 30 sec. and logout if idle -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="900; url=../logout.php">
    <title>One page demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="css/styles.css" rel="stylesheet">
    <!-- TinyMCS, refer to : https://www.tiny.cloud/ >
    <script src="https://cdn.tiny.cloud/1/d19zn0pj3rrkbkz2dl52qvodai4parv91kuvlnml7r2rm1sx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: 'textarea',
        plugins:  'a11ychecker advlist advcode advtable autolink checklist export lists link image charmap preview anchor searchreplace visualblocks powerpaste fullscreen formatpainter insertdatetime media table help wordcount',
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
      })
    </script-->
    <!-- end -->
    
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #35396E;" aria-label="Ninth navbar example">
            <div class="container-xl">
                <a class="navbar-brand" href="http://site1.guosi.site">Hobby page</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarsExample07XL">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="http://site1.guosi.site">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Coffee, Travel</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="http://www.coffeeology.com.tw">Coffeeology</a></li>
                                <li><a class="dropdown-item" href="http://khh.travel/">Travel in Kaohsung</a></li>
                                <li><a class="dropdown-item" href="http://mys.coffee/">My's Cafe</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Manage Page</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="http://site1.guosi.site/manage.php">Manage</a></li>
                                <li><a class="dropdown-item" href="http://site1.guosi.site/uploadimg.php">Upload your image</a></li>
                                <li><a class="dropdown-item" href="http://site1.guosi.site/functions/reset-passwd.php">Reset user's password</a></li>
                            </ul>
                        </li>
                </div>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
            </div>
        </nav>
