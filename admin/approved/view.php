<?php require_once("../../includes/dbh.inc.php") ?>
<div class="filters">
    <span class="spanFiltro">Filtro në bazë të &nbsp;</span>
    <select name="fetchval" id="fetchval">
      <option value="" disabled="" selected="">Select Filter</option>
      <option value="Vushtrria">Vushtrria</option>
      <option value="Mitrovica">Mitrovica</option>
      <option value="Peja">Peja</option>
      <option value="Prishtina">Prishtina</option>
    </select>
  </div>
  <table class="approved_businesses_table">
  <?php 
    $sql = "SELECT * FROM business WHERE aproved=1 AND username != 'admin'; ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
  ?>
  
  
    <tr>
      <th>Emri & Mbiemri</th>
      <th>E-mail</th>
      <th>Emri i Kompanise</th>
      <th>Qyteti</th>
      <th>Nr. Telefonit</th>
      <th>Statusi</th>
      <th>Fshij</th>
    </tr>


    <?php 
      $status_options = ["Active", "Inactive", "Suspended"];
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
          echo "<th>". $row['name'] ."</th>";
          echo "<th>". $row['email'] ."</th>";
          echo "<th>". $row['company_name'] ."</th>";
          echo "<th>". $row['company_city'] ."</th>";
          echo "<th>". $row['phone_number'] ."</th>";
          echo "<th>";
            echo "<select class='change_business_status' id='change_business_status_".$row['id']."'>";
              echo "<option>". $row['status'] ."</option>";
              foreach ($status_options as $option) {
                if ($option != $row['status']) {
                  echo "<option>$option</option>";
                }
              }
            echo "</select>";
          echo "</th>";
          echo "<th><button class='delete_business_action' value='".$row['id']."' id='delete_business'><i class='fas fa-times-circle'></i></button></th>";
        echo "</tr>";
      }
    ?>
  <?php } else {
    echo "<h1 style='color: var(--secondary-color);text-align: center;'>Nuk ka biznese ne pritje!</h1>";
  } ?>
</table>

<script>
  
  $(".delete_business_action").on('click', function(e) {
      
    if(confirm("A jeni i sigurt?")){
      let id = this.value;
    
      $.ajax({
        url: "approved/action.php",
        type: "POST",
        data: {
          id: id,
        },
        success: function(data) {
    
          $(".display_approved_businesses").load("approved/view.php");

        }
      }) 
    }
  })
  
  $(".change_business_status").change(function() {
    let value = this.value;
    let id = this.id.split("_").pop();
    $.ajax({
      url: "approved/action.php",
      type: "POST",
      data: {
        action_id: id,
        action: value
      },
      success: function(data) {
        $(".display_approved_businesses").load("approved/view.php");
      }
    })
  });
  
  $(document).ready(function(){
    $("#fetchval").on('change' , function(){
      var value = $(this).val();
      // alert(value);

      $.ajax({
        url:'approved/action.php',
        type:'POST',
        data: 'request=' + value,
        success:function(data){
          $(".approved_businesses_table").html(data);
        }
      });
    });
  });
</script>
