import java.util.Hashtable;

class Solution
{
    public int subarraysDivByK(int[] A, int K) {
        int[] map = new int[K];
        map[0] += 1;
        int prefix = 0, res = 0;
        for (int a : A) {
            prefix = (a + prefix) % K;
            if (prefix < 0) prefix += K;
            res += map[prefix]++;
        }
        return res;
    }
}
