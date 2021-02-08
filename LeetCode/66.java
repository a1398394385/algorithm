class Solution
{
    public int[] plusOne(int[] digits) {
        int[] result = new int[digits.length + 1];
        int temp = 1;
        for (int i = digits.length - 1; i >= 0; i--) {
            result[i + 1] = (digits[i] + temp) % 10;
            temp = (digits[i] + temp) / 10;
            digits[i] = result[i + 1];
        }
        result[0] = temp;
        if (temp != 0) return result;
        return digits;
    }
}
