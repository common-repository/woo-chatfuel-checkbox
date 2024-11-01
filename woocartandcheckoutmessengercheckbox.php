<?php

/*
Plugin Name: Woo Cart and Checkout Messenger Checkbox
Description: Easily add Facebook Send to Messenger and Telegram plugins to your WooCommerce cart and checkout pages.
Version: 1.1.1
Author: ActiveChat
Author URI: https://www.facebook.com/activechatai/
*/
/*  Copyright 2018  Roman Koval  (email: romariooo27@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if (! defined ('ABSPATH')) exit;

function wcacmc_add_menu_item() {
  add_menu_page('WOO Checkbox', 'WOO Checkbox', 8, 'wcacmc_adminsetting', 'wcacmc_adminsetting');
}

 add_action('admin_menu', 'wcacmc_add_menu_item');

 function wcacmc_adminsetting(){
     include_once("include/add.php");
  
 }


 function wcacmc_add_text_tovar(){
  
      
    $app_id = get_option( 'wcmcac_app_id' );
    $page_id = get_option( 'wcmcac_page_id' );
    $size = get_option( 'wcmcac_select_size' );
    
    ?>
     <script> 
window.fbMessengerPlugins = window.fbMessengerPlugins || { init : function() { FB.init({ appId: "<?php esc_attr_e($app_id); ?>", xfbml: true, version: "v2.6" });
 }, callable : [] };
  window.fbMessengerPlugins.callable.push( function() { var ruuid, fbPluginElements = document.querySelectorAll(".fb-messenger-checkbox[page_id='<?php esc_attr_e($page_id); ?>']");
   if (fbPluginElements) { for( i = 0; i < fbPluginElements.length; i++ ) { ruuid = 'cf_' + (new Array(16).join().replace(/(.|$)/g, function(){return ((Math.random()*36)|0).toString(36)[Math.random()<.5?"toString":"toUpperCase"]();}));
    fbPluginElements[i].setAttribute('user_ref', ruuid) ;
     fbPluginElements[i].setAttribute('origin', window.location.href);
      window.confirmOptIn = function() { FB.AppEvents.logEvent('MessengerCheckboxUserConfirmation', null, { app_id:"<?php esc_attr_e($app_id); ?>", page_id:"<?php esc_attr_e($page_id); ?>", ref:"woo_add_to_cart", user_ref: ruuid }); }; } } });
       window.fbAsyncInit = window.fbAsyncInit || function() { window.fbMessengerPlugins.callable.forEach( function( item ) { item(); } );
        window.fbMessengerPlugins.init(); }; setTimeout( function() { (function(d, s, id){ var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) { return; } js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk')); }, 0); 
 </script>
<script>
jQuery(document).ready(function($) {
 
     $(function() {
         
           $('.single_add_to_cart_button ').on('click', function() {
                window.confirmOptIn();
           });
             
          

     });

})
</script>
    <div class="fb-messenger-checkbox" origin="" page_id="<?php esc_attr_e($page_id); ?>" messenger_app_id="<?php esc_attr_e($app_id); ?>" user_ref="" prechecked="true" allow_login="true" size="<?=$size?>"></div>
    
     <?php
      
    
  }

function wcacmc_add_text_tovar_checkout(){
  

    $app_id = get_option( 'wcmcac_app_id' );
    $page_id = get_option( 'wcmcac_page_id' );
    $size = get_option( 'wcmcac_select_size' );
    $value_teleg_bot = get_option( 'wcmcac_url_bot' );
    $woo_checkout = 'woo_checkout';
    ?>
     <script> 
window.fbMessengerPlugins = window.fbMessengerPlugins || { init : function() { FB.init({ appId: "<?php esc_attr_e($app_id); ?>", xfbml: true, version: "v2.6" });
 }, callable : [] };
  window.fbMessengerPlugins.callable.push( function() { var ruuid, fbPluginElements = document.querySelectorAll(".fb-messenger-checkbox[page_id='<?php esc_attr_e($page_id); ?>']");
   if (fbPluginElements) { for( i = 0; i < fbPluginElements.length; i++ ) { ruuid = 'cf_' + (new Array(16).join().replace(/(.|$)/g, function(){return ((Math.random()*36)|0).toString(36)[Math.random()<.5?"toString":"toUpperCase"]();}));
    fbPluginElements[i].setAttribute('user_ref', ruuid) ;
     fbPluginElements[i].setAttribute('origin', window.location.href);
      window.confirmOptIn = function() { FB.AppEvents.logEvent('MessengerCheckboxUserConfirmation', null, { app_id:"<?php esc_attr_e($app_id); ?>", page_id:"<?php esc_attr_e($page_id); ?>", ref:"woo_checkout", user_ref: ruuid }); }; } } });
       window.fbAsyncInit = window.fbAsyncInit || function() { window.fbMessengerPlugins.callable.forEach( function( item ) { item(); } );
        window.fbMessengerPlugins.init(); }; setTimeout( function() { (function(d, s, id){ var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) { return; } js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk')); }, 0); 
 </script>
<script>
jQuery(document).ready(function($) {
 
     $(function() {
         
           
          
         $("form.woocommerce-checkout").on('submit', function () {
                       if(document.querySelector('.check-woo-wc-plug').checked == true){
                                             window.open('<?php _e(esc_url($value_teleg_bot)); ?>?start=<?php _e(base64_encode($woo_checkout)); ?>');
                                             }else if(document.querySelector('.check-woo-wc-plug').checked == false){
                                             
                                           }
                  
                  window.confirmOptIn();
                   
                     return false;

        });
             
           

     });

})
</script>
    <div class="fb-messenger-checkbox" origin="" page_id="<?php esc_attr_e($page_id); ?>" messenger_app_id="<?php esc_attr_e($app_id); ?>" user_ref="" prechecked="true" allow_login="true" size="<?=$size?>"></div>
   <?php
 }

function wcacmc_add_text_tovar_telegram(){
       $value_teleg_bot = get_option( 'wcmcac_url_bot' );
       $woo_add_to_cart = 'woo_add_to_cart';
    ?>
<div class="woo-checkbox-telegram">
    <div class="woo-checkbox-block"><input  type="checkbox" class = "check-woo-wc-plug" ><span class='check-result'></span><span>Send to<span></div>
    <div class="woo-checkbox-logo">
         <svg id="svg2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" width="15" height="15"><style>.st0{fill:url(#path2995-1-0_1_)}.st1{fill:#c8daea}.st2{fill:#a9c9dd}.st3{fill:url(#path2991_1_)}</style><linearGradient id="path2995-1-0_1_" gradientUnits="userSpaceOnUse" x1="-683.305" y1="534.845" x2="-693.305" y2="511.512" gradientTransform="matrix(6 0 0 -6 4255 3247)"><stop offset="0" stop-color="#37aee2"/><stop offset="1" stop-color="#1e96c8"/></linearGradient><path id="path2995-1-0" class="st0" d="M240 120c0 66.3-53.7 120-120 120S0 186.3 0 120 53.7 0 120 0s120 53.7 120 120z"/><path id="path2993" class="st1" d="M98 175c-3.9 0-3.2-1.5-4.6-5.2L82 132.2 152.8 88l8.3 2.2-6.9 18.8L98 175z"/><path id="path2989" class="st2" d="M98 175c3 0 4.3-1.4 6-3 2.6-2.5 36-35 36-35l-20.5-5-19 12-2.5 30v1z"/><linearGradient id="path2991_1_" gradientUnits="userSpaceOnUse" x1="128.991" y1="118.245" x2="153.991" y2="78.245" gradientTransform="matrix(1 0 0 -1 0 242)"><stop offset="0" stop-color="#eff7fc"/><stop offset="1" stop-color="#fff"/></linearGradient><path id="path2991" class="st3" d="M100 144.4l48.4 35.7c5.5 3 9.5 1.5 10.9-5.1L179 82.2c2-8.1-3.1-11.7-8.4-9.3L55 117.5c-7.9 3.2-7.8 7.6-1.4 9.5l29.7 9.3L152 93c3.2-2 6.2-.9 3.8 1.3L100 144.4z"/></svg>

Telegram</div>
</div>

<script>
   jQuery(document).ready(function( $ ) {
                          $('.single_add_to_cart_button ').on('click', function() {
                                         if(document.querySelector('.check-woo-wc-plug').checked == true){
                                             window.open('<?php _e(esc_url($value_teleg_bot)); ?>?start=<?php _e(base64_encode($woo_add_to_cart)); ?>');
                                             }else if(document.querySelector('.check-woo-wc-plug').checked == false){
                                             
                                           }

                                });
});


</script>


    <style>
    
       .woo-checkbox-telegram{
          max-width: 156px;
          display: flex;
          /*background: yellow;*/
         align-items: center;
          justify-content: space-around;
               padding: 9px;
    }
     
    .woo-checkbox-block{
    
          position: relative;
   
          display: flex;
   
                 align-items: center;

           font-size: 11px;
        color: rgba(0, 0, 0, .75);
        font-family: Helvetica, Arial, sans-serif;


    }

     .check-result{
    background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yk/r/qx_FC97K29P.png);
    background-repeat: no-repeat;
    background-size: auto;
    background-position: 0 0;
    content: '';
    display: inline-block;
    height: 16px;
    margin: 0 1px;
    position: relative;
    top: -1px;
    vertical-align: middle;
    width: 16px;
    margin-right: 6px;
}

