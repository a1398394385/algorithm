import collections


class Solution:
    def subarraysDivByK(self, A: List[int], K: int) -> int:
        record = collections.defaultdict(int)
        record[0] = 1
        total = ans = 0
        for num in A:
            total += num
            mod = total % K
            ans, record[mod] = ans + record[mod], record[mod] + 1
        return ans
