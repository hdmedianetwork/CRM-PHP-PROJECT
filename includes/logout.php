<?php

// Logout user
session_start();
session_unset();
session_destroy();

header("Location: /newtemp/login");
exit();
