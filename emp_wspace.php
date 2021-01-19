<?php 
require_once 'server_connect.inc.php';
require_once 'get_logged.inc.php';
include 'USER.php';

$new_customer = new New_Customer();

if(@($_SESSION['emp_id']==null || $_SESSION['emp_id']==""))
{
die(header('Location:index.php'));
}
 ?>
<html>
<head>
  <meta charset="utf-8">
  <title>Employee Workspace</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">        
  <link rel="stylesheet" href="css/templatemo_main.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/templatemo_script.js"></script>
</head>

<body>
  <div id="main-wrapper">
    <div class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <div class="logo"><h1>Employee Workspace</h1></div>
      </div>   
    </div>
<?php		

    if(isset($_GET['subtopic_newacc']))
	{
	    include "admin-files/new_customer.php"; 
    }
	if(isset($_GET['subtopic_updateinfo']))
	{
	    include "admin-files/update_info.php"; 
    }
	
	if(!isset($_GET['subtopic_newacc']) && !isset($_GET['subtopic_updateinfo']))
		{			
	?>	
		<div align="center">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th><a href="emp_wspace.php?subtopic_newacc=new_customer"><div align="center">New Customer</div></a></th>
                        </tr>
                    </thead>
		
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th><a href="emp_wspace.php?subtopic_updateinfo=update_info"><div align="center">Make Changes</div></a></th>
                        </tr>
                    </thead>

                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th><a href="javascript:;" data-toggle="modal"  data-backdrop="false" data-target="#confirmModal"><div align="center"><i class="fa fa-sign-out"></i>Logout</div></a></th>
                        </tr>
                     </thead>			    
<?php	
	}
?>
        <div class="modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Are you sure you want to sign out?</h4>
					    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
							
                    <div class="modal-footer">
                        <a href="logout.php" class="btn btn-primary">Yes</a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</body>
</html>
