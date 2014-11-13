<?php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'sisdma';
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

$query="select distinct c.idcontatos, c.nomecontatos, c.siglacontatos, c.orgaocontatos, c.enderecoorgao, c.telefone, c.ramalfone, c.emailcontato, c.celcontato, c.cargocontato from contatos c order by c.idcontatos";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}
# JSON-encode the response
$json_response = json_encode($arr);

// # Return the response
echo $json_response;

?>
