<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Simple SPARQL Fuseki Select</title>
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
            <a class="navbar-brand" href="coba.php">SEMANTICS - Streamline : Hewan famili Characidae</a>
       
        </nav>
		</br>
		<div class="container pt-12">
		<?php
			include_once('semsol/ARC2.php');  

			$dbpconfig = array(
			"remote_store_endpoint" => "http://dbpedia.org/sparql",
			);

			$store = ARC2::getRemoteStore($dbpconfig); 

			if ($errs = $store->getErrors()) {
			 echo "<h1>getRemoteSotre error<h1>" ;
			}

			$query = '
			PREFIX dbpedia-owl: <http://dbpedia.org/ontology/>
			PREFIX owl: <http://www.w3.org/2002/07/owl#>
			PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
			PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
			PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
			PREFIX foaf: <http://xmlns.com/foaf/0.1/>
			PREFIX dc: <http://purl.org/dc/elements/1.1/>
			PREFIX : <http://dbpedia.org/resource/>
			PREFIX dbpedia2: <http://dbpedia.org/property/>
			PREFIX dbpedia: <http://dbpedia.org/>
			PREFIX dbpprop: <http://dbpedia.org/property/>

			SELECT DISTINCT ?species ?binomial ?genus ?label
			WHERE { ?species dbpedia-owl:family :Characidae;
				dbpprop:genus ?genus;
				rdfs:label ?label;
				dbpedia2:binomial ?binomial.
				filter ( langMatches(lang(?label), "en") ) }
			ORDER BY ?genus';

			$rows = $store->query($query, 'rows'); 

			if ($errs = $store->getErrors()) {
			   echo "Query errors" ;
			   print_r($errs);
			}

			echo "<table id='datapertanyaan' class='table table-striped table-bordered' style='width:100%'>
			<thead>
				<th>#</th>
				<th>Species (Label)</th>
				<th>Binomial</th>
				<th>Genus</th>
			</thead>";

			$id=0;
			foreach( $rows as $row ) { 
			print "<tr><td>".++$id. "</td>
			<td><a href='". $row['species'] . "'>" . 
			$row['label']."</a></td><td>" . 
			$row['binomial']. "</td><td>" . 
			$row['genus']. "</td></tr>";
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