<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 7:26
 * To change this template use File | Settings | File Templates.
 */
class SubscriberFilter extends Filter
{
    private $name;
    private $email;

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __construct($url, $name = null, $email = null)
    {
        parent::__construct($url);

        $this->name = $name;
        $this->email = $email;
    }

    public function setFilter($cdata)
    {
        if ($cdata['name'])
            $this->name = $cdata['name'];

        if ($cdata['email'])
            $this->email = $cdata['email'];
    }

    protected function buildQuery()
    {
        $response = " FROM subscriber AS items WHERE 1";

        $response .= ($this->name) ? " AND name LIKE '%" . $this->name . "%'" : "";
        $response .= ($this->email) ? " AND email LIKE '%" . $this->email . "%'" : "";

        return $response . " ORDER BY items.name ASC";
    }
}