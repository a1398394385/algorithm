import java.util.Comparator;
import java.util.PriorityQueue;

class Solution
{
    public int kthSmallest(int[][] matrix, int k) {
        int n = matrix.length - 1;
        int l = matrix[0][0], r = matrix[n][n];
        while (l < r) {
            int mid = l + (r - l) / 2;
            int count = countNoMoreThanMid(matrix, mid, n);
            if (count < k)
                l = mid + 1;
            else
                r = mid;
        }
        return r;
    }

    public int countNoMoreThanMid(int[][] matrix, int mid, int n) {
        int x = n, y = 0, count = 0;
        while (x >= 0 && y <= n) {
            if (matrix[x][y] <= mid) {
                count += x + 1;
                ++y;
            } else {
                --x;
            }
        }
        return count;
    }

    public int kthSmallest1(int[][] matrix, int k) {
        PriorityQueue<int[]> pq = new PriorityQueue<int[]>(new Comparator<int[]>() {
            public int compare(int[] a, int[] b) {
                return a[0] - b[0];
            }
        });
        int n = matrix.length;
        for (int i = 0; i < n; i++) {
            pq.add(new int[] {matrix[i][0], i, 0});
        }
        for (int i = 0; i < k - 1; i++) {
            int[] now = pq.poll();
            int x = now[1], y = now[2];
            if (now[2] != n - 1) {
                pq.add(new int[] {matrix[x][y + 1], x, y + 1});
            }
        }
        return pq.poll()[0];
    }

    public int kthSmallest2(int[][] matrix, int k) {
        int len = matrix.length;
        int left = matrix[0][0], right = matrix[len - 1][len - 1];
        while (left < right) {
            int i = 0, j = len - 1, sum = 0, mid = (left + right) / 2;
            while (i < len && j >= 0) {
                if (matrix[i][j] <= mid) {
                    sum += j + 1;
                    ++i;
                } else {
                    --j;
                }
            }
            if (sum < k)
                left = mid + 1;
            else
                right = mid;
        }
        return left;
    }
}
