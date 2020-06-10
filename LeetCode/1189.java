class Solution
{
    public int maxNumberOfBalloons(String text) {
        int[] frequency = new int[26];
        for (char c : text.toCharArray())
            frequency[c - 'a']++;
        return Math.min(frequency[1],
                Math.min(frequency[0],
                        Math.min(frequency[13],
                                Math.min(frequency[11] >>> 1, frequency[14] >>> 1))));
    }
}
