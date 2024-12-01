<?php
require_once 'dbconf.php';

function showTable1($tname, $connect, $colnames) {
    try {
        $sql = "SELECT ";

        for ($i = 0; $i < sizeof($colnames) - 1; $i++) {
            $sql .= $colnames[$i] . ",";
        }

        $sql .= $colnames[sizeof($colnames) - 1] . " FROM $tname "; 

        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>";
            echo "<tr>";

            $columns = mysqli_fetch_fields($result);
            foreach ($columns as $column) {
                echo "<th>$column->name</th>";
            }
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No result";
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

showTable1("student", $connect, ["name", "course"]);
?>