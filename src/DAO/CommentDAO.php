<?php

namespace MicroCMS\DAO;

use MicroCMS\Domain\Comment;

class CommentDAO extends DAO 
{
    /**
     * @var \MicroCMS\DAO\ArticleDAO
     */
    protected $reservationDAO;

    public function setReservationDAO($reservationDAO) {
        $this->reservationDAO = $reservationDAO;
    }

    /**
     * Return a list of all comments for an article, sorted by date (most recent first).
     *
     * @param $articleId The article id.
     *
     * @return array A list of all comments for the article.
     */
    public function findAllByReservation($reservationId) {
        $sql = "select * from COMMENT where NUM_RESA=? order by COM_ID";
        $result = $this->getDb()->fetchAll($sql, array($reservationId));

        // Convert query result to an array of Comment objects
        $comments = array();
        foreach ($result as $row) {
            $comId = $row['COM_ID'];
            $comments[$comId] = $this->buildDomainObject($row);
        }
        return $comments;
    }

    /**
     * Creates an Comment object based on a DB row.
     *
     * @param array $row The DB row containing Comment data.
     * @return \MicroCMS\Domain\Comment
     */
    protected function buildDomainObject($row) {
        // Find the associated article
        $reservationId = $row['NUM_RESA'];
        $reservation = $this->reservationDAO->find($reservationId);

        $comment = new Comment();
        $comment->setId($row['COM_ID']);
        $comment->setUserId($row['USER_ID']);
        $comment->setContent($row['COM_CONTENT']);
        $comment->setReservation($row['NUM_RESA']);
        return $comment;
    }
}