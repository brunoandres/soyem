<?php  
include("secure3.php");
include("conecta.php");

if(isset($_POST["employee_id"]))  
 {  
        $fecha = $_POST["employee_id"];
      $output = '';  
      $query = "SELECT * FROM asientos where YEAR(fecha) = 2017 order by fecha asc limit 100";  
      $result = mysql_query($query);
      $output .= "
      <table id='tabla_ejercicios' class='display'>  
           <table class='table table-bordered'>
          
           <thead>
              <tr>
                <th>ID</th>
                <th>Trabajo</th>
                            
              </tr>
            </thead>
            <tbody> ";  
      while($row = mysql_fetch_array($result))  {

        
       
           $output .= 
            '
                <tr>  
                     
                     <td>'.$row["nro"].'</td>     
                      
                     <td>'.$row["fecha"].'</td>  
                                         
                </tr>  
           ';  
      }  
      $output .= '</tbody> 
           </table>  
      </div>  
      ';  

      $tabla = "<table id='table_id' class='display'>
      <thead>
          <tr>
              <th>Column 1</th>
              <th>Column 2</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>Row 1 Data 1</td>
              <td>Row 1 Data 2</td>
          </tr>
          <tr>
              <td>Row 2 Data 1</td>
              <td>Row 2 Data 2</td>
          </tr>
      </tbody>
  </table>";
      echo $tabla; 
}  

?>

