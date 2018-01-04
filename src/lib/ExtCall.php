<?php

/**
 * class ExtCall sets the API call location, gathers and assigns parameters, and makes the POST request via curl.
 * It provides, in a loose sense, a library of API calls available from the service.
 *
 * @author: John Alder
 * @email: john@sfp.net
 *
 */

class ExtCall
{
    private $ch; //curl handler
    private $url; //api url location

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function get()
    {
        //todo: is the GET verb used for any API calls?
    }

    public function post($call, $params)
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $this->url.$call);
        curl_setopt($this->ch, CURLOPT_POST, count($params));
        $param_string = http_build_query($params);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $param_string);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($this->ch);
        curl_close($this->ch);
        return json_decode($result);
    }

    public function getItemDetails($id)
    {
        $params = array(
            't' => 'd',
            'i' => $id
        );
        return $this->post('Item.ashx', $params);
    }

    public function getExpandedItemDetails($id)
    {
        $params = array(
            't' => 'e',
            'i' => $id
        );
        return $this->post('Item.ashx', $params);
    }

    public function getStaticItemDetails($id)
    {
        $params = array(
            't' => 's',
            'i' => $id
        );
        return $this->post('Item.ashx', $params);
    }

    public function getExpandedStaticItemDetails($id)
    {
        $params = array(
            't' => 'c',
            'i' => $id
        );
        return $this->post('Item.ashx', $params);
    }

    public function getItemBlurbList($id)
    {
        $params = array(
            't' => 'b',
            'i' => $id
        );
        return $this->post('Item.ashx', $params);
    }

    public function getItemBlurbExpanded($id, $cat = -1, $subcat = -1)
    {
        $params = array(
            't' => 'x',
            'i' => $id,
            'c' => $cat,
            's' => $subcat
        );
        return $this->post('Item.ashx', $params);
    }

    public function getHomeID($url)
    {
        $params = array(
            't' => 'h',
            'u' => $url
        );
        return $this->post('Home.ashx', $params);
    }

    public function getSocialMediaLinks($id)
    {
        $params = array(
            't' => 's',
            'i' => $id
        );
        return $this->post('Home.ashx', $params);
    }

    public function getRelevantLinks($id, $cat = -1, $subcat = -1)
    {
        $params = array(
            't' => 'r',
            'i' => $id,
            'c' => $cat,
            's' => $subcat
        );
        return $this->post('Home.ashx', $params);
    }

    public function getMenu($id)
    {
        $params = array(
            't' => 'm',
            'i' => $id
        );
        return $this->post('Menu.ashx', $params);
    }

    public function getMenuExpanded($id)
    {
        $params = array(
            't' => 'e',
            'i' => $id
        );
        return $this->post('Menu.ashx', $params);
    }

    public function getDownloadLink($id)
    {
        return $this->url.'File.ashx?f=i&i='.$id;
    }

    public function getImageLink($id)
    {
        return $this->url.'File.ashx?t=i&i='.$id;
    }
}