<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Simple SPARQL Select</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">

        <script src="assets/bootstrap/jquery.min.js"></script>
        <script src="assets/bootstrap/popper.min.js"></script>
        <script src="assets/bootstrap/bootstrap.min.js"></script>


        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">SEMANTICS - Streamline : dataset contact</a>
       
        </nav>
		</br>
		<div class="container pt-12">
		<?php
			include_once('semsol/ARC2.php');  

			$dbpconfig = array(
			"remote_store_endpoint" => "http://localhost:3030/contact/query",
			);

			$store = ARC2::getRemoteStore($dbpconfig); 

			if ($errs = $store->getErrors()) {
			 echo "<h1>getRemoteSotre error<h1>" ;
			}

			$query = '
			PREFIX foaf: <http://xmlns.com/foaf/0.1/>

			SELECT ?subject ?predicate ?obje
			WHERE {
			  ?subject ?predicate ?obje
			}
			LIMIT 25';

			$rows = $store->query($query, 'rows'); 

			if ($errs = $store->getErrors()) {
			   echo "Query errors" ;
			   print_r($errs);
			}

			echo "<table id='datapertanyaan' class='table table-striped table-bordered' style='width:100%'>
			<thead>
				<th>#</th>
				<th>Subjek</th>
				<th>Predikat</th>
				<th>Objek</th>
			</thead>";

			$id=0;
			foreach( $rows as $row ) { 
			print "<tr><td>".++$id. "</td>
			<td>" . 
			$row['subject']."</td><td>" . 
			$row['predicate']. "</td><td>" . 
			$row['obje']. "</td></tr>";
			}
			echo "</table>" 

		?>
	</div>


    <script>
        $(document).ready(function () {
            $('#datapertanyaan').DataTable();
        });


    </script>

</html>