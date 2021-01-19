<?php
if(isset($_GET['subtopic_credit']))
{
$query0="SELECT * FROM credit_cash WHERE owner='".$user->getAccno()."'";
$query0_data=$mysql1->query($query0);
$query0_result=$query0_data->fetch_assoc();
$credit->setCredit($query0_result['saldo']);

// pay off button
if(isset($_POST['payoff'])){
	
	$user->setAmount($query01_result['Amount']);
		
	if($user->getAmount() >= $credit->getCredit()){
		$query02="UPDATE CUSTOMERS SET Amount=Amount - '".$credit->getCredit()."' WHERE Acc_no='".$user->getAccno()."'";
		$query03="UPDATE Credit_Cash SET saldo='0' WHERE owner='".$user->getAccno()."'";

        if($mysql1->query($query02) && $mysql1->query($query03))			
	        echo '<p class="success-msg">Your credit has been repaid.</p>';
		else{
			echo '<p class="error-msg">Repayment can not be done.</p>';
		}			
	}else{
		echo '<p class="error-msg">You do not have sufficient balance.</p>';
	}	
		
}else{

if($credit->getCredit() == 0){
    if(isset($_POST['Amount']) && !empty($_POST['Amount'])){
	    $time=time();
	    $user->setDate(date("Y/m/d H:i:s",$time));
	    $credit->setCredit($_POST['Amount']);

	    if($user->getAmount() > $credit->getCredit()){
			if($credit->getCredit() <= 1000){
				$query4="SELECT Trans_count FROM Transaction_count";
				$query4_data=$mysql1->query($query4);
				$query4_row=$query4_data->fetch_assoc();
				$Trans_id=$query4_row['Trans_count']+1;
				$query1="INSERT INTO Transactions(Trans_id,Date,Acc_no1,Acc_no2,Remark,Amount) VALUES('$Trans_id','".$user->getDate()."','".$user->getAccno()."',NULL, 'CREDIT CASH','".$credit->getCredit()."')";
				$query3="UPDATE Credit_Cash SET saldo=saldo + '".$credit->getCredit()."' + ROUND('".$credit->getCredit()."' * 0.12) WHERE owner='".$user->getAccno()."'";
				$query2="UPDATE CUSTOMERS SET Amount=Amount + '".$credit->getCredit()."' WHERE Acc_no='".$user->getAccno()."'";
				$query5="UPDATE Transaction_count SET Trans_count=Trans_count+1";	
				
			    if($query1_data=$mysql1->query($query1) && $query2_data=$mysql1->query($query2) && $query3_data=$mysql1->query($query3)){    
				    if($query5_data=$mysql1->query($query5)){
			            echo $credit->creditConfirmMsg($user->getAccno());
			        }
		            else { echo '<p class="error-msg">Could not take the credit, try later.</p>';}
		        }
		        else { echo '<p class="error-msg">Could not take the credit, try later.</p>';}
	        }
			else { echo '<p class="error-msg">You cannot credit more than 1000gp.</p>';}	   
		}
	    else { echo '<p class="error-msg">Your balance should be higher than the credit amount.</p>';}
	}
	else{ 
?>
	<br><p class="note-msg"><br>The maximum credit amount you can take is 1000 gp.<br><br></p>
		<p class="warning-msg">The amount you must give back will be higher by 12%</p> 
		<form role="form" action="layout.php?subtopic_credit=credit_cash" id="templatemo-preferences-form" method="POST">
            <div class="row">
                <div class="col-md-6 margin-bottom-15">
                    <label for="Amount">Amount</label>
					<div class="input-group">	     
					    <div class="input-group-prepend">
					        <span class="input-group-text">$</span>
						</div>
                            <input type="number" class="form-control" id="Amount" name="Amount" placeholder="Enter Amount" required>
                    </div>							
                </div>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>    
        </form>
<?php
		}
}else{
?>	
	<p class='warning-msg'>Pay off your current credit to take an another one.<br>Credit sum: <?php echo $credit->getCredit();?> gp</p>
	<form action='layout.php?subtopic_credit=credit_cash' method='post'>
	    <button type='submit' name='payoff' class='btn btn-primary'>Pay Off</button>
	</form>

<?php
	    }
    }
}
?>
