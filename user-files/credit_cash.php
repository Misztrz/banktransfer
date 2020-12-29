<?php
if(isset($_GET['subtopic_credit']))
{
$query0="SELECT * FROM credit_cash WHERE owner='$acc_no'";
$query0_data=$mysql1->query($query0);
$query0_result=$query0_data->fetch_assoc();
$credit=$query0_result['saldo'];

// pay off button
if(isset($_POST['payoff'])){
	
	$money=$query01_result['Amount'];
		
	if($money >= $credit){
		$query02="UPDATE CUSTOMERS SET Amount=Amount - '$credit' WHERE Acc_no='$acc_no'";
		$query03="UPDATE Credit_Cash SET saldo='0' WHERE owner='$acc_no'";

        if($mysql1->query($query02) && $mysql1->query($query03))			
	        echo '<p class="success-msg">Your credit has been repaid.</p>';
		else{
			echo '<p class="error-msg">Repayment can not be done.</p>';
		}
			
	}else{
		echo '<p class="error-msg">You do not have sufficient balance.</p>';
	}	
		
}else{

if($credit == 0){
    if(isset($_POST['Amount']) && !empty($_POST['Amount'])){
	    $time=time();
	    $date=date("Y/m/d H:i:s",$time);
	    $amount=$_POST['Amount'];

	    if($amount>0){
			if($amount <= 1000){
				$query4="SELECT Trans_count FROM Transaction_count";
				$query4_data=$mysql1->query($query4);
				$query4_row=$query4_data->fetch_assoc();
				$Trans_id=$query4_row['Trans_count']+1;
				$query1="INSERT INTO Transactions(Trans_id,Date,Acc_no1,Acc_no2,Remark,Amount) VALUES('$Trans_id','$date','$acc_no',NULL, 'CREDIT CASH','$amount')";
				$query3="UPDATE Credit_Cash SET saldo=saldo + '$amount' + ROUND('$amount' * 0.12) WHERE owner='$acc_no'";
				$query2="UPDATE CUSTOMERS SET Amount=Amount + '$amount' WHERE Acc_no='$acc_no'";
				$query5="UPDATE Transaction_count SET Trans_count=Trans_count+1";	
				
			    if($query1_data=$mysql1->query($query1) && $query2_data=$mysql1->query($query2) && $query3_data=$mysql1->query($query3)){    
				    if($query5_data=$mysql1->query($query5)){
			            echo '<br><p class="success-msg"><br>Successful<br><br>Account Number: '.$acc_no.'<br><br>Amount credited: '.$amount.'<br><br></p>';
			        }
		            else { echo '<p class="error-msg">Could not take the credit, try later.</p>';}
		        }
		        else { echo '<p class="error-msg">Could not take the credit, try later.</p>';}
	        }
			else { echo '<p class="error-msg">You cannot credit more than 1000gp.</p>';}	   
		}
	    else { echo '<p class="error-msg">Amount entered is not valid</p>';}
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
	<p class='warning-msg'>Pay off your current credit to take an another one.<br>Credit sum: <?php echo $credit;?> gp</p>
	<form action='layout.php?subtopic_credit=credit_cash' method='post'>
	    <button type='submit' name='payoff' class='btn btn-primary'>Pay Off</button>
	</form>

<?php
	    }
    }
}
?>