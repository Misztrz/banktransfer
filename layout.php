<?php 
require_once 'server_connect.inc.php';
require_once 'get_logged.inc.php';
include 'USER.php';

$user = new USER();
$credit = new Credit();
$transfer = new Transfer();

if(@($_SESSION['emp_id']==null || $_SESSION['emp_id']=="" || $_SESSION['password']==null || $_SESSION['password']=="") && (@($_SESSION['atm']==null || $_SESSION['atm']=="") || @($_SESSION['pin']==null || $_SESSION['pin']=="")))
{
die(header('Location:index.php'));
}

$user->setAccno($_SESSION['acc_no']);
$query01="SELECT * FROM customers WHERE Acc_no='".$user->getAccno()."'";
$query01_data=$mysql1->query($query01);
$query01_result=$query01_data->fetch_assoc();

$user->setFname($query01_result['First_name']);
$user->setStatus($query01_result['Status']);
$user->setAmount($query01_result['Amount']);

 if($user->getStatus() == 'Member')
		$label = 'primary';
	else
		$label = 'danger';
?>
<!DOCTYPE html>
<html>
<head>
  <title>OTS Transfer Money</title>
  
  <meta charset="utf-8">
  <meta name="author" content="Me" />
  <meta name="copyright" content="Me" />
  <meta name="keywords" lang="en" content="transfers, money, credits, transations">
  <meta name="keywords" lang="pl" content="pieniadze, transakcjem, przelewy, kredyty">
  <meta name="description" content="Make your transactions in safty and easily way">
  <meta name="viewport" content="width=device-width">        
  <link rel="stylesheet" type="text/css" href="css/templatemo_main.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/templatemo_script.js"></script>
</head>
<body>
    <nav class="navbar top-bar-gradient" role="navigation">
                <span class="logo hope">OTS Transfer Money</span>
			    <span class="top1-menu-word">User Name: <?php echo $user->getFname();?></span>
				<span class="top2-menu-word">Status: <span class="badge badge-<?php echo $label;?>"><?php echo $user->getStatus();?></span></span>
                <span><button type="button" class="btn btn-primary top3-menu-word" data-target="#confirmModal" data-backdrop="false" data-toggle="modal"><i class="fa fa-sign-out"></i>Logout</button></span>
    </nav>
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
        <div class="templatemo-sidebar">
            <ul class="navbar-nav templatemo-sidebar-menu">
                <li <?php if(isset($_GET['subtopic_credit'])){?> class="nav-item active" <?php }?> ><a class="nav-link" href="layout.php?subtopic_credit=credit_cash"><i class="fa fa-credit-card"></i>Credit-Cash</a></li>
                <li <?php if(isset($_GET['subtopic_transfer'])){?> class="nav-item active" <?php }?> ><a class="nav-link" href="layout.php?subtopic_transfer=transfer"><i class="fa fa-bank"></i>Transfer</a></li>
                <li <?php if(isset($_GET['subtopic_accsum'])){?> class="nav-item active" <?php }?> ><a class="nav-link" href="layout.php?subtopic_accsum=account_summary"><i class="fa fa-book"></i>Account Summary</a></li>
	        </ul>
        </div>
        <div class="templatemo-content-wrapper">
            <div class="templatemo-content">
			<?php  
			
			if(isset($_GET['subtopic_credit']))
			{
				showAnimatedText(35, 75, "Credit Cash");
			    include "user-files/credit_cash.php"; 
            }
			if(isset($_GET['subtopic_transfer']))
			{
				showAnimatedText(40, 75, "Transfer");
			    include "user-files/transfer.php"; 
            }
			if(isset($_GET['subtopic_accsum']))
			{
			    include "user-files/account_summary.php"; 
            }
			if(!isset($_GET['subtopic_credit']) && !isset($_GET['subtopic_transfer']) && !isset($_GET['subtopic_accsum']))
			{ echo '<div class="btn btn-outline-danger disabled text-font"><<<<</div><br><br><div class="btn btn-outline-danger disabled text-font"><<<<</div><br><br><div class="btn btn-outline-danger disabled text-font"><<<<</div><br><br><span class="btn btn-outline-secondary disabled text-font">Wybierz operacje</span>';}
			
			?>
            </div>
        </div>
		<div class="templatemo-footer">
		 Bank Transfer Money
		</div>
</html>

<?php

function showAnimatedText($x, $y, $text)
{

echo '	<svg viewBox="0 0 1500 100">
                    <symbol id="s-text">
                        <text x="'.$x.'%" y="'.$y.'%">'.$text.'</text>
                    </symbol>
                        <use class="text" xlink:href="#s-text"></use>
                        <use class="text" xlink:href="#s-text"></use>
                        <use class="text" xlink:href="#s-text"></use>
                        <use class="text" xlink:href="#s-text"></use>
                        <use class="text" xlink:href="#s-text"></use>
         </svg> ';
		
		 }
?>
