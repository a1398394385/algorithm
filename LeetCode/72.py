class Solution(object):
    def minDistance(self, word1, word2):
        """
        :type word1: str
        :type word2: str
        :rtype: int
        """
        n1, n2 = len(word1), len(word2)
        dp1 = [0] * (n2 + 1)  # 保留两行
        dp2 = [0] * (n2 + 1)
        dp1[0] = 0
        for j in xrange(1, n2 + 1):
            dp1[j] = j
        for i in xrange(1, n1 + 1):
            dp2[0] = i
            for j in xrange(1, n2 + 1):
                if word1[i - 1] == word2[j - 1]:
                    dp2[j] = dp1[j - 1]
                else:
                    dp2[j] = min(dp1[j], dp2[j - 1], dp1[j - 1]) + 1
            dp1, dp2 = dp2, dp1
        return dp1[n2]
