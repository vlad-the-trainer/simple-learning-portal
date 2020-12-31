<?php

   echo '<h1 style="text-align:center;color:blue;">CloudBlue Application Suppport TLS Portal</h1>';
   $engineer_id = htmlspecialchars($_GET["id"]);
   include 'connect.php';

// Check DB connection
   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
//      echo "Opened database successfully";
//      echo "<br>";
   }

//retrive name
   $sql =<<<EOF
      select name from engineers where engineer_id = $engineer_id;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }

   $row = pg_fetch_row($ret);

   echo 'The list of activities scheduled for ' . $row[0] . ':<br><br>';

//retrive data
   $sql =<<<EOF
      select a.activity_name, eta, done, completion_date from scheduled_activities sa join activities a on sa.activity_id = a.activity_id where engineer_id = $engineer_id order by ETA;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }

// Show the table with activities scheduled for the enginer

   echo "<table border='1'>
   <tr>
   <th>Activity</th>
   <th>ETA</th>
   <th>Done?</th>
   <th>Completeion date</th>
   </tr>";

   while($row = pg_fetch_row($ret)) {
//      $name_link = strtok($row[2], '@');
      echo "<tr>";
      echo "<td>" . $row[0] . "</td>";

//      $date_var = mktime($row[1]);
//      echo "<td>" . date("d M Y", $date_var) . "</td>";
      $date_var = new DateTime(substr($row[1], 0, 10));
       echo "<td>" . $date_var->format('d M Y') . "</td>";
      //echo "<td>" . $row[1] . "</td>";

      if ($row[2] == "t") {
        echo "<td>YES</td>";
      } else {
        echo "<td>NO</td>";
      }

//      echo "<td>" . $row[2] . "</td>";
      //echo "<td>" . $row[3] . "</td>";
      if ($row[2] == "t") {
        //$date_var = mktime($row[3]);
        //echo "<td>" . date("d M Y", $date_var) . "</td>";
        $date_var = new DateTime(substr($row[3], 0, 10));
        echo "<td>" . $date_var->format('d M Y') . "</td>";
      } else {
        echo "<td></td>";
      }

      echo "</tr>";
   }
   echo "</table>";

   pg_close($db);

   echo "<br><br><a href=index.php>Back to dashboard</a>";

?>

