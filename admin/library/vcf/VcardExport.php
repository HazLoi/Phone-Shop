<?php

use JeroenDesloovere\VCard\VCard;

class VcardExport
{
    public function contactVcardExportService($contactResult)
    {
        require_once 'vendor/Behat-Transliterator/Transliterator.php';
        require_once 'vendor/jeroendesloovere-vcard/VCard.php';
        // define vcard
        $vcardObj = new VCard();

        $vcardObj->addName(ucfirst($contactResult["name"]));
        $vcardObj->addEmail(ucfirst($contactResult["email"]));
        $vcardObj->addPhoneNumber($contactResult["phone"]);
        // $vcardObj->addAddress(ucfirst($contactResult["address"]));
       
        return $vcardObj->download();
    }
}

$VcardExport = new VcardExport();
