import java.util.ArrayList;
import java.util.Comparator;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.PriorityQueue;
import java.util.Queue;

class Twitter
{
    /**
     * 用户关注列表
     */
    private Map<Integer, List<Integer>> userAttentions;
    /**
     * 用户发推列表
     */
    private Map<Integer, List<Integer>> userTweets;
    /**
     * 推特对应时间表
     */
    private Map<Integer, Integer> TweetPriority;
    /**
     * 大顶堆
     */
    private Queue<Integer> queue;
    /**
     * 当前时间
     */
    private int time;

    public Twitter() {
        this.userAttentions = new HashMap<Integer, List<Integer>>();
        this.userTweets = new HashMap<Integer, List<Integer>>();
        this.TweetPriority = new HashMap<Integer, Integer>();
        this.queue = new PriorityQueue<Integer>(new Comparator<Integer>() {
            @Override
            public int compare(Integer o1, Integer o2) {
                return o2 - o1;
            }
        });
        this.time = 0;
    }

    public void userExistsOrInit(int userId) {
        if (this.userAttentions.containsKey(userId) == false) {
            List<Integer> attentions = new ArrayList<Integer>();
            attentions.add(userId);
            List<Integer> tweets = new ArrayList<Integer>();
            this.userAttentions.put(userId, attentions);
            this.userTweets.put(userId, tweets);
        }
    }

    public void postTweet(final int userId, final int tweetId) {
        this.userExistsOrInit(userId);
        this.userTweets.get(userId).add(this.time);
        this.TweetPriority.put(this.time, tweetId);
        this.time += 1;
    }

    public List<Integer> getNewsFeed(final int userId) {
        this.userExistsOrInit(userId);
        this.queue.clear();
        List<Integer> result = new ArrayList<Integer>();
        for (int i : this.userAttentions.get(userId)) {
            if (this.userTweets.get(i) != null)
                this.queue.addAll(this.userTweets.get(i));
        }
        for (int i = 0; i < 10 && !queue.isEmpty(); i++) {
            result.add(this.TweetPriority.get(queue.poll()));
        }
        return result;
    }

    public void follow(final int followerId, final int followeeId) {
        this.userExistsOrInit(followerId);
        List<Integer> attentions = this.userAttentions.get(followerId);
        if (attentions.contains(followeeId) == false) {
            attentions.add(followeeId);
        }
    }

    public void unfollow(final int followerId, final int followeeId) {
        this.userExistsOrInit(followerId);
        if (followerId != followeeId) {
            List<Integer> attentions = this.userAttentions.get(followerId);
            if ((attentions.contains(followeeId)) == true) {
                attentions.remove(new Integer(followeeId));
            }
        }
    }
}
