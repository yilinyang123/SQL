<?php

if (isset($_POST['submit2'])) {

    require_once("conn.php");

    $city = $_POST['city2'];

    $condition = $_POST['condition'];

    $query = "SELECT DISTINCT CONCAT(frst_nm, ' ', mid_nm, ' ', lst_nm, ' ', suffix) AS name, prf_rate, 
              org_nm 
              -- (YEAR(NOW()) - grad_year) AS experience_year
              FROM provider_info
              INNER JOIN individual_score
              ON provider_info.NPI = individual_score.NPI
              INNER JOIN provider_profession
              ON provider_info.NPI = provider_profession.NPI
              INNER JOIN provider_address
              ON provider_info.NPI = provider_address.NPI
              WHERE pri_spec LIKE CONCAT('%',UPPER(:condition),'%')
              AND city = UPPER(:city2)
              ORDER BY prf_rate DESC";

try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':city2', $city, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':condition', $condition, PDO::PARAM_STR);
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
if (isset($_POST['submit2'])) {
  if ($result && $prepared_stmt->rowCount() > 0) { ?>
    

    <table>
      <thead>
    <tr>
      <th>Doctor name</th>
      <th>Performance score</th>
      <th>Hospital</th>
      <!-- <th>Years of experience</th> -->
    </tr>
      </thead>
      <tbody>
  
<?php foreach ($result as $row) { ?>
      
      <tr>
    <td><?php echo $row["name"]; ?></td>
    <td><?php echo $row["prf_rate"]; ?></td>
    <td><?php echo $row["org_nm"]; ?></td>
    <!-- <td><?php echo $row["experience_year"]; ?></td> -->
      </tr>
<?php } ?>
      </tbody>
  </table>
  
<?php } else { ?>
    > No results found for <?php echo $_POST['city2']; ?>.
  <?php }
} ?>