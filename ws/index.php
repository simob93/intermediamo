<?php
require("vendor/autoload.php");
 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;
 
require 'vendor/autoload.php';
require_once 'model/dbConnection.php';
require_once 'model/contatti.php';
require_once 'model/allegati.php';
require_once 'model/costanti.php';
require_once 'model/rapporti.php';

$app = new \Slim\App;



$container = $app->getContainer();
//Generazione del mio token
$container["token"] = function($c) { 
	$time = time();
	$secret_key ="12345678";
	$token['exp'] = $time * 60;

	return JWT::encode($token, $secret_key);
};

$app->add(new Tuupola\Middleware\JwtAuthentication([
	"path" => "/*", /* or ["/api", "/admin"] */
	"ignore" => "/login/doLogin",
    "secret" => "12345678"
]));


$app->add(function (Request $req, Response $res, $next) {
	//var_dump($req->getHeader('Authorization'));
	$response = $next($req, $res);

    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
			->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/contatti/list', function (Request $request, Response $response, $args) {

	$connection = new DbConnection();
	$conn = $connection -> getDbConnection();
	//recupero i parametri di get
	$params = $request->getQueryParams();
	
	$sql = 'SELECT ID as id, NOME as nome, COGNOME as cognome, 
				   DATADINASCITA as dataDiNascita, CODICEFISCALE as codFiscale 
			FROM contatti as c ';
	
	$search = isset($params["text"]) && !empty($params["text"]) ? $params["text"] : null;
	$tree = isset($params["tree"]) ? $params['tree']: null;

	if (isset($search)) {

		$search = "'%{$search}%'";
		$sql .= "WHERE c.COGNOME LIKE " .$search." OR c.NOME LIKE ".$search;
	}
	$sql .= ' ORDER BY c.COGNOME ASC';  
	$stmt = $conn -> prepare($sql);
	$stmt -> execute();
	//popolo la mia calsse (viene esegutio il costruttore)
	$data = $stmt -> fetchAll(PDO::FETCH_CLASS, "Contatti");

	if (isset($tree) && $tree == 'T') {
		$result = array();
        if (isset($data) && count($data) > 0) {
            $tmpIndex = 0; 
            $previous = null; 
            $result = array(); 
            $alfabetic  = null;

            foreach ($data as $value) {
                
               $firstLetter = substr($value->cognome, 0, 1);
               $change = $previous !== $firstLetter;
               if ($change) {
                   //costruisco il nodo principale
                   $alfabetic = array("lettera" => $firstLetter, "contatto" => array());
                   array_push($result, $alfabetic);
                   $tmpIndex++;
               } 
               //aggiungo al nodo "padre" i figli
               array_push($result[$tmpIndex -1]["contatto"], $value);
               $previous = $firstLetter;
           }
		}
		$data = $result;
	}
	echo json_encode(array("success" => true, "message"=>Costanti::OPERAZIONE_OK, "data" =>$data));	
});

