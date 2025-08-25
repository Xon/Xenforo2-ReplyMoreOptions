<?php

namespace SV\ReplyMoreOptions\XF\Pub\Controller;

use XF\Mvc\ParameterBag;
use XF\Mvc\Reply\View as ViewReply;

/**
 * @extends \XF\Pub\Controller\Conversation
 */
class Conversation extends XFCP_Conversation
{
    public function actionIndex(ParameterBag $params)
    {
        $reply = parent::actionIndex($params);
        if ($reply instanceof ViewReply)
        {
            $reply->setParam('svMoreOptions', true);
        }
        return $reply;
    }

    public function actionAddReply(ParameterBag $params)
    {
        if ($this->filter('more_options', 'str'))
        {
            $this->actionDraft($params);
            return $this->rerouteController($this->rootClass, 'reply', $params);
        }
        else if (!$this->isPost())
        {
            return $this->rerouteController($this->rootClass, 'reply', $params);
        }

        return parent::actionAddReply($params);
    }
}