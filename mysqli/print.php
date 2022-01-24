<?php
    require('function.php');
    require_once('pdf/tcpdf/tcpdf.php');
    $tables = read("SELECT * FROM one ORDER BY nama");

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Data siswa');

    $pdf->setPrintHeader(false);
    $pdf->SetAutoPageBreak(TRUE, 0);
    $pdf->SetMargins(5, 0, 8);

    $pdf->AddPage();

    $html = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title class="hide">home</title>
            
                <style>
                    *{
                        box-sizing: border-box;
                    }
                    body{
                        font-family: sans-serif;
                    }
                    th{
                        background-color: #333333;
                        color: #fff;
                        text-align: center;
                    }
                    img{
                        width: 35px;
                        height: 35px;
                    }
                    h1{
                        text-align: center;
                    }
                </style>
            </head>
            <body>
            
                <h1>Data siswa</h1>
                <table border="1" cellspacing="0" cellpadding="5">
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 10%;">Kelas</th>
                        <th style="width: 12%;">Jurusan</th>
                        <th style="width: 25%;">Nama</th>
                        <th style="width: 30%;">Email</th>
                        <th>Foto</th>
                    </tr>';
                    
                $id = 1;
                foreach( $tables as $table ) {
                $html .='
                    <tr class="bg">
                        <td> '.$id.' </td>
                        <td> '.$table["kls"].' </td>
                        <td> '.$table["jurusan"].' </td>
                        <td> '.$table["nama"].' </td>
                        <td> '.$table["email"].' </td>
                        <td> <img src="img/'.$table["foto"].'" style="margin: auto auto;"> </td>
                    </tr>';
                    $id++;
                }
                $html .= '
                </table>
            </body>
            </html>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('dataSiswa.pdf', 'I');
?>