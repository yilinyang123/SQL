
<?php

if (isset($_POST['submit3'])) {

    require_once("conn.php");

    $hospital_insert = $_POST['hospital_insert'];
    $measure_insert = $_POST['measure_insert'];
    $score_insert = $_POST['score_insert'];

    $query = "INSERT into patient_experience (org_nm, measure_id, prf_rate)
              values (:hospital_insert, :measure_insert, :score_insert)";

  try
  {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':hospital_insert', $hospital_insert, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':measure_insert', $measure_insert, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':score_insert', $score_insert, PDO::PARAM_STR);
      $prepared_stmt->execute();
      $code=$prepared_stmt->errorCode();
    }

    catch (PDOException $ex)
    { // Error in database processing.
      echo $query . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
  }
}

?>

<?php
if (isset($_POST['submit3'])) {
  if ($code==00000) {
   
   echo "Insert success!";

  } else { 

    $errorInfo = $prepared_stmt->errorInfo();
    echo $errorInfo[2];

  }
} 
?>