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

//require libs
require_once('ExtCall.php');

use stdClass;

class ExtDCR
{
    private $call;
    private $api = 'https://api.ag.purdue.edu/api/DepotWS/';
    private $homeId;
    private $countyUrl;

    public function __construct($county_url)
    {
        $this->countyUrl = $county_url; //todo: refactor the county url to home id work to cut down on repeated calls
        $this->call = new ExtCall($this->api);
    }

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

    public function getMenu($county_url)
    {
        $id = $this->_getHomeID($county_url);

        $menu = $this->call->getMenu($id);

        return $menu;
    }

    public function getAboutPage()
    {

    }

    public function getProfilePage()
    {

    }

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

    public function getStatePage($state_url)
    {
        $id = $this->_getHomeID($state_url);
        return $id;
    }

    public function getCountyPage($county_url)
    {
        //get the home id for the current landing page
        $id = $this->_getHomeID($county_url);

        //API call not defined in docs for this
        $cta = $this->call->getStaticItemDetails($id);

        //get article list from newsfeed
        $articles = $this->_getNewsFeed($id);

        //get the events list, cap at 5
        $events = $this->_getEventsFeed($id, 5);

        //gather up page content
        $page_content = array(
            'articles' => $articles,
            'events' => $events,
            'cta' => $cta
        );
        return $page_content;
    }

    private function _getHomeID($url)
    {
        if(isset($this->homeId)){
            return $this->homeId;
        }
        else{
            $result = $this->call->getHomeID($url);
            $id = $result->intHomeID;
            return $id;
        }
    }

    private function _getNewsFeed($id)
    {
        $articles = $this->call->getItemBlurbList($id);

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

    private function _getEventsFeed($id, $count = 5)
    {
        $events = $this->call->getEventList($id, $count);
        return $events;
    }
}