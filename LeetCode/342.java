class Solution
{

    public boolean isPowerOfFour(int num) {
        if (num < 0 || (num & (num - 1)) != 0) return false;
        return num % 3 == 1;
    }

    public boolean isPowerOfFour1(int num) {
        return (num == 0x00000001) ||
                (num == 0x00000004) ||
                (num == 0x00000010) ||
                (num == 0x00000040) ||
                (num == 0x00000100) ||
                (num == 0x00000400) ||
                (num == 0x00001000) ||
                (num == 0x00004000) ||
                (num == 0x00010000) ||
                (num == 0x00040000) ||
                (num == 0x00100000) ||
                (num == 0x00400000) ||
                (num == 0x01000000) ||
                (num == 0x04000000) ||
                (num == 0x10000000) ||
                (num == 0x40000000);
    }
}
