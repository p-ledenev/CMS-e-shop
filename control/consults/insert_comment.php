<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 TRansitional//EN">
<HTML>
<HEAD>
    <META name="ROBOTS" content="none">
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-ConTRol" CONTENT="no-cache, no-store, must-revalidate">

    <TITLE>Административная панель :: project.avnc.ru</TITLE>

    <LINK href="/control/styles.css" rel="stylesheet" type="text/css"/>

    <SCRIPT type="text/javascript" src="/control/script.js"></SCRIPT>
    <IMG style='display:none;' border='0' src='/control/images/minus.png'>
</HEAD>
<BODY>
<?
if ($_POST['padd']) {
    if ($_REQUEST['id'])
        $strErr = modify_consult_record($_POST['mode'], $_POST);

    if (intval($strErr) != true) echo "<div class='date color1' style='font-weight:bold; padding:10;'>> $strErr</div>";
    else echo "<script> window.opener.document.location.reload(); window.close();</script>";

    if (intval($strErr) != true) $CDATA = $_POST;
}

if ($_REQUEST['id'] && (!$strErr || intval($strErr) == true)) $CDATA = get_consult_record($_REQUEST['id'], $_REQUEST['mode']);
?>
<DIV style='padding: 10 0 0 10;'><FONT class="switch FONT17 color2">Редактировать сообщение</FONT></DIV>
<FORM method='post' action='/control/consult/insert_comment.php' enctype='multipart/form-data'>
    <INPUT type='hidden' name='id' value='<?=$_REQUEST["id"]?>'>
    <INPUT type='hidden' name='mode' value='<?=$_REQUEST["mode"]?>'>
    <TABLE width='98%' align='center' cellpadding='10' cellspacing='10' border='0' backround='#FFCCCC'>
        <TR>
            <TD class='date red' style='text-align:left;'>Сообщение</TD>
        </TR>
        <TD><TEXTAREA name='record' cols='50' maxlength='2500' rows='15'><?=$CDATA["record"]?></TEXTAREA></TD>
        </TR>
        <TR>
            <TD class="yellow_foot line_divs" style='verical-align:center;' colspan='2'><INPUT class='big_button'
                                                                                               type='submit' name='padd'
                                                                                               value='Изменить'></TD>
        </TR>
    </TABLE>
</FORM>

</BODY>
</HTML>
<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
?>