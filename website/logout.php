<?php
    session_start();
    session_destroy();
    session_unset();
    echo "<script>
          alert('Logout successfully!, Will redirect to home page shortly');
          window.location.href='index.html';
          </script>";
?>