$app->post('/contatti/save', function (Request $request, Response $response) {
	//recupero la connessione al database
	$connection = new DbConnection();
	$conn = $connection -> getDbConnection();
	$params = $request -> getParsedBody();
	$success = true;
	$id = null;
	$message = array();
	try {
		$stmt = $conn -> prepare(
			'INSERT INTO contatti (NOME, COGNOME, DATADINASCITA, CODICEFISCALE, EMAIL, TELEFONO, VIA, CAP, PROVINCIA, CITTA) 
				VALUES (:NOME, :COGNOME, :DATADINASCITA, :CODICEFISCALE, :EMAIL, :TELEFONO, :VIA, :CAP, :PROVINCIA, :CITTA)'
		);
		//setto i parametri
		$stmt->bindParam(':NOME', $params["nome"]);
		$stmt->bindParam(':COGNOME', $params["cognome"]);
		$stmt->bindParam(':DATADINASCITA', $params["dataDiNascita"]);
		$stmt->bindParam(':CODICEFISCALE', $params["codiceFiscale"]);
		$stmt->bindParam(':EMAIL', $params["email"]);
		$stmt->bindParam(':TELEFONO', $params["telefono"]);
		$stmt->bindParam(':VIA', $params["via"]);
		$stmt->bindParam(':CAP', $params["cap"]);
		$stmt->bindParam(':PROVINCIA', $params["provincia"]);
		$stmt->bindParam(':CITTA', $params["citta"]);
		$stmt -> execute();
		array_push($message, Costanti::OPERAZIONE_OK);
		//recupero l'idInserito
		$id = $conn->lastInsertId();
	
	} catch (Exception $e) {
		$success = false;
		array_push($message, Costanti::OPERAZIONE_KO, $e -> getMessage());
	}
	echo json_encode(
		array("success" => $success, "message"=> $message, "data" =>$id)
	);	
	
});
$app->post('/login/doLogin', function (Request $request, Response $response) {
	//recupero la connessione al database
	$connection = new DbConnection();
	$conn = $connection -> getDbConnection();
	$params = $request -> getParsedBody();
	$username = $params["username"];
	$password = $params["password"];
	$success = true;
	$message = array();
	try {
		$stmt = $conn -> prepare(
			'SELECT ID as id, USERNAME as username, PASSWORD as password 
			FROM pwd as p
			WHERE p.USERNAME=:USERNAME AND p.PASSWORD=:PASSWORD'
		);
		$stmt->bindParam(':USERNAME', $username);
		$stmt->bindParam(':PASSWORD', $password);
		$stmt -> execute();
		$data = $stmt -> fetchAll();
						
		if (count($data) > 0) {
			array_push($message, Costanti::OPERAZIONE_OK);
			echo json_encode(array("success" => true, "message"=> $message, "data" =>  $this->get("token")));		
			return false;
		}
		
		//recupero l'idInserito
	
	} catch (Exception $e) {
		$success = false;
		array_push($message, Costanti::OPERAZIONE_KO, $e -> getMessage());
	}
	echo json_encode(array("success" => $success, "message"=>Costanti::OPERAZIONE_OK, "data" =>null));	
	
	
	
});

