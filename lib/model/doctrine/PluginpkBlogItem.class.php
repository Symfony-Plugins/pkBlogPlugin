<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginpkBlogItem extends BasepkBlogItem
{
  public function getPermalink()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
    return url_for('pk_blog_post', $this, false);
  }
  
  /**
   * Used by the pkContextCMS search action.
   */
  public function getUrl()
  {
    return $this->getPermalink();
  }

  /**
   * These date methods are use in the routing of the permalink
   */
  public function getYear()
  {
    return date('Y', strtotime($this->getPublishedAt()));
  }

  public function getMonth()
  {
    return date('m', strtotime($this->getPublishedAt()));
  }

  public function getDay()
  {
    return date('d', strtotime($this->getPublishedAt()));
  }

  public function getFeedSlug()
  {
    return $this->slug;
  }
  
	public function getSearchSummary()
	{
    return pkString::limitWords(strip_tags($this->getExcerpt()), 100, "...");
	}
  
  public function updateLuceneIndex()
  {
    // TODO: this isn't really good enough, the blog plugin needs to be i18n'd
    $culture = sfConfig::get('sf_default_culture', 'en');
    $title = $this->getTitle();
    $body = $this->getBody();
    $categoryName = $this->getCategory()->getName();
    $tags = $this->getTags();
    $summary = $this->getSearchSummary();
    $link = $this->getPermalink();
    // For reasons I don't understand it's not letting me search for stuff that
    // appears in the title field when I pass the indexed fields individually
    $text = $title . ' ' . $body . ' ' . $categoryName . ' ' . implode(", ", $tags);
    pkZendSearch::updateLuceneIndex($this, array(
      'text' => $text
//      'title' => $title,
//      'body' => $body,
//      'category' => $categoryName,
//      'tags' => implode(", ", $tags)
      ), $culture, array(
      'title' => $title,
      'summary' => $summary,
      'url' => $link));
  }
  
  public function togglePublish()
  {
    $this->setPublished(($this->getPublished()) ? 0 : 1);
    
    return $this->getPublished();
  }
  
  public function preSave($event)
  {
    if (in_array('published', $this->getModified()))
    {
      $this->setPublishedAt(date('Y-m-d H:i:s'));
    }
  }

  public function postSave($event)
  {
    $this->updateLuceneIndex();
  }

  /**
   * Returns the image for use in a template that highlights featured articles.
   * If there are embedded images in the description of the news article, this will
   * will retrieve the first of those images.
   *
   * If there are items from pkMediaPlugin that have specifically been attached to 
   * the article, then we are going to return the first of those instead.
   */
  public function getFeaturedImage()
  {
    // waiting for tom: https://trac.aas.duke.edu/ticket/270
    foreach ($this->getAttachedMedia() as $media)
    {
      if ($media->type = 'image')
      {
        $image = array();
        $image['src'] = $media->originalImage;
        $image['alt'] = $media->slug;
        $image['width'] = $media->width;
        $image['height'] = $media->height;
        
        return $image;
      }
    }
    
    if ($embedded_images = $this->getEmbeddedImages())
    {
      return $embedded_images[0];
    }
    
    return false;
  }

  /**
   * Uses a nice regular expression to return an array of all image tags in 
   * the article's description. Some RSS feeds will give us rather robust 
   * HTML, and we want to be able to use that as much as possible.
   *
   * @param string $format Images can be returned as their original HTML
   * tags or as arrays of image information.
   * @return array|false 
   *
   * TBB: implementation merged into pkToolkitPlugin's pkHtml class
   */
  public function getEmbeddedImages($format = 'array')
  {
    return pkHtml::getImages($this->description, $format);
  }
  
  public function getAttachedMedia()
  {
    if (strlen($this->media))
    {
      return unserialize($this->media);
    }
  
    return array();
  }

  public function getAttachedImages()
  {
    $media = $this->getAttachedMedia();
    
    $images = array();
    foreach ($media as $item)
    {
      if ($item->type == 'image')
      {
        $images[] = $item;
      }
    }

    return $images;
  }

  public function getAttachedVideos()
  {
    $media = $this->getAttachedMedia();
    
    $videos = array();
    foreach ($media as $item)
    {
      if ($item->type == 'video')
      {
        $videos[] = $item;
      }
    }
    
    return $videos;
  }
  
  public function getAttachedMediaIds()
  {
    $itemIds = array();
    foreach ($this->getAttachedMedia() as $item)
    {
      $itemIds[] = $item->id;
    }
    
    return $itemIds;
  }

  public function userHasPrivilege($privilege, $user = false)
  {
    if ($user === false)
    {
      if (!sfContext::getInstance())
      {
        // The absence of a context means we're running as a task and
        // should have full privileges
        return true;
      }
      $user = sfContext::getInstance()->getUser();
    }
    if ($privilege === 'view')
    {
      return true;
    }
    if ($user->hasCredential('blog_admin'))
    {
      return true;
    }
    if (!$user->hasCredential('blog_author'))
    {
      return false;
    }
    $guardUser = $user->getGuardUser();
    if (!$guardUser)
    {
      return false;
    }
    if ($this->getAuthorId() === $guardUser->getId())
    {
      return true;
    }
    return false;
  }
  
  public function save(Doctrine_Connection $conn = null)
  {
    if (!$this->userHasPrivilege('edit'))
    {
      throw new sfException("User does not have editing privileges");      
    }
    $result = parent::save($conn);
    return $result;
  }
  
  public function delete(Doctrine_Connection $conn = null)
  {
    if (!$this->userHasPrivilege('edit'))
    {
      throw new sfException("User does not have editing privileges");      
    }
    $result = parent::delete($conn);
    return $result;
  }
  
}