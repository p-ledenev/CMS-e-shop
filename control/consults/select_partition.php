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
<TABLE align='center' width='98%' cellpadding='5' cellspacing='5'>
    <?
    $arCategories = get_consult_category_list();
    foreach ($arCategories as $number => $category) :
        ?>
<TR><TD>
<A href='javascript:void(0)' onClick='window.opener.document.forms.question.partition_id.value="<?=$category['id']?>";
        window.opener.document.forms.question.partition.value="<?=mysql_real_escape_string(htmlspecialchars($category['name'], ENT_COMPAT, 'cp1251'))?>";
        window.close();'><FONT class='switch font17 color2'><?=$category['name']?></FONT></A>
        <?
        echo "<TR><TD><FONT class='switch purple'></FONT></TD></TR>";
    endforeach;
    echo "</TABLE></TD></TR>";
    ?>
</TABLE>
</BODY>
</HTML>
<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
?>
