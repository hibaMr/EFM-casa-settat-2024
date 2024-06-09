<?php
session_start();
session_destroy();
header('location:conxDB.php');