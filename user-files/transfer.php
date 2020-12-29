<?php

if(isset($_GET['subtopic_transfer']))
{
if(isset($_POST['Amount']) && !empty($_POST['Amount']) && isset($_POST['Acc_no2']) && !empty($_POST['Acc_no2'])){

@$atm=$_SESSION['atm'];
@$pin=$_SESSION['pin'];

	$time=time();
	$date=date("Y/m/d H:i:s",$time);
	$amount=$_POST['Amount'];
	
	if($amount > 0){

		$acc_no_credit=$_POST['Acc_no2'];
		
		if($rows = $query01_data->num_rows > 0){
			$a=$query01_result['Amount'];
		
		    if($acc_no_credit !== $query01_result['Acc_no'] ){							
			    if($amount <= $a){
				    $query7="SELECT Trans_count FROM Transaction_count";
					$query7_data=$mysql1->query($query7);
					$query7_row=$query7_data->fetch_assoc();
					$Trans_id=$query7_row['Trans_count']+1;
					$query1="INSERT INTO Transactions(Trans_id,Date,Acc_no1,Acc_no2,Remark,Amount) VALUES('$Trans_id','$date','$acc_no','$acc_no_credit','TRANSFER','$amount')";
					$query4="UPDATE CUSTOMERS SET Amount=Amount-'$amount' WHERE Acc_no='$acc_no'";
					$query2="UPDATE CUSTOMERS SET Amount=Amount+'$amount' WHERE Acc_no='$acc_no_credit'";
					$query5="UPDATE Transaction_count SET Trans_count=Trans_count+1";

				    if($query1_data=$mysql1->query($query1) && $query2_data=$mysql1->query($query2) && $query4_data=$mysql1->query($query4)){				        
						if($query5_data=$mysql1->query($query5)){
					        echo '<p class="success-msg">Money Transfer Successful<br><br>Account Number: '.$acc_no.'<br><br>Amount transfered: '.number_format($amount, 0, ' ', ' ').'<br><br>Amount transfered to: '.$acc_no_credit;
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