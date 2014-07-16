<?php

/**
 * The MIT License (MIT)
 * 
 * Copyright (c) 2011-2014 BitPay
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require 'bp_lib.php';
require 'config.php';
require 'functions.php';

if ($_POST['x_login'] != $login) {
	debuglog('ecwid login does not match that found in config.php');
	print 'invalid ecwid login';
	die;
}

// create invoice
$posData = array($_POST['x_amount'], // put here to preserve exact digits
		$_POST['x_invoice_num']);
$options = array(
	'apiKey' => $apiKey,
	'notificationURL' => $bitpayURL.'callback.php',
	'transactionSpeed' => $speed,
	'fullNotifications' => true,
	'itemDesc' => $_POST['x_description'],
	'currency' => $_POST['x_currency_code'],
	'redirectURL' => $bitpayURL.'redirect2ecwid.php?ecwidInvoiceId='.$_POST['x_invoice_num'],
	'buyerEmail' => $_POST['x_email'],
	'buyerName' => $_POST['x_first_name'].' '.$_POST['x_last_name'],
	'buyerAddress1' => $_POST['x_address'],
	'buyerCity' => $_POST['x_city'],
	'buyerState' => $_POST['x_state'],
	'buyerZip' => $_POST['x_zip'],
	'buyerCountry' => $_POST['x_country'],
	);		

$invoice = bpCreateInvoice(NULL, $_POST['x_amount'], $posData, $options);
if (isset($invoice['error'])) {
	debuglog('Error creating invoice');
	print 'Error creating invoice';
	die;
}

// save bitpay invoice id in a file named after the ecwid invoice id
file_put_contents($_POST['x_invoice_num'].'.inv', $invoice['id']);

// redirect to bitpay
header('Location: '.$invoice['url']);

?>
