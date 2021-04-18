import java.util.Arrays;

class Solution
{
    public String largestNumber(int[] nums) {
        String[] numbers = new String[nums.length];
        for (int i = 0; i < nums.length; i++) numbers[i] = String.valueOf(nums[i]);
        Arrays.sort(numbers, (String num1, String num2) -> {
            String number1 = num1 + num2, number2 = num2 + num1;
            int len = number1.length();
            for (int i = 0; i < len; i++) {
                if (number1.charAt(i) == number2.charAt(i))
                    continue;
                else
                    return number2.charAt(i) - number1.charAt(i);
            }
            return 1;
        });
        if (numbers[0].equals("0")) return "0";
        StringBuilder result = new StringBuilder();
        for (int i = 0; i < numbers.length; i++) result.append(numbers[i]);
        return result.toString();
    }
}
