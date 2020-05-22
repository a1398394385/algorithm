class Solution:
    def findTheLongestSubstring(self, s: str) -> int:
        D = {"a": 1, "e": 2, "i": 4, "o": 8, "u": 16}
        L = {0: 0}
        m = t = 0
        for i, c in enumerate(s, 1):
            t ^= D.get(c, 0)
            m = max(m, i - L.setdefault(t, i))
        return m