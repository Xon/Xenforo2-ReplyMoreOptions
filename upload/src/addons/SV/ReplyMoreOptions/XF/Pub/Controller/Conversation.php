<?php

namespace SV\ReplyMoreOptions\XF\Pub\Controller;

use XF\Mvc\ParameterBag;

/**
 * Extends \XF\Pub\Controller\Conversation
 */
class Conversation extends XFCP_Conversation
{
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