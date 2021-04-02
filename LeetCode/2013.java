class Solution
{
    public int trap(int[] height) {
        int count = height.length;

        int[] left = new int[count], right = new int[count];
        for (int i = 1; i < count; i++)
            left[i] = left[i - 1] > height[i - 1] ? left[i - 1] : height[i - 1];
        for (int i = count - 2; i >= 0; i--)
            right[i] = right[i + 1] > height[i + 1] ? right[i + 1] : height[i + 1];

        int result = 0;
        for (int i = 0; i < count; i++) {
            int min = left[i] < right[i] ? left[i] : right[i];
            result += min - height[i] > 0 ? min - height[i] : 0;
        }
        return result;
    }
}
