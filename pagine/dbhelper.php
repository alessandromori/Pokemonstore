<?php
function Connetti(){
  $servername = 'localhost';
  $port = 3723;
  $username = 'root';
  $password = 'mysql';
  $dbname = 'pokemon';
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  return $conn;
}
function Cerca($conn, $iden){
  $sql = "select * from pokemon where identifier like '%$iden%'";
  $sth = $conn->prepare($sql);
  $sth->execute();
  echo "<div class='row'>";
    echo "<div class='col-1'>";
    echo "ID";
    echo"</div>";
    echo "<div class='col'>";
    echo "Sprite";
    echo"</div>";
    echo "<div class='col'>";
    echo "Nome";
    echo"</div>";
    echo "<div class='col'>";
    echo "Altezza" ;
    echo"</div>";
    echo "<div class='col'>";
    echo "Peso";
    echo"</div>";
    echo "<div class='col'>";
    echo "Esp. Iniz.";
    echo"</div>";
  echo "</div>";
    while($result=$sth->fetch()){
    echo "<div class='row border border-danger rounded'>";
      echo "<div class='col-1' style='margin:auto'>";
      echo $result['id'];
      echo"</div>";
      echo "<div class='col' style='margin:auto'>";
      echo "<img src='../sprites/" . $result['id'] . ".png'>";
      echo "</div>";
      echo "<div class='col' style='margin:auto'>";
      echo $result['identifier'];
      echo"</div>";
      echo "<div class='col' style='margin:auto'>";
      echo $result['height'];
      echo"</div>";
      echo "<div class='col' style='margin:auto'>";
      echo $result['weight'];
      echo"</div>";
      echo "<div class='col' style='margin:auto'>";
      echo $result['base_experience'];
      echo"</div>";
    echo "</div>";
  }
}
function Catalogo($conn){
  $x_pag = 5;
  if (isset($_GET['pag'])){
      $pag = $_GET['pag'];
  }
  else
  {
     $pag  = 1;
  }
  if (!$pag || !is_numeric($pag)){
      $pag = 1;
  }
  $sql = "SELECT count(*) FROM pokemon";
  $sth = $conn->prepare($sql);
  $sth->execute();
  $all_rows = $sth->fetchColumn();
  $all_pages = ceil($all_rows / $x_pag);
  $first = ($pag-1) * $x_pag;
  $sql = "SELECT * FROM pokemon LIMIT $first, $x_pag";
  $sth = $conn->prepare($sql);
  $sth->execute();
  echo "<div class='row'>";
    echo "<div class='col-1'>";
    echo "ID";
    echo "</div>";
    echo "<div class='col'>";
    echo "Sprites";
    echo "</div>";
    echo "<div class='col'>";
    echo "Nome";
    echo "</div>";
    echo "<div class='col'>";
    echo "Altezza";
    echo "</div>";
    echo "<div class='col'>";
    echo "Peso";
    echo "</div>";
    echo "<div class='col'>";
    echo "Esp. Iniz.";
    echo"</div>";
  echo "</div>";
    while($result = $sth->fetch(PDO::FETCH_ASSOC))
    {
      echo "<div class='row border border-danger rounded'>";
        echo "<div class='col-1' style='margin:auto'>";
        echo $result['id'];
        echo "</div>";
        echo "<div class='col' style='margin:auto'>";
        echo "<img src='../sprites/" . $result['id'] . ".png'>";
        echo "</div>";
        echo "<div class='col' style='margin:auto'>";
        echo $result['identifier'];
        echo "</div>";
        echo "<div class='col' style='margin:auto'>";
        echo $result['height'];
        echo "</div>";
        echo "<div class='col' style='margin:auto'>";
        echo $result['weight'];
        echo "</div>";
        echo "<div class='col' style='margin:auto'>";
        echo $result['base_experience'];
        echo"</div>";
      echo "</div>";
    }
  echo "<div class='pagine'>";
  if ($all_pages > 1){
      if ($pag > 1){
          echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag - 1) . "\">";
          echo "<<</a>&nbsp;";
      }

      if($p=$pag){
        echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . $p . "\"" . "style='color:black'>";
        echo $p . "</a>&nbsp;";
      }

      for ($p=$pag+1; $p<$pag+5; $p++) {

          echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . $p . "\">";
          echo $p . "</a>&nbsp;";
      }
      if ($all_pages > $pag){
          echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag + 1) . "\">";
          echo ">></a>";
      }

  }
  echo "</div>";
}
function Registrati($conn,$username,$nome,$cognome,$password,$email,$telefono,$datanascita,$paesenascita){
  try{

    $sql = "INSERT INTO Utente(Username,Password,nome,cognome,email,telefono,datanascita,paesenascita) VALUES(:user,:password,:nome,:cognome,:email,:telefono,:datanascita,:paesenascita)";
    $sth = $conn->prepare($sql);
    $sth->execute(array(':user'=>$username,':password'=>$password,':nome'=>$nome,':cognome'=>$cognome,':email'=>$email,':telefono'=>$telefono,':datanascita'=>$datanascita,':paesenascita'=>$paesenascita));
    return true;
  }
  catch(PDOException $e){
           echo 'Error: '.$e->getMessage();
           return false;
    }
}

function Login($conn,$username,$password){
  $sql = "select * from Utente where Username = :username  and Password  = :password";
  $sth = $conn->prepare($sql);
  $sth->execute(array(':username'=>$username,':password'=>$password));
  $numero_righe = $sth->rowCount();
  if($numero_righe == 0){
    echo "<div>
          Username e/o Password sbagliata
          </div>";
  }
  else{
    echo "<div>
          Bentornato " . $username .
          "</div>";
  }
}
?>
