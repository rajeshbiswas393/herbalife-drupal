<?php
	namespace BPOINT {
		class Actions {
			const Payment = "payment";
			const Refund = "refund";
			const Preauth = "preauth";
			const Capture = "capture";
			const Reversal = "reversal";
			const UnmatchedRefund = "unmatched_refund";
		}
		
		class Mode {
			const Live = "Live";
			const UAT = "UAT";
		}
		
		class TokenisationMode {
			const Default_Mode = 0;
			const Do_Not_Tokenise = 1;
			const Tokenise_If_Storing = 2;
			const Tokenise = 3;
		}
		
		class TransactionType {
			const CallCentre = "callcentre";
			const CardPresent = "cardpresent";
			const ECommerce = "ecommerce";
			const Internet = "internet";
			const IVR = "ivr";
			const MailOrder = "mailorder";
			const TelephoneOrder = "telephoneorder";
		}
		
		class TransactionSubType {
			const Single = "single";
			const Recurring = "recurring";
		}
		
		class CardType {
			const Visa = "VC";
			const MasterCard = "MC";
			const JCB = "JC";
			const DinersClub = "DC";
			const AmericanExpress = "AX";
		}
		
		class TransactionSource {
			const API = "api";
			const InvoicePortal = "invoiceportal";
			const Internet = "internet";
			const BackOffice = "backoffice";
			const SFTP = "sftp";
		}
		
		class CVNResponse {
			const Matched = "M";
			const NotPresent = "S";
			const NotProcessed = "P";
			const NotRegistered = "U";
			const NotMatched = "N";
			const Unsupported = "Unsupported";
		}
		
		class ThreeDECIResponse {
			const Authenticated = "05";
			const NotAuthenticated = "06";
		}
		
		class ThreeDEnrolledResponse {
			const Enrolled = "Y";
			const NotEnrolled = "N";
			const Unknown = "U";
		}
		
		class ThreeDStatusResponse {
			const Authenticated = "Y";
			const NotAuthenticated = "N";
			const AttemptedAuthentication = "A";
			const Unknown = "U";
		}
		
		class ThreeDSLIResponse {
			const MCMerchantNotParticipating = "0";
			const MCCardholderNotParticipating = "1";
			const MCAuthenticated = "2";
			const VisaAuthenticated = "05";
			const AmexAuthenticated = "05";
			const VisaCardholderNotParticipating = "06";
			const AmexCardholderAuthFailed = "06";
			const VisaNotAuthenticated = "07";
			const AmexNotAuthenticated = "07";
		}
		
		class ThreeDVerifyStatusResponse {
			const Authenticated = "Y";
			const IssuerAttemptedAuthentication = "M";
			const CardholderNotEnrolled = "E";
			const RequestError = "F";
			const VerificationFailed = "N";
			const SignatureVerifyError = "S";
			const IssuerInputError = "P";
			const InternalError = "I";
			const VerificationNotCompleted = "U";
			const CardholderTimeout = "T";
			const MerchantAuthFailure = "A";
			const CommunicationError = "D";
			const CardTypeNotSupported = "C";
		}
		
		class ThreeDVerifyTypeResponse {
			const ThreeDSecure = "3DS";
			const SecurePaymentAuthentication = "SPA";
		}
	}
