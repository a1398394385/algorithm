import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.List;

class Solution
{
    public static List<Integer> addToArrayForm(int[] A, int K) {
        List<Integer> result = new ArrayList<>();
        int carry = 0, index = A.length - 1, temp;
        while (K > 0 || carry != 0) {
            temp = index < 0 ? 0 : A[index--];
            temp += (K % 10) + carry;
            carry = temp / 10;
            result.add(temp % 10);
            K /= 10;
        }
        while (index >= 0) {
            result.add(A[index--]);
        }
        Collections.reverse(result);
        return result;
    }
}
