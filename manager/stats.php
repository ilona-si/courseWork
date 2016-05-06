<?php
    require_once('../lib/connection.php');
    require_once('../lib/Items.php');
    require_once 'PHPExcel/Classes/PHPExcel.php';
    require_once 'PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
    header ( "Content-type: application/vnd.ms-excel" );
    header ( "Content-Disposition: attachment; filename=statistic.xls" );

    Items::getExcelStatics();
