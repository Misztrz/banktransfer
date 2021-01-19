<?php
if(isset($_GET['subtopic_newacc']))
	{
?>
<body>
    <div id="main-wrapper">
	    <nav class="navbar navbar-expand-lg bg-light">
            <ul class="navbar-nav">
			    <li class="nav-item"><a class="nav-link" href="emp_wspace.php"><i class="fa fa-arrow-left"></i>Back</a></li>
                <li class="nav-item"><a class="nav-link" href="emp_wspace.php?subtopic_updateinfo=update_info">Make Changes</a></li>
                <li class="nav-item"><a class="nav-link" href="javascript:;" data-backdrop="false" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Logout</a></li>
            </ul>                 
		</nav>
        <div class="margin-bottom-15" style="text-align: center;">
<?php

if(isset($_POST['First_name']) && !empty($_POST['First_name'])	&& isset($_POST['Status']) && !empty($_POST['Status']) 
	&& isset($_POST['day']) && !empty($_POST['day']) && isset($_POST['Address']) && !empty($_POST['Address']) 
    && isset($_POST['month']) && !empty($_POST['month']) && isset($_POST['year']) && !empty($_POST['year'])
    && isset($_POST['Contact_no']) && !empty($_POST['Contact_no'])){

$new_customer->setName($_POST['First_name']);
$new_customer->setStatus($_POST['Status']);
$new_customer->setAddress($_POST['Address']);
$new_customer->setDay($_POST['day']);
$new_customer->setMonth($_POST['month']);
$new_customer->setYear($_POST['year']);
$new_customer->setAmount(0);
$new_customer->setContactno($_POST['Contact_no']);
$time=time();
$new_customer->setCreatedon(date("Y/m/d",$time));
$new_customer->setPin(rand(1000,9999));
$new_customer->setAtmno(rand(459100,459199));
$new_customer->setAccno(rand(1230001,1239991));
$new_customer->setDob($new_customer->getYear()."/".$new_customer->getMonth()."/".$new_customer->getDay());

	$query2="SELECT Acc_no, ATM_NO FROM CUSTOMERS WHERE Acc_no='".$new_customer->getAccno()."' OR ATM_NO='".$new_customer->getAtmno()."'";
	$query2_data=$mysql1->query($query2);

	if($row = $query2_data->num_rows == 0){
		$query1="INSERT INTO CUSTOMERS(Acc_no,First_name,Status,DOB,Contact_no,Address,Created_on,Amount,ATM_NO,PIN) VALUES('".$new_customer->getAccno()."','".$new_customer->getName()."','".$new_customer->getStatus()."','".$new_customer->getDob()."','".$new_customer->getContactno()."','".$new_customer->getAddress()."','".$new_customer->getCreatedon()."','".$new_customer->getAmount()."','".$new_customer->getAtmno()."','".$new_customer->getPin()."')";
        
		if($query1_data = $mysql1->query($query1)){
			$query_insert_in_credit = "INSERT INTO credit_cash(saldo, owner) VALUES('0', '".$new_customer->getAccno()."')";
			$mysql1->query($query_insert_in_credit);
			$query3="SELECT * FROM CUSTOMERS WHERE Acc_no='".$new_customer->getAccno()."'";
			
			if($query3_data = $mysql1->query($query3)){			    
				echo $new_customer->newcustomerConfirmMsg();										
			}else { echo '<p class="error-msg">Pretty close!</p>'; }
				
		}else{  echo '<p class="error-msg">Something wrong</p>';}		
				
	}else { echo'<p class="error-msg">Account exists!</p>';}
	
}else {
	?>
	</div>
        <div align="center">
            <h1>Create a new Customer Account here.</h1> 
		    <p class="margin-bottom-15">Please verify the details.</p>
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="emp_wspace.php?subtopic_newacc=new_customer" id="templatemo-preferences-form" method="POST">
                        <div class="row">
                            <div class="col-md-6 margin-bottom-15">
                                <label for="First_name" class="control-label">First Name</label>
                                <input type="text" class="form-control" id="First_name" name="First_name" placeholder="First Name" required>                  
                            </div>
							
                            <div class="col-md-6 margin-bottom-15">
                                <label for="Status" class="control-label">Status</label>
                                <select class="custom-select margin-bottom-15" id="Status" name="Status" required>
	                                <option>Member</option>
						            <option>Administrator</option>
		                        </select>								
                            </div>
                        </div> 

		                <div class="row">
                            <div class="col-md-6 margin-bottom-15">
                                <label for="contactno" class="control-label">Contact Number</label>
                                <input type="number" class="form-control" id="contactno" name="Contact_no" placeholder="Contact Number" required>                  
                            </div>
							
                            <div class="col-md-6 margin-bottom-15">
                                <label for="Address" class="control-label">Address</label>
                                <input type="text" class="form-control" id="Address" name="Address" placeholder="Address" required>                 
                            </div>
                        </div>
		
		                <div class="row">
                            <div class="col-md-2 margin-bottom-15" align="center">
							    <label>Date of Birth:</label>
							</div>

	                        <div class="col-md-2 margin-bottom-15">
                                <label for="month">Month</label>
                                <select class="custom-select margin-bottom-15" id="month" name="month" placeholder="MONTH" required>
	
	                        <?php
							    $new_customer->showRange(1, 12);	                  
							?>
						
		                        </select>
                            </div>
							
		                    <div class="col-md-2 margin-bottom-15">
                                <label for="day">Day</label>
                                <select class="custom-select margin-bottom-15" id="day" name="day" placeholder="DAY" required>
		                    
							<?php
							    $new_customer->showRange(1, 31);	                    
		                    ?>
							
							    </select>
                            </div>
		                    
							<div class="col-md-2 margin-bottom-15">
                                <label for="year">Year</label>
                                <select class="custom-select margin-bottom-15" id="year" name="year" placeholder="YEAR" required>
		                    
							<?php
							    $new_customer->showRange(1900, date("Y"));
                            ?>	
		                        </select>                  
                            </div>                                     
		                </div>
                </div>
	            <div style="margin-left: 45%;"> 
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>    
                </div>
                    </form>
            </div>
        </div>
	</div>
</body>

<?php
	    }
	}
?>
