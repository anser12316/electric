<?php
class City {
    protected $name;
    protected $units;
    protected $unitRates = array();
    protected $taxRate = 0.15; 

    public function __construct($name, $units, $unitRates) {
        $this->name = $name;
        $this->setUnits($units);
        $this->unitRates = $unitRates;
    }

    public function calculateBill() {
        $totalBill = 0;
        $remainingUnits = $this->units;

        foreach ($this->unitRates as $range => $rate) {
            $unitsInThisRange = min($remainingUnits, $range);
            $totalBill += $unitsInThisRange * $rate;
            $remainingUnits -= $unitsInThisRange;

            if ($remainingUnits <= 0) {
                break;
            }
        }

        $taxAmount = $totalBill * $this->taxRate;
        $totalBillWithTax = $totalBill + $taxAmount;

        echo "City: {$this->name}\n";
        echo "Total Units Consumed: {$this->units}\n";
        echo "Electricity Charges: Rs {$totalBill}\n";
        echo "Tax (15%): Rs {$taxAmount}\n";
        echo "Total Bill: Rs {$totalBillWithTax}\n";
        echo "\n";
    }

    public function setUnits($units) {
        if ($units >= 0) {
            $this->units = $units;
        } 
    }

    public function getUnits() {
        return $this->units;
    }
}

$islamabad = new City("Islamabad", 150, array(100 => 2.5, 300 => 5, 500 => 10));
$lahore = new City("Lahore", 250, array(100 => 2.5, 300 => 5, 500 => 10));
$karachi = new City("Karachi", 400, array(100 => 3, 300 => 6, 500 => 12));

$islamabad->calculateBill();
echo "<br>";
$lahore->calculateBill();
echo "<br>";
$karachi->calculateBill();

?>