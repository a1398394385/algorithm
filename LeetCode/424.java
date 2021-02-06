class Solution
{
    class Node
    {
        public int count;
        public Node prev;
        public Node next;

        public Node(int count) {
            this.count = count;
        }

        public Node(int count, Node prev, Node next) {
            this.count = count;
            this.prev = prev;
            this.next = next;
        }

        public void increment() {
            count += 1;
            while (count > prev.count) {
                Node temp = this.prev;
                this.prev = temp.prev;
                temp.prev.next = this;
                temp.next = this.next;
                this.next.prev = temp;
                this.next = temp;
                temp.prev = this;
            }
        }

        public void decrement() {
            count -= 1;
            while (count < next.count) {
                Node temp = this.next;
                this.next = temp.next;
                temp.next.prev = this;
                temp.prev = this.prev;
                this.prev.next = temp;
                this.prev = temp;
                temp.next = this;
            }
        }
    }

    public int characterReplacement(String s, int k) {
        Node[] letter = new Node[26];
        Node first = new Node(Integer.MAX_VALUE);
        first.next = letter[0] = new Node(0, first, null);
        for (int i = 1; i < letter.length; i++) {
            letter[i] = new Node(0, letter[i - 1], null);
            letter[i - 1].next = letter[i];
        }
        letter[25].next = new Node(Integer.MIN_VALUE, letter[25], null);
        char[] chars = s.toCharArray();
        int result = 0, left = 0, right = 0, length = chars.length;
        while (right < length) {
            letter[chars[right++] - 'A'].increment();
            while (right - left > first.next.count + k) letter[chars[left++] - 'A'].decrement();
            result = Math.max(right - left, result);
        }
        return result;
    }

    public int characterReplacement1(String s, int k) {
        int[] record = new int[26];
        char[] chars = s.toCharArray();
        int historyMax = 0, left = 0, right = 0, length = chars.length;
        while (right < length) {
            historyMax = Math.max(historyMax, ++record[chars[right++] - 'A']);
            while (right - left > historyMax + k) record[chars[left++] - 'A']--;
        }
        return right - left;
    }
}
