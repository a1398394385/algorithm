import java.util.Stack;

class Solution
{
    public static String decodeString(String s) {
        StringBuilder result = new StringBuilder(), str = new StringBuilder();
        Stack<Character> stack = new Stack<>();
        char[] chars = s.toCharArray();
        char temp;
        for (int i = chars.length - 1; i >= 0;) {
            if (chars[i] == ']') {
                stack.push(chars[i--]);
                while (stack.size() != 0) {
                    str = new StringBuilder();
                    StringBuilder number = new StringBuilder();
                    while ((temp = chars[i--]) != '[') stack.push(temp);
                    while (i >= 0 && chars[i] >= '0' && chars[i] <= '9') number.insert(0, chars[i--]);
                    while ((temp = stack.pop()) != ']') str.append(temp);
                    str.append(repeat(str.toString(), Integer.parseInt(number.toString()) - 1));
                    if (stack.size() != 0)
                        for (int idx = str.length() - 1; idx >= 0; idx--)
                            stack.push(str.charAt(idx));
                }
                result.insert(0, str);
            } else {
                result.insert(0, chars[i--]);
            }
        }
        return result.toString();
    }

    public static String repeat(String str, int num) {
        StringBuffer buf = new StringBuffer();
        for (int i = 0; i < num; i++)
            buf.append(str);
        return buf.toString();
    }

    public static void main(String[] args) {
        // System.out.println(decodeString("3[a2[c]]"));
        // System.out.println(decodeString("3[a]2[b4[F]c]"));
        System.out.println(decodeString("3[z]2[2[y]pq4[2[jk]e1[f]]]ef"));
    }

    ///// (O(n),O(n))
    // 当 s[i] == ']' 时，返回当前括号内记录的 res 字符串与 ] 的索引 i （更新上层递归指针位置）；
    // 当 s[i] == '[' 时，开启新一层递归，记录此 [...] 内字符串 tmp 和递归后的最新索引 i，并执行 res + multi * tmp 拼接字符串。
    // 遍历完毕后返回 res。
    public String decodeString1(String s) {
        return dfs(s, 0)[1];
    }

    private String[] dfs(String s, int i) {// 字符串s和索引i,返回字符数组，索引i和结果string
        StringBuilder res = new StringBuilder();
        int multi = 0;// 重复次数
        while (i < s.length()) {// 没有走到结尾时
            if (s.charAt(i) >= '0' && s.charAt(i) <= '9') {// 是数字
                multi = multi * 10 + Integer.parseInt(String.valueOf(s.charAt(i)));
                // 计算数字的值
            } else if (s.charAt(i) == '[') {// 递归开启
                String[] tmp = dfs(s, i + 1);
                i = Integer.parseInt(tmp[0]);// 遇到']',i=结尾索引，即右括号位置
                while (multi > 0) {
                    res.append(tmp[1]);
                    multi--;
                }
            } else if (s.charAt(i) == ']') {
                return new String[] {String.valueOf(i), res.toString()};
            } else {
                res.append(s.charAt(i));
            }
            i++;
        }
        return new String[] {String.valueOf(i), res.toString()};
    }
}
