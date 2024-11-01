<?php
if (! defined ('ABSPATH')) exit;

function wcacmc_send_api_activecomp($email){
          
      $url = 'https://newdigital.api-us1.com';
      $params = array(
                'api_key'      => '792aab951f98cbb55d6e0349118ebb012fb6bacc7a6609fd90f614271c4e523d142eb38b',
                'api_action'   => 'contact_add',
                'api_output'   => 'serialize',
      );
      $post = array(
              'email' => $email/*'testdom2@example.com'*/,
               'p[10]' => 10,
                'field[25,0]' => get_site_url(),
      );
      $query = "";
      foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
      $query = rtrim($query, '& ');

      $data = "";
      foreach( $post as $key => $value ) $data .= urlencode($key) . '=' . urlencode($value) . '&';
      $data = rtrim($data, '& ');

      $url = rtrim($url, '/ ');
      
      if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');
      
      if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
      die('JSON not supported. (introduced in PHP 5.2.0)');
      }
       
      $api = $url . '/admin/api.php?' . $query;

      $request = curl_init($api); // initiate curl object
    curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
    curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
    curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
    //curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
    curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

    $response = (string)curl_exec($request); // execute curl post and store results in $response

    // additional options may be required depending upon your server configuration
    // you can find documentation on curl options at http://www.php.net/curl_setopt
    curl_close($request); // close curl object

    if ( !$response ) {
        die('Nothing was returned. Do you have a connection to Email Marketing server?');
    }

    // This line takes the response and breaks it into an array using:
    // JSON decoder
    //$result = json_decode($response);
    // unserializer
    $result = unserialize($response);
}

if (!empty($_POST)) {


    
    $woocappId = sanitize_key($_POST['woocappId']);
    $woocpageId = sanitize_key($_POST['woocpageId']);
    $selectOption = sanitize_key($_POST['taskOption']);
    $woocfacebook = sanitize_key($_POST['woocfacebook']);
    $wooctelegram = sanitize_key($_POST['wooctelegram']);
    $woocnamebot = esc_url_raw($_POST['woocnamebot']);
    $woocsubsc = sanitize_key($_POST['woocsubscribe']);
    $woocuseremail = sanitize_email($_POST['user_email']);


    update_option("wcmcac_app_id", $woocappId);
    update_option("wcmcac_page_id", $woocpageId);
    update_option("wcmcac_select_size", $selectOption);
    update_option("wcmcac_fb_true", $woocfacebook);
    update_option("wcmcac_teleg_true", $wooctelegram);
    update_option("wcmcac_url_bot", $woocnamebot);
    update_option("wcmcac_subscribe", $woocsubsc);
    update_option("wcmcac_user_email", $woocuseremail);


     
      $app_id = get_option( 'wcmcac_app_id' );
      $page_id = get_option( 'wcmcac_page_id' );
      $size = get_option( 'wcmcac_select_size' );
      $value_fb = get_option( 'wcmcac_fb_true' );
      $value_teleg = get_option( 'wcmcac_teleg_true' );
      $value_teleg_bot = get_option( 'wcmcac_url_bot' );
      $value_subscribe = get_option( 'wcmcac_subscribe' );
      $value_emailformdb = get_option( 'wcmcac_user_email' );
      
      
        
 }else{
      update_option("wcmcac_user_email", wp_get_current_user()->user_email);
  
      $app_id = get_option( 'wcmcac_app_id' );
      $page_id = get_option( 'wcmcac_page_id' );
      $size = get_option( 'wcmcac_select_size' );
      $value_fb = get_option( 'wcmcac_fb_true' );
      $value_teleg = get_option( 'wcmcac_teleg_true' );
      $value_teleg_bot = get_option( 'wcmcac_url_bot' );
      $value_subscribe = get_option( 'wcmcac_subscribe' );
      $value_emailformdb = get_option( 'wcmcac_user_email' );
     
}
if($value_emailformdb==''){
   $value_emailformdb = wp_get_current_user()->user_email;
}

if(get_option( 'wcmcac_subscribe' ) == 'subscrtrue'){
   wcacmc_send_api_activecomp($value_emailformdb);
}



?>
<h3>Plugin settings</h3>
<style>
.wooc-help-plug{
 margin-left: 60px;
}
.wooc-help-plug::after {
    font-family: Dashicons;
    speak: none;
    font-weight: 400;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
   text-align: center;
    content: "";
    cursor: help;
    font-variant: normal;
    margin: 0px;
}
.wrapper-for-fb-checkbox-1{
    display: flex;
}

.wrapper-for-fb-id{
   line-height: 67px;
   width: 10%;
}

.wrapper-for-fb-input{
    width: 50%;
}

.wrapper-for-fb-checkbox-but{
   width: 26%;
   text-align: center;
}

.woocfacebook-save{
    width: 60%; 
     box-shadow: 0 0 5px 2px rgba(34, 139, 34, 0.4);
}

