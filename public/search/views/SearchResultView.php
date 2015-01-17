<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 07.04.14
 * Time: 8:26
 */

class SearchResultView extends SearchView
{
    /* @param Produce[] $produceList */
    public function __construct($produceList, $produceTitle)
    {
        parent::__construct($produceTitle);

        $preProduce = Produce::initEntity("Produce");
        foreach ($produceList as $produce) {

            if (!$preProduce->equals($produce))
                $this->viewList[] = new SearchResultProduceView($produce);

            $preProduce = $produce;
        }
    }

    public function echoHeaderTemplate()
    {
        parent::echoHeaderTemplate();

        echo "<TABLE cellpadding='0' cellspacing='0' border='0'>";
    }

    public function echoFooterTemplate()
    {
        echo "</TABLE>";

        parent::echoFooterTemplate();
    }

} 