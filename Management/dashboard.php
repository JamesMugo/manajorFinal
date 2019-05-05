  <?php require('../classes/database.php');?>
  <?php require('../classes/functions.php');?>
  <?php
  sessionCheck();

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manajor - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-home"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Manajor <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <div>
        <!--Nav Item - Property Owners Collapse Menu -->
        <!--manage property owners (view, add, delete, update)-->
        <div>
          <li class="nav-item active">
            <a class="nav-link" href="javascript:void(0)" onclick="unhide()">
              <i class="fas fa-user-tie"></i>
              <span>Property owners</span></a>
          </li>
        </div>

          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">

          <!-- Tenant's link for approval-->
        <div>
          <li class="nav-item active">
            <a class="nav-link" href="javascript:void(0)" onclick="unhide1()">
              <i class="fas fa-users"></i>
              <span>Tenants</span></a>
          </li>
        </div>

          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">

          <!-- Property's link for approval-->
        <div>
          <li class="nav-item active">
            <a class="nav-link" href="javascript:void(0)" onclick="unhide2()">
              <i class="far fa-building"></i>
              <span>Property</span></a>
          </li>
        </div>

          <hr class="sidebar-divider d-none d-md-block">
        <div>
          <li class="nav-item active">
            <a class="nav-link" href="javascript:void(0)" onclick="unhide3()">
              <i class="fas fa-home"></i>
              <span>Rooms</span></a>
          </li>
        </div>


  <!--------------------------------------------------------------------------------------------------------->



        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>
      <!-- End of Sidebar -->


      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php displayUser(); ?></span>

                  <img class="img-profile rounded-circle" src="<?php echo $_SESSION["profileImg"]; ?>">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>

            </ul>

          </nav>
          <!-- End of Topbar -->





          <!-- Begin Page Content -->
          <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
              <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

          <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="row">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Property Owners:</div>
                        <div class="col-auto">
                          <i class="fas fa-user-tie"></i>
                        </div>               
                      </div>
                      <hr>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo propertyOwnersCount(); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="row">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tenants</div>
                        <div class="col-auto">
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <hr>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo tenantsCount(); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="row">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Property</div>
                        <div class="col-auto">
                          <i class="far fa-building"></i>
                        </div>                       
                      </div>
                      <hr>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo propertyCount(); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="row">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Rooms</div>
                        <div class="col-auto">
                          <i class="fas fa-home"></i>
                        </div>
                      </div>
                      <hr>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo vacantCount(); ?></div>
                      <hr>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo occupiedCount(); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>


            <div class="card shadow mb-4" id="ownerPanel" style="display: none;">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Property Owners</h6>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addOwnerModal">ADD OWNERS</button>
              </div>
              <div class="modal fade" id="addOwnerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Fill the form below then click ADD OWNERS</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form class="user" action="" method="POST" enctype="multipart/form-data">
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <input type="text" class="form-control form-control-user" name="firstname" placeholder="First Name" required="required">
                            </div>
                            <div class="col-sm-6">
                              <input type="text" class="form-control form-control-user" name="lastname" placeholder="Last Name" required="required">
                            </div>
                          </div>
                          <hr>
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <input type="text" class="form-control form-control-user" name="id" placeholder="National Identity" required="required">
                            </div>
                            <div class="col-sm-6">
                              <select class="form-control" name="propertyOwned">
                                <option selected>Choose Property Type</option>
                                <option>Self contained</option>
                                <option>Houses</option>
                                <option>Apartments</option>
                              </select>
                            </div>
                            <!--div class="col-sm-6">
                              <input type="text" class="form-control form-control-user" name="propertyOwned" placeholder="Property Owned" required="required">
                            </div-->
                          </div>
                          <hr>
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <input type="text" class="form-control form-control-user" name="location" placeholder="Location" required="required">
                            </div>
                            <div class="col-sm-6">
                              <input type="text" class="form-control form-control-user" name="number_of_rooms" placeholder="Number of Rooms" required="required">
                            </div>
                          </div>
                          <hr>
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <input type="file" name="agreement" id="agreement"><label> Agreement Form </label>
                            </div>
                          </div>
                          <hr>
                          <div class="col-xs-6 col-md-6">
                            <input type="submit" name="addowners" value="Add Property Owner" class="btn btn-primary btn-user btn-block" style="width: 210%">
                          </div>
                          <!--a href="login.php" class="btn btn-primary btn-user btn-block">
                            Register Account
                          </a-->
                      </form>
                    </div>
                  </div>
                </div>
              </div>


              <div class="table-responsive">
                <?php echo displayContent(); ?>

              </div>

              <form class="user" id="editform" style="display: none">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="firstname" placeholder="First Name" required="required" id="fname">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="lastname" placeholder="Last Name" required="required" id="lname">
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="number_of_rooms" placeholder="number_of_rooms" required="required" id="number_of_rooms">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="propertyOwned" placeholder="Property Owned" required="required" id="property">
                  </div>
                </div>
                <hr>

                <input type="hidden" name="ownerid" id="ownerid">

                <div class="col-xs-6 col-md-6">
                  <input type="button" name="submit" id="updateform" value="Update Property Owner" class="btn btn-primary btn-user btn-block" style="width: 210%">
                </div>
              </form>
            </div>

            <div class="card shadow mb-4" id="tenantPanel" style="display: none;">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tenants</h6>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addTenantModal">ADD TENANTS</button>
              </div>

              <div class="modal fade" id="addTenantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Fill the form below then click ADD TENANTS</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form class="user" action="" method="POST">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="firstname" placeholder="First Name" required="required">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="lastname" placeholder="Last Name" required="required">
                          </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="nationalid" placeholder="National Id." required="required">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="contacts" placeholder="Phone Number" required="required">
                          </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <select class="form-control" id="propDrop" name="propertyno">
                              <option>select property number</option>
                              <?php drpProp(); ?>
                            </select>
                          </div>
                          <div class="col-sm-6">
                            <select class="form-control" id="hseDrop" name="houseno">
                              <option>select room number</option>
                              <?php dropHse(); ?>
                            </select>
                          </div>
                          <!--div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="propertyno" placeholder="Property Number" required="required">
                          </div-->
                          <!--div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="houseno" placeholder="House Number" required="required">
                          </div-->
                        </div>
                        <hr>
                        <div class="col-xs-6 col-md-6">
                          <input type="submit" name="addtenant" value="Add Tenant" class="btn btn-primary btn-user btn-block" style="width: 210%">
                        </div>
                        <!--a href="login.php" class="btn btn-primary btn-user btn-block">
                          Register Account
                        </a-->
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <?php echo displayTenants(); ?>

              </div>

              <form class="user" id="editTenform" style="display: none">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="firstname" placeholder="First Name" required="required" id="fTname">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="lastname" placeholder="Last Name" required="required" id="lTname">
                  </div>
                  
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="identity" placeholder="Identity Number" required="required" id="identity">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="contacts" placeholder="Phone Number" required="required" id="contacts">
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="plotno" placeholder="Plot Number" required="required" id="plotno">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="hseno" placeholder="House Number" required="required" id="hseno">
                  </div>
                </div>
                <hr>

                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="payment_status" placeholder="Rent Status" required="required" id="payment_status">
                </div>

                <input type="hidden" name="tenid" id="tenid">
                <hr>

                <div class="col-xs-6 col-md-6">
                  <input type="button" name="submit" id="updateTenform" value="Update Tenant" class="btn btn-primary btn-user btn-block" style="width: 210%">
                </div>
              </form>
            </div>

            <div class="card shadow mb-4" id="propertyPanel" style="display: none;">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Property</h6>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPropertyModal">ADD PROPERTY</button>
              </div>

              <div class="modal fade" id="addPropertyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Fill the form below then click ADD PROPERTY</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form class="user" action="" method="POST">
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="ownerid" placeholder="Onwer's Id" required="required">
                          </div>
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="description" placeholder="Property Owned" required="required">
                          </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="capacity" placeholder="Number of Rooms" required="required">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="location" placeholder="Location" required="required">
                          </div>
                        </div>
                        <hr>
                        <div class="col-xs-6 col-md-6">
                          <input type="submit" name="addproperty" value="Add Property" class="btn btn-primary btn-user btn-block" style="width: 210%">
                        </div>
                        <!--a href="login.php" class="btn btn-primary btn-user btn-block">
                          Register Account
                        </a-->
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <?php echo displayProperty(); ?>

              </div>

              <form class="user" id="editPropForm" style="display: none">
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" class="form-control form-control-user" name="ownersid" placeholder="Owner's Id" required="required" id="ownersid">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control form-control-user" name="description" placeholder="Property Owned" required="required" id="description">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <input type="text" class="form-control form-control-user" name="capacity" placeholder="Capacity" required="required" id="capacity">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control form-control-user" name="location" placeholder="Location" required="required" id="location">
                    </div>
                  </div>
                  <hr>

                  <input type="hidden" name="propid" id="propid">

                  <div class="col-xs-6 col-md-6">
                    <input type="button" name="submit" id="updatePropForm" value="Update Property" class="btn btn-primary btn-user btn-block" style="width: 210%">
                  </div>
              </form>
            </div>


            <div class="card shadow mb-4" id="roomsPanel" style="display: none;">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rooms</h6>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addRoomModal">Add Rooms</button>
              </div>

              <div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Fill the form below then click ADD ROOMS</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form class="user" action="" method="POST">
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="propertyno" placeholder="Property Number" required="required">
                          </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="description" placeholder="Description" required="required">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="price" placeholder="Rent" required="required">
                          </div>
                        </div>
                        <hr>
                        <div class="col-xs-6 col-md-6">
                          <input type="submit" name="addroom" value="Add Room" class="btn btn-primary btn-user btn-block" style="width: 210%">
                        </div>
                        <!--a href="login.php" class="btn btn-primary btn-user btn-block">
                          Register Account
                        </a-->
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <?php echo displayRooms(); ?>

              </div>
            </div>

            <form class="user" id="editRoomForm" style="display: none">
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" class="form-control form-control-user" name="pno" placeholder="Property Id" required="required" id="pno">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control form-control-user" name="desc" placeholder="Property Description" required="required" id="desc">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <input type="text" class="form-control form-control-user" name="price" placeholder="Rent" required="required" id="price">
                    </div>
                  </div>
                  <hr>

                  <input type="hidden" name="rid" id="rid">

                  <div class="col-xs-6 col-md-6">
                    <input type="button" name="submit" id="updateRoomForm" value="Update Room" class="btn btn-primary btn-user btn-block" style="width: 210%">
                  </div>
              </form>


          </div>
        <!-- End of Main Content -->




      </div>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Manajor 2019</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>



    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!--profile -->
      <!-- Logout Modal-->

    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div>
            <form class="user" id="editform">
              <div class="form-control-user">
                <img class="img-profile rounded-circle" src="<?php echo $_SESSION["profileImg"]; ?>" style="display: block; margin-left: auto;
                  margin-right: auto;">
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  Firstname: <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['firstname']; ?>">
                </div>
                <div class="col-sm-6">
                  Lastname: <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['lastname']; ?>">
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-sm-6">
                  Username: <input type="text" class="form-control form-control-user" value="<?php echo $_SESSION['username']; ?>">
                </div>
                <div class="col-sm-6">
                  Email: <input type="email" class="form-control form-control-user" value="<?php echo $_SESSION['email']; ?>">
                </div>
              </div>
              <hr>

              <input type="hidden" name="staffid" id="staffid">
          </form>
          </div>



          
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">BACK</button>
          </div>
        </div>
      </div>
    </div>
    <!--end of profile-->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script type="text/javascript">
      function unhide(){
        document.getElementById('ownerPanel').style.display='block';
        document.getElementById('tenantPanel').style.display='none';
        document.getElementById('propertyPanel').style.display='none';
        document.getElementById('roomsPanel').style.display='none';
      }
      function unhide1(){
        document.getElementById('tenantPanel').style.display='block';
        document.getElementById('ownerPanel').style.display='none';
        document.getElementById('propertyPanel').style.display='none';
        document.getElementById('roomsPanel').style.display='none';
      }
      function unhide2(){
        document.getElementById('propertyPanel').style.display='block';
        document.getElementById('tenantPanel').style.display='none';
        document.getElementById('ownerPanel').style.display='none';
        document.getElementById('roomsPanel').style.display='none';
      }
      function unhide3(){
        document.getElementById('roomsPanel').style.display='block';
        document.getElementById('propertyPanel').style.display='none';
        document.getElementById('tenantPanel').style.display='none';
        document.getElementById('ownerPanel').style.display='none';
      }
    </script>
    <!--edit and update for property_owners-->
    <script>
      function editOwners(oid, fname, lname, property, number_of_rooms){
        document.getElementById('editform').style.display = "block";
        document.getElementById('fname').value = fname;
        document.getElementById('ownerid').value = oid;
        document.getElementById('lname').value = lname;
        document.getElementById('number_of_rooms').value = number_of_rooms;
        document.getElementById('property').value = property;
      }

      $("#updateform").click(function(){

        $.post("php/update.php",
        {
          firstname: $('#fname').val(),
          lastname: $('#lname').val(),
          propertyOwned: $('#property').val(),
          number_of_rooms: $('#number_of_rooms').val(),

          ownerid: $('#ownerid').val(),
          submit: "yes"
        },
        function(data, status){
          alert(data);
          window.location.href = "dashboard.php";
        });
      });
    </script>

    <!-- house drop down controll-->
    <script>
      $("#propDrop").change(function(){
        var selectRoom = 
        $(this).children("option:selected").val();
         $.post("php/displayRooms.php",
        {
          propertyID: selectRoom,
        },
        function(data, status){
          $("#hseDrop").html(data);
        });
      }

        )
    </script>



    <!--edit and update for tenants-->
    <script>
      function editTenants(tenid, fTname, lTname, identity, contacts, plotno, hseno, payment_status){
        document.getElementById('editTenform').style.display = "block";
        document.getElementById('fTname').value = fTname;
        document.getElementById('tenid').value = tenid;
        document.getElementById('lTname').value = lTname;
        document.getElementById('identity').value = identity;
        document.getElementById('contacts').value = contacts;
        document.getElementById('plotno').value = plotno;
        document.getElementById('hseno').value = hseno;
        document.getElementById('payment_status').value = payment_status;
      }

      $("#updateTenform").click(function(){

        $.post("php/updateTenant.php",
        {
          firstname: $('#fTname').val(),
          lastname: $('#lTname').val(),
          identity: $('#identity').val(),
          contacts: $('#contacts').val(),
          propertyno: $('#plotno').val(),
          hseno: $('#hseno').val(),
          payment_status: $('#payment_status').val(),

          tenid: $('#tenid').val(),
          submit: "yes"
        },
        function(data, status){
          alert(data);
          window.location.href = "dashboard.php";
        });
      });
    </script>

    <!--edit and update for property-->
    <script>
      function editProperty(propid ,ownersid, description, capacity, location){
        document.getElementById('editPropForm').style.display = "block";
        document.getElementById('propid').value = propid;
        document.getElementById('ownersid').value = ownersid;
        document.getElementById('description').value = description;
        document.getElementById('capacity').value = capacity;
        document.getElementById('location').value = location;
      }

      $("#updatePropForm").click(function(){
        alert("jerdg");
        $.post("php/updateProperty.php",
        {
          ownersid: $('#ownersid').val(),
          description: $('#description').val(),
          capacity: $('#capacity').val(),
          location: $('#location').val(),

          propid: $('#propid').val(),
          submit: "yes"
        },
        function(data, status){
          alert(data);
          window.location.href = "dashboard.php";
        });
      });
    </script>

        <!--edit and update for rooms-->
    <script>
      function editRoom(rid , pno, desc, price){
        document.getElementById('editRoomForm').style.display = "block";
        document.getElementById('rid').value = rid;
        document.getElementById('pno').value = pno;
        document.getElementById('desc').value = desc;
        document.getElementById('price').value = price;
      }

      $("#updateRoomForm").click(function(){

        $.post("php/updateRoom.php",
        {
          pno: $('#pno').val(),
          desc: $('#desc').val(),
          price: $('#price').val(),

          rid: $('#rid').val(),
          submit: "yes"
        },
        function(data, status){
          alert(data);
          window.location.href = "dashboard.php";
        });
      });
    </script>

  </body>

  </html>
