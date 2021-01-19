<?php

class USER
{
	private $acc_no;
	private $fname;
	private $status;
	private $amount;
	private $remark;
	private $date;

		public function setAccno($acc_no)
		{
			$this->acc_no = $acc_no;
		}
		public function getAccno()
		{
			return $this->acc_no;
		}

		public function setFname($fname)
		{
			$this->fname = $fname;
		}
		public function getFname()
		{
			return $this->fname;
		}
		public function setStatus($status)
		{
			$this->status = $status;
		}
		public function getStatus()
		{
			return $this->status;
		}

		public function setAmount($amount)
		{
			$this->amount = $amount;
		}
		public function getAmount()
		{
			return $this->amount;
		}

		public function setRemark($remark)
		{
			$this->remark = $remark;
		}
		public function getRemark()
		{
			return $this->remark;
		}
           
		public function setDate($date)
		{
			$this->date = $date;
		}
		public function getDate()
		{
			return $this->date;
		}

}

class Create_Account
{
	protected $name;
	private $login;
	private $contact_no;
	private $address;
	private $day;
	private $month;
	private $year;
	private $created_on;
	protected $pin;
	protected $acc_no;
	private $dob;
		
		public function showRange($from, $range)
		{
			$i = $from;
		    while($i <= $range)
		   {   
                echo'<option>'.$i.'</option>';
                $i++;
			}
		}
		
		public function showData()
		{
			return '<p class="success-msg" style="text-align: center;">Welcome to Moneta Family</h3><br>Name: '.$this->name.'
			        <br>Account number: '.$this->acc_no.'<br>Login: '.$this->login.'<br>PIN: '.$this->pin.'</p> ';
		}
		
		public function setName($name)
		{
			$this->name = $name;
		}
		public function getName()
		{
			return $this->name;
		}
		public function setLogin($login)
		{
			$this->login = $login;
		}
		public function getLogin()
		{
			return $this->login;
		}
		public function setContactno($contact_no)
		{
			$this->contact_no = $contact_no;
		}
		public function getContactno()
		{
			return $this->contact_no;
		}
		public function setAddress($address)
		{
			$this->address = $address;
		}
		public function getAddress()
		{
			return $this->address;
		}
		public function setDay($day)
		{
			$this->day = $day;
		}
		public function getDay()
		{
			return $this->day;
		}
		public function setMonth($month)
		{
			$this->month = $month;
		}
		public function getMonth()
		{
			return $this->month;
		}
		public function setYear($year)
		{
			$this->year = $year;
		}
		public function getYear()
		{
			return $this->year;
		}
	    public function setCreatedon($created_on)
		{
			$this->created_on = $created_on;
		}
		public function getCreatedon()
		{
			return $this->created_on;
		}
	    public function setAccno($acc_no)
		{
			$this->acc_no = $acc_no;
		}
		public function getAccno()
		{
			return $this->acc_no;
		}
	    public function setDob($dob)
		{
			$this->dob = $dob;
		}
		public function getDob()
		{
			return $this->dob;
		}
	    public function setPin($pin)
		{
			$this->pin = $pin;
		}
		public function getPin()
		{
			return $this->pin;
		}
}

class New_Customer extends Create_Account
{
	private $amount;
	private $status;
	private $atm_no;
	private $userno;
    
	    public function newcustomerConfirmMsg()
		{
	        return '<p class="success-msg">Welcome to Moneta Family</h3><br>Name: '.$this->name.'
			        <br>Status: '.$this->status.'<br>Account number: '.$this->acc_no.'<br>ATM No: '.$this->atm_no.'<br>PIN: '.$this->pin.'<br></p>';
	    }
		
		public function setUserno($userno)
		{
			$this->userno = $userno;
		}
		public function getUserno()
		{
			return $this->userno;
		}
	
	    public function setAtmno($atm_no)
		{
			$this->atm_no = $atm_no;
		}
		public function getAtmno()
		{
			return $this->atm_no;
		}
		public function setAmount($amount)
		{
			$this->amount = $amount;
		}
		public function getAmount()
		{
			return $this->amount;
		}
		public function setStatus($status)
		{
			$this->status = $status;
		}
		public function getStatus()
		{
			return $this->status;
		}
}


class Account
{
	private $pin;
	private $atm_no;
	private $emp_id;
	private $password;
	
	
	    public function setEmpid($emp_id)
		{
			$this->emp_id = $emp_id;
		}
		public function getEmpid()
		{
			return $this->emp_id;
		}
	    public function setPassword($password)
		{
			$this->password = $password;
		}
		public function getPassword()
		{
			return $this->password;
		}
		
	    public function setPin($pin)
		{
			$this->pin = $pin;
		}
		public function getPin()
		{
			return $this->pin;
		}
		 public function setAtmno($atm_no)
		{
			$this->atm_no = $atm_no;
		}
		public function getAtmno()
		{
			return $this->atm_no;
		}
		
		public function mysqli_result($search, $row, $field)
		{
            $i=0;
            while($results = mysqli_fetch_array($search))
	            {
                if ($i == $row)
				{ $result=$results[$field]; }
                $i++;
			    }
            return $result;
        } 

}


class Credit
{
	private $credit;

	    public function creditConfirmMsg($number)
		{
	 	return '<br><p class="success-msg"><br>Successful<br><br>Account Number: '.$number.'<br><br>Amount credited: '.$this->credit.'<br><br></p>';
	    }
		
	    public function setCredit($credit)
		{
			$this->credit = $credit;
		}
		public function getCredit()
		{
			return $this->credit;
		}
}

class Transfer
{
	private $date;
	private $acc_no_credit;
	private $acc_no1;
	private $amount;
	private $fname;
	    
		public function setFname($fname)
		{
			$this->fname = $fname;
		}
		public function getFname()
		{
			return $this->fname;
		}
		
	    public function transferConfirmMsg($name)
		{
		    return '<p class="success-msg">Money Transfer Successful<br><br>Amount transfered: '.number_format($this->amount, 0, ' ', ' ').'<br><br>Amount transfered to: '.$this->acc_no_credit.' ('.$name.')</p>';
		}
	
	    public function setAmount($amount)
		{
			$this->amount = $amount;
		}
		public function getAmount()
		{
			return $this->amount;
		}
	    public function setAccno1($acc_no1)
		{
			$this->acc_no1 = $acc_no1;
		}
		public function getAccno1()
		{
			return $this->acc_no1;
		}
		
	    public function setAccnoCredit($acc_no_credit)
		{
			$this->acc_no_credit = $acc_no_credit;
		}
		public function getAccnoCredit()
		{
			return $this->acc_no_credit;
		}
		
	    public function setDate($date)
		{
			$this->date = $date;
		}
		public function getDate()
		{
			return $this->date;
		}
}
?>