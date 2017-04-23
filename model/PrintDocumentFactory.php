<?php

require_once ('model/PrintDocument.php');

class PrintDocumentFactory {

    private static $documents = array();

    public static function build($contract, $status) {

        if(!array_key_exists($contract, self::$documents)) {
            $document = new PrintDocument($contract, $status);
            self::$documents[$contract] = $document;
        }

        return self::$documents[$contract]->getData();

    }

}