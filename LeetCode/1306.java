class Solution
{
    public boolean canReach(int[] arr, int start) {
        int length = arr.length;
        boolean[] dp = new boolean[length];
        for (int i = 0; i < length; i++) {
            if (arr[i] == 0) dp[i] = true;
        }
        for (int i1 = 0; i1 < length; i1++) {
            for (int i2 = 0; i2 < length; i2++) {
                boolean left = i2 - arr[i2] >= 0 ? dp[i2 - arr[i2]] : false;
                boolean right = i2 + arr[i2] < length ? dp[i2 + arr[i2]] : false;
                dp[i2] = left || right;
            }
        }
        return dp[start];
    }

    public boolean canReach1(int[] arr, int start) {
        boolean[] visited = new boolean[arr.length];
        return dfs(arr, start, visited);
    }

    private boolean dfs(int[] arr, int start, boolean[] visited) {
        if (arr[start] == 0) { return true; }
        visited[start] = true;

        int left = start - arr[start];
        if (left >= 0 && !visited[left] && dfs(arr, left, visited)) { return true; }
        int right = start + arr[start];
        if (right < arr.length && !visited[right] && dfs(arr, right, visited)) { return true; }

        return false;
    }

    public boolean canReach2(int[] arr, int start) {
        if (start >= arr.length || start < 0) return false;
        if (arr[start] < 0) return false;
        if (arr[start] == 0) return true;
        int l = arr[start] + start;
        int r = start - arr[start];
        arr[start] *= -1;
        return canReach2(arr, l) || canReach2(arr, r);
    }

    public static void main(String[] args) {
        Solution test = new Solution();
        test.canReach1(new int[] {4, 2, 3, 0, 3, 1, 2}, 5);
    }
}
