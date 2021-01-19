<?php

if(isset($_GET['subtopic_transfer']))
{
if(isset($_POST['Amount']) && !empty($_POST['Amount']) && isset($_POST['Acc_no2']) && !empty($_POST['Acc_no2'])){

	$time=time();
	$transfer->setDate(date("Y/m/d H:i:s",$time));
	$transfer->setAmount($_POST['Amount']);
	
	if($user->getAmount() > 0){

		$transfer->setAccnoCredit($_POST['Acc_no2']);
		
		if($rows = $query01_data->num_rows > 0){	
		    if($transfer->getAccnoCredit() !== $user->getAccno()){							
			    if($transfer->getAmount() <= $user->getAmount()){
				    $query7="SELECT Trans_count FROM Transaction_count";
					$query7_data=$mysql1->query($query7);
					$query7_row=$query7_data->fetch_assoc();
					$Trans_id=$query7_row['Trans_count']+1;
					$query1="INSERT INTO Transactions(Trans_id,Date,Acc_no1,Acc_no2,Remark,Amount) VALUES('$Trans_id','".$transfer->getDate()."','".$user->getAccno()."','".$transfer->getAccnoCredit()."','TRANSFER','".$transfer->getAmount()."')";
					$query4="UPDATE CUSTOMERS SET Amount=Amount-'".$transfer->getAmount()."' WHERE Acc_no='".$user->getAccno()."'";
					$query2="UPDATE CUSTOMERS SET Amount=Amount+'".$transfer->getAmount()."' WHERE Acc_no='".$transfer->getAccnoCredit()."'";
					$query5="UPDATE Transaction_count SET Trans_count=Trans_count+1";

				    if($query1_data=$mysql1->query($query1) && $query2_data=$mysql1->query($query2) && $query4_data=$mysql1->query($query4)){				        
						if($query5_data=$mysql1->query($query5)){
							$select_name = "SELECT First_name FROM customers WHERE Acc_no='".$transfer->getAccnoCredit()."'";
							$select_name_data = $mysql1->query($select_name);
							$select_name_row = $select_name_data->fetch_assoc();
							$transfer->setFname($select_name_row['First_name']);
							echo $transfer->transferConfirmMsg($transfer->getFname());
					    }
				        else { echo '<p class="error-msg">Could not transfer</p>';}
			        }
				    else{ echo '<p class="error-msg">Could not transfer</p>';}		
			    }
	            else{ echo '<p class="error-msg">You do not have sufficient balance</p>'; }
		    }
		    else{ echo '<p class="error-msg">You want to send money on your own account!</p>'; }
	    }	
		else{ echo '<p class="error-msg">Account number does not exist</p>'; }			
	}
	else{ echo '<p class="error-msg">Amount entered is not valid</p>'; }
}
else {
	?>
    <form role="form" action="layout.php?subtopic_transfer=transfer" id="templatemo-preferences-form" method="POST">
        <div class="row">
            <div class="col-md-6 margin-bottom-15">
                <label for="Amount">Amount</label>
			    <div class="input-group">
					<div class="input-group-prepend">
					    <div class="input-group-text">$</div>
					</div>
                    <input type="number" class="form-control" id="Amount" name="Amount" placeholder="Enter Amount" required> 
                </div>					
            </div>				
        </div>
        <div class="row">
            <div class="col-md-6 margin-bottom-15">
                <label for="Acc_no2">Account Number</label>
                <input type="text" class="form-control" id="Acc_no2" name="Acc_no2" placeholder="Account Number" required>                  
            </div>
        </div>         
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>          
    </form>
<?php
    }
}
?>
