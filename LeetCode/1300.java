import java.util.Arrays;

class Solution
{
    public int findBestValue(int[] arr, int target) {
        int big = 0;
        int sum = 0;
        for (int i : arr) {
            sum += i;
            big = i > big ? i : big;
        }
        if (sum <= target) return big;
        int ans = target / arr.length;
        sum = getSum(arr, ans);
        while (sum < target) {
            int sumn = getSum(arr, ans + 1);
            if (sumn >= target) return target - sum <= sumn - target ? ans : ans + 1;
            sum = sumn;
            ans++;
        }
        return 0;
    }

    public int getSum(int[] arr, int value) {
        int sum = 0;
        for (int i : arr) sum += i < value ? i : value;
        return sum;
    }

    public int findBestValue1(int[] arr, int target) {
        Arrays.sort(arr);
        int n = arr.length;
        int[] prefix = new int[n + 1];
        for (int i = 1; i <= n; ++i) {
            prefix[i] = prefix[i - 1] + arr[i - 1];
        }
        int r = arr[n - 1];
        int ans = 0, diff = target;
        for (int i = 1; i <= r; ++i) {
            int index = Arrays.binarySearch(arr, i);
            if (index < 0) {
                index = -index - 1;
            }
            int cur = prefix[index] + (n - index) * i;
            if (Math.abs(cur - target) < diff) {
                ans = i;
                diff = Math.abs(cur - target);
            }
        }
        return ans;
    }

    public int findBestValue2(int[] arr, int target) {
        Arrays.sort(arr);
        int len = arr.length;
        int curSum = 0;
        for (int i = 0; i < len; i++) {
            int curAve = (target - curSum) / (len - i);
            if (curAve <= arr[i]) {
                // 即判断curAve两边
                double curAveDou = (target * 1.0 - curSum) / (len - i);
                if (curAveDou - curAve <= 0.5) {
                    return curAve;
                } else {
                    return curAve + 1;
                }
            }
            curSum += arr[i];
        }
        return arr[len - 1];
    }

}

