<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 13.08.13
 * Time: 17:44
 * To change this template use File | Settings | File Templates.
 */
class Navigation
{
    private $totalCount;
    private $totalPages;
    private $perPage;
    private $initialPerPage;
    private $currentPage;
    private $startsFrom;
    private $url;

    public function __construct($totalCount, $url, $perPage = 50)
    {
        $this->totalCount = $totalCount;
        $this->totalPages = ceil($totalCount / $perPage);
        $this->perPage = ($totalCount < $perPage) ? $totalCount : $perPage;
        $this->initialPerPage = ($totalCount < $perPage) ? $totalCount : $perPage;
        $this->currentPage = 1;
        $this->startsFrom = 0;
        $this->url = $url;
    }

    public function setInitialPerPage($initialPerPage)
    {
        $this->initialPerPage = ($initialPerPage > 0) ? $initialPerPage : 50;
    }

    public function getInitialPerPage()
    {
        return $this->initialPerPage;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setStartsFrom($startsFrom)
    {
        $this->startsFrom = $startsFrom;
    }

    public function getStartsFrom()
    {
        return $this->startsFrom;
    }

    public function setTotalPages($totalPages)
    {
        $this->totalPages = $totalPages;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function setTotalCount($totalCount)
    {
        $this->totalCount = $totalCount;
    }

    public function getTotalCount()
    {
        return $this->totalCount;
    }

    public function resetAll()
    {
        $this->perPage = $this->initialPerPage;
        $this->totalPages = ceil($this->totalCount / $this->perPage);
        $this->currentPage = 1;
        $this->startsFrom = 0;
    }

    public function toNextPage()
    {
        if ($this->currentPage < $this->totalPages + 1) {
            $this->currentPage += 1;
            $this->startsFrom += $this->perPage;
        }
    }

    public function toPrevPage()
    {
        if ($this->currentPage > 0) {
            $this->currentPage -= 1;
            $this->startsFrom -= $this->perPage;
        }
    }

    public function toPage($page)
    {
        if ($page > 0 && $page < $this->totalPages + 1) {
            $this->currentPage = $page;
            $this->startsFrom = $this->perPage * ($this->currentPage - 1);
        }
    }

    public function allPages()
    {
        $this->perPage = $this->totalCount;
        $this->totalPages = 1;
        $this->currentPage = 1;
        $this->startsFrom = 0;
    }
}

;