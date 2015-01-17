<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/header.php";
?>
<?
if ($_POST['ofill'] || $_POST['cfill']) {
    $strErr = ($_REQUEST['id']) ? modify_consult_question($_POST) : add_consult_record("q", $_POST);

    if (intval($strErr) != true) echo "<div class='date color1' style='font-weight:bold; padding:10;'>> $strErr</div>";
    elseif ($_POST['cfill']) echo "<script> window.location='http://$_SERVER[HTTP_HOST]/control/consult/'</script>"; else echo "<div class='date green' style='font-weight:bold;padding:10;'>> Информация успешно сохранена</div>";
    if (intval($strErr) != true) $CDATA = $_POST;
}

if ($_REQUEST['id'] && (!$strErr || intval($strErr) == true)) $CDATA = get_consult_question($_REQUEST['id'], false, false);

$CDATA['date'] = ($CDATA['date']) ? $CDATA['date'] : date("d.m.Y");
if (is_numeric($CDATA['date'])) $CDATA['date'] = date("d.m.Y", $CDATA['date']);

$CDATA['partition_id'] = $CDATA['c_id'];
$CDATA['partition'] = $CDATA['c_name']

?>

<FORM name='question' method='post' action='/control/consult/insert.php' enctype='multipart/form-data'>
    <INPUT type='hidden' name='id' value="<?=$_REQUEST['id']?>">
    <TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
        <TR>
            <TD style='padding:0 0 20 0;'><FONT class="switch font17 color2">Добавить вопрос</FONT></TD>
        </TR>
        <TR>
            <TD>
                <TABLE cellpadding='5' cellspacing='5' border='0' width="30%">
                    <TR>
                        <TD class="date red" align='middle'>Имя</TD>
                        <TD class="date red" align='middle'>Дата</TD>
                    </TR>
                    <TR>
                        <TD class="date red" align='middle'><INPUT class="input" maxLength='50' size='30' name='name'
                                                                   value="<?=$CDATA['name']?>"></TD>
                        <TD class="date red" align='middle'><INPUT class="input" maxLength='50' size='10' name='date'
                                                                   value="<?=$CDATA['date']?>"
                                                                   onFocus="this.select();lcs(this)"
                                                                   onClick="event.cancelBubble=true;this.select();lcs(this)">
                        </TD>
                    </TR>
                </TABLE>
            </TD>
        </TR>

        <TR>
            <TD>&nbsp;</TD>
        </TR>

        <TR>
            <TD>
                <TABLE cellpadding='5' cellspacing='5' border='0 valign=' top
                ''>
        <TR>
            <TD valign='top'>
                <TABLE cellpadding='5' cellspacing='5' border='0' valign='top'>
                    <TR>
                        <TD class="date red" align='middle'>Раздел</TD>
                        <TD><INPUT class="input" maxLength='50' size='30' name='partition'
                                   value="<?=$CDATA['partition']?>">
                            <INPUT type='hidden' name='partition_id' value="<?=$CDATA['partition_id']?>">
                            <INPUT type='button' value='...'
                                   onClick='javascript:ShowWin("/control/consult/select_partition.php", 400, 600)'></TD>
                    </TR>
                </TABLE>
            </TD>
            <TD align='left' valign='top' style='padding:0 0 0 20;'>
                <TABLE cellpadding='5' cellspacing='5' align='left' valign='top'>
                    <TR>
                        <TD class="date red">Размещен в разделе</TD>
                    </TR>
                    <TR>
                        <TD class='date' style='font-size:12px; color:#555;'><?=$CDATA['c_name']?></TD>
                </TABLE>
    </TABLE>
    </TD></TR>

    <TR>
        <TD>&nbsp;</TD>
    </TR>

    <TR>
        <TD>
            <TABLE>
                <TR>
                    <TD class="date red">Вопрос</TD>
                </TR>
                <TR>
                    <TD>
                        <?
                        $form_name = "question"; $field_name = "record";
                        include $_SERVER['DOCUMENT_ROOT'] . "/control/editor/bar.php";
                        ?>
                    </TD>
                </TR>
                <TR>
                    <TD><TEXTAREA name="record" rows='6' cols='80' maxlength='2500'><?=$CDATA['record']?></TEXTAREA>
                    </TD>
                </TR>
            </TABLE>
        </TD>
    </TR>

    <TR>
        <TD>&nbsp;</TD>
    </TR>

    <TR>
        <TD class="yellow_foot line_divs" style='verical-align:center;'>
            <INPUT class="big_button" style='text-align:center' type='submit' name='ofill' value='Сохранить'>
            <INPUT class="big_button" style='text-align:center' type='submit' name='cfill' value='Сохранить и Закрыть'>
        </TD>
    </TR>

    </TABLE>

</FORM>

<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/footer.php";
?>