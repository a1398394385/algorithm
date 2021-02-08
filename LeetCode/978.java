class Solution
{
    public int maxTurbulenceSize(int[] arr) {
        if (arr.length == 1) return 1;
        int result = 1;
        for (int i = 0; i < arr.length - 1; i++) {
            if (arr[i] == arr[i + 1]) continue;
            int temp = dp(i + 1, arr, arr[i] < arr[i + 1]);
            result = Math.max(temp + 1, result);
            i += temp - 1;
        }
        return result;
    }

    int dp(int index, int[] arr, boolean flag) {
        if (index == arr.length - 1 || arr[index] == arr[index + 1]) return 1;
        if (arr[index] > arr[index + 1] == flag) return dp(index + 1, arr, !flag) + 1;
        return 1;
    }

    public int maxTurbulenceSize1(int[] arr) {
        if (arr.length == 1) return 1;
        if (arr.length == 2) return arr[1] != arr[0] ? 2 : 1;

        int a, b = 0;
        int max = a = arr[1] != arr[0] ? 2 : 1;
        for (int i = 2; i < arr.length; i++) {
            if (arr[i] < arr[i - 1] && arr[i - 1] > arr[i - 2] || arr[i] > arr[i - 1] && arr[i - 1] < arr[i - 2]) {
                b = a + 1;
            } else if (arr[i] != arr[i - 1]) {
                b = 2;
            }
            max = Math.max(max, b);
            a = b;
        }
        return max;
    }
}
