<?php
    /**
     * Copyright 2014 RatingWidget, Inc.
     *
     * Licensed under the GPL v2 (the "License"); you may
     * not use this file except in compliance with the License. You may obtain
     * a copy of the License at
     *
     *     http://choosealicense.com/licenses/gpl-v2/
     *
     * Unless required by applicable law or agreed to in writing, software
     * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
     * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
     * License for the specific language governing permissions and limitations
     * under the License.
     */
    namespace RatingWidget\Api\Sdk;

    define('RW_API__VERSION', '1');
    define('RW_API__ADRESS', 'http://api.rating-widget.com');
    define('RW_SDK__PATH', dirname(__FILE__));
    define('RW_SDK__EXCEPTIONS_PATH', RW_SDK__PATH . '/exceptions/');
    
    if (!function_exists('json_decode'))
        throw new \Exception('RatingWidget needs the JSON PHP extension.');
    
    // Include all exception files.
    $exceptions = array(
        'Exception', 
        'InvalidArgumentException',
        'ArgumentNotExistException', 'EmptyArgumentException', 'OAuthException');
    
    foreach ($exceptions as $e)
        require RW_SDK__EXCEPTIONS_PATH . $e . '.php';
    
    class RatingWidgetBase
    {
        const VERSION = '1.0.2';
        const FORMAT = 'json';
        
        protected $_id;
        protected $_public;
        protected $_secret;
        protected $_scope;
        
        /**
        * @param string $pScope 'app', 'user' or 'site'
        * @param number $pID Element's id.
        * @param string $pPublic Public key.
        * @param string $pSecret App, User or Site secret key.
        */
        public function __construct($pScope, $pID, $pPublic, $pSecret)
        {
            $this->_id = $pID;
            $this->_public = $pPublic;
            $this->_secret = $pSecret;
            $this->_scope = $pScope;
        }

        protected function CanonizePath($pPath)
        {
            $pPath = trim($pPath, '/');
            
            switch ($this->_scope)
            {
                case 'app':
                    break;
                case 'user':
                    $pPath = '/users/' . $this->_id . (!empty($pPath) ? '/' . $pPath : '.' . self::FORMAT);
                    break;
                case 'site':
                    $pPath = '/sites/' . $this->_id . (!empty($pPath) ? '/' . $pPath : '.' . self::FORMAT);
                    break;
            }
            
            return '/v' . RW_API__VERSION . $pPath;
        }
        
        protected function GetUrl($pCanonizedPath)
        {
            return RW_API__ADRESS . $pCanonizedPath;
        }
    }