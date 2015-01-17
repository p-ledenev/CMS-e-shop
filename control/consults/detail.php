<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/header.php";
?>
<?
if (!$_REQUEST['id']) die("Specify ID parameter");

if ($_GET['delete'] == "yes") {

    if ($_GET['id'] && $_GET['cid']) $strDErr = remove_consult_record($_GET['cid'], "comment");

    if (intval($strDErr) != true)
        echo "<div class='date color1' style='font-weight:bold; padding:10;'>> $strDErr</div>";
}

if ($_POST['ofill'] || $_POST['cfill']) {
    if ($_REQUEST['id'])
        $strErr = add_consult_record($_POST['mode'], $_POST);

    if (intval($strErr) != true) echo "<div class='date color1' style='font-weight:bold; padding:10;'>> $strErr</div>";
    elseif ($_POST['cfill']) echo "<script> window.location='http://$_SERVER[HTTP_HOST]/control/consult/'</script>"; else echo "<div class='date green' style='font-weight:bold;padding:10;'>> Информация успешно сохранена</div>";

    if (intval($strErr) != true) $CDATA = $_POST;
}

$arPages = nav_consult_print("/control/consult/detail.php?id=$_REQUEST[id]", "_comment", "AND question=" . $_REQUEST['id']);

$arQuestion = get_consult_question($_REQUEST['id']);

$arAnswers = get_consult_record_list($_REQUEST['id'], "answer");

$arAnswer = $arAnswers[0];
$arAnswer['date'] = ($arAnswer['date']) ? date("d.m.Y", $arAnswer['date']) : "";

$arSpecialist = get_user_info(get_user_customer_email($arAnswer['specialist']));

$arComments = get_consult_record_list($_REQUEST['id'], "comment", $arPages['bg'], $arPages['nd']);

set_consult_status($_REQUEST['id']);

$CDATA['mode'] = ($arAnswers[0]['id']) ? "c" : "a";
?>

<FORM name='client' method='post' action='/control/consult/detail.php' enctype='multipart/form-data'>
    <INPUT type='hidden' name='id' value="<?=$_REQUEST['id']?>">
    <INPUT type='hidden' name='mode' value="<?=$CDATA['mode']?>">
    <TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
        <TR>
            <TD style='padding:0 0 20 0;'><FONT class="switch font17 color2">Вопрос</FONT></TD>
        </TR>
        <TR>
            <TD>
                <TABLE cellpadding='10' cellspacing='10' border='0' width="100%">
                    <TR>
                        <TD class="date red" align='right'>Раздел</TD>
                        <TD class='txt'><?=$arQuestion['c_name']?></TD>
                    </TR>
                    <TR>
                        <TD class="date red" align='right'>
                            <nobr>Вопрос от</nobr>
                        </TD>
                        <TD class='txt color2'><?=$arQuestion['name']?></TD>
                    </TR>
                    <TR>
                        <TD class="date red" align='right'>
                            <nobr>Дата</nobr>
                        </TD>
                        <TD class='txt'><?=date("d.m.Y", $arQuestion['date'])?></TD>
                    </TR>
                    <TR>
                        <TD class="date red" align='right'>Вопрос</TD>
                        <TD class='txt black'><A target='_blank' class='blank'
                                                 href="/control/consult/insert.php?id=<?=$arQuestion['id']?>"><?=$arQuestion['record']?></A>
                        </TD>
                    </TR>
                </TABLE>
            </TD>
        </TR>

        <TR>
            <TD>&nbsp;</TD
        </TR>

        <TR>
            <TD style='padding:0 0 20 0;'><FONT class="switch font17 color2">Ответ специалиста</FONT></TD>
        </TR>
        <TR>
            <TD>
                <INPUT type='hidden' name='id_u' value='<?=$arAnswer["id"]?>'>
                <INPUT type='hidden' name='postfix' value='answer'>
                <TABLE cellpadding='5' cellspacing='5' border='0' width="80%">
                    <TR>
                        <TD class='date red' width='1%'><?=$arAnswer['date']?></TD>
                        <TD class='txt color2'
                            style='text-align:left;'><?=$arSpecialist['sname']?> <?=$arSpecialist['fname']?> <?=$arSpecialist['mname']?></TD>
                    </TR>
                    <TR>
                        <TD colspan='2' class='txt' style='text-align:justify;'><A target='_blank' class='blank'
                                                                                   href="/control/consult/insert_comment.php?id=<?=$arAnswer['id']?>&mode=answer"
                                                                                   onClick='javascript:ShowWin(this.href, 500, 400); return false;'><?=$arAnswer['answer']?></A>
                        </TD>
                    </TR>
                </TABLE>
            </TD>
        </TR>

        <TR>
            <TD>&nbsp;</TD
        </TR>

        <TR>
            <TD style='padding:0 0 20 0;'><FONT class="switch font17 color2">Комметарии посетителей</FONT></TD>
        </TR>
        <TR>
            <TD>
                <TABLE cellpadding='5' cellspacing='5' border='0' width="80%">
                    <?
                    foreach ($arComments as $number => $comment) {
                        ?>
                        <TR>
                            <TD class='date red' width='1%'><?=date("d.m.Y", $comment['date'])?></TD>
                            <TD class='txt color2' style='text-align:left;'><?=$comment['name']?></TD>
                            <?
                            if (is_auser_admin()) {
                                ?>
                                <TD>
                                    <A onClick="delConfirm('/control/consult/detail.php?delete=yes&id=<?=$_REQUEST['id']?>&cid=<?=$comment['id']?>', 'Вы действительно хотите удалить комментарий?'); return false;"
                                       href="/"><FONT class='date red'>del</FONT>
                                </TD>
                                <?
                            }
                            ?>
                        </TR>
                        <TR>
                            <TD colspan='3' class='txt' style='text-align:justify;'><A target='_blank' class='blank'
                                                                                       href="/control/consult/insert_comment.php?id=<?=$comment['id']?>&mode=comment"
                                                                                       onClick='javascript:ShowWin(this.href, 500, 400); return false;'><?=$comment['comment']?></A>
                            </TD>
                        </TR>
                        <TR>
                            <TD>&nbsp;</TD>
                        </TR>
                        <?
                    }
                    ?>
                </TABLE>
            </TD>
        </TR>

        <TR>
            <TD>
                <DIV style='padding:10' align='right'><?=$arPages['nav']?></DIV>
            </TD
        </TR>

        <TR>
            <TD style='padding:0 0 20 0;'><FONT class="switch font17 color2">Оставить сообщение</FONT></TD>
        </TR>
        <TR>
            <TD>
                <TABLE cellpadding='5' cellspacing='5' border='0' width="80%">
                    <TR>
                        <TD><TEXTAREA name='record' cols='60' rows='6' maxlength='2500'><?=$CDATA["record"]?></TEXTAREA>
                        </TD>
                    </TR>
                </TABLE>
            </TD>
        </TR>

        <TR>
            <TD>&nbsp;</TD
        </TR>

        <TR>
            <TD class="yellow_foot line_divs" style='verical-align:center;'>
                <INPUT class="big_button" style='text-align:center' type='submit' name='ofill' value='Сохранить'>
                <INPUT class="big_button" style='text-align:center' type='submit' name='cfill'
                       value='Сохранить и Закрыть'>
            </TD>
        </TR>


    </TABLE>
</FORM>

<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/footer.php";
?>
