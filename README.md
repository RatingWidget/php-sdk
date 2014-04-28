RatingWidget PHP-SDK
====================

## API Authentication

Authentication is easy to do. The API will generate all the necessary URLs your application needs to authenticate.

To get your site's ID, Public Key & Secret Key, simply sign-in at http://app.rating-widget.com and open the relevant site details.

    // Use API site scope.
    define('RW_SDK__API_SCOPE', 'site');
    
    // Modify the following definitions to your site details.
    define('RW_SDK__SITE_ID',         '__YOUR_SITE_ID__');
    define('RW_SDK__SITE_PUBLIC_KEY', '__YOUR_SITE_PUBLIC_KEY__');
    define('RW_SDK__SITE_SECRET_KEY', '__YOUR_SITE_SECRET_KEY__');

    $rw_api = new \RatingWidget\Api\Sdk\RatingWidget(
        RW_SDK__API_SCOPE,
        RW_SDK__SITE_ID,
        RW_SDK__SITE_PUBLIC_KEY,
        RW_SDK__SITE_SECRET_KEY
    );


## Usage Example

Loading the first 100 site's ratings:

    $ratings = $rw_api->Api('/ratings.json?fields=id,external_id,approved_count,avg_rate&count=100');
    
Note: Please do NOT use ratings.json call for Rich-Snippets, there's a special call for that.
    
Clear specified rating's votes:

    $ratings = $rw_api->Api('/ratings/1234/votes.json', 'DELETE');

## Rich-Snippets Data Fetching

Google crwaling frequency is not requiring a real-time micro data updates. Thus, we've wrapped the Rich-Snippets endpoint with special SDK methods that using local disk caching to prevent unnecessary API calls.

To get specified ratings data use:

    $rating_data = $rw_api->GetRichSnippetData($rating_id);
    
To echo schema.org AggregateRating HTML use:

    $rw_api->EchoAggregateRating($rating_id);

You can use /src/example.html.php as an excellent implementation of Rich-Snippets support.
    
## Reporting Bugs
Email dev [at] rating-widget [dot] com

## FAQ and Knowledge Base
http://rating-widget.com/support/

## Copyright
RatingWidget
