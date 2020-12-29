<?php
if(isset($_GET['subtopic_accsum']))
{

$query0="SELECT * FROM credit_cash WHERE owner='$acc_no'";
$query1="SELECT * FROM Transactions WHERE Acc_no1='$acc_no' OR Acc_no2='$acc_no' ORDER BY date DESC";

$query0_data=$mysql1->query($query0);
$query1_data=$mysql1->query($query1);

$query0_result = $query0_data->fetch_assoc();
$credit = $query0_result['saldo'];

	
    echo '<p class="btn btn-outline-secondary disabled text-font" style="font-size: 25px; border-radius: 10px; border: 6px double;">Account Number: '.number_format($acc_no, 0, ' ', ' ').'</p><br><br>
	      <p class="btn btn-outline-info disabled text-font" style="font-size: 25px; border-radius: 10px; border: 6px double;">Balance: '.number_format($amount, 0, ' ', ' ').' gp</p><br><br>';
	
	if($credit > 0) 
		echo '<p class="btn btn-outline-danger disabled text-font" style="color: red; font-size: 25px; border-radius: 10px; border: 6px double;">Credit: '.$credit;
	        else
		echo '<p class="btn btn-outline-secondary disabled text-font" style="font-size: 25px; border-radius: 10px; border: 6px double;">Credit: '.$credit;
	echo ' gp</p><br><br>';

    if($query1_data->num_rows > 0){
				
        echo '<p class="btn btn-primary disabled" style="font-size: 15px;">Total number of transactions: <span class="badge badge-light">'.$query1_data->num_rows.'</span></p><br>';		
		
	while($query1_row=$query1_data->fetch_assoc()){
		
		echo '<div class="toast">
		<div class="toast-header">';
		
		$trans_id=$query1_row['Trans_id'];
		$remark=$query1_row['Remark'];
		$amount=$query1_row['Amount'];
		$date=$query1_row['Date'];
		$acc1=$query1_row['Acc_no1'];
		$kindOfTransfer = '';
		
		if($acc1 === $acc_no && $remark != 'CREDIT CASH')
		    $kindOfTransfer = 'OUTGOING';
	
	    if($acc1 !== $acc_no && $remark != 'CREDIT CASH')
		    $kindOfTransfer = 'INCOMING';
		
		
		if($acc1 !== $acc_no)
			$color='success';
		
            elseif($remark=='CREDIT CASH')
			    $color='warning';	
		        else 
				$color='danger';

                echo'<strong class="mr-auto text-primary">No. '.$trans_id.' | '.$kindOfTransfer.' '.$remark.'</strong>
                     <small class="text-muted">'.$date.'</small></div>';
					
		        if($remark=='CREDIT CASH'){
			        $color2='orange';
			        $sign='+';
			    }
				elseif($acc1 != $acc_no){
					$color2 = 'green';
					$sign = '+';
				}
			    else{
				    $color2='red';
				    $sign='-';
			    }
               
                echo '<div class="toast-body '.$color.'" style="color: '.$color2.';">Amount: '.$sign.''.number_format($amount, 0, ' ', ' ').' gp
                    </div></div>';
	    }
	}
    else { echo '<p class="btn btn-primary disabled">No Transactions have been made</p>';}
}
?>