$app->post('/immobile/save', function (Request $request, Response $response, $args) {
	
	$connection = new DbConnection();
	$conn = $connection -> getDbConnection();
	//recupero i parametri di get
	$params = $request -> getParsedBody();
	$success = true;
	$id = null;
	$message = array();
	
	$sql = 'INSERT INTO immob
			(
				DATA_ACQUISTO,ANNOCOSTRUZIONE,DATA_RISTRUTTURATO,COSTRUITODA,TIPOLOGIA,MQNETTI,MQCOMM,UNITATOT,
				PIANO,TOTPIANI,ESPOSIZIONE,GIARDINO,MQGIARDINO, TERRAZZO, MQTERRAZZO, NUMEROTERRAZZO, BALCONE,
				NUMEROBALCONE,MQBALCONE,CANNAFUMARIA,CAPPOTTO,PANNELLISOLARI,FOTOVOLTAICO,POSTOAUTO,INGRESSODISBRIGO,
				CUCINAABITABILE,CUCINOTTO,SOGGIORNOCOTTURA,SOGGIORNO,CAMERAMATRIMONIALE,CAMERETTA,STUDIO,
				RIPOSTIGLIO,SOTTOTETTO, BAGNI, STUBE, IDCONTATTO)
		values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

	try {

		$stmt = $conn -> prepare($sql);
		
		$stmt -> bindParam(1, $params["dataAcquisto"], PDO::PARAM_STR);
		$stmt -> bindParam(2, $params["annoCostruzione"], PDO::PARAM_STR);
		$stmt -> bindParam(3, $params["dataRistrutturato"], PDO::PARAM_STR);
		$stmt -> bindParam(4, $params["costruitoDa"], PDO::PARAM_STR);
		$stmt -> bindParam(5, $params["tipologia"], PDO::PARAM_STR);
		$stmt -> bindParam(6, $params["mqNetti"], PDO::PARAM_INT);
		$stmt -> bindParam(7, $params["mqComm"], PDO::PARAM_INT);
		$stmt -> bindParam(8, $params["unitaTot"], PDO::PARAM_INT);
		$stmt -> bindParam(9, $params["piano"], PDO::PARAM_INT);
		$stmt -> bindParam(10, $params["totPiani"], PDO::PARAM_INT);
		$stmt -> bindParam(11, $params["esposizione"], PDO::PARAM_STR);
		$stmt -> bindParam(12, $params["giardino"], PDO::PARAM_STR);
		$stmt -> bindParam(13, $params["mqGiardino"], PDO::PARAM_INT);
		$stmt -> bindParam(14, $params["terrazzo"], PDO::PARAM_STR);
		$stmt -> bindParam(15, $params["mqTerrazzo"], PDO::PARAM_INT);
		$stmt -> bindParam(16, $params["numTerrazzo"], PDO::PARAM_INT);
		$stmt -> bindParam(17, $params["balcone"], PDO::PARAM_STR);
		$stmt -> bindParam(18, $params["numBalcone"], PDO::PARAM_INT);
		$stmt -> bindParam(19, $params["mqBalcone"], PDO::PARAM_INT);
		$stmt -> bindParam(20, $params["cannafumaria"], PDO::PARAM_STR);
		$stmt -> bindParam(21, $params["cappotto"], PDO::PARAM_STR);
		$stmt -> bindParam(22, $params["pannelliSolari"], PDO::PARAM_STR);
		$stmt -> bindParam(23, $params["fotovoltaico"], PDO::PARAM_STR);
		$stmt -> bindParam(24, $params["postoAuto"], PDO::PARAM_STR);
		$stmt -> bindParam(25, $params["ingressoDisbrigo"], PDO::PARAM_STR);
		$stmt -> bindParam(26, $params["cucinaAbitabile"], PDO::PARAM_STR);
		$stmt -> bindParam(27, $params["cucinotto"], PDO::PARAM_STR);
		$stmt -> bindParam(28, $params["soggiornoCottura"], PDO::PARAM_STR);
		$stmt -> bindParam(29, $params["soggiorno"], PDO::PARAM_STR);
		$stmt -> bindParam(30, $params["cameraMatrimoniale"], PDO::PARAM_STR);
		$stmt -> bindParam(31, $params["cameretta"], PDO::PARAM_STR);
		$stmt -> bindParam(32, $params["studio"], PDO::PARAM_STR);
		$stmt -> bindParam(33, $params["ripostiglio"], PDO::PARAM_STR);
		$stmt -> bindParam(34, $params["sottoTetto"], PDO::PARAM_STR);
		$stmt -> bindParam(35, $params["bagni"], PDO::PARAM_STR);
		$stmt -> bindParam(36, $params["stube"], PDO::PARAM_STR);
		$stmt -> bindParam(37, $params["idContatto"], PDO::PARAM_INT);
	
		$stmt -> execute();
		$id = $conn->lastInsertId();
		array_push($message, Costanti::OPERAZIONE_OK);
		

	} catch (Exception  $e) {
		$success = false;
		array_push($message, Costanti::OPERAZIONE_KO, $e -> getMessage());
	}

	echo json_encode(array("success" => $success, "message"=>$message, "data" =>$id));	
});

$app->post('/allegati/upload', function (Request $request, Response $response) {
	//recupero la connessione al database
	$connection = new DbConnection();
	$conn = $connection -> getDbConnection();
	$params = $request -> getParsedBody();
	$success = true;
	$message = array();
	try {


		$file = $params['file'];
		$nome = $params['nome'];
		$idImmobile = $params['idImmobile'];
		
		$sql = "INSERT INTO allegati (NOME, FILE, IDIMMOBILE) values (?,?,?)";

		$stmt = $conn -> prepare($sql);
		
		$stmt -> bindParam(1, $nome, PDO::PARAM_STR);
		$stmt -> bindParam(2, $file, PDO::PARAM_STR);
		$stmt -> bindParam(3, $idImmobile, PDO::PARAM_INT);
		$stmt -> execute();

		array_push($message, Costanti::OPERAZIONE_OK);

	
	} catch (Exception $e) {
		$success = false;
		array_push($message, Costanti::OPERAZIONE_KO, $e -> getMessage());
	}
	echo json_encode(array("success" => $success, "message"=>$message, "data" =>null));	
});
$app->get('/allegati/getByContatto', function (Request $request, Response $response, $args) {
	
		$connection = new DbConnection();
		$conn = $connection -> getDbConnection();
		//recupero i parametri di get
		$params = $request->getQueryParams();
		
		$sql = 'SELECT ID as id, NOME as nome, FILE as file, IDIMMOBILE as idImmobile
				FROM allegati as a 
				WHERE a.IDIMMOBILE = ?';
		
		$success = true;
		$message = array();
		$data = null;
		try {

			$stmt = $conn -> prepare($sql);

			$stmt -> bindParam(1, $params['idImmobile'], PDO::PARAM_INT);
			$stmt -> execute();

			$data = $stmt -> fetchAll(PDO::FETCH_CLASS, "Allegati");

			foreach($data as $value) {
				$tmp = explode( ',', $value -> file);
				if (!strpos($tmp[0], 'image'))
					$value -> file = null;
			}
			array_push($message, Costanti::OPERAZIONE_OK);

		} catch (Exception $e) {
			$success = false;
			array_push($message, Costanti::OPERAZIONE_KO, $e -> getMessage());
		}
		//popolo la mia calsse (viene esegutio il costruttore)
		echo json_encode(array("success" => $success, "message"=>$message, "data" =>$data));	
});

