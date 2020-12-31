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
      SELECT * from engineers;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }

// Show link to all trainings
   echo "<br><br><a href=trainings.php>All trainings list</a><br><br>";

// Show the table with engineers

   echo 'The list of engineers:<br><br>';

   echo "<table border='1'>
   <tr>
   <th>ID</th>
   <th>Name</th>
   <th>Email</th>
   </tr>";

   while($row = pg_fetch_row($ret)) {
      $name_link = strtok($row[2], '@');
      echo "<tr>";
//      echo "<td>" . $row[0] . "</td>";
      echo '<td><a href="'.$name_link.'.php">' . $row[0] . '</a></td>';
      //      echo "<td>" . $row[1] . "</td>";
      echo '<td><a href="'.$name_link.'.php">' . $row[1] . '</a></td>';
//      $name_link = strtok($row[2], '@');
//      echo "<td>";
      //      echo "<a href='" . $name_link . "'>Link</a>"
      //echo "<a href=\"ya.ru\">Link</a>"
      echo '<td><a href="'.$name_link.'.php">' . $row[2] . '</a></td>';
//      echo "</td>";
//      echo "<td>" . $row[2] . "</td>";
      echo "</tr>";
//      echo "ID = ". $row[0] . "\n";
//      echo "NAME = ". $row[1] ."\n";
//      echo "EMAIL = ". $row[2] ."\n";
   }
   echo "</table>";
//   echo "Operation done successfully\n";
   pg_close($db);


?>