</style>
<form method='post' style='position: relative'>
<input type="checkbox" class='woocfacebook' name="woocfacebook" value="fbtrue" <?php checked( $value_fb, 'fbtrue' ); ?>>Add Facebook checkbox<br>
    <div class='wrapper-for-fb-checkbox'>
        <div class='wrapper-for-fb-checkbox-1'>
                  <div class='wrapper-for-fb-id'>Your app Id:</div>  
                  <div class='wrapper-for-fb-input'>
                     <span class="wooc-help-plug" title='Get this from Grow tab (Chatfuel bot platform) or Facebook App settings (custom bot). Check plugin FAQ for details.'></span> <input type="text" style="margin: 20px; " name="woocappId" id="setting-input" value="<?php esc_attr_e($app_id); ?>"><br>
                  </div>
        </div>
   
        <div class='wrapper-for-fb-checkbox-1'>
                  <div class='wrapper-for-fb-id'>Your page Id:</div> 
                  <div class='wrapper-for-fb-input'>
                       <span class="wooc-help-plug" title='Get this from Grow tab (Chatfuel bot platform) or Facebook Page settings (custom bot). Check plugin FAQ for details.'></span> <input type="text" style="margin: 20px; " name="woocpageId" id="setting-input" value="<?php esc_attr_e($page_id); ?>"><br>
                  </div>
        </div>
        <div class='wrapper-for-fb-checkbox-1'>
                  <div class='wrapper-for-fb-id'>Plugin size</div>
                  <div class='wrapper-for-fb-input'>
                       <span class="wooc-help-plug" title='Size of Send to Messenger checkbox. Adapt to your shop design.'></span>
                       <select class='select-fb-change' style="margin: 20px; " name="taskOption">
                            <option value="<?php esc_attr_e($size); ?>"><?php esc_attr_e($size); ?></option>
                            <option value="standard">Standard</option>
                            <option value="large">Large</option>
                            <option value="xlarge">Xlarge</option>
                       </select><br>
                  </div>
 
      </div>

  </div>
<hr style='width: 90%;
    position: relative;
    left: -100px;'>
          <input type="checkbox" class='wooctelegram' name="wooctelegram" value="telegtrue" <?php checked( $value_teleg, 'telegtrue' ); ?>>Add Telegram checkbox<br>

      <div class='woo-bot-name'> 
              <div class='wrapper-for-fb-checkbox-1'>
                       <div class='wrapper-for-fb-id'>Your bot url:</div>
                       <div class='wrapper-for-fb-input'>
                             <span class="wooc-help-plug" title='Link to your bot on Telegram'></span>
                             <input type="text" style="margin: 20px; width: 224px;" name="woocnamebot" id="setting-input" value="<?php _e(esc_url($value_teleg_bot)); ?>">
                       </div>
              </div>
        </div>

<hr style='width: 90%;
    position: relative;
    left: -100px;'>

            <script>
              jQuery(document).ready(function( $ ) {

                   var inputAdmin = document.querySelectorAll('#setting-input');
                   
                        function changeshadowbutton() {
                                     $('.woocfacebook-save').css("box-shadow", "0 0 5px 2px rgba(240, 128, 128, 0.4)")
                                     $('.woocfacebook-save').val('Save');
                                    };
                         
                        document.querySelector('.select-fb-change').onchange = changeshadowbutton;
                     for(var i = 0; i<inputAdmin.length; i++){
                              
                             inputAdmin[i].oninput = changeshadowbutton;
                                
                        }
                      
                        
          if(document.querySelector('.wooctelegram').checked == true){
                                             $('.woo-bot-name').show();
                                             }else if(document.querySelector('.wooctelegram').checked == false){
                                             $('.woo-bot-name').hide();
                                           }
                          



                      $('.wooctelegram').on('click', function() {
                          changeshadowbutton();
                                     if(document.querySelector('.wooctelegram').checked == true){
                                             $('.woo-bot-name').slideDown();
                                             }else if(document.querySelector('.wooctelegram').checked == false){
                                             $('.woo-bot-name').slideUp();
                                           }
                                           
                                       
              });



                                  if(document.querySelector('.woocfacebook').checked == true){
                                             $('.wrapper-for-fb-checkbox').show();
                                             }else if(document.querySelector('.woocfacebook').checked == false){
                                             $('.wrapper-for-fb-checkbox').hide();
                                           }
          
          $('.woocsubscribe').on('click', function() {
                           changeshadowbutton();
                     });
                          



                                 $('.woocfacebook').on('click', function() {
                           changeshadowbutton();
                                     if(document.querySelector('.woocfacebook').checked == true){
                                             $('.wrapper-for-fb-checkbox').slideDown();
                                             }else if(document.querySelector('.woocfacebook').checked == false){
                                             $('.wrapper-for-fb-checkbox').slideUp();
                                           }
                   
                   
                   
                                           
                                       
              });
  
                    })
            </script>
<div class='subscrib-wrap' style='display: flex; height: 67px;'>
       <div class='subscrib-checkbox' style='width: 10%; line-height: 67px;'> <input type="checkbox" class='woocsubscribe' name="woocsubscribe" value="subscrtrue" <?php checked( $value_subscribe, 'subscrtrue' ); ?>>
        Subscribe</div>
       <div class='subscrib-input' style='width: 50%; line-height: 67px;'> <span class="wooc-help-plug" title='Subscribe to our newsletter'></span><input style='margin: 20px; width: 224px;' type="text" name='user_email' value='<?php _e(sanitize_email($value_emailformdb)) ?>'></div>
</div>

        <div     style='margin-top: 25px;' class='wrapper-for-fb-checkbox-but'><input  class="woocfacebook-save" type='submit' value='Saved'></div>
        <a target="_blank" style='position: absolute; top: 0; right: 100px;' href='https://www.facebook.com/groups/activechatai/'><img src='<?php _e(esc_url(plugins_url("/webnoodle.png",__FILE__))) ?>'  ><a>
 </form>




 <style >
  
   

 </style>

