<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/header.php";
?>
<?
if ($_GET['delete'] == "yes") {

    if ($_GET['id']) $strDErr = remove_consult_question($_GET['id']);

    if (intval($strDErr) != true)
        echo "<div class='date color1' style='font-weight:bold; padding:10;'>> $strDErr</div>";
}

if ($_POST['tser']) {
    $_SESSION['category'] = $_POST['category'];
}

$_POST['category'] = $_SESSION['category'];
$FILTER = ($_POST['category']) ? "AND c.id='$_POST[category]'" : "AND c.id='-1'";

$arPages = nav_consult_print("/control/consult/");

$arQuestions = get_consult_question_list($FILTER, $arPages['bg'], $arPages['nd']);

$arCategories = get_consult_category_list();

?>

<FORM name='search' method='post' action='/control/consult/'>
    <TABLE width='98%' align='center'>
        <TR>
            <TD>
                <FONT class="switch font17 color2">Список вопросов</FONT>
            </TD>
        </TR>
        <TR>
            <TD>
                <TABLE align='left' cellpadding='5' cellspacing='5'>
                    <TR>
                        <TD class="date red">Разделы консультации</TD>
                        <TD>
                            <SELECT class='input' name='category' onChange="javascript:select_category();"
                                    style='width:300px;'>
                                <OPTION value='0'>- - -</OPTION>
                                <?
                                foreach ($arCategories as $number => $category)
                                    if ($category['id'] == $_POST['category']) echo "<OPTION value='$category[id]' selected>$category[name]</OPTION>";
                                    else echo "<OPTION value='$category[id]'>$category[name]</OPTION>";
                                ?>
                            </SELECT>
                        </TD>
                    </TR>
                </TABLE>
            </TD>
        </TR>
        <TR>
            <TD class="yellow_foot line_divs">
                <INPUT class="big_button" name='tser' type="submit" value="Показать">
            </TD>
        </TR>
    </TABLE>

    <BR>

    <TABLE class='original_table' cellpadding='0' cellspacing='0' border='0' width='100%'>
        <TR>
            <TH>Дата</TH>
            <TH>Имя</TH>
            <TH>Вопрос</TH>
            <?
            if (is_auser_admin()) {
                ?>
                <TH>&nbsp;</TH>
                <?
            }
            ?>
        </TR>

        <?
        foreach ($arQuestions as $number => $question) :

            $dbg = (is_consult_answer($question['id']) && is_consult_visited($question['id'])) ? "" : "#F1F1FF";
            ?>

            <TR style='background-color:<?=$dbg?>' onMouseOut='this.style.background="<?=$dbg?>"'
                onMouseOver='this.style.background="#FFEEEE"'>
                <TD><?=date("d.m.Y", $question['date'])?>&nbsp;</TD>
                <TD><?=$question['name']?>&nbsp;</TD>
                <TD style='text-align:left;'><A
                        href="/control/consult/detail.php?id=<?=$question['id']?>"><?=substr($question['record'], 0, 200)?>
                    ...</A></TD>
                <?
                if (is_auser_admin()) {
                    ?>
                    <TD>
                        <A onClick="delConfirm('/control/consult/?delete=yes&id=<?=$question['id']?>', 'Вы дейтсвительно хотите удалить вопрос?'); return false;"
                           href="/"><FONT class='date red'>del</FONT>
                    </TD>
                    <?
                }
                ?>
            </TR>

            <?
        endforeach;
        ?>

    </TABLE>

    <DIV style='padding:10' align='right'><?=$arPages['nav']?></DIV>

    <?
    include $_SERVER['DOCUMENT_ROOT'] . "/control/footer.php";
    ?>
