<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prioritization</title>
</head>

<body>
    <h1> Priority Queue</h1>
    <table>
        <thead>
            <tr>
                <th>Priority</th>
                <th>Item</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($priorityQueue as $priority => $items) {
                foreach ($items as $item) {
                    echo "<tr>";
                    echo "<td>$priority</td>";
                    echo "<td>$item</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
</body>

</html>