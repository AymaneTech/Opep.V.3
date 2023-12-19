<?php

//function.php

$connect = new PDO("mysql:host=localhost; dbname=opep_v3", "root", "");

function fetch_top_five_data($connect)
{
	$query = "
	SELECT * FROM users 
	ORDER BY id DESC 
	LIMIT 5
	";

	$result = $connect->query($query);

	$output = '';

	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row["firstName"].'</td>
			<td>'.$row["lastName"].'</td>
			<td>'.$row["email"].'</td>
			<td>'.$row["password"].'</td>
		</tr>
		';
	}

	return $output;
}

function count_all_data($connect)
{
	$query = "SELECT * FROM customer_table";

	$statement = $connect->prepare($query);

	$statement->execute();

	return $statement->rowCount();
}

?>