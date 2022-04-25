<?php
include_once "../Controllers/tablesController.php";
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['ActivePage'] = "../pages/dashboard-investors.php";
    header("Location: /Aisha/pages/login.php");

} else {
    $loggedUser = unserialize($_SESSION['user']);
    $userId = $loggedUser->getUserId();
    $vistorTableData = $tenantData = $investorData = "";

    $pdo = getPdo();
    if(isset($_POST['delete'])){
        delete($pdo,$_POST['delete']);
    }

    $investorData = getInvestor($pdo);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../media/images/apple-icon.png">
    <link rel="icon" type="image/png" href="../media/images/favicon.png">
    <title>
        Investors Dashboard
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="../css/nucleo-icons.css" rel="stylesheet"/>
    <link href="../css/nucleo-svg.css" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../css/nucleo-svg.css" rel="stylesheet"/>
    <!-- CSS Files -->
    <link id="pagestyle" href="../css/aisha-dashboard.css?v=1.0.4" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="/Aisha/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" /Aisha/index.php "
           target="_blank">
            <img src="../media/images/comfortable-coliving.png" class="navbar-brand-img h-100" alt="logo">
            <!-- <span class="ms-1 font-weight-bold">Senior cohousing</span> -->
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
        <li class="nav-item">
                <a class="nav-link  " href="dashboard.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md  text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-chart-bar-32 text-lg  text-dark" aria-hidden="true"></i>

                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="dashboard-investors.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-money-coins text-lg " aria-hidden="true"></i>
                    
                    </div>
                    <span class="nav-link-text ms-1">Investors</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  " href="renters-dashboard.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md  text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-building text-lg text-dark "></i>
                    </div>
                    <span class="nav-link-text ms-1">Renters</span>
                </a>
            </li>
            <li class="nav-item">
                    <a class="nav-link  " href="visitors.php">
                        <div class="icon icon-shape icon-sm shadow border-radius-md   me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-lg text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Short Stay</span>
                    </a>
                </li>
            <!-- <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link  " href="profile.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>Profile</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6"
                                                  d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                            <path class="color-background"
                                                  d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                            <path class="color-background"
                                                  d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link  " href="sign-out.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-button-power text-lg text-dark" aria-hidden="true"></i>

                    </div>
                    <span class="nav-link-text ms-1">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 "></div>
    <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard"></div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <!-- <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tables</li>
                </ol> -->
                <h6 class="font-weight-bolder mb-0">Investors Dashboard</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a  href="sign-out.php" class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Sign Out</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0">
                            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Investors</h6>
                    </div>
                    <div class="card-body px-2 pt-2 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 display" id="myTable2">
                                <thead>
                                <tr>
                                    <td hidden = "hidden" ></td>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Age
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Contact Number
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        City
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Postal Code
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Province
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Invest Amount
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Message
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($investorData as $data) {
                                    echo "<tr>";
                                    extracted($data);
                                    $fmt = numfmt_create( 'en_US', NumberFormatter::CURRENCY );
                                    echo '<td class="border-bottom-0"><p class="text-xs font-weight-bold mb-0 text-center">' . numfmt_format_currency($fmt,$data["Invest_Amount"],"CAD") . '</p ></td>';
                                    echo '<td class="border-bottom-0 text-center"><button type="button" class="btn btn-link text-xs font-weight-bold mb-0 badge rounded-pill bg-success" data-bs-toggle="modal" data-bs-target="#exampleModal' . $data["id"] .'">Open</button>'.modalMessage("exampleModal".$data["id"],$data["Comments"],$data["First_Name"],$data["Last_Name"]).'</td>';
                                    echo '<td class="border-bottom-0">';
                                    echo '<p class="text-xs font-weight-bold mb-0">' . $data["Date_Message"] . '</p >';
                                    echo '</td >';
                                    deleteButton($data["id"],"dashboard-investors");
                                    
                                    // echo "<td class='border-bottom-0'><form action='dashboard-investors.php' method='post'><button name='delete' class='btn btn-danger text-xs mb-0'  value='".$data["id"]."' onclick=".'"return confirm('."'This will delete this message. Click Ok to Confirm !'".')" >Delete</button></form></td>';

                                    echo "</tr>";

                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer pt-3  ">
        </footer>
    </div>
</main>
<!-- <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Dashboard Configurator</h5>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <div>
                <h6 class="mb-0">Sidebar Colors</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="badge filter bg-gradient-primary active" data-color="primary"
                          onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success"
                          onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning"
                          onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger"
                          onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <div class="mt-3">
                <h6 class="mb-0">Sidenav Type</h6>
                <p class="text-sm">Choose between 2 different sidenav types.</p>
            </div>
            <div class="d-flex">
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent"
                        onclick="sidebarType(this)">Transparent
                </button>
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white"
                        onclick="sidebarType(this)">White
                </button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <div class="mt-3">
                <h6 class="mb-0">Navbar Fixed</h6>
            </div>
            <div class="form-check form-switch ps-0">
                <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                       onclick="navbarFixed(this)">
            </div>
            <hr class="horizontal dark my-sm-4">
        </div>
    </div>
</div> -->
<!--   Core JS Files   -->
<script src="../javascript/core/popper.min.js"></script>
<script src="../javascript/core/bootstrap.min.js"></script>
<script src="../javascript/plugins/perfect-scrollbar.min.js"></script>
<script src="../javascript/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../javascript/aisha-dashboard.min.js?v=1.0.4"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
<script>
        $(document).ready(function() {

            $('#myTable2').DataTable();

        });
    </script>
</body>

</html>
