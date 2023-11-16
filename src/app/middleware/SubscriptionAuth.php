<?php

class SubscriptionAuth {
    public function isSubscribeAccept($studioID) 
    {
        if (!isset($_SESSION['user_id']))
        {
            throw new Exception('Unauthorized', STATUS_UNAUTHORIZED);
        }

        $userID = $_SESSION['user_id'];
        
        $subscription = Utils::model("Subscription");
        $subs = $subscription->getSubscription($studioID, $userID, 'ACCEPTED');
        
        if (!$subs) {
            throw new Exception('Forbidden', 403);
        }
    }
}