.woo-checkbox-block input[type="checkbox"]:checked ~ .check-result{
background-image: url(https://static.xx.fbcdn.net/rsrc.php/v3/yk/r/qx_FC97K29P.png);
    background-repeat: no-repeat;
    background-size: auto;
    background-position: -17px 0;

}


         .woo-checkbox-block input[type="checkbox"]{
           margin: 0;
        margin-right: 9px;
        position: absolute;
        z-index: 90;
         opacity: 0;
         left: 3px;
             }


    .woo-checkbox-logo{
        display: flex;
        height: 20px;
        align-items: center;
        font-size: 11px;
        color: rgba(0, 0, 0, .75);
        font-family: Helvetica, Arial, sans-serif;


    }
    .woo-checkbox-logo svg{

       margin-right: 5px;

    }
     </style>

<?php
}

 function wcacmc_add_text_tovar_telegram_checkout(){
       $value_teleg_bot = get_option( 'wcmcac_url_bot' );
    ?>
<div class="woo-checkbox-telegram">
    <div class="woo-checkbox-block"><input  type="checkbox" class = "check-woo-wc-plug" ><span class='check-result'></span><span>Send to<span></div>
    <div class="woo-checkbox-logo">
         <svg id="svg2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" width="15" height="15"><style>.st0{fill:url(#path2995-1-0_1_)}.st1{fill:#c8daea}.st2{fill:#a9c9dd}.st3{fill:url(#path2991_1_)}</style><linearGradient id="path2995-1-0_1_" gradientUnits="userSpaceOnUse" x1="-683.305" y1="534.845" x2="-693.305" y2="511.512" gradientTransform="matrix(6 0 0 -6 4255 3247)"><stop offset="0" stop-color="#37aee2"/><stop offset="1" stop-color="#1e96c8"/></linearGradient><path id="path2995-1-0" class="st0" d="M240 120c0 66.3-53.7 120-120 120S0 186.3 0 120 53.7 0 120 0s120 53.7 120 120z"/><path id="path2993" class="st1" d="M98 175c-3.9 0-3.2-1.5-4.6-5.2L82 132.2 152.8 88l8.3 2.2-6.9 18.8L98 175z"/><path id="path2989" class="st2" d="M98 175c3 0 4.3-1.4 6-3 2.6-2.5 36-35 36-35l-20.5-5-19 12-2.5 30v1z"/><linearGradient id="path2991_1_" gradientUnits="userSpaceOnUse" x1="128.991" y1="118.245" x2="153.991" y2="78.245" gradientTransform="matrix(1 0 0 -1 0 242)"><stop offset="0" stop-color="#eff7fc"/><stop offset="1" stop-color="#fff"/></linearGradient><path id="path2991" class="st3" d="M100 144.4l48.4 35.7c5.5 3 9.5 1.5 10.9-5.1L179 82.2c2-8.1-3.1-11.7-8.4-9.3L55 117.5c-7.9 3.2-7.8 7.6-1.4 9.5l29.7 9.3L152 93c3.2-2 6.2-.9 3.8 1.3L100 144.4z"/></svg>

Telegram</div>
</div>

<script>
   


</script>


    <style>
    
       .woo-checkbox-telegram{
          max-width: 156px;
          display: flex;
          /*background: yellow;*/
         align-items: center;
          justify-content: space-around;
               padding: 9px;
    }
     
    .woo-checkbox-block{
    
          position: relative;
   
          display: flex;
   
                 align-items: center;

           font-size: 11px;
        color: rgba(0, 0, 0, .75);
        font-family: Helvetica, Arial, sans-serif;


    }

     .check-result{
    background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yk/r/qx_FC97K29P.png);
    background-repeat: no-repeat;
    background-size: auto;
    background-position: 0 0;
    content: '';
    display: inline-block;
    height: 16px;
    margin: 0 1px;
    position: relative;
    top: -1px;
    vertical-align: middle;
    width: 16px;
    margin-right: 6px;
}

.woo-checkbox-block input[type="checkbox"]:checked ~ .check-result{
background-image: url(https://static.xx.fbcdn.net/rsrc.php/v3/yk/r/qx_FC97K29P.png);
    background-repeat: no-repeat;
    background-size: auto;
    background-position: -17px 0;

}


         .woo-checkbox-block input[type="checkbox"]{
           margin: 0;
        margin-right: 9px;
        position: absolute;
        z-index: 90;
         opacity: 0;
         left: 3px;
             }


    .woo-checkbox-logo{
        display: flex;
        height: 20px;
        align-items: center;
        font-size: 11px;
        color: rgba(0, 0, 0, .75);
        font-family: Helvetica, Arial, sans-serif;


    }
    .woo-checkbox-logo svg{

       margin-right: 5px;

    }
     </style>

<?php
}



if(get_option( 'wcmcac_teleg_true' ) == 'telegtrue' ){
 add_action( 'woocommerce_after_add_to_cart_form' , 'wcacmc_add_text_tovar_telegram' );
 add_action( 'woocommerce_after_order_notes' , 'wcacmc_add_text_tovar_telegram_checkout' );
}


if(get_option( 'wcmcac_fb_true' ) == 'fbtrue' ){

 add_action( 'woocommerce_after_add_to_cart_form' , 'wcacmc_add_text_tovar' );
 add_action( 'woocommerce_after_order_notes' , 'wcacmc_add_text_tovar_checkout' );
}


register_uninstall_hook(__FILE__, 'wm_ya_db_uninstall');

function wm_ya_db_uninstall() {
    delete_option("wcmcac_app_id");
    delete_option("wcmcac_page_id");
    delete_option("wcmcac_select_size");
    delete_option("wcmcac_fb_true");
    delete_option("wcmcac_teleg_true");
    delete_option('wcmcac_url_bot');
  delete_option('wcmcac_user_email');
  delete_option('wcmcac_subscribe');
}




 

 
  



 
