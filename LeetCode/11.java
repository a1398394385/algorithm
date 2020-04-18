class Solution {
    public int maxArea(int[] height) {
        int length = height.length;
        int max = 0, left = 0, right = length - 1;
        for (; left < right;) {
            max = Math.max(max, Math.min(height[left], height[right]) * (right - left));
            if (height[left] > height[right]) {
                right--;
            } else {
                left++;
            }
        }
        return max;
    }
}
