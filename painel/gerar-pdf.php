<?php 
    ob_start();
    include('templateFinanceiro.php');
    $conteudo = ob_get_contents();
    ob_end_clean();

    require('../vendor/autoload.php');
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($conteudo);
    $mpdf->Output();
?>