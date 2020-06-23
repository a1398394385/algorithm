import java.util.LinkedList;

class Solution
{
    public boolean isSubsequence(String s, String t) {
        LinkedList<Integer>[] cache = new LinkedList[26];
        for (int i = 0; i < cache.length; i++)
            cache[i] = new LinkedList<>();
        for (int i = 0; i < t.length(); i++)
            cache[t.charAt(i) - 'a'].add(i);

        int prev = -1;
        for (int i = 0; i < s.length(); i++) {
            int index = s.charAt(i) - 'a';
            if (cache[index].isEmpty() || cache[index].peekLast() <= prev) return false;
            int point = 0;
            while (point < cache[index].size() && cache[index].get(point) <= prev) point++;
            prev = cache[index].get(point);
        }
        return true;
    }

    public boolean isSubsequence1(String s, String t) {
        char[] charS = s.toCharArray();
        char[] charT = t.toCharArray();
        int Si = 0, Ti = 0;
        while (Si < charS.length && Ti < charT.length) {
            if (charS[Si] == charT[Ti]) Si++;
            Ti++;
        }
        return Si == charS.length;
    }
}
