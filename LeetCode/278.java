public class Solution extends VersionControl
{
    public int firstBadVersion(int n) {
        if (isBadVersion(1)) return 1;
        int left = 1, right = n;
        while (left < right) {
            int mid = left + ((right - left) >> 1);
            if (isBadVersion(mid)) {
                right = mid;
            } else {
                left = mid + 1;
            }
        }
        return right;
    }

    public boolean isBadVersion(int version) {
        return true;
    }
}


