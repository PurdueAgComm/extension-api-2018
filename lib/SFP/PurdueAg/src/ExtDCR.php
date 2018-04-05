<?php
/**
 * class ExtDCR is an API wrapper for the ag DepotWS service.
 * It relies on ExtCall class to make the cURL web requests to the API.
 * It organizes and structures the responses and then returns data for the PHP templates to render out.
 *
 * @author: John Alder
 * @email: john@sfp.net
 *
 */

namespace SFP\PurdueAg;

//require API Calling Class
require_once('ExtCall.php');

use stdClass;

class ExtDCR
{
    private $call;
    private $api = 'https://api.ag.purdue.edu/api/DepotWS/';
    private $homeId = 0;
    private $countyUrl;

    public function __construct($county_url)
    {
        $this->call = new ExtCall($this->api);
        $this->countyUrl = $county_url;
        $this->homeId = $this->_getHomeID($this->countyUrl);
    }

    //todo: deprecate this, move to wrapper functions
    public function getHeaderElements($county_url)
    {
        //get the home id for the current landing page
        $id = $this->_getHomeID($county_url);

        $social = $this->call->getSocialMediaLinks($id);

        $header = array(
            'social' => $social
        );

        return $header;
    }

    public function getMenu()
    {
        $menu = $this->call->getMenu($this->homeId);
        return $menu;
    }

    public function getAboutPage()
    {

    }

    public function getProfilePage()
    {

    }

    //todo: move this to the ExtCall Class
    public function getArticlePage($article_id)
    {
        $params = array(
            't' => 'e', //expanded article details
            'i' => $article_id,
        );
        $result = $this->call->post('Item.ashx', $params);
        $article = $result;
        return $article;
    }

    public function getLabelPage()
    {
        return $this->call->getLabelList();
    }

    public function getEventPage()
    {

    }

    public function getEventsPage()
    {

    }

    public function getCategoryPage()
    {

    }

    //todo: move this to the ExtCall Class
    public function getSubCategoryPage()
    {
        //retrieve item blurb list
        $params = array(
            't' => 'b',
            'i' => 1
        );
        $result = $this->call->post('Item.ashx', $params);
        return $result;
    }

    public function getPageBanner()
    {
        return $this->call->getStaticItemDetails($this->_getHomeID());
    }

    private function _getHomeID($url = false)
    {
        if($url === false){
            $url = $this->countyUrl;
        }
        if($this->homeId === 0 && $url !== false){
            $result = $this->call->getHomeID($url);
            $this->homeId = $result->intHomeID;
        }
        return $this->homeId;
    }

    public function getArticleList($size = 7, $count = 0)
    {
        $articles = $this->call->getItemBlurbList($this->_getHomeID(), $size, $count);

        //build article list additional details/assets
        foreach($articles as &$article){
            $expandedDetails = $this->call->getExpandedItemDetails($article->intItemID);
            if(count($expandedDetails->Images)){
                //let's get the thumbnail
                $imageUrl = $this->call->getImageLink($expandedDetails->Images[0]->intImageID);
                $article->thumb = new stdClass();
                $article->thumb->url = $imageUrl;
                $article->thumb->alt = $expandedDetails->Images[0]->strAltText;
            }
        }

        return $articles;
    }

    public function getEventList($size = 5, $count = 0)
    {
        $events = $this->call->getEventList($this->_getHomeID(), $size, $count);
        return $events;
    }
}