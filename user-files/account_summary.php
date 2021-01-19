<?php
if(isset($_GET['subtopic_accsum']))
{

$query0="SELECT * FROM credit_cash WHERE owner='".$user->getAccno()."'";
$query1="SELECT * FROM Transactions WHERE Acc_no1='".$user->getAccno()."' OR Acc_no2='".$user->getAccno()."' ORDER BY date DESC";

$query0_data=$mysql1->query($query0);
$query1_data=$mysql1->query($query1);

$query0_result = $query0_data->fetch_assoc();
$credit->setCredit($query0_result['saldo']);

	
    echo '<p class="btn btn-outline-secondary disabled text-font" style="font-size: 25px; border-radius: 10px; border: 6px double;">Account Number: '.number_format($user->getAccno(), 0, ' ', ' ').'</p><br><br>
	      <p class="btn btn-outline-info disabled text-font" style="font-size: 25px; border-radius: 10px; border: 6px double;">Balance: '.number_format($user->getAmount(), 0, ' ', ' ').' gp</p><br><br>';
	
	if($credit->getCredit() > 0) 
		echo '<p class="btn btn-outline-danger disabled text-font" style="color: red; font-size: 25px; border-radius: 10px; border: 6px double;">Credit: '.$credit->getCredit();
	        else
		echo '<p class="btn btn-outline-secondary disabled text-font" style="font-size: 25px; border-radius: 10px; border: 6px double;">Credit: '.$credit->getCredit();
	echo ' gp</p><br><br>';

    if($query1_data->num_rows > 0){
				
        echo '<p class="btn btn-primary disabled" style="font-size: 15px;">Total number of transactions: <span class="badge badge-light">'.$query1_data->num_rows.'</span></p><br>';		
		
	while($query1_row=$query1_data->fetch_assoc()){
		
		echo '<div class="toast">
		<div class="toast-header">';
		
		$trans_id=$query1_row['Trans_id'];
		$user->setRemark($query1_row['Remark']);
		$user->setAmount($query1_row['Amount']);
		$user->setDate($query1_row['Date']);
		$transfer->setAccno1($query1_row['Acc_no1']);
		$kindOfTransfer = '';
		
		if($transfer->getAccno1() === $user->getAccno() && $user->getRemark() != 'CREDIT CASH')
		    $kindOfTransfer = 'OUTGOING';
	
	    if($transfer->getAccno1() !== $user->getAccno() && $user->getRemark() != 'CREDIT CASH')
		    $kindOfTransfer = 'INCOMING';
		
		
		if($transfer->getAccno1() !== $user->getAccno())
			$color='success';
		
            elseif($user->getRemark()=='CREDIT CASH')
			    $color='warning';	
		        else 
				$color='danger';

                echo'<strong class="mr-auto text-primary">No. '.$trans_id.' | '.$kindOfTransfer.' '.$user->getRemark().'</strong>
                     <small class="text-muted">'.$user->getDate().'</small></div>';
					
		        if($user->getRemark()=='CREDIT CASH'){
			        $color2='orange';
			        $sign='+';
			    }
				elseif($transfer->getAccno1() != $user->getAccno()){
					$color2 = 'green';
					$sign = '+';
				}
			    else{
				    $color2='red';
				    $sign='-';
			    }
               
                echo '<div class="toast-body '.$color.'" style="color: '.$color2.';">Amount: '.$sign.''.number_format($user->getAmount(), 0, ' ', ' ').' gp
                    </div></div>';
	    }
	}
    else { echo '<p class="btn btn-primary disabled">No Transactions have been made</p>';}
}
?>
