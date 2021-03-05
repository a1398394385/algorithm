class Solution
{
    public int[] countBits(int num) {
        int[] result = new int[num + 1];
        for (int i = 1; i <= num; i++) {
            result[i] = swar(i);
        }
        return result;
    }

    public int swar(int num) {
        num = (num & 0x55555555) + ((num >> 1) & 0x55555555);
        num = (num & 0x33333333) + ((num >> 2) & 0x33333333);
        num = (num & 0x0F0F0F0F) + ((num >> 4) & 0x0F0F0F0F);
        num = (num * (0x01010101) >> 24);
        return num;
    }

    public int[] countBits1(int num) {
        int[] ans = new int[num + 1];
        for (int i = 1; i < num + 1; i++)
            ans[i] = ans[(i & (i - 1))] + 1;
        return ans;
    }
}

