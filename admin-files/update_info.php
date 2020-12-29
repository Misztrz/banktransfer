<?php
if(isset($_GET['subtopic_updateinfo']))
	{
?>

<body>
  <div id="main-wrapper">
	<nav class="navbar navbar-expand-lg bg-light">
        <ul class="navbar-nav">
		    <li class="nav-item"><a class="nav-link" href="emp_wspace.php"><i class="fa fa-arrow-left"></i>Back</a></li>
            <li class="nav-item"><a class="nav-link" href="emp_wspace.php?subtopic_newacc=new_customer">New Customer <span class="badge"></span></a></li>
            <li class="nav-item"><a class="nav-link" href="javascript:;" data-backdrop="false" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Logout <span class="badge"></span></a></li>
            <li class="nav-item"><span class="navbar-text">Select an account number:</span></li>
            <li class="nav-item">
			    <form role="form" class="form-inline" action="emp_wspace.php?subtopic_updateinfo=update_info" method="POST">
				    <select class="custom-select" id="userno" name="userno">
	                    <?php
	                        $acc_no_query = $mysql1->query("SELECT Acc_no, Status FROM customers");
		                    while($account_no = $acc_no_query->fetch_assoc())
		                        {
									$save_acc_no = $account_no['Acc_no'];						
	                                echo'<option value="'.$save_acc_no.'">'.$save_acc_no.'</option>';	
								}
						?>			             					
                	</select>
					<button type="submit" class="btn btn-primary">Select</button>
			    </form>	
			</li>		
	    </ul>          
    </nav>          
<?php

    if(!isset($_SESSION['userno']))
	{
		$_SESSION['userno'] = 0;
	}
	
    if(isset($_POST['userno']) && !empty($_POST['userno']))
		$_SESSION['userno'] = $_POST['userno'];
	else {
		echo '<p class="note-msg" style="text-align:center; background-position: 42%;"><br>No selected any account.<br><br></p>';
	    }
		
    $acc_no = $_SESSION['userno'];
	
    if(isset($_POST['fname']) && !empty($_POST['fname']))
		{	
	        $fname=$_POST['fname'];	
			$query="UPDATE customers SET First_name='$fname' WHERE Acc_no='$acc_no'";
			$query_= $mysql1->query($query);
			echo '<p class="success-msg" style="text-align: center; background-position: 45%;">Name updated!</p>';				
	    }
		
	if(isset($_POST['contactno']) && !empty($_POST['contactno']))
		{	$contact_no=$_POST['contactno'];	
			$query="UPDATE CUSTOMERS set Contact_No='$contact_no' where Acc_no='$acc_no'";
			$query_= $mysql1->query($query);
			echo '<p class="success-msg" style="text-align: center; background-position: 42%;">Contact number updated!</p>';
		}

	if(isset($_POST['address']) && !empty($_POST['address']))
		{	$address=$_POST['address'];	
			$query="UPDATE CUSTOMERS set Address='$address' where Acc_no='$acc_no'";
			$query_= $mysql1->query($query);
            echo '<p class="success-msg" style="text-align: center; background-position: 44%;">Address updated!</p>';			
		}
if(isset($_POST['statuscheck'])){
	if(isset($_POST['status']) && !empty($_POST['status']))
		{	$status=$_POST['status'];	
			$query="UPDATE CUSTOMERS set Status='$status' where Acc_no='$acc_no'";
		    $query_= $mysql1->query($query);	
			echo '<p class="success-msg" style="text-align: center; background-position: 45%;">Status updated!</p>';
		}
}
	
	$query1 = "SELECT * FROM customers WHERE Acc_no = '$acc_no'";	
if($query2 = $mysql1->query($query1)){
	$query4 = $query2->fetch_assoc();
	?>
	<div style="margin-left: 235px; text-align: center;">
	<h1 style="padding-right: 200px;">Update account details here.</h1> 
		<p class="margin-bottom-15" style="padding-right: 200px;">*Please update carefully!</p>
        <div class="row">
            <div class="col-md-12">
                <form role="form" action="emp_wspace.php?subtopic_updateinfo=update_info" id="templatemo-preferences-form" method="POST">
                    <div class="row">
                        <div class="col-md-6 margin-bottom-15">
                            <label for="fname" class="control-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="<?php echo $query4['First_name'];?>">                  
                        </div>
				        <div class="col-md-6 margin-bottom-15">
                            <label for="address" class="control-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="<?php echo $query4['Address'];?>">                 
                        </div>
                    </div> 
		            <div class="row">
                        <div class="col-md-6 margin-bottom-15">
                            <label for="contactno" class="control-label">Contact Number</label>
                            <input type="number" class="form-control" id="contactno" name="contactno" placeholder="<?php echo $query4['Contact_No'];?>">                  
                        </div>
                        <div class="col-md-6 margin-bottom-15">
						    <label class="control-label">Status</label>
							<div class="input-group">
							    <div class="input-group-prepend">
							        <div class="input-group-text">
							            <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="statuscheck" name="statuscheck">
                                            <label class="custom-control-label" for="statuscheck"></label>
                                        </div>
							        </div>
							    </div>
							    <select class="custom-select" id="status" name="status" disabled>
						            <?php 
								        if($query4['Status'] == 'Member')
								        {
									        echo '<option>Member</option>
									        <option>Administrator</option>';
								        }else{
									        echo '<option>Administrator</option>
									        <option>Member</option>';
								        }
								    ?>
                                </select>						
							</div>						                      						
                        </div>
                    </div>
		            <div class="row">
                        <div class="col-md-6 margin-bottom-15">
                            <label>Date of Birth</label>
                            <p class="form-control-static" id="acc_no"><?php echo $query4['DOB'];?></p>
                        </div>
		                <div class="col-md-6 margin-bottom-15">
                            <label>Amount(gp)</label>
                            <p class="form-control-static" id="acc_no"><?php echo number_format($query4['Amount'], 0, ' ', ' ');?></p>
                        </div>
                    </div>
		            <div class="row">
                        <div class="col-md-6 margin-bottom-15">
                            <label>Account Number</label>
                            <p class="form-control-static" id="acc_no"><?php echo number_format($query4['Acc_no'], 0, ' ', ' ');?></p>
                        </div>
                        <div class="col-md-6 margin-bottom-15">
                            <label>PIN</label>
                            <p class="form-control-static" id="ATM"><?php echo $query4['ATM_NO'];?></p>
                        </div>
                    </div>
                    <div class="row templatemo-form-buttons">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-danger">Reset</button>    
                        </div>
                    </div>
</body>
<?php
	}
}
?>