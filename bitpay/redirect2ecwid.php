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
 
require 'config.php';
require 'bp_lib.php';
require 'functions.php';

// get invoice number from file
$file = $_GET['ecwidInvoiceId'].'.inv';

if (file_exists($file))
{
	$invoiceId = file_get_contents($file);	
	deleteOldInvs();
	
	$invoice = bpGetInvoice($invoiceId, $apiKey);
	if ($invoice['status'] == 'confirmed' or $invoice['status'] == 'completed')
	{
		postToEcwid($invoice); // this will redirect to a confirmation page
		die;
	}
}
else
	debuglog('no file found for invoice '.$_GET['ecwidInvoiceId']);
	
header('Location: '.$storeURL); // if the transaction speed is medium/low, they'll be redirected w/o confirmation

?>