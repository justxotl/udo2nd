<?php

if ($peticionAjax) {
    require_once "../models/pdfModel.php";
} else {
    require_once "../models/pdfModel.php";
}

class pdfControl extends pdfModel{

	public static function mostrarPdfControl($id){        
        $id= $id;
        return pdfModel::mostrarPdfModelo($id);
    }

}