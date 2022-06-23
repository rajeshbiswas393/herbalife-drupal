<?php

include ("./API/BPOINT.php");
		
		BPOINT\URLDirectory::setBaseURL("reserved","https://www.bpoint.com.au/webapi/v3");
		$credentials = new BPOINT\Credentials("Singh movers", "L5[%c1xD0i", "5353109395482707",BPOINT\Mode::Live);
		$txn = new BPOINT\Transaction();
		$cardDetails = new BPOINT\CardDetails();
		$order = new BPOINT\Order();
		$shippingAddress = new BPOINT\OrderAddress();
		$billingAddress = new BPOINT\OrderAddress();
		$address = new BPOINT\Address();
		$customer = new BPOINT\Customer();
		$personalDetails = new BPOINT\PersonalDetails();
		$contactDetails = new BPOINT\ContactDetails();
		$order_item_1 = new BPOINT\OrderItem();
		$order_recipient_1 = new BPOINT\OrderRecipient();
		$fraudScreening = new BPOINT\FraudScreeningRequest();

		$txn->setAction(BPOINT\Actions::Payment);
		$txn->setCredentials($credentials);
		$txn->setAmount(20000);
		$txn->setCurrency("AUD");
		$txn->setMerchantReference("Merchant Reference");
		$txn->setCrn1("My Customer Reference");
		$txn->setCrn2("Medium");
		$txn->setCrn3("Large");
		$txn->setStoreCard(FALSE);
		$txn->setSubType("single");
		$txn->setType(BPOINT\TransactionType::Internet);

		$cardDetails->setCardHolderName("MR C CARDHOLDER");
		$cardDetails->setCardNumber("4444333322221111");
		$cardDetails->setCVN("678");
		$cardDetails->setExpiryDate("0521");

		$txn->setCardDetails($cardDetails);

		$address->setAddressLine1("123 Fake Street");
		$address->setCity("Melbourne");
		$address->setCountryCode("AUS");
		$address->setPostCode("3000");
		$address->setState("Vic");

		$contactDetails->setEmailAddress("example@email.com");

		$personalDetails->setDateOfBirth("1900-01-01");
		$personalDetails->setFirstName("John");
		$personalDetails->setLastName("Smith");
		$personalDetails->setSalutation("Mr");

		$billingAddress->setAddress($address);
		$billingAddress->setContactDetails($contactDetails);
		$billingAddress->setPersonalDetails($personalDetails);

		$shippingAddress->setAddress($address);
		$shippingAddress->setContactDetails($contactDetails);
		$shippingAddress->setPersonalDetails($personalDetails);

		$order_item_1->setDescription("an item");
		$order_item_1->setQuantity(1);
		$order_item_1->setUnitPrice(1000);

		$orderItems = array($order_item_1);

		$order_recipient_1->setAddress($address);
		$order_recipient_1->setContactDetails($contactDetails);
		$order_recipient_1->setPersonalDetails($personalDetails);

		$orderRecipients = array($order_recipient_1);

		$order->setBillingAddress($billingAddress);
		$order->setOrderItems($orderItems);
		$order->setOrderRecipients($orderRecipients);
		$order->setShippingAddress($shippingAddress);
		$order->setShippingMethod("boat");

		$txn->setOrder($order);

		$customer->setCustomerNumber("1234");
		$customer->setAddress($address);
		$customer->setExistingCustomer(false);
		$customer->setContactDetails($contactDetails);
		$customer->setPersonalDetails($personalDetails);
		$customer->setCustomerNumber("1");
		$customer->setDaysOnFile(1);

		$txn->setCustomer($customer);

		$fraudScreening->setPerformFraudScreening(true);
		$fraudScreening->setDeviceFingerprint("0400l1oURA1kJHkN<1900 characters removed>+ZKFOkdULYCXsUu0Oxk=");

		$txn->setFraudScreeningRequest($fraudScreening);

		$txn->setTokenisationMode(3);
		$txn->setTimeout(93121);

		$response = $txn->submit();
		
		echo '<pre>';
		var_dump($response);
		echo '</pre>';
?>