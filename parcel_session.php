<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $billno = $_POST['billno'];
    $Table = $_POST['tabno'];
    $_SESSION['parcelbillno'] = $billno;
    $_SESSION['ParcelTable'] = $Table;
    $_SESSION['parcelbillEdit'] = true;
    echo 'Session variable set successfully';
} else {
    if (isset($_SESSION['parcelbillno'])) 
    {
        echo json_encode(['billno' => $_SESSION['parcelbillno'],'BillEdit'=>$_SESSION['parcelbillEdit'],'Table'=>$_SESSION['ParcelTable'] ]);
    } else {
        echo json_encode([]);
    }
}


?>