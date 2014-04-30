<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Lang" content="en">
    <title>RatingWidget Rich-Snippets Example</title>
</head>
<body>
<?php
    // Use API site scope.
    define('RW_SDK__API_SCOPE', 'site');
    
    // Modify the following definitions to your site details.
    define('RW_SDK__SITE_ID',         '__YOUR_SITE_ID__');
    define('RW_SDK__SITE_PUBLIC_KEY', '__YOUR_SITE_PUBLIC_KEY__');
    define('RW_SDK__SITE_SECRET_KEY', '__YOUR_SITE_SECRET_KEY__');
    
    // Include RatingWidget's SDK.
    require dirname(__FILE__) . '/ratingwidget.php';
    
    // Init SDK with your site details (assumes that the SDK located in same folder of this example).
    $rw_api = new \RatingWidget\Api\Sdk\RatingWidget(
        RW_SDK__API_SCOPE,
        RW_SDK__SITE_ID,
        RW_SDK__SITE_PUBLIC_KEY,
        RW_SDK__SITE_SECRET_KEY
    );
    
    $item_id = 'UNIQUE_POSITIVER_INTEGER'; // Replace that with your rating id.
    
    // If you want the rating to work with Rich-Snippets,
    // set the rating class to one of the following values:
    //     product, page, blog-post, post, front-post, item
    $rating_class = 'product';  
?>
    <!-- Must contain all schema.org elements -->
    <div class="container" itemscope itemtype="http://schema.org/Product">
        <!-- itemprop="name"should be added to rated element name/title -->
        <h1 itemprop="name">My Page/Post/Product Title</h1>
        <p>
            Description / Content.
        </p>
        <div class="rw-ui-container rw-class-<?php echo $rating_class ?> rw-urid-<?php echo $item_id ?>"></div>
        <?php 
        $rw_api->EchoAggregateRating($item_id) ?>
    </div>
</body>
</html>
