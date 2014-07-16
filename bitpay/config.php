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

// ecwid settings
$storeURL = '';  // example: 'http://www.example.com/ecwid/index.html'
$storeId = ''; // found in your ecwid control panel, bottom-right

// bitpay settings
// url of bitpay folder on your server.  example: 'http://www.example.com/ecwid/bitpay/
$bitpayURL = ''; 
// apiKey: create this at bitpay.com in your account settings and paste it here
$apiKey = '';  // ex 'DNboT9fVNpW7usAuDNboT9fVNpW7usAu'
// speed: Warning: on medium/low, customers will not see an order confirmation page.  
$speed = 'high'; // can be 'high', 'medium' or 'low'.  See bitpay API doc for more details.

//payment method settings
$login = ''; // see README
$hashValue = ''; // see README

// add trailing slash to url
$bitpayURL = preg_replace('#([^\/])$#', '\1/', $bitpayURL);

?>