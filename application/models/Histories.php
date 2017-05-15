<?php


class Histories extends MY_Model {
	/*var $data = array(
		array('transactionId' => '1', 'type' => 'Purchased Box', 'partsType' => 'a1 b2 c3 d1 e2 f3 g1 h2 i3 j1', 'date' => '10:30pm April 15 2014', 'price' => 100),
		array('transactionId' => '2', 'type' => 'Purchased Box', 'partsType' => 'c1 b2 q3 d1 e2 l3 g2 p2 x3 m1', 'date' => '08:30pm April 17 2014', 'price' => 100),
		array('transactionId' => '3', 'type' => 'Purchased Box', 'partsType' => 'x1 b2 c3 d1 e2 f3 g1 h2 i3 j1', 'date' => '07:30pm April 12 2014', 'price' => 100),
		array('transactionId' => '4', 'type' => 'Purchased Box', 'partsType' => 'z1 b1 c3 y1 x2 f3 g2 k2 i3 n1', 'date' => '06:30pm April 11 2014', 'price' => 100),
		array('transactionId' => '5', 'type' => 'Purchased Box', 'partsType' => 'w1 q1 e3 r1 x3 f3 g2 k1 i1 n2', 'date' => '07:30pm April 11 2014', 'price' => 100),
		array('transactionId' => '6', 'type' => 'Purchased Box', 'partsType' => 'z1 w1 p3 n1 e2 r3 g2 c2 e3 n1', 'date' => '08:30pm April 11 2014', 'price' => 100),
		array('transactionId' => '7', 'type' => 'Robot Assembly', 'partsType' => 'a2 b1 c3', 'date' => '05:30pm April 15 2014', 'price' => 0),
		array('transactionId' => '8', 'type' => 'Robot Assembly', 'partsType' => 'c1 c2 c3', 'date' => '04:30pm April 19 2014', 'price' => 0),
		array('transactionId' => '9', 'type' => 'Robot Assembly', 'partsType' => 'p1 b2 z3', 'date' => '03:30pm April 21 2014', 'price' => 0),
		array('transactionId' => '10', 'type' => 'Robot Assembly', 'partsType' => 'z1 j2 m3', 'date' => '01:30am April 24 2014', 'price' => 0),
		array('transactionId' => '11', 'type' => 'Robot Assembly', 'partsType' => 'e1 j2 w3', 'date' => '03:30am April 21 2014', 'price' => 0),
		array('transactionId' => '12', 'type' => 'Robot Assembly', 'partsType' => 'p1 x2 q3', 'date' => '06:30am April 22 2014', 'price' => 0),
		array('transactionId' => '13', 'type' => 'Robot Assembly', 'partsType' => 'b1 t2 y3', 'date' => '07:30am April 23 2014', 'price' => 0),
		array('transactionId' => '14', 'type' => 'Return Part(s)', 'partsType' => 'a2 b1', 'date' => '07:30am April 28 2014', 'price' => 10),
		array('transactionId' => '15', 'type' => 'Return Part(s)', 'partsType' => 'p2 b3 c3', 'date' => '03:50am April 29 2014', 'price' => 15),
		array('transactionId' => '16', 'type' => 'Return Part(s)', 'partsType' => 'r2 q3 e3', 'date' => '05:50am April 20 2014', 'price' => 15),
		array('transactionId' => '17', 'type' => 'Return Part(s)', 'partsType' => 'm2 n3 y3', 'date' => '08:50am April 18 2014', 'price' => 15),
		array('transactionId' => '18', 'type' => 'Return Part(s)', 'partsType' => 'p3', 'date' => '06:50am April 15 2014', 'price' => 5),
		array('transactionId' => '19', 'type' => 'Return Part(s)', 'partsType' => 'p1 b2 c2 d2', 'date' => '01:50am April 14 2014', 'price' => 20),
		array('transactionId' => '20', 'type' => 'Sold Robot', 'partsType' => 'p1 b2 c3', 'date' => '03:30am April 28 2014', 'price' => 25),
		array('transactionId' => '21', 'type' => 'Sold Robot', 'partsType' => 'a1 b2 c3', 'date' => '04:30am April 26 2014', 'price' => 25),
		array('transactionId' => '22', 'type' => 'Sold Robot', 'partsType' => 'a1 a2 a3', 'date' => '05:30am April 29 2014', 'price' => 50),
		array('transactionId' => '23', 'type' => 'Sold Robot', 'partsType' => 'b1 b2 b3', 'date' => '06:30pm April 21 2014', 'price' => 50),
		array('transactionId' => '24', 'type' => 'Sold Robot', 'partsType' => 'm1 m2 m3', 'date' => '11:30am April 20 2014', 'price' => 100),
		array('transactionId' => '25', 'type' => 'Sold Robot', 'partsType' => 'm1 n2 o3', 'date' => '12:30am April 23 2014', 'price' => 50),
		array('transactionId' => '26', 'type' => 'Sold Robot', 'partsType' => 'w1 w2 w3', 'date' => '04:30am April 24 2014', 'price' => 200),
		array('transactionId' => '27', 'type' => 'Sold Robot', 'partsType' => 'w1 y2 z3', 'date' => '01:30am April 25 2014', 'price' => 100)
	);*/

