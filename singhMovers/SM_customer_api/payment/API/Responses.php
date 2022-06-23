<?php
    namespace BPOINT {
        include_once("BPOINT.php");
        abstract class Response {
            private $apiResponse;
            
            public function getAPIResponse() {
                return $this->apiResponse;
            }
            
            public function __construct($apiResponse) {
                $this->apiResponse = $apiResponse;
            }
        }
        
        class APIResponse {
            private $responseCode;
            private $responseText;
            
            public function __construct($responseCode, $responseText) {
                $this->responseCode = $responseCode;
                $this->responseText = $responseText;	
            }
            
            public function getResponseCode() {
                return $this->responseCode;
            }
            
            public function getResponseText() {
                return $this->responseText;
            }
            
            public function isSuccessful() {
                return !! ($this->responseCode == 0);
            }
            
            public static function fromFullResponse($response) {
                $responseCode = $response->APIResponse->ResponseCode;
                $responseText = $response->APIResponse->ResponseText;
                $apiResponse = new APIResponse($responseCode, $responseText);
                
                return $apiResponse;
            }
        }
        
        class CVNResult {
            private $cvnResultCode;
            
            public function __construct($cvnResult) {
                if (NULL == $cvnResult) {
                    $this->cvnResultCode = "Unsupported";
                } else {
                    $this->cvnResultCode = $cvnResult->CVNResultCode;
                }
            }
            
            public function getCVNResultCode() {
                return $this->cvnResultCode;
            }
        }
        
        class TokenResponse extends Response {
            private $cardDetails = NULL;
            private $bankAccountDetails = NULL;
            private $cardType = NULL;
            private $crn1 = NULL;
            private $crn2 = NULL;
            private $crn3 = NULL;
            private $emailAddress = NULL;
            private $token = NULL;
            
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                
                parent::__construct($apiResponse);
                
                if ($apiResponse->getResponseCode() == "0") {
                    $elements = $responseArray->DVTokenResp;
                    
                    if (isset($elements->CardDetails)) {
                        $this->cardDetails = new CardDetails($elements->CardDetails);
                    }
                    if (isset($elements->BankAccountDetails)) {
                        $this->bankAccountDetails = new BankAccountDetails($elements->BankAccountDetails);
                    }
                    
                    $this->cardType = $elements->CardType;
                    $this->emailAddress = $elements->EmailAddress;
                    $this->crn1 = $elements->Crn1;
                    $this->crn2 = $elements->Crn2;
                    $this->crn3 = $elements->Crn3;
                    $this->token = $elements->DVToken;
                }
            }
            
            public function getCardDetails() {
                return $this->cardDetails;
            }
            public function getBankAccountDetails() {
                return $this->bankAccountDetails;
            }
            public function getCardType() {
                return $this->cardType;
            }
            public function getCrn1() {
                return $this->crn1;
            }
            public function getCrn2() {
                return $this->crn2;
            }
            public function getCrn3() {
                return $this->crn3;
            }
            public function getEmailAddress() {
                return $this->emailAddress;
            }
            public function getToken() {
                return $this->token;
            }
        }
            
        class TokenSearchResponse extends Response {
            private $dvtokens;
            private $tokenIndex;
                
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
            
                parent::__construct($apiResponse);
            
                $this->dvtokens = array();
            
                if ($apiResponse->getResponseCode() == "0") {
                    $tokenList = $responseArray->DVTokenRespList;
            
                    foreach ($tokenList as $token) {
                        $tokenPayload = (object) array();
                        $tokenPayload->APIResponse = $apiPayload;
                        $tokenPayload->DVTokenResp = $token;
            
                        $this->dvtokens[] = new TokenResponse($tokenPayload);
                    }
                }
            }
            
            public function getResultCount() {
                return count($this->dvtokens);
            }
                
            public function getTokens() {
                return $this->dvtokens;
            }
                
            public function nextToken() {
                $returnValue = NULL;
                if (count($this->dvtokens) > $this->tokenIndex) {
                    $returnValue = $this->dvtokens[$this->tokenIndex];
                    $this->tokenIndex += 1;
                }
            
                return $returnValue;
            }
                
            public function reset() {
                $this->tokenIndex = 0;
            }
        }
        
        class TransactionResponse extends Response {
            private $action;
            private $amount;
            private $amountOriginal;
            private $amountSurcharge;
            private $threeDSResponse;
            private $authoriseId;
            private $bankAccountDetails;
            private $bankResponseCode;
            private $cvnResult;
            private $cardDetails;
            private $cardType;
            private $currency;
            private $isThreeDS;
            private $isCVNPresent;
            private $merchantNumber;
            private $originalTxnNumber;
            private $processedDateTime;
            private $rrn;
            private $receiptNumber;
            private $crn1;
            private $crn2;
            private $crn3;
            private $responseCode;
            private $responseText;
            private $billerCode;
            private $settlementDate;
            private $source;
            private $storeCard;
            private $subType;
            private $txnNumber;
            private $type;
            private $isTestTxn;
            private $merchantReference;
            private $emailAddress;
            private $dvtoken;
            private $fraudScreeningResponse;
            private $statementDescriptor;

            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                
                parent::__construct($apiResponse);
                if ($apiResponse->getResponseCode() == "0") {
                    
                    $elements = $responseArray->TxnResp;
    
                    $this->action = $elements->Action;
                    $this->amount = $elements->Amount;
                    $this->amountOriginal = $elements->AmountOriginal;
                    $this->amountSurcharge = $elements->AmountSurcharge;
                    
                    if (isset($elements->ThreeDSResponse)) {
                        $this->threeDSResponse = new ThreeDSResponse($elements->ThreeDSResponse);
                    }
                    
                    $this->authoriseId = $elements->AuthoriseId;
                    
                    if (isset($elements->BankAccountDetails)) {
                        $this->bankAccountDetails = new BankAccountDetails($elements->BankAccountDetails);
                    }
                    
                    $this->bankResponseCode = $elements->BankResponseCode;
                    $this->cvnResult = new CVNResult($elements->CVNResult);
                    $this->merchantReference = $elements->MerchantReference;
                    
                    if (isset($elements->CardDetails)) {
                        $this->cardDetails = new CardDetails($elements->CardDetails);
                    }
                    
                    $this->cardType = $elements->CardType;
                    $this->currency = $elements->Currency;
                    $this->isThreeDS = $elements->IsThreeDS;
                    $this->isCVNPresent = $elements->IsCVNPresent;
                    $this->merchantNumber = $elements->MerchantNumber;
                    $this->originalTxnNumber = $elements->OriginalTxnNumber;
                    $this->processedDateTime = $elements->ProcessedDateTime;
                    $this->rrn = $elements->RRN;
                    $this->receiptNumber = $elements->ReceiptNumber;
                    $this->crn1 = $elements->Crn1;
                    $this->crn2 = $elements->Crn2;
                    $this->crn3 = $elements->Crn3;
                    $this->responseCode = $elements->ResponseCode;
                    $this->responseText = $elements->ResponseText;
                    $this->billerCode = $elements->BillerCode;
                    $this->settlementDate = $elements->SettlementDate;
                    $this->source = $elements->Source;
                    $this->subType = $elements->SubType;
                    $this->storeCard = $elements->StoreCard;
                    $this->txnNumber = $elements->TxnNumber;
                    $this->dvtoken = $elements->DVToken;
                    $this->type = $elements->Type;
                    $this->isTestTxn = $elements->IsTestTxn;
                    if (isset($elements->FraudScreeningResponse)) {
                        $this->fraudScreeningResponse = new FraudScreeningResponse($elements->FraudScreeningResponse);
                    }
                    if (isset($elements->StatementDescriptor)) {
                        $this->statementDescriptor = new StatementDescriptor($elements->StatementDescriptor);
                    }
                    if (isset($elements->DVToken)) {
                        $this->dvtoken = $elements->DVToken;
                    }
                    
                    if (isset($elements->EmailAddress)) {
                        $this->emailAddress = $elements->EmailAddress;
                    }
                }
                
            }
            
            public function isApproved() {
                $resp = $this->responseCode;
                $retVal = NULL;
                
                if ($resp == "0" || $resp == "00" || $resp == "08" || $resp == "16") {
                    $retVal = TRUE;	
                } else {
                    $retVal = FALSE;
                }
                
                return $retVal;
            }
            
            public function getAction() {
                return $this->action;
            }
            
            public function getAmount() {
                return $this->amount;
            }
            
            public function getAmountOriginal() {
                return $this->amountOriginal;
            }
            
            public function getAmountSurcharge() {
                return $this->amountSurcharge;
            }
            
            public function getThreeDSResponse() {
                return $this->threeDSResponse;
            }
            
            public function getAuthoriseId() {
                return $this->authoriseId;
            }
            
            public function getBankAccountDetails() {
                return $this->bankAccountDetails;
            }
            
            public function getCVNResult() {
                return $this->cvnResult;
            }
            
            public function getCardDetails() {
                return $this->cardDetails;
            } 
            
            public function getCardType() {
                return $this->cardType;
            }
            
            public function getCurrency() {
                return $this->currency;
            }
    
            public function getIs3DS() {
                return $this->isThreeDS;
            }
            
            public function getIsCVNPresent() {
                return $this->isCVNPresent;
            }
            
            public function getMerchantReference(){
                return $this->merchantReference;
            }
            
            public function getMerchantNumber() {
                return $this->merchantNumber;
            }
            
            public function getOriginalTxnNumber() {
                return $this->originalTxnNumber;
            }
            
            public function getProcessedDateTime() {
                return $this->processedDateTime;
            }
            
            public function getRRN() {
                return $this->rrn;
            }
            
            public function getReceiptNumber() {
                return $this->receiptNumber;
            }
            
            public function getCrn1() {
                return $this->crn1;
            }
            
            public function getCrn2() {
                return $this->crn2;
            }
            
            public function getCrn3() {
                return $this->crn3;
            }
            
            public function getBankResponseCode(){
                return $this->bankResponseCode;
            }
            
            public function getResponseCode() {
                return $this->responseCode;
            }
            
            public function getResponseText() {
                return $this->responseText;
            }
            
            public function getBillerCode() {
                return $this->billerCode;
            }
                
            public function getSettlementDate() {
                return $this->settlementDate;
            }
            
            public function getSource() {
                return $this->source;
            }
            
            public function getStoreCard() {
                return $this->storeCard;
            }
        
            public function getSubType() {
                return $this->subType;
            }
            
            public function getTxnNumber() {
                return $this->txnNumber;
            }
            
            public function getToken() {
                return $this->dvtoken;
            }
            
            public function getType() {
                return $this->type;
            }
            
            public function getFraudScreeningResponse() {
                return $this->fraudScreeningResponse;
            }
            
            public function getStatementDescriptor() {
                return $this->statementDescriptor;
            }
            
            public function getEmailAddress() {
                return $this->emailAddress;
            }
        }
        
        class AuthKeyTransactionResponse extends AuthKeyResponse {
            public function __construct($responseArray) {
                parent::__construct($responseArray);
            }
        }
    
        class AuthKeyResponse extends Response {
            private $authKey = NULL;
            
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                
                parent::__construct($apiResponse);
                
                if ($apiResponse->getResponseCode() == "0") {
                    $this->authKey = $responseArray->AuthKey;
                }
            }
            
            public function getAuthKey() {
                return $this->authKey;
            }
        }
        
        class ResultKeyResponse extends Response {
            private $resultKey = NULL;
            private $redirectionUrl = NULL;
            
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                
                parent::__construct($apiResponse);
                
                if ($apiResponse->getResponseCode() == "0") {
                    $this->resultKey = $responseArray->ResultKey;
                    $this->redirectionUrl = $responseArray->RedirectionUrl;
                }
            }
            
            public function getResultKey() {
                return $this->resultKey;
            }
            
            public function getRedirectionUrl() {
                return $this->redirectionUrl;
            }
            
        }
        
        class TransactionSearchResponse extends Response {
            private $transactions;
            private $transactionIndex;
            
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                
                parent::__construct($apiResponse);
                
                $this->transactions = array();
                
                if ($apiResponse->getResponseCode() == "0") {
                    $transactionList = $responseArray->TxnRespList;
                
                    foreach ($transactionList as $transaction) {
                        $transactionPayload = (object) array();
                        $transactionPayload->APIResponse = $apiPayload;
                        $transactionPayload->TxnResp = $transaction;
                        
                        $this->transactions[] = new TransactionResponse($transactionPayload);
                    }
                }
            }
            
            public function getResultCount() {
                return count($this->transactions);
            }
            
            public function getTransactions() {
                return $this->transactions;
            }
            
            public function nextTransaction() {
                $returnValue = NULL;
                if (count($this->transactions) > $this->transactionIndex) {
                    $returnValue = $this->transactions[$this->transactionIndex];
                    $this->transactionIndex += 1;
                }
                
                return $returnValue;
            }
            
            public function reset() {
                $this->transactionIndex = 0;
            }
        }

        class CreateSecureCallAuthKeyResponse extends Response {
            private $authKey;

            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                parent::__construct($apiResponse);
                
                $this->authKey = $responseArray->AuthKey;
            }

            public function getAuthKey(){
                return $this->authKey;
            }
        }

        class InitiateSecureCallResponse extends Response {
            private $accessCode;
            private $accessCodePopupMessage;
            private $disableClampingButtonLabel;
            private $disableClampingPopupMessage;
            private $hangupButtonLabel;
            private $hideAccessCodePopup;
            private $hideDisableClampingButton;
            private $hideHangupButton;

            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                parent::__construct($apiResponse);
                
                $this->accessCode = $responseArray->AccessCode;
                $this->accessCodePopupMessage = $responseArray->AccessCodePopupMessage;
                $this->disableClampingButtonLabel = $responseArray->DisableClampingButtonLabel;
                $this->disableClampingPopupMessage = $responseArray->DisableClampingPopupMessage;
                $this->hangupButtonLabel = $responseArray->HangupButtonLabel;
                $this->hideAccessCodePopup = $responseArray->HideAccessCodePopup;
                $this->hideDisableClampingButton = $responseArray->HideDisableClampingButton;
                $this->hideHangupButton = $responseArray->HideHangupButton;
            }

            public function getAccessCode(){
                return $this->accessCode;
            }

            public function getAccessCodePopupMessage(){
                return $this->accessCodePopupMessage;
            }
            
            public function getDisableClampingButtonLabel(){
                return $this->disableClampingButtonLabel;
            }
            
            public function getDisableClampingPopupMessage(){
                return $this->disableClampingPopupMessage;
            }
            
            public function getHangupButtonLabel(){
                return $this->hangupButtonLabel;
            }
            
            public function getHideAccessCodePopup(){
                return $this->hideAccessCodePopup;
            }
            
            public function getHideDisableClampingButton(){
                return $this->hideDisableClampingButton;
            }
            
            public function getHideHangupButton(){
                return $this->hideHangupButton;
            }

        }

        class InitiateSecureCallActionResponse extends Response {
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                parent::__construct($apiResponse);
            }
        }

        class GetSecureCallDetailsResponse extends Response {
            private $secureCallDetails;
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                parent::__construct($apiResponse);

                $this->secureCallDetails = new SecureCallDetails($responseArray->SecureCallDetails);
            }

            public function getSecureCallDetails(){
                return $this->secureCallDetails;
            }
        }

        class ProcessSecureCallTxnResponse extends Response {
            private $transactionResponse;

            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                parent::__construct($apiResponse);

                $transactionPayload = (object) array();
                $transactionPayload->APIResponse = $responseArray->APIResponse;
                $transactionPayload->TxnResp = $responseArray->TxnResp;
                
                $this->transactionResponse = new TransactionResponse($transactionPayload);
            }

            public function getTransactionResponse(){
                return $this->transactionResponse;
            }
        }

        class AddSecureCallTokenResponse extends Response {
            private $tokenResponse;
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                parent::__construct($apiResponse);

                $this->tokenResponse = new TokenResponse($responseArray);
            }

            public function getTokenResponse()
            {
                return $this->tokenResponse;
            }
        }

        class UpdateSecureCallTokenResponse extends Response {
            private $tokenResponse;
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                parent::__construct($apiResponse);

                $this->tokenResponse = new TokenResponse($responseArray);
            }

            public function getTokenResponse()
            {
                return $this->tokenResponse;
            }
        }

        class FraudScreeningResponse{
                
            private $txnRejected;
            private $responseCode;
            private $responseMessage;
            private $reDResponse;
        
            public function __construct($responseArray) {
                if (isset($responseArray->TxnRejected)) {
                    $this->txnRejected = $responseArray->TxnRejected;
                }
                if (isset($responseArray->ResponseCode)) {
                    $this->responseCode = $responseArray->ResponseCode;
                }
                if (isset($responseArray->ResponseMessage)) {
                    $this->responseMessage = $responseArray->ResponseMessage;
                }
                if (isset($responseArray->ReDResponse)) {
                    $this->reDResponse = new ReDResponse($responseArray->ReDResponse);
                }
            }
                
            public function getTxnRejected(){
                return $this->txnRejected;
            }
            public function setTxnRejected($txnRejected){
                $this->txnRejected = $txnRejected;
                return $this;
            }
                
            public function getResponseCode(){
                return $this->responseCode;
            }
            public function setResponseCode($responseCode){
                $this->responseCode = $responseCode;
                return $this;
            }
                
            public function getResponseMessage(){
                return $this->responseMessage;
            }
            public function setResponseMessage($responseMessage){
                $this->responseMessage = $responseMessage;
                return $this;
            }
                
            public function getReDResponse(){
                return $this->reDResponse;
            }
            public function setReDResponse($reDResponse){
                $this->reDResponse = $reDResponse;
                return $this;
            }
        }
        
        class ReDResponse{
            private $req_id;
            private $ord_id;
            private $stat_cd;
            private $fraud_stat_cd;
            private $fraud_rsp_cd;
            private $fraud_rec_id;
            private $fraud_neural;
            private $fraud_rcf;
                
            public function __construct($responseArray) {
                if (isset($responseArray->REQ_ID)) {
                    $this->req_id = $responseArray->REQ_ID;
                }
                if (isset($responseArray->ORD_ID)) {
                    $this->ord_id = $responseArray->ORD_ID;
                }
                if (isset($responseArray->STAT_CD)) {
                    $this->stat_cd = $responseArray->STAT_CD;
                }
                if (isset($responseArray->FRAUD_STAT_CD)) {
                    $this->fraud_stat_cd = $responseArray->FRAUD_STAT_CD;
                }
                if (isset($responseArray->FRAUD_RSP_CD)) {
                    $this->fraud_rsp_cd = $responseArray->FRAUD_RSP_CD;
                }
                if (isset($responseArray->FRAUD_REC_ID)) {
                    $this->fraud_rec_id = $responseArray->FRAUD_REC_ID;
                }
                if (isset($responseArray->FRAUD_NEURAL)) {
                    $this->fraud_neural = $responseArray->FRAUD_NEURAL;
                }
                if (isset($responseArray->FRAUD_RCF)) {
                    $this->fraud_rcf = $responseArray->FRAUD_RCF;
                }
            }
            public function getREQ_ID(){
                return $this->req_id;
            }
            public function setREQ_ID($req_id){
                $this->req_id = $req_id;
                return $this;
            }
                
            public function getORD_ID(){
                return $this->ord_id;
            }
            public function setORD_ID($ord_id){
                $this->ord_id = $ord_id;
                return $this;
            }
                
            public function getSTAT_CD(){
                return $this->stat_cd;
            }
            public function setSTAT_CD($stat_cd){
                $this->stat_cd = $stat_cd;
                return $this;
            }
                
            public function getFRAUD_STAT_CD(){
                return $this->fraud_stat_cd;
            }
            public function setFRAUD_STAT_CD($fraud_stat_cd){
                $this->fraud_stat_cd = $fraud_stat_cd;
                return $this;
            }
                
            public function getFRAUD_RSP_CD(){
                return $this->fraud_rsp_cd;
            }
            public function setFRAUD_RSP_CD($fraud_rsp_cd){
                $this->fraud_rsp_cd = $fraud_rsp_cd;
                return $this;
            }
                
            public function getFRAUD_REC_ID(){
                return $this->fraud_rec_id;
            }
            public function setFRAUD_REC_ID($fraud_rec_id){
                $this->fraud_rec_id = $fraud_rec_id;
                return $this;
            }
                
            public function getFRAUD_NEURAL(){
                return $this->fraud_neural;
            }
            public function setFRAUD_NEURAL($fraud_neural){
                $this->fraud_neural = $fraud_neural;
                return $this;
            }
                
            public function getFRAUD_RCF(){
                return $this->fraud_rcf;
            }
            public function setFRAUD_RCF($fraud_rcf){
                $this->fraud_rcf = $fraud_rcf;
                return $this;
            }
        }
        
        class ThreeDSResponse{
            private $eci;
            private $enrolled;
            private $status;
            private $verifySecurityLevel;
            private $verifyStatus;
            private $verifyToken;
            private $verifyType;
            private $XId;
            
            public function __construct($responseArray) {
                if (isset($responseArray->Eci)) {
                    $this->eci = $responseArray->Eci;
                }
                if (isset($responseArray->Enrolled)) {
                    $this->enrolled = $responseArray->Enrolled;
                }
                if (isset($responseArray->Status)) {
                    $this->status = $responseArray->Status;
                }
                if (isset($responseArray->VerifySecurityLevel)) {
                    $this->verifySecurityLevel = $responseArray->VerifySecurityLevel;
                }
                if (isset($responseArray->VerifyStatus)) {
                    $this->verifyStatus = $responseArray->VerifyStatus;
                }
                if (isset($responseArray->VerifyToken)) {
                    $this->verifyToken = $responseArray->VerifyToken;
                }
                if (isset($responseArray->VerifyType)) {
                    $this->verifyType = $responseArray->VerifyType;
                }
                if (isset($responseArray->XId)) {
                    $this->XId = $responseArray->XId;
                }
            }
                
            public function getEci(){
                return $this->eci;
            }
            public function setEci($eci){
                $this->eci = $eci;
                return $this;
            }
            
            public function getEnrolled(){
                return $this->enrolled;
            }
            public function setEnrolled($enrolled){
                $this->enrolled = $enrolled;
                return $this;
            }
            
            public function getStatus(){
                return $this->status;
            }
            public function setStatus($status){
                $this->status = $status;
                return $this;
            }
            
            public function getVerifySecurityLevel(){
                return $this->verifySecurityLevel;
            }
            public function setVerifySecurityLevel($verifySecurityLevel){
                $this->verifySecurityLevel = $verifySecurityLevel;
                return $this;
            }
            
            public function getVerifyStatus(){
                return $this->verifyStatus;
            }
            public function setVerifyStatus($verifyStatus){
                $this->verifyStatus = $verifyStatus;
                return $this;
            }
            
            public function getVerifyToken(){
                return $this->verifyToken;
            }
            public function setVerifyToken($verifyToken){
                $this->verifyToken = $verifyToken;
                return $this;
            }
            
            public function getVerifyType(){
                return $this->verifyType;
            }
            public function setVerifyType($verifyType){
                $this->verifyType = $verifyType;
                return $this;
            }
            
            public function getXId(){
                return $this->XId;
            }
            public function setXId($XId){
                $this->XId = $XId;
                return $this;
            }
        }

        class SecureCallDetails{
            private $agentPhoneNumber;
            private $callStatus;
            private $dataFieldList;
            
            public function __construct($responseArray) {
                if (isset($responseArray->AgentPhoneNumber)) {
                    $this->agentPhoneNumber = $responseArray->AgentPhoneNumber;
                }
                if (isset($responseArray->CallStatus)) {
                    $this->callStatus = $responseArray->CallStatus;
                }
                if (isset($responseArray->DataFieldList)) {
                    $dataFieldList = $responseArray->DataFieldList;
                    
                    foreach ($dataFieldList as $dataField) {
                        $this->dataFieldList[] = new SecureCallDataField($dataField);
                    }
                }
            }

            public function getAgentPhoneNumber(){
                return $this->agentPhoneNumber;
            }
            public function setAgentPhoneNumber($value){
                $this->agentPhoneNumber = $value;
                return $this;
            }

            public function getCallStatus(){
                return $this->callStatus;
            }
            public function setCallStatus($value){
                $this->callStatus = $value;
                return $this;
            }

            public function getDataFieldList(){
                return $this->dataFieldList;
            }
            public function setDataFieldList($value){
                $this->dataFieldList = $value;
                return $this;
            }
        }

        class SecureCallDataField{
            private $fieldType;
            private $displayValue;
            private $fieldStatus;
            private $fieldMessage;
            
            public function __construct($responseArray) {
                if (isset($responseArray->FieldType)) {
                    $this->fieldType = $responseArray->FieldType;
                }
                if (isset($responseArray->DisplayValue)) {
                    $this->displayValue = $responseArray->DisplayValue;
                }
                if (isset($responseArray->FieldStatus)) {
                    $this->fieldStatus = $responseArray->FieldStatus;
                }
                if (isset($responseArray->FieldMessage)) {
                    $this->fieldMessage = $responseArray->FieldMessage;
                }
            }

            public function getieldType(){
                return $this->fieldType;
            }
            public function setFieldType($value){
                $this->fieldType = $value;
                return $this;
            }

            public function getDisplayValue(){
                return $this->displayValue;
            }
            public function setDisplayValue($value){
                $this->displayValue = $value;
                return $this;
            }

            public function getFieldStatus(){
                return $this->fieldStatus;
            }
            public function setFieldStatus($value){
                $this->fieldStatus = $value;
                return $this;
            }

            public function getFieldMessage(){
                return $this->fieldMessage;
            }
            public function setFieldMessage($value){
                $this->fieldMessage = $value;
                return $this;
            }
        }

    
        // --------------------------------------------------------
        // Begin Payment Request classes.
     
        
        class PaymentRequestResponse extends Response {
            private $paymentRequestResp;
            
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                
                parent::__construct($apiResponse);
                
                if ($apiResponse->getResponseCode() == "0") {
                    if (isset($responseArray->PaymentRequestResp)) {
                        $this->paymentRequestResp = new PaymentRequestDetails($responseArray->PaymentRequestResp);
                    }
                }
            }
            
            public function getPaymentRequestResp(){
                return $this->paymentRequestResp;
            }
            
            public function setPaymentRequestResp($PaymentRequestResp){
                $this->paymentRequestResp = $PaymentRequestResp;
                return $this;
            }
            
        }
        
        class PaymentRequestResponseList extends Response {
            private $paymentRequestResps;
            private $paymentRequestRespIndex;
            
            public function __construct($responseArray) {
                $apiPayload = $responseArray->APIResponse;
                $apiResponse = new APIResponse($apiPayload->ResponseCode, $apiPayload->ResponseText);
                
                parent::__construct($apiResponse);
                
                $this->paymentRequestResps = array();
                
                if ($apiResponse->getResponseCode() == "0") {
                    if (isset($responseArray->PaymentRequestResp)) {
                        $items = $responseArray->PaymentRequestResp;
                        
                        foreach($items as $item) {
                            $payload = (object) array();
                            $payload->APIResponse = $apiPayload;
                            $payload->PaymentRequestResp = $item;
                            
                            $this->paymentRequestResps[] = new PaymentRequestResponse($payload);
                        }
                    }
                }
            }
            
            public function getResultCount() {
                return count($this->paymentRequestResps);
            }
            
            public function getPaymentRequestResps(){
                return $this->paymentRequestResps;
            }
            
            public function nextPaymentRequestResp() {
                $returnValue = NULL;
                if(count($this->paymentRequestResps) > $this->paymentRequestRespIndex) {
                    $returnValue = $this->paymentRequestResp[$this->paymentRequestRespIndex];
                    $this->paymentRequestRespIndex += 1;
                }
            }
            
            
        }
        
        // End Payment Request classes.
        // --------------------------------------------------------
        
        
    }
