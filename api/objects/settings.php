<?php
class Settings {
    // database connection and table name
    private $conn;
    private $table_name = "settings";

    // object properties
    public $id;
    public $companyName;
    public $shortName;
    public $companyRegNo;
    public $webSite;
    public $defaultEmail;
    public $address1;
    public $address2;
    public $city;
    public $county;
    public $postcode;
    public $telephoneNumber;
    public $vatRate;
    public $defaultKPIQuoteRtndBy;
    public $defaultCreditHardLimit;
    public $defaultCreditSoftLimit;
    public $dateUpdated;
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function update(){
        $query = "UPDATE ".$this->table_name." SET 
							 company_name = :companyName, 
							    shortname = :shortName, 
							 companyregno = :companyRegNo, 
							      website = :webSite, 
							default_email = :defaultEmail, 
							     address1 = :address1, 
							     address2 = :address2, 
							         city = :city, 
							       county = :county, 
							     postcode = :postcode, 
							       tel_no = :telephoneNumber, 
							     vat_rate = :vatRate, 
				default_kpi_quote_rtnd_by = :defaultKPIQuoteRtndBy, 
				default_credit_hard_limit = :defaultCreditHardLimit, 
				default_credit_soft_limit = :defaultCreditSoftLimit, 
							date_updated  = now() WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $this->companyName            = htmlspecialchars(strip_tags($this->companyName));
        $this->shortName              = htmlspecialchars(strip_tags($this->shortName));
		$this->companyRegNo           = htmlspecialchars(strip_tags($this->companyRegNo));
		$this->webSite                = htmlspecialchars($this->webSite);
		$this->defaultEmail           = htmlspecialchars($this->defaultEmail);
		$this->address1               = htmlspecialchars($this->address1);
		$this->address2               = htmlspecialchars($this->address2);
		$this->city                   = htmlspecialchars($this->city);
		$this->county                 = htmlspecialchars($this->county);
		$this->postcode               = htmlspecialchars($this->postcode);
		$this->telephoneNumber        = htmlspecialchars($this->telephoneNumber);
		$this->vatRate                = htmlspecialchars($this->vatRate);
		$this->defaultKPIQuoteRtndBy  = htmlspecialchars($this->defaultKPIQuoteRtndBy);
		$this->defaultCreditHardLimit = htmlspecialchars($this->defaultCreditHardLimit);
		$this->defaultCreditSoftLimit = htmlspecialchars($this->defaultCreditSoftLimit);
        $stmt->bindParam(':companyName',            $this->companyName);
        $stmt->bindParam(':shortName',              $this->shortName);
        $stmt->bindParam(':companyRegNo',           $this->companyRegNo);
        $stmt->bindParam(':webSite',                $this->webSite);
        $stmt->bindParam(':defaultEmail',           $this->defaultEmail);
        $stmt->bindParam(':address1',               $this->address1);
        $stmt->bindParam(':address2',               $this->address2);
        $stmt->bindParam(':city',                   $this->city);
        $stmt->bindParam(':county',                 $this->county);
        $stmt->bindParam(':postcode',               $this->postcode);
        $stmt->bindParam(':telephoneNumber',        $this->telephoneNumber);
        $stmt->bindParam(':vatRate',                $this->vatRate);
        $stmt->bindParam(':defaultKPIQuoteRtndBy',  $this->defaultKPIQuoteRtndBy);
        $stmt->bindParam(':defaultCreditHardLimit', $this->defaultCreditHardLimit);
        $stmt->bindParam(':defaultCreditSoftLimit', $this->defaultCreditSoftLimit);
        $stmt->bindParam(':id',                     $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readOne(){
        $query = "SELECT id, 
						company_name,
						shortname,
						companyregno,
						website,
						default_email,
						address1,
						address2,
						city,
						county,
						postcode,
						tel_no,
						vat_rate,
						default_kpi_quote_rtnd_by,
						default_credit_hard_limit,
						default_credit_soft_limit,
						date_updated
					FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
        $stmt  = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row                          = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->companyName            = $row['company_name'];
        $this->shortName              = $row['shortname'];
        $this->companyRegNo           = $row['companyregno'];
        $this->webSite                = $row['website'];
        $this->defaultEmail           = $row['default_email'];
        $this->address1               = $row['address1'];
        $this->address2               = $row['address2'];
        $this->city                   = $row['city'];
        $this->county                 = $row['county'];
        $this->postcode               = $row['postcode'];
        $this->telephoneNumber        = $row['tel_no'];
        $this->vatRate                = $row['vat_rate'];
        $this->defaultKPIQuoteRtndBy  = $row['default_kpi_quote_rtnd_by'];
        $this->defaultCreditHardLimit = $row['default_credit_hard_limit'];
        $this->defaultCreditSoftLimit = $row['default_credit_soft_limit'];
        $this->dateUpdated            = $row['date_updated'];
    }
}
?>
