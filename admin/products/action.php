<?php 
  require_once('../../includes/dbh.inc.php');

  if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    mysqli_query($conn, "DELETE FROM product WHERE id=$id LIMIT 1");
  } 
  
  if (isset($_POST['company_name'])) {
    $request;
    $company_name;
    $request = $_POST['request'];
    $company_name = $_POST['company_name'];

    if($company_name == 'All Companies'){
      if($request != 'All Categories'){
        $query = "SELECT * FROM product WHERE item_categorie ='$request'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);  
      }else{ 
        $query = "SELECT * FROM product";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result); 
      }      
    }else{
      
      if($request != 'All Categories'){
        $sql1 = "SELECT * FROM `business` WHERE company_name = '$company_name'";
        $result1 = mysqli_query($conn, $sql1);
    
        while($row1 = mysqli_fetch_assoc($result1)){
          $company_id = $row1['id'];
        }
        $query = "SELECT * FROM product WHERE item_categorie ='$request' && business_id = '$company_id'";
  
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);

      }else{
        $sql1 = "SELECT * FROM `business` WHERE company_name = '$company_name'";
        $result1 = mysqli_query($conn, $sql1);
    
        while($row1 = mysqli_fetch_assoc($result1)){
          $company_id = $row1['id'];
        }
        $query = "SELECT * FROM product WHERE business_id = '$company_id'";
  
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
      }
    }
    
  
  
  ?>
  
    <table class="approved_businesses_table">
      <?php
      if ($count) {
        
      
      ?>
      
        <tr>
          <th>Emri i Kompanisë</th>
          <th>Emri i Produktit</th>
          <th>Çmimi</th>
          <th>Përbërësit</th>
          <th>Kategoria</th>
          <th>Shikueshmëria</th>
          <th>Foto</th>
          <th>Fshij produktin</th>
        </tr>
    
          <?php
      }else{
        echo "Sorry! no record Found";
      }

        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
            echo "<th>".$company_name."</th>";
            echo "<th>". $row['item_name'] ."</th>";
            echo "<th>". $row['item_price'] ."</th>";
            echo "<th>". $row['item_ingridients'] ."</th>";
            echo "<th>". $row['item_categorie'] ."</th>";
            echo "<th>". $row['item_views'] ."</th>";
            echo "<th><img width='50 ' src='../dashboard/products/uploads/". $row['item_picture'] ."'></th>";
            echo "<th><button class='delete_product_action' value='".$row['id']."' id='delete_products'><i class='fas fa-times-circle'></i></button></th>";
          echo "</tr>";
        }
        ?>
        <?php 
  }?>
  </table>
