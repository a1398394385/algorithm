<?php
require_once '../vendor/autoload.php';
class Twitter
{
    /**
     * 用户关注列表
     */
    private array $userAttentions;
    /**
     * 用户发推列表
     */
    private array $userTweets;
    /**
     * 当前时间
     */
    private int $time;

    public function __construct()
    {
        $this->userAttentions = [];
        $this->userTweets = [];
        $this->time = 0;
    }

    /**
     * 用户初始化
     *
     * @param int $userId
     * @return void
     */
    private function userExistsOrInit(int $userId): void
    {
        if (!isset($this->userAttentions[$userId])) {
            $this->userAttentions[$userId] = [$userId];
            $this->userTweets[$userId] = [];
        }
    }

    /**
     * Compose a new tweet.
     * @param Integer $userId
     * @param Integer $tweetId
     * @return NULL
     */
    public function postTweet(int $userId, int $tweetId): void
    {
        $this->userExistsOrInit($userId);
        $time = $this->time;
        $this->userTweets[$userId][] =  "$tweetId,$time";
        $this->time += 1;
    }

    /**
     * Retrieve the 10 most recent tweet ids in the user's news feed. Each item in the news feed must be posted by users who the user followed or by the user herself. Tweets must be ordered from most recent to least recent.
     * @param Integer $userId
     * @return Integer[]
     */
    public function getNewsFeed(int $userId): array
    {
        $this->userExistsOrInit($userId);
        $queue = new \SplPriorityQueue();
        $userIds = $this->userAttentions[$userId];
        $Tweets = [];
        foreach ($userIds as $userId) {
            array_push($Tweets, ...$this->userTweets[$userId]);
        }
        $count = count($Tweets);
        for ($i = 0; $i < $count; $i++) {
            $queue->insert(...explode(',', $Tweets[$i]));
        }
        $result = [];
        $i = 0;
        while ($i++ < 10 && $queue->count() != 0) {
            $result[] = $queue->extract();
        }
        return $result;
    }

    /**
     * Follower follows a followee. If the operation is invalid, it should be a no-op.
     * @param Integer $followerId
     * @param Integer $followeeId
     * @return NULL
     */
    public function follow(int $followerId, int $followeeId): void
    {
        $this->userExistsOrInit($followerId);
        if (in_array($followeeId, $this->userAttentions[$followerId]) === false) {
            array_push($this->userAttentions[$followerId], $followeeId);
        }
    }

    /**
     * Follower unfollows a followee. If the operation is invalid, it should be a no-op.
     * @param Integer $followerId
     * @param Integer $followeeId
     * @return NULL
     */
    public function unfollow(int $followerId, int $followeeId): void
    {
        $this->userExistsOrInit($followerId);
        if ($followerId != $followeeId) {
            if (in_array($followeeId, $this->userAttentions[$followerId]) === true) {
                $index = array_search($followeeId, $this->userAttentions[$followerId]);
                unset($this->userAttentions[$followerId][$index]);
            }
        }
    }
}

$twitter = new Twitter();
// 用户1发送了一条新推文 (用户id = 1, 推文id = 5)
$twitter->postTweet(1, 5);
// 用户1的获取推文应当返回一个列表，其中包含一个id为5的推文
var_dump($twitter->getNewsFeed(1));
// 用户1关注了用户2->
$twitter->follow(1, 2);
// 用户2发送了一个新推文 (推文id = 6)
$twitter->postTweet(2, 6);
// 用户1的获取推文应当返回一个列表，其中包含两个推文，id分别为 -> [6, 5]
// 推文id6应当在推文id5之前，因为它是在5之后发送的
var_dump($twitter->getNewsFeed(1));
// 用户1取消关注了用户2->
$twitter->unfollow(1, 2);
// 用户1的获取推文应当返回一个列表，其中包含一个id为5的推文
// 因为用户1已经不再关注用户2->
var_dump($twitter->getNewsFeed(1));