	// Constructor
	public function __construct()
	{
		parent::__construct('Histories', 'id');
	}

	// retrieve a single transaction
	public function getTransaction($which)
	{
		// iterate over the data until we find the one we want
		foreach ($this->all() as $record)
			if ($record['id'] == $which)
				return $record;
		return null;
	}

	public function sortedByPrice($order)
	{
		// retrieve all transactions
		$transactions = $this->all();
		// convert from array of objects to array of arrays
		foreach ($transactions as $transaction)
            $converted[] = (array) $transaction;
		$price = array();
		foreach ($converted as $key => $row)
		{
			$price[$key] = $row['price'];
		}

		if (strcmp($order, "asc") == 0) {
			// Sort by price ascending
			array_multisort($price, SORT_ASC, $converted);
		} else if(strcmp($order, "desc") == 0){
			// Sort by price descending
			array_multisort($price, SORT_DESC, $converted);
		}
		return $converted;
	}

	// Compare date/time ascending
	public function sortDateTimeAsc($a, $b)
	{
		return strtotime($a['date']) - strtotime($b['date']);
	}
	// Compare date/time descending
	public function sortDateTimeDesc($a, $b)
	{
		return strtotime($b['date']) - strtotime($a['date']);
	}
	// Compare transaction type ascending
	public function sortTypeAsc($a, $b)
	{
  	return strcmp($a["type"], $b["type"]);
	}
	// Compare transaction type descending
	public function sortTypeDesc($a, $b)
	{
  	return -strcmp($a["type"], $b["type"]);
	}

	public function sortedByDateTime($order)
	{
		// retrieve all transactions
		$transactions = $this->all();
		// convert from array of objects to array of arrays
		foreach ($transactions as $transaction)
            $converted[] = (array) $transaction;
		if (strcmp($order, "asc") == 0) {
			// Sort by date/time ascending
			usort($converted, array($this,"sortDateTimeAsc"));
		} else if(strcmp($order, "desc") == 0){
			// Sort by date/time descending
			usort($converted, array($this,"sortDateTimeDesc"));
		}
		return $converted;
	}

	public function sortedByType($order)
	{
		// retrieve all transactions
		$transactions = $this->all();
		// convert from array of objects to array of arrays
		foreach ($transactions as $transaction)
            $converted[] = (array) $transaction;
		if (strcmp($order, "asc") == 0) {
			// Sort by date/time ascending
			usort($converted, array($this,"sortTypeAsc"));
		} else if(strcmp($order, "desc") == 0){
			// Sort by date/time descending
			usort($converted, array($this,"sortTypeDesc"));
		}
		return $converted;
	}

	// retrieve all of the transactions
	public function getAllTransactions()
	{
		return $this->all();
	}

	// retrieve the total amount of money spent
	public function getSpent()
	{
		$totalSpent = 0;

		foreach ($this->all() as $record)
		{
			if ($record->type == "Purchased Box")
			{
				$totalSpent += $record->price;
			}
		}
		return $totalSpent;
	}

	// retrieve the total amount of money earned
	public function getEarned()
	{
		$totalEarned = 0;

		foreach ($this->all() as $record)
		{
			if (($record->type == "Sell") || ($record->type == "Return Part(s)"))
			{
				$totalEarned += $record->price;
			}
		}
		return $totalEarned;
	}

}
