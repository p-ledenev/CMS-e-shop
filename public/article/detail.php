<?
$arArticle = get_article_paper($_GET['id'], true);

$preview_file = get_image($arArticle['id'], "article_preview");
$detail_file = get_image($arArticle['id'], "article_detail");

$arCategory = get_article_category_by_partition($arArticle['partition_id']);
$arPartition = get_article_partition($arArticle['partition_id']);
$arProduces = get_article_paper_produce_list($arArticle['id']);
$arTemplate = get_article_template($arPartition['template']);
?>
<?
include $_SERVER['DOCUMENT_ROOT'] . "/templates/" . $arTemplate['path']. "/header.php";
?>

<table width='100%' cellpadding='0' cellspacing='0'>
    <!--	<TR>
		<TD style='color:#b39e83; font-size:12px; padding:0 0 15px 0;'><A style='color:#b39e83;' href='/<?=$arPartition["url"]?>/'><?=$arPartition["name"]?></A> > <?=$arArticle["title"]?></TD>
	</TR> 
	<TR>
<?
    if ($preview_file) {
        ?>
		<TD rowspan='2' style='padding-right:10px; vertical-align:top; text-align:center;'><A target="_blank" href='/upload/article_preview/<?= $preview_file ?>'><IMG border='0' src='/upload/article_preview/thumb/<?= $preview_file ?>'></A></TD>
<?
    }
    ?>
		<TD style='font-weight:bold; padding-right:10px;'>
<?
    if ($arCategory['id'] == 6) {
        ?>
		<FONT class='date' style='font-weight:500;'><?= date("d.m.Y", $arArticle['date']) ?></FONT>&nbsp;
<?
    }
    ?>
		<H1 style='color:#5c4621;'><?=strtoupper($arArticle['title'])?></H1></TD>
	</TR>
	<TR>
		<TD style='text-align:justify; vertical-align:top; font-style:italic; padding: 10px 0 0 0;' valign='top'><P><?=$arArticle['preview']?></P></TD>
	</TR>
-->
    <TR>
        <TD colspan='2' style='text-align:justify; vertical-align:top; padding-top:0px;' valign='top'><P>
            <?
            if ($detail_file) {
                ?>
                <A target="_blank" href='/upload/article_detail/<?=$detail_file?>'><IMG style='margin:10px;'
                                                                                        align='left' border='0'
                                                                                        src='/upload/article_detail/thumb/<?=$detail_file?>'></A>
                <?
            }
            ?>
            <?=$arArticle['detail']?>
        </P></TD>
    </TR>
</TABLE>

<?
include $_SERVER['DOCUMENT_ROOT'] . "/templates/" . $arTemplate['path'] . "/footer.php";
?>