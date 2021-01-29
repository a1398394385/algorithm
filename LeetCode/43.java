class Solution
{
    public String multiply(String num1, String num2) {
        if (num1.length() == 0) return num2;
        if (num2.length() == 0) return num1;
        if ("0".equals(num1) || "0".equals(num2)) return "0";
        char[] chars1 = new StringBuilder(num1).reverse().toString().toCharArray(),
                chars2 = new StringBuilder(num2).reverse().toString().toCharArray();
        int[] res = new int[chars1.length + chars2.length];
        for (int i = 0; i < chars1.length; i++) {
            for (int j = 0; j < chars2.length; j++) {
                int index = i + j;
                res[index] += (chars1[i] - '0') * (chars2[j] - '0');
                while (res[index] > 9) {
                    res[index + 1] += res[index] / 10;
                    res[index] = res[index] % 10;
                    index++;
                }
            }
        }
        StringBuilder sbl = new StringBuilder();
        int index = res.length - 1;
        while (index >= 0 && res[index] == 0) index--;
        for (; index >= 0; index--) {
            sbl.append(res[index]);
        }
        return "".equals(sbl.toString()) ? "0" : sbl.toString();
    }

    public String multiply1(String num1, String num2) {
        if (num1.length() == 0) return num2;
        if (num2.length() == 0) return num1;
        if ("0".equals(num1) || "0".equals(num2)) return "0";
        char[] chars1 = num1.toCharArray(), chars2 = num2.toCharArray();
        int[] res = new int[chars1.length + chars2.length - 1];
        for (int i = 0; i < chars1.length; i++) {
            for (int j = 0; j < chars2.length; j++) {
                res[i + j] += (chars1[i] - '0') * (chars2[j] - '0');
            }
        }
        StringBuilder sbl = new StringBuilder();
        int temp = 0;
        for (int i = res.length - 1; i >= 0; i--) {
            sbl.append((res[i] + temp) % 10);
            temp = (res[i] + temp) / 10;
        }
        while (temp != 0) {
            sbl.append(temp % 10);
            temp /= 10;
        }
        return sbl.reverse().toString();
    }
}
