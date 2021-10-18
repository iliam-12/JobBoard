<?php
    function check_ese_id($id, $db_ese) {
      foreach  ($db_ese as $row) {
        if ($row['id'] == $id) {
          return $row['name_e'];
        }
      }
    }
?>