<?php

   echo '<h1 style="text-align:center;color:blue;">CloudBlue Application Suppport TLS Portal</h1>';

   include 'connect.php';

// Check DB connection
   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
//      echo "Opened database successfully";
//      echo "<br>";
   }

//retrive data
   $sql =<<<EOF
     select activity_name, description, link from activities;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }

// Show the list of trainings

   echo 'Existing trainings:<br><br>';

   echo "<table border='1'>
   <tr>
   <th>Activity</th>
   <th>Description</th>
   </tr>";

   while($row = pg_fetch_row($ret)) {

      echo "<tr>";
//     echo "<td>" . $row[0] . "</td>";
//      echo "<td>" . $row[1] . "</td>";

//      echo "<td>" . $row[0] . "</td>";
      echo '<td><a href="' . $row[2] . '">' . $row[0] . '</a></td>';
      echo "<td>" . $row[1] . "</td>";


      echo "</tr>";

   }
   echo "</table>";
//   echo "Operation done successfully\n";
   pg_close($db);

   echo "<br><br><a href=index.php>Back to dashboard</a>";

?>

