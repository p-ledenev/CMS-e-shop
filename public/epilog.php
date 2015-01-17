<?
$_SESSION['customerCart'] = serialize($cart);
$_SESSION['customer'] = serialize($customer);
$_SESSION['deal'] = serialize($deal);
$_SESSION['capthca'] = serialize($captcha);

Filter:: $base->close();
