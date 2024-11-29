<?php

      $email=$_GET["email"];
      $db->update_user_authenticated($email);
      echo "<script>window.setTimeout('window.close()',500);</script>";
?>