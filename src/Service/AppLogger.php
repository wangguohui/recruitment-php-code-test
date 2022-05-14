<?php

namespace App\Service;

use think\facade\Log;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';
    const TYPE_THINK_LOG = 'think-log';

    private $type;
    private $logger;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        if ($type == self::TYPE_LOG4PHP) {
            $this->logger = \Logger::getLogger("Log");
        } else if ($type == self::TYPE_THINK_LOG) {
            Log::init([
                'default'	=>	'file',
                'channels'	=>	[
                    'file'	=>	[
                        'type'	=>	'file',
                        'path'	=>	'./logs/',
                    ],
                ],
            ]);
            $this->logger = Log::channel('file');
            $this->type = self::TYPE_THINK_LOG;
        }
    }

    public function __call($name, $arguments)
    {
        if ($this->type == self::TYPE_THINK_LOG && in_array($name, ['info', 'error', 'debug'])) {
            $arguments[0] = strtoupper($arguments[0]);
        }

        call_user_func_array([$this->logger, $name], $arguments);
    }
}