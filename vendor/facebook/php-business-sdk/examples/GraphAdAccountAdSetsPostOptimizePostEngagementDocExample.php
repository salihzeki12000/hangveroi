<?php
/**
 * Copyright (c) 2015-present, Facebook, Inc. All rights reserved.
 *
 * You are hereby granted a non-exclusive, worldwide, royalty-free license to
 * use, copy, modify, and distribute this software in source code or binary
 * form for use in connection with the web services and APIs provided by
 * Facebook.
 *
 * As with any software that integrates with the Facebook platform, your use
 * of this software is subject to the Facebook Developer Principles and
 * Policies [http://developers.facebook.com/policy/]. This copyright notice
 * shall be included in all copies or substantial portions of the software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 */

require __DIR__ . '/vendor/autoload.php';

use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdSet;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;

$access_token = '<ACCESS_TOKEN>';
$app_secret = '<APP_SECRET>';
$app_id = '<APP_ID>';
$id = '<ID>';

$api = Api::init($app_id, $app_secret, $access_token);
$api->setLogger(new CurlLogger());

$fields = array(
);
$params = array(
  'name' => 'My First Adset',
  'lifetime_budget' => '20000',
  'start_time' => '2018-08-09T18:06:15-0700',
  'end_time' => '2018-08-19T18:06:15-0700',
  'campaign_id' => '<adCampaignLinkClicksID>',
  'bid_amount' => '500',
  'billing_event' => 'IMPRESSIONS',
  'optimization_goal' => 'POST_ENGAGEMENT',
  'targeting' => array('geo_locations' => array('countries' => array('US'),'regions' => array(array('key' => '4081')),'cities' => array(array('key' => 777934,'radius' => 10,'distance_unit' => 'mile'))),'genders' => array(1),'age_max' => 24,'age_min' => 20,'behaviors' => array(array('id' => 6002714895372,'name' => 'All travelers')),'life_events' => array(array('id' => 6002714398172,'name' => 'Newlywed (1 year)')),'home_ownership' => array(array('id' => 6006371327132,'name' => 'Renters')),'publisher_platforms' => array('facebook'),'device_platforms' => array('desktop')),
  'status' => 'PAUSED',
);
echo json_encode((new AdAccount($id))->createAdSet(
  $fields,
  $params
)->getResponse()->getContent(), JSON_PRETTY_PRINT);