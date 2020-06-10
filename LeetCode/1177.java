import java.util.AbstractList;
import java.util.ArrayList;
import java.util.List;

class Solution
{
    public List<Boolean> canMakePaliQueries(String s, int[][] queries) {
        if (queries.length == 0) return new ArrayList<>();
        List<Boolean> result = new ArrayList<>();
        for (int[] i : queries)
            result.add(name(s.substring(i[0], i[1] + 1), i[2]));
        return result;
    }

    public boolean name(String str, int num) {
        int[] frequency = new int[26];
        for (char c : str.toCharArray())
            frequency[c - 'a']++;
        int result = 0;
        for (int i : frequency)
            result += i & 1;
        return result >>> 1 <= num;
    }

    public List<Boolean> canMakePaliQueries1(String s, int[][] queries) {

        List<Boolean> res = new ArrayList<>();

        int[][] count = new int[s.length() + 1][26];
        for (int i = 1; i <= s.length(); i++) {
            System.arraycopy(count[i - 1], 0, count[i], 0, 26);
            count[i][s.charAt(i - 1) - 'a']++;
        }
        for (int[] q : queries) {
            int[] chs = new int[26];
            int left = q[0];
            int right = q[1];
            for (int i = 0; i < 26; i++) {
                chs[i] = count[left][i] - count[right + 1][i];
            }
            int c = 0;
            for (int i = 0; i < 26; i++) {
                if ((chs[i] & 1) != 0) {
                    c++;
                }
            }
            if (c / 2 > q[2]) {
                res.add(false);
            } else {
                res.add(true);
            }
        }
        return res;
    }

    public List<Boolean> canMakePaliQueries2(String s, int[][] queries) {
        int status[] = new int[s.length() + 1];
        for (int i = 0; i < s.length(); i++)
            status[i + 1] = (status[i] ^ (1 << (s.charAt(i) - 'a')));
        List<Boolean> res = new ArrayList<>();
        for (int query[] : queries) {
            int count = 0, n = (status[query[1] + 1] ^ status[query[0]]);
            while (n != 0) {
                n &= n - 1;
                count++;
            }
            res.add(count / 2 <= query[2]);
        }
        return res;
    }
}


class Solution1 extends AbstractList<Boolean>
{
    int[] cs;
    int[][] qs;

    public int size() {
        return qs.length;
    }

    public Boolean get(int index) {
        int[] q = qs[index];
        int m = cs[q[0]] ^ cs[q[1] + 1];
        int c = 0;
        for (; m != 0; m >>>= 1)
            c += (m & 1);
        return (c >>> 1) <= q[2];
    }

    public List<Boolean> canMakePaliQueries(String s, int[][] queries) {
        final int N = s.length();
        int[] cs = new int[N + 1];
        int m = 0;
        for (int i = 0; i < N; i++) {
            cs[i] = m;
            m ^= 1 << (s.charAt(i) - 'a');
        }
        cs[N] = m;
        this.cs = cs;
        this.qs = queries;
        return this;
    }
}
