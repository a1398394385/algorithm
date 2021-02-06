class Solution
{
    public int[] fairCandySwap(int[] A, int[] B) {
        int diff = 0;
        boolean[] flags = new boolean[100001];
        for (int num : A)
            diff -= num;
        for (int num : B) {
            diff += num;
            flags[num] = true;
        }
        diff /= 2;
        for (int num : A) {
            int numB = num + diff;
            if (numB > 0 && numB < 100001 && flags[numB])
                return new int[] {num, num + diff};
        }
        return null;
    }
}
