<?php
    namespace BPOINT {
        class CardDetails {
            private $cardHolderName;
            private $cardNumber;
            private $cvn;
            private $expiryDate;
            private $maskedCardNumber;
            private $category;
            private $issuer;
            private $issuerCountryCode;
            private $localisation;
            private $subType;

            public function getCardHolderName() {
                return $this->cardHolderName;
            }

            public function getExpiryDate() {
                return $this->expiryDate;
            }
            
            public function getMaskedCardNumber() {
                return $this->maskedCardNumber;
            }
            
            public function getCategory() {
                return $this->category;
            }

            public function getIssuer() {
                return $this->issuer;
            }

            public function getIssuerCountryCode(){
                return $this->issuerCountryCode;
            }

            public function getLocalisation() {
                return $this->localisation;
            }

            public function getSubType() {
                return $this->subType;
            }

            public function setCardHolderName($name) {
                $this->cardHolderName = $name;
                return $this;
            }
            
            public function setCardNumber($cc) {
                $this->cardNumber = $cc;
                return $this;
            }
            
            public function setCVN($cvn) {
                $this->cvn = $cvn;
                return $this;
            }
            
            public function setExpiryDate($expiryDate) {
                $this->expiryDate = $expiryDate;
                return $this;
            }

            public function setMaskedCardNumber($cc) {
                $this->maskedCardNumber = $cc;
                return $this;
            }

            public function getArrayRepresentation() {
                $detail = array();
                
                $detail["CardHolderName"] = $this->cardHolderName;
                $detail["CardNumber"] = $this->cardNumber;
                $detail["Cvn"] = $this->cvn;
                $detail["ExpiryDate"] = $this->expiryDate;
                
                return $detail;
            }
            
            public function __construct($rep = NULL, $expiryDate = NULL, $cvn = NULL, $cardHolderName = NULL) {
                if ($rep != NULL && $expiryDate == NULL) {
                    $this->cardHolderName = $rep->CardHolderName;
                    $this->expiryDate = $rep->ExpiryDate;
                    $this->maskedCardNumber = $rep->MaskedCardNumber;
                    if(isset($rep->Category)){
                        $this->category = $rep->Category;
                    }
                    if(isset($rep->Issuer)){
                        $this->issuer = $rep->Issuer;
                    }
                    if(isset($rep->IssuerCountryCode)){
                        $this->issuerCountryCode = $rep->IssuerCountryCode;
                    }
                    if(isset($rep->Localisation)){
                        $this->localisation = $rep->Localisation;
                    }
                    if(isset($rep->SubType)){
                        $this->subType = $rep->SubType;
                    }
                } else if ($rep != NULL && $expiryDate != NULL) {
                    $this->cardNumber = $rep;
                    $this->expiryDate = $expiryDate;
                    $this->cvn = $cvn;
                    $this->cardHolderName = $cardHolderName;
                }
            }
        }
        
        class AuthKeyCardDetails {
            private $cardHolderName;
            private $expiryDateMonth;
            private $expiryDateYear;
            
            public function setCardHolderName($name) {
                $this->cardHolderName = $name;
            }
            
            public function setExpiryDateMonth($expiryDateMonth) {
                $this->expiryDateMonth = $expiryDateMonth;
            }
            
            public function setExpiryDateYear($expiryDateYear) {
                $this->expiryDateYear = $expiryDateYear;
            }
            
            public function getArrayRepresentation() {
                $detail = array();
                
                $detail["CardHolderName"] = $this->cardHolderName;
                $detail["ExpiryDateMonth"] = $this->expiryDateMonth;
                $detail["ExpiryDateYear"] = $this->expiryDateYear;
                
                return $detail;
            }
        }
        
        class BankAccountDetails {
            private $accountName;
            private $accountNumber;
            private $bsbNumber;
            private $truncatedAccountNumber;
            
            public function __construct($responseArray) {
                if (isset($responseArray->AccountName)) {
                    $this->accountName = $responseArray->AccountName;
                }
                if (isset($responseArray->BSBNumber)) {
                    $this->bsbNumber = $responseArray->BSBNumber;
                }
                if (isset($responseArray->TruncatedAccountNumber)) {
                    $this->truncatedAccountNumber = $responseArray->TruncatedAccountNumber;
                }
                if (isset($responseArray->AccountNumber)) {
                    $this->accountNumber = $responseArray->AccountNumber;
                }
            }
    
            public function getAccountName() {
                return $this->accountName;
            }
            
            public function setAccountName($accountName) {
                $this->accountName = $accountName;
                return $this;
            }
            
            public function getAccountNumber() {
                return $this->accountNumber;
            }
            
            public function setAccountNumber($accountNumber) {
                $this->accountNumber = $accountNumber;
                return $this;
            }
            
            public function getBsbNumber() {
                return $this->bsbNumber;
            }
            
            public function setBsbNumber($bsbNumber) {
                $this->bsbNumber = $bsbNumber;
                return $this;
            }
            
            public function getTruncatedAccountNumber() {
                return $this->truncatedAccountNumber;
            }
            
            public function setTruncatedAccountNumber($truncatedAccountNumber) {
                $this->truncatedAccountNumber = $truncatedAccountNumber;
                return $this;
            }
            
            public function getArrayRepresentation() {
                $detail = array();
                
                $detail["AccountName"] = $this->accountName;
                $detail["AccountNumber"] = $this->accountNumber;
                $detail["BSBNumber"] = $this->bsbNumber;
                
                return $detail;
            }
            
        }
        
        class DVTokenData {
            private $token;
            private $expiryDate;
            private $updateDVTokenExpiryDate;
            
            public function getDVToken() {
                return $this->token;
            }
            
            public function setDVToken($token) {
                $this->token = $token;
                return $this;
            }
            
            public function getExpiryDate() {
                return $this->expiryDate;
            }
            
            public function setExpiryDate($expiryDate) {
                $this->expiryDate = $expiryDate;
                return $this;
            }
            
            public function getUpdateDVTokenExpiryDate() {
                return $this->updateDVTokenExpiryDate;
            }
            
            public function setUpdateDVTokenExpiryDate($updateDVTokenExpiryDate) {
                $this->updateDVTokenExpiryDate = $updateDVTokenExpiryDate;
                return $this;
            }
            
            public function getPayload() {
                $detail = array();
                
                $detail["DVToken"] = $this->token;
                $detail["ExpiryDate"] = $this->expiryDate;
                $detail["UpdateDVTokenExpiryDate"] = $this->updateDVTokenExpiryDate;
                
                return $detail;
            }
        }

        class StatementDescriptor {
            private $addressLine1;
            private $addressLine2;
            private $city;
            private $companyName;
            private $countryCode;
            private $merchantName;
            private $phoneNumber;
            private $postCode;
            private $state;

            public function getAddressLine1(){
                return $this->addressLine1;
            }

            public function getAddressLine2(){
                return $this->addressLine2;
            }

            public function getCity(){
                return $this->city;
            }

            public function getCompanyName(){
                return $this->companyName;
            }

            public function getCountryCode() {
                return $this->countryCode;
            }

            public function getMerchantName(){
                return $this->merchantName;
            }

            public function getPhoneNumber(){
                return $this->phoneNumber;
            }

            public function getPostCode(){
                return $this->postCode;
            }

            public function getState(){
                return $this->state;
            }

            public function setAddressLine1($addressLine1){
                $this->addressLine1 = $addressLine1;
                return $this;
            }

            public function setAddressLine2($addressLine2){
                $this->addressLine2 = $addressLine2;
                return $this;
            }

            public function setCity($city){
                $this->city = $city;
                return $this;
            }

            public function setCompanyName($companyName){
                $this->companyName = $companyName;
                return $this;
            }

            public function setCountryCode($countryCode){
                $this->countryCode = $countryCode;
                return $this;
            }

            public function setMerchantName($merchantName){
                $this->merchantName = $merchantName;
                return $this;
            }

            public function setPhoneNumber($phoneNumber){
                $this->phoneNumber = $phoneNumber;
                return $this;
            }

            public function setPostCode($postCode){
                $this->postCode = $postCode;
                return $this;
            }

            public function setState($state){
                $this->state = $state;
                return $this;
            }

            public function __construct($responseArray = NULL){
                if(isset($responseArray)){
                    if (isset($responseArray->AddressLine1)) {
                        $this->addressLine1 = $responseArray->AddressLine1;
                    }
                    if (isset($responseArray->AddressLine2)){
                        $this->addressLine2 = $responseArray->AddressLine2;
                    }
                    if (isset($responseArray->City)){
                        $this->city = $responseArray->City;
                    }
                    if (isset($responseArray->CompanyName)){
                        $this->companyName = $responseArray->CompanyName;
                    }    
                    if (isset($responseArray->CountryCode)){
                        $this->countryCode = $responseArray->CountryCode;
                    }    
                    if(isset($responseArray->MerchantName)){
                        $this->merchantName = $responseArray->MerchantName;
                    }    
                    if(isset($responseArray->PhoneNumber)){
                        $this->phoneNumber = $responseArray->PhoneNumber;
                    }    
                    if(isset($responseArray->PostCode)){
                        $this->postCode = $responseArray->PostCode;
                    }
                    if(isset($responseArray->State)){
                        $this->state = $responseArray->State;
                    }
                }
            }

            public function getPayload() {
                $detail = array();

                $detail["AddressLine1"] = $this->addressLine1;
                $detail["AddressLine2"] = $this->addressLine2;
                $detail["City"] = $this->city;
                $detail["CompanyName"] = $this->companyName;
                $detail["CountryCode"] = $this->countryCode;
                $detail["MerchantName"] = $this->merchantName;
                $detail["PhoneNumber"] = $this->phoneNumber;
                $detail["PostCode"] = $this->postCode;
                $detail["State"] = $this->state;

                return $detail;
            }
        }
   
        class PaymentRequestDetails {
            private $acceptablePaymentType;
            private $action;
            private $amount;
            private $amountOutstanding;
            private $amountPaid;
            private $createdDateTime;
            private $currency;
            private $dueDate;
            private $emailSenderName;
            private $expiryDate;
            private $guid;
            private $merchantReference;
            private $messagingMode;
            private $billerCode;
            private $paymentRequestUrl;
            private $crn1;
            private $crn2;
            private $crn3;
            private $status;
            private $dvtoken;
            
            public function __construct($elements) {
                
                $this->acceptablePaymentType = $elements->AcceptablePaymentType;
                $this->action = $elements->Action;
                $this->amount = $elements->Amount;
                $this->amountOutstanding = $elements->AmountOutstanding;
                $this->amountPaid = $elements->AmountPaid;
                $this->createdDateTime = $elements->CreatedDateTime;
                $this->currency = $elements->Currency;
                $this->dueDate = $elements->DueDate;
                $this->emailSenderName = $elements->EmailSenderName;
                $this->expiryDate = $elements->ExpiryDate;
                $this->guid = $elements->Guid;
                $this->merchantReference = $elements->MerchantReference;
                $this->messagingMode = $elements->MessagingMode;
                $this->billerCode = $elements->BillerCode;
                $this->paymentRequestUrl = $elements->PaymentRequestUrl;
                $this->crn1 = $elements->Crn1;
                $this->crn2 = $elements->Crn2;
                $this->crn3 = $elements->Crn3;
                $this->status = $elements->Status;
                $this->dvtoken = $elements->DVToken;
                
            }
            
            public function getAcceptablePaymentType(){
                return $this->acceptablePaymentType;
            }
            
            public function getAction(){
                return $this->action;
            }
            
            public function getAmount(){
                return $this->amount;
            }
            
            public function getAmountOutstanding(){
                return $this->amountOutstanding;
            }
            
            public function getAmountPaid(){
                return $this->amountPaid;
            }
            
            public function getCreatedDateTime(){
                return $this->createdDateTime;
            }
            
            public function getCurrency(){
                return $this->currency;
            }
            
            public function getDueDate(){
                return $this->dueDate;
            }
            
            public function getEmailSenderName(){
                return $this->emailSenderName;
            }
            
            public function getExpiryDate(){
                return $this->expiryDate;
            }
            
            public function getGuid(){
                return $this->guid;
            }
            
            public function getInternalNote(){
                return $this->merchantReference;
            }
            
            public function getMessagingMode(){
                return $this->messagingMode;
            }
            
            public function getPaymentReason(){
                return $this->billerCode;
            }
            
            public function getPaymentRequestUrl(){
                return $this->paymentRequestUrl;
            }
            
            public function getcrn1(){
                return $this->crn1;
            }
            
            public function getcrn2(){
                return $this->crn2;
            }
            
            public function getcrn3(){
                return $this->crn3;
            }
            
            public function getStatus(){
                return $this->status;
            }
            
            public function getdvtoken(){
                return $this->dvtoken;
            }
            
            
        }
    
    }
?>
