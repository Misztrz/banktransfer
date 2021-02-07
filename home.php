<?php
require 'server_connect.inc.php';
include 'USER.php';
if(!isset($_SESSION))
session_start();

$account = new Account();
$user = new USER();
$create_acc = new Create_Account();

if(isset($_POST['ATM_NO']) && !empty($_POST['ATM_NO']) && isset($_POST['PIN']) && !empty($_POST['PIN']) ){
		
		$account->setAtmno($_POST['ATM_NO']);
		$account->setPin($_POST['PIN']);
		$query1="SELECT Acc_no FROM CUSTOMERS WHERE ATM_NO='".$account->getAtmno()."' AND PIN='".$account->getPin()."'";
		
		if($query1_data=$mysql1->query($query1)){
			
			if($query1_data->num_rows == 1){
					$_SESSION['atm']=$account->getAtmno();
					$_SESSION['pin']=$account->getPin();
					$user->setAccno($account->mysqli_result($query1_data, 0, 'Acc_no'));
					$_SESSION['acc_no']=$user->getAccno();					
					header('Location:index.php');
				echo "login ok";
			}
			else {
				echo "login error";
				}
		}
}

if(isset($_POST['Emp_id']) && !empty($_POST['Emp_id']) && isset($_POST['Password']) && !empty($_POST['Password'])){
			$account->setEmpid($_POST['Emp_id']);
			$account->setPassword($_POST['Password']);
			$Password_new=MD5($account->getPassword());

			$query1="SELECT Emp_id FROM Employee WHERE Emp_id='".$account->getEmpid()."' AND Password='$Password_new'";

			if($query1_data=$mysql1->query($query1)) {

				if($query1_data->num_rows == 1){
						$account->setEmpid($account->mysqli_result($query1_data, 0, 'Emp_id'));
						$_SESSION['emp_id']=$account->getEmpid();
						$_SESSION['password']=$account->getPassword();
						header('Location:index.php');
				    }
				else if($query1_data->num_rows == 0){ 
				    }
			}
    }		
	
	if(isset($_POST['loginReg']) && !empty($_POST['loginReg']) && isset($_POST['nameReg']) && !empty($_POST['nameReg']) && isset($_POST['contactReg']) && !empty($_POST['contactReg']) 
		&& isset($_POST['addressReg']) && !empty($_POST['addressReg']) && isset($_POST['monthReg']) && !empty($_POST['monthReg']) && isset($_POST['dayReg']) && !empty($_POST['dayReg'])
	    && isset($_POST['yearReg']) && !empty($_POST['yearReg']) && isset($_POST['pinReg']) && !empty($_POST['pinReg'])) 
		{
			$create_acc->setName($_POST['nameReg']);
            $create_acc->setLogin($_POST['loginReg']);
            $create_acc->setAddress($_POST['addressReg']);
            $create_acc->setDay($_POST['dayReg']);
            $create_acc->setMonth($_POST['monthReg']);
            $create_acc->setYear($_POST['yearReg']);
            $create_acc->setContactno($_POST['contactReg']);
            $time=time();
            $create_acc->setCreatedon(date("Y/m/d",$time));
            $create_acc->setPin($_POST['pinReg']);
            $create_acc->setAccno(rand(1230001,1239991));
	        $create_acc->setDob($create_acc->getYear()."/".$create_acc->getMonth()."/".$create_acc->getDay());

	        $query2="SELECT Acc_no,ATM_NO FROM CUSTOMERS WHERE Acc_no='".$create_acc->getAccno()."' OR ATM_NO='".$create_acc->getLogin()."'";
	        $query2_data=$mysql1->query($query2);

	        if($row = $query2_data->num_rows == 0){
		        $query1="INSERT INTO CUSTOMERS(Acc_no,First_name,Status,DOB,Contact_no,Address,Created_on,Amount,ATM_NO,PIN) VALUES('".$create_acc->getAccno()."','".$create_acc->getName()."','Member','".$create_acc->getDob()."','".$create_acc->getContactno()."','".$create_acc->getAddress()."','".$create_acc->getCreatedon()."','0','".$create_acc->getLogin()."','".$create_acc->getPin()."')";
        
		if($query1_data = $mysql1->query($query1)){
			$query_insert_in_credit = "INSERT INTO credit_cash(saldo, owner) VALUES('0', '".$create_acc->getAccno()."')";
			$mysql1->query($query_insert_in_credit);
			$query3="SELECT * FROM CUSTOMERS WHERE Acc_no='".$create_acc->getAccno()."'";
			
			if($query3_data = $mysql1->query($query3)){
				echo $create_acc->showData();
			}
		}else{  echo '<p class="error-msg">Something wrong</p>';}			
	}else { echo'<p class="error-msg">Account exists!</p>';}
}		
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example that shows off a responsive product landing page.">

<title>OTS Transfer Money</title>
<link rel="stylesheet" href="css/templatemo_main.css">
<script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/templatemo_script.js"></script>
</head>

<body>

<div class="header">
    <span class="home-heading">OTS Transfer Money</span>
</div>
   <div class="circle">
       <div class="quarter yellow"></div>
       <div class="quarter orange"></div>
        <button type="button" class="cut btn btn-primary" data-backdrop="false" data-toggle="modal" data-target="#registerModal">Register</button>
	</div>
	<div class="modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #09db87;">
                                <h4 class="modal-title" style="margin-left: 37%;" id="myModalLabel">Create your Account</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
							
							<form role="form" action="home.php" method="POST">
							<div class="modal-body">					
							    <div class="row">
								     <div class="col-md-6 margin-bottom-15">
								        <label for="loginReg" class="control-label">Login</label>
									    <input type="number" class="form-control" id="loginReg" name="loginReg" placeholder="Login" required>
									</div>
								    <div class="col-md-6 margin-bottom-15">
								        <label for="nameReg" class="control-label">Name</label>
									    <input type="text" class="form-control" id="nameReg" name="nameReg" placeholder="Name" required>
									</div>
								</div>
								<div class="row">
								    <div class="col-md-6 margin-bottom-15">
								        <label for="contactReg" class="control-label">Contact</label>
									    <input type="text" class="form-control" id="contactReg" name="contactReg" placeholder="Contact" required>
									</div>
									<div class="col-md-6 margin-bottom-15">
									    <label for="addressReg" class="control-label">Address</label>
									    <input type="text" class="form-control" id="addressReg" name="addressReg" placeholder="Address" required>
								    </div>							
								</div>
								<div class="row">
                                    <div class="col-md-2 margin-bottom-15" align="center">
							            <label>Date of Birth:</label>
							        </div>
	                                <div class="col-md-2 margin-bottom-15">
                                        <label for="monthReg">Month</label>
                                        <select class="custom-select margin-bottom-15" id="monthReg" name="monthReg" placeholder="MONTH" required>	
	                                    <?php										
										    $create_acc->showRange(1, 12);		                                
							            ?>
		                                </select>
                                    </div>
		                            <div class="col-md-2 margin-bottom-15">
                                        <label for="dayReg">Day</label>
                                        <select class="custom-select margin-bottom-15" id="dayReg" name="dayReg" placeholder="DAY" required>	                    
							            <?php
		                                    $create_acc->showRange(1, 31);	                                    
		                                ?>	
							            </select>
                                    </div>     
							        <div class="col-md-2 margin-bottom-15">
                                        <label for="yearReg">Year</label>
                                        <select class="custom-select margin-bottom-15" id="yearReg" name="yearReg" placeholder="YEAR" required>	        
							            <?php
										    $create_acc->showRange(1900, date("Y"));	                                    
                                        ?>
		                                </select>                  
                                    </div>  
                                    <div class="col-md-2 margin-bottom-15">
									    <label for="pinReg" class="control-label">PIN</label>
									    <input type="number" class="form-control" id="pinReg" name="pinReg" placeholder="PIN" required>
								    </div>	         							
							    </div>
							
							</div>
							
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Create</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
							</form>
                        </div>
                    </div>
        </div>

    
<div class="content-wrapper">
    <div class="ribbon padding-2 is-center">
		<h2 class="content-head"><div class="set-to-white">User Login</div></h2>

        <div class="home-box">
            <form class="form-group" role="form" action="home.php" method="POST">
                <fieldset>
				
                    <label for="name"><div class="set-to-white">Account Login</div></label>
                    <input type="text" class="form-control" id="ATM_NO" name="ATM_NO" placeholder="Your Account Login" required>

                    <label for="password"><div class="set-to-white">PIN</div></label>
                    <input type="password" class="form-control" id="PIN" name="PIN" placeholder="Your PIN" required>
			
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </fieldset>
            </form>
        </div> 
    </div>
	
	<div class="content-head-ribbon padding-2 is-center">
    <h2 class="content-head">LOGGING AS AN ADMIN</h2>
		<div class="home-box">
            <form class="form-group" role="form" action="home.php" method="POST">
                <fieldset>

                    <label for="name">Employee ID</label>
                    <input type="text" class="form-control" id="Emp_id" name="Emp_id" placeholder="Employee ID" required>

                    <label for="password">Your Password</label>
                    <input type="password" class="form-control" id="Password" name="Password"  placeholder="Your Password" required>
 
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </fieldset>
            </form>
		</div>
	</div>  
</div>
</body>
</html>
