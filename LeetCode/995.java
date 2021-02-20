import java.util.Deque;
import java.util.LinkedList;

class Solution
{
    /**
     * 贪心
     */
    public int minKBitFlips(int[] nums, int k) {
        int n = nums.length;
        int ans = 0;
        for (int i = 0; i < n; i++) {
            if (nums[i] == 0) {
                if (i + k > n) return -1;
                for (int j = i; j < i + k; j++) nums[j] ^= 1;
                ans++;
            }
        }
        return ans;
    }

    /**
     * 贪心 + 差分数组
     */
    public int minKBitFlips1(int[] nums, int k) {
        int n = nums.length;
        int ans = 0;
        int[] arr = new int[n + 1];
        for (int i = 0, cnt = 0; i < n; i++) {
            cnt += arr[i];
            if ((nums[i] + cnt) % 2 == 0) {
                if (i + k > n) return -1;
                arr[i + 1]++;
                arr[i + k]--;
                ans++;
            }
        }
        return ans;
    }

    /**
     * 贪心 + 滑动窗口
     */
    public int minKBitFlips2(int[] A, int K) {
        int res = 0;
        Deque<Integer> que = new LinkedList<>();
        for (int i = 0; i < A.length; i++) {
            if (que.size() > 0 && i > que.peek() + K - 1) {
                que.removeFirst();
            }
            // 1.本来是1，翻转奇数次变为0，所以需要再次翻转，放入队列
            // 2.本来是0，翻转偶数次还是0，所以需要再次翻转，放入队列
            if (que.size() % 2 == A[i]) {
                if (i + K > A.length) return -1;
                que.add(i);
                res += 1;
            }
        }
        return res;
    }

}
