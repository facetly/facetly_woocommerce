facetly_woocommerce
===================
Facetly Wordpress WooCommerce Plugin

Install Facetly WooCommerce Plugin

How to install Facetly WooCommerce Plugin in wordpress

1. Before Installing Facetly WooCommerce Plugin, make sure you already have these requirements:

    a. Any FTP program, such as WinSCP, FileZilla, etc.
    
    b. Activated Ubercart Plugin.

2. Facetly WooCommerce Plugin can be installed in three ways:

    a. Download Facetly WooCommerce Plugin from github (https://github.com/facetly/facetly_woocommerce) and upload it to your plugins folder using FTP program
    
    b. Download Facetly WooCommerce Plugin from github (https://github.com/facetly/facetly_woocommerce) and upload it directly from your Wordpress
    
    c. Search Facetly WooCommerce from your Wordpress plugin

3. After Facetly WooCommerce Plugin successfully installed in your Wordpress, you will find Facetly Settings in your admin menu and contain submenus: Facetly Settings, Fields, Reindex, and Template

Configure Facetly WooCommerce Plugin

The next step is set up Facetly WooCommerce Plugin for your store.

1. Input your Consumer Key, Consumer Secret, Server Name, Search Limit, and Additional Variable (as we already seen in previous picture) in Facetly Settings sub menu.

2. Check your permission for template folder and current active template folder. If the permission is "0777" (rwxrwxrwx), you can just use "Copy File" feature, otherwise extract "facetly-search-template.zip" and "searchform.zip" to your current active template folder and make sure you have already backup your "searchform.php" file in your active theme folder if file exists.
    
    Please note: this search template is based on twenty ten default theme, if you use another theme, please make some adjustments such as id and class which match your template configuration.

3. After completed step 1 and 2, go to Fields sub menu. This sub menu is used to map our defined field in http://www.facetly.com and field which defined in your Wordpress store.

4. Next step is go to Reindex sub menu. This sub menu is used to save all your product data to our server, which will used as your search data. Click Start Reindex to start the process.

    Please note: you should wait until process is complete and not move to other page, otherwise your data reindex will not completed and you must start from the beginning.

5. The final step is setting template for your search page. Go to Template sub menu and you will see search template and facet template. You can find more details about Template in https://www.facetly.com/doc/template


