<?php
/**
 * class ExtDCR is an API wrapper for the ag DepotWS service.
 * It relies on ExtCall class to make the cURL web requests to the API.
 * It organizes and structures the responses and then returns data for the WP templates to render out.
 *
 * @author: John Alder
 * @email: john@sfp.net
 *
 */

//require libs
require_once('ExtCall.php');

class ExtDCR
{
    private $call;
    private $api = 'https://api.ag.purdue.edu/api/DepotWS/';

    public function __construct()
    {
        $this->call = new ExtCall($this->api);
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

        //todo: get banner
        //API call not defined in docs for this

        //get article list from newsfeed
        $articles = $this->_getNewsFeed($id);

        //todo: get event list
        //API call not defined in docs for this

        //gather up page content
        $page_content = array(
            'articles' => $articles
        );
        return $page_content;
    }

    private function _getHomeID($url)
    {
        $result = $this->call->getHomeID($url);
        $id = $result->intHomeID;
        return $id;
    }

    private function _getNewsFeed($id)
    {
        //todo: missing pagination
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
}