<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";
include $_SERVER["DOCUMENT_ROOT"] . "/control/deals/templates/inwords.php";

function eval_template($str, $blProp)
{
    $str_template = "";

    $str_array = explode("||", $str);
    for ($i = 0; $i < count($str_array); $i++) {

        if (isset($blProp[$str_array[$i]])) :
            $blProp[$str_array[$i]] = str_replace("<br>", "\par", $blProp[$str_array[$i]]);
            $blProp[$str_array[$i]] = str_replace("&#40;", "(", $blProp[$str_array[$i]]);
            $blProp[$str_array[$i]] = str_replace("&#41;", ")", $blProp[$str_array[$i]]);
            $blProp[$str_array[$i]] = str_replace("&#37;", "%", $blProp[$str_array[$i]]);
            $blProp[$str_array[$i]] = str_replace("&nbsp;", " ", $blProp[$str_array[$i]]);
            $blProp[$str_array[$i]] = str_replace("&quot;", "\"", $blProp[$str_array[$i]]);
        endif;

        $str_template .= (isset($blProp[$str_array[$i]])) ? $blProp[$str_array[$i]] : $str_array[$i];
    }

    return $str_template;
}

/* @var Deal $deal */
$deal = Deal::initEntityWithId("Deal", $_POST['id']);
$customer = $deal->getCustomer();

$CDATA = Array();
$strErr = "";

$d = intval(date("d", time()));
$m = intval(date("m", time()));
$year = date("Y", time());

$month[1] = "€нвар€";
$month[2] = "феврал€";
$month[3] = "марта";
$month[4] = "апрел€";
$month[5] = "ма€";
$month[6] = "июн€";
$month[7] = "июл€";
$month[8] = "августа";
$month[9] = "сент€бр€";
$month[10] = "окт€бр€";
$month[11] = "но€бр€";
$month[12] = "декабр€";

$day[1] = "01";
$day[2] = "02";
$day[3] = "03";
$day[4] = "04";
$day[5] = "05";
$day[6] = "06";
$day[7] = "07";
$day[8] = "08";
$day[9] = "09";
$day[10] = "10";
$day[11] = "11";
$day[12] = "12";
$day[13] = "13";
$day[14] = "14";
$day[15] = "15";
$day[16] = "16";
$day[17] = "17";
$day[18] = "18";
$day[19] = "19";
$day[20] = "20";
$day[21] = "21";
$day[22] = "22";
$day[23] = "23";
$day[24] = "24";
$day[25] = "25";
$day[26] = "26";
$day[27] = "27";
$day[28] = "28";
$day[29] = "29";
$day[30] = "30";
$day[31] = "31";

$cIndex = $deal->getAddress()->getCIndex();

$house = ($deal->getAddress()->getHouse()) ? "д. " . $deal->getAddress()->getHouse() : "";
$build = ($deal->getAddress()->getBuild() && $deal->getAddress()->getBuild() != '-' &&
    $deal->getAddress()->getBuild() != ' ' && $deal->getAddress()->getBuild() != 'нет') ? ", корп. " . $deal->getAddress()->getBuild() : "";
$flat = ($deal->getAddress()->getFlat() && $deal->getAddress()->getFlat() != '-' &&
    $deal->getAddress()->getFlat() != ' ' && $deal->getAddress()->getFlat() != 'нет') ? ", кв. " . $deal->getAddress()->getFlat() : "";

$CDATA['date_of'] = $day[$d] . " " . $month[$m] . " " . $year;
$CDATA['date_di'] = date("d.m.Y");

$CDATA['day'] = $day[$d];
$CDATA['month'] = $month[$m];
$CDATA['year'] = $year;

$CDATA['sum_rub'] = $_POST['print_summ'] . " руб.";
$CDATA['sum'] = $_POST['print_summ'];
$CDATA['sum_prop'] = SumProp($_POST['print_summ']);
$CDATA['second_name'] = $customer->getPostSecondName();
$CDATA['first_name'] = $customer->getPostFirstName() . " " . $customer->getPostMiddleName();
$CDATA['phone'] = (strlen($deal->getAddress()->getPhone()) > 0) ? $deal->getAddress()->getPhone() : $customer->getPhone();
$CDATA['fio_full'] = $customer->getPostSecondName() . " " . $customer->getPostFirstName() . " " . $customer->getPostMiddleName();
$CDATA['index'] = $cIndex;
$CDATA['i1'] = $cIndex[0];
$CDATA['i2'] = $cIndex[1];
$CDATA['i3'] = $cIndex[2];
$CDATA['i4'] = $cIndex[3];
$CDATA['i5'] = $cIndex[4];
$CDATA['i6'] = $cIndex[5];
$CDATA['city'] = $deal->getAddress()->getCity() . ", ";
$CDATA['street'] = "ул. " . $deal->getAddress()->getStreet() . ",";
$CDATA['house'] = $house . $build . $flat;
$CDATA['fio'] = $customer->getPostSecondName() . " " .
    substr($customer->getPostFirstName(), 0, 1) . "." .
    substr($customer->getPostMiddleName(), 0, 1) . ".";

if ($_POST['post_form'] == "1") {

    $fname = "post_template_117.rtf";
    if ($_POST['post_np'] == "1") $fname = "post_template.rtf";
    if ($_POST['post_np'] == "1" && $_POST['post_bnd'] == "1") $fname = "post_template_113.rtf";

    header("Content-Disposition: attachment; filename=$fname");

    $fl = fopen($_SERVER['DOCUMENT_ROOT'] . "/control/deals/templates/$fname", "r");
    while ($ln = fgets($fl)) echo eval_template($ln, $CDATA);
    fclose($fl);
}

if ($_POST['package_form'] == "1") {

    $fname = "package_template.rtf";
    if ($_POST['post_np'] == "1") $fname = "package_template_np.rtf";

    header("Content-Disposition: attachment; filename=$fname");

    $fl = fopen($_SERVER['DOCUMENT_ROOT'] . "/control/deals/templates/$fname", "r");
    while ($ln = fgets($fl)) echo eval_template($ln, $CDATA);
    fclose($fl);
}

if ($_POST['parcel_form'] == "1") {

    $fname = "parcel_template.rtf";
    if ($_POST['post_np'] == "1") $fname = "parcel_template_np.rtf";

    header("Content-Disposition: attachment; filename=$fname");

    $fl = fopen($_SERVER['DOCUMENT_ROOT'] . "/control/deals/templates/$fname", "r");
    while ($ln = fgets($fl)) echo eval_template($ln, $CDATA);
    fclose($fl);
}

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
