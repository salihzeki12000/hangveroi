<?php
/**
 * Copyright (c) 2014-present, Facebook, Inc. All rights reserved.
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
 *
 */

namespace FacebookAds\Http\Adapter\Curl;

class Curl55 extends AbstractCurl {

  /**
   * @throws \RuntimeException
   */
  public function __construct() {
    parent::__construct();
    if (version_compare(PHP_VERSION, '5.5.0') < 0) {
      throw new \RuntimeException("Unsupported Curl version");
    }
  }

  /**
   * @param string $string
   * @return bool|string
   */
  public function escape($string) {
    return curl_escape($this->handle, $string);
  }

  /**
   * @param int $bitmask
   * @return int
   */
  public function pause($bitmask) {
    return curl_pause($this->handle, $bitmask);
  }

  /**
   * @param string $filepath
   * @return \CURLFile
   */
  public function preparePostFileField($filepath) {
    return new \CURLFile($filepath);
  }

  /**
   * @return void
   */
  public function reset() {
    $this->handle && curl_reset($this->handle);
  }

  /**
   * @param int $errornum
   * @return NULL|string
   */
  public static function strerror($errornum) {
    return curl_strerror($errornum);
  }

  /**
   * @param string $string
   * @return bool|string
   */
  public function unescape($string) {
    return curl_unescape($this->handle, $string);
  }
}
