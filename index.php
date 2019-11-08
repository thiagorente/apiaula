<?php
	//cria a conexao com o banco de dados
	$servername = "mysql";
	$username = "root";
	$password = "";

	$connCriaDB = new mysqli($servername, $username, $password);

	$queryCriaBanco = 'create database if not exists apiaula;';
	$result = $connCriaDB->query($queryCriaBanco);


	$conn = new mysqli($servername, $username, $password, 'apiaula');

    	$queryCriaTabela = 'CREATE TABLE IF NOT EXISTS pensamentos (
      		id int(5) NOT NULL AUTO_INCREMENT,
	      pensamento varchar(255) NOT NULL,
	      dt_criacao datetime,
	      PRIMARY KEY (id)
	    ) DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;';

	$result = $conn->query($queryCriaTabela);

?>

<HTML>
<HEAD>
<TITLE>Pensamentos do dia</TITLE>
</HEAD>

<BODY>
 	<form action="index.php" method="post">
	  <h1>Insira um pensamento:</h1> 
	  <input type="text" name="pensamento" id="pensamento"><br>
	  <input type="submit" value="Enviar">
	</form> 
	<?php
		//inclui um novo pensamento
		if($_POST['pensamento']) {
			$pensamento = $_POST['pensamento'];
			$dataCriacao = date("Y-m-d H:i:s");

			$queryInserePensamento = "INSERT INTO pensamentos (pensamento, dt_criacao)
				VALUES ('".$pensamento."','". $dataCriacao."')";

			$result = $conn->query($queryInserePensamento);

		} else {
			$pensamento = "";
		}

		$queryListaPensamentos = "SELECT pensamento, dt_criacao FROM pensamentos";
		$result = $conn->query($queryListaPensamentos);

		if($result->num_rows > 0){
			echo "<table>";
			    echo "<tr>";
				echo "<th>Pensamento</th>";
				echo "<th>Data Criacao</th>";
			    echo "</tr>";
			while($row = $result->fetch_assoc()){
			    echo "<tr>";
				echo "<td>" . $row['pensamento'] . "</td>";
				echo "<td>" . $row['dt_criacao'] . "</td>";
			    echo "</tr>";
			}
			echo "</table>";
			// Free result set
			mysqli_free_result($result);
		} else{
			echo "Ainda nao temos pensamentos hoje.";
		}
	?>
</BODY>
</HTML>
<?php
	$conn->close();
?>