$app->get('/allegati/linkById', function (Request $request, Response $response, $args) {
	
		$connection = new DbConnection();
		$conn = $connection -> getDbConnection();
		//recupero i parametri di get
		$params = $request->getQueryParams();
		
		$sql = 'SELECT NOME as nome, FILE as file FROM allegati as a WHERE a.ID = ?';
		
		$success = true;
		$message = array();
		$data = null;
		$path = $_SERVER['DOCUMENT_ROOT'].'/tmp';
		try {

			$stmt = $conn -> prepare($sql);

			$stmt -> bindParam(1, $params['id'], PDO::PARAM_INT);
			$stmt -> execute();

			$data = $stmt -> fetchAll(PDO::FETCH_CLASS, "Allegati");

			//decodifico il file base 24 e creo una cartella temporanea
			$file = $data[0] -> file;
			$nome = $data[0] -> nome;
			if (isset($file)) {
			
				if (!is_dir($path))
					mkdir($path, 0777, true);
				
				$fileName = $path.'/'.$nome;
				
				$ifp = fopen( $fileName, 'wb' ); 
					
				$data = explode( ',', $file );
				
				fwrite( $ifp, base64_decode( $data[ 1 ] ) );
				fclose( $ifp ); 

				$remotePath = 'http://'.$_SERVER['SERVER_NAME'].'/tmp/'.$nome;
								
			}
			array_push($message, Costanti::OPERAZIONE_OK);
		} catch (Exception $e) {
			$success = false;
			array_push($message, Costanti::OPERAZIONE_KO, $e -> getMessage());
		}
		//popolo la mia calsse (viene esegutio il costruttore)
		echo json_encode(array("success" => $success, "message"=>$message, "data" =>$remotePath));	
});

$app->get('/rapporti/list', function (Request $request, Response $response, $args) {
	
		$connection = new DbConnection();
		$conn = $connection -> getDbConnection();
		//recupero i parametri di get
		$params = $request->getQueryParams();

		$data = strtotime($params['data']); //timestamp
		//calcolo la data di inizio / fine giornata
		$dataInizio = strtotime('midnight', $data);
		$dataFine = strtotime('tomorrow', $dataInizio) - 1;

		$dataInizioFormat = date("Y-m-d H:i:s", $dataInizio);
		$dataFineFormat = date("Y-m-d H:i:s", $dataFine);

		$sql = "SELECT immo.ID as idImmobile, cont.ID as idContatto, CONCAT(cont.nome, ' ', cont.cognome) as nominativo,  immo.INSERTDATA as insertData
				FROM immob as immo INNER JOIN contatti as cont
				ON cont.ID = immo.IDCONTATTO
				WHERE immo.INSERTDATA >= ? AND immo.INSERTDATA <= ? ";
		
		$success = true;
		$message = array();
		$data = null;
		try {

			$stmt = $conn -> prepare($sql);

			$stmt -> bindParam(1, $dataInizioFormat, PDO::PARAM_STR);
			$stmt -> bindParam(2, $dataFineFormat, PDO::PARAM_STR);
			$stmt -> execute();

			$data = $stmt -> fetchAll(PDO::FETCH_CLASS, "Rapporti");

			array_push($message, Costanti::OPERAZIONE_OK);

		} catch (Exception $e) {
			$success = false;
			array_push($message, Costanti::OPERAZIONE_KO, $e -> getMessage());
		}
		//popolo la mia calsse (viene esegutio il costruttore)
		echo json_encode(array("success" => $success, "message"=>$message, "data" =>$data));	
});


$app->run();
?>