<?php

class pkBlogPluginTools
{
  // You too can do this in a plugin dependent on pkContextCMS, see the provided stylesheet 
  // for how to correctly specify an icon to go with your button. See the 
  // pkMediaCMSSlotsPluginConfiguration class for the registration of the event listener.
  static public function getGlobalButtons()
  {
    $user = sfContext::getInstance()->getUser();
    if ($user->hasCredential('blog_author') || $user->hasCredential('blog_admin'))
    {
      pkContextCMSTools::addGlobalButtons(array(
        new pkContextCMSGlobalButton('Blog', 'pkBlogPostAdmin/index', 'pk-blog'),
  			new pkContextCMSGlobalButton('Events', 'pkBlogEventAdmin/index', 'pk-events day-'.date('j'))
  		));
  	}
  }
}
