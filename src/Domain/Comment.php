<?php
/**
 * Created by PhpStorm.
 * User: seljo
 * Date: 09/02/2016
 * Time: 13:33
 */

namespace MicroCMS\Domain;


class Comment
{
    private $id;

    /**
     * Comment author.
     *
     * @var \MicroCMS\Domain\User
     */
    private $author;

    private $content;
    private $article;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }



}