class Solution
{
    public static int myAtoi(String str) {
        str = str.trim();
        if (str.length() == 0) return 0;
        int sign = 1;
        StringBuilder value = new StringBuilder();
        if (str.charAt(0) == '+' || str.charAt(0) == '-') {
            sign = str.charAt(0) == '+' ? 1 : -1;
        } else if (str.charAt(0) >= '0' && str.charAt(0) <= '9') {
            value.append(str.charAt(0));
        } else {
            return 0;
        }

        for (int i = 1, len = str.length(); i < len; i++) {
            if (str.charAt(i) < '0' || str.charAt(i) > '9')
                break;
            value.append(str.charAt(i));
        }

        int number = 0;
        for (int len = value.length(); number < len && value.charAt(number) == '0';) number++;
        if (value.length() - number > 10)
            return sign > 0 ? Integer.MAX_VALUE : Integer.MIN_VALUE;

        long result = 0, ans = 1;
        for (int i = value.length() - 1; i >= 0; i--, ans *= 10)
            result += (value.charAt(i) - '0') * ans;
        result *= sign;
        result = result > Integer.MAX_VALUE ? Integer.MAX_VALUE : result;
        result = result < Integer.MIN_VALUE ? Integer.MIN_VALUE : result;
        return (int) result;
    }

    public int myAtoi1(String str) {
        char[] s = str.toCharArray();
        int i = 0;
        int sign = 1, result = 0, temp = 0;
        while (i < s.length && s[i] == ' ') {
            i++;
        }
        if (i < s.length && s[i] == '+') {
            i++;
        } else if (i < s.length && s[i] == '-') {
            sign = -1;
            i++;
        }
        while (i < s.length && s[i] >= '0' && s[i] <= '9') {
            if (temp > (Integer.MAX_VALUE - (s[i] - '0')) / 10) {
                return sign > 0 ? Integer.MAX_VALUE : Integer.MIN_VALUE;
            }
            result = temp * 10 + s[i] - '0';
            temp = result;
            i++;
        }
        return sign > 0 ? result : -result;
    }
}
