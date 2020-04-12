<?php

if (isset($_POST['submit'])) {

    require_once("conn.php");

    $city = $_POST['city'];

    $query = "SELECT org_nm, prf_rate FROM group_score 
              WHERE org_nm IN 
                (SELECT org_nm  FROM provider_address WHERE city = upper(:city))
              ORDER BY prf_rate DESC";

try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':city', $city, PDO::PARAM_STR);
      $prepared_stmt->execute();
      $result = $prepared_stmt->fetchAll();

    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $query . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }
}
?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $prepared_stmt->rowCount() > 0) { ?>
    

    <table>
      <thead>
    <tr>
      <th>Hospital name</th>
      <th>performance score</th>
    </tr>
      </thead>
      <tbody>
  
<?php foreach ($result as $row) { ?>
      
      <tr>
    <td><?php echo $row["org_nm"]; ?></td>
    <td><?php echo $row["prf_rate"]; ?></td>
      </tr>
<?php } ?>
      </tbody>
  </table>
  
<?php } else { ?>
    > No results found for <?php echo $_POST['city']; ?>.
  <?php }
} ?>
