class Solution
{
    public int majorityElement(int[] nums) {

        // 摩尔投票
        int count = 0;
        Integer card = null;
        for (int num : nums) {
            if (count == 0) card = num;
            count += (card == num) ? 1 : -1;
        }
        return card;
    }
}
