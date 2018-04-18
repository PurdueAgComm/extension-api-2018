<?php
/**
 * Assortment of functions that provide middleware wrappers for the ExtDCR class.
 * Inspired by wordpress style function call and templating.
 * This is an optional approach to using the API.
 * Instantiating the ExtDCR class and calling methods can also be done in your template files.
 *
 * @author: John Alder
 * @email: john@sfp.net
 *
 */

function get_homepath()
{
    $known_routes = [
        'category',
        'subcategory',
        'events',
        'event',
        'label',
        'about',
        'article',
        'profile'
    ];
    require_once('../lib/SFP/PurdueAg/src/ExtDCR.php');
    $path = trim($_SERVER['REQUEST_URI'],'/');
    $path_parts = explode('/',$path);
    $is_county = '';
    foreach($known_routes as $route) {
        if(strpos($path,$route) === 0){
            //known reserved path is at /, this *must* be the main page, no need to contact the API
            return 'extension.purdue.edu/';
        }
    }
    if(isset($path_parts[0])){
        $is_county = $path_parts[0];
    }
    $ext = SFP\PurdueAg\ExtDCR::validateHomepath('extension.purdue.edu/'.$is_county);
    if($ext){
        return 'extension.purdue.edu/'.$is_county;
    }
    return 'extension.purdue.edu/';
}

function get_template()
{
    $known_routes = [
        '/category',
        '/subcategory',
        '/events',
        '/event',
        '/label',
        '/about',
        '/article',
        '/profile'
    ];
    foreach($known_routes as $route){
        if(strpos($_SERVER['REQUEST_URI'],$route) !== false){
            //known route is present in request uri
            return trim($route, '/').'.php';
        }
    }
    return 'home.php';
}

function bootstrap()
{
    //require API Interaction class
    require_once('../lib/SFP/PurdueAg/src/ExtDCR.php');

    //get the global homepath from the view and create the ext global var
    global $homepath, $ext;

    if($homepath == ''){
        //either return an error that the template never set homepath
        error_log('homepath not set by template. Using default value.', 0);
        //or provide a default
        $homepath = 'extension.purdue.edu/';
    }

    //instantiate the ExtDCR with homepath to begin fetching relevant content
    $ext = new SFP\PurdueAg\ExtDCR($homepath);
}

function get_banner()
{
    global $ext;
    $banner = $ext->getPageBanner();

    //note: this is a patch to fix inline style url paths that are not setting the domain
    $banner->strBody = str_replace('url(/','url(https://extension.purdue.edu/',$banner->strBody);

    echo $banner->strBody;
}

function get_menu()
{
    global $ext;
    $navigation = $ext->getMenu();
    include('../partials/header-menu.php');
}

function get_navigation()
{
    global $ext;
    $navigation = $ext->getMenu();
    include('../partials/page-navigation.php');
}

function get_article_list($pagesize = 7, $pagecount = 0)
{
    global $ext;
    $articles = $ext->getArticleList($pagesize, $pagecount);
    include('../partials/feed-article.php');
}

function get_category_list($cat_id, $page_size = 7, $page_count = 0)
{
    global $ext;
    $articles = $ext->getCategoryPage($cat_id, $page_size, $page_count);
    include('../partials/feed-article.php');
}

function get_event_list($pagesize = 5, $pagecount = 0)
{
    global $ext;
    $events = $ext->getEventList($pagesize, $pagecount);
    include('../partials/feed-event.php');
}

function get_footer()
{

}
