class TreeNode
{
    int val;
    TreeNode left;
    TreeNode right;

    TreeNode(int x) {
        val = x;
    }
}


class Solution
{
    public TreeNode sortedArrayToBST(int[] nums) {
        return dfs(0, nums.length - 1, nums);
    }

    public TreeNode dfs(int left, int right, int[] nums) {
        if (right < left) return null;
        int mid = left + ((right - left) >>> 1);
        TreeNode root = new TreeNode(nums[mid]);
        root.left = dfs(left, mid - 1, nums);
        root.right = dfs(mid + 1, right, nums);
        return root;
    }
}
