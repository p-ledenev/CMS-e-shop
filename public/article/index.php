<?
$arCategory = get_article_category($_GET['id']);

$arPartitions = get_article_partition_list_by_category($_GET['id']);
?>
<?
include $_SERVER['DOCUMENT_ROOT'] . "/templates/main/header.php";
?>

<TABLE width='100%' cellpadding='0' cellspacing='0'>
    <TR>
        <TD colspan='2' style='padding:20px 0 0 0;'>
            <H1>
                <NOBR><?=strtoupper($arCategory["name"])?></NOBR>
            </H1>
        </TD>
    </TR>
    <?
    foreach ($arPartitions as $number => $partition) {
        echo "<TR><TD><A href='/$partition[url]/'>$partition[name]</A></TD></TR>";
    }
    ?>
</TABLE>

<?
include $_SERVER['DOCUMENT_ROOT'] . "/templates/main/footer.php";
?>

