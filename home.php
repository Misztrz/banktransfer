<?php
require 'server_connect.inc.php';
if(!isset($_SESSION))
session_start();

if(isset($_POST['ATM_NO']) && !empty($_POST['ATM_NO']) && isset($_POST['PIN']) && !empty($_POST['PIN']) ){
		
		$atm_no=$_POST['ATM_NO'];
		$pin=$_POST['PIN'];
		$query1="SELECT Acc_no FROM CUSTOMERS WHERE ATM_NO='$atm_no' AND PIN='$pin'";
		
		if($query1_data=$mysql1->query($query1)){
			
			if($query1_data->num_rows ==1){
					$_SESSION['atm']=$atm_no;
					$_SESSION['pin']=$pin;
					$acc_no=mysqli_result($query1_data,0,'Acc_no');
					$_SESSION['acc_no']=$acc_no;
										
					header('Location:index.php');	
			}
			else if($query1_data->num_rows == 0){
				
				}
		}
}
?>
<?php
function mysqli_result($search, $row, $field){
$i=0;
    while($results = mysqli_fetch_array($search))
	{
        if ($i == $row){ $result=$results[$field]; }
            $i++;
			}
        return $result;
} 

if(isset($_POST['Emp_id']) && !empty($_POST['Emp_id']) && isset($_POST['Password']) && !empty($_POST['Password'])){
			$Emp_id=$_POST['Emp_id'];
			$Password=$_POST['Password'];
			$Password_new=MD5($Password);

			$query1="SELECT Emp_id FROM Employee WHERE Emp_id='$Emp_id' AND Password='$Password_new'";

			if($query1_data=$mysql1->query($query1)) {

				if($query1_data->num_rows == 1){
						$emp_id=mysqli_result($query1_data,0,'Emp_id');
						
						$_SESSION['emp_id']=$emp_id;
						header('Location:index.php');

				    }
						
				else if($query1_data->num_rows == 0){ 
						//echo 'Invalid username and/or password';
				    }
			}
    }		
	
	
	if(isset($_POST['loginReg']) && !empty($_POST['loginReg']) && isset($_POST['nameReg']) && !empty($_POST['nameReg']) && isset($_POST['contactReg']) && !empty($_POST['contactReg']) 
		&& isset($_POST['addressReg']) && !empty($_POST['addressReg']) && isset($_POST['monthReg']) && !empty($_POST['monthReg']) && isset($_POST['dayReg']) && !empty($_POST['dayReg'])
	    && isset($_POST['yearReg']) && !empty($_POST['yearReg']) && isset($_POST['pinReg']) && !empty($_POST['pinReg'])) 
		{
			
			$name=$_POST['nameReg'];
            $login=$_POST['loginReg'];
            $address=$_POST['addressReg'];
            $day=$_POST['dayReg'];
            $month=$_POST['monthReg'];
            $year=$_POST['yearReg'];
            $contact_no=$_POST['contactReg'];
            $time=time();
            $created_on=date("Y/m/d",$time);
            $pin=$_POST['pinReg'];
            $acc_no=rand(1230001,1239991);

/*concatenating stings*/
	        $dob=$year."/".$month."/".$day;

	        $query2="SELECT Acc_no,ATM_NO FROM CUSTOMERS WHERE Acc_no='$acc_no' OR ATM_NO='$login'";
	        $query2_data=$mysql1->query($query2);

	        if($row = $query2_data->num_rows == 0){
		        $query1="INSERT INTO CUSTOMERS(Acc_no,First_name,Status,DOB,Contact_no,Address,Created_on,Amount,ATM_NO,PIN) VALUES('$acc_no','$name','Member','$dob','$contact_no','$address','$created_on','0','$login','$pin')";
        
		if($query1_data = $mysql1->query($query1)){
			$query3="SELECT * FROM CUSTOMERS WHERE Acc_no='$acc_no'";
			
			if($query3_data = $mysql1->query($query3)){
			    $query3_row=$query3_data->fetch_assoc();
			    $name=$query3_row['First_name'];
			    $login=$query3_row['ATM_NO'];
				$pin=$query3_row['PIN'];
					echo '	<p class="success-msg" style="text-align: center;">Welcome to Moneta Family</h3><br>Name: '.$name.'
			                <br>Account number: '.$acc_no.'<br>Login: '.$login.'<br>PIN: '.$pin.'</p> ';
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
		                                    $i=1;
		                                    while($i<=12)
		                                    {   
						                        echo'<option>'.$i.'</option>';
                   	                            $i=$i+1;
			                                }
							            ?>
		                                </select>
                                    </div>
		                            <div class="col-md-2 margin-bottom-15">
                                        <label for="dayReg">Day</label>
                                        <select class="custom-select margin-bottom-15" id="dayReg" name="dayReg" placeholder="DAY" required>	                    
							            <?php
		                                    $i=1;
		                                    while($i<=31)
		                                    {    
						                        echo'<option>'.$i.'</option>';
                   	                            $i=$i+1;
			                                }
		                                ?>	
							            </select>
                                    </div>     
							        <div class="col-md-2 margin-bottom-15">
                                        <label for="yearReg">Year</label>
                                        <select class="custom-select margin-bottom-15" id="yearReg" name="yearReg" placeholder="YEAR" required>	        
							            <?php
		                                    $i=1900;
		                                    while($i <= date("Y"))
		                                    {   
						                        echo'<option>'.$i.'</option>';
                   	                            $i=$i+1;
			                                }
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
