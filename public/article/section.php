<?
$arPartition = get_article_partition($_GET['id']);

$partition_image = get_image($arPartition['id'], "article_partition");

$arCategory = get_article_category_by_partition($arPartition['id']);

$arPages = nav_article_print($_SERVER["REQUEST_URI"], "partition", "1", 5, 10);

$arArticles = get_article_paper_list_by_partition($_GET['id'], 0, 100); //$arPages['bg'], $arPages['nd']);
?>
<?
include $_SERVER['DOCUMENT_ROOT'] . "/templates/article_section/header.php";
?>
<table width='100%' cellpadding='0' cellspacing='0'>
    <TR>
        <TD>
            <TABLE border='0' cellpadding='0' cellspacing='0' width='100%' align='center'>
                <TR>
                    <TD style='padding:0 0 10px 0;'>
                        <TABLE>
                            <TR>
                                <TD style='font-weight:bold; padding-right:10px;'>
                                    <NOBR><H1><?=mb_strtoupper($arPartition['name'], "cp1251")?></H1></NOBR>
                                </TD>
                                <TD width='100%'>
                                    <HR noshade size='1px'>
                                </TD>
                            </TR>
                        </TABLE>
                    </TD>
                </TR>

                <TR>
                    <TD style='text-align:left;'>
                        <TABLE align='left' style='text-align:left;'>
                            <TR>
                                <?
                                if ($partition_image) {
                                    ?>
                                    <TD style='padding-right:20px; vertical-align:top;'><A target='_blank'
                                                                                           href='/upload/article_partition/<?=$partition_image?>'><IMG
                                            border='0' src='/upload/article_partition/thumb/<?=$partition_image?>'></A>
                                    </TD>
                                    <?
                                }
                                ?>
                                <TD style='text-align:justify; font-style:italic;'><?=$arPartition['preview']?></TD>
                            </TR>
                        </TABLE>
                    </TD>
                </TR>

                <TR>
                    <TD style='padding:10px 0 10px 0; text-align:justify;'>
                        <?=$arPartition['detail']?>
                    </TD>
                </TR>

                <TR>
                    <TD style='padding:20px 0 10px 0;'>
                        <TABLE>
                            <TR>
                                <TD style='font-weight:bold; padding-right:10px;'>
                                    <NOBR><H1>Ã¿“≈–»¿À€ –¿«ƒ≈À¿</H1></NOBR>
                                </TD>
                                <TD width='100%'>
                                    <HR noshade size='1px'>
                                </TD>
                            </TR>
                        </TABLE>
                    </TD>
                </TR>

                <TR>
                    <TD style='text-align:left;'>
                        <?
                        foreach ($arArticles as $number => $article) {
                            echo get_article_material_preview_representation($article);
                        }
                        ?>
                    </TD>
                </TR>
            </TABLE>

        </TD>
    </TR>
</TABLE>


<div style='padding:10' align='right'><?=$arPages['nav']?></DIV>
<?
include $_SERVER['DOCUMENT_ROOT'] . "/templates/article_section/footer.php";
?>	