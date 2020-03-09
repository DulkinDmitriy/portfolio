<?php

require_once('db_driver.php');

    $driver = new DbDriver();

    $result = $driver->execute("SELECT * FROM discipline as d 
                                  JOIN index as i ON d.index_id = i.id 
                                  JOIN rating as r ON d.rating_id = r.id
                                  JOIN section as s ON d.section_id = s.id");

    foreach ($result as $row) {
        var_dump($row);
    }
?>