Facetly Wordpress
=================

Install Facetly Plugin
----------------------

How to install Facetly Plugin in wordpress

1. Before Installing Facetly Plugin, make sure you already have these requirements:
    
     a. Any FTP program, such as WinSCP, FileZilla, etc.
    
     b. Wordpress 3.0 or higher (we are not guarantee facetly plugin would be work properly in previous version)
    
     c. Activated Wordpress Woo Commerce depends on your platform, please download this plugin here (http://wordpress.org/extend/plugins/woocommerce/).
    
     d. Add permalinks in your wordpress, please follow this guide (http://codex.wordpress.org/Settings_Permalinks_Screen).
     
     e. Enable curl in php, please follow our guide here (https://www.facetly.com/doc/howto/curl)

2. Download Facetly Plugin from github (https://github.com/facetly/facetly_wordpress) and rename folder into facetly then upload it to wordpress >> wp-content >> plugins using FTP program

3. After Facetly Plugin successfully installed in your Wordpress, you will find Facetly Configuration in your admin menu and contain submenus: Facetly Configuration, Fields, Reindex, and Template

Configure Facetly Plugin
------------------------

The next step is set up Facetly Plugin for your store.

1. Input your Consumer Key, Consumer Secret, Server Name, Search Limit, and Additional Variable in Facetly Configuration sub menu.

2. If you experienced with Wordpress Development and need more customization, you can use facetly search template and follow this instruction:
     a. Extract facetly-search-template.zip to your current active template folder and make sure you have already backup your "searchform.php" file in your active theme folder if file exists. 
     
     b. Go to pages menu in your wp-admin and edit Facetly Search page. Change the template from default template to Facetly Search.

    <b>Please note: this search template (in facetly-search-template.php) is based on twenty ten default theme, if you use another theme, please make some adjustments such as id and class which match your template configuration.</b>

3. If you want just to use this facetly, just activate facetly widget on your sidebar to display product facets (depending your template).

4. After completed step 1 and 2, go to Fields sub menu. This sub menu is used to map our defined field in http://www.facetly.com and field which defined in your Wordpress store. Please follow instruction in https://www.facetly.com/doc/field to set field mapping.

5. Next step is go to Reindex sub menu. This sub menu is used to save all your product data to our server, which will used as your search data. Click Start Reindex to start the process.

    <b>Please note: you should wait until process is complete and not move to other page, otherwise you must restart your reindex process.</b>

6. Setting template for your search page. Go to Template sub menu and you will see search template and facet template. You can find more details about Template in https://www.facetly.com/doc/template

7. You can use shortcode [facetly_search output=op] to display search results or facet results in your template, where op = results to display search results or facets to display facets

8. Then you can find product with your search textbox to use this plugin
