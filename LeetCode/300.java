class Solution
{
    public static int lengthOfLIS(int[] nums) {
        int len = nums.length;
        if (len == 0) return 0;
        int[] dp = new int[len];
        dp[0] = 1;
        int result = 1;
        for (int i = 1; i < len; i++) {
            int max = 0;
            for (int j = 0; j < i; j++) {
                if (nums[i] > nums[j]) {
                    max = Math.max(max, dp[j]);
                }
            }
            dp[i] = max + 1;
            result = Math.max(result, dp[i]);
        }
        return result;
    }

    public static int lengthOfLIS1(int[] nums) {
        int len = nums.length;
        if (len <= 1) { return len; }

        /**
         * dp[x] = y
         * 
         * @x : 上升子序列的长度
         * @y : 当前子序列的末尾值
         */
        int[] dp = new int[len + 1];
        dp[1] = nums[0];
        // index : 当前最长上升子序列的长度,指向 dp 中最后一个不为0的数
        int index = 1;

        for (int i = 1; i < len; i++) {
            if (nums[i] > dp[index]) {
                dp[++index] = nums[i];
            } else {
                // 在 dp 中找到第 1 个大于等于 nums[i] 的元素,尝试让那个元素更小
                int left = 0, right = index;
                while (left < right) {
                    int mid = (right + left) >>> 1;
                    if (dp[mid] < nums[i])
                        left = mid + 1;
                    else
                        right = mid;
                }
                dp[left] = nums[i];
            }
        }
        return index;
    }

    public static void main(String[] args) {
        // int[] nums = new int[] {3, 5, 6, 2, 5, 4, 19, 5, 6, 7, 12};
        int[] nums = new int[] {2, 3, 5, 3, 5};
        System.out.println(Solution.lengthOfLIS(nums));
        System.out.println(Solution.lengthOfLIS1(nums));
    }
}

