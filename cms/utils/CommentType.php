<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.02.14
 * Time: 8:48
 */

class CommentType extends Enum
{
    /* @var CommentType $toProduce */
    public static $toProduce;
    /* @var CommentType $toArticle */
    public static $toArticle;
    /* @var CommentType $toQuestion */
    public static $toQuestion;
    /* @var CommentType $question */
    public static $question;
    /* @var CommentType $answer */
    public static $answer;

    public static function enumerate()
    {
        self::$toProduce = new CommentType(1, "toProduce");
        self::$toArticle = new CommentType(2, "toArticle");
        self::$toQuestion = new CommentType(3, "toQuestion");
        self::$question = new CommentType(4, "question");
        self::$answer = new CommentType(5, "answer");
    }
}