<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $billno = $_POST['billno'];
    $Table = $_POST['tabno'];
    $_SESSION['billno'] = $billno;
    $_SESSION['Table'] = $Table;
    $_SESSION['billEdit'] = true;
    echo 'Session variable set successfully';
} else {
    if (isset($_SESSION['billno'])) 
    {
        echo json_encode(['billno' => $_SESSION['billno'],'BillEdit'=>$_SESSION['billEdit'],'Table'=>$_SESSION['Table'] ]);
    } else {
        echo json_encode([]);
    }
}